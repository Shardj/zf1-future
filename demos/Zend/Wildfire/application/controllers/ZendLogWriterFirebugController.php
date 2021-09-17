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
 * @package    Zend_Wildfire
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Zend_Controller_Action */
require_once 'Zend/Controller/Action.php';

/** Zend_Wildfire_Plugin_FirePhp */
require_once 'Zend/Wildfire/Plugin/FirePhp.php';

/**
 * Tests for Zend_Log_Writer_Firebug
 *
 * @category   Zend
 * @package    Zend_Wildfire
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ZendLogWriterFirebugController extends Zend_Controller_Action
{

    public function testloggingAction()
    {
        $logger = Zend_Registry::get('logger');

        $logger->log('Emergency: system is unusable',            Zend_Log::EMERG);
        $logger->log('Alert: action must be taken immediately',  Zend_Log::ALERT);
        $logger->log('Critical: critical conditions',            Zend_Log::CRIT);
        $logger->log('Error: error conditions',                  Zend_Log::ERR);
        $logger->log('Warning: warning conditions',              Zend_Log::WARN);
        $logger->log('Notice: normal but significant condition', Zend_Log::NOTICE);
        $logger->log('Informational: informational messages',    Zend_Log::INFO);
        $logger->log('Debug: debug messages',                    Zend_Log::DEBUG);
        $logger->log(['$_SERVER',$_SERVER],                 Zend_Log::DEBUG);

        $logger->trace('Trace to here');

        $table = ['Summary line for the table',
                       [
                           ['Column 1', 'Column 2'],
                           ['Row 1 c 1',' Row 1 c 2'],
                           ['Row 2 c 1',' Row 2 c 2']
                       ]
                      ];
        $logger->table($table);
    }

    public function testgroupedloggingAction()
    {
        $logger = Zend_Registry::get('logger');

        Zend_Wildfire_Plugin_FirePhp::group("Collapsed Group", ['Collapsed' => true]);
            $logger->log('Message in collapsed group', Zend_Log::DEBUG);
        Zend_Wildfire_Plugin_FirePhp::groupEnd();

        Zend_Wildfire_Plugin_FirePhp::group("Expanded Group", ['Collapsed' => false]);
            $logger->log('Message in expanded group', Zend_Log::DEBUG);
        Zend_Wildfire_Plugin_FirePhp::groupEnd();
    }

    public function testerrorcontrollerAction()
    {
        require_once 'Zend/Exception.php';
        throw new Zend_Exception('Test Exception');
    }

    public function testlargemessageAction()
    {
        $message = [];

        for ( $i=0 ; $i<300 ; $i++ ) {
            $message[] = 'This is message #' . $i;
        }

        $logger = Zend_Registry::get('logger');
        $logger->log($message, Zend_Log::INFO);
    }
}
