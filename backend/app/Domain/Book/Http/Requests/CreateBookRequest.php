<?php

namespace App\Domain\Book\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

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
            'book_title' => ['string', 'required'],
            'book_description' => ['required', 'string'],
            'book_cover' => ['required', File::types(['jpg', 'jpeg', 'png'])->max('2mb')],
            'book_price' => ['required', 'numeric'],
            'book_genres' => ['required', 'array'],
            'book_genres.*' => ['required', 'string'],
            'book_authors' => ['required', 'array'],
            'book_authors.*.fname' => ['required', 'string'],
            'book_authors.*.lname' => ['required', 'string'],
        ];
    }
}
