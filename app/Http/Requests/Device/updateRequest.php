<?php

namespace App\Http\Requests\Device;

use App\Models\Device;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateRequest extends FormRequest
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
            'customer_id' =>'required|exists:customers,id',
            'user_id' => [
                'exists:users,id',
                Rule::requiredIf(request()->user()->isAdmin())
            ],
            'maintenances' =>'required|exists:maintenances,id',
            'description' =>'required|string',
            'status' =>'required|string|in:' . implode(',', Device::STATUSES),

        ];
    }
}
