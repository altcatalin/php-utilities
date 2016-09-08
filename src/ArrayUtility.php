<?php

namespace PhpUtilities;

class ArrayUtility
{
    /**
     * Check for minimum array structure
     *
     * @param $required
     * @param $provided
     * @return bool
     * @throws \ErrorException
     */
    public static function isMinimumProvided($required, $provided)
    {
        if (!is_array($required) || !is_array($provided)) {
            throw new \ErrorException('Only arrays allowed as parameters');
        }

        foreach ($required as $key => $value) {
            if (!isset($provided[$key])) {
                return false;
            }

            if (is_array($value)) {
                try {
                    return self::isMinimumProvided($value, $provided[$key]);
                }
                catch (\ErrorException $e) {
                    return false;
                }
            }
        }

        return true;
    }
}