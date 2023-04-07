<?php

namespace App\Http\Requests\Admin\Offer;

use Illuminate\Foundation\Http\FormRequest;

class CreateOfferRequest extends FormRequest
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
        return [
            'category_id' => 'required',
            'advertiser_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1024',
            'preview' => 'required|url',
            'url' => 'required|string|max:255',
            'revenue' => 'required|numeric',
            'payout' => 'required|numeric',
            'expiration_date' => 'nullable|date',
            'conversion_status' => 'required|boolean',
            'status' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,bmp,png,gif,svg',
        ];
    }
}
