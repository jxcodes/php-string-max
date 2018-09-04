<?php

/**
 * jDelta PHP String Max
 * 
 * https://jdelta.github.io/php-string-max
 * Version 1.1
 * 
 * Copyright 2018, Jaime Cruz
 * Released under the MIT license
 */

namespace jDelta;

class StringMax {

    /**
     * Replace tokens
     * 
     * Example:
     * ```php
     * 
     * echo StringMax::replaceTokens(
     *     'Hi {{name}}, remember to be {{tip}}',
     *     ['name' => 'developer', 'tip' => 'nice']
     * );
     * 
     * ```
     * @param string $tpl The template.
     * @param array $data The values.
     * @param boolean $replaceUndefinedTokens Set **true** to replace the found tokens with an empty string.
     * @param string $undefinedTokenString Use this to set an specific string when the previous parameter is **true**
     * 
     * @return string the resulting string.
     */
    public static function replaceTokens($tpl, $data, $replaceUndefinedTokens = false, $undefinedTokenString = '') {
        $output = $tpl;
        $matches = [];
        if (preg_match_all("/{{(.*?)}}/", $tpl, $matches)) {
            foreach ($matches[1] as $i => $key) {
                if (isset($data[$key])) {
                    $output = str_replace($matches[0][$i], $data[$key], $output);
                } elseif ($replaceUndefinedTokens) {
                    $output = str_replace($matches[0][$i], $undefinedTokenString, $output);
                }
            }
        }
        return $output;
    }

    /**
     * Replace tokens in array
     * 
     * Replaces tokens in an array of strings including sub arrays.
     * 
     * ```php
     * 
     * $result = StringMax::replaceTokensInArray([
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
     * 
     * ```
     * @param array $tpl The array of templates
     * @param array $values The values
     * 
     * @return The resulting array.
     */
    public static function replaceTokensInArray($tpl, $values, $replaceUndefinedTokens = false, $undefinedTokenString = '') {
        foreach ($tpl as $key => $value) {
            if (is_string($value)) {
                $tpl[$key] = self::replaceTokens($value, $values, $replaceUndefinedTokens, $undefinedTokenString);
            } elseif (is_array($value)) {
                $tpl[$key] = self::replaceTokensInArray($value, $values, $replaceUndefinedTokens, $undefinedTokenString);
            }
        }
        return $tpl;
    }

}
