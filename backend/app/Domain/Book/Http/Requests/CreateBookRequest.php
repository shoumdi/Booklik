<?php

namespace App\domain\book\http\requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'book_name'=>['string','required','min:6'],
            'book_authors'=>['required',Rule::array()],
            'book_description'=>['required','string','min:4'],
            'book_price'=>['required','numeric']
        ];
    }
}
