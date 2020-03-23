<?php

namespace TinyColor\Traits;

trait Convert
{
    // Conversion Functions
    // --------------------

    // `rgbToHsl`, `rgbToHsv`, `hslToRgb`, `hsvToRgb` modified from:
    // <http://mjijackson.com/2008/02/rgb-to-hsl-and-rgb-to-hsv-color-model-conversion-algorithms-in-javascript>

    // `rgbToRgb`
    // Handle bounds / percentage checking to conform to CSS color spec
    // <http://www.w3.org/TR/css3-color/>
    // *Assumes:* r, g, b in [0, 255] or [0, 1]
    // *Returns:* { r, g, b } in [0, 255]
    protected function rgbToRgb($r, $g, $b)
    {
        return [
            'r' => bound01($r, 255) * 255,
            'g' => bound01($g, 255) * 255,
            'b' => bound01($b, 255) * 255,
        ];
    }

    // `rgbToHsl`
    // Converts an RGB color value to HSL.
    // *Assumes:* r, g, and b are contained in [0, 255] or [0, 1]
    // *Returns:* { h, s, l } in [0,1]
    protected function rgbToHsl($r, $g, $b)
    {

        $r = bound01($r, 255);
        $g = bound01($g, 255);
        $b = bound01($b, 255);

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $l   = ($max + $min) / 2;

        if ($max == $min) {
            $h = $s = 0; // achromatic
        } else {
            $d = $max - $min;
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
            switch ($max) {
                case $r:
                    $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
                    break;
                case $g:
                    $h = ($b - $r) / $d + 2;
                    break;
                case $b:
                    $h = ($r - $g) / $d + 4;
                    break;
            }

            $h /= 6;
        }

        return ['h' => $h, 's' => $s, 'l' => $l];
    }

    // `hslToRgb`
    // Converts an HSL color value to RGB.
    // *Assumes:* h is contained in [0, 1] or [0, 360] and s and l are contained [0, 1] or [0, 100]
    // *Returns:* { r, g, b } in the set [0, 255]
    protected function hslToRgb($h, $s, $l)
    {

        $h = bound01($h, 360);
        $s = bound01($s, 100);
        $l = bound01($l, 100);

        $hue2rgb = function ($p, $q, $t) {
            if ($t < 0) {
                $t += 1;
            }
            if ($t > 1) {
                $t -= 1;
            }
            if ($t < 1 / 6) {
                return $p + ($q - $p) * 6 * $t;
            }
            if ($t < 1 / 2) {
                return $q;
            }
            if ($t < 2 / 3) {
                return $p + ($q - $p) * (2 / 3 - $t) * 6;
            }
            return $p;
        };

        if ($s == 0) {
            $r = $g = $b = $l; // achromatic
        } else {
            $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
            $p = 2 * $l - $q;
            $r = $hue2rgb($p, $q, $h + 1 / 3);
            $g = $hue2rgb($p, $q, $h);
            $b = $hue2rgb($p, $q, $h - 1 / 3);
        }

        return ['r' => $r * 255, 'g' => $g * 255, 'b' => $b * 255];
    }

    // `rgbToHsv`
    // Converts an RGB color value to HSV
    // *Assumes:* r, g, and b are contained in the set [0, 255] or [0, 1]
    // *Returns:* { h, s, v } in [0,1]
    protected function rgbToHsv($r, $g, $b)
    {

        $r = bound01($r, 255);
        $g = bound01($g, 255);
        $b = bound01($b, 255);

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        // var h, s,

        $v = $max;

        $d = $max - $min;
        $s = $max == 0 ? 0 : $d / $max;

        if ($max == $min) {
            $h = 0; // achromatic
        } else {
            switch ($max) {
                case $r:
                    $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
                    break;
                case $g:
                    $h = ($b - $r) / $d + 2;
                    break;
                case $b:
                    $h = ($r - $g) / $d + 4;
                    break;
            }
            $h /= 6;
        }
        return [
            'h' => $h,
            's' => $s,
            'v' => $v,
        ];
    }

    // `hsvToRgb`
    // Converts an HSV color value to RGB.
    // *Assumes:* h is contained in [0, 1] or [0, 360] and s and v are contained in [0, 1] or [0, 100]
    // *Returns:* { r, g, b } in the set [0, 255]
    protected function hsvToRgb($h, $s, $v)
    {

        $h = bound01($h, 360) * 6;
        $s = bound01($s, 100);
        $v = bound01($v, 100);

        $i   = floor($h);
        $f   = $h - $i;
        $p   = $v * (1 - $s);
        $q   = $v * (1 - $f * $s);
        $t   = $v * (1 - (1 - $f) * $s);
        $mod = fmod($i, 6);
        $r   = [$v, $q, $p, $p, $t, $v][$mod];
        $g   = [$t, $v, $v, $q, $p, $p][$mod];
        $b   = [$p, $p, $t, $v, $v, $q][$mod];

        return [
            'r' => $r * 255,
            'g' => $g * 255,
            'b' => $b * 255,
        ];
    }

    // `rgbToHex`
    // Converts an RGB color to hex
    // Assumes r, g, and b are contained in the set [0, 255]
    // Returns a 3 or 6 character hex
    protected function rgbToHex($r, $g, $b, $allow3Char = false)
    {
        $hex = [
            pad2(dechex(round($r))),
            pad2(dechex(round($g))),
            pad2(dechex(round($b))),
        ];

        // Return a 3 character hex if possible
        if ($allow3Char && $hex[0][0] == $hex[0][1] && $hex[1][0] == $hex[1][1] && $hex[2][0] == $hex[2][1]) {
            return $hex[0][0] . $hex[1][0] . $hex[2][0];
        }

        return implode('', $hex);
    }

    // `rgbaToHex`
    // Converts an RGBA color plus alpha transparency to hex
    // Assumes r, g, b are contained in the set [0, 255] and
    // a in [0, 1]. Returns a 4 or 8 character rgba hex
    protected function rgbaToHex($r, $g, $b, $a, $allow4Char = false)
    {

        $hex = [
            pad2(dechex(round($r))),
            pad2(dechex(round($g))),
            pad2(dechex(round($b))),
            pad2(convertDecimalToHex($a)),
        ];

        // Return a 4 character hex if possible
        if ($allow4Char
            && $hex[0][0] == $hex[0][1]
            && $hex[1][0] == $hex[1][1]
            && $hex[2][0] == $hex[2][1]
            && $hex[3][0] == $hex[3][1]
        ) {
            return $hex[0][0] . $hex[1][0] . $hex[2][0] . $hex[3][0];
        }

        return implode('', $hex);
    }

    // `rgbaToArgbHex`
    // Converts an RGBA color to an ARGB Hex8 string
    // Rarely used, but required for "toFilter()"
    protected function rgbaToArgbHex($r, $g, $b, $a)
    {

        $hex = [
            pad2(convertDecimalToHex($a)),
            pad2(dechex(round($r))),
            pad2(dechex(round($g))),
            pad2(dechex(round($b))),
        ];

        return implode('', $hex);
    }
}
