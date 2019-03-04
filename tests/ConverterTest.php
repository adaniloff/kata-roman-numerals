<?php

namespace App\Tests;

use App\Service\Converter;
use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    public function testCommandClass()
    {
        $this->assertTrue(class_exists('App\Service\Converter'));
    }

    public function testCommandMethod()
    {
        $this->assertTrue(method_exists('App\Service\Converter', 'convert'));
    }

    public function testSingleDigit()
    {
        $this->assertEquals("I", Converter::convert(1));
        $this->assertEquals("II", Converter::convert(2));
        $this->assertEquals("III", Converter::convert(3));
        $this->assertEquals("IV", Converter::convert(4));
        $this->assertEquals("V", Converter::convert(5));
        $this->assertEquals("VI", Converter::convert(6));
        $this->assertEquals("VII", Converter::convert(7));
        $this->assertEquals("VIII", Converter::convert(8));
        $this->assertEquals("IX", Converter::convert(9));
    }

    public function testDoubleDigit()
    {
        $this->assertEquals("X", Converter::convert(10));
        $this->assertEquals("XX", Converter::convert(20));
        $this->assertEquals("XXX", Converter::convert(30));
        $this->assertEquals("XL", Converter::convert(40));
        $this->assertEquals("L", Converter::convert(50));
        $this->assertEquals("LX", Converter::convert(60));
        $this->assertEquals("LXX", Converter::convert(70));
        $this->assertEquals("LXXX", Converter::convert(80));
        $this->assertEquals("XC", Converter::convert(90));
    }

    public function testCompoundDoubleDigit()
    {
        $this->assertEquals("XIV", Converter::convert(14));
        $this->assertEquals("XXV", Converter::convert(25));
        $this->assertEquals("XXXVI", Converter::convert(36));
        $this->assertEquals("XLIX", Converter::convert(49));
        $this->assertEquals("LV", Converter::convert(55));
        $this->assertEquals("XCIX", Converter::convert(99));
    }

    public function testTripleDigit()
    {
        $this->assertEquals("C", Converter::convert(100));
        $this->assertEquals("CC", Converter::convert(200));
        $this->assertEquals("CCC", Converter::convert(300));
        $this->assertEquals("CD", Converter::convert(400));
        $this->assertEquals("D", Converter::convert(500));
        $this->assertEquals("DC", Converter::convert(600));
        $this->assertEquals("DCC", Converter::convert(700));
        $this->assertEquals("DCCC", Converter::convert(800));
        $this->assertEquals("CM", Converter::convert(900));
    }

    public function testCompoundTripleDigit()
    {
        $this->assertEquals("CI", Converter::convert(101));
        $this->assertEquals("CCV", Converter::convert(205));
        $this->assertEquals("CCCX", Converter::convert(310));
        $this->assertEquals("CDXV", Converter::convert(415));
        $this->assertEquals("DXXVI", Converter::convert(526));
        $this->assertEquals("DCLV", Converter::convert(655));
        $this->assertEquals("DCCLXXXIV", Converter::convert(784));
        $this->assertEquals("DCCCXCVI", Converter::convert(896));
        $this->assertEquals("CMXXIX", Converter::convert(929));
    }

    public function testQuadDigit()
    {
        $this->assertEquals("M", Converter::convert(1000));
        $this->assertEquals("MM", Converter::convert(2000));
        $this->assertEquals("MMM", Converter::convert(3000));
    }

    public function testCompoundQuadDigit()
    {
        $this->assertEquals("MI", Converter::convert(1001));
        $this->assertEquals("MMCDV", Converter::convert(2405));
        $this->assertEquals("MMMCXX", Converter::convert(3120));
        $this->assertEquals("MMMCMXCIX", Converter::convert(3999));
    }

    public function testZero()
    {
        $this->expectExceptionMessage("Invalid argument number: cant be less than 1");
        Converter::convert(0);
    }

    public function test5000()
    {
        $this->expectExceptionMessage("Invalid argument number: cant be greater than 3999");
        Converter::convert(5000);
    }

    public function testInvalidInput()
    {
        $this->expectExceptionMessageRegExp("/Argument 1 passed to .* must be of the type integer/");
        Converter::convert("aaa");
    }
}
