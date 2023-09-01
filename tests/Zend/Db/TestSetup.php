<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

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
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Loader
 */
require_once 'Zend/Loader.php';

/**
 * @see Zend_Db
 */
require_once 'Zend/Db.php';


/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Db
 */
abstract class Zend_Db_TestSetup extends TestCase
{
    /**
     * @var Zend_Db_TestUtil_Common
     */
    protected $_util = null;

    /**
     * @var Zend_Db_Adapter_Abstract
     */
    protected $_db = null;

    abstract public function getDriver();

    /**
     * Subclasses should call parent::set_up() before
     * doing their own logic, e.g. creating metadata.
     */
    protected function set_up()
    {
        $this->_setUpTestUtil();
        $this->_setUpAdapter();
        $this->_util->set_up($this->_db);
    }

    /**
     * Get a TestUtil class for the current RDBMS brand.
     */
    protected function _setUpTestUtil()
    {
        $driver = $this->getDriver();
        $utilClass = "Zend_Db_TestUtil_{$driver}";
        Zend_Loader::loadClass($utilClass);
        $this->_util = new $utilClass();
    }

    /**
     * Open a new database connection
     */
    protected function _setUpAdapter()
    {
        try {
            $this->_db = Zend_Db::factory($this->getDriver(), $this->_util->getParams());
            $this->_db->getConnection();
        } catch (Zend_Exception $e) {
            $this->_db = null;
            $this->assertTrue(
                $e instanceof Zend_Db_Adapter_Exception,
                'Expecting Zend_Db_Adapter_Exception, got ' . get_class($e)
            );
            $this->markTestSkipped($e->getMessage());
        } catch (Throwable $e) {
            // DB2 constants
            if (stristr($e->getMessage(), 'undefined constant')) {
                $this->markTestSkipped($e->getMessage());
            }
        }
    }

    /**
     * Subclasses should call parent::tear_down() after
     * doing their own logic, e.g. deleting metadata.
     */
    protected function tear_down()
    {
        $this->_util->tear_down();
        $this->_db->closeConnection();
        $this->_db = null;
    }
}
