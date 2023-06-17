<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class ConfirmPassword implements Rule
{
    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function passes($attribute, $value)
    {
        return $value === $this->password;
    }

    public function message()
    {
        return 'The password confirmation does not match.';
    }
}
