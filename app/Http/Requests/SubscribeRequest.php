<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'subscribe_email' => 'required|email|unique:subscriptions|max:255',
        ];
    }
}
