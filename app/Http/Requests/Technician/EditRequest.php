<?php

namespace App\Http\Requests\Technician;

use App\Rules\ImageError;
use App\Rules\ImageExtension;
use App\Rules\ImageSize;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Route;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    protected $route;

    public function __construct(Route $route)
    {
        $this->route = $route;

    }
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
            'email'=> ['required', 'email:filter', Rule::unique('users')->ignore($this->route->parameter('tecnico'))],
            'avatar'=> ['file', new ImageError, new ImageExtension, new ImageSize],
            'password'=> 'string|min:8|confirmed|nullable',
        ];
    }
}
