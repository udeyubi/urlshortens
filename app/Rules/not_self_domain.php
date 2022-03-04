<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class not_self_domain implements Rule
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
        $domain = parse_url($value);
        $domain = $domain['host'];
        return $domain != request()->getHost();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '請輸入本網站以外的網址';
    }
}
