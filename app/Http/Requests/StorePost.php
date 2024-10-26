<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'bail|required|min:5|max:100',
            'content'=>'required|min:10',
            'thumbnail' => 'required|file|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_height=500', // مثال على القواعد
        ];
    }
}
