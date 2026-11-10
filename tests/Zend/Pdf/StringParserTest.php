<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

require_once 'Zend/Pdf/StringParser.php';
require_once 'Zend/Pdf/ElementFactory.php';

/**
 * @category   Zend
 * @package    Zend_Pdf
 * @subpackage UnitTests
 * @group      Zend_Pdf
 */
class Zend_Pdf_StringParserTest extends TestCase
{
    /**
     * @dataProvider commentProvider
     */
    public function testSkipCommentStopsAtTheEndOfTheLine($data, $expectedOffset)
    {
        $parser = new Zend_Pdf_StringParser($data, Zend_Pdf_ElementFactory::createFactory(1));
        $parser->offset = 0;

        $parser->skipComment();

        $this->assertSame($expectedOffset, $parser->offset);
    }

    public function commentProvider()
    {
        return [
            'line feed'             => ["% comment\n1 0 obj", 9],
            'carriage return'       => ["% comment\r1 0 obj", 9],
            'carriage return, feed' => ["% comment\r\n1 0 obj", 9],
            'end of data'           => ['% comment', 9],
        ];
    }
}
