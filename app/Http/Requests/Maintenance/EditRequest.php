<?php

namespace App\Http\Requests\Maintenance;

use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    protected $route;

    public function __construct (Route $route)
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
            'name' => ['required', Rule::unique('maintenances')->ignore($this->route->parameter('id'))],
            'price'=> 'required'
        ];
    }
}
