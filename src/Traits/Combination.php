<?php

namespace TinyColor\Traits;

use TinyColor\TinyColor;

trait Combination
{
    // Combination Functions
    // ---------------------
    // Thanks to jQuery xColor for some of the ideas behind these
    // <https://github.com/infusion/jQuery-xcolor/blob/master/jquery.xcolor.js>
    public function complement()
    {
        $hsl      = $this->toHsl();
        $hsl['h'] = ($hsl['h'] + 180) % 360;
        return TinyColor::parse($hsl);
    }

    public function triad()
    {
        $hsl = $this->toHsl();
        $h   = $hsl['h'];
        return [
            $this,
            TinyColor::parse([
                'h' => ($h + 120) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l'],
            ]),
            TinyColor::parse([
                'h' => ($h + 240) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l'],
            ]),
        ];
    }

    public function tetrad()
    {
        $hsl = $this->toHsl();
        $h   = $hsl['h'];
        return [
            $this,
            TinyColor::parse([
                'h' => ($h + 90) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l'],
            ]),
            TinyColor::parse([
                'h' => ($h + 180) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l'],
            ]),
            TinyColor::parse([
                'h' => ($h + 270) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l'],
            ]),
        ];
    }

    public function splitcomplement()
    {
        $hsl = $this->toHsl();
        $h   = $hsl['h'];
        return [
            $this,
            TinyColor::parse([
                'h' => ($h + 72) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l'],
            ]),
            TinyColor::parse([
                'h' => ($h + 216) % 360,
                's' => $hsl['s'],
                'l' => $hsl['l'],
            ]),
        ];
    }

    public function analogous($results = 6, $slices = 30)
    {
        $hsl  = $this->toHsl();
        $part = 360 / $slices;
        $ret  = [$this];

        for ($hsl['h'] = (($hsl['h'] - ($part * $results >> 1)) + 720) % 360; --$results;) {
            $hsl['h'] = ($hsl['h'] + $part) % 360;
            $ret[]    = TinyColor::parse($hsl);
        }

        return $ret;
    }

    public function monochromatic($results = 6)
    {
        $hsv = $this->toHsl();

        $h   = $hsv['h'];
        $s   = $hsv['s'];
        $v   = $hsv['v'];
        $ret = [];

        $modification = 1 / $results;

        while ($results--) {
            $ret[] = TinyColor::parse(['h' => $h, 's' => $s, 'v' => $v]);
            $v     = ($v + $modification) % 1;
        }

        return $ret;
    }
}
