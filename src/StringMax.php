<?php

/**
 * jDelta PHP String Max
 * 
 * https://jdelta.github.io/php-string-max
 * Version 1.0
 * 
 * Copyright 2018, Jaime Cruz
 * Released under the MIT license
 */

namespace jDelta;

class StringMax {

    /**
     * Format string 
     * 
     * Example:
     * ```php
     * 
     * echo StringMax::format(
     *     'Hi {{name}}, remember to be {{tip}}',
     *     ['name' => 'developer', 'tip' => 'nice']
     * );
     * ```
     * @param string $tpl
     * @param array $data
     * @param string $undefinedVar default value for undefined values
     * 
     * @return string the formated string
     */
    public static function format($tpl, $data, $removeWhiteSpaces = true, $undefinedVar = '') {
        $output = $tpl;
        if (preg_match_all("/{{(.*?)}}/", $tpl, $matches)) {
            foreach ($matches[1] as $i => $key) {
                $value = (string) (isset($data[$key]) ? $data[$key] : $undefinedVar);
                $output = str_replace($matches[0][$i], $value, $output);
            }
        }
        return $removeWhiteSpaces ? trim($output) : $output;
    }

    /**
     * Format array
     * 
     * Formats an array of strings including sub arrays.
     * 
     * ```php
     * 
     * echo StringMax::formatArray([
     *         'Hi {{name}}, remember to be {{tip}}.',
     *         'Because {{myTarget}} love nice {{myTarget}}',
     *         'and' => [
     *             'the world is better if we have more {{mates}}.'
     *         ]
     *     ],
     *     [
     *         'name'      => 'developer',
     *         'tip'       => 'nice',
     *         'myTarget'  => 'people',
     *         'mates'     => 'friends'
     *     ]
     * );
     * ```
     * @param array $array
     * @param array $values
     * @return array the formated array
     */
    public static function formatArray(&$array, $values) {
        foreach ($array as $key => $value) {
            if (is_string($value)) {
                $array[$key] = self::format($value, $values);
            } elseif (is_array($value)) {
                $array[$key] = self::formatArray($value, $values);
            }
        }
        return $array;
    }

}
