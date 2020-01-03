<?php


namespace MyanmarTownships\App\Helpers\Contracts;


interface FontConverter
{
    /**
     * Determine whether the input string is zawgyi or not
     * @param string $input
     * @return bool
     */
    public function isZawgyi(string $input): bool;

    /**
     * Determine whether the input string is unicode or not
     * @param string $input
     * @return bool
     */
    public function isUnicode($input): bool;

    /**
     *
     * @param array|string $input
     * @param bool $isNeedToCheck determine the string is already checked for zawgyi/unicode
     * @return array|string
     */
    public function convertToUnicode($input, $isNeedToCheck = true);
}
