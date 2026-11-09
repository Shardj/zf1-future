<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

require_once 'Zend/Pdf.php';
require_once 'Zend/Pdf/Annotation/Link.php';
require_once 'Zend/Pdf/Action/GoTo.php';
require_once 'Zend/Pdf/Destination/Fit.php';
require_once 'Zend/Pdf/Destination/Named.php';

/**
 * @group Zend_Pdf
 */
class Zend_Pdf_AnnotationLinkTest extends TestCase
{
    public function testSetDestinationAcceptsNamedDestinationString()
    {
        $link = Zend_Pdf_Annotation_Link::create(0, 0, 10, 10, 'First');
        $this->assertSame($link, $link->setDestination('Second'));

        $destination = $link->getDestination();
        $this->assertInstanceOf('Zend_Pdf_Destination_Named', $destination);
        $this->assertSame('Second', $destination->getName());
    }

    public function testSetDestinationAcceptsDestination()
    {
        $pdf  = new Zend_Pdf();
        $page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4);

        $link = Zend_Pdf_Annotation_Link::create(0, 0, 10, 10, 'First');
        $link->setDestination(Zend_Pdf_Destination_Fit::create($page));

        $this->assertInstanceOf('Zend_Pdf_Destination_Fit', $link->getDestination());
    }

    public function testSetDestinationAcceptsAction()
    {
        $link = Zend_Pdf_Annotation_Link::create(0, 0, 10, 10, 'First');
        $link->setDestination(Zend_Pdf_Action_GoTo::create('Second'));

        $action = $link->getDestination();
        $this->assertInstanceOf('Zend_Pdf_Action_GoTo', $action);
        $this->assertSame('Second', $action->getDestination()->getName());
    }

    public function testSetDestinationRejectsInvalidTarget()
    {
        $link = Zend_Pdf_Annotation_Link::create(0, 0, 10, 10, 'First');

        $this->expectException(Zend_Pdf_Exception::class);
        $link->setDestination(42);
    }
}
