<?php

namespace DutchProvincePostcodeHelper;

use DutchProvincePostcodeHelper\Exceptions\InvalidPostcode;
use DutchProvincePostcodeHelper\Exceptions\InvalidProvince;

class DutchProvincePostcodeHelper {
    /** @var array */
    private $provinces = [];

    /** @var array */
    private $postcodes = [];

    public function __construct()
    {
        $this->provinces = [
            'Drenthe',
            'Flevoland',
            'Friesland',
            'Gelderland',
            'Groningen',
            'Limburg',
            'Noord-Brabant',
            'Noord-Holland',
            'Overijssel',
            'Utrecht',
            'Zeeland',
            'Zuid-Holland',
        ];

        // Translate ranges to simple numbers
        $this->postcodes = array_map(function ($province) {
            $return = [];

            foreach($province as $provincePostcode) {
                if(is_array($provincePostcode)) {
                    foreach($provincePostcode as $postcode) {
                        $return[] = $postcode;
                    }
                } else {
                    $return[] = $provincePostcode;
                }
            }

            return $return;
        }, [
            'Drenthe'          => [
                range(7740, 7766),
                range(7800, 7949),
                range(7956, 7999),
                range(8350, 8354),
                range(8380, 8387),
                range(9300, 9349),
                range(9400, 9478),
                range(9480, 9499),
                range(9510, 9539),
                9564,
                range(9570, 9579),
                range(9654, 9659),
                9749,
                range(9760, 9769),
            ], 'Flevoland'     => [
                range(1300, 1379),
                range(3890, 3899),
                range(8200, 8259),
                range(8300, 8322),
            ], 'Friesland'     => [
                range(8388, 9299),
                range(9850, 9859),
                range(9870, 9879),
            ], 'Gelderland'    => [
                range(3770, 3794),
                range(3837, 3888),
                3925,
                range(4000, 4119),
                range(4147, 4162),
                range(4170, 4199),
                range(4211, 4212),
                range(4214, 4219),
                range(5300, 5335),
                range(6500, 6583),
                range(6600, 7399),
                7439,
                range(8050, 8054),
                range(8070, 8099),
                range(8160, 8195),
            ], 'Groningen'     => [
                range(9350, 9399),
                9479,
                range(9500, 9509),
                range(9540, 9563),
                range(9565, 9569),
                range(9580, 9653),
                range(9660, 9748),
                range(9750, 9759),
                range(9770, 9849),
                range(9860, 9869),
                range(9880, 9999),
            ], 'Limburg'       => [
                range(5766, 5817),
                range(5850, 6019),
                range(6030, 6499),
                range(6584, 6599),
            ], 'Noord-Brabant' => [
                range(4250, 4299),
                range(4600, 4671),
                range(4680, 4681),
                range(4700, 5299),
                range(5340, 5765),
                range(5820, 5846),
                range(6020, 6029),
            ], 'Noord-Holland' => [
                range(1000, 1299),
                range(1380, 1384),
                1394,
                range(1398, 1425),
                range(1430, 2158),
                2165,
            ], 'Overijssel'    => [
                range(7400, 7438),
                range(7440, 7739),
                range(7767, 7799),
                range(7950, 7955),
                range(8000, 8049),
                range(8055, 8069),
                range(8100, 8159),
                range(8196, 8199),
                range(8260, 8299),
                range(8323, 8349),
                range(8355, 8379),
            ], 'Utrecht'       => [
                range(1390, 1393),
                1396,
                range(1426, 1427),
                range(3382, 3464),
                range(3467, 3769),
                range(3795, 3836),
                range(3900, 3924),
                range(3926, 3999),
                range(4120, 4125),
                range(4130, 4146),
                range(4163, 4169),
                range(4230, 4239),
                range(4242, 4249),
            ], 'Zeeland'       => [
                range(4300, 4599),
                range(4672, 4679),
                range(4682, 4699),
            ], 'Zuid-Holland'  => [
                range(1428, 1429),
                range(2159, 2164),
                range(2170, 3381),
                range(3465, 3466),
                range(4126, 4129),
                range(4200, 4209),
                4213,
                range(4220, 4229),
            ],
        ]);
    }

    /**
     * Get all provinces
     *
     * @return array
     */
    public function getProvinces(): array
    {
        return $this->provinces;
    }

    /**
     * Get all postcode numbers
     *
     * @return array
     */
    public function getPostcodeNumbers(): array
    {
        $postcodeNumbers = array_reduce($this->postcodes, function ($total, $province) {
            return array_merge($total, $province);
        }, []);

        sort($postcodeNumbers); // sort ascending

        return $postcodeNumbers;
    }

    /**
     * Check if the given postcode is a valid (Dutch) postcode
     *
     * @param  string  $postcode
     * @return bool
     */
    public function isValidPostcode(string $postcode): bool {
        $postcode = self::filterPostcode($postcode);

        return in_array($postcode, $this->getPostcodeNumbers());
    }

    /**
     * @param $postcode
     * @return string
     * @throws InvalidPostcode
     */
    public function getProvinceFromPostcode($postcode): string
    {
        foreach($this->provinces as $province) {
            try {
                if($this->isPostcodeInProvince($postcode, $province)) {
                    return $province;
                }
            } catch (InvalidProvince $e) {
                // Unreachable
            }
        }
    }

    /**
     * Check if the given (Dutch) postcode is within the given (Dutch) province
     *
     * @param  string|int  $postcode
     * @param  string  $province
     * @return bool
     * @throws InvalidProvince
     * @throws InvalidPostcode
     */
    public function isPostcodeInProvince($postcode, string $province): bool {
        if(!$this->isValidProvince($province)) {
            throw new InvalidProvince();
        }

        if(!is_int($postcode)) {
            $postcode = self::filterPostcode($postcode);
        }

        if(!in_array($postcode, $this->getPostcodeNumbers())) {
            throw new InvalidPostcode();
        }

        /** @var array $provincePostcodes */
        $provincePostcodes = $this->postcodes[$province];

        foreach($provincePostcodes as $provincePostcode) {
            if($postcode == $provincePostcode) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the given province is a Dutch province
     *
     * @param  string  $province
     * @return bool
     */
    public function isValidProvince(string $province): bool
    {
        return in_array($province, $this->provinces);
    }

    /**
     * Filter the given postcode by only keeping the numbers
     *
     * @param  string  $postcode
     * @return int
     */
    public static function filterPostcode(string $postcode): int {
        return intval(str_replace(['+', '-'], '', filter_var($postcode, FILTER_SANITIZE_NUMBER_INT)));
    }
}
