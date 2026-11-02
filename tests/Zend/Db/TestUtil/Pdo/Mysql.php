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
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Db_TestUtil_Mysqli
 */
require_once 'Zend/Db/TestUtil/Mysqli.php';




/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Db_TestUtil_Pdo_Mysql extends Zend_Db_TestUtil_Mysqli
{
    protected function _rawQuery($sql)
    {
        $conn = $this->_db->getConnection();
        $retval = $conn->exec($sql);
        if ($retval === false) {
            $e = $conn->error;
            require_once 'Zend/Db/Exception.php';
            throw new Zend_Db_Exception("SQL error for \"$sql\": $e");
        }
    }

    public function getParams(array $constants = [])
    {
        $constants = parent::getParams($constants);

        if (!isset($constants['driver_options'])) {
            $constants['driver_options'] = [];
        }

        $bufferedQuery = self::getBufferedQueryAttribute();
        if (!isset($constants['driver_options'][$bufferedQuery])) {
            $constants['driver_options'][$bufferedQuery] = true;
        }

        return $constants;
    }

    /**
     * Returns the PDO attribute for buffered MySQL queries.
     *
     * PDO::MYSQL_ATTR_USE_BUFFERED_QUERY is deprecated since PHP 8.5 in favour of
     * Pdo\Mysql::ATTR_USE_BUFFERED_QUERY, which exists since PHP 8.4.
     *
     * @return int
     */
    public static function getBufferedQueryAttribute()
    {
        if (defined('Pdo\Mysql::ATTR_USE_BUFFERED_QUERY')) {
            return constant('Pdo\Mysql::ATTR_USE_BUFFERED_QUERY');
        }

        return PDO::MYSQL_ATTR_USE_BUFFERED_QUERY;
    }
}
