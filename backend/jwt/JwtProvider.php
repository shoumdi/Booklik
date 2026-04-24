<?php
namespace JWT;

use JWT\Exception\ExpiredTokenException;
use JWT\Exception\InvalidTokenException;
use DomainException;
use InvalidArgumentException;
use UnexpectedValueException;

use function PHPUnit\Framework\isArray;
use function PHPUnit\Framework\isNumeric;
use function PHPUnit\Framework\isString;

class JwtProvider
{

    use JsonHandler;

    private $supportedAlgs = [
        'HS256' => ['hash_hmac', 'SHA256'],
        'HS384' => ['hash_hmac', 'SHA384'],
        'HS512' => ['hash_hmac', 'SHA512']
    ];
    /**
     * 
     * 
     */
    public function encode(
        array $payload,
        string $secret,
        string $alg
    ) {
        $header = ["typ" => "jwt"];
        $header["alg"] = $alg;

        $parts = [];

        $parts[] = $this->base64UrlEncode($this->jsonEncode($header));
        $parts[] = $this->base64UrlEncode($this->jsonEncode($payload));
        $parts[] = $this->base64UrlEncode($this->sign($alg, implode('.', $parts), $secret));

        return implode('.', $parts);
    }


    public function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
    public function base64UrlDecode(string $data): string
    {
        $data = strtr($data, '-_', '+/');
        $data .= str_repeat('=', 4 - (strlen($data) % 4));
        return base64_decode($data);
    }

    public function sign(
        string $alg,
        string $data,
        $key
    ): string {
        if (!isset($this->supportedAlgs[$alg]))
            throw new DomainException("Unsupported algorithm " . $alg);
        [$hashMethod, $hashAlg] = $this->supportedAlgs[$alg];
        switch ($hashMethod) {
            case 'hash_hmac':
                if (!isString($key)) throw new InvalidArgumentException('Key must be string in hashmac');
                $this->validateHashmacKey($key, $hashAlg);
                return hash_hmac(
                    algo: $hashAlg,
                    data: $data,
                    key: $key,
                    binary: true
                );
            default:
                throw new DomainException('Unsupported Algorithm');
        }
    }

    /**
     * @throws UnexpectedValueException
     * @throws DomainException
     * @throws InvalidArgumentException
     * @throws InvalidTokenException
     * @throws ExpiredTokenException
     * 
     */
    public function decode(
        string $token,
        $key
    ): object {
        $parts = explode('.', $token);
        if (count($parts) !== 3) throw new UnexpectedValueException("token has less then the expected parts");
        [$head64, $payload64, $sign64] = $parts;
        if (null === ($header = $this->jsonDecode($this->base64UrlDecode($head64))))
            throw new UnexpectedValueException('Invalide header encoding');
        if (!isset($header->alg))
            throw new DomainException('Algorithm is required');
        if (!isset($this->supportedAlgs[$header->alg]))
            throw new DomainException("Unsupported algo $header->alg");

        if (null === ($payload = $this->jsonDecode($this->base64UrlDecode($payload64))))
            throw new UnexpectedValueException('Invalide payload encoding');
        if (isArray($payload)) $payload = (object) $payload;

        if (isset($payload->exp) && !isNumeric($payload->exp))
            throw new InvalidArgumentException('exp time should be of numiric value');
        if (isset($payload->iat) && !isNumeric($payload->iat))
            throw new InvalidArgumentException('iat time should be of numiric value');


        if (!hash_equals(
            $this->base64UrlDecode($sign64),
            $this->sign(
                alg: array_find_key($this->supportedAlgs, fn($algorithm) => $algorithm[1] !== $header->alg) ?? '',
                data: implode('.', [$head64, $payload64]),
                key: $key
            )
        )) throw new InvalidTokenException('token is invalid');

        if (isset($payload->exp) && $payload->exp < time())
            throw new ExpiredTokenException("Token already expired $payload->exp");


        return $payload;
    }
    private function validateHashmacKey(string $key, string $algo)
    {
        $minLength = (int) str_replace('SHA', '', $algo);
        $keyLength = strlen($key) * 8;
        if ($keyLength < $minLength) throw new DomainException('key too short for hashmac');
    }

    private function constantTimeEquals(string $s1, string $s2): bool
    {
        $s1Length = strlen($s1);
        if ($s1Length !== strlen($s2)) return false;
        $r = 0;
        for ($i = 0; $i < $s1Length; $i++)
            $r |= $s1[$i] ^ $s2[$i];
        return $r === 0;
    }
}
