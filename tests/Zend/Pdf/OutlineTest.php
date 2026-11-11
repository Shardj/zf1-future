<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

require_once 'Zend/Pdf.php';
require_once 'Zend/Pdf/Outline.php';
require_once 'Zend/Pdf/Color/Rgb.php';

/**
 * @category   Zend
 * @package    Zend_Pdf
 * @subpackage UnitTests
 * @group      Zend_Pdf
 */
class Zend_Pdf_OutlineTest extends TestCase
{
    public function testColorOfCreatedOutlineCanBeReset()
    {
        $outline = Zend_Pdf_Outline::create('Chapter 1');
        $outline->setColor(new Zend_Pdf_Color_Rgb(1, 0, 0));
        $this->assertInstanceOf(Zend_Pdf_Color_Rgb::class, $outline->getColor());

        $this->assertSame($outline, $outline->setColor(null));
        $this->assertNull($outline->getColor());
    }

    public function testColorOfLoadedOutlineCanBeReset()
    {
        $pdf = new Zend_Pdf();
        $pdf->pages[] = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);
        $outline = Zend_Pdf_Outline::create('Chapter 1');
        $outline->setColor(new Zend_Pdf_Color_Rgb(1, 0, 0));
        $pdf->outlines[] = $outline;

        $source = $pdf->render();
        $loadedPdf = Zend_Pdf::parse($source);
        $loaded = $loadedPdf->outlines[0];
        $this->assertInstanceOf(Zend_Pdf_Outline_Loaded::class, $loaded);
        $this->assertEquals([1, 0, 0], $loaded->getColor()->getComponents());

        $this->assertSame($loaded, $loaded->setColor(null));
        $this->assertNull($loaded->getColor());
    }
}
