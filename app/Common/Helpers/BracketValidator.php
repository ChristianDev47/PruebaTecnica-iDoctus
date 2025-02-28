<?php

namespace App\Common\Helpers;

class BracketValidator
{
    /**
     * Checks if an expression contains balanced brackets: {} = True, {) = False.
     *
     * @param string $token
     * @return bool
     */
    public static function isValid(string $token): bool
    {
        $pairs = ['(' => ')', '{' => '}', '[' => ']'];
        $stack = [];
        $validChars = array_merge(array_keys($pairs), array_values($pairs));
        $n = strlen($token);

        for ($x = 0; $x < $n; $x++) {
            $char = $token[$x];
            if (!in_array($char, $validChars, true)) {
                return false;
            }
            if (isset($pairs[$char])) {
                $stack[] = $char;
            } else {
                if (empty($stack)) {
                    return false;
                }
                $last = array_pop($stack);
                if ($pairs[$last] !== $char) {
                    return false;
                }
            }
        }

        return empty($stack);
    }
}
