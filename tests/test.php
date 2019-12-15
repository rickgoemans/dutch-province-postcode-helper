<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DutchProvincePostcodeHelper\DutchProvincePostcodeHelper;
use DutchProvincePostcodeHelper\Exceptions\InvalidPostcode;
use DutchProvincePostcodeHelper\Exceptions\InvalidProvince;

$dutchProvincePostcodeHelper = new DutchProvincePostcodeHelper();

echo "Provinces: " . implode(', ', $dutchProvincePostcodeHelper->getProvinces());

echo "Postcode numbers: " . implode(', ', $dutchProvincePostcodeHelper->getPostcodeNumbers());

$result = $dutchProvincePostcodeHelper->isValidProvince('Noord-Brabant') ? "yes" : "no";
echo "Valid province: {$result}";

$result =  $dutchProvincePostcodeHelper->isValidPostcode('5825 CP') ? "yes" : "no";
echo "Valid postcode: {$result}";

try {
    echo 'Province from postcode: ' . $dutchProvincePostcodeHelper->getProvinceFromPostcode('5825 CP');
} catch (InvalidPostcode $e) {
    echo "Province from postcode: [ERROR] {$e->getMessage()}";
}

try {
    $result = $dutchProvincePostcodeHelper->isPostcodeInProvince('5825 CP', 'Noord-Brabant') ? "yes" : "no";
    echo "Postcode in province: {$result}";
} catch (InvalidPostcode $e) {
    echo "Province in province: [ERROR] {$e->getMessage()}";
} catch (InvalidProvince $e) {
    echo "Province in province: [ERROR] {$e->getMessage()}";
}

