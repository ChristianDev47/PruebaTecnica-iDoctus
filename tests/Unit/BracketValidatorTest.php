<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Common\Helpers\BracketValidator;

class BracketValidatorTest extends TestCase
{
    public function testValidBrackets()
    {
        $this->assertTrue(BracketValidator::isValid("{}"));
        $this->assertTrue(BracketValidator::isValid("{}[]()"));
        $this->assertTrue(BracketValidator::isValid("{([])}"));
    }

    public function testInvalidBrackets()
    {
        $this->assertFalse(BracketValidator::isValid("{)"));
        $this->assertFalse(BracketValidator::isValid("[{]}"));
        $this->assertFalse(BracketValidator::isValid("(((((((()"));
    }

    public function testEmptyStringIsValid()
    {
        $this->assertTrue(BracketValidator::isValid(""));
    }
}
