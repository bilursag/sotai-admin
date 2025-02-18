<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class ValidRut implements Rule
{
    public function passes($attribute, $value)
    {
        $rut = str_replace(['.', '-'], '', $value);
        $rut = strtoupper($rut);

        $number = substr($rut, 0, -1);
        $dv = substr($rut, -1);

        $sum = 0;
        $multiplier = 2;
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $sum += $number[$i] * $multiplier;
            $multiplier = $multiplier == 7 ? 2 : $multiplier + 1;
        }
        $dvOutput = 11 - ($sum % 11);
        $dvOutput = $dvOutput == 11 ? '0' : ($dvOutput == 10 ? 'K' : strval($dvOutput));

        return $dv == $dvOutput;
    }

    public function message()
    {
        return 'El RUT ingresado no es válido';
    }
}
