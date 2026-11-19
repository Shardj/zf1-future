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
 * session_set_save_handler() introduced in PHP 8.4. It also provides create_sid()
 * and validateId(): PHP 8.6 raises a warning for a SessionHandlerInterface class
 * without them, and PHP 9 requires them.
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
     * @param mixed $path
     * @param mixed $name
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function open($path, $name): bool
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
     * @param mixed $id
     * @return string|false
     */
    #[\ReturnTypeWillChange]
    public function read($id)
    {
        $data = $this->saveHandler->read($id);
        return $data ?? false;
    }

    /**
     * @param mixed $id
     * @param mixed $data
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function write($id, $data): bool
    {
        return (bool) $this->saveHandler->write($id, $data);
    }

    /**
     * @param mixed $id
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function destroy($id): bool
    {
        return (bool) $this->saveHandler->destroy($id);
    }

    /**
     * @param mixed $max_lifetime
     * @return int|false
     */
    #[\ReturnTypeWillChange]
    public function gc($max_lifetime)
    {
        $result = $this->saveHandler->gc($max_lifetime);
        return $result === false ? false : (int) $result;
    }

    /**
     * Creates a new session id with PHP's own generator.
     *
     * Inside a save handler callback, session_create_id() does not call back into
     * the handler, so the id follows session.sid_length and
     * session.sid_bits_per_character, as with PHP's default handler.
     *
     * @return string
     * @throws Zend_Session_SaveHandler_Exception When no session id can be created
     */
    public function create_sid(): string
    {
        $id = session_create_id();
        if ($id === false) {
            require_once 'Zend/Session/SaveHandler/Exception.php';
            throw new Zend_Session_SaveHandler_Exception('Unable to create a session id');
        }
        return $id;
    }

    /**
     * Whether the save handler holds data for the session id.
     *
     * PHP asks this with session.use_strict_mode on, to replace an id it does not
     * know instead of adopting it, and for every new id of session_regenerate_id()
     * and session_create_id(), to detect a collision. Zend_Session_SaveHandler_Interface
     * has no existence check, so a session counts as known when read() returns data;
     * a session without data is replaced as well, which loses nothing.
     *
     * @param mixed $id
     * @return bool
     */
    public function validateId($id): bool
    {
        $data = $this->saveHandler->read($id);
        return is_string($data) && $data !== '';
    }
}