<?php

namespace App\Service;

/**
 * @SuppressWarnings(PHPMD)
 */
class Truncate
{
    public function trunc(string $string): string
    {
        $maxLength = 20;
        $replacement = '';
        $maxLength -= strlen($replacement);

        if (strlen($string) <= $maxLength) {
            return $string;
        }

        if ($spacePosition = strpos($string, ' ', $maxLength - strlen($string))) {
                $maxLength = $spacePosition;
        }

        return substr_replace($string, $replacement, $maxLength);
    }
}
