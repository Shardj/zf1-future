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
 * @package    Zend_Dojo
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_Dom_QueryTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Dom_QueryTest::main");
}

/** Zend_Dom_Query */
require_once 'Zend/Dom/Query.php';

/**
 * Test class for Zend_Dom_Query.
 *
 * @category   Zend
 * @package    Zend_Dom
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Dom
 */
class Zend_Dom_QueryTest extends PHPUnit_Framework_TestCase
{
    public $html;

    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("Zend_Dom_QueryTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->query = new Zend_Dom_Query();
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    public function tearDown()
    {
    }

    public function getHtml()
    {
        if (null === $this->html) {
            $this->html  = file_get_contents(dirname(__FILE__) . '/_files/sample.xhtml');
        }
        return $this->html;
    }

    public function loadHtml()
    {
        $this->query->setDocument($this->getHtml());
    }

    public function handleError($msg, $code = 0)
    {
        $this->error = $msg;
    }

    public function testConstructorShouldNotRequireArguments()
    {
        $query = new Zend_Dom_Query();
    }

    public function testConstructorShouldAcceptDocumentString()
    {
        $html  = $this->getHtml();
        $query = new Zend_Dom_Query($html);
        $this->assertSame($html, $query->getDocument());
    }

    public function testDocShouldBeNullByDefault()
    {
        $this->assertNull($this->query->getDocument());
    }

    public function testDocShouldBeNullByEmptyStringConstructor()
    {
        $emptyStr = "";
        $query = new Zend_Dom_Query($emptyStr);
        $this->assertNull($this->query->getDocument());
    }

    public function testDocShouldBeNullByEmptyStringSet()
    {
        $emptyStr = "";
        $this->query->setDocument($emptyStr);
        $this->assertNull($this->query->getDocument());
    }

    public function testDocTypeShouldBeNullByDefault()
    {
        $this->assertNull($this->query->getDocumentType());
    }

    public function testShouldAllowSettingDocument()
    {
        $this->testDocShouldBeNullByDefault();
        $this->loadHtml();
        $this->assertEquals($this->getHtml(), $this->query->getDocument());
    }

    public function testDocumentTypeShouldBeAutomaticallyDiscovered()
    {
        $this->loadHtml();
        $this->assertEquals(Zend_Dom_Query::DOC_XHTML, $this->query->getDocumentType());
        $this->query->setDocument('<?xml version="1.0"?><root></root>');
        $this->assertEquals(Zend_Dom_Query::DOC_XML, $this->query->getDocumentType());
        $this->query->setDocument('<html><body></body></html>');
        $this->assertEquals(Zend_Dom_Query::DOC_HTML, $this->query->getDocumentType());
        $this->query->setDocument(new DOMDocument());
        $this->assertEquals(Zend_Dom_Query::DOC_DOM, $this->query->getDocumentType());
    }

    public function testQueryingWithoutRegisteringDocumentShouldThrowException()
    {
        try {
            $this->query->query('.foo');
            $this->fail('Querying without registering document should throw exception');
        } catch (Zend_Dom_Exception $e) {
            $this->assertContains('no document', $e->getMessage());
        }
    }

    public function testQueryingInvalidDocumentShouldThrowException()
    {
        set_error_handler([$this, 'handleError']);
        $this->query->setDocumentXml('some bogus string');
        try {
            $this->query->query('.foo');
            restore_error_handler();
            $this->fail('Querying invalid document should throw exception');
        } catch (Zend_Dom_Exception $e) {
            restore_error_handler();
            $this->assertContains('Error parsing', $e->getMessage());
        }
    }

    public function testQueryShouldReturnResultObject()
    {
        $this->loadHtml();
        $test = $this->query->query('.foo');
        $this->assertTrue($test instanceof Zend_Dom_Query_Result);
    }

    public function testResultShouldIndicateNumberOfFoundNodes()
    {
        $this->loadHtml();
        $result  = $this->query->query('.foo');
        $message = 'Xpath: ' . $result->getXpathQuery() . "\n";
        $this->assertEquals(3, count($result), $message);
    }

    public function testResultShouldAllowIteratingOverFoundNodes()
    {
        $this->loadHtml();
        $result = $this->query->query('.foo');
        $this->assertEquals(3, count($result));
        foreach ($result as $node) {
            $this->assertTrue($node instanceof DOMNode, var_export($result, 1));
        }
    }

    public function testQueryShouldFindNodesWithMultipleClasses()
    {
        $this->loadHtml();
        $result = $this->query->query('.footerblock .last');
        $this->assertEquals(1, count($result), $result->getXpathQuery());
    }

    public function testQueryShouldFindNodesWithArbitraryAttributeSelectorsExactly()
    {
        $this->loadHtml();
        $result = $this->query->query('div[dojoType="FilteringSelect"]');
        $this->assertEquals(1, count($result), $result->getXpathQuery());
    }

    public function testQueryShouldFindNodesWithArbitraryAttributeSelectorsAsDiscreteWords()
    {
        $this->loadHtml();
        $result = $this->query->query('li[dojoType~="bar"]');
        $this->assertEquals(2, count($result), $result->getXpathQuery());
    }

    public function testQueryShouldFindNodesWithArbitraryAttributeSelectorsAndAttributeValue()
    {
        $this->loadHtml();
        $result = $this->query->query('li[dojoType*="bar"]');
        $this->assertEquals(2, count($result), $result->getXpathQuery());
    }

    public function testQueryXpathShouldAllowQueryingArbitraryUsingXpath()
    {
        $this->loadHtml();
        $result = $this->query->queryXpath('//li[contains(@dojotype, "bar")]');
        $this->assertEquals(2, count($result), $result->getXpathQuery());
    }

    public function testQueryOnDomDocument()
    {
        $xml = <<<EOF
<?xml version="1.0" encoding="UTF-8" ?>
<foo>
    <bar class="baz"/>
</foo>
EOF;
        $document = new DOMDocument();
        $document->loadXML($xml, 524288 /* LIBXML_PARSEHUGE */);
        $this->query->setDocument($document);
        $test = $this->query->query('.baz');
        $this->assertTrue($test instanceof Zend_Dom_Query_Result);
        $testDocument = $test->getDocument();
        $this->assertTrue($testDocument instanceof DOMDocument);
        $this->assertEquals('UTF-8', $testDocument->encoding);
    }

    /**
     * @group ZF-9243
     */
    public function testLoadingDocumentWithErrorsShouldNotRaisePhpErrors()
    {
        $file = file_get_contents(dirname(__FILE__) . '/_files/bad-sample.html');
        $this->query->setDocument($file);
        $this->query->query('p');
        $errors = $this->query->getDocumentErrors();
        $this->assertTrue(is_array($errors));
        $this->assertTrue(0 < count($errors));
    }

    /**
     * @group ZF-9765
     */
    public function testCssSelectorShouldFindNodesWhenMatchingMultipleAttributes()
    {
        $html = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
  <form action="#" method="get">
    <input type="hidden" name="foo" value="1" id="foo"/>
    <input type="hidden" name="bar" value="0" id="bar"/>
    <input type="hidden" name="baz" value="1" id="baz"/>
  </form>
</body>
</html>
EOF;

        $this->query->setDocument($html);
        $results = $this->query->query('input[type="hidden"][value="1"]');
        $this->assertEquals(2, count($results), $results->getXpathQuery());
        $results = $this->query->query('input[value="1"][type~="hidden"]');
        $this->assertEquals(2, count($results), $results->getXpathQuery());
        $results = $this->query->query('input[type="hidden"][value="0"]');
        $this->assertEquals(1, count($results));
    }

    /**
     * @group ZF-3938
     */
    public function testAllowsSpecifyingEncodingAtConstruction()
    {
        $doc = new Zend_Dom_Query($this->getHtml(), 'iso-8859-1');
        $this->assertEquals('iso-8859-1', $doc->getEncoding());
    }

    /**
     * @group ZF-3938
     */
    public function testAllowsSpecifyingEncodingWhenSettingDocument()
    {
        $this->query->setDocument($this->getHtml(), 'iso-8859-1');
        $this->assertEquals('iso-8859-1', $this->query->getEncoding());
    }

    /**
     * @group ZF-3938
     */
    public function testAllowsSpecifyingEncodingViaSetter()
    {
        $this->query->setEncoding('iso-8859-1');
        $this->assertEquals('iso-8859-1', $this->query->getEncoding());
    }

    /**
     * @group ZF-3938
     */
    public function testSpecifyingEncodingSetsEncodingOnDomDocument()
    {
        $this->query->setDocument($this->getHtml(), 'utf-8');
        $test = $this->query->query('.foo');
        $this->assertTrue($test instanceof Zend_Dom_Query_Result);
        $doc  = $test->getDocument();
        $this->assertTrue($doc instanceof DOMDocument);
        $this->assertEquals('utf-8', $doc->encoding);
    }
    
    /**
     * @group ZF-11376
     */
    public function testXhtmlDocumentWithXmlDeclaration()
    {
        $xhtmlWithXmlDecl = <<<EOB
<?xml version="1.0" encoding="UTF-8" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head><title /></head>
    <body><p>Test paragraph.</p></body>
</html>
EOB;
        $this->query->setDocument($xhtmlWithXmlDecl, 'utf-8');
        $this->assertEquals(1, $this->query->query('//p')->count());
    }
    
    /**
     * @group ZF-12106
     */
    public function testXhtmlDocumentWithXmlAndDoctypeDeclaration()
    {
        $xhtmlWithXmlDecl = <<<EOB
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Virtual Library</title>
  </head>
  <body>
    <p>Moved to <a href="http://example.org/">example.org</a>.</p>
  </body>
</html>
EOB;
        $this->query->setDocument($xhtmlWithXmlDecl, 'utf-8');
        $this->assertEquals(1, $this->query->query('//p')->count());
    }

    public function testLoadingXmlContainingDoctypeShouldFailToPreventXxeAndXeeAttacks()
    {
        $xml = <<<XML
<?xml version="1.0"?>
<!DOCTYPE results [<!ENTITY harmless "completely harmless">]>
<results>
    <result>This result is &harmless;</result>
</results>
XML;
        $this->query->setDocumentXml($xml);
        $this->setExpectedException("Zend_Dom_Exception");
        $this->query->queryXpath('/');
    }
}

// Call Zend_Dom_QueryTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_Dom_QueryTest::main") {
    Zend_Dom_QueryTest::main();
}
