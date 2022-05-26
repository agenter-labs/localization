<?php

use AgenterLab\Localization\Country;
use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{
    public function testFactoryMethods()
    {
        $this->assertEquals(Country::IN(), new Country('IN'));
        $this->assertEquals(Country::AE(), new Country('AE'));
    }


    public function testCantInstantiateUnknownCountry()
    {
        $this->expectException(OutOfBoundsException::class);

        new Country('unknown');
    }

    public function testComparison()
    {
        $c1 = new Country('IN');
        $c2 = new Country('AE');

        $this->assertTrue($c1->equals(new Country('IN')));
        $this->assertTrue($c2->equals(new Country('AE')));
        $this->assertFalse($c1->equals($c2));
        $this->assertFalse($c2->equals($c1));
    }

    public function testtToArray()
    {
        $c1 = new Country('IN');

        $this->assertEquals('IN', $c1->toArray()['code']);
        $this->assertEquals($c1->getName(), $c1->toArray()['name']);
    }

    public function testResetCountries()
    {
        $countries = Country::getCountries();
        Country::setCountries([]);
        $this->assertEmpty(Country::getCountries());
        Country::setCountries($countries);
    }
}