<?php

namespace App\Domain\Book\Http\Requests;

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
            'book_title' => ['string', 'required', 'min:40'],
            'book_description' => ['required', 'string', 'min:30', 'max:255'],
            'book_price' => ['required', 'numeric'],
            'book_genre' => ['required', 'array'],
            'book_genre.*' => ['required', 'string'],
            'book_authors' => ['required', 'array'],
            'book_authors.*.fname' => ['required', 'string'],
            'book_authors.*.lname' => ['required', 'string'],
        ];
    }
}
