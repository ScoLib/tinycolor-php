<?php

namespace TinyColor\Traits;

use TinyColor\TinyColor;

trait Modification
{
    // Modification Functions
    // ----------------------
    // Thanks to less.js for some of the basics here
    // <https://github.com/cloudhead/less.js/blob/master/lib/less/functions.js>
    /**
     * @param int $amount
     * @return \TinyColor\Color
     */
    public function desaturate(int $amount = 10)
    {
        $hsl      = $this->toHsl();
        $hsl['s'] -= $amount / 100;
        $hsl['s'] = clamp01($hsl['s']);
        return $this->modify($hsl);
    }

    /**
     * @param int $amount
     * @return \TinyColor\Color
     */
    public function saturate(int $amount = 10)
    {
        $hsl      = $this->toHsl();
        $hsl['s'] += $amount / 100;
        $hsl['s'] = clamp01($hsl['s']);
        return $this->modify($hsl);
    }

    /**
     * @return \TinyColor\Color
     */
    public function greyscale()
    {
        return $this->desaturate(100);
    }

    /**
     * @param int $amount
     * @return \TinyColor\Color
     */
    public function lighten(int $amount = 10)
    {
        $hsl      = $this->toHsl();
        $hsl['l'] += $amount / 100;
        $hsl['l'] = clamp01($hsl['l']);
        return $this->modify($hsl);
    }

    /**
     * @param int $amount
     * @return \TinyColor\Color
     */
    public function brighten(int $amount = 10)
    {
        // js 中 Math.round 对于 小数位等于5的负数，取值是舍去，与php不同
        $rgb      = $this->toRgb();
        $rgb['r'] = max(
            0,
            min(255, $rgb['r'] - round(255 * -($amount / 100)))
        );
        $rgb['g'] = max(
            0,
            min(255, $rgb['g'] - round(255 * -($amount / 100)))
        );
        $rgb['b'] = max(
            0,
            min(255, $rgb['b'] - round(255 * -($amount / 100)))
        );
        return $this->modify($rgb);
    }

    /**
     * @param int $amount
     * @return \TinyColor\Color
     */
    public function darken(int $amount = 10)
    {
        $hsl      = $this->toHsl();
        $hsl['l'] -= $amount / 100;
        $hsl['l'] = clamp01($hsl['l']);
        return $this->modify($hsl);
    }

    // Spin takes a positive or negative amount within [-360, 360] indicating the change of hue.
    // Values outside of this range will be wrapped into this range.
    /**
     * @param int $amount
     * @return \TinyColor\Color
     */
    public function spin(int $amount)
    {
        $hsl      = $this->toHsl();
        $hue      = fmod(($hsl['h'] + $amount), 360);
        $hsl['h'] = $hue < 0 ? 360 + $hue : $hue;
        return $this->modify($hsl);
    }

    /**
     * @param $color
     * @return \TinyColor\Color
     */
    protected function modify($color)
    {
        $color = tinycolor($color);

        $this->r = $color->r;
        $this->g = $color->g;
        $this->b = $color->b;
        $this->setAlpha($color->a);

        return $this;
    }
}
