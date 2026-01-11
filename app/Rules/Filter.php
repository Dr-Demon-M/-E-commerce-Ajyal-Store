<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    protected array $blocked; // array get value from request

    public function __construct(array $blocked)
    {
        $this->blocked = $blocked;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void // to filter word didnt cant use 
    {  // use in request (( new Filter(['php', 'html']) ))
        if (in_array(strtolower($value), $this->blocked)) {
            $fail('This value is not allowed.');    
        }
    }
}
