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
 * @package    Zend_Feed
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Feed
 */
require_once 'Zend/Feed.php';

/**
 * @see Zend_Http
 */
require_once 'Zend/Http/Client.php';

/**
 * @category   Zend
 * @package    Zend_Feed
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Feed
 */
class Zend_Feed_AbstractFeedTest extends PHPUnit_Framework_TestCase
{
    public $baseUri;

    public $remoteFeedNames = [];

    public function setUp()
    {
        if (!defined('TESTS_ZEND_FEED_IMPORT_ONLINE_BASEURI')
            || !constant('TESTS_ZEND_FEED_IMPORT_ONLINE_BASEURI')
        ) {
            $this->markTestSkipped('ONLINE feed tests are not enabled');
        }
        $this->baseUri = rtrim(constant('TESTS_ZEND_FEED_IMPORT_ONLINE_BASEURI'), '/');
        Zend_Feed::setHttpClient(new Zend_Http_Client());
    }

    public function tearDown()
    {
        if (!$this->baseUri) {
            return parent::tearDown();
        }

        $basePath = dirname(__FILE__) . '/_files/';
        foreach ($this->remoteFeedNames as $file) {
            $filename = $basePath . $file;
            if (!file_exists($filename)) {
                continue;
            }
            unlink($filename);
        }
    }

    public function prepareFeed($filename)
    {
        $basePath = dirname(__FILE__) . '/_files/';
        $path     = $basePath . $filename;
        $remote   = str_replace('.xml', '.remote.xml', $filename);
        $string   = file_get_contents($path);
        $string   = str_replace('XXE_URI', $this->baseUri . '/xxe-info.txt', $string);
        file_put_contents($basePath . '/' . $remote, $string);
        return $remote;
    }
}
