<?php

namespace DutchProvincePostcodeHelper\Exceptions;

use Exception;

class InvalidPostcode extends Exception {
    protected $message = 'Invalid (Dutch) postcode';
}
