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
 * @package    Zend_Service_LiveDocx
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: $
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Service_LiveDocx_MailMergeTest::main');
}

require_once 'Zend/Service/LiveDocx/MailMerge.php';

/**
 * Zend_Service_LiveDocx test case
 *
 * @category   Zend
 * @package    Zend_Service_LiveDocx
 * @subpackage UnitTests
 * @group      Zend_Service
 * @group      Zend_Service_LiveDocx
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: $
 */
class Zend_Service_LiveDocx_MailMergeTest extends PHPUnit_Framework_TestCase
{
    const TEST_TEMPLATE_1 = 'phpunit-template.docx';
    const TEST_TEMPLATE_2 = 'phpunit-template-block-fields.doc';
    const TEST_IMAGE_1 = 'image-01.png';
    const TEST_IMAGE_2 = 'image-02.png';
    const ENDPOINT = 'https://api.livedocx.com/2.0/mailmerge.asmx?wsdl';

    public $path;
    public $phpLiveDocx;

    // -------------------------------------------------------------------------

    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        if (!constant('TESTS_ZEND_SERVICE_LIVEDOCX_USERNAME')
            || !constant('TESTS_ZEND_SERVICE_LIVEDOCX_PASSWORD')
        ) {
            $this->markTestSkipped('LiveDocx tests disabled');
            return;
        }

        $this->phpLiveDocx = new Zend_Service_LiveDocx_MailMerge();
        $this->phpLiveDocx->setUsername(TESTS_ZEND_SERVICE_LIVEDOCX_USERNAME)
                          ->setPassword(TESTS_ZEND_SERVICE_LIVEDOCX_PASSWORD);

        foreach($this->phpLiveDocx->listTemplates() as $template) {
            $this->phpLiveDocx->deleteTemplate($template['filename']);
        }

        $this->path = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'MailMerge');
    }

    public function tearDown()
    {
	if (isset($this->phpLiveDocx)) {
	    foreach($this->phpLiveDocx->listTemplates() as $template) {
		$this->phpLiveDocx->deleteTemplate($template['filename']);
	    }

	    unset($this->phpLiveDocx);
	}
    }

    // -------------------------------------------------------------------------

    public function testLoginUsernamePassword()
    {
        $phpLiveDocx = new Zend_Service_LiveDocx_MailMerge();
        $phpLiveDocx->setUsername(TESTS_ZEND_SERVICE_LIVEDOCX_USERNAME);
        $phpLiveDocx->setPassword(TESTS_ZEND_SERVICE_LIVEDOCX_PASSWORD);
        $this->assertTrue($phpLiveDocx->logIn());
    }

    public function testLoginUsernamePasswordSoapClient()
    {
        $phpLiveDocx = new Zend_Service_LiveDocx_MailMerge();
        $phpLiveDocx->setUsername(TESTS_ZEND_SERVICE_LIVEDOCX_USERNAME);
        $phpLiveDocx->setPassword(TESTS_ZEND_SERVICE_LIVEDOCX_PASSWORD);
        $phpLiveDocx->setSoapClient(new Zend_Soap_Client(self::ENDPOINT));
        $this->assertTrue($phpLiveDocx->logIn());
    }

    /**
     * @expectedException Zend_Service_LiveDocx_Exception
     */
    public function testLoginUsernamePasswordException()
    {
        $phpLiveDocx = new Zend_Service_LiveDocx_MailMerge();
        $phpLiveDocx->setUsername('phpunitInvalidUsername');
        $phpLiveDocx->setPassword('phpunitInvalidPassword');
        $phpLiveDocx->logIn();
    }

    /**
     * @expectedException Zend_Service_LiveDocx_Exception
     */
    public function testLoginUsernamePasswordSoapClientException()
    {
        $phpLiveDocx = new Zend_Service_LiveDocx_MailMerge();
        $phpLiveDocx->setUsername('phpunitInvalidUsername');
        $phpLiveDocx->setPassword('phpunitInvalidPassword');
        $phpLiveDocx->setSoapClient(new Zend_Soap_Client(self::ENDPOINT));
        $phpLiveDocx->logIn();
    }

    public function testConstructorOptionsUsernamePassword()
    {
        $phpLiveDocx = new Zend_Service_LiveDocx_MailMerge(
            [
                'username' => TESTS_ZEND_SERVICE_LIVEDOCX_USERNAME,
                'password' => TESTS_ZEND_SERVICE_LIVEDOCX_PASSWORD
            ]
        );
        $this->assertTrue($phpLiveDocx->logIn());
    }

    public function testConstructorOptionsUsernamePasswordSoapClient()
    {
        $phpLiveDocx = new Zend_Service_LiveDocx_MailMerge(
            [
                'username' => TESTS_ZEND_SERVICE_LIVEDOCX_USERNAME,
                'password' => TESTS_ZEND_SERVICE_LIVEDOCX_PASSWORD,
                'soapClient' => new Zend_Soap_Client(self::ENDPOINT)
            ]
        );
        $this->assertTrue($phpLiveDocx->logIn());
    }

    // -------------------------------------------------------------------------

    public function testSetLocalTemplate()
    {
        $this->assertTrue(is_a($this->phpLiveDocx->setLocalTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1), 'Zend_Service_LiveDocx_MailMerge'));
        $this->setExpectedException('Zend_Service_LiveDocx_Exception');
        @$this->phpLiveDocx->setLocalTemplate('phpunit-nonexistent.doc');
    }

    public function testSetRemoteTemplate()
    {
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->assertTrue(is_a($this->phpLiveDocx->setRemoteTemplate(self::TEST_TEMPLATE_1), 'Zend_Service_LiveDocx_MailMerge'));
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_1);
    }

    public function testSetFieldValues()
    {
        $testValues = ['software' => 'phpunit'];

        // Remote Template
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->setRemoteTemplate(self::TEST_TEMPLATE_1);
        $this->assertTrue(is_a($this->phpLiveDocx->setFieldValues($testValues), 'Zend_Service_LiveDocx_MailMerge'));
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_1);

        // Local Template
        $this->phpLiveDocx->setLocalTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->assertTrue(is_a($this->phpLiveDocx->setFieldValues($testValues), 'Zend_Service_LiveDocx_MailMerge'));
    }

    public function testSetFieldValue()
    {
        $testKey   = 'software';
        $testValue = 'phpunit';

        // Remote Template
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->assertTrue(is_a($this->phpLiveDocx->setFieldValue($testKey, $testValue), 'Zend_Service_LiveDocx_MailMerge'));
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_1);

        // Local Template
        $this->phpLiveDocx->setLocalTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->assertTrue(is_a($this->phpLiveDocx->setFieldValue($testKey, $testValue), 'Zend_Service_LiveDocx_MailMerge'));
    }

    public function testAssign()
    {
        $testKey   = 'software';
        $testValue = 'phpunit';

        // Remote Template
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->assertTrue(is_a($this->phpLiveDocx->assign($testKey, $testValue), 'Zend_Service_LiveDocx_MailMerge'));
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_1);

        // Local Template
        $this->phpLiveDocx->setLocalTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->assertTrue(is_a($this->phpLiveDocx->assign($testKey, $testValue), 'Zend_Service_LiveDocx_MailMerge'));
    }

    public function testSetBlockFieldValues()
    {
        $testKey    = 'connection';
        $testValues = [['connection_number' => 'unittest', 'connection_duration' => 'unittest', 'fee' => 'unittest'],
                            ['connection_number' => 'unittest', 'connection_duration' => 'unittest', 'fee' => 'unittest'],
                            ['connection_number' => 'unittest', 'connection_duration' => 'unittest', 'fee' => 'unittest'],
                            ['connection_number' => 'unittest', 'connection_duration' => 'unittest', 'fee' => 'unittest'] ];

        // Remote Template
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_2);
        $this->assertTrue(is_a($this->phpLiveDocx->setBlockFieldValues($testKey, $testValues), 'Zend_Service_LiveDocx_MailMerge'));
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_2);

        // Local Template
        $this->phpLiveDocx->setLocalTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_2);
        $this->assertTrue(is_a($this->phpLiveDocx->setBlockFieldValues($testKey, $testValues), 'Zend_Service_LiveDocx_MailMerge'));
    }

    // -------------------------------------------------------------------------

    public function testCreateDocument()
    {
        $testValues = [
            'software' => 'phpunit',
            'licensee' => 'phpunit',
            'company'  => 'phpunit',
            'date'     => 'phpunit',
            'time'     => 'phpunit',
            'city'     => 'phpunit',
            'country'  => 'phpunit',
        ];

        // Remote Template
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->setRemoteTemplate(self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->assign($testValues);
        $this->assertNull($this->phpLiveDocx->createDocument());
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_1);

        // Local Template
        $this->phpLiveDocx->setLocalTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->assign($testValues);
        $this->assertNull($this->phpLiveDocx->createDocument());
    }

    public function testRetrieveDocument()
    {
        $testValues = [
            'software' => 'phpunit',
            'licensee' => 'phpunit',
            'company'  => 'phpunit',
            'date'     => 'phpunit',
            'time'     => 'phpunit',
            'city'     => 'phpunit',
            'country'  => 'phpunit',
        ];

        // PDF and DOCs are always slightly different:
        // - PDF because of the timestamp in meta data
        // - DOC because of ???

        $expectedResults = [
            'docx' => 'f21728491855c27a9e64a47266c2a720',
            'rtf'  => 'fb75deabf481b0264927cb4a5c9db765',
            'txd'  => 'd1f645405ded0718edff6ae6f50a496e',
            'txt'  => 'ec2f680646540edd79cd22773fa7e183',
            'html' => 'e3a28523794b0071501c09f791f8c795',
        ];

        // Remote Template
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->setRemoteTemplate(self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->assign($testValues);
        $this->phpLiveDocx->createDocument();
        foreach($expectedResults as $format => $hash) {
            $document = $this->phpLiveDocx->retrieveDocument($format);
            $this->assertEquals($hash, md5($document));
        }
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_1);

        // Local Template
        $this->phpLiveDocx->setLocalTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->assign($testValues);
        $this->phpLiveDocx->createDocument();
        foreach($expectedResults as $format => $hash) {
            $document = $this->phpLiveDocx->retrieveDocument($format);
            $this->assertEquals($hash, md5($document));
        }
    }

    public function testRetrieveDocumentAppended()
    {
        $testValues = [
            [
                'software' => 'phpunit - document 1',
                'licensee' => 'phpunit - document 1',
                'company'  => 'phpunit - document 1',
                'date'     => 'phpunit - document 1',
                'time'     => 'phpunit - document 1',
                'city'     => 'phpunit - document 1',
                'country'  => 'phpunit - document 1',
            ],
            [
                'software' => 'phpunit - document 2',
                'licensee' => 'phpunit - document 2',
                'company'  => 'phpunit - document 2',
                'date'     => 'phpunit - document 2',
                'time'     => 'phpunit - document 2',
                'city'     => 'phpunit - document 2',
                'country'  => 'phpunit - document 2',
            ],
        ];

        // PDF and DOCs are always slightly different:
        // - PDF because of the timestamp in meta data
        // - DOC because of ???
        $expectedResults = [
            'docx' => '2757b4d10c8c031d8f501231be39fcfe',
            'rtf'  => '2997e531011d826f315291fca1351988',
            'txd'  => '8377a5a62f2e034974fc299c322d137f',
            'txt'  => 'a7d23668f81b314e15d653ab657316f9',
            'html' => '57365a2ff02347a7863626317505e037',
        ];

        // Remote Template
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->setRemoteTemplate(self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->assign($testValues);
        $this->phpLiveDocx->createDocument();
        foreach($expectedResults as $format => $hash) {
            $document = $this->phpLiveDocx->retrieveDocument($format);
            $this->assertEquals($hash, md5($document));
        }
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_1);

        // Local Template
        $this->phpLiveDocx->setLocalTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->assign($testValues);
        $this->phpLiveDocx->createDocument();
        foreach($expectedResults as $format => $hash) {
            $document = $this->phpLiveDocx->retrieveDocument($format);
            $this->assertEquals($hash, md5($document));
        }
    }

    // -------------------------------------------------------------------------

    public function testGetTemplateFormats()
    {
        $expectedResults = ['doc' , 'docx' , 'rtf' , 'txd'];
        $this->assertEquals($expectedResults, $this->phpLiveDocx->getTemplateFormats());
    }

    public function testGetDocumentFormats()
    {
        $expectedResults = ['doc' , 'docx' , 'html' , 'pdf' , 'rtf' , 'txd' , 'txt'];
        $this->assertEquals($expectedResults, $this->phpLiveDocx->getDocumentFormats());
    }

    public function testGetImageImportFormats()
    {
        $expectedResults = ['bmp' , 'gif' , 'jpg' , 'png' , 'tiff', 'wmf'];
        $this->assertEquals($expectedResults, $this->phpLiveDocx->getImageImportFormats());
    }

    public function testGetImageExportFormats()
    {
        $expectedResults = ['bmp' , 'gif' , 'jpg' , 'png' , 'tiff'];
        $this->assertEquals($expectedResults, $this->phpLiveDocx->getImageExportFormats());
    }

    // -------------------------------------------------------------------------

    public function testGetBitmaps()
    {
        $testValues = [
            'software' => 'phpunit',
            'licensee' => 'phpunit',
            'company'  => 'phpunit',
            'date'     => 'phpunit',
            'time'     => 'phpunit',
            'city'     => 'phpunit',
            'country'  => 'phpunit',
        ];

        $expectedResults = [
            'bmp'  => 'a1934f2153172f021847af7ece9049ce',
            'gif'  => 'd7281d7b6352ff897917e25d6b92746f',
            'jpg'  => 'e0b20ea2c9a6252886f689f227109085',
            'png'  => 'c449f0c2726f869e9a42156e366f1bf9',
            'tiff' => '20a96a94762a531e9879db0aa6bd673f',
        ];

        $this->phpLiveDocx->setLocalTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->assign($testValues);
        $this->phpLiveDocx->createDocument();
        foreach($this->phpLiveDocx->getImageExportFormats() as $format) {
            $bitmaps = $this->phpLiveDocx->getBitmaps(1, 1, 20, $format);
            $this->assertEquals($expectedResults[$format], md5(serialize($bitmaps)));
        }
    }

    public function testGetAllBitmaps()
    {
        $testValues = [
            'software' => 'phpunit',
            'licensee' => 'phpunit',
            'company'  => 'phpunit',
            'date'     => 'phpunit',
            'time'     => 'phpunit',
            'city'     => 'phpunit',
            'country'  => 'phpunit',
        ];

        $expectedResults = [
            'bmp'  => 'e8a884ee61c394deec8520fb397d1cf1',
            'gif'  => '2255fee47b4af8438b109efc3cb0d304',
            'jpg'  => 'e1acfc3001fc62567de2a489eccdb552',
            'png'  => '15eac34d08e602cde042862b467fa865',
            'tiff' => '98bad79380a80c9cc43dfffc5158d0f9',
        ];

        $this->phpLiveDocx->setLocalTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->assign($testValues);
        $this->phpLiveDocx->createDocument();
        foreach($this->phpLiveDocx->getImageExportFormats() as $format) {
            $bitmaps = $this->phpLiveDocx->getAllBitmaps(20, $format);
            $this->assertEquals($expectedResults[$format], md5(serialize($bitmaps)));
        }
    }

    public function testGetFontNames()
    {
        $fonts = $this->phpLiveDocx->getFontNames();
        if (is_array($fonts) && count($fonts) > 5) {
            foreach (['Courier New' , 'Verdana' , 'Arial' , 'Times New Roman'] as $font) {
                if (in_array($font, $fonts)) {
                    $this->assertTrue(true);
                } else {
                    $this->assertTrue(false);
                }
            }
        } else {
            $this->assertTrue(false);
        }
    }

    public function testGetFieldNames()
    {
        $expectedResults = ['phone', 'date', 'name', 'customer_number', 'invoice_number', 'account_number', 'service_phone', 'service_fax', 'month', 'monthly_fee', 'total_net', 'tax', 'tax_value', 'total'];

        // Remote Template
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_2);
        $this->phpLiveDocx->setRemoteTemplate(self::TEST_TEMPLATE_2);
        $this->assertEquals($expectedResults, $this->phpLiveDocx->getFieldNames());
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_2);

        // Local Template
        $this->phpLiveDocx->setLocalTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_2);
        $this->assertEquals($expectedResults, $this->phpLiveDocx->getFieldNames());
    }

    public function testGetBlockFieldNames()
    {
        $expectedResults = ['connection_number', 'connection_duration', 'fee'];

        // Remote Template
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_2);
        $this->phpLiveDocx->setRemoteTemplate(self::TEST_TEMPLATE_2);
        $this->assertEquals($expectedResults, $this->phpLiveDocx->getBlockFieldNames('connection'));
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_2);

        // Local Template
        $this->phpLiveDocx->setLocalTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_2);
        $this->assertEquals($expectedResults, $this->phpLiveDocx->getBlockFieldNames('connection'));
    }

    public function testGetBlockNames()
    {
        $expectedResults = ['connection'];

        // Remote Template
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_2);
        $this->phpLiveDocx->setRemoteTemplate(self::TEST_TEMPLATE_2);
        $this->assertEquals($expectedResults, $this->phpLiveDocx->getBlockNames());
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_2);

        // Local Template
        $this->phpLiveDocx->setLocalTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_2);
        $this->assertEquals($expectedResults, $this->phpLiveDocx->getBlockNames());
    }

    // -------------------------------------------------------------------------

    public function testUploadTemplate()
    {
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_2);
        $this->assertNull($this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_2));
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_2);
    }

    public function testDownloadTemplate()
    {
        $expectedResults = '2f076af778ca5f8afc9661cfb9deb7c6';
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_2);
        $template = $this->phpLiveDocx->downloadTemplate(self::TEST_TEMPLATE_2);
        $this->assertEquals($expectedResults, md5($template));
    }

    public function testDeleteTemplate()
    {
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_2);
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_2);
        $templateDeleted = true;
        foreach($this->phpLiveDocx->listTemplates() as $template) {
            if($template['filename'] == self::TEST_TEMPLATE_2) {
                $templateDeleted = false;
            }
        }
        $this->assertTrue($templateDeleted);
    }

    public function testListTemplates()
    {
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_2);

        // Where templates uploaded and are being listed?
        $testTemplate1Exists = false;
        $testTemplate2Exists = false;

        $templates = $this->phpLiveDocx->listTemplates();
        foreach($templates as $template) {
            if(self::TEST_TEMPLATE_1 === $template['filename']) {
                $testTemplate1Exists = true;
            } elseif(self::TEST_TEMPLATE_2 === $template['filename']) {
                $testTemplate2Exists = true;
            }
        }
        $this->assertTrue($testTemplate1Exists && $testTemplate2Exists);

        // Is all info about templates available?
        $expectedResults = ['filename', 'fileSize', 'createTime', 'modifyTime'];
        foreach($templates as $template) {
            $this->assertEquals($expectedResults, array_keys($template));
        }

        // Is all info about templates correct?
        foreach($templates as $template) {
            $this->assertTrue(strlen($template['filename']) > 0);
            $this->assertTrue($template['fileSize'] > 1);
            $this->assertTrue($template['createTime'] > mktime(0, 0, 0, 1, 1, 1980));
            $this->assertTrue($template['modifyTime'] > mktime(0, 0, 0, 1, 1, 1980));
        }

        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_1);
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_2);
    }

    public function testTemplateExists()
    {
        $this->phpLiveDocx->uploadTemplate($this->path . DIRECTORY_SEPARATOR . self::TEST_TEMPLATE_2);
        $this->assertTrue($this->phpLiveDocx->templateExists(self::TEST_TEMPLATE_2));
        $this->phpLiveDocx->deleteTemplate(self::TEST_TEMPLATE_2);
    }

    // -------------------------------------------------------------------------

    public function testUploadImage()
    {
        $this->phpLiveDocx->deleteImage(self::TEST_IMAGE_2);
        $this->assertNull($this->phpLiveDocx->uploadImage($this->path . DIRECTORY_SEPARATOR . self::TEST_IMAGE_2));
        $this->phpLiveDocx->deleteImage(self::TEST_IMAGE_2);
    }

    public function testDownloadImage()
    {
        $expectedResults = 'f8b663e465acd570414395d5c33541ab';
        $this->phpLiveDocx->uploadImage($this->path . DIRECTORY_SEPARATOR . self::TEST_IMAGE_2);
        $image = $this->phpLiveDocx->downloadImage(self::TEST_IMAGE_2);
        $this->assertEquals($expectedResults, md5($image));
    }

    public function testDeleteImage()
    {
        $this->phpLiveDocx->uploadImage($this->path . DIRECTORY_SEPARATOR . self::TEST_IMAGE_2);
        $this->phpLiveDocx->deleteImage(self::TEST_IMAGE_2);
        $imageDeleted = true;
        foreach($this->phpLiveDocx->listImages() as $image) {
            if($image['filename'] == self::TEST_IMAGE_2) {
                $imageDeleted = false;
            }
        }
        $this->assertTrue($imageDeleted);
    }

    public function testListImages()
    {
        $this->phpLiveDocx->uploadImage($this->path . DIRECTORY_SEPARATOR . self::TEST_IMAGE_1);
        $this->phpLiveDocx->uploadImage($this->path . DIRECTORY_SEPARATOR . self::TEST_IMAGE_2);

        // Where images uploaded and are being listed?
        $testImage1Exists = false;
        $testImage2Exists = false;

        $images = $this->phpLiveDocx->listImages();
        foreach($images as $image) {
            if(self::TEST_IMAGE_1 === $image['filename']) {
                $testImage1Exists = true;
            } elseif(self::TEST_IMAGE_2 === $image['filename']) {
                $testImage2Exists = true;
            }
        }
        $this->assertTrue($testImage1Exists && $testImage2Exists);

        // Is all info about images available?
        $expectedResults = ['filename', 'fileSize', 'createTime', 'modifyTime'];
        foreach($images as $image) {
            $this->assertEquals($expectedResults, array_keys($image));
        }

        // Is all info about images correct?
        foreach($images as $image) {
            $this->assertTrue(strlen($image['filename']) > 0);
            $this->assertTrue($image['fileSize'] > 1);
            $this->assertTrue($image['createTime'] > mktime(0, 0, 0, 1, 1, 1980));
            $this->assertTrue($image['modifyTime'] > mktime(0, 0, 0, 1, 1, 1980));
        }

        $this->phpLiveDocx->deleteImage(self::TEST_IMAGE_1);
        $this->phpLiveDocx->deleteImage(self::TEST_IMAGE_2);
    }

    public function testImageExists()
    {
        $this->phpLiveDocx->uploadImage($this->path . DIRECTORY_SEPARATOR . self::TEST_IMAGE_2);
        $this->assertTrue($this->phpLiveDocx->imageExists(self::TEST_IMAGE_2));
        $this->phpLiveDocx->deleteImage(self::TEST_IMAGE_2);
    }

    // -------------------------------------------------------------------------

    public function testAssocArrayToArrayOfArrayOfString()
    {
        $testValues = [
            'a' => '1',
            'b' => '2',
            'c' => '3',
        ];

        $expectedResults = [
            ['a', 'b', 'c'],
            ['1', '2', '3'],
        ];

        $actualResults = Zend_Service_LiveDocx_MailMerge::assocArrayToArrayOfArrayOfString($testValues);
        $this->assertEquals($expectedResults, $actualResults);
    }

    public function testMultiAssocArrayToArrayOfArrayOfString()
    {
        $testValues = [
            [
                'a' => '1',
                'b' => '2',
                'c' => '3',
            ],
            [
                'a' => '4',
                'b' => '5',
                'c' => '6',
            ],
            [
                'a' => '7',
                'b' => '8',
                'c' => '9',
            ],
        ];

        $expectedResults = [
            ['a', 'b', 'c'],
            ['1', '2', '3'],
            ['4', '5', '6'],
            ['7', '8', '9'],
        ];
        $actualResults = Zend_Service_LiveDocx_MailMerge::multiAssocArrayToArrayOfArrayOfString($testValues);
        $this->assertEquals($expectedResults, $actualResults);
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Service_LiveDocx_MailMergeTest::main') {
    Zend_Service_LiveDocx_MailMergeTest::main();
}
