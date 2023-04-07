<?php

namespace App\Http\Requests\Admin\Advertiser;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvertiser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() : array
    {
        $advertiser = $this->route('advertiser');
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$advertiser->id,
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required|string',
        ];
    }
}
