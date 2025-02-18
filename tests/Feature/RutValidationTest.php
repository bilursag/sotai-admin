<?php

namespace Tests\Feature;

use App\Rules\ValidRut;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RutValidationTest extends TestCase
{
    public function test_a_valid_rut_passes_validation()
    {
        $rule = new ValidRut();
        $this->assertTrue($rule->passes('rut', '9618152-3'));
        $this->assertTrue($rule->passes('rut', '25625073-K'));
    }

    public function test_an_invalid_rut_fails_validation()
    {
        $rule = new ValidRut();

        $this->assertFalse($rule->passes('rut', '12.345.678-0'));
        $this->assertFalse($rule->passes('rut', '12.345.678'));
        $this->assertFalse($rule->passes('rut', 'abc.def.ghi-j'));
    }
}
