<?php

namespace App\Http\Requests;

use App\Rules\CheckBadWordsRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceRequest extends FormRequest
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
            'name' => 'required | min:6 | max:255',
            'image' => 'required | image',
            'description' => [
                'required',
                'min:6',
                new CheckBadWordsRule(),
            ],
            'type_id' => 'required | exists:types,id'
        ];
    }
}
