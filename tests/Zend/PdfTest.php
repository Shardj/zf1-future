<?php

/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Pdf
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */
/**
 * @see Zend_Pdf
 */
require_once 'Zend/Pdf.php';
/**
 * @see Zend_Pdf_Exception
 */
require_once 'Zend/Pdf/Exception.php';

/**
 * @category   Zend
 * @package    Zend_Pdf
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Pdf
 */
class Zend_PdfTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Zend_Pdf = null
     */
    private $_pdf;

    protected function setUp()
    {
        $this->_pdf = Zend_Pdf::load(dirname(__FILE__) . '/Pdf/_files/PdfWithFields.pdf');
    }

    /**
     * PDF with text fields must return array of text field names
     */
    public function testGetTextFieldNames()
    {
        $fieldNames = $this->_pdf->getTextFieldNames();
        $this->assertEquals(['Field1', 'Field2'], $fieldNames);
    }

    /**
     * PDF with no text fields must return empty array
     */
    public function testGetTextFieldNamesNoFieldsEmptyArray()
    {
        $pdf        = new Zend_Pdf();
        $fieldNames = $pdf->getTextFieldNames();
        $this->assertEquals([], $fieldNames);
    }

    public function testSetTextField()
    {
        try {
            $this->_pdf->setTextField('Field1', 'Value1');
            $this->assertTrue(true); // in case of --strict
        } catch (\Exception $e) {
            $this->fail('Failed to set an existing text field');
        }
    }

    /**
     * Asserts: Setting a non-existent field shouls throw an exception
     * 
     * @expectedException Zend_Pdf_Exception
     * @expectedExceptionMessage Field 'FieldNotExists' does not exist or is not
     *                           a textfield
     */
    public function testSetTextFieldNonExistent()
    {
        $this->_pdf->setTextField('FieldNotExists', 'Value1');
    }

    public function testSetTextFieldProperties()
    {
        try {
            $this->_pdf->setTextFieldProperties(
                    'Field1', Zend_Pdf::PDF_FORM_FIELD_READONLY
            );
            $this->_pdf->setTextFieldProperties(
                    'Field1', Zend_Pdf::PDF_FORM_FIELD_REQUIRED
            );
            $this->_pdf->setTextFieldProperties(
                    'Field1', Zend_Pdf::PDF_FORM_FIELD_NOEXPORT
            );
            $this->_pdf->setTextFieldProperties(
                    'Field1', Zend_Pdf::PDF_FORM_FIELD_READONLY
                    | Zend_Pdf::PDF_FORM_FIELD_REQUIRED
                    | Zend_Pdf::PDF_FORM_FIELD_NOEXPORT
            );
            $this->assertTrue(true); // in case of --strict
        } catch (\Exception $e) {
            $this->fail('Failed to set property of an existing text field');
        }
    }

    /**
     * Asserts setting property of non-existent field shouls throw an exception
     * 
     * @expectedException Zend_Pdf_Exception
     * @expectedExceptionMessage Field 'FieldNotExists' does not exist or is not
     *                           a textfield
     */
    public function testSetTextFieldPropertiesNonExistent()
    {
        $this->_pdf->setTextFieldProperties(
            'FieldNotExists', Zend_Pdf::PDF_FORM_FIELD_REQUIRED
        );
    }

    public function testMarkTextFieldAsReadOnly()
    {
        try {
            $this->_pdf->markTextFieldAsReadOnly('Field1');
            $this->_pdf->markTextFieldAsReadOnly('Field2');
            $this->assertTrue(true); // in case of --strict
        } catch (\Exception $e) {
            $this->fail('Failed to set an existing text field as read-only');
        }
    }

    /**
     * Asserts setting property of non-existent field shouls throw an exception
     * 
     * @expectedException Zend_Pdf_Exception
     * @expectedExceptionMessage Field 'FieldNotExists' does not exist or is not
     *                           a textfield
     */
    public function testMarkTextFieldAsReadOnlyNonExistent()
    {
        $this->_pdf->markTextFieldAsReadOnly('FieldNotExists');
    }

    public function testGetJavasriptNull()
    {
        // getting JavaScript without setting it returns NULL
        $pdf = new Zend_Pdf();
        $this->assertNull($pdf->getJavaScript());
    }

    public function testSetAndGetJavasriptArray()
    {
        // getting JavaScript after setting it returns array
        $pdf = new Zend_Pdf();
        $pdf->setJavaScript('print();');
        $this->assertTrue(is_array($pdf->getJavaScript()));
    }

    public function testSetJavaScriptString()
    {
        // setting string value is possible
        $pdf = new Zend_Pdf();
        $javaScriptString = 'print();';
        $pdf->setJavaScript($javaScriptString);
        $javaScript = $pdf->getJavaScript();
        $this->assertEquals($javaScriptString, $javaScript[0]);
    }

    public function testSetJavaScriptArray()
    {
        // setting string value is possible
        $pdf = new Zend_Pdf();
        $javaScriptArray = ['print();', 'alert();'];
        $pdf->setJavaScript($javaScriptArray);
        $this->assertEquals($javaScriptArray, $pdf->getJavaScript());
    }

    public function testResetJavaScript()
    {
        // reset removes the added JavaScript
        $pdf = new Zend_Pdf();
        $pdf->setJavaScript('print();');
        $pdf->resetJavaScript();
        $this->assertNull($pdf->getJavaScript());
    }

    public function testAddJavaScript()
    {
        // adding JavaScript appends previously added JavaScript
        $pdf = new Zend_Pdf();
        $javaScriptArray = ['print();', 'alert();'];
        $pdf->addJavaScript($javaScriptArray[0]);
        $pdf->addJavaScript($javaScriptArray[1]);
        $this->assertEquals($javaScriptArray, $pdf->getJavaScript());
    }

    /**
     * Asserts setting empty JavaScript string throws exception
     * 
     * @expectedException Zend_Pdf_Exception
     * @expectedExceptionMessage JavaScript must be a non empty string or array
     *                           of strings
     */
    public function testSetJavaScriptEmptyString()
    {
        $pdf = new Zend_Pdf();
        $pdf->setJavaScript('');
    }

    /**
     * Asserts setting empty JavaScript array throws exception
     * 
     * @expectedException Zend_Pdf_Exception
     * @expectedExceptionMessage JavaScript must be a non empty string or array
     *                           of strings
     */
    public function testSetJavaScriptEmptyArray()
    {
        $pdf = new Zend_Pdf();
        $pdf->setJavaScript([]);
    }

    public function testSetAndSaveLoadAndGetJavaScript()
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'PdfUnitFile');
        $javaScript = ['print();', 'alert();'];

        $pdf = new Zend_Pdf();
        $pdf->setJavaScript($javaScript);
        $pdf->save($tempFile);
        unset($pdf);

        $pdf = Zend_Pdf::load($tempFile);
        unlink($tempFile);

        $this->assertEquals($javaScript, $pdf->getJavaScript());
    }

    public function testSetAndSaveLoadAndResetAndSaveLoadAndGetJavaScript()
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'PdfUnitFile');
        $javaScript = ['print();', 'alert();'];

        $pdf = new Zend_Pdf();
        $pdf->setJavaScript($javaScript);
        $pdf->save($tempFile);
        unset($pdf);

        $pdf = Zend_Pdf::load($tempFile);
        unlink($tempFile);

        $pdf->resetJavaScript();
        $pdf->save($tempFile);
        unset($pdf);

        $pdf = Zend_Pdf::load($tempFile);
        unlink($tempFile);

        $this->assertNull($pdf->getJavaScript());
    }
}
