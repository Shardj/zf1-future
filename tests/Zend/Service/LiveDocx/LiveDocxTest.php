<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;
use PHPUnit\Framework\TestSuite;
use PHPUnit\TextUI\TestRunner;

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
    define('PHPUnit_MAIN_METHOD', 'Zend_Service_LiveDocx_LiveDocxTest::main');
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
class Zend_Service_LiveDocX_LiveDocxTest extends TestCase
{
    public $phpLiveDocx;

    public static function main()
    {
        $suite = new TestSuite(__CLASS__);
        $result = (new resources_Runner())->run($suite);
    }

    protected function set_up()
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

        foreach ($this->phpLiveDocx->listTemplates() as $template) {
            $this->phpLiveDocx->deleteTemplate($template['filename']);
        }
    }

    public function tear_down()
    {
        if (isset($this->phpLiveDocx)) {
            foreach ($this->phpLiveDocx->listTemplates() as $template) {
                $this->phpLiveDocx->deleteTemplate($template['filename']);
            }
            unset($this->phpLiveDocx);
        }
    }

    public function testGetFormat()
    {
        $this->assertEquals('', $this->phpLiveDocx->getFormat('document'));
        $this->assertEquals('doc', $this->phpLiveDocx->getFormat('document.doc'));
        $this->assertEquals('doc', $this->phpLiveDocx->getFormat('document-123.doc'));
        $this->assertEquals('doc', $this->phpLiveDocx->getFormat('document123.doc'));
        $this->assertEquals('doc', $this->phpLiveDocx->getFormat('document.123.doc'));
    }

    public function testGetVersion()
    {
        $expectedResults = '2.0';
        $this->assertEquals($expectedResults, $this->phpLiveDocx->getVersion());
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Service_LiveDocx_LiveDocxTest::main') {
    Zend_Service_LiveDocx_LiveDocxTest::main();
}
