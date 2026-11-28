<?php
require_once 'Zend/Service/Exception.php';

/**
 * Error of the Last.fm client or of the Last.fm API; for an error reported by the API,
 * the code is the Last.fm error code (e.g. 6 for invalid parameters, 10 for an invalid API key)
 *
 * @category   Zend
 * @package    Zend_Service
 * @subpackage LastFm
 */
class Zend_Service_LastFm_Exception extends Zend_Service_Exception
{
}
