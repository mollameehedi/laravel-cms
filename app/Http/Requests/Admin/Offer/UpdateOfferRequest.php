<?php

namespace App\Http\Requests\Admin\Offer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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
        $offer = $this->route('offer');
        return [
            'name' => 'required|string|max:255|unique:offers,name,' . $offer->id,
            'description' => 'nullable|string',
            'advertiser_id' => 'required|integer|exists:users,id',
            'preview_link' => 'required|url',
            'offer_link' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'alt_offer_id' => 'nullable|integer|exists:offers,id',
            'expiration_date' => 'nullable|date',
            'payout_type' => 'required|string|in:RevenueShare,Fixed',
            'revenue' =>  'required',
            'payout' => 'required',
            'country_id' => 'nullable|array|exists:countries,id',
            'device_id' => 'nullable|array|exists:devices,id',
            'same_ip_click' => 'required|boolean',
            'same_ip_conversion' => 'required|boolean',
            'status' => 'required|string|in:Approved,Pending,Private,RequestApproved',
        ];
    }
}
