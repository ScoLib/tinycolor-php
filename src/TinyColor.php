<?php

namespace TinyColor;

class TinyColor
{

    // If input is an object, force 1 into "1.0" to handle ratios properly
    // String input requires "1.0" as input, so 1 will be treated as 1
    public static function fromRatio($color, array $opts = [])
    {
        if (is_array($color)) {
            $newColor = [];
            foreach ($color as $i => $v) {
                $newColor[$i] = $i == 'a' ? $v : convertToPercentage($v);
            }

            $color = $newColor;
        }

        return self::parse($color, $opts);
    }

    // `equals`
    // Can be called with any tinycolor input
    public static function equals($color1, $color2)
    {
        if (!$color1 || !$color2) {
            return false;
        }
        return self::parse($color1)->toRgbString() == self::parse($color2)->toRgbString();
    }

    public static function random()
    {
        return self::fromRatio([
            'r' => mt_rand() / mt_getrandmax(),
            'g' => mt_rand() / mt_getrandmax(),
            'b' => mt_rand() / mt_getrandmax(),
        ]);
    }

    public static function mix($color1, $color2, $amount = 50)
    {
        // $amount = ($amount === 0) ? 0 : ($amount ?: 50);

        $rgb1 = self::parse($color1)->toRgb();
        $rgb2 = self::parse($color2)->toRgb();

        $p = $amount / 100;

        $rgba = [
            'r' => (($rgb2['r'] - $rgb1['r']) * $p) + $rgb1['r'],
            'g' => (($rgb2['g'] - $rgb1['g']) * $p) + $rgb1['g'],
            'b' => (($rgb2['b'] - $rgb1['b']) * $p) + $rgb1['b'],
            'a' => (($rgb2['a'] - $rgb1['a']) * $p) + $rgb1['a'],
        ];

        return self::parse($rgba);
    }

    // Readability Functions
    // ---------------------
    // <http://www.w3.org/TR/2008/REC-WCAG20-20081211/#contrast-ratiodef (WCAG Version 2)

    // `contrast`
    // Analyze the 2 colors and returns the color contrast defined by (WCAG Version 2)
    public static function readability($color1, $color2)
    {
        $c1 = self::parse($color1);
        $c2 = self::parse($color2);
        return (max($c1->getLuminance(), $c2->getLuminance()) + 0.05)
            / (min($c1->getLuminance(), $c2->getLuminance()) + 0.05);
    }

    // `isReadable`
    // Ensure that foreground and background color combinations meet WCAG2 guidelines.
    // The third argument is an optional Object.
    //      the 'level' property states 'AA' or 'AAA' - if missing or invalid, it defaults to 'AA';
    //      the 'size' property states 'large' or 'small' - if missing or invalid, it defaults to 'small'.
    // If the entire object is absent, isReadable defaults to {level:"AA",size:"small"}.

    // *Example*
    //    tinycolor.isReadable("#000", "#111") => false
    //    tinycolor.isReadable("#000", "#111",{level:"AA",size:"large"}) => false
    public static function isReadable($color1, $color2, $wcag2 = [])
    {
        $readability = self::readability($color1, $color2);

        $out = false;

        $wcag2Parms = validateWCAG2Parms($wcag2);
        switch ($wcag2Parms['level'] . $wcag2Parms['size']) {
            case "AAsmall":
            case "AAAlarge":
                $out = $readability >= 4.5;
                break;
            case "AAlarge":
                $out = $readability >= 3;
                break;
            case "AAAsmall":
                $out = $readability >= 7;
                break;
        }
        return $out;
    }

    // `mostReadable`
    // Given a base color and a list of possible foreground or background
    // colors for that base, returns the most readable color.
    // Optionally returns Black or White if the most readable color is unreadable.
    public static function mostReadable($baseColor, $colorList, $args = [])
    {
        $bestColor = null;
        $bestScore = 0;

        $includeFallbackColors = $args['includeFallbackColors'] ?? false;
        $level                 = $args['level'] ?? '';
        $size                  = $args['size'] ?? '';

        foreach ($colorList as $item) {
            $readability = self::readability($baseColor, $item);
            if ($readability > $bestScore) {
                $bestScore = $readability;
                $bestColor = self::parse($item);
            }
        }


        if (self::isReadable($baseColor, $bestColor, ["level" => $level, "size" => $size])
            || !$includeFallbackColors
        ) {
            return $bestColor;
        } else {
            $args['includeFallbackColors'] = false;
            return self::mostReadable($baseColor, ["#fff", "#000"], $args);
        }
    }

    /**
     * @param $color
     * @param array $opts
     * @return \TinyColor\Color
     */
    public static function parse($color, array $opts = [])
    {
        if ($color instanceof Color) {
            return $color;
        }

        return new Color($color, $opts);
    }
}
