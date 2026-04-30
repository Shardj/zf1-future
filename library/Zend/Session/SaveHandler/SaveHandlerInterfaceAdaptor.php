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
 * @subpackage SaveHandler
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Zend_Session_SaveHandler_SessionHandlerInterfaceAdapter
 *
 * Adapts Zend_Session_SaveHandler_Interface to PHP's native SessionHandlerInterface,
 * avoiding the deprecation of passing individual callbacks to
 * session_set_save_handler() introduced in PHP 8.4.
 *
 * @category   Zend
 * @package    Zend_Session
 * @subpackage SaveHandler
 * @see        https://www.php.net/manual/en/class.sessionhandlerinterface.php
 */
class Zend_Session_SaveHandler_SessionHandlerInterfaceAdapter implements SessionHandlerInterface
{
    /**
     * @var Zend_Session_SaveHandler_Interface
     */
    private Zend_Session_SaveHandler_Interface $saveHandler;

    /**
     * @param Zend_Session_SaveHandler_Interface $saveHandler
     */
    public function __construct(Zend_Session_SaveHandler_Interface $saveHandler)
    {
        $this->saveHandler = $saveHandler;
    }

    /**
     * @param string $path
     * @param string $name
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function open(string $path, string $name): bool
    {
        return (bool) $this->saveHandler->open($path, $name);
    }

    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function close(): bool
    {
        return (bool) $this->saveHandler->close();
    }

    /**
     * @param string $id
     * @return string|false
     */
    #[\ReturnTypeWillChange]
    public function read(string $id): string|false
    {
        $data = $this->saveHandler->read($id);
        return $data ?? false;
    }

    /**
     * @param string $id
     * @param string $data
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function write(string $id, string $data): bool
    {
        return (bool) $this->saveHandler->write($id, $data);
    }

    /**
     * @param string $id
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function destroy(string $id): bool
    {
        return (bool) $this->saveHandler->destroy($id);
    }

    /**
     * @param int $max_lifetime
     * @return int|false
     */
    #[\ReturnTypeWillChange]
    public function gc(int $max_lifetime): int|false
    {
        $result = $this->saveHandler->gc($max_lifetime);
        return $result === false ? false : (int) $result;
    }
}