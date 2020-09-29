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
 * @version    $Id: TableBugs.php 24593 2012-01-05 20:35:02Z matthew $
 */


/**
 * @see Zend_Db_Table_Abstract
 */
require_once 'Zend/Db/Table/Abstract.php';

/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class My_ZendDbTable_TableCascadeRecursive extends Zend_Db_Table_Abstract
{

    protected $_name = 'zfalt_cascade_recursive';
    protected $_primary = 'item_id'; // Deliberate non-array value

    protected $_dependentTables = ['My_ZendDbTable_TableCascadeRecursive'];

    protected $_referenceMap    = [
        'Children' => [
            'columns'           => ['item_parent'],
            'refTableClass'     => 'My_ZendDbTable_TableCascadeRecursive',
            'refColumns'        => ['item_id'],
            'onDelete'          => self::CASCADE_RECURSE
        ]
    ];

}
