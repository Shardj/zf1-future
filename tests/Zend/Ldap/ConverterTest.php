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
 * @package    Zend_Ldap
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Zend_Ldap_Converter
 */
require_once 'Zend/Ldap/Converter.php';

/**
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Ldap
 */
class Zend_Ldap_ConverterTest extends PHPUnit_Framework_TestCase
{
    public function testAsc2hex32()
    {
        $expected='\00\01\02\03\04\05\06\07\08\09\0a\0b\0c\0d\0e\0f\10\11\12\13\14\15\16\17\18\19' .
            '\1a\1b\1c\1d\1e\1f !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`' .
            'abcdefghijklmnopqrstuvwxyz{|}~';
        $str='';
        for ($i=0; $i<127; $i++) {
             $str.=chr($i);
        }
        $this->assertEquals($expected, Zend_Ldap_Converter::ascToHex32($str));
    }

    public function testHex2asc()
    {
        $expected='';
        for ($i=0; $i<127; $i++) {
             $expected.=chr($i);
        }

        $str='\00\01\02\03\04\05\06\07\08\09\0a\0b\0c\0d\0e\0f\10\11\12\13\14\15\16\17\18\19\1a\1b' .
            '\1c\1d\1e\1f !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefg' .
            'hijklmnopqrstuvwxyz{|}~';
        $this->assertEquals($expected, Zend_Ldap_Converter::hex32ToAsc($str));
    }

	/**
     * @dataProvider toLdapDateTimeProvider
     */
    public function testToLdapDateTime($convert,$expect)
    {
        $result = Zend_Ldap_Converter::toLdapDatetime($convert['date'], $convert['utc']);
        $this->assertEquals( $expect,$result);
    }

    public function toLdapDateTimeProvider(){
        include_once 'Zend/Date.php';
        $tz = new DateTimeZone('UTC');
        return [
            [['date'=> 0, 'utc' => true ],'19700101000000Z'],
            [['date'=> new DateTime('2010-05-12 13:14:45+0300', $tz), 'utc' => false ],'20100512131445+0300'],
            [['date'=> new DateTime('2010-05-12 13:14:45+0300', $tz), 'utc' => true ],'20100512101445Z'],
            [['date'=> '2010-05-12 13:14:45+0300', 'utc' => false ],'20100512131445+0300'],
            [['date'=> '2010-05-12 13:14:45+0300', 'utc' => true ],'20100512101445Z'],
            [['date'=> new Zend_Date('2010-05-12T13:14:45+0300', Zend_Date::ISO_8601), 'utc' => true ],'20100512101445Z'],
            [['date'=> new Zend_Date('2010-05-12T13:14:45+0300', Zend_Date::ISO_8601), 'utc' => false ],'20100512131445+0300'],
            [['date'=> new Zend_Date('0', Zend_Date::TIMESTAMP), 'utc' => true ],'19700101000000Z'],
        ];
    }

    /**
     * @dataProvider toLdapBooleanProvider
     */
    public function testToLdapBoolean($expect, $convert)
    {
        $this->assertEquals($expect, Zend_Ldap_Converter::toldapBoolean($convert));
    }

    public function toLdapBooleanProvider(){
        return [
            ['TRUE',true],
            ['TRUE',1],
            ['TRUE','true'],
            ['FALSE','false'],
            ['FALSE', false],
            ['FALSE', ['true']],
            ['FALSE', ['false']],
        ];
    }

    /**
     * @dataProvider toLdapSerializeProvider
     */
    public function testToLdapSerialize($expect, $convert){
        $this->assertEquals($expect, Zend_Ldap_Converter::toLdapSerialize($convert));
    }

    public function toLdapSerializeProvider(){
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            return [
                ['N;', null],
                ['i:1;', 1],
                ['O:8:"DateTime":0:{}', new DateTime('@0')],
                ['a:3:{i:0;s:4:"test";i:1;i:1;s:3:"foo";s:3:"bar";}', ['test',1,'foo'=>'bar']],
            ];
        }

        if (getenv('TRAVIS') && version_compare(PHP_VERSION, '5.4.0', '>=')) {
            return [
                ['N;', null],
                ['i:1;', 1],
                ['O:8:"DateTime":3:{s:4:"date";s:26:"1970-01-01 00:00:00.000000";s:13:"timezone_type";i:1;s:8:"timezone";s:6:"+00:00";}', new DateTime('@0')],
                ['a:3:{i:0;s:4:"test";i:1;i:1;s:3:"foo";s:3:"bar";}', ['test',1,'foo'=>'bar']],
            ];
        }

        if (version_compare(PHP_VERSION, '5.6.0beta4', '>=')) {
            return [
                ['N;', null],
                ['i:1;', 1],
                ['O:8:"DateTime":3:{s:4:"date";s:26:"1970-01-01 00:00:00.000000";s:13:"timezone_type";i:1;s:8:"timezone";s:6:"+00:00";}', new DateTime('@0')],
                ['a:3:{i:0;s:4:"test";i:1;i:1;s:3:"foo";s:3:"bar";}', ['test',1,'foo'=>'bar']],
            ];
        }

        return [
            ['N;', null],
            ['i:1;', 1],
            ['O:8:"DateTime":3:{s:4:"date";s:19:"1970-01-01 00:00:00";s:13:"timezone_type";i:1;s:8:"timezone";s:6:"+00:00";}', new DateTime('@0')],
            ['a:3:{i:0;s:4:"test";i:1;i:1;s:3:"foo";s:3:"bar";}', ['test',1,'foo'=>'bar']],
        ];
    }

    /**
     * @dataProvider toLdapProvider
     */
    public function testToLdap($expect, $convert){
        $this->assertEquals($expect, Zend_Ldap_Converter::toLdap($convert['value'], $convert['type']));
    }

    public function toLdapProvider(){
        return [
            [null, ['value' => null,'type' => 0]],
            ['19700101000000Z',['value'=> 0, 'type' => 2]],
            ['0',['value'=> 0, 'type' => 0]],
            ['FALSE',['value'=> 0, 'type' => 1]],
            ['19700101000000Z',['value'=>new Zend_Date('1970-01-01T00:00:00+0000',Zend_Date::ISO_8601),'type'=>0]],

        ];
    }

    /**
     * @dataProvider fromLdapUnserializeProvider
     */
    public function testFromLdapUnserialize ($expect, $convert)
    {
        $this->assertEquals($expect, Zend_Ldap_Converter::fromLdapUnserialize($convert));
    }

    public function testFromLdapUnserializeThrowsException ()
    {
        $this->setExpectedException('UnexpectedValueException');
        Zend_Ldap_Converter::fromLdapUnserialize('--');
    }

    public function fromLdapUnserializeProvider(){
        return [
                [null,'N;'],
                [1,'i:1;'],
                [false,'b:0;'],
        ];
    }

    public function testFromLdapBoolean()
    {
        $this->assertTrue(Zend_Ldap_Converter::fromLdapBoolean('TRUE'));
        $this->assertFalse(Zend_Ldap_Converter::fromLdapBoolean('FALSE'));
        $this->setExpectedException('InvalidArgumentException');
        Zend_Ldap_Converter::fromLdapBoolean('test');
    }

    /**
     * @dataProvider fromLdapDateTimeProvider
     */
    public function testFromLdapDateTime($expected, $convert, $utc)
    {
        if ( true === $utc ) {
            $expected -> setTimezone(new DateTimeZone('UTC'));
        }
        $this->assertEquals($expected, Zend_Ldap_Converter::fromLdapDatetime($convert,$utc));
    }

    public function fromLdapDateTimeProvider ()
    {
        return [
                [new DateTime('2010-12-24 08:00:23+0300'),'20101224080023+0300', false],
                [new DateTime('2010-12-24 08:00:23+0300'),'20101224080023+03\'00\'', false],
                [new DateTime('2010-12-24 08:00:23+0000'),'20101224080023', false],
                [new DateTime('2010-12-24 08:00:00+0000'),'201012240800', false],
                [new DateTime('2010-12-24 08:00:00+0000'),'2010122408', false],
                [new DateTime('2010-12-24 00:00:00+0000'),'20101224', false],
                [new DateTime('2010-12-01 00:00:00+0000'),'201012', false],
                [new DateTime('2010-01-01 00:00:00+0000'),'2010', false],
                [new DateTime('2010-04-03 12:23:34+0000'), '20100403122334', true],
        ];
    }

    /**
     * @expectedException	InvalidArgumentException
     * @dataProvider		fromLdapDateTimeException
     */
    public function testFromLdapDateTimeThrowsException ($value)
    {
        Zend_Ldap_Converter::fromLdapDatetime($value);
    }

    public static function fromLdapDateTimeException ()
    {
        return [
                ['foobar'],
                ['201'],
                ['201013'],
                ['20101232'],
                ['2010123124'],
                ['201012312360'],
                ['20101231235960'],
                ['20101231235959+13'],
                ['20101231235959+1160'],
            ];
    }

	/**
     * @dataProvider fromLdapProvider
     */
    public function testFromLdap($expect, $value, $type, $dateTimeAsUtc){
        $this->assertSame($expect, Zend_Ldap_Converter::fromLdap($value, $type, $dateTimeAsUtc));
    }

    public function fromLdapProvider(){
        return [
           ['1', '1', 0, true],
           ['0', '0', 0, true],
           [true, 'TRUE', 0, true],
           [false, 'FALSE', 0, true],
           ['123456789', '123456789', 0, true],
           // ZF-11639
           ['+123456789', '+123456789', 0, true],
        ];
    }
}

