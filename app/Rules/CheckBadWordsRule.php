<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckBadWordsRule implements Rule
{
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
        $words = array('f***', 's***' , 'a****' , 'b***');
        foreach ($words as $word) {
            if (stripos($value, $word)) return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must not contain bad words.';
    }
}
