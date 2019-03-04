<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    public function testCommandClass()
    {
        $this->assertTrue(class_exists('App\Service\Converter'));
    }
}
