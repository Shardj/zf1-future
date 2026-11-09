<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

require_once 'Zend/Pdf/ElementFactory.php';
require_once 'Zend/Pdf/Element/Dictionary.php';
require_once 'Zend/Pdf/Element/Name.php';
require_once 'Zend/Pdf/Resource/GraphicsState.php';

/**
 * @group Zend_Pdf
 */
class Zend_Pdf_GraphicsStateTest extends TestCase
{
    public function testWrapsGivenGraphicsStateObject()
    {
        $dictionary = new Zend_Pdf_Element_Dictionary();
        $dictionary->Type = new Zend_Pdf_Element_Name('ExtGState');
        $factory = Zend_Pdf_ElementFactory::createFactory(1);
        $object  = $factory->newObject($dictionary);

        $graphicsState = new Zend_Pdf_Resource_GraphicsState($object);

        $this->assertSame($object, $graphicsState->getResource());
    }

    public function testCreatesGraphicsStateObject()
    {
        $graphicsState = new Zend_Pdf_Resource_GraphicsState();
        $graphicsState->setAlpha(0.5);

        $resource = $graphicsState->getResource();
        $this->assertSame(Zend_Pdf_Element::TYPE_DICTIONARY, $resource->getType());
        $this->assertSame('ExtGState', $resource->Type->value);
        $this->assertSame(0.5, $resource->CA->value);
    }
}
