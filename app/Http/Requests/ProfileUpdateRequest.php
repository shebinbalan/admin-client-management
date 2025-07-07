<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user()->id)],
            'phone' => 'required|string|max:20',
            'password' => 'nullable|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:max_width=1920,max_height=1080',
        ];
    }

    public function messages(): array
    {
        return [
            'profile_image.dimensions' => 'The profile image must not exceed 1920x1080 pixels.',
            'profile_image.max' => 'The profile image must not exceed 2MB.',
        ];
    }
}