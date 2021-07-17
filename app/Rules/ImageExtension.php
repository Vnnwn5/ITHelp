<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageExtension implements Rule
{
    protected $allowed_extensions=['jpg','jpeg','png','gif'];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $extension = strtolower($value->getClientOriginalExtension());
        return in_array($extension, $this->allowed_extensions);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Extencion invalida de la imagen';
    }
}
