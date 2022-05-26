<?php

namespace AgenterLab\Localization;
use OutOfBoundsException;

class Country
{

    /**
     * @var array
     */
    protected static $countries;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $code3;

    /**
     * @var string
     */
    protected $ccc;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $timezone;

    /**
     * @var string
     */
    protected $dateFormat;

    /**
     * @var string
     */
    protected $dateSeparator;

    /**
     * Create a new instance.
     *
     * @param string $code
     * 
     * @throws \OutOfBoundsException
     */
    public function __construct(string $country)
    {

        $country = strtoupper(trim($country));
        $countries = static::getCountries();

        if (!array_key_exists($country, $countries)) {
            throw new OutOfBoundsException('Invalid country "' . $country . '"');
        }

        $attributes = $countries[$country];
        $this->country = $country;
        $this->code3 = (string) $attributes['code3'];
        $this->ccc = (string) $attributes['ccc'];
        $this->name = (string) $attributes['name'];
        $this->currency = (string) $attributes['currency'];
        $this->timezone = (string) $attributes['timezone'] ?? 'UTC';
        $this->dateFormat = (string) $attributes['date_format'] ?? 'd M Y';
        $this->dateSeparator = (string) $attributes['date_separator'] ?? 'slash';
    }

    /**
     * getName.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * getDialingCode.
     *
     * @return string
     */
    public function getDialingCode()
    {
        return $this->ccc;
    }


    /**
     * getCode.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->country;
    }


    /**
     * getCode3.
     *
     * @return string
     */
    public function getCode3()
    {
        return $this->code3;
    }


    /**
     * getCurrency.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }


    /**
     * getTimezone.
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }


    /**
     * getDateFormat.
     *
     * @return string
     */
    public function getDateFormat()
    {
        return $this->dateFormat;
    }


    /**
     * getDateSeparator.
     *
     * @return string
     */
    public function getDateSeparator()
    {
        return $this->dateSeparator;
    }

    /**
     * equals.
     *
     * @param \AgenterLab\Localization\Country $country
     *
     * @return bool
     */
    public function equals(self $country)
    {
        return $this->getCode() === $country->getCode();
    }
    
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return  [
            'name'            => $this->name,
            'code'            => $this->country,
            'dialing_code'    => $this->ccc,
            'code3'           => $this->code3,
            'currency'        => $this->currency,
            'timezone'        => $this->timezone,
            'date_format'     => $this->dateFormat,
            'date_separator'  => $this->dateSeparator
        ];
    }

    /**
     * __callStatic.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return \AgenterLab\Localization\Country
     */
    public static function __callStatic($method, array $arguments)
    {
        return new static($method, $arguments);
    }

    /**
     * setCountries.
     *
     * @param array $countries
     *
     * @return void
     */
    public static function setCountries(array $countries)
    {
        static::$countries = $countries;
    }

    /**
     * getCountries.
     *
     * @return array
     */
    public static function getCountries()
    {
        if (!isset(static::$countries)) {
            static::$countries = require __DIR__ . '/../config/country.php';
        }

        return (array) static::$countries;
    }

}