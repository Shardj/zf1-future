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
 * @package    Zend\Service\Rackspace
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

require_once 'Zend/Service/Rackspace/Files.php';
require_once 'Zend/Http/Client/Adapter/Test.php';

/**
 * Test helper
 */

/**
 * @category   Zend
 * @package    Zend_Service_Rackspace_Files
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Service_Rackspace_Files
 */
class Zend_Service_Rackspace_Files_OfflineTest
    extends PHPUnit_Framework_TestCase
{
    /**
     * Reference to RackspaceFiles
     *
     * @var Zend_Service_Rackspace_Files
     */
    protected $rackspace;

    /**
     * HTTP client adapter for testing
     *
     * @var Zend_Http_Client_Adapter_Test
     */
    protected $httpClientAdapterTest;

    /**
     * Metadata for container/object test
     *
     * @var array
     */
    protected $metadata;

    /**
     * Another metadata for container/object test
     *
     * @var array
     */
    protected $metadata2;

    /**
     * Reference to Container
     *
     * @var Zend_Service_Rackspace_Files_Container
     */
    protected $container;

    /**
     * Set up the test case
     *
     * @return void
     */
    public function setUp()
    {
        $this->rackspace = new Zend_Service_Rackspace_Files('foo', 'bar');

        $this->container = new Zend_Service_Rackspace_Files_Container(
            $this->rackspace,
            [
                 'name' => TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME
            ]
        );

        $this->httpClientAdapterTest = new Zend_Http_Client_Adapter_Test();

        $this->rackspace->getHttpClient()->setAdapter(
            $this->httpClientAdapterTest
        );

        // authentication (from a file)
        $this->httpClientAdapterTest->setResponse(
            self::loadResponse('../../_files/testAuthenticate')
        );
        $this->assertTrue(
            $this->rackspace->authenticate(), 'Authentication failed'
        );

        $this->metadata = [
            'foo'  => 'bar',
            'foo2' => 'bar2'
        ];

        $this->metadata2 = [
            'hello' => 'world'
        ];

        // load the HTTP response (from a file)
        $this->httpClientAdapterTest->setResponse(
            $this->loadResponse($this->getName())
        );
    }

    /**
     * Utility method for returning a string HTTP response, which is loaded from a file
     *
     * @param  string $name
     *
     * @return string
     */
    protected function loadResponse($name)
    {
        return file_get_contents(__DIR__ . '/_files/' . $name . '.response');
    }

    public function testCreateContainer()
    {
        $container =
            $this->rackspace->createContainer('zf-unit-test', $this->metadata);
        $this->assertTrue($container !== false);
        $this->assertEquals($container->getName(), 'zf-unit-test');
    }

    public function testGetCountContainers()
    {
        $num = $this->rackspace->getCountContainers();
        $this->assertTrue($num > 0);
    }

    public function testGetContainer()
    {
        $container = $this->rackspace->getContainer('zf-unit-test');
        $this->assertTrue($container !== false);
        $this->assertEquals($container->getName(), 'zf-unit-test');
    }

    public function testGetContainers()
    {
        $containers = $this->rackspace->getContainers();
        $this->assertTrue($containers !== false);
        $found = false;
        foreach ($containers as $container) {
            if ($container->getName() == 'zf-unit-test') {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found);
    }

    public function testGetMetadataContainer()
    {
        $data = $this->rackspace->getMetadataContainer('zf-unit-test');
        $this->assertTrue($data !== false);
        $this->assertEquals($data['name'], 'zf-unit-test');
        $this->assertEquals($data['metadata'], $this->metadata);
    }

    public function testGetInfoAccount()
    {
        $data = $this->rackspace->getInfoAccount();
        $this->assertTrue($data !== false);
        $this->assertTrue($data['tot_containers'] > 0);
    }

    public function testStoreObject()
    {
        $content = 'This is a test!';
        $result  = $this->rackspace->storeObject(
            'zf-unit-test',
            'zf-object-test',
            $content,
            $this->metadata
        );
        $this->assertTrue($result);
    }

    public function testGetObject()
    {
        $object = $this->rackspace->getObject(
            'zf-unit-test',
            'zf-object-test'
        );
        $this->assertTrue($object !== false);
        $this->assertEquals($object->getName(), 'zf-object-test');
        $this->assertEquals($object->getSize(), 15);
        $this->assertEquals($object->getMetadata(), $this->metadata);
    }

    public function testCopyObject()
    {
        $result = $this->rackspace->copyObject(
            'zf-unit-test',
            'zf-object-test',
            'zf-unit-test',
            'zf-object-test' . '-copy'
        );
        $this->assertTrue($result);
        $this->assertNotContains('application/x-www-form-urlencoded', $this->rackspace->getHttpClient()->getLastRequest());
    }

    public function testGetObjects()
    {
        $objects = $this->rackspace->getObjects('zf-unit-test');
        $this->assertTrue($objects !== false);

        $this->assertEquals($objects[0]->getName(), 'zf-object-test');
        $this->assertEquals($objects[1]->getName(), 'zf-object-test' . '-copy');
    }

    /**
     * @group GH-68
     */
    public function testGetObjectsPseudoDirs()
    {
        $objects = $this->rackspace->getObjects(
            'zf-unit-test',
            [
                'delimiter' => '/',
                'prefix'    => 'dir/',
            ]
        );
        $this->assertTrue($objects !== false);

        $this->assertEquals($objects[0]->getName(), 'dir/subdir1/');
        $this->assertEquals($objects[1]->getName(), 'dir/subdir2/');
    }

    public function testGetSizeContainers()
    {
        $size = $this->rackspace->getSizeContainers();
        $this->assertTrue($size !== false);
        $this->assertTrue(is_numeric($size));
    }

    public function testGetCountObjects()
    {
        $count = $this->rackspace->getCountObjects();
        $this->assertTrue($count !== false);
        $this->assertTrue(is_numeric($count));
    }

    public function testSetMetadataObject()
    {
        $result = $this->rackspace->setMetadataObject(
            'zf-unit-test',
            'zf-object-test',
            $this->metadata2
        );
        $this->assertTrue($result);
    }

    public function testGetMetadataObject()
    {
        $data = $this->rackspace->getMetadataObject(
            'zf-unit-test',
            'zf-object-test'
        );
        $this->assertTrue($data !== false);
        $this->assertEquals($data['metadata'], $this->metadata2);
    }

    public function testEnableCdnContainer()
    {
        $data = $this->rackspace->enableCdnContainer('zf-unit-test');
        $this->assertTrue($data !== false);
        $this->assertTrue(is_array($data));
        $this->assertTrue(!empty($data['cdn_uri']));
        $this->assertTrue(!empty($data['cdn_uri_ssl']));
    }

    public function testGetCdnContainers()
    {
        $containers = $this->rackspace->getCdnContainers();
        $this->assertTrue($containers !== false);
        $found = false;
        foreach ($containers as $container) {
            if ($container->getName() == 'zf-unit-test') {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found);
    }

    public function testUpdateCdnContainer()
    {
        $data =
            $this->rackspace->updateCdnContainer('zf-unit-test', null, false);
        $this->assertTrue($data !== false);
    }

    public function testDeleteObject()
    {
        $this->assertTrue(
            $this->rackspace->deleteObject(
                'zf-unit-test',
                'zf-object-test'
            )
        );
    }

    public function testDeleteObject2()
    {
        $this->assertTrue(
            $this->rackspace->deleteObject(
                'zf-unit-test',
                'zf-object-test' . '-copy'
            )
        );
    }

    public function testDeleteContainer()
    {
        $this->assertTrue($this->rackspace->deleteContainer('zf-unit-test'));
    }

    /**
     * @group ZF-12542
     */
    public function testGetInfoCdnContainer()
    {
        $info = $this->rackspace->getInfoCdnContainer(
            TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME
        );
        $this->assertTrue($info !== false);
        $this->assertTrue(is_array($info));
        $this->assertTrue(!empty($info['ttl']));
        $this->assertTrue(!empty($info['cdn_uri']));
        $this->assertTrue(!empty($info['cdn_uri_ssl']));
        $this->assertTrue($info['cdn_enabled']);
        $this->assertTrue($info['log_retention']);
    }

    /**
     * @group ZF-12542
     */
    public function testGetCdnTtl()
    {
        $ttl = $this->container->getCdnTtl();
        $this->assertTrue($ttl !== false);
    }

    /**
     * @group ZF-12542
     */
    public function testGetCdnUri()
    {
        $uri = $this->container->getCdnUri();
        $this->assertTrue($uri !== false);
    }

    /**
     * @group ZF-12542
     */
    public function testGetCdnUriSsl()
    {
        $uri = $this->container->getCdnUriSsl();
        $this->assertTrue($uri !== false);
    }
}
