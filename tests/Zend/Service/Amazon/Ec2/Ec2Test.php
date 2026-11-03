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
 * @package    Zend_Service_Amazon
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Service/Amazon/Ec2.php';

/**
 * Zend_Service_Amazon_Ec2 test case.
 *
 * @category   Zend
 * @package    Zend_Service_Amazon
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Service
 * @group      Zend_Service_Amazon
 * @group      Zend_Service_Amazon_Ec2
 */
class Zend_Service_Amazon_Ec2_Ec2Test extends TestCase
{
    /**
     * @var Zend_Service_Amazon_Ec2
     */
    private $Zend_Service_Amazon_Ec2;

    /**
     * Prepares the environment before running a test.
     */
    protected function set_up()
    {
        parent::set_up();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tear_down()
    {
        parent::tear_down();
    }

    public function testFactoryReturnsKeyPairObject()
    {
        $object = Zend_Service_Amazon_Ec2::factory('keypair', 'access_key', 'secret_access_key');
        $this->assertTrue($object instanceof Zend_Service_Amazon_Ec2_Keypair);
    }

    public function testFactoryReturnsElasticIpObject()
    {
        $object = Zend_Service_Amazon_Ec2::factory('elasticip', 'access_key', 'secret_access_key');
        $this->assertTrue($object instanceof Zend_Service_Amazon_Ec2_Elasticip);
    }


    public function testFactoryReturnsEbsObject()
    {
        $object = Zend_Service_Amazon_Ec2::factory('ebs', 'access_key', 'secret_access_key');
        $this->assertTrue($object instanceof Zend_Service_Amazon_Ec2_Ebs);
    }

    public function testFactoryReturnImageObject()
    {
        $object = Zend_Service_Amazon_Ec2::factory('image', 'access_key', 'secret_access_key');
        $this->assertTrue($object instanceof Zend_Service_Amazon_Ec2_Image);
    }

    public function testFactoryReturnsInstanceObject()
    {
        $object = Zend_Service_Amazon_Ec2::factory('instance', 'access_key', 'secret_access_key');
        $this->assertTrue($object instanceof Zend_Service_Amazon_Ec2_Instance);
    }

    public function testFactoryReturnsSecurityGroupsObject()
    {
        $object = Zend_Service_Amazon_Ec2::factory('security', 'access_key', 'secret_access_key');
        $this->assertTrue($object instanceof Zend_Service_Amazon_Ec2_Securitygroups);
    }
}
