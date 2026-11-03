<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/** Zend_Pdf */
require_once 'Zend/Pdf.php';

/** Zend_Pdf_Font */
require_once 'Zend/Pdf/Font.php';

/** Zend_Pdf_FileParserDataSource_File */
require_once 'Zend/Pdf/FileParserDataSource/File.php';

/** Zend_Pdf_FileParser_Font_OpenType_TrueType */
require_once 'Zend/Pdf/FileParser/Font/OpenType/TrueType.php';

/**
 * Tests for Zend_Pdf_Font: font loading, embedding options and the
 * TrueType font parser.
 *
 * @category   Zend
 * @package    Zend_Pdf
 * @subpackage UnitTests
 * @group      Zend_Pdf
 */
class Zend_Pdf_FontTest extends TestCase
{
    /**
     * @return string
     */
    protected function _fontPath()
    {
        return dirname(__FILE__) . '/_fonts/Vera.ttf';
    }

    /**
     * Latin blocks only, including the Greek and Private Use Area bits that
     * Latin fonts set for the Mac Roman Greek letters and private ligatures.
     *
     * @group GH-494
     */
    public function testAdobeLatinUnicodeRangeAcceptsLatinBlocks()
    {
        // Basic Latin only
        $this->assertTrue(Zend_Pdf_FileParser_Font_OpenType::isAdobeLatinUnicodeRange(1, 0, 0, 0));

        // Bitstream Vera: bits 0,1,2,3,5,7,31,33,35,38,45,60
        $range1 = (1 << 0) | (1 << 1) | (1 << 2) | (1 << 3) | (1 << 5) | (1 << 7) | (1 << 31);
        $range2 = (1 << 1) | (1 << 3) | (1 << 6) | (1 << 13) | (1 << 28);
        $this->assertTrue(Zend_Pdf_FileParser_Font_OpenType::isAdobeLatinUnicodeRange($range1, $range2, 0, 0));
    }

    /**
     * @group GH-494
     */
    public function testAdobeLatinUnicodeRangeRejectsOtherScripts()
    {
        // Basic Latin + Cyrillic (bit 9)
        $this->assertFalse(Zend_Pdf_FileParser_Font_OpenType::isAdobeLatinUnicodeRange(1 | (1 << 9), 0, 0, 0));

        // Basic Latin + CJK Unified Ideographs (bit 59)
        $this->assertFalse(Zend_Pdf_FileParser_Font_OpenType::isAdobeLatinUnicodeRange(1, 1 << 27, 0, 0));

        // Basic Latin + Arabic Presentation Forms-A (bit 67)
        $this->assertFalse(Zend_Pdf_FileParser_Font_OpenType::isAdobeLatinUnicodeRange(1, 0, 1 << 3, 0));

        // Nothing covered at all
        $this->assertFalse(Zend_Pdf_FileParser_Font_OpenType::isAdobeLatinUnicodeRange(0, 0, 0, 0));
    }

    /**
     * @group GH-494
     */
    public function testVeraIsRecognizedAsAdobeLatinSubset()
    {
        $parser = new Zend_Pdf_FileParser_Font_OpenType_TrueType(new Zend_Pdf_FileParserDataSource_File($this->_fontPath()));
        $parser->parse();

        $this->assertTrue($parser->isAdobeLatinSubset);
        $this->assertFalse($parser->isSymbolicFont);
    }

    /**
     * Without the option a TrueType font is embedded as a composite Type 0
     * font, with it as a simple TrueType font; the two are cached separately.
     *
     * @group GH-494
     */
    public function testEmbedAsSimpleFontOption()
    {
        $composite = Zend_Pdf_Font::fontWithPath($this->_fontPath());
        $this->assertInstanceOf('Zend_Pdf_Resource_Font_Type0', $composite);

        $simple = Zend_Pdf_Font::fontWithPath($this->_fontPath(), Zend_Pdf_Font::EMBED_AS_SIMPLE_FONT);
        $this->assertInstanceOf('Zend_Pdf_Resource_Font_Simple_Parsed_TrueType', $simple);

        $this->assertSame($composite, Zend_Pdf_Font::fontWithPath($this->_fontPath()));
        $this->assertSame($simple, Zend_Pdf_Font::fontWithPath($this->_fontPath(), Zend_Pdf_Font::EMBED_AS_SIMPLE_FONT));
    }

    /**
     * The Widths array of a simple font is indexed by character code of
     * WinAnsiEncoding, not by glyph number.
     *
     * @group GH-494
     */
    public function testSimpleFontWidthsAreIndexedByCharacterCode()
    {
        $font     = Zend_Pdf_Font::fontWithPath($this->_fontPath(), Zend_Pdf_Font::EMBED_AS_SIMPLE_FONT);
        $resource = $font->getResource();

        $this->assertSame(32, $resource->FirstChar->value);
        $this->assertSame(255, $resource->LastChar->value);

        $widths = $resource->Widths->items;
        $this->assertCount(224, $widths);

        $widthOf = function ($char) use ($widths) {
            return $widths[ord($char) - 32]->value;
        };

        // the advance widths reported for the glyphs, in em space
        $glyphWidths = $font->widthsForGlyphs($font->glyphNumbersForCharacters([ord('i'), ord('W'), 0xC4]));
        $this->assertEquals($font->toEmSpace($glyphWidths[0]), $widthOf('i'));
        $this->assertEquals($font->toEmSpace($glyphWidths[1]), $widthOf('W'));
        $this->assertEquals($font->toEmSpace($glyphWidths[2]), $widths[0xC4 - 32]->value);   // Ä

        $this->assertLessThan($widthOf('W'), $widthOf('i'));
        $this->assertEquals($widthOf('A'), $widths[0xC4 - 32]->value);   // Ä has the width of A
    }

    /**
     * A page drawn with a simple font can be saved and loaded again.
     *
     * @group GH-494
     */
    public function testDrawWithSimpleFont()
    {
        $pdf  = new Zend_Pdf();
        $page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
        $pdf->pages[] = $page;

        $font = Zend_Pdf_Font::fontWithPath($this->_fontPath(), Zend_Pdf_Font::EMBED_AS_SIMPLE_FONT);
        $page->setFont($font, 24)->drawText('Vera ÄÖÜ äöü € – “quotes”', 40, 700, 'UTF-8');

        $output = $pdf->render();
        $this->assertStringContainsString('/Subtype /TrueType', $output);
        $this->assertStringContainsString('/Encoding /WinAnsiEncoding', $output);

        $loaded = Zend_Pdf::parse($output);
        $this->assertCount(1, $loaded->pages);
    }
}
