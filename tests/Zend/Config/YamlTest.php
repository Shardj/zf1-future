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
 * @package    Zend_Config
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2009 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: IniTest.php 18950 2009-11-12 15:37:56Z alexander $
 */

/**
 * Zend_Config_Ini
 */
require_once 'Zend/Config/Yaml.php';

/**
 * @category   Zend
 * @package    Zend_Config
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2009 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Config
 */
class Zend_Config_YamlTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->_iniFileConfig             = dirname(__FILE__) . '/_files/config.yaml';
        $this->_iniFileAllSectionsConfig  = dirname(__FILE__) . '/_files/allsections.yaml';
        $this->_iniFileCircularConfig     = dirname(__FILE__) . '/_files/circular.yaml';
        $this->_nonReadableConfig         = dirname(__FILE__) . '/_files/nonreadable.yaml';
        $this->_iniFileInvalid            = dirname(__FILE__) . '/_files/invalid.yaml';
        $this->_iniFileSameNameKeysConfig = dirname(__FILE__) . '/_files/array.yaml';
        $this->_badIndentationConfig      = dirname(__FILE__) . '/_files/badindentation.yaml';
        $this->_booleansConfig            = dirname(__FILE__) . '/_files/booleans.yaml';
        $this->_constantsConfig           = dirname(__FILE__) . '/_files/constants.yaml';
        $this->_yamlInlineCommentsConfig  = dirname(__FILE__) . '/_files/inlinecomments.yaml';
        $this->_yamlIndentedCommentsConfig  = dirname(__FILE__) . '/_files/indentedcomments.yaml';
        $this->_yamlListConstantsConfig     = dirname(__FILE__) . '/_files/listconstants.yaml';
        $this->_listBooleansConfig          = dirname(__FILE__) . '/_files/listbooleans.yaml';
        $this->_yamlSingleQuotedString    = dirname(__FILE__) . '/_files/zf11934.yaml';
    }

    public function testLoadSingleSection()
    {
        $config = new Zend_Config_Yaml($this->_iniFileConfig, 'all');

        $this->assertEquals('all', $config->hostname);
        $this->assertEquals('live', $config->db->name);
        $this->assertEquals('multi', $config->one->two->three);
        $this->assertNull(@$config->nonexistent); // property doesn't exist
    }

    public function testSectionInclude()
    {
        $config = new Zend_Config_Yaml($this->_iniFileConfig, 'staging');

        $this->assertEquals('', $config->debug); // only in staging
        $this->assertEquals('thisname', $config->name); // only in all
        $this->assertEquals('username', $config->db->user); // only in all (nested version)
        $this->assertEquals('staging', $config->hostname); // inherited and overridden
        $this->assertEquals('dbstaging', $config->db->name); // inherited and overridden
    }

    public function testTrueValues()
    {
        $config = new Zend_Config_Yaml($this->_iniFileConfig, 'debug');

        $this->assertTrue(is_string($config->debug));
        $this->assertEquals('1', $config->debug);
        $this->assertTrue(is_string($config->values->changed));
        $this->assertEquals('1', $config->values->changed);
    }

    public function testEmptyValues()
    {
        $config = new Zend_Config_Yaml($this->_iniFileConfig, 'debug');

        $this->assertTrue(is_string($config->special->no));
        $this->assertEquals('', $config->special->no);
        $this->assertTrue(is_string($config->special->null));
        $this->assertEquals('', $config->special->null);
        $this->assertTrue(is_string($config->special->false));
        $this->assertEquals('', $config->special->false);
        $this->assertTrue(is_string($config->special->zero));
        $this->assertEquals('0', $config->special->zero);
    }

    public function testMultiDepthExtends()
    {
        $config = new Zend_Config_Yaml($this->_iniFileConfig, 'other_staging');

        $this->assertEquals('otherStaging', $config->only_in); // only in other_staging
        $this->assertEquals('', $config->debug); // 1 level down: only in staging
        $this->assertEquals('thisname', $config->name); // 2 levels down: only in all
        $this->assertEquals('username', $config->db->user); // 2 levels down: only in all (nested version)
        $this->assertEquals('staging', $config->hostname); // inherited from two to one and overridden
        $this->assertEquals('dbstaging', $config->db->name); // inherited from two to one and overridden
        $this->assertEquals('anotherpwd', $config->db->pass); // inherited from two to other_staging and overridden
    }

    public function testErrorNoExtendsSection()
    {
        try {
            $config = new Zend_Config_Yaml($this->_iniFileConfig, 'extendserror');
            $this->fail('An expected Zend_Config_Exception has not been raised');
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('cannot be found', $expected->getMessage());
        }
    }

    public function testZF413_MultiSections()
    {
        $config = new Zend_Config_Yaml($this->_iniFileAllSectionsConfig, ['staging','other_staging']);

        $this->assertEquals('otherStaging', $config->only_in);
        $this->assertEquals('staging', $config->hostname);

    }

    public function testZF413_AllSections()
    {
        $config = new Zend_Config_Yaml($this->_iniFileAllSectionsConfig, null);
        $this->assertEquals('otherStaging', $config->other_staging->only_in);
        $this->assertEquals('staging', $config->staging->hostname);
    }

    public function testZF414()
    {
        $config = new Zend_Config_Yaml($this->_iniFileAllSectionsConfig, null);
        $this->assertEquals(null, $config->getSectionName());
        $this->assertEquals(true, $config->areAllSectionsLoaded());

        $config = new Zend_Config_Yaml($this->_iniFileAllSectionsConfig, 'all');
        $this->assertEquals('all', $config->getSectionName());
        $this->assertEquals(false, $config->areAllSectionsLoaded());

        $config = new Zend_Config_Yaml($this->_iniFileAllSectionsConfig, ['staging','other_staging']);
        $this->assertEquals(['staging','other_staging'], $config->getSectionName());
        $this->assertEquals(false, $config->areAllSectionsLoaded());
    }

    public function testZF415()
    {
        try {
            $config = new Zend_Config_Yaml($this->_iniFileCircularConfig, null);
            $this->fail('An expected Zend_Config_Exception has not been raised');
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('circular inheritance', $expected->getMessage());
        }
    }

    public function testErrorNoFile()
    {
        try {
            $config = new Zend_Config_Yaml('','');
            $this->fail('An expected Zend_Config_Exception has not been raised');
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('Filename is not set', $expected->getMessage());
        }
    }

    public function testErrorNoSectionFound()
    {
        try {
            $config = new Zend_Config_Yaml($this->_iniFileConfig,['all', 'notthere']);
            $this->fail('An expected Zend_Config_Exception has not been raised');
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('cannot be found', $expected->getMessage());
        }

        try {
            $config = new Zend_Config_Yaml($this->_iniFileConfig,'notthere');
            $this->fail('An expected Zend_Config_Exception has not been raised');
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('cannot be found', $expected->getMessage());
        }

    }

    public function testZF3196_InvalidIniFile()
    {
        try {
            $config = new Zend_Config_Yaml($this->_iniFileInvalid);
            $this->fail('An expected Zend_Config_Exception has not been raised');
        } catch (Zend_Config_Exception $expected) {
            $this->assertRegexp('/(Error parsing|syntax error, unexpected)/', $expected->getMessage());
        }

    }

    public function testZF2285_MultipleKeysOfTheSameName()
    {
        $config = new Zend_Config_Yaml($this->_iniFileSameNameKeysConfig, null);
        $this->assertEquals('2a', $config->one->two->{0});
        $this->assertEquals('2b', $config->one->two->{1});
        $this->assertEquals('4', $config->three->four->{1});
        $this->assertEquals('5', $config->three->four->{0}->five);
    }

    public function testZF2437_ArraysWithMultipleChildren()
    {
        $config = new Zend_Config_Yaml($this->_iniFileSameNameKeysConfig, null);
        $this->assertEquals('1', $config->six->seven->{0}->eight);
        $this->assertEquals('2', $config->six->seven->{1}->eight);
        $this->assertEquals('3', $config->six->seven->{2}->eight);
        $this->assertEquals('1', $config->six->seven->{0}->nine);
        $this->assertEquals('2', $config->six->seven->{1}->nine);
        $this->assertEquals('3', $config->six->seven->{2}->nine);
    }

    public function yamlDecoder($string)
    {
        return Zend_Config_Yaml::decode($string);
    }

    public function testHonorsOptionsProvidedToConstructor()
    {
        $config = new Zend_Config_Yaml($this->_iniFileAllSectionsConfig, 'debug', [
            'allow_modifications' => true,
            'skip_extends'        => true,
            'yaml_decoder'        => [$this, 'yamlDecoder'],
            'foo'                 => 'bar', // ignored
        ]);
        $this->assertNull($config->name); // verifies extends were skipped
        $config->foo = 'bar';
        $this->assertEquals('bar', $config->foo); // verifies allows modifications
        $this->assertEquals([$this, 'yamlDecoder'], $config->getYamlDecoder());
    }

    public function testConstructorRaisesExceptionWhenUnableToLoadFile()
    {
        $this->setExpectedException('Zend_Config_Exception', 'file_get_contents');
        $config = new Zend_Config_Yaml('__foo__');
    }

    public function testBadIndentationRaisesException()
    {
        $this->setExpectedException('Zend_Config_Exception', 'unsupported syntax');
        $config = new Zend_Config_Yaml($this->_badIndentationConfig, 'all');
    }

    public function testPassingBadYamlDecoderRaisesException()
    {
        $this->setExpectedException('Zend_Config_Exception', 'must be callable');
        $config = new Zend_Config_Yaml($this->_iniFileAllSectionsConfig, 'debug', [
            'yaml_decoder' => '__foo__',
        ]);
    }

    public function testParsesBooleansAccordingToOneDotOneSpecification()
    {
        $config = new Zend_Config_Yaml($this->_booleansConfig, 'production');

        $this->assertTrue($config->usingLowerCasedYes);
        $this->assertTrue($config->usingTitleCasedYes);
        $this->assertTrue($config->usingCapitalYes);
        $this->assertTrue($config->usingLowerY);
        $this->assertTrue($config->usingUpperY);

        $this->assertFalse($config->usingLowerCasedNo);
        $this->assertFalse($config->usingTitleCasedNo);
        $this->assertFalse($config->usingCapitalNo);
        $this->assertFalse($config->usingLowerN);
        $this->assertFalse($config->usingUpperN);

        $this->assertTrue($config->usingLowerCasedTrue);
        $this->assertTrue($config->usingTitleCasedTrue);
        $this->assertTrue($config->usingCapitalTrue);

        $this->assertFalse($config->usingLowerCasedFalse);
        $this->assertFalse($config->usingTitleCasedFalse);
        $this->assertFalse($config->usingCapitalFalse);

        $this->assertTrue($config->usingLowerCasedOn);
        $this->assertTrue($config->usingTitleCasedOn);
        $this->assertTrue($config->usingCapitalOn);

        $this->assertFalse($config->usingLowerCasedOff);
        $this->assertFalse($config->usingTitleCasedOff);
        $this->assertFalse($config->usingCapitalOff);
    }

    /**
     * @group ZF-12277
     */
    public function testParsesTypesAccordingToOneDotTwoSpecification()
    {
        $config = new Zend_Config_Yaml($this->_booleansConfig, 'production');
        $this->assertNull($config->usingLowerCasedNull);
        $this->assertNull($config->usingTitleCasedNull);
        $this->assertNull($config->usingCapitalNull);
    }

    public function testHonorsPhpConstants()
    {
        if (!defined('ZEND_CONFIG_YAML_ENV')) {
            define('ZEND_CONFIG_YAML_ENV', 'testing');
        }
        if (!defined('ZEND_CONFIG_YAML_ENV_PATH')) {
            define('ZEND_CONFIG_YAML_ENV_PATH', dirname(__FILE__));
        }
        $config = new Zend_Config_Yaml($this->_constantsConfig, 'production');
        $this->assertEquals(ZEND_CONFIG_YAML_ENV, $config->env);
        $this->assertEquals(ZEND_CONFIG_YAML_ENV_PATH . '/test/this', $config->path);
    }

    public function testAllowsIgnoringConstantStrings()
    {
        if (!defined('ZEND_CONFIG_YAML_ENV')) {
            define('ZEND_CONFIG_YAML_ENV', 'testing');
        }
        if (!defined('ZEND_CONFIG_YAML_ENV_PATH')) {
            define('ZEND_CONFIG_YAML_ENV_PATH', dirname(__FILE__));
        }
        $config = new Zend_Config_Yaml(
            $this->_constantsConfig, 'production', ['ignore_constants' => true]
        );
        $this->assertEquals('ZEND_CONFIG_YAML_ENV', $config->env);
        $this->assertEquals('ZEND_CONFIG_YAML_ENV_PATH/test/this', $config->path);
    }
    
    /**
     * @group ZF-11329
     */
    public function testAllowsInlineCommentsInValuesUsingHash()
    {
        $config = new Zend_Config_Yaml($this->_yamlInlineCommentsConfig, null);
        $this->assertTrue($config->resources instanceof Zend_Config);
        $this->assertTrue($config->resources->frontController instanceof Zend_Config);
        $this->assertTrue(
            is_string($config->resources->frontController->controllerDirectory)
        );
        $this->assertSame(
            'APPLICATION_PATH/controllers',
            $config->resources->frontController->controllerDirectory
        );
    }
    
    /**
     * @group ZF-11384
     */
    public function testAllowsIndentedCommentsUsingHash()
    {
        $config = new Zend_Config_Yaml($this->_yamlIndentedCommentsConfig, null);
        $this->assertTrue($config->resources instanceof Zend_Config);
        $this->assertTrue($config->resources->frontController instanceof Zend_Config);
        $this->assertTrue(
            is_string($config->resources->frontController->controllerDirectory)
        );
        $this->assertSame(
            'APPLICATION_PATH/controllers',
            $config->resources->frontController->controllerDirectory
        );
    }
    
    /**
     * @group ZF-11702
     */
    public function testAllowsConstantsInLists()
    {
        if (!defined('ZEND_CONFIG_YAML_TEST_PATH')) {
            define('ZEND_CONFIG_YAML_TEST_PATH', 'testing');
        }        
        $config = new Zend_Config_Yaml($this->_yamlListConstantsConfig, 'production');

        $this->assertEquals(ZEND_CONFIG_YAML_TEST_PATH, $config->paths->{0});
        $this->assertEquals(ZEND_CONFIG_YAML_TEST_PATH . '/library/test', $config->paths->{1});
    }
    
    /**
     * @group ZF-11702
     */
    public function testAllowsBooleansInLists()
    {
        $config = new Zend_Config_Yaml($this->_listBooleansConfig, 'production');

        $this->assertTrue($config->usingLowerCasedYes->{0});
        $this->assertTrue($config->usingTitleCasedYes->{0});
        $this->assertTrue($config->usingCapitalYes->{0});
        $this->assertTrue($config->usingLowerY->{0});
        $this->assertTrue($config->usingUpperY->{0});

        $this->assertFalse($config->usingLowerCasedNo->{0});
        $this->assertFalse($config->usingTitleCasedNo->{0});
        $this->assertFalse($config->usingCapitalNo->{0});
        $this->assertFalse($config->usingLowerN->{0});
        $this->assertFalse($config->usingUpperN->{0});

        $this->assertTrue($config->usingLowerCasedTrue->{0});
        $this->assertTrue($config->usingTitleCasedTrue->{0});
        $this->assertTrue($config->usingCapitalTrue->{0});

        $this->assertFalse($config->usingLowerCasedFalse->{0});
        $this->assertFalse($config->usingTitleCasedFalse->{0});
        $this->assertFalse($config->usingCapitalFalse->{0});

        $this->assertTrue($config->usingLowerCasedOn->{0});
        $this->assertTrue($config->usingTitleCasedOn->{0});
        $this->assertTrue($config->usingCapitalOn->{0});

        $this->assertFalse($config->usingLowerCasedOff->{0});
        $this->assertFalse($config->usingTitleCasedOff->{0});
        $this->assertFalse($config->usingCapitalOff->{0});
    }
    
    /**
     * @group ZF-11934
     */
    public function testAllowsSingleQuotedStringValues()
    {
        $config = new Zend_Config_Yaml($this->_yamlSingleQuotedString);
        $this->assertEquals('two', $config->one);
    }

    /**
    * @group ZF-11363
    */
    public function testAllowsDashesInLists()
    {
        $config = new Zend_Config_Yaml($this->_iniFileSameNameKeysConfig, null);
        $this->assertEquals('101112', $config->{'te-n'}->{'ele-ven'}->{0}->{'twel-ve'});
        $this->assertEquals('101112', $config->{'te-n'}->{'ele-ven'}->{0}->twelve);
        $this->assertEquals('thir-teen', $config->{'te-n'}->{'ele-ven'}->{1});
    }
}
