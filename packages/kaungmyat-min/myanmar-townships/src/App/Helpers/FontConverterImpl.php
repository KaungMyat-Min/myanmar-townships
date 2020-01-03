<?php


namespace MyanmarTownships\App\Helpers;


use Googlei18n\MyanmarTools\ZawgyiDetector;
use MyanmarTownships\App\Helpers\Contracts\FontConverter;

class FontConverterImpl implements FontConverter
{

    private $detector;

    public function __construct()
    {
        $this->detector = new ZawgyiDetector();
    }


    public function isZawgyi(string $input): bool
    {
        $score = $this->detector->getZawgyiProbability($input);
        /*
         * Generally, if the score is greater than or equal to 0.95,
         *  you can generally assume the string is Zawgyi.
         *  If the score is lower or equal to 0.05, you can assume it is Unicode.
         */
        return $score > 0.95;
    }


    public function isUnicode($input): bool
    {
        $score = $this->detector->getZawgyiProbability($input);
        /*
         * Generally, if the score is greater than or equal to 0.95,
         *  you can generally assume the string is Zawgyi.
         *  If the score is lower or equal to 0.05, you can assume it is Unicode.
         */
        return $score < 0.05;
    }


    public function convertToUnicode($input, $isNeedToCheck = false)
    {

        if (is_array($input)) {
            $output = [];

            foreach ($input as $key => $value) {
                $output[$key] = $this->convertToUnicode($value, $isNeedToCheck);
            }

            return $output;

        } else {

            if ($input === null || $input === '') {
                //the input must be valid string (not null, not empty string)
                return $input;
            } else {

                if ($isNeedToCheck && $this->isUnicode($input)) {
                    //the string is not need to be checked, so check now.
                    //if the string is already unicode, just return it.
                    return $input;
                } else {
                    //the string is not need to be checked or is not unicode
                    return \Rabbit::zg2uni($input);
                }
            }
        }
    }
}
