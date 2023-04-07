<?php

namespace App\Http\Requests\Admin\Domain;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDomainRequest extends FormRequest
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
        $domain = $this->route('domain');
        return [
            'domain' => 'required|string|max:255|unique:domains,domain,' . $domain->id,
        ];
    }
}
