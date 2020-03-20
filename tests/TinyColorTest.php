<?php

declare(strict_types=1);

namespace Tests;

use TinyColor\Color;
use TinyColor\TinyColor;

class TinyColorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test that true does in fact equal true
     */
    public function testTinyColorParseIsColor()
    {
        $this->assertInstanceOf(Color::class, TinyColor::parse('#000'));
    }

}
