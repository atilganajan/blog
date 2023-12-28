<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{

    public function rules(): array
    {

        $rules = [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'category' => 'required|string',
        ];

        if ($this->input('change_image')) {

            $rules['image'] = 'required|image|max:3072';
        }

        return $rules;

    }
}
