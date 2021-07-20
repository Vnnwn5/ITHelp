<?php

namespace App\Http\Requests\Technician;

use App\Rules\ImageSize;
use App\Rules\ImageError;
use App\Rules\ImageExtension;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|max:100',
            'last_name'=> 'required|max:100',
            'email'=> 'required|email:filter|unique:users',
            'avatar'=> ['file', new ImageError, new ImageExtension, new ImageSize],
            'password'=> 'required|string|min:8|confirmed',


        ];
    }
}
