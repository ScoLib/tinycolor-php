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
        $hsl['h'] = fmod(($hsl['h'] + 180), 360);
        return tinycolor($hsl);
    }

    public function triad()
    {
        $hsl = $this->toHsl();
        $h   = $hsl['h'];
        return [
            $this,
            tinycolor([
                'h' => fmod(($h + 120), 360),
                's' => $hsl['s'],
                'l' => $hsl['l'],
            ]),
            tinycolor([
                'h' => fmod(($h + 240), 360),
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
            tinycolor([
                'h' => fmod(($h + 90), 360),
                's' => $hsl['s'],
                'l' => $hsl['l'],
            ]),
            tinycolor([
                'h' => fmod(($h + 180), 360),
                's' => $hsl['s'],
                'l' => $hsl['l'],
            ]),
            tinycolor([
                'h' => fmod(($h + 270), 360),
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
            tinycolor([
                'h' => fmod(($h + 72), 360),
                's' => $hsl['s'],
                'l' => $hsl['l'],
            ]),
            tinycolor([
                'h' => fmod(($h + 216), 360),
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

        for ($hsl['h'] = fmod((($hsl['h'] - ($part * $results >> 1)) + 720), 360); --$results;) {
            $hsl['h'] = fmod(($hsl['h'] + $part), 360);
            $ret[]    = tinycolor($hsl);
        }

        return $ret;
    }

    public function monochromatic($results = 6)
    {
        $hsv = $this->toHsv();

        $h   = $hsv['h'];
        $s   = $hsv['s'];
        $v   = $hsv['v'];
        $ret = [];

        $modification = 1 / $results;

        while ($results--) {
            $ret[] = tinycolor(['h' => $h, 's' => $s, 'v' => $v]);
            $v     = fmod(($v + $modification), 1);
        }

        return $ret;
    }
}
