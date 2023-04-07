<?php

namespace App\Http\Requests\Admin\Affiliate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAffiliateRequest extends FormRequest
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
    public function rules()
    {
        $affiliate = $this->route('affiliate');
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$affiliate->id,
            'password' => 'nullable|string|min:8|confirmed',
            'manager_id' => 'required|integer',
            'status' => 'required|string',
        ];
    }
}
