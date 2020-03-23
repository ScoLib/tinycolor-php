<?php

namespace TinyColor;

use TinyColor\Traits\Combination;
use TinyColor\Traits\Convert;
use TinyColor\Traits\Modification;
use TinyColor\Traits\Names;

class Color
{
    use Convert, Names, Combination, Modification;

    // <http://www.w3.org/TR/css3-values/#integers>
    const CSS_INTEGER = "[-\\+]?\\d+%?";

    // <http://www.w3.org/TR/css3-values/#number-value>
    const CSS_NUMBER = "[-\\+]?\\d*\\.\\d+%?";

    // Allow positive/negative integer/number.  Don't capture the either/or, just the entire outcome.
    const CSS_UNIT = "(?:" . self::CSS_NUMBER . ")|(?:" . self::CSS_INTEGER . ")";

    // Actual matching.
    // Parentheses and commas are optional, but not required.
    // Whitespace can take the place of commas or opening paren
    const PERMISSIVE_MATCH3 = "[\\s|\\(]+(" . self::CSS_UNIT . ")[,|\\s]+("
                            . self::CSS_UNIT . ")[,|\\s]+(" . self::CSS_UNIT . ")\\s*\\)?";
    const PERMISSIVE_MATCH4 = "[\\s|\\(]+(" . self::CSS_UNIT . ")[,|\\s]+("
                            . self::CSS_UNIT . ")[,|\\s]+(" . self:: CSS_UNIT
                            . ")[,|\\s]+(" . self::CSS_UNIT . ")\\s*\\)?";

    private $matchers = [];

    private $originalInput;

    public $r;
    public $g;
    public $b;
    public $a;
    /**
     * @var float|int
     */
    private $roundA;

    /**
     * @var string
     */
    private $format;
    private $gradientType;
    private $ok;

    public function __construct($color, array $opts = [])
    {
        $color = $color ?: '';

        // If input is already a tinycolor, return itself
        // if (color instanceof tinycolor) {
        //     return color;
        // }
        // If we are called as a function, call using new instead
        // if (!(this instanceof tinycolor)) {
        //     return new tinycolor(color, opts);
        // }

        $this->originalInput = $color;

        $this->matchers = [
            'CSS_UNIT' => '/' . self::CSS_UNIT . '/',
            'rgb'      => '/rgb' . self::PERMISSIVE_MATCH3 . '/',
            'rgba'     => '/rgba' . self::PERMISSIVE_MATCH4 . '/',
            'hsl'      => '/hsl' . self::PERMISSIVE_MATCH3 . '/',
            'hsla'     => '/hsla' . self::PERMISSIVE_MATCH4 . '/',
            'hsv'      => '/hsv' . self::PERMISSIVE_MATCH3 . '/',
            'hsva'     => '/hsva' . self::PERMISSIVE_MATCH4 . '/',
            'hex3'     => '/^#?([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})$/',
            'hex6'     => '/^#?([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/',
            'hex4'     => '/^#?([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})$/',
            'hex8'     => '/^#?([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/',
        ];

        /*CSS_UNIT: /(?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?)/
        hex3: /^#?([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})$/
        hex4: /^#?([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})$/
        hex6: /^#?([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/
        hex8: /^#?([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/
        hsl: /hsl[\s|\(]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))\s*\)?/
        hsla: /hsla[\s|\(]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))\s*\)?/
        hsv: /hsv[\s|\(]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))\s*\)?/
        hsva: /hsva[\s|\(]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))\s*\)?/
        rgb: /rgb[\s|\(]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))\s*\)?/
        rgba: /rgba[\s|\(]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))[,|\s]+((?:[-\+]?\d*\.\d+%?)|(?:[-\+]?\d+%?))\s*\)?/*/


        $rgb = $this->inputToRGB($color);

        $this->r = $rgb['r'];
        $this->g = $rgb['g'];
        $this->b = $rgb['b'];
        $this->a = $rgb['a'];

        $this->roundA       = round(100 * $this->a) / 100;
        $this->format       = $opts['format'] ?? $rgb['format'];
        $this->gradientType = $opts['gradientType'] ?? false;

        // Don't let the range of [0,255] come back in [0,1].
        // Potentially lose a little bit of precision here, but will fix issues where
        // .5 gets interpreted as half of the total, instead of half of 1
        // If it was supposed to be 128, this was already taken care of by `inputToRgb`
        if ($this->r < 1) {
            $this->r = round($this->r);
        }
        if ($this->g < 1) {
            $this->g = round($this->g);
        }
        if ($this->b < 1) {
            $this->b = round($this->b);
        }

        $this->ok = $rgb['ok'];
    }

    // Given a string or object, convert that input to RGB
    // Possible string inputs:
    //
    //     "red"
    //     "#f00" or "f00"
    //     "#ff0000" or "ff0000"
    //     "#ff000000" or "ff000000"
    //     "rgb 255 0 0" or "rgb (255, 0, 0)"
    //     "rgb 1.0 0 0" or "rgb (1, 0, 0)"
    //     "rgba (255, 0, 0, 1)" or "rgba 255, 0, 0, 1"
    //     "rgba (1.0, 0, 0, 1)" or "rgba 1.0, 0, 0, 1"
    //     "hsl(0, 100%, 50%)" or "hsl 0 100% 50%"
    //     "hsla(0, 100%, 50%, 1)" or "hsla 0 100% 50%, 1"
    //     "hsv(0, 100%, 100%)" or "hsv 0 100% 100%"
    //
    private function inputToRGB($color)
    {

        $rgb    = [
            'r' => 0,
            'g' => 0,
            'b' => 0,
        ];
        $a      = 1;
        $ok     = false;
        $format = false;

        if (is_string($color)) {
            $color = $this->stringInputToObject($color);
        }

        if (is_array($color)) {
            if ($this->isValidCSSUnit($color['r'] ?? null)
                && $this->isValidCSSUnit($color['g'] ?? null)
                && $this->isValidCSSUnit($color['b'] ?? null)
            ) {
                $rgb    = $this->rgbToRgb($color['r'], $color['g'], $color['b']);
                $ok     = true;
                $format = substr($color['r'], -1) === "%" ? "prgb" : "rgb";
            } elseif ($this->isValidCSSUnit($color['h'] ?? null)
                && $this->isValidCSSUnit($color['s'] ?? null)
                && $this->isValidCSSUnit($color['v'] ?? null)
            ) {
                $s      = convertToPercentage($color['s']);
                $v      = convertToPercentage($color['v']);
                $rgb    = $this->hsvToRgb($color['h'], $s, $v);
                $ok     = true;
                $format = "hsv";
            } elseif ($this->isValidCSSUnit($color['h'] ?? null)
                && $this->isValidCSSUnit($color['s'] ?? null)
                && $this->isValidCSSUnit($color['l'] ?? null)
            ) {
                $s      = convertToPercentage($color['s']);
                $l      = convertToPercentage($color['l']);
                $rgb    = $this->hslToRgb($color['h'], $s, $l);
                $ok     = true;
                $format = "hsl";
            }

            if (isset($color['a'])) {
                $a = $color['a'];
            }
        }

        $a = boundAlpha($a);

        return [
            'ok'     => $ok,
            'format' => $color['format'] ?? $format,
            'r'      => min(255, max($rgb['r'], 0)),
            'g'      => min(255, max($rgb['g'], 0)),
            'b'      => min(255, max($rgb['b'], 0)),
            'a'      => $a,
        ];
    }

    public function isDark()
    {
        return $this->getBrightness() < 128;
    }

    public function isLight()
    {
        return !$this->isDark();
    }

    public function isValid()
    {
        return $this->ok;
    }

    public function getOriginalInput()
    {
        return $this->originalInput;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function getAlpha()
    {
        return $this->a;
    }

    public function getBrightness()
    {
        //http://www.w3.org/TR/AERT#color-contrast
        $rgb = $this->toRgb();
        return ($rgb['r'] * 299 + $rgb['g'] * 587 + $rgb['b'] * 114) / 1000;
    }

    public function getLuminance()
    {
        //http://www.w3.org/TR/2008/REC-WCAG20-20081211/#relativeluminancedef
        $rgb   = $this->toRgb();
        $RsRGB = $rgb['r'] / 255;
        $GsRGB = $rgb['g'] / 255;
        $BsRGB = $rgb['b'] / 255;

        if ($RsRGB <= 0.03928) {
            $R = $RsRGB / 12.92;
        } else {
            $R = pow((($RsRGB + 0.055) / 1.055), 2.4);
        }
        if ($GsRGB <= 0.03928) {
            $G = $GsRGB / 12.92;
        } else {
            $G = pow((($GsRGB + 0.055) / 1.055), 2.4);
        }
        if ($BsRGB <= 0.03928) {
            $B = $BsRGB / 12.92;
        } else {
            $B = pow((($BsRGB + 0.055) / 1.055), 2.4);
        }
        return (0.2126 * $R) + (0.7152 * $G) + (0.0722 * $B);
    }

    public function setAlpha($value)
    {
        $this->a      = boundAlpha($value);
        $this->roundA = round(100 * $this->a) / 100;
        return $this;
    }

    public function toHsv()
    {
        $hsv = $this->rgbToHsv($this->r, $this->g, $this->b);
        return [
            'h' => $hsv['h'] * 360,
            's' => $hsv['s'],
            'v' => $hsv['v'],
            'a' => $this->a,
        ];
    }

    public function toHsvString()
    {
        $hsv = $this->rgbToHsv($this->r, $this->g, $this->b);
        $h   = round($hsv['h'] * 360);
        $s   = round($hsv['s'] * 100);
        $v   = round($hsv['v'] * 100);
        return ($this->a == 1) ?
            "hsv({$h}, {$s}%, {$v}%)" :
            "hsva({$h}, {$s}%, {$v}%, {$this->roundA})";
    }

    public function toHsl()
    {
        $hsl = $this->rgbToHsl($this->r, $this->g, $this->b);
        return [
            'h' => $hsl['h'] * 360,
            's' => $hsl['s'],
            'l' => $hsl['l'],
            'a' => $this->a,
        ];
    }

    public function toHslString()
    {
        $hsl = $this->rgbToHsl($this->r, $this->g, $this->b);
        $h   = round($hsl['h'] * 360);
        $s   = round($hsl['s'] * 100);
        $l   = round($hsl['l'] * 100);
        return ($this->a == 1) ?
            "hsl({$h}, {$s}%, {$l}%)" :
            "hsla({$h}, {$s}%, {$l}%, {$this->roundA})";
    }

    public function toHex($allow3Char = false)
    {
        return $this->rgbToHex($this->r, $this->g, $this->b, $allow3Char);
    }

    public function toHexString($allow3Char = false)
    {
        return '#' . $this->toHex($allow3Char);
    }

    public function toHex8($allow4Char = false)
    {
        return $this->rgbaToHex($this->r, $this->g, $this->b, $this->a, $allow4Char);
    }

    public function toHex8String($allow4Char = false)
    {
        return '#' . $this->toHex8($allow4Char);
    }

    public function toRgb()
    {
        return [
            'r' => round($this->r),
            'g' => round($this->g),
            'b' => round($this->b),
            'a' => $this->a,
        ];
    }

    public function toRgbString()
    {
        $r = round($this->r);
        $g = round($this->g);
        $b = round($this->b);
        return ($this->a == 1) ?
            "rgb({$r}, {$g}, {$b})" :
            "rgba({$r}, {$g}, {$b}, {$this->roundA})";
    }

    public function toPercentageRgb()
    {
        return [
            'r' => round(bound01($this->r, 255) * 100) . "%",
            'g' => round(bound01($this->g, 255) * 100) . "%",
            'b' => round(bound01($this->b, 255) * 100) . "%",
            'a' => $this->a,
        ];
    }

    public function toPercentageRgbString()
    {
        $r = round(bound01($this->r, 255) * 100);
        $g = round(bound01($this->g, 255) * 100);
        $b = round(bound01($this->b, 255) * 100);
        return ($this->a == 1) ?
            "rgb({$r}%, {$g}%, {$b}%)" :
            "rgba({$r}%, {$g}%, {$b}%, {$this->roundA})";
    }

    public function toName()
    {
        if ($this->a == 0) {
            return "transparent";
        }

        if ($this->a < 1) {
            return false;
        }
        $hex = $this->rgbToHex($this->r, $this->g, $this->b, true);
        return $this->getByHex($hex) ?: false;
    }

    public function toFilter($secondColor = null)
    {
        $hex8String       = '#' . $this->rgbaToArgbHex($this->r, $this->g, $this->b, $this->a);
        $secondHex8String = $hex8String;
        $gradientType     = $this->gradientType ? "GradientType = 1, " : "";

        if ($secondColor) {
            $s                = new static($secondColor);
            $secondHex8String = '#' . $this->rgbaToArgbHex($s->r, $s->g, $s->b, $s->a);
        }

        return "progid:DXImageTransform.Microsoft.gradient("
            . "{$gradientType}startColorstr={$hex8String},endColorstr={$secondHex8String})";
    }

    public function toString($format = null)
    {
        $formatSet = $format ? true : false;
        $format    = $format ?: $this->format;

        $formattedString  = false;
        $hasAlpha         = $this->a < 1 && $this->a >= 0;
        $needsAlphaFormat = !$formatSet && $hasAlpha
                            && in_array($format, ['hex', 'hex6', 'hex3', 'hex4', 'hex8', 'name']);

        if ($needsAlphaFormat) {
            // Special case for "transparent", all other non-alpha formats
            // will return rgba when there is transparency.
            if ($format === "name" && $this->a == 0) {
                return $this->toName();
            }
            return $this->toRgbString();
        }
        if ($format === "rgb") {
            $formattedString = $this->toRgbString();
        }
        if ($format === "prgb") {
            $formattedString = $this->toPercentageRgbString();
        }
        if ($format === "hex" || $format === "hex6") {
            $formattedString = $this->toHexString();
        }
        if ($format === "hex3") {
            $formattedString = $this->toHexString(true);
        }
        if ($format === "hex4") {
            $formattedString = $this->toHex8String(true);
        }
        if ($format === "hex8") {
            $formattedString = $this->toHex8String();
        }
        if ($format === "name") {
            $formattedString = $this->toName();
        }
        if ($format === "hsl") {
            $formattedString = $this->toHslString();
        }
        if ($format === "hsv") {
            $formattedString = $this->toHsvString();
        }

        return $formattedString ?: $this->toHexString();
    }

    public function clone()
    {
        return new static($this->toString());
    }

    // `isValidCSSUnit`
    // Take in a single string / number and check to see if it looks like a CSS unit
    // (see `matchers` above for definition).
    private function isValidCSSUnit($color)
    {
        return (bool)preg_match($this->matchers['CSS_UNIT'], $color);
        // return !!matchers . CSS_UNIT . exec(color);
    }

    // `stringInputToObject`
    // Permissive string parsing.  Take in a number of formats, and output an object
    // based on detected format.  Returns `{ r, g, b }` or `{ h, s, l }` or `{ h, s, v}`
    protected function stringInputToObject(string $color)
    {
        $color = strtolower(trim($color));
        $named = false;
        if ($t = $this->getByName($color)) {
            $color = $t;
            $named = true;
        } elseif ($color == 'transparent') {
            return [
                'r'      => 0,
                'g'      => 0,
                'b'      => 0,
                'a'      => 0,
                'format' => 'name',
            ];
        }


        // Try to match string input using regular expressions.
        // Keep most of the number bounding out of this function - don't worry about [0,1] or [0,100] or [0,360]
        // Just return an object and let the conversion functions handle that.
        // This way the result will be the same whether the tinycolor is initialized with string or object.

        if (preg_match($this->matchers['rgb'], $color, $match)) {
            return [
                'r' => $match[1],
                'g' => $match[2],
                'b' => $match[3],
            ];
        }

        if (preg_match($this->matchers['rgba'], $color, $match)) {
            return [
                'r' => $match[1],
                'g' => $match[2],
                'b' => $match[3],
                'a' => $match[4],
            ];
        }

        if (preg_match($this->matchers['hsl'], $color, $match)) {
            return [
                'h' => $match[1],
                's' => $match[2],
                'l' => $match[3],
            ];
        }

        if (preg_match($this->matchers['hsla'], $color, $match)) {
            return [
                'h' => $match[1],
                's' => $match[2],
                'l' => $match[3],
                'a' => $match[4],
            ];
        }

        if (preg_match($this->matchers['hsv'], $color, $match)) {
            return [
                'h' => $match[1],
                's' => $match[2],
                'v' => $match[3],
            ];
        }

        if (preg_match($this->matchers['hsva'], $color, $match)) {
            return [
                'h' => $match[1],
                's' => $match[2],
                'v' => $match[3],
                'a' => $match[4],
            ];
        }

        if (preg_match($this->matchers['hex8'], $color, $match)) {
            return [
                'r'      => parseIntFromHex($match[1]),
                'g'      => parseIntFromHex($match[2]),
                'b'      => parseIntFromHex($match[3]),
                'a'      => convertHexToDecimal($match[4]),
                'format' => $named ? "name" : "hex8",
            ];
        }

        if (preg_match($this->matchers['hex6'], $color, $match)) {
            return [
                'r'      => parseIntFromHex($match[1]),
                'g'      => parseIntFromHex($match[2]),
                'b'      => parseIntFromHex($match[3]),
                'format' => $named ? "name" : "hex",
            ];
        }

        if (preg_match($this->matchers['hex4'], $color, $match)) {
            return [
                'r'      => parseIntFromHex($match[1] . '' . $match[1]),
                'g'      => parseIntFromHex($match[2] . '' . $match[2]),
                'b'      => parseIntFromHex($match[3] . '' . $match[3]),
                'a'      => convertHexToDecimal($match[4] . '' . $match[4]),
                'format' => $named ? "name" : "hex8",
            ];
        }

        if (preg_match($this->matchers['hex3'], $color, $match)) {
            return [
                'r'      => parseIntFromHex($match[1] . '' . $match[1]),
                'g'      => parseIntFromHex($match[2] . '' . $match[2]),
                'b'      => parseIntFromHex($match[3] . '' . $match[3]),
                'format' => $named ? "name" : "hex",
            ];
        }

        return false;
    }
}
