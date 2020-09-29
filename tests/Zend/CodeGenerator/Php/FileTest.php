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
 * @package    Zend_CodeGenerator
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id $
 */

/** requires here */
require_once 'Zend/CodeGenerator/Php/File.php';
require_once 'Zend/Reflection/File.php';

/**
 * @category   Zend
 * @package    Zend_CodeGenerator
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 *
 * @group Zend_CodeGenerator
 * @group Zend_CodeGenerator_Php
 * @group Zend_CodeGenerator_Php_File
 */
class Zend_CodeGenerator_Php_FileTest extends PHPUnit_Framework_TestCase
{

    public function testConstruction()
    {
        $file = new Zend_CodeGenerator_Php_File();
        $this->assertEquals(get_class($file), 'Zend_CodeGenerator_Php_File');
    }

    public function testSourceContentGetterAndSetter()
    {
        $file = new Zend_CodeGenerator_Php_File();
        $file->setSourceContent('Foo');
        $this->assertEquals('Foo', $file->getSourceContent());
    }

    public function testIndentationGetterAndSetter()
    {
        $file = new Zend_CodeGenerator_Php_File();
        $file->setIndentation('        ');
        $this->assertEquals('        ', $file->getIndentation());
    }

    public function testToString()
    {
        $codeGenFile = new Zend_CodeGenerator_Php_File([
            'requiredFiles' => ['SampleClass.php'],
            'class' => [
                'abstract' => true,
                'name' => 'SampleClass',
                'extendedClass' => 'ExtendedClassName',
                'implementedInterfaces' => ['Iterator', 'Traversable']
                ]
            ]);


        $expectedOutput = <<<EOS
<?php

require_once 'SampleClass.php';

abstract class SampleClass extends ExtendedClassName implements Iterator, Traversable
{


}


EOS;

        $output = $codeGenFile->generate();
        $this->assertEquals($expectedOutput, $output, $output);
    }

    public function testFromReflection()
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'UnitFile');

        $codeGenFile = new Zend_CodeGenerator_Php_File([
            'class' => [
                'name' => 'SampleClass'
                ]
            ]);

        file_put_contents($tempFile, $codeGenFile->generate());

        require_once $tempFile;

        $codeGenFileFromDisk = Zend_CodeGenerator_Php_File::fromReflection(new Zend_Reflection_File($tempFile));

        unlink($tempFile);

        $this->assertEquals(get_class($codeGenFileFromDisk), 'Zend_CodeGenerator_Php_File');
        $this->assertEquals(count($codeGenFileFromDisk->getClasses()), 1);

    }

    public function testFromReflectionFile()
    {
        $file = dirname(__FILE__) . '/_files/TestSampleSingleClass.php';

        require_once $file;
        $codeGenFileFromDisk = Zend_CodeGenerator_Php_File::fromReflection(new Zend_Reflection_File($file));
        $codeGenFileFromDisk->getClass()->setMethod(['name' => 'foobar']);

        $expectedOutput = <<<EOS
<?php
/**
 * File header here
 *
 * @author Ralph Schindler <ralph.schindler@zend.com>
 */




/**
 * class docblock
 *
 * @package Zend_Reflection_TestSampleSingleClass
 */
class Zend_Reflection_TestSampleSingleClass
{

    /**
     * Enter description here...
     *
     * @return bool
     */
    public function someMethod()
    {
        /* test test */
    }

    public function foobar()
    {
    }


}




EOS;

        $this->assertEquals($expectedOutput, $codeGenFileFromDisk->generate());

    }

    /**
     * @group ZF-7369
     * @group ZF-6982
     */
    public function testFromReflectionFileKeepsIndents()
    {
        $file = dirname(__FILE__) . '/_files/TestClassWithCodeInMethod.php';

        require_once $file;
        $codeGenFileFromDisk = Zend_CodeGenerator_Php_File::fromReflection(new Zend_Reflection_File($file));

        $expectedOutput = <<<EOS
<?php
/**
 * File header here
 *
 * @author Ralph Schindler <ralph.schindler@zend.com>
 */



/**
 * class docblock
 *
 * @package Zend_Reflection_TestClassWithCodeInMethod
 */
class Zend_Reflection_TestClassWithCodeInMethod
{

    /**
     * Enter description here...
     *
     * @return bool
     */
    public function someMethod()
    {
        /* test test */
        \$foo = 'bar';
    }

}


EOS;

        $this->assertEquals($expectedOutput, $codeGenFileFromDisk->generate());
    }

    /**
     * @group ZF-7369
     * @group ZF-6982
     */
    public function testFromReflectionFilePreservesIndentsWhenAdditionalMethodAdded()
    {
        $file = dirname(__FILE__) . '/_files/TestClassWithCodeInMethod.php';

        require_once $file;
        $codeGenFileFromDisk = Zend_CodeGenerator_Php_File::fromReflection(new Zend_Reflection_File($file));
        $codeGenFileFromDisk->getClass()->setMethod(['name' => 'foobar']);
        
        $expectedOutput = <<<EOS
<?php
/**
 * File header here
 *
 * @author Ralph Schindler <ralph.schindler@zend.com>
 */




/**
 * class docblock
 *
 * @package Zend_Reflection_TestClassWithCodeInMethod
 */
class Zend_Reflection_TestClassWithCodeInMethod
{

    /**
     * Enter description here...
     *
     * @return bool
     */
    public function someMethod()
    {
        /* test test */
        \$foo = 'bar';
    }

    public function foobar()
    {
    }


}




EOS;

        $this->assertEquals($expectedOutput, $codeGenFileFromDisk->generate());
    }

    public function testFileLineEndingsAreAlwaysLineFeed()
    {
        $codeGenFile = new Zend_CodeGenerator_Php_File([
            'requiredFiles' => ['SampleClass.php'],
            'class' => [
                'abstract' => true,
                'name' => 'SampleClass',
                'extendedClass' => 'ExtendedClassName',
                'implementedInterfaces' => ['Iterator', 'Traversable']
                ]
            ]);

        // explode by newline, this would leave CF in place if it were generated
        $lines = explode("\n", $codeGenFile);

        $targetLength = strlen('require_once \'SampleClass.php\';');
        $this->assertEquals($targetLength, strlen($lines[2]));
        $this->assertEquals(';', $lines[2][$targetLength-1]);
    }

    /**
    * @group ZF-11703
    */
    public function testNewMethodKeepDocBlock(){
        $codeGenFile = Zend_CodeGenerator_Php_File::fromReflectedFileName(dirname(__FILE__).'/_files/zf-11703.php', true, true);
        $target = <<<EOS
<?php
/**
 * For manipulating files.
 */

class Foo
{

    public function bar()
    {
        // action body
    }

    public function bar2()
    {
        // action body
    }


}


EOS;

        $codeGenFile->getClass()->setMethod([
            'name' => 'bar2',
            'body' => '// action body'
            ]);

        $this->assertEquals($target, $codeGenFile->generate());
    }
    
    /**
    * @group ZF-11703
    */
    public function testNewMethodKeepTwoDocBlock(){
        $codeGenFile = Zend_CodeGenerator_Php_File::fromReflectedFileName(dirname(__FILE__).'/_files/zf-11703_1.php', true, true);
        $target = <<<EOS
<?php
/**
 * For manipulating files.
 */


/**
 * Class Foo1
 */
class Foo1
{

    public function bar()
    {
        // action body
    }

    public function bar2()
    {
        // action body
    }


}


EOS;

        $codeGenFile->getClass()->setMethod([
            'name' => 'bar2',
            'body' => '// action body'
            ]);

        $this->assertEquals($target, $codeGenFile->generate());
    }
}
