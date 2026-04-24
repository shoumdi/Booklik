<?php

namespace App\Domain\Community\Dto;

use Illuminate\Http\UploadedFile;

class CreateCommunityData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        readonly string $name,
        readonly string $description,
        readonly UploadedFile $image
    ) {}

    public static function from(array $inputs): self
    {
        return new self(
            $inputs['name'],
            $inputs['description'],
            $inputs['image']
        );
    }
    public function inputs(){
        return [
            'name'=>$this->name,
            'description'=>$this->description,
        ];
    }
}
