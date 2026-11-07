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
 * @package    Zend_Session
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id:$
 */

/**
 * @see Zend_Session_Validator_Abstract
 */
require_once 'Zend/Session/Validator/Abstract.php';

/**
 * Session validator for ZF-11186.
 *
 * @category   Zend
 * @package    Zend_Session
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Session
 */
class Zend_Session_Validator_NoticeValidator extends Zend_Session_Validator_Abstract
{
    /**
     * @access public
     * @return void
     */
    public function setup()
    {
        $this->getValidData();
    }

    /**
     * @access public
     * @return void
     */
    public function validate()
    {
        /* do nothing */
    }
}
