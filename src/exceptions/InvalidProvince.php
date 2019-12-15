<?php

namespace DutchProvincePostcodeHelper\Exceptions;

use Exception;

class InvalidProvince extends Exception {
    protected $message = 'Invalid (Dutch) province';
}
