<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidRut implements Rule
{
  public function passes($attribute, $value)
  {
    $rut = str_replace(['.', '-'], '', $value);
    $rut = strtoupper($rut);

    $body = substr($rut, 0, -1);
    $dv = substr($rut, -1);

    if (!ctype_digit($body) || !in_array($dv, ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'K'])) {
      return false;
    }

    $sum = 0;
    $multiplier = 2;
    for ($i = strlen($body) - 1; $i >= 0; $i--) {
      $sum += $body[$i] * $multiplier;
      $multiplier = $multiplier == 7 ? 2 : $multiplier + 1;
    }
    $dvExpected = 11 - ($sum % 11);
    $dvExpected = $dvExpected == 11 ? '0' : ($dvExpected == 10 ? 'K' : strval($dvExpected));

    return $dv == $dvExpected;
  }

  public function message()
  {
    return 'El RUT ingresado no es válido.';
  }
}
