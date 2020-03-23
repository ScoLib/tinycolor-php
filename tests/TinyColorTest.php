<?php

declare(strict_types=1);

namespace Tests;

use TinyColor\Color;
use TinyColor\TinyColor;

class TinyColorTest extends \PHPUnit\Framework\TestCase
{

    public function conversions()
    {
        // Taken from convertWikipediaColors.html
        return [
            [
                'hex' => '#FFFFFF', 'hex8' => '#FFFFFFFF',
                'rgb' => ['r' => '100.0%', 'g' => '100.0%', 'b' => '100.0%'],
                'hsv' => ['h' => '0', 's' => '0.000', 'v' => '1.000'],
                'hsl' => ['h' => '0', 's' => '0.000', 'l' => '1.000'],
            ],
            [
                'hex' => '#808080', 'hex8' => '#808080FF',
                'rgb' => ['r' => '050.0%', 'g' => '050.0%', 'b' => '050.0%'],
                'hsv' => ['h' => '0', 's' => '0.000', 'v' => '0.500'],
                'hsl' => ['h' => '0', 's' => '0.000', 'l' => '0.500'],
            ],
            [
                'hex' => '#000000', 'hex8' => '#000000FF',
                'rgb' => ['r' => '000.0%', 'g' => '000.0%', 'b' => '000.0%'],
                'hsv' => ['h' => '0', 's' => '0.000', 'v' => '0.000'],
                'hsl' => ['h' => '0', 's' => '0.000', 'l' => '0.000'],
            ],
            [
                'hex' => '#FF0000', 'hex8' => '#FF0000FF',
                'rgb' => ['r' => '100.0%', 'g' => '000.0%', 'b' => '000.0%'],
                'hsv' => ['h' => '0.0', 's' => '1.000', 'v' => '1.000'],
                'hsl' => ['h' => '0.0', 's' => '1.000', 'l' => '0.500'],
            ],
            [
                'hex' => '#BFBF00', 'hex8' => '#BFBF00FF',
                'rgb' => ['r' => '075.0%', 'g' => '075.0%', 'b' => '000.0%'],
                'hsv' => ['h' => '60.0', 's' => '1.000', 'v' => '0.750'],
                'hsl' => ['h' => '60.0', 's' => '1.000', 'l' => '0.375'],
            ],
            [
                'hex' => '#008000', 'hex8' => '#008000FF',
                'rgb' => ['r' => '000.0%', 'g' => '050.0%', 'b' => '000.0%'],
                'hsv' => ['h' => '120.0', 's' => '1.000', 'v' => '0.500'],
                'hsl' => ['h' => '120.0', 's' => '1.000', 'l' => '0.250'],
            ],
            [
                'hex' => '#80FFFF', 'hex8' => '#80FFFFFF',
                'rgb' => ['r' => '050.0%', 'g' => '100.0%', 'b' => '100.0%'],
                'hsv' => ['h' => '180.0', 's' => '0.500', 'v' => '1.000'],
                'hsl' => ['h' => '180.0', 's' => '1.000', 'l' => '0.750'],
            ],
            [
                'hex' => '#8080FF', 'hex8' => '#8080FFFF',
                'rgb' => ['r' => '050.0%', 'g' => '050.0%', 'b' => '100.0%'],
                'hsv' => ['h' => '240.0', 's' => '0.500', 'v' => '1.000'],
                'hsl' => ['h' => '240.0', 's' => '1.000', 'l' => '0.750'],
            ],
            [
                'hex' => '#BF40BF', 'hex8' => '#BF40BFFF',
                'rgb' => ['r' => '075.0%', 'g' => '025.0%', 'b' => '075.0%'],
                'hsv' => ['h' => '300.0', 's' => '0.667', 'v' => '0.750'],
                'hsl' => ['h' => '300.0', 's' => '0.500', 'l' => '0.500'],
            ],
            [
                'hex' => '#A0A424', 'hex8' => '#A0A424FF',
                'rgb' => ['r' => '062.8%', 'g' => '064.3%', 'b' => '014.2%'],
                'hsv' => ['h' => '61.8', 's' => '0.779', 'v' => '0.643'],
                'hsl' => ['h' => '61.8', 's' => '0.638', 'l' => '0.393'],
            ],
            [
                'hex' => '#1EAC41', 'hex8' => '#1EAC41FF',
                'rgb' => ['r' => '011.6%', 'g' => '067.5%', 'b' => '025.5%'],
                'hsv' => ['h' => '134.9', 's' => '0.828', 'v' => '0.675'],
                'hsl' => ['h' => '134.9', 's' => '0.707', 'l' => '0.396'],
            ],
            [
                'hex' => '#B430E5', 'hex8' => '#B430E5FF',
                'rgb' => ['r' => '070.4%', 'g' => '018.7%', 'b' => '089.7%'],
                'hsv' => ['h' => '283.7', 's' => '0.792', 'v' => '0.897'],
                'hsl' => ['h' => '283.7', 's' => '0.775', 'l' => '0.542'],
            ],
            [
                'hex' => '#FEF888', 'hex8' => '#FEF888FF',
                'rgb' => ['r' => '099.8%', 'g' => '097.4%', 'b' => '053.2%'],
                'hsv' => ['h' => '56.9', 's' => '0.467', 'v' => '0.998'],
                'hsl' => ['h' => '56.9', 's' => '0.991', 'l' => '0.765'],
            ],
            [
                'hex' => '#19CB97', 'hex8' => '#19CB97FF',
                'rgb' => ['r' => '009.9%', 'g' => '079.5%', 'b' => '059.1%'],
                'hsv' => ['h' => '162.4', 's' => '0.875', 'v' => '0.795'],
                'hsl' => ['h' => '162.4', 's' => '0.779', 'l' => '0.447'],
            ],
            [
                'hex' => '#362698', 'hex8' => '#362698FF',
                'rgb' => ['r' => '021.1%', 'g' => '014.9%', 'b' => '059.7%'],
                'hsv' => ['h' => '248.3', 's' => '0.750', 'v' => '0.597'],
                'hsl' => ['h' => '248.3', 's' => '0.601', 'l' => '0.373'],
            ],
            [
                'hex' => '#7E7EB8', 'hex8' => '#7E7EB8FF',
                'rgb' => ['r' => '049.5%', 'g' => '049.3%', 'b' => '072.1%'],
                'hsv' => ['h' => '240.5', 's' => '0.316', 'v' => '0.721'],
                'hsl' => ['h' => '240.5', 's' => '0.290', 'l' => '0.607'],
            ],
        ];
    }

    public function testTinyColorInitialization()
    {
        $tinyColor = tinycolor('red');
        $this->assertIsObject($tinyColor);
        $this->assertInstanceOf(Color::class, tinycolor('red'));
        $this->assertEquals($tinyColor, tinycolor('red'));

        $this->assertEquals('#ff0000', tinycolor('red', ['format' => 'hex'])->toString());

        $this->assertEquals(
            '#ff0000',
            TinyColor::fromRatio([
                'r' => 1,
                'g' => 0,
                'b' => 0,
            ], ['format' => 'hex'])->toString()
        );
    }

    public function testOriginalInput()
    {

        $colorRgbUp  = 'RGB(39, 39, 39)';
        $colorRgbLow = 'rgb(39, 39, 39)';
        $colorRgbMix = 'RgB(39, 39, 39)';

        $tinycolorObj = tinycolor($colorRgbMix);
        $inputObj     = ['r' => 100, 'g' => 100, 'b' => 100];

        $this->assertEquals($colorRgbLow, tinycolor($colorRgbLow)->getOriginalInput());
        $this->assertEquals($colorRgbUp, tinycolor($colorRgbUp)->getOriginalInput());
        $this->assertEquals($colorRgbMix, tinycolor($colorRgbMix)->getOriginalInput());
        $this->assertEquals($colorRgbMix, tinycolor($tinycolorObj)->getOriginalInput());
        $this->assertEquals($inputObj, tinycolor($inputObj)->getOriginalInput());
        $this->assertSame('', tinycolor('')->getOriginalInput());
        $this->assertSame('', tinycolor(null)->getOriginalInput());
    }

    public function testCloneColor()
    {
        $originalColor          = tinycolor('red');
        $originalColorRgbString = $originalColor->toRgbString();

        $clonedColor = $originalColor->clone();

        $this->assertEquals($clonedColor->toRgbString(), $originalColor->toRgbString());

        $clonedColor->setAlpha(0.5);
        $this->assertNotEquals($clonedColor->toRgbString(), $originalColor->toRgbString());
        $this->assertEquals($originalColorRgbString, $originalColor->toRgbString());
    }

    /**
     * @dataProvider conversions
     */
    public function testColorTranslations($hex, $hex8, $rgb, $hsv, $hsl)
    {
        $tiny = tinycolor($hex);
        $this->assertTrue($tiny->isValid());

        $this->assertTrue(TinyColor::equals($rgb, $hex));
        $this->assertTrue(TinyColor::equals($rgb, $hex8));
        $this->assertTrue(TinyColor::equals($rgb, $hsl));
        $this->assertTrue(TinyColor::equals($rgb, $hsv));
        $this->assertTrue(TinyColor::equals($rgb, $rgb));


        $this->assertTrue(TinyColor::equals($hex, $hex));
        $this->assertTrue(TinyColor::equals($hex, $hex8));
        $this->assertTrue(TinyColor::equals($hex, $hsl));
        $this->assertTrue(TinyColor::equals($hex, $hsv));

        $this->assertTrue(TinyColor::equals($hsl, $hsv));

    }

    public function testWithRatio()
    {
        $this->assertEquals('#ffffff', TinyColor::fromRatio(['r' => 1, 'g' => 1, 'b' => 1])->toHexString());

        $this->assertEquals('rgba(255, 0, 0, 0.5)',
            TinyColor::fromRatio(['r' => 1, 'g' => 0, 'b' => 0, 'a' => .5])->toRgbString());

        $this->assertEquals('rgb(255, 0, 0)',
            TinyColor::fromRatio(['r' => 1, 'g' => 0, 'b' => 0, 'a' => 1])->toRgbString());

        $this->assertEquals('rgb(255, 0, 0)',
            TinyColor::fromRatio(['r' => 1, 'g' => 0, 'b' => 0, 'a' => 10])->toRgbString());
        $this->assertEquals('rgb(255, 0, 0)',
            TinyColor::fromRatio(['r' => 1, 'g' => 0, 'b' => 0, 'a' => -1])->toRgbString());
    }

    public function testWithoutRatio()
    {
        $this->assertEquals('#010101', tinycolor(['r' => 1, 'g' => 1, 'b' => 1])->toHexString());
        $this->assertEquals('#000000', tinycolor(['r' => .1, 'g' => .1, 'b' => .1])->toHexString());
        $this->assertEquals('#000000', tinycolor('rgb .1 .1 .1')->toHexString());
    }

    public function testRGBTextParsing()
    {
        $this->assertEquals('#ff0000', tinycolor('rgb 255 0 0')->toHexString());
        $this->assertEquals('#ff0000', tinycolor('rgb(255, 0, 0)')->toHexString());
        $this->assertEquals('#ff0000', tinycolor('rgb (255, 0, 0)')->toHexString());
        $this->assertEquals('#ff0000', tinycolor(['r' => 255, 'g' => 0, 'b' => 0])->toHexString());

        $this->assertEqualsCanonicalizing(
            tinycolor(['r' => 255, 'g' => 0, 'b' => 0])->toRgb(),
            ['r' => 255, 'g' => 0, 'b' => 0, 'a' => 1]
        );

        $this->assertTrue(TinyColor::equals(['r' => 200, 'g' => 100, 'b' => 0], 'rgb(200, 100, 0)'));
        $this->assertTrue(TinyColor::equals(['r' => 200, 'g' => 100, 'b' => 0], 'rgb 200 100 0'));
        $this->assertTrue(TinyColor::equals(['r' => 200, 'g' => 100, 'b' => 0, 'a' => .4], 'rgba 200 100 0 .4'));

        $this->assertFalse(TinyColor::equals(['r' => 199, 'g' => 100, 'b' => 0], 'rgba 200 100 0 1'));
        $this->assertFalse(TinyColor::equals(['r' => 199, 'g' => 100, 'b' => 0], 'rgb(200, 100, 0)'));
        $this->assertFalse(TinyColor::equals(['r' => 199, 'g' => 100, 'b' => 0], 'rgb 200 100 0'));


        $this->assertTrue(TinyColor::equals(
            tinycolor(['r' => 200, 'g' => 100, 'b' => 0]),
            'rgb(200, 100, 0)'
        ));
        $this->assertTrue(TinyColor::equals(
            tinycolor(['r' => 200, 'g' => 100, 'b' => 0]),
            'rgb 200 100 0'
        ));
    }

    public function testPercentageRGBTextParsing()
    {
        $this->assertEquals('#ff0000', tinycolor('rgb 100% 0% 0%')->toHexString());
        $this->assertEquals('#ff0000', tinycolor('rgb(100%, 0%, 0%)')->toHexString());
        $this->assertEquals('#ff0000', tinycolor('rgb (100%, 0%, 0%)')->toHexString());
        $this->assertEquals('#ff0000', tinycolor(['r' => '100%', 'g' => '0%', 'b' => '0%'])->toHexString());
        $this->assertEqualsCanonicalizing(
            tinycolor(['r' => '100%', 'g' => '0%', 'b' => '0%'])->toRgb(),
            ['r' => 255, 'g' => 0, 'b' => 0, 'a' => 1]
        );

        $this->assertTrue(TinyColor::equals(['r' => '90%', 'g' => '45%', 'b' => '0%'], 'rgb(90%, 45%, 0%)'));
        $this->assertTrue(TinyColor::equals(['r' => '90%', 'g' => '45%', 'b' => '0%'], 'rgb 90% 45% 0%'));
        $this->assertTrue(TinyColor::equals(['r' => '90%', 'g' => '45%', 'b' => '0%', 'a' => .4],
            'rgba 90% 45% 0% .4'));
        $this->assertFalse(TinyColor::equals(['r' => '89%', 'g' => '45%', 'b' => '0%'], 'rgba 90% 45% 0% 1'));
        $this->assertFalse(TinyColor::equals(['r' => '89%', 'g' => '45%', 'b' => '0%'], 'rgb(90%, 45%, 0%)'));
        $this->assertFalse(TinyColor::equals(['r' => '89%', 'g' => '45%', 'b' => '0%'], 'rgb 90% 45% 0%'));

        $this->assertTrue(TinyColor::equals(
            tinycolor(['r' => '90%', 'g' => '45%', 'b' => '0%']),
            'rgb(90%, 45%, 0%)'
        ));
        $this->assertTrue(TinyColor::equals(
            tinycolor(['r' => '90%', 'g' => '45%', 'b' => '0%']),
            'rgb 90% 45% 0%'
        ));
    }

    public function testHSLParsing()
    {
        $this->assertEquals('#2400c2', tinycolor(['h' => 251, 's' => 100, 'l' => .38])->toHexString());
        $this->assertEquals('rgb(36, 0, 194)', tinycolor(['h' => 251, 's' => 100, 'l' => .38])->toRgbString());
        $this->assertEquals('hsl(251, 100%, 38%)',
            tinycolor(['h' => 251, 's' => 100, 'l' => .38])->toHslString());
        $this->assertEquals('#2400c2', tinycolor('hsl(251, 100, 38)')->toHexString());
        $this->assertEquals('rgb(36, 0, 194)', tinycolor('hsl(251, 100%, 38%)')->toRgbString());
        $this->assertEquals('hsla(0, 100%, 50%, 0.5)', tinycolor('hsla(0, 100%, 50%, .5)')->toHslString());
        $this->assertEquals('hsl(100, 20%, 10%)', tinycolor('hsl 100 20 10')->toHslString());
    }

    public function testHexParsing()
    {
        $this->assertEquals('#ff0000', tinycolor('rgb 255 0 0')->toHexString());
        $this->assertEquals('#f00', tinycolor('rgb 255 0 0')->toHexString(true));

        $this->assertEquals("#ff000080", tinycolor("rgba 255 0 0 0.5")->toHex8String());
        $this->assertEquals("#ff000000", tinycolor("rgba 255 0 0 0")->toHex8String());
        $this->assertEquals("#ff0000ff", tinycolor("rgba 255 0 0 1")->toHex8String());
        $this->assertEquals("#f00f", tinycolor("rgba 255 0 0 1")->toHex8String(true));

        $this->assertEquals("ff0000", tinycolor("rgb 255 0 0")->toHex());
        $this->assertEquals("f00", tinycolor("rgb 255 0 0")->toHex(true));
        $this->assertEquals("ff000080", tinycolor("rgba 255 0 0 0.5")->toHex8());
    }

    public function testHSVParsing()
    {
        $this->assertEquals("hsv(251, 89%, 92%)", tinycolor("hsv 251.1 0.887 .918")->toHsvString());
        $this->assertEquals("hsv(251, 89%, 92%)", tinycolor("hsv 251.1 0.887 0.918")->toHsvString());
        $this->assertEquals("hsva(251, 89%, 92%, 0.5)", tinycolor("hsva 251.1 0.887 0.918 0.5")->toHsvString());
    }

    public function testInvalidParsing()
    {
        $invalidColor = tinycolor("this is not a color");
        $this->assertEquals("#000000", $invalidColor->toHexString());
        $this->assertFalse($invalidColor->isValid());

        $invalidColor = tinycolor("#red");
        $this->assertEquals("#000000", $invalidColor->toHexString());
        $this->assertFalse($invalidColor->isValid());

        $invalidColor = tinycolor("  #red");
        $this->assertEquals("#000000", $invalidColor->toHexString());
        $this->assertFalse($invalidColor->isValid());

        $invalidColor = tinycolor("##123456");
        $this->assertEquals("#000000", $invalidColor->toHexString());
        $this->assertFalse($invalidColor->isValid());

        $invalidColor = tinycolor("  ##123456");
        $this->assertEquals("#000000", $invalidColor->toHexString());
        $this->assertFalse($invalidColor->isValid());

        $invalidColor = tinycolor(['r' => 'invalid', 'g' => 'invalid', 'b' => 'invalid']);
        $this->assertEquals("#000000", $invalidColor->toHexString());
        $this->assertFalse($invalidColor->isValid());

        $invalidColor = tinycolor(['h' => 'invalid', 's' => 'invalid', 'l' => 'invalid']);
        $this->assertEquals("#000000", $invalidColor->toHexString());
        $this->assertFalse($invalidColor->isValid());

        $invalidColor = tinycolor(['h' => 'invalid', 's' => 'invalid', 'v' => 'invalid']);
        $this->assertEquals("#000000", $invalidColor->toHexString());
        $this->assertFalse($invalidColor->isValid());
    }

    public function testNamedColors()
    {
        $this->assertEquals("f0f8ff", tinycolor("aliceblue")->toHex());
        $this->assertEquals("faebd7", tinycolor("antiquewhite")->toHex());
        $this->assertEquals("00ffff", tinycolor("aqua")->toHex());
        $this->assertEquals("7fffd4", tinycolor("aquamarine")->toHex());
        $this->assertEquals("f0ffff", tinycolor("azure")->toHex());
        $this->assertEquals("f5f5dc", tinycolor("beige")->toHex());
        $this->assertEquals("ffe4c4", tinycolor("bisque")->toHex());
        $this->assertEquals("000000", tinycolor("black")->toHex());
        $this->assertEquals("ffebcd", tinycolor("blanchedalmond")->toHex());
        $this->assertEquals("0000ff", tinycolor("blue")->toHex());
        $this->assertEquals("8a2be2", tinycolor("blueviolet")->toHex());
        $this->assertEquals("a52a2a", tinycolor("brown")->toHex());
        $this->assertEquals("deb887", tinycolor("burlywood")->toHex());
        $this->assertEquals("5f9ea0", tinycolor("cadetblue")->toHex());
        $this->assertEquals("7fff00", tinycolor("chartreuse")->toHex());
        $this->assertEquals("d2691e", tinycolor("chocolate")->toHex());
        $this->assertEquals("ff7f50", tinycolor("coral")->toHex());
        $this->assertEquals("6495ed", tinycolor("cornflowerblue")->toHex());
        $this->assertEquals("fff8dc", tinycolor("cornsilk")->toHex());
        $this->assertEquals("dc143c", tinycolor("crimson")->toHex());
        $this->assertEquals("00ffff", tinycolor("cyan")->toHex());
        $this->assertEquals("00008b", tinycolor("darkblue")->toHex());
        $this->assertEquals("008b8b", tinycolor("darkcyan")->toHex());
        $this->assertEquals("b8860b", tinycolor("darkgoldenrod")->toHex());
        $this->assertEquals("a9a9a9", tinycolor("darkgray")->toHex());
        $this->assertEquals("006400", tinycolor("darkgreen")->toHex());
        $this->assertEquals("bdb76b", tinycolor("darkkhaki")->toHex());
        $this->assertEquals("8b008b", tinycolor("darkmagenta")->toHex());
        $this->assertEquals("556b2f", tinycolor("darkolivegreen")->toHex());
        $this->assertEquals("ff8c00", tinycolor("darkorange")->toHex());
        $this->assertEquals("9932cc", tinycolor("darkorchid")->toHex());
        $this->assertEquals("8b0000", tinycolor("darkred")->toHex());
        $this->assertEquals("e9967a", tinycolor("darksalmon")->toHex());
        $this->assertEquals("8fbc8f", tinycolor("darkseagreen")->toHex());
        $this->assertEquals("483d8b", tinycolor("darkslateblue")->toHex());
        $this->assertEquals("2f4f4f", tinycolor("darkslategray")->toHex());
        $this->assertEquals("00ced1", tinycolor("darkturquoise")->toHex());
        $this->assertEquals("9400d3", tinycolor("darkviolet")->toHex());
        $this->assertEquals("ff1493", tinycolor("deeppink")->toHex());
        $this->assertEquals("00bfff", tinycolor("deepskyblue")->toHex());
        $this->assertEquals("696969", tinycolor("dimgray")->toHex());
        $this->assertEquals("1e90ff", tinycolor("dodgerblue")->toHex());
        $this->assertEquals("b22222", tinycolor("firebrick")->toHex());
        $this->assertEquals("fffaf0", tinycolor("floralwhite")->toHex());
        $this->assertEquals("228b22", tinycolor("forestgreen")->toHex());
        $this->assertEquals("ff00ff", tinycolor("fuchsia")->toHex());
        $this->assertEquals("dcdcdc", tinycolor("gainsboro")->toHex());
        $this->assertEquals("f8f8ff", tinycolor("ghostwhite")->toHex());
        $this->assertEquals("ffd700", tinycolor("gold")->toHex());
        $this->assertEquals("daa520", tinycolor("goldenrod")->toHex());
        $this->assertEquals("808080", tinycolor("gray")->toHex());
        $this->assertEquals("808080", tinycolor("grey")->toHex());
        $this->assertEquals("008000", tinycolor("green")->toHex());
        $this->assertEquals("adff2f", tinycolor("greenyellow")->toHex());
        $this->assertEquals("f0fff0", tinycolor("honeydew")->toHex());
        $this->assertEquals("ff69b4", tinycolor("hotpink")->toHex());
        $this->assertEquals("cd5c5c", tinycolor("indianred ")->toHex());
        $this->assertEquals("4b0082", tinycolor("indigo ")->toHex());
        $this->assertEquals("fffff0", tinycolor("ivory")->toHex());
        $this->assertEquals("f0e68c", tinycolor("khaki")->toHex());
        $this->assertEquals("e6e6fa", tinycolor("lavender")->toHex());
        $this->assertEquals("fff0f5", tinycolor("lavenderblush")->toHex());
        $this->assertEquals("7cfc00", tinycolor("lawngreen")->toHex());
        $this->assertEquals("fffacd", tinycolor("lemonchiffon")->toHex());
        $this->assertEquals("add8e6", tinycolor("lightblue")->toHex());
        $this->assertEquals("f08080", tinycolor("lightcoral")->toHex());
        $this->assertEquals("e0ffff", tinycolor("lightcyan")->toHex());
        $this->assertEquals("fafad2", tinycolor("lightgoldenrodyellow")->toHex());
        $this->assertEquals("d3d3d3", tinycolor("lightgrey")->toHex());
        $this->assertEquals("90ee90", tinycolor("lightgreen")->toHex());
        $this->assertEquals("ffb6c1", tinycolor("lightpink")->toHex());
        $this->assertEquals("ffa07a", tinycolor("lightsalmon")->toHex());
        $this->assertEquals("20b2aa", tinycolor("lightseagreen")->toHex());
        $this->assertEquals("87cefa", tinycolor("lightskyblue")->toHex());
        $this->assertEquals("778899", tinycolor("lightslategray")->toHex());
        $this->assertEquals("b0c4de", tinycolor("lightsteelblue")->toHex());
        $this->assertEquals("ffffe0", tinycolor("lightyellow")->toHex());
        $this->assertEquals("00ff00", tinycolor("lime")->toHex());
        $this->assertEquals("32cd32", tinycolor("limegreen")->toHex());
        $this->assertEquals("faf0e6", tinycolor("linen")->toHex());
        $this->assertEquals("ff00ff", tinycolor("magenta")->toHex());
        $this->assertEquals("800000", tinycolor("maroon")->toHex());
        $this->assertEquals("66cdaa", tinycolor("mediumaquamarine")->toHex());
        $this->assertEquals("0000cd", tinycolor("mediumblue")->toHex());
        $this->assertEquals("ba55d3", tinycolor("mediumorchid")->toHex());
        $this->assertEquals("9370db", tinycolor("mediumpurple")->toHex());
        $this->assertEquals("3cb371", tinycolor("mediumseagreen")->toHex());
        $this->assertEquals("7b68ee", tinycolor("mediumslateblue")->toHex());
        $this->assertEquals("00fa9a", tinycolor("mediumspringgreen")->toHex());
        $this->assertEquals("48d1cc", tinycolor("mediumturquoise")->toHex());
        $this->assertEquals("c71585", tinycolor("mediumvioletred")->toHex());
        $this->assertEquals("191970", tinycolor("midnightblue")->toHex());
        $this->assertEquals("f5fffa", tinycolor("mintcream")->toHex());
        $this->assertEquals("ffe4e1", tinycolor("mistyrose")->toHex());
        $this->assertEquals("ffe4b5", tinycolor("moccasin")->toHex());
        $this->assertEquals("ffdead", tinycolor("navajowhite")->toHex());
        $this->assertEquals("000080", tinycolor("navy")->toHex());
        $this->assertEquals("fdf5e6", tinycolor("oldlace")->toHex());
        $this->assertEquals("808000", tinycolor("olive")->toHex());
        $this->assertEquals("6b8e23", tinycolor("olivedrab")->toHex());
        $this->assertEquals("ffa500", tinycolor("orange")->toHex());
        $this->assertEquals("ff4500", tinycolor("orangered")->toHex());
        $this->assertEquals("da70d6", tinycolor("orchid")->toHex());
        $this->assertEquals("eee8aa", tinycolor("palegoldenrod")->toHex());
        $this->assertEquals("98fb98", tinycolor("palegreen")->toHex());
        $this->assertEquals("afeeee", tinycolor("paleturquoise")->toHex());
        $this->assertEquals("db7093", tinycolor("palevioletred")->toHex());
        $this->assertEquals("ffefd5", tinycolor("papayawhip")->toHex());
        $this->assertEquals("ffdab9", tinycolor("peachpuff")->toHex());
        $this->assertEquals("cd853f", tinycolor("peru")->toHex());
        $this->assertEquals("ffc0cb", tinycolor("pink")->toHex());
        $this->assertEquals("dda0dd", tinycolor("plum")->toHex());
        $this->assertEquals("b0e0e6", tinycolor("powderblue")->toHex());
        $this->assertEquals("800080", tinycolor("purple")->toHex());
        $this->assertEquals("663399", tinycolor("rebeccapurple")->toHex());
        $this->assertEquals("ff0000", tinycolor("red")->toHex());
        $this->assertEquals("bc8f8f", tinycolor("rosybrown")->toHex());
        $this->assertEquals("4169e1", tinycolor("royalblue")->toHex());
        $this->assertEquals("8b4513", tinycolor("saddlebrown")->toHex());
        $this->assertEquals("fa8072", tinycolor("salmon")->toHex());
        $this->assertEquals("f4a460", tinycolor("sandybrown")->toHex());
        $this->assertEquals("2e8b57", tinycolor("seagreen")->toHex());
        $this->assertEquals("fff5ee", tinycolor("seashell")->toHex());
        $this->assertEquals("a0522d", tinycolor("sienna")->toHex());
        $this->assertEquals("c0c0c0", tinycolor("silver")->toHex());
        $this->assertEquals("87ceeb", tinycolor("skyblue")->toHex());
        $this->assertEquals("6a5acd", tinycolor("slateblue")->toHex());
        $this->assertEquals("708090", tinycolor("slategray")->toHex());
        $this->assertEquals("fffafa", tinycolor("snow")->toHex());
        $this->assertEquals("00ff7f", tinycolor("springgreen")->toHex());
        $this->assertEquals("4682b4", tinycolor("steelblue")->toHex());
        $this->assertEquals("d2b48c", tinycolor("tan")->toHex());
        $this->assertEquals("008080", tinycolor("teal")->toHex());
        $this->assertEquals("d8bfd8", tinycolor("thistle")->toHex());
        $this->assertEquals("ff6347", tinycolor("tomato")->toHex());
        $this->assertEquals("40e0d0", tinycolor("turquoise")->toHex());
        $this->assertEquals("ee82ee", tinycolor("violet")->toHex());
        $this->assertEquals("f5deb3", tinycolor("wheat")->toHex());
        $this->assertEquals("ffffff", tinycolor("white")->toHex());
        $this->assertEquals("f5f5f5", tinycolor("whitesmoke")->toHex());
        $this->assertEquals("ffff00", tinycolor("yellow")->toHex());
        $this->assertEquals("9acd32", tinycolor("yellowgreen")->toHex());

        $this->assertEquals("red", tinycolor("#f00")->toName());
        $this->assertFalse(tinycolor("#fa0a0a")->toName());
    }

    public function testInvalidAlphaShouldNormalizeToOne()
    {
        $this->assertEquals(
            "rgb(255, 20, 10)",
            tinycolor(['r' => 255, 'g' => 20, 'b' => 10, 'a' => -1])->toRgbString()
        );
        $this->assertEquals(
            "rgba(255, 20, 10, 0)",
            tinycolor(['r' => 255, 'g' => 20, 'b' => 10, 'a' => -0])->toRgbString()
        );
        $this->assertEquals(
            "rgba(255, 20, 10, 0)",
            tinycolor(['r' => 255, 'g' => 20, 'b' => 10, 'a' => 0])->toRgbString()
        );
        $this->assertEquals(
            "rgba(255, 20, 10, 0.5)",
            tinycolor(['r' => 255, 'g' => 20, 'b' => 10, 'a' => .5])->toRgbString()
        );
        $this->assertEquals(
            "rgb(255, 20, 10)",
            tinycolor(['r' => 255, 'g' => 20, 'b' => 10, 'a' => 1])->toRgbString()
        );
        $this->assertEquals(
            "rgb(255, 20, 10)",
            tinycolor(['r' => 255, 'g' => 20, 'b' => 10, 'a' => 100])->toRgbString()
        );
        $this->assertEquals(
            "rgb(255, 20, 10)",
            tinycolor(['r' => 255, 'g' => 20, 'b' => 10, 'a' => "asdfasd"])->toRgbString()
        );

        $this->assertEquals(
            "rgb(255, 255, 255)",
            tinycolor("#fff")->toRgbString()
        );
        $this->assertEquals(
            "rgb(255, 0, 0)",
            tinycolor("rgba 255 0 0 100")->toRgbString()
        );
    }

    public function testToString()
    {
        $this->assertEquals("rgb(255, 0, 0)", tinycolor('red')->toString('rgb'));
        $this->assertEquals("rgb(100%, 0%, 0%)", tinycolor('red')->toString('prgb'));
        $this->assertEquals("hsl(0, 100%, 50%)", tinycolor('red')->toString('hsl'));
        $this->assertEquals("hsv(0, 100%, 100%)", tinycolor('red')->toString('hsv'));

        $this->assertEquals("rgb(255, 0, 0)", tinycolor('rgb 1.0 0 0')->toString());
    }

    public function testToStringWithAlphaSet()
    {
        $redNamed         = TinyColor::fromRatio(['r' => 255, 'g' => 0, 'b' => 0, 'a' => .6], ['format' => "name"]);
        $transparentNamed = TinyColor::fromRatio(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 0], ['format' => "name"]);
        $redHex           = TinyColor::fromRatio(['r' => 255, 'g' => 0, 'b' => 0, 'a' => .4], ['format' => "hex"]);

        $this->assertEquals("name", $redNamed->getFormat());
        $this->assertEquals("hex", $redHex->getFormat());

        $this->assertEquals("rgba(255, 0, 0, 0.6)", $redNamed->toString());
        $this->assertEquals("rgba(255, 0, 0, 0.4)", $redHex->toString());

        $this->assertEquals("#ff0000", $redNamed->toString("hex"));
        $this->assertEquals("#ff0000", $redNamed->toString("hex6"));
        $this->assertEquals("#f00", $redNamed->toString("hex3"));
        $this->assertEquals("#ff000099", $redNamed->toString("hex8"));
        $this->assertEquals("#f009", $redNamed->toString("hex4"));
        $this->assertEquals("#ff0000", $redNamed->toString("name"));

        $this->assertFalse($redNamed->toName());

        $this->assertEquals("rgba(255, 0, 0, 0.4)", $redHex->toString());
        $this->assertEquals("transparent", $transparentNamed->toString());

        $redHex->setAlpha(0);
        $this->assertEquals("rgba(255, 0, 0, 0)", $redHex->toString());
    }

    public function testSettingAlpha()
    {
        $hexSetter = tinycolor("rgba(255, 0, 0, 1)");
        $this->assertEquals(1, $hexSetter->getAlpha());
        $returnedFromSetAlpha = $hexSetter->setAlpha(.9);
        $this->assertEquals($hexSetter, $returnedFromSetAlpha);
        $this->assertEquals(.9, $hexSetter->getAlpha());
        $hexSetter->setAlpha(.5);
        $this->assertEquals(.5, $hexSetter->getAlpha());
        $hexSetter->setAlpha(0);
        $this->assertEquals(0, $hexSetter->getAlpha());
        $hexSetter->setAlpha(-1);
        $this->assertEquals(1, $hexSetter->getAlpha());
        $hexSetter->setAlpha(2);
        $this->assertEquals(1, $hexSetter->getAlpha());
        // $hexSetter->setAlpha();
        // $this->assertEquals(1, $hexSetter->getAlpha());
        $hexSetter->setAlpha(null);
        $this->assertEquals(1, $hexSetter->getAlpha());
        $hexSetter->setAlpha("test");
        $this->assertEquals(1, $hexSetter->getAlpha());
    }

    public function testAlphaIsZeroShouldActDifferentlyOnToName()
    {
        $this->assertEquals(
            'transparent',
            tinycolor(['r' => 255, 'g' => 20, 'b' => 10, 'a' => 0])->toName()
        );
        $this->assertEquals(
            'transparent', tinycolor("transparent")->toString()
        );
        $this->assertEquals(
            '000000', tinycolor("transparent")->toHex()
        );
    }

    public function testGetBrightness()
    {
        $this->assertEquals(0, tinycolor('#000')->getBrightness());
        $this->assertEquals(255, tinycolor('#fff')->getBrightness());
    }

    public function testGetLuminance()
    {
        $this->assertEquals(0, tinycolor('#000')->getLuminance());
        $this->assertEquals(1, tinycolor('#fff')->getLuminance());
    }

    public function testIsDarkReturnsTrueOrFalseForDarkOrLightColors()
    {
        $this->assertTrue(tinycolor('#000')->isDark());
        $this->assertTrue(tinycolor('#111')->isDark());
        $this->assertTrue(tinycolor('#222')->isDark());
        $this->assertTrue(tinycolor('#333')->isDark());
        $this->assertTrue(tinycolor('#444')->isDark());
        $this->assertTrue(tinycolor('#555')->isDark());
        $this->assertTrue(tinycolor('#666')->isDark());
        $this->assertTrue(tinycolor('#777')->isDark());

        $this->assertFalse(tinycolor('#888')->isDark());
        $this->assertFalse(tinycolor('#999')->isDark());
        $this->assertFalse(tinycolor('#aaa')->isDark());
        $this->assertFalse(tinycolor('#bbb')->isDark());
        $this->assertFalse(tinycolor('#ccc')->isDark());
        $this->assertFalse(tinycolor('#ddd')->isDark());
        $this->assertFalse(tinycolor('#eee')->isDark());
        $this->assertFalse(tinycolor('#fff')->isDark());
    }

    public function testIsLightReturnsTrueOrFalseForLightOrDarkColors()
    {
        $this->assertFalse(tinycolor('#000')->isLight());
        $this->assertFalse(tinycolor('#111')->isLight());
        $this->assertFalse(tinycolor('#222')->isLight());
        $this->assertFalse(tinycolor('#333')->isLight());
        $this->assertFalse(tinycolor('#444')->isLight());
        $this->assertFalse(tinycolor('#555')->isLight());
        $this->assertFalse(tinycolor('#666')->isLight());
        $this->assertFalse(tinycolor('#777')->isLight());

        $this->assertTrue(tinycolor('#888')->isLight());
        $this->assertTrue(tinycolor('#999')->isLight());
        $this->assertTrue(tinycolor('#aaa')->isLight());
        $this->assertTrue(tinycolor('#bbb')->isLight());
        $this->assertTrue(tinycolor('#ccc')->isLight());
        $this->assertTrue(tinycolor('#ddd')->isLight());
        $this->assertTrue(tinycolor('#eee')->isLight());
        $this->assertTrue(tinycolor('#fff')->isLight());
    }

    /**
     * @dataProvider conversions
     */
    public function testInitializationFromTinycolorOutput($hex, $hex8, $rgb, $hsv, $hsl)
    {
        $tiny = tinycolor($hex);

        // HSL array
        $this->assertEquals(tinycolor($tiny->toHsl())->toHexString(), $tiny->toHexString());

        // HSL string
        $input   = $tiny->toRgb();
        $output  = tinycolor($tiny->toHslString())->toRgb();
        $maxDiff = 2;

        $this->assertLessThanOrEqual($maxDiff, abs($input['r'] - $output['r']));
        $this->assertLessThanOrEqual($maxDiff, abs($input['g'] - $output['g']));
        $this->assertLessThanOrEqual($maxDiff, abs($input['b'] - $output['b']));

        // HSV string
        $output = tinycolor($tiny->toHsvString())->toRgb();
        $this->assertLessThanOrEqual($maxDiff, abs($input['r'] - $output['r']));
        $this->assertLessThanOrEqual($maxDiff, abs($input['g'] - $output['g']));
        $this->assertLessThanOrEqual($maxDiff, abs($input['b'] - $output['b']));

        // HSV array
        $this->assertEquals(tinycolor($tiny->toHsv())->toHexString(), $tiny->toHexString());

        // RGB array
        $this->assertEquals(tinycolor($tiny->toRgb())->toHexString(), $tiny->toHexString());

        // RGB string
        $this->assertEquals(tinycolor($tiny->toRgbString())->toHexString(), $tiny->toHexString());

        // PRGB array
        $output = tinycolor($tiny->toPercentageRgb())->toRgb();
        $this->assertLessThanOrEqual($maxDiff, abs($input['r'] - $output['r']));
        $this->assertLessThanOrEqual($maxDiff, abs($input['g'] - $output['g']));
        $this->assertLessThanOrEqual($maxDiff, abs($input['b'] - $output['b']));

        // PRGB String
        $output = tinycolor($tiny->toPercentageRgbString())->toRgb();
        $this->assertLessThanOrEqual($maxDiff, abs($input['r'] - $output['r']));
        $this->assertLessThanOrEqual($maxDiff, abs($input['g'] - $output['g']));
        $this->assertLessThanOrEqual($maxDiff, abs($input['b'] - $output['b']));

        // Object
        $this->assertEquals(tinycolor($tiny)->toHexString(), $tiny->toHexString());
    }

    public function testColorEquality()
    {
        $this->assertTrue(TinyColor::equals("#ff0000", "#ff0000"));
        $this->assertTrue(TinyColor::equals("#ff0000", "rgb(255, 0, 0)"));
        $this->assertFalse(TinyColor::equals("#ff0000", "rgba(255, 0, 0, .1)"));
        $this->assertTrue(TinyColor::equals("#ff000066", "rgba(255, 0, 0, .4)"));
        $this->assertTrue(TinyColor::equals("#f009", "rgba(255, 0, 0, .6)"));
        $this->assertTrue(TinyColor::equals("#336699CC", "369C"));
        $this->assertTrue(TinyColor::equals("ff0000", "#ff0000"));
        $this->assertTrue(TinyColor::equals("#f00", "#ff0000"));
        $this->assertTrue(TinyColor::equals("#f00", "#ff0000"));
        $this->assertTrue(TinyColor::equals("f00", "#ff0000"));

        $this->assertEquals('#010101', tinycolor('010101')->toHexString());

        $this->assertFalse(TinyColor::equals("#ff0000", "#00ff00"));
        $this->assertTrue(TinyColor::equals("#ff8000", "rgb(100%, 50%, 0%)"));

        $this->assertFalse(TinyColor::equals("#ff0000", null));
        $this->assertFalse(TinyColor::equals(null, null));
    }

    public function testIsReadable()
    {

        // "#ff0088", "#8822aa" (values used in old WCAG1 tests)
        $this->assertTrue(TinyColor::isReadable("#000000", "#ffffff", ['level' => "AA", 'size' => "small"]));
        $this->assertFalse(TinyColor::isReadable("#ff0088", "#5c1a72", []));
        $this->assertFalse(TinyColor::isReadable("#ff0088", "#8822aa", ['level' => "AA", 'size' => "small"]));
        $this->assertFalse(TinyColor::isReadable("#ff0088", "#8822aa", ['level' => "AA", 'size' => "large"]));
        $this->assertFalse(TinyColor::isReadable("#ff0088", "#8822aa", ['level' => "AAA", 'size' => "small"]));
        $this->assertFalse(TinyColor::isReadable("#ff0088", "#8822aa", ['level' => "AAA", 'size' => "large"]));

        // values derived from and validated using the calculators at http://www.dasplankton.de/ContrastA/
        // and http://webaim.org/resources/contrastchecker/

        // "#ff0088", "#5c1a72": contrast ratio 3.04
        $this->assertFalse(TinyColor::isReadable("#ff0088", "#5c1a72", ['level' => "AA", 'size' => "small"]));
        $this->assertTrue(TinyColor::isReadable("#ff0088", "#5c1a72", ['level' => "AA", 'size' => "large"]));
        $this->assertFalse(TinyColor::isReadable("#ff0088", "#5c1a72", ['level' => "AAA", 'size' => "small"]));
        $this->assertFalse(TinyColor::isReadable("#ff0088", "#5c1a72", ['level' => "AAA", 'size' => "large"]));

        // "#ff0088", "#2e0c3a": contrast ratio 4.56
        $this->assertTrue(TinyColor::isReadable("#ff0088", "#2e0c3a", ['level' => "AA", 'size' => "small"]));
        $this->assertTrue(TinyColor::isReadable("#ff0088", "#2e0c3a", ['level' => "AA", 'size' => "large"]));
        $this->assertFalse(TinyColor::isReadable("#ff0088", "#2e0c3a", ['level' => "AAA", 'size' => "small"]));
        $this->assertTrue(TinyColor::isReadable("#ff0088", "#2e0c3a", ['level' => "AAA", 'size' => "large"]));

        // "#db91b8", "#2e0c3a":  contrast ratio 7.12
        $this->assertTrue(TinyColor::isReadable("#db91b8", "#2e0c3a", ['level' => "AA", 'size' => "small"]));
        $this->assertTrue(TinyColor::isReadable("#db91b8", "#2e0c3a", ['level' => "AA", 'size' => "large"]));
        $this->assertTrue(TinyColor::isReadable("#db91b8", "#2e0c3a", ['level' => "AAA", 'size' => "small"]));
        $this->assertTrue(TinyColor::isReadable("#db91b8", "#2e0c3a", ['level' => "AAA", 'size' => "large"]));
    }

    public function testReadability()
    {
        // check return values from readability function. See isReadable above for standards tests.
        $this->assertEquals(1, TinyColor::readability("#000", "#000"));
        $this->assertSame(1.1121078324840545, TinyColor::readability("#000", "#111"));
        // todo
        // float or int
        $this->assertSame(21.0, TinyColor::readability("#000", "#fff"));
    }

    public function testMostReadable()
    {
        $this->assertEquals("#222222", TinyColor::mostReadable("#000", ["#111", "#222"])->toHexString());
        $this->assertEquals("#00dd00", TinyColor::mostReadable("#f00", ["#d00", "#0d0"])->toHexString());
        $this->assertEquals("#ffffff", TinyColor::mostReadable("#fff", ["#fff", "#fff"])->toHexString());
        //includeFallbackColors
        $this->assertEquals("#000000",
            TinyColor::mostReadable("#fff", ["#fff", "#fff"], ['includeFallbackColors' => true])->toHexString());
        $this->assertEquals("#112255",
            TinyColor::mostReadable("#123", ["#124", "#125"], ['includeFallbackColors' => false])->toHexString());
        $this->assertEquals("#ffffff",
            TinyColor::mostReadable("#123", ["#000", "#fff"], ['includeFallbackColors' => false])->toHexString());
        $this->assertEquals("#ffffff",
            TinyColor::mostReadable("#123", ["#124", "#125"], ['includeFallbackColors' => true])->toHexString());

        $this->assertEquals("#000000",
            TinyColor::mostReadable("#ff0088", ["#000", "#fff"], ['includeFallbackColors' => false])->toHexString());
        $this->assertEquals("#2e0c3a", TinyColor::mostReadable("#ff0088", ["#2e0c3a"],
            ['includeFallbackColors' => true, 'level' => "AAA", 'size' => "large"])->toHexString());
        $this->assertEquals("#000000", TinyColor::mostReadable("#ff0088", ["#2e0c3a"],
            ['includeFallbackColors' => true, 'level' => "AAA", 'size' => "small"])->toHexString());

        $this->assertEquals("#ffffff",
            TinyColor::mostReadable("#371b2c", ["#000", "#fff"], ['includeFallbackColors' => false])->toHexString());
        $this->assertEquals("#a9acb6", TinyColor::mostReadable("#371b2c", ["#a9acb6"],
            ['includeFallbackColors' => true, 'level' => "AAA", 'size' => "large"])->toHexString());
        $this->assertEquals("#ffffff", TinyColor::mostReadable("#371b2c", ["#a9acb6"],
            ['includeFallbackColors' => true, 'level' => "AAA", 'size' => "small"])->toHexString());
    }

    public function testToFilters()
    {
        $this->assertEquals(
            "progid:DXImageTransform.Microsoft.gradient(startColorstr=#ffff0000,endColorstr=#ffff0000)",
            tinycolor("red")->toFilter()
        );
        $this->assertEquals(
            "progid:DXImageTransform.Microsoft.gradient(startColorstr=#ffff0000,endColorstr=#ff0000ff)",
            tinycolor("red")->toFilter("blue")
        );

        $this->assertEquals(
            "progid:DXImageTransform.Microsoft.gradient(startColorstr=#00000000,endColorstr=#00000000)",
            tinycolor("transparent")->toFilter()
        );
        $this->assertEquals(
            "progid:DXImageTransform.Microsoft.gradient(startColorstr=#00000000,endColorstr=#ffff0000)",
            tinycolor("transparent")->toFilter("red")
        );

        $this->assertEquals(
            "progid:DXImageTransform.Microsoft.gradient(startColorstr=#ddf0f0f0,endColorstr=#ddf0f0f0)",
            tinycolor("#f0f0f0dd")->toFilter()
        );
        $this->assertEquals(
            "progid:DXImageTransform.Microsoft.gradient(startColorstr=#800000ff,endColorstr=#800000ff)",
            tinycolor("rgba(0, 0, 255, .5")->toFilter()
        );
    }

    public function testModification()
    {
        $DESATURATIONS = [
            "ff0000", "fe0101", "fc0303", "fb0404", "fa0505", "f90606", "f70808", "f60909", "f50a0a", "f40b0b",
            "f20d0d", "f10e0e", "f00f0f", "ee1111", "ed1212", "ec1313", "eb1414", "e91616", "e81717", "e71818",
            "e61a1a", "e41b1b", "e31c1c", "e21d1d", "e01f1f", "df2020", "de2121", "dd2222", "db2424", "da2525",
            "d92626", "d72828", "d62929", "d52a2a", "d42b2b", "d22d2d", "d12e2e", "d02f2f", "cf3030", "cd3232",
            "cc3333", "cb3434", "c93636", "c83737", "c73838", "c63939", "c43b3b", "c33c3c", "c23d3d", "c13e3e",
            "bf4040", "be4141", "bd4242", "bb4444", "ba4545", "b94646", "b84747", "b64949", "b54a4a", "b44b4b",
            "b34d4d", "b14e4e", "b04f4f", "af5050", "ad5252", "ac5353", "ab5454", "aa5555", "a85757", "a75858",
            "a65959", "a45b5b", "a35c5c", "a25d5d", "a15e5e", "9f6060", "9e6161", "9d6262", "9c6363", "9a6565",
            "996666", "986767", "966969", "956a6a", "946b6b", "936c6c", "916e6e", "906f6f", "8f7070", "8e7171",
            "8c7373", "8b7474", "8a7575", "887777", "877878", "867979", "857a7a", "837c7c", "827d7d", "817e7e",
            "808080",
        ];
        $SATURATIONS   = [
            "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000",
            "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000",
            "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000",
            "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000",
            "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000",
            "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000",
            "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000",
            "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000",
            "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000",
            "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000", "ff0000",
            "ff0000",
        ];
        $LIGHTENS      = [
            "ff0000", "ff0505", "ff0a0a", "ff0f0f", "ff1414", "ff1a1a", "ff1f1f", "ff2424", "ff2929", "ff2e2e",
            "ff3333", "ff3838", "ff3d3d", "ff4242", "ff4747", "ff4d4d", "ff5252", "ff5757", "ff5c5c", "ff6161",
            "ff6666", "ff6b6b", "ff7070", "ff7575", "ff7a7a", "ff8080", "ff8585", "ff8a8a", "ff8f8f", "ff9494",
            "ff9999", "ff9e9e", "ffa3a3", "ffa8a8", "ffadad", "ffb3b3", "ffb8b8", "ffbdbd", "ffc2c2", "ffc7c7",
            "ffcccc", "ffd1d1", "ffd6d6", "ffdbdb", "ffe0e0", "ffe6e6", "ffebeb", "fff0f0", "fff5f5", "fffafa",
            "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff",
            "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff",
            "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff",
            "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff",
            "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff", "ffffff",
            "ffffff",
        ];
        $BRIGHTENS     = [
            "ff0000", "ff0303", "ff0505", "ff0808", "ff0a0a", "ff0d0d", "ff0f0f", "ff1212", "ff1414", "ff1717",
            "ff1a1a", "ff1c1c", "ff1f1f", "ff2121", "ff2424", "ff2626", "ff2929", "ff2b2b", "ff2e2e", "ff3030",
            "ff3333", "ff3636", "ff3838", "ff3b3b", "ff3d3d", "ff4040", "ff4242", "ff4545", "ff4747", "ff4a4a",
            "ff4d4d", "ff4f4f", "ff5252", "ff5454", "ff5757", "ff5959", "ff5c5c", "ff5e5e", "ff6161", "ff6363",
            "ff6666", "ff6969", "ff6b6b", "ff6e6e", "ff7070", "ff7373", "ff7575", "ff7878", "ff7a7a", "ff7d7d",
            "ff8080", "ff8282", "ff8585", "ff8787", "ff8a8a", "ff8c8c", "ff8f8f", "ff9191", "ff9494", "ff9696",
            "ff9999", "ff9c9c", "ff9e9e", "ffa1a1", "ffa3a3", "ffa6a6", "ffa8a8", "ffabab", "ffadad", "ffb0b0",
            "ffb3b3", "ffb5b5", "ffb8b8", "ffbaba", "ffbdbd", "ffbfbf", "ffc2c2", "ffc4c4", "ffc7c7", "ffc9c9",
            "ffcccc", "ffcfcf", "ffd1d1", "ffd4d4", "ffd6d6", "ffd9d9", "ffdbdb", "ffdede", "ffe0e0", "ffe3e3",
            "ffe6e6", "ffe8e8", "ffebeb", "ffeded", "fff0f0", "fff2f2", "fff5f5", "fff7f7", "fffafa", "fffcfc",
            "ffffff",
        ];
        $DARKENS       = [
            "ff0000", "fa0000", "f50000", "f00000", "eb0000", "e60000", "e00000", "db0000", "d60000", "d10000",
            "cc0000", "c70000", "c20000", "bd0000", "b80000", "b30000", "ad0000", "a80000", "a30000", "9e0000",
            "990000", "940000", "8f0000", "8a0000", "850000", "800000", "7a0000", "750000", "700000", "6b0000",
            "660000", "610000", "5c0000", "570000", "520000", "4d0000", "470000", "420000", "3d0000", "380000",
            "330000", "2e0000", "290000", "240000", "1f0000", "1a0000", "140000", "0f0000", "0a0000", "050000",
            "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000",
            "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000",
            "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000",
            "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000",
            "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000", "000000",
            "000000",
        ];

        // todo
        // i = 20: e61919 => e61a1a
        for ($i = 0; $i <= 100; $i++) {
            $this->assertEquals($DESATURATIONS[$i], tinycolor("red")->desaturate($i)->toHex(), "desaturate {$i} err");
        }
        for ($i = 0; $i <= 100; $i++) {
            $this->assertEquals($SATURATIONS[$i], tinycolor("red")->saturate($i)->toHex(), "saturate {$i} err");
        }
        // todo
        // i = 45: ffe5e5 => ffe6e6
        for ($i = 0; $i <= 100; $i++) {
            $this->assertEquals($LIGHTENS[$i], tinycolor("red")->lighten($i)->toHex(), "lighten {$i} err");
        }
        // todo
        // i = 10: ff1919 => ff1a1a
        // i = 30: ff4c4c => ff4d4d
        // i = 50: ff7f7f => ff8080
        // i = 70: ffb2b2 => ffb3b3
        // i = 90: ffe5e5 => ffe6e6
        for ($i = 0; $i <= 100; $i++) {
            $this->assertEquals($BRIGHTENS[$i], tinycolor("red")->brighten($i)->toHex(), "brighten {$i} err");
        }
        // todo
        // i = 45: 190000 => 1a0000
        for ($i = 0; $i <= 100; $i++) {
            $this->assertEquals($DARKENS[$i], tinycolor("red")->darken($i)->toHex(), "darken {$i} err");
        }

        $this->assertEquals("808080", tinycolor("red")->greyscale()->toHex());
    }

    public function testSpin()
    {
        $this->assertEquals(206, round(tinycolor("#f00")->spin(-1234)->toHsl()['h']));
        $this->assertEquals(0, round(tinycolor("#f00")->spin(-360)->toHsl()['h']));
        $this->assertEquals(240, round(tinycolor("#f00")->spin(-120)->toHsl()['h']));
        $this->assertEquals(0, round(tinycolor("#f00")->spin(0)->toHsl()['h']));
        $this->assertEquals(10, round(tinycolor("#f00")->spin(10)->toHsl()['h']));
        $this->assertEquals(0, round(tinycolor("#f00")->spin(360)->toHsl()['h']));
        $this->assertEquals(185, round(tinycolor("#f00")->spin(2345)->toHsl()['h']));

        foreach ([-360, 0, 360] as $delta) {
            foreach (Color::$names as $name) {
                $this->assertEquals(tinycolor($name)->spin($delta)->toHex(), tinycolor($name)->toHex());
            }
        }
    }

    public function testMix()
    {
        // amount 0 or none
        $this->assertEquals(0.5, TinyColor::mix('#000', '#fff')->toHsl()['l']);
        $this->assertEquals('ff0000', TinyColor::mix('#f00', '#000', 0)->toHex());
        // This case checks the the problem with floating point numbers (eg 255/90)
        $this->assertEquals('1a1a1a', TinyColor::mix('#fff', '#000', 90)->toHex());

        // black and white
        for ($i = 0; $i < 100; $i++) {
            $this->assertEquals($i / 100, round(TinyColor::mix('#000', '#fff', $i)->toHsl()['l'] * 100) / 100);
        }

        // with colors
        for ($i = 0; $i < 100; $i++) {
            $new_hex = dechex(round((255 * (100 - $i)) / 100));

            if (strlen($new_hex) == 1) {
                $new_hex = '0' . $new_hex;
            }

            $this->assertEquals($new_hex . '0000', TinyColor::mix('#f00', '#000', $i)->toHex());
            $this->assertEquals('00' . $new_hex . '00', TinyColor::mix('#0f0', '#000', $i)->toHex());
            $this->assertEquals('0000' . $new_hex, TinyColor::mix('#00f', '#000', $i)->toHex());
            $this->assertEquals($i / 100, TinyColor::mix(tinycolor('transparent'), '#000', $i)->toRgb()['a']);
        }
    }

    // The combination tests need to be expanded further
    public function testCombinations()
    {

        $colorsToHexString = function ($colors) {
            return implode(',', array_map(function ($item) {
                return $item->toHex();
            }, $colors));
        };

        // complement
        $complementDoesntModifyInstance = tinycolor("red");
        $this->assertEquals("00ffff", $complementDoesntModifyInstance->complement()->toHex());
        $this->assertEquals("ff0000", $complementDoesntModifyInstance->toHex());

        // analogous
        $combination = tinycolor("red")->analogous();
        $this->assertEquals("ff0000,ff0066,ff0033,ff0000,ff3300,ff6600", $colorsToHexString($combination));

        // monochromatic
        $combination = tinycolor("red")->monochromatic();
        $this->assertEquals("ff0000,2a0000,550000,800000,aa0000,d40000", $colorsToHexString($combination));

        // splitcomplement
        $combination = tinycolor("red")->splitcomplement();
        $this->assertEquals("ff0000,ccff00,0066ff", $colorsToHexString($combination));

        // triad
        $combination = tinycolor("red")->triad();
        $this->assertEquals("ff0000,00ff00,0000ff", $colorsToHexString($combination));

        // tetrad
        // todo
        // 7f00ff => 8000ff
        $combination = tinycolor("red")->tetrad();
        $this->assertEquals("ff0000,80ff00,00ffff,8000ff", $colorsToHexString($combination));

    }

    public function testRandom()
    {
        $random = TinyColor::random()->toHexString();
        $this->assertEquals($random, tinycolor($random)->toHexString());
    }
}
