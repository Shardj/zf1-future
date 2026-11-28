<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

require_once 'Zend/Tool/Project/Profile.php';
require_once 'Zend/Tool/Project/Context/Repository.php';
require_once 'Zend/Tool/Project/Provider/Abstract.php';
require_once 'Zend/Tool/Framework/Provider/Pretendable.php';
require_once 'Zend/Tool/Project/Provider/Module.php';

/**
 * @category   Zend
 * @package    Zend_Tool
 * @subpackage UnitTests
 * @group      Zend_Tool
 * @group      Zend_Tool_Project
 */
class Zend_Tool_Project_Provider_ModuleTest extends TestCase
{
    protected function set_up()
    {
        Zend_Tool_Project_Context_Repository::resetInstance();
        Zend_Tool_Project_Context_Repository::getInstance()->addContextsFromDirectory(
            dirname(__FILE__) . '/../../../../../library/Zend/Tool/Project/Context/Zf/',
            'Zend_Tool_Project_Context_Zf_'
        );
    }

    protected function tear_down()
    {
        Zend_Tool_Project_Context_Repository::resetInstance();
    }

    /**
     * A directory that follows a subtree two levels deep belongs to the module directory again
     */
    public function testCreateResourcesReturnsToTheRightParentAfterANestedDirectory()
    {
        $profile = new Zend_Tool_Project_Profile();
        $profile->setAttribute('projectDirectory', dirname(__FILE__) . '/../_files/project1/');
        $profile->setAttribute('profileData', '<?xml version="1.0"?>
<projectProfile type="default" version="1.11.0">
  <projectDirectory>
    <applicationDirectory>
      <viewsDirectory>
        <viewScriptsDirectory>
          <viewHelpersDirectory/>
        </viewScriptsDirectory>
      </viewsDirectory>
      <controllersDirectory/>
      <modulesDirectory/>
    </applicationDirectory>
  </projectDirectory>
</projectProfile>');
        $profile->loadFromData();

        $module = Zend_Tool_Project_Provider_Module::createResources(
            $profile,
            'blog',
            $profile->search('applicationDirectory')
        );

        $structure = [];
        $iterator = new RecursiveIteratorIterator($module, RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $resource) {
            $structure[] = $iterator->getDepth() . ' ' . $resource->getName();
        }

        $this->assertSame(
            ['0 ViewsDirectory', '1 ViewScriptsDirectory', '2 ViewHelpersDirectory', '0 ControllersDirectory'],
            $structure
        );
    }
}
