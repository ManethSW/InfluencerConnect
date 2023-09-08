<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class EmailValidation implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function passes($attribute, $value)
    {
        // Split the email address into the user and domain parts
        $parts = explode('@', $value);

        // If there aren't exactly two parts, the email is invalid
        if (count($parts) !== 2) {
            return false;
        }

        // If the domain part doesn't contain a dot, the email is invalid
        if (strpos($parts[1], '.') === false) {
            return false;
        }

        // The email is valid
        return true;
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return 'Must be a valid email address.';
    }
}