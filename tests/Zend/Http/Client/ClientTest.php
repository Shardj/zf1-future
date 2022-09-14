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
 * @package    Zend_Http
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Http/Client.php';

/**
 * @category   Zend
 * @package    Zend_Http_Client
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Http
 * @group      Zend_Http_Client
 */
class Zend_Http_Client_ClientTest extends PHPUnit_Framework_TestCase
{
    /**
     * Set up the test case
     *
     */
    protected function setUp()
    {
        $this->client = new Zend_Http_Client();
    }

    public function invalidHeaders()
    {
        return [
            'invalid-name-cr'                      => ["X-Foo-\rBar", 'value'],
            'invalid-name-lf'                      => ["X-Foo-\nBar", 'value'],
            'invalid-name-crlf'                    => ["X-Foo-\r\nBar", 'value'],
            'invalid-value-cr'                     => ['X-Foo-Bar', "value\risEvil"],
            'invalid-value-lf'                     => ['X-Foo-Bar', "value\nisEvil"],
            'invalid-value-bad-continuation'       => ['X-Foo-Bar', "value\r\nisEvil"],
            'invalid-array-value-cr'               => ['X-Foo-Bar', ["value\risEvil"]],
            'invalid-array-value-lf'               => ['X-Foo-Bar', ["value\nisEvil"]],
            'invalid-array-value-bad-continuation' => ['X-Foo-Bar', ["value\r\nisEvil"]],
        ];
    }

    /**
     * @dataProvider invalidHeaders
     * @group ZF2015-04
     */
    public function testHeadersContainingCRLFInjectionRaiseAnException($name, $value)
    {
        $this->setExpectedException('Zend_Http_Exception');
        $this->client->setHeaders([
            $name => $value,
        ]);
    }
}
