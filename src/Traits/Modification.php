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
     * @param $color
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
     * @param $color
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
     * @param $color
     * @return mixed
     */
    public function greyscale()
    {
        return $this->desaturate(100);
    }

    public function lighten(int $amount = 10)
    {
        $hsl      = $this->toHsl();
        $hsl['l'] += $amount / 100;
        $hsl['l'] = clamp01($hsl['l']);
        return $this->modify($hsl);
    }

    public function brighten(int $amount = 10)
    {
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

    public function darken(int $amount = 10)
    {
        $hsl      = $this->toHsl();
        $hsl['l'] -= $amount / 100;
        $hsl['l'] = clamp01($hsl['l']);
        return $this->modify($hsl);
    }

    // Spin takes a positive or negative amount within [-360, 360] indicating the change of hue.
    // Values outside of this range will be wrapped into this range.
    public function spin(int $amount)
    {
        $hsl      = $this->toHsl();
        $hue      = ($hsl['h'] + $amount) % 360;
        $hsl['h'] = $hue < 0 ? 360 + $hue : $hue;
        return $this->modify($hsl);
    }

    protected function modify($color)
    {
        $color = new static($color);

        $this->r = $color->r;
        $this->g = $color->g;
        $this->b = $color->b;
        $this->setAlpha($color->a);

        return $this;
    }
}