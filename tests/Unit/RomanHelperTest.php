<?php

namespace Tests\Unit;

use App\Helpers\RomanHelper;
use PHPUnit\Framework\TestCase;

class RomanHelperTest extends TestCase
{
    public function test_get_angkatan_romawi_for_2026()
    {
        $this->assertEquals('XXXIV', RomanHelper::getAngkatanRomawi(2026));
    }

    public function test_to_roman_conversion()
    {
        $this->assertEquals('XXXIV', RomanHelper::toRoman(34));
    }
}
