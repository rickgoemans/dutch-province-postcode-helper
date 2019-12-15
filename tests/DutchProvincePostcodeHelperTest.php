<?php
declare(strict_types=1);

use DutchProvincePostcodeHelper\DutchProvincePostcodeHelper;
use PHPUnit\Framework\TestCase;

final class DutchProvincePostcodeHelperTest extends TestCase {
    /** var DutchProvincePostcodeHelper */
    protected $dutchProvincePostcodeHelper;

    public function __construct()
    {
        parent::__construct();

        $this->dutchProvincePostcodeHelper = new DutchProvincePostcodeHelper();
    }

    public function testCanGetProvinces()
    {
        $this->assertIsArray($this->dutchProvincePostcodeHelper->getProvinces());
    }

    public function testCanGetPostcodeNumbers()
    {
        $this->assertIsArray($this->dutchProvincePostcodeHelper->getPostcodeNumbers());
    }

    public function testCanCheckValidProvince()
    {
        $this->assertTrue($this->dutchProvincePostcodeHelper->isValidProvince('Noord-Brabant'));
    }

    public function testCanCheckValidPostcode()
    {
        $this->assertTrue($this->dutchProvincePostcodeHelper->isValidPostcode('5825 CP'));
    }

    public function testCanGetProvinceFromPostcode()
    {
        try {
            $this->assertEquals('Noord-Brabant',
                $this->dutchProvincePostcodeHelper->getProvinceFromPostcode('5825 CP'));
        } catch (\DutchProvincePostcodeHelper\Exceptions\InvalidPostcode $e) {
            echo $e->getMessage();
        }
    }

    public function testCanCheckPostcodeFromProvince()
    {
        try {
            $this->assertTrue($this->dutchProvincePostcodeHelper->isPostcodeInProvince('5825 CP', 'Noord-Brabant'));
        } catch (\DutchProvincePostcodeHelper\Exceptions\InvalidPostcode $e) {
            echo $e->getMessage();
        } catch (\DutchProvincePostcodeHelper\Exceptions\InvalidProvince $e) {
            echo $e->getMessage();
        }
    }
}
