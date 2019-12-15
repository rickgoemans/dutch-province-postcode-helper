# Dutch Province Postcode Helper
This package helps you with common actions related to (Dutch) postcodes and provinces.  
Source: https://nl.wikipedia.org/wiki/Postcodes_in_Nederland

## Table of contents
[1.0 Install](#10-install)  
[2.0 Usage](#20-usage)  
[2.1 Get all provinces](#21-get-all-provinces)  
[2.2 Get all postcode numbers](#22-get-all-postcode-numbers)  
[2.3 Valid province](#23-valid-province)  
[2.4 Valid postcode](#24-valid-postcode)  
[2.5 Get province from postcode](#25-get-province-from-postcode)  
[2.6 Check postcode in province](#26-check-postcode-in-province)  
[3.0 Tests](#30-tests)  
[4.0 Future expansions](#40-future-expansions)

## 1.0 Install
```bash
compose require rickgoemans/dutch-province-postcode-helper
```

## 2.0 Usage
Here are some examples of how to use this package.

### 2.1 Get all provinces
```php
use DutchProvincePostcodeHelper\DutchProvincePostcodeHelper;

$provinces = (new DutchProvincePostcodeHelper())->getProvinces();
```

### 2.2 Get all postcode numbers
```php
use DutchProvincePostcodeHelper\DutchProvincePostcodeHelper;

$provinces = (new DutchProvincePostcodeHelper())->getPostcodeNumbers();
```

### 2.3 Valid province
```php
use DutchProvincePostcodeHelper\DutchProvincePostcodeHelper;

if((new DutchProvincePostcodeHelper())->isValidProvince('Noord-Brabant')) {
    // valid 
} else {
    // invalid
}
```

### 2.4 Valid postcode
```php
use DutchProvincePostcodeHelper\DutchProvincePostcodeHelper;

if((new DutchProvincePostcodeHelper())->isValidPostcode('5825 CP')) {
    // valid 
} else {
    // invalid
}
```

### 2.5 Get province from postcode
```php
use DutchProvincePostcodeHelper\DutchProvincePostcodeHelper;

try {
    $province = (new DutchProvincePostcodeHelper())->getProvinceFromPostcode('5825 CP'));
} catch (\DutchProvincePostcodeHelper\Exceptions\InvalidPostcode $e) {
    echo $e->getMessage();
}
```

### 2.6 Check postcode in province

```php
use DutchProvincePostcodeHelper\DutchProvincePostcodeHelper;

try {
    if((new DutchProvincePostcodeHelper())isPostcodeInProvince('5825 CP', 'Noord-Brabant'))) {
        // true
    } else {
        // false
    }
} catch (\DutchProvincePostcodeHelper\Exceptions\InvalidPostcode $e) {
    echo $e->getMessage();
}
```
## 3.0 Tests
You can execute PHPUnit tests by running;

```bash
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/DutchProvincePostcodeHelperTest.php
```

## 4.0 Future expansions
Nothing planned at the moment. Know of something useful to add? Post an issue!
