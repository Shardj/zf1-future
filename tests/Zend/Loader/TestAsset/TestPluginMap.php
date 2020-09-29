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
 * @package    Zend_Loader
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace ZendTest\Loader\TestAsset;

/**
 * @package    Zend_Loader
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Loader
 */
class ZendTest_Loader_TestAsset_TestPluginMap implements IteratorAggregate
{
    /**
     * Plugin map
     * 
     * @var array
     */
    public $map = [
        'map'    => __CLASS__,
        'test'   => 'Zend_Loader_PluginClassLoaderTest',
        'loader' => 'Zend_Loader_PluginClassLoader',
    ];

    /**
     * Return iterator
     * 
     * @return Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->map);
    }
}
