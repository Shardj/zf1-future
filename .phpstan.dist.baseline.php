<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Acl::_roleDFSAllPrivileges() invoked with 3 parameters, 1-2 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Acl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $date of class Zend_Date constructor expects array|int|string|Zend_Date|null, float given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/Amf0/Deserializer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*=" between string and 1000 results in an error.',
	'identifier' => 'assignOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/Amf0/Serializer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with array will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/Amf3/Deserializer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $date of class Zend_Date constructor expects array|int|string|Zend_Date|null, float given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/Amf3/Deserializer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Assign to $value overwrites the last element from array.',
	'identifier' => 'assign.byRefForeachExpr',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/Amf3/Serializer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*" between string and 1000 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/Amf3/Serializer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $link of function mysqli_num_fields expects mysqli_result, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/Resource/MysqliResult.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $result of function mysqli_fetch_assoc expects mysqli_result, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/Resource/MysqliResult.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $result of function mysqli_fetch_field_direct expects mysqli_result, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/Resource/MysqliResult.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Amf_Parse_TypeLoader::loadType() never returns array<string> so it can be removed from the return type.',
	'identifier' => 'return.unusedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/TypeLoader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Amf_Parse_TypeLoader::loadType() never returns false so it can be removed from the return type.',
	'identifier' => 'return.unusedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/TypeLoader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Reflection::getPrototypes().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Class::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Class::newInstance().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Function::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Function_Abstract::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Method::getName().',
	'identifier' => 'method.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Method::invokeArgs().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Method::isStatic().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_object() with object will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $message of class Zend_Amf_Value_Messaging_ErrorMessage constructor expects Zend_Amf_Value_Messaging_AbstractMessage|null, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $data of class Zend_Amf_Value_MessageBody constructor expects string, array|Zend_Amf_Value_Messaging_ErrorMessage given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $response of method Zend_Amf_Server::setResponse() has invalid type Zend_Amf_Server_Response.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Amf_Server::$_loader (Zend_Loader_PluginLoader) in empty() is not falsy.',
	'identifier' => 'empty.property',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Negated boolean expression is always true.',
	'identifier' => 'booleanNot.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Loader_PluginLoader_Interface::getPaths().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Bootstrap/BootstrapAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Loader_PluginLoader_Interface::load() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Bootstrap/BootstrapAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Application_Bootstrap_Bootstrapper::$view.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Dojo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Application_Resource_Dojo::getDojo() has invalid return type Zend_Dojo_View_Dojo_Container.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Dojo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Application_Resource_Dojo::init() should return Zend_Dojo_View_Helper_Dojo_Container but returns Zend_Dojo_View_Dojo_Container.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Dojo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Application_Bootstrap_Bootstrapper::$frontController.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Frontcontroller.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'ArrayObject<*NEVER*, *NEVER*> does not accept object.',
	'identifier' => 'offsetAssign.valueType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Modules.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Application_Bootstrap_Bootstrapper::getResource().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Modules.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Negated boolean expression is always true.',
	'identifier' => 'booleanNot.alwaysTrue',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Modules.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @var above a method has no effect.',
	'identifier' => 'varTag.misplaced',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Multidb.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Application_Bootstrap_Bootstrapper::$view.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Navigation.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Application_Bootstrap_Bootstrapper::getContainer().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Router.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Translate::addTranslation().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Translate.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Application_Bootstrap_Bootstrapper::getResource().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Useragent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Application_Bootstrap_Bootstrapper::hasPluginResource().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Useragent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Application_Bootstrap_Bootstrapper::hasResource().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Useragent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_Abstract::setView().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/View.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Application_Resource_View::getView() should return Zend_View but returns Zend_View_Interface.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/View.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Auth_Adapter_Http::$_basicResolver (Zend_Auth_Adapter_Http_Resolver_Interface) in empty() is not falsy.',
	'identifier' => 'empty.property',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Auth/Adapter/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Auth_Adapter_Http::$_digestResolver (Zend_Auth_Adapter_Http_Resolver_Interface) in empty() is not falsy.',
	'identifier' => 'empty.property',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Auth/Adapter/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Auth_Adapter_OpenId::$_response (Zend_Controller_Response_Abstract) does not accept string.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Auth/Adapter/OpenId.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $barcode of method Zend_Barcode_Renderer_RendererAbstract::setBarcode() expects Zend_Barcode_Object, Zend_Barcode_Object_ObjectAbstract given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $barcode of method Zend_Barcode::draw() has invalid type Zend_Barcode_Object.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $barcode of method Zend_Barcode::render() has invalid type Zend_Barcode_Object.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $renderer of method Zend_Barcode::draw() has invalid type Zend_Barcode_Renderer.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $renderer of method Zend_Barcode::render() has invalid type Zend_Barcode_Renderer.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "%%" between string and 4 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/Ean2.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $adapter of class Zend_Validate_Barcode constructor expects string|Zend_Config|Zend_Validate_Barcode_BarcodeAdapter, array<string, string|false> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/Ean8.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Barcode_Object_Error::_calculateBarcodeWidth() should be compatible with return type (int) of method Zend_Barcode_Object_ObjectAbstract::_calculateBarcodeWidth()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/Error.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Barcode_Object_Error::_prepareBarcode() should be compatible with return type (array) of method Zend_Barcode_Object_ObjectAbstract::_prepareBarcode()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/Error.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "<=" between *NEVER* and 5 results in an error.',
	'identifier' => 'smallerOrEqual.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/ObjectAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation ">=" between *NEVER* and 1 results in an error.',
	'identifier' => 'greaterOrEqual.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/ObjectAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $adapter of class Zend_Validate_Barcode constructor expects string|Zend_Config|Zend_Validate_Barcode_BarcodeAdapter, array<string, mixed> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/ObjectAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $str of function ltrim expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/ObjectAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $subject of function preg_match expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/ObjectAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*" between string and 0.5 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/Postnet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $input of function array_sum expects an array of values castable to number, list<string> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/Postnet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "%%" between string and 2 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/Royalmail.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $adapter of class Zend_Validate_Barcode constructor expects string|Zend_Config|Zend_Validate_Barcode_BarcodeAdapter, array<string, string|false> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/Upce.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function imagefilledpolygon invoked with 3 parameters, 4 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Renderer/Image.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function imagepolygon invoked with 3 parameters, 4 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Renderer/Image.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between class-string and \'GdImage\' will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Renderer/Image.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Font::getUnitsPerEm().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Renderer/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Font::glyphNumbersForCharacters().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Renderer/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Font::widthsForGlyphs().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Renderer/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $font of method Zend_Barcode_Renderer_Pdf::widthForStringUsingFontSize() expects Zend_Pdf_Font, Zend_Pdf_Resource_Font given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Renderer/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $barcode of method Zend_Barcode_Renderer_RendererAbstract::setBarcode() expects Zend_Barcode_Object, Zend_Barcode_Object_ObjectAbstract given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Renderer/RendererAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $barcode of method Zend_Barcode_Renderer_RendererAbstract::setBarcode() has invalid type Zend_Barcode_Object.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Renderer/RendererAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $value of method DOMElement::setAttribute() expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Barcode/Renderer/Svg.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $prefix of function uniqid expects string, int<0, max> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "+" between string and int results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend/Sqlite.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cache_Backend_Sqlite::_query() never returns resource so it can be removed from the return type.',
	'identifier' => 'return.unusedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend/Sqlite.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cache_Backend_Sqlite::_query() should return resource|false but returns SQLiteResult.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend/Sqlite.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between SQLiteResult and false will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend/Sqlite.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Cache_Backend_ExtendedInterface::___expire().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend/TwoLevels.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Cache_Backend_TwoLevels::$_fastBackend (Zend_Cache_Backend_ExtendedInterface) does not accept Zend_Cache_Backend.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend/TwoLevels.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Cache_Backend_TwoLevels::$_slowBackend (Zend_Cache_Backend_ExtendedInterface) does not accept Zend_Cache_Backend.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend/TwoLevels.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constant XC_TYPE_VAR not found.',
	'identifier' => 'constant.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cache/Backend/Xcache.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Cache_Backend::getCapabilities().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Core.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Cache_Backend_Interface::getFillingPercentage().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Core.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Cache_Backend_Interface::getIds().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Core.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Cache_Backend_Interface::getIdsMatchingAnyTags().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Core.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Cache_Backend_Interface::getIdsMatchingTags().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Core.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Cache_Backend_Interface::getIdsNotMatchingTags().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Core.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Cache_Backend_Interface::getMetadatas().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Core.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Cache_Backend_Interface::getTags().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Core.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Cache_Backend_Interface::touch().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Core.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cache_Backend_Interface::save() invoked with 5 parameters, 2-4 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Core.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $value of function ignore_user_abort expects bool, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Core.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Cache_Core::$_backend (Zend_Cache_Backend_Interface) does not accept Zend_Cache_Backend.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Core.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $flag of function ob_implicit_flush expects int, false given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Frontend/Capture.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cache_Frontend_Class::_makeId() is unused.',
	'identifier' => 'method.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Frontend/Class.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $flag of function ob_implicit_flush expects int, false given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Frontend/Class.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $flag of function ob_implicit_flush expects int, false given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Frontend/Function.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $flag of function ob_implicit_flush expects int, false given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Frontend/Output.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $flag of function ob_implicit_flush expects int, false given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Frontend/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $_COOKIE in isset() always exists and is not nullable.',
	'identifier' => 'isset.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Frontend/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Abstract::doctype().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Captcha/Image.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Session_Namespace::$word.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Captcha/Word.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'If condition is always true.',
	'identifier' => 'if.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Captcha/Word.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_DocumentService_Adapter_SimpleDb::_resolveAttributes() should return array but returns object.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/SimpleDb.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $query of method Zend_Cloud_DocumentService_Adapter_SimpleDb::query() expects string, Zend_Cloud_DocumentService_Query given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/SimpleDb.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (Zend_Cloud_DocumentService_DocumentSet) of method Zend_Cloud_DocumentService_Adapter_SimpleDb::query() should be compatible with return type (array) of method Zend_Cloud_DocumentService_Adapter::query()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/SimpleDb.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (array|false) of method Zend_Cloud_DocumentService_Adapter_SimpleDb::fetchDocument() should be compatible with return type (Zend_Cloud_DocumentService_Document) of method Zend_Cloud_DocumentService_Adapter::fetchDocument()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/SimpleDb.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (string) of method Zend_Cloud_DocumentService_Adapter_SimpleDb::listCollections() should be compatible with return type (array) of method Zend_Cloud_DocumentService_Adapter::listCollections()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/SimpleDb.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Cloud_DocumentService_Adapter_SimpleDb::createCollection() should be compatible with return type (array) of method Zend_Cloud_DocumentService_Adapter::createCollection()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/SimpleDb.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Cloud_DocumentService_Adapter_SimpleDb::insertDocument() should be compatible with return type (bool) of method Zend_Cloud_DocumentService_Adapter::insertDocument()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/SimpleDb.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $attr might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/SimpleDb.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $documentId in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/SimpleDb.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @var above a method has no effect.',
	'identifier' => 'varTag.misplaced',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/SimpleDb/Query.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (string) of method Zend_Cloud_DocumentService_Adapter_SimpleDb_Query::assemble() should be compatible with return type (array) of method Zend_Cloud_DocumentService_Query::assemble()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/SimpleDb/Query.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to preg_quote() is missing delimiter @ to be effective.',
	'identifier' => 'argument.invalidPregQuote',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_DocumentService_Adapter_WindowsAzure::_validateCompositeKey() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_DocumentService_Adapter_WindowsAzure::query() should return array but returns object.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_DocumentService_Adapter_WindowsAzure::select() should return Zend_Cloud_DocumentService_Query but returns Zend_Cloud_DocumentService_Adapter_WindowsAzure_Query.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $query of method Zend_Cloud_DocumentService_Adapter_WindowsAzure::query() expects string|Zend_Cloud_DocumentService_Adapter_WindowsAzure_Query, Zend_Cloud_DocumentService_Query given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (array) of method Zend_Cloud_DocumentService_Adapter_WindowsAzure::listDocuments() should be compatible with return type (Zend_Cloud_DocumentService_DocumentSet) of method Zend_Cloud_DocumentService_Adapter::listDocuments()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (bool) of method Zend_Cloud_DocumentService_Adapter_WindowsAzure::createCollection() should be compatible with return type (array) of method Zend_Cloud_DocumentService_Adapter::createCollection()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Cloud_DocumentService_Adapter_WindowsAzure::insertDocument() should be compatible with return type (bool) of method Zend_Cloud_DocumentService_Adapter::insertDocument()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Cloud_DocumentService_Adapter_WindowsAzure::updateDocument() should be compatible with return type (bool) of method Zend_Cloud_DocumentService_Adapter::updateDocument()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/DocumentService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_Infrastructure_Adapter::imagesInstance() has invalid return type ImageList.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/Adapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_Infrastructure_Adapter::listInstances() has invalid return type InstanceList.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/Adapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to undefined constant Zend_Cloud_Infrastructure_Instance::SSH_KEY.',
	'identifier' => 'classConstant.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/Adapter/AbstractAdapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $adapter of class Zend_Cloud_Infrastructure_Instance constructor expects Adapter, $this(Zend_Cloud_Infrastructure_Adapter_Ec2) given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/Adapter/Ec2.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $adapter of class Zend_Cloud_Infrastructure_InstanceList constructor expects Adapter, $this(Zend_Cloud_Infrastructure_Adapter_Ec2) given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/Adapter/Ec2.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $adapter of class Zend_Cloud_Infrastructure_Instance constructor expects Adapter, $this(Zend_Cloud_Infrastructure_Adapter_Rackspace) given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/Adapter/Rackspace.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $adapter of class Zend_Cloud_Infrastructure_InstanceList constructor expects Adapter, $this(Zend_Cloud_Infrastructure_Adapter_Rackspace) given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/Adapter/Rackspace.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_Infrastructure_ImageList::current() has invalid return type Image.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/ImageList.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_Infrastructure_ImageList::offsetGet() has invalid return type Image.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/ImageList.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to constant TIMEOUT_STATUS_CHANGE on an unknown class Adapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/Instance.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $adapter of method Zend_Cloud_Infrastructure_Instance::__construct() has invalid type Adapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/Instance.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_Infrastructure_InstanceList::current() has invalid return type Instance.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/InstanceList.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_Infrastructure_InstanceList::offsetGet() has invalid return type Instance.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/InstanceList.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $adapter of class Zend_Cloud_Infrastructure_Instance constructor expects Adapter, Zend_Cloud_Infrastructure_Adapter given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/InstanceList.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $adapter of method Zend_Cloud_Infrastructure_InstanceList::__construct() has invalid type Adapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/InstanceList.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @return contains unresolvable type.',
	'identifier' => 'return.unresolvableType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/QueueService/Adapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_QueueService_Adapter_Sqs::_makeMessages() should return array<Zend_Cloud_QueueService_Message> but returns object.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/QueueService/Adapter/Sqs.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instantiated class Zend_Cloud_Storage_Exception not found.',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/QueueService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_QueueService_Adapter_WindowsAzure::_makeMessages() should return array<Zend_Cloud_QueueService_Message> but returns object.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/QueueService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Cloud_QueueService_Adapter_WindowsAzure::deleteQueue() should be compatible with return type (bool) of method Zend_Cloud_QueueService_Adapter::deleteQueue()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/QueueService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Cloud_QueueService_Adapter_WindowsAzure::sendMessage() should be compatible with return type (string) of method Zend_Cloud_QueueService_Adapter::sendMessage()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/QueueService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Throwing object of an unknown class Zend_Cloud_Storage_Exception.',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/QueueService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_QueueService_Adapter_ZendQueue::_makeMessages() should return array<Zend_Cloud_QueueService_Message> but returns object.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/QueueService/Adapter/ZendQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $messages of method Zend_Cloud_QueueService_Adapter_ZendQueue::_makeMessages() expects array, Iterator given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/QueueService/Adapter/ZendQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (false) of method Zend_Cloud_QueueService_Adapter_ZendQueue::fetchQueueMetadata() should be compatible with return type (array) of method Zend_Cloud_QueueService_Adapter::fetchQueueMetadata()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cloud/QueueService/Adapter/ZendQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_QueueService_MessageSet::getIterator() should return Traversable but returns ArrayAccess.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/QueueService/MessageSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Cloud_StorageService_Adapter_FileSystem::storeItem() should be compatible with return type (bool) of method Zend_Cloud_StorageService_Adapter::storeItem()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/StorageService/Adapter/FileSystem.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Cloud_StorageService_Adapter_Rackspace::getAllFolders() is unused.',
	'identifier' => 'method.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/StorageService/Adapter/Rackspace.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Cloud_StorageService_Adapter_Rackspace::storeItem() should be compatible with return type (bool) of method Zend_Cloud_StorageService_Adapter::storeItem()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/StorageService/Adapter/Rackspace.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Cloud_StorageService_Adapter_WindowsAzure::storeItem() should be compatible with return type (bool) of method Zend_Cloud_StorageService_Adapter::storeItem()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/StorageService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Reflection_Docblock_Tag::getUrl().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/CodeGenerator/Php/Docblock/Tag/License.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Reflection_Docblock_Tag::getType().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/CodeGenerator/Php/Docblock/Tag/Param.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Reflection_Docblock_Tag::getVariableName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/CodeGenerator/Php/Docblock/Tag/Param.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Reflection_Docblock_Tag::getType().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/CodeGenerator/Php/Docblock/Tag/Return.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $type of method Zend_CodeGenerator_Php_Member_Container::__construct() has invalid type const.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/CodeGenerator/Php/Member/Container.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_CodeGenerator_Php_Member_Container::$_type has unknown class const as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/CodeGenerator/Php/Member/Container.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method generate() on string.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/CodeGenerator/Php/Property.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method isValidConstantType() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/CodeGenerator/Php/Property.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Controller_Action_HelperBroker::$redirector.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Controller_Action_HelperBroker::$viewRenderer.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Controller/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_Abstract::getViewScript().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_Abstract::setNoController().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Dispatcher_Interface::getPathDelimiter().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Dispatcher_Interface::getWordDelimiter().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Controller_Action::render() with return type void returns mixed but should not return anything.',
	'identifier' => 'return.void',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Controller_Action::renderScript() with return type void returns mixed but should not return anything.',
	'identifier' => 'return.void',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Controller_Action_Helper_ActionStack::$_actionStack (Zend_Controller_Plugin_ActionStack) does not accept array|Zend_Controller_Plugin_Abstract|false.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/ActionStack.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Request_Abstract::isXmlHttpRequest().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/AjaxContext.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_Abstract::encodeJson().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/AutoComplete/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_Abstract::setNoRender().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/AutoComplete/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_Abstract::setNoRender().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/AutoCompleteDojo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_Cache::getCache().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/Cache.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Request_Abstract::getRequestUri().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/Cache.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Controller_Action_Helper_Abstract::$view.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/ContextSwitch.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_Abstract::setNoRender().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/ContextSwitch.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_ContextSwitch::getViewSuffix().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/ContextSwitch.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_ContextSwitch::setViewSuffix().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/ContextSwitch.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation ">=" between int<2, max> and 2 is always true.',
	'identifier' => 'greaterOrEqual.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/ContextSwitch.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Controller_Action_Helper_ContextSwitch::_getViewRenderer() should return $this(Zend_Controller_Action_Helper_ContextSwitch) but returns Zend_Controller_Action_Helper_Abstract.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/ContextSwitch.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Controller_Action_Helper_ContextSwitch::$_viewRenderer (Zend_Controller_Action_Helper_ViewRenderer) does not accept Zend_Controller_Action_Helper_Abstract.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/ContextSwitch.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_Abstract::setNoRender().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/Json.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using !== between null and array will always evaluate to true.',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/Redirector.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $target of method Zend_Filter_Inflector::setTargetReference() expects reference, string given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/ViewRenderer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Controller_Action_Helper_ViewRenderer::$_inflectorTarget (string) does not accept reference.',
	'identifier' => 'assign.propertyType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/ViewRenderer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $origModuleDir might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/ViewRenderer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $origSuffix might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/ViewRenderer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Controller_Action_HelperBroker::getPluginLoader() should return Zend_Loader_PluginLoader but returns Zend_Loader_PluginLoader_Interface.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/HelperBroker.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Controller_Action_HelperBroker_PriorityStack::__unset() with return type void returns Zend_Controller_Action_HelperBroker_PriorityStack but should not return anything.',
	'identifier' => 'return.void',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/HelperBroker/PriorityStack.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instanceof between object and Zend_Controller_Action will always evaluate to false.',
	'identifier' => 'instanceof.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Dispatcher/Standard.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Negated boolean expression is always true.',
	'identifier' => 'booleanNot.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Dispatcher/Standard.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unreachable statement - code above always terminates.',
	'identifier' => 'deadCode.unreachable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Dispatcher/Standard.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Dispatcher_Interface::removeControllerDirectory().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Front.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Dispatcher_Interface::setDefaultAction().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Front.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Dispatcher_Interface::setDefaultControllerName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Front.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Dispatcher_Interface::setDefaultModule().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Front.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Controller_Dispatcher_Interface::getControllerDirectory() invoked with 1 parameter, 0 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Front.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Controller_Dispatcher_Interface::setControllerDirectory() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Front.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between null and null will always evaluate to true.',
	'identifier' => 'identical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Front.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Controller_Plugin_ActionStack::popStack() invoked with 1 parameter, 0 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Plugin/ActionStack.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property ArrayObject<*NEVER*, *NEVER*>::$exception.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Plugin/ErrorHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property ArrayObject<*NEVER*, *NEVER*>::$request.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Plugin/ErrorHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property ArrayObject<*NEVER*, *NEVER*>::$type.',
	'identifier' => 'property.notFound',
	'count' => 6,
	'path' => __DIR__ . '/library/Zend/Controller/Plugin/ErrorHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Request_Abstract::getRawBody().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Plugin/PutHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Request_Abstract::isPut().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Plugin/PutHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri::getPath().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Request/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri::getQuery().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Request/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with array<mixed> will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Controller/Request/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using !== between int<1, max> and 0 will always evaluate to true.',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Request/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $_GET in isset() always exists and is not nullable.',
	'identifier' => 'isset.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Request/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $_POST in isset() always exists and is not nullable.',
	'identifier' => 'isset.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Request/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc type string|null of property Zend_Controller_Request_HttpTestCase::$_rawBody is not covariant with PHPDoc type string|false of overridden property Zend_Controller_Request_Http::$_rawBody.',
	'identifier' => 'property.phpDocType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Request/HttpTestCase.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Controller_Response_Cli::__toString() should return string but returns array.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Response/Cli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (array) of method Zend_Controller_Response_HttpTestCase::sendHeaders() should be compatible with return type ($this(Zend_Controller_Response_Abstract)) of method Zend_Controller_Response_Abstract::sendHeaders()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Response/HttpTestCase.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Router_Route_Interface::chain().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Rewrite.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $route of method Zend_Controller_Router_Route_Chain::chain() expects Zend_Controller_Router_Route_Abstract, Zend_Controller_Router_Route_Interface given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Rewrite.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$defaults.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$reqs.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$route.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Translate::getMessages().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Translate::translate().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between mixed and null will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unsafe usage of new static().',
	'identifier' => 'new.static',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $translateMessages might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$defaults.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Chain.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$route.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Chain.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unsafe usage of new static().',
	'identifier' => 'new.static',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Chain.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$defaults.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Hostname.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$reqs.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Hostname.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$route.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Hostname.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unsafe usage of new static().',
	'identifier' => 'new.static',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Hostname.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$defaults.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Module.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unsafe usage of new static().',
	'identifier' => 'new.static',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Module.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$defaults.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Regex.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$map.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Regex.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$route.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Regex.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unsafe usage of new static().',
	'identifier' => 'new.static',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Regex.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$defaults.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Static.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$route.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Static.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unsafe usage of new static().',
	'identifier' => 'new.static',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Static.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Crypt::hash() has invalid return type unknown.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Crypt_Math_BigInteger::btwoc().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Crypt/DiffieHellman.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Crypt_Math_BigInteger::fromBinary().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Crypt/DiffieHellman.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Crypt_Math_BigInteger::powmod().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Crypt/DiffieHellman.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Crypt_Math_BigInteger::rand().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/DiffieHellman.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Crypt_Math_BigInteger::toBinary().',
	'identifier' => 'method.notFound',
	'count' => 6,
	'path' => __DIR__ . '/library/Zend/Crypt/DiffieHellman.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $dh_key of function openssl_dh_compute_key expects resource, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/DiffieHellman.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $types might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Hmac.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constant MCRYPT_DEV_URANDOM not found.',
	'identifier' => 'constant.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $ascii of function chr expects int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Bcmath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $right_operand of function bcadd expects numeric-string, int<0, 255> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Bcmath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $right_operand of function bccomp expects numeric-string, 0 given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Bcmath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $right_operand of function bcdiv expects numeric-string, 256 given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Bcmath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $right_operand of function bcmod expects numeric-string, 256 given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Bcmath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $right_operand of function bcmul expects numeric-string, 256 given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Bcmath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $a of function gmp_add expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $a of function gmp_cmp expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $a of function gmp_div expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $a of function gmp_mod expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $a of function gmp_mul expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $a of function gmp_sub expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $base of function gmp_pow expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $base of function gmp_powm expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $gmpnumber of function gmp_strval expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $b of function gmp_add expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $b of function gmp_cmp expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $b of function gmp_div expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $b of function gmp_mod expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $b of function gmp_mul expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $b of function gmp_sub expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $exp of function gmp_powm expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $mod of function gmp_powm expects GMP|int|string, resource given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Math/BigInteger/Gmp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Class Zend_Crypt_Rsa_Key_Public constructor invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Rsa.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with array will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Currency.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getRate() on an unknown class Zend_Service.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Currency.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Currency::getService() has invalid return type Zend_Service.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Currency.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $subject of function str_replace expects array<string>|string, float|int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Currency.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Static method Zend_Locale_Data::clearCache() invoked with 1 parameter, 0 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Currency.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*" between string and 1000 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*" between string and 3600000 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*" between string and 60000 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "+" between string and 1 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "+" between string and 23 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "+=" between float|int|numeric-string and string results in an error.',
	'identifier' => 'assignOp.invalid',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "+=" between int and string results in an error.',
	'identifier' => 'assignOp.invalid',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "-" between string and (int|string) results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "-" between string and 1 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "-" between string and 23 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "-" between string and float|int|numeric-string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "-" between string and int results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "-=" between string and 1970 results in an error.',
	'identifier' => 'assignOp.invalid',
	'count' => 19,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_int() with string will always evaluate to false.',
	'identifier' => 'function.impossibleType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addArpa() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addDate() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addDay() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addDayOfYear() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addHour() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addIso() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addMinute() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addMonth() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addSecond() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addTime() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addTimestamp() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addWeek() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addWeekday() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::addYear() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setArpa() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setDate() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setDay() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setDayOfYear() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setHour() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setIso() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setMinute() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setMonth() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setSecond() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setTime() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setTimestamp() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setWeek() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setWeekday() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::setYear() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subArpa() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subDate() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subDay() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subDayOfYear() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subHour() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subIso() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subMinute() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subMonth() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subSecond() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subTime() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subTimestamp() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subWeek() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subWeekday() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Date::subYear() should return $this(Zend_Date) but returns int|Zend_Date.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $input of function str_pad expects string, (array|float|int<0, max>) given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $input of function str_pad expects string, (float|int) given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $num of function abs expects float|int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $string of function strlen expects string, (array|float|int<0, max>) given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $string of function strlen expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $string of function substr expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $locale of method Zend_Date::toString() expects string|Zend_Locale|null, true given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $value of static method Zend_Locale_Data::getList() expects bool|string, array<int, string> given.',
	'identifier' => 'argument.type',
	'count' => 5,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $found might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 11,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "+" between string and float results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date/DateObject.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between string and 1 will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date/DateObject.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constant DB2_I5_NAMING_OFF not found.',
	'identifier' => 'constant.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Db2.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constant DB2_I5_NAMING_ON not found.',
	'identifier' => 'constant.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Db2.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $value of function db2_autocommit expects 0|1, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Db2.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $error on object|resource.',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $insert_id on object|resource.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $server_version on object|resource.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method close() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method query() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method real_escape_string() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between object and false will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method beginTransaction() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method commit() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method errorInfo() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method exec() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getAttribute() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method inTransaction() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method lastInsertId() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method quote() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method rollBack() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with array will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Ibm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getAttribute() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Ibm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method lastInsertId() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Ibm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method setAttribute() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Ibm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method exec() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Mssql.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $type might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Mssql.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method exec() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Pgsql.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method lastInsertId() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Pgsql.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method errorInfo() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Sqlite.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method exec() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Sqlite.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method exec() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Sqlsrv.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $type might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Sqlsrv.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using !== between array and false will always evaluate to true.',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Sqlsrv.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unreachable statement - code above always terminates.',
	'identifier' => 'deadCode.unreachable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Sqlsrv.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $type might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Sqlsrv.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $replace of function str_replace expects array<string>|string, array<int, int|string> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Profiler/Firebug.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Db_Statement::$_stmt (object|resource) does not accept false.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Db2.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $affected_rows on object|resource.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $errno on object|resource.',
	'identifier' => 'property.nonObject',
	'count' => 6,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $error on object|resource.',
	'identifier' => 'property.nonObject',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $sqlstate on object|resource.',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method close() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method execute() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method fetch() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method free_result() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method more_results() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method next_result() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method prepare() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method reset() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method result_metadata() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method store_result() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Db_Statement::$_stmt (object|resource) does not accept null.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Db_Adapter_Abstract::_getExecuteMode().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Oracle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with array will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Oracle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instanceof between string and \'OCI-Lob\'|\'OCILob\' will always evaluate to false.',
	'identifier' => 'instanceof.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Oracle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Negated boolean expression is always true.',
	'identifier' => 'booleanNot.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Oracle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Db_Statement::$_stmt (object|resource) does not accept false.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Oracle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $queryString on object|resource.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method bindColumn() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method bindParam() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method bindValue() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method closeCursor() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method columnCount() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method errorCode() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method errorInfo() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method execute() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method fetch() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method fetchAll() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method fetchColumn() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method fetchObject() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getAttribute() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getColumnMeta() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method nextRowset() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method prepare() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method rowCount() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method setAttribute() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method setFetchMode() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method bindParam() on object|resource.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo/Ibm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with array will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Sqlsrv.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Db_Statement::$_stmt (object|resource) does not accept false.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Sqlsrv.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @param references unknown parameter: $key',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Table/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using !== between mixed and null will always evaluate to true.',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Table/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between true and true will always evaluate to true.',
	'identifier' => 'identical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Table/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $cacheId might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Table/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Db_Table_Row_Abstract::__unset() with return type void returns $this(Zend_Db_Table_Row_Abstract) but should not return anything.',
	'identifier' => 'return.void',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Table/Row/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $joinCond might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Table/Row/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::addHelperPath().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::getPluginLoader().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::dojo().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/BuildLayer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::getHelper().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/BuildLayer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to preg_quote() is missing delimiter / to be effective.',
	'identifier' => 'argument.invalidPregQuote',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/BuildLayer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $value of method Zend_Dojo_BuildLayer::addProfileOption() has invalid type value.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/BuildLayer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::addHelperPath().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::getPluginLoader().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::dojo().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Decorator/DijitContainer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::dojo().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Decorator/DijitElement.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::form().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Decorator/DijitForm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::addHelperPath().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/DisplayGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::getPluginLoader().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/DisplayGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_DisplayGroup::setView() should return Zend_Dojo_Form_DisplayGroup but returns Zend_Form_DisplayGroup.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/DisplayGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::addHelperPath().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/Dijit.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::getPluginLoader().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/Dijit.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_Element_Editor::addStyleSheet() should return Zend_Dojo_Form_Element_Editor but returns Zend_Dojo_Form_Element_Dijit.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/Editor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_Element_Editor::clearCaptureEvents() should return Zend_Dojo_Form_Element_Editor but returns Zend_Dojo_Form_Element_Dijit.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/Editor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_Element_Editor::clearEvents() should return Zend_Dojo_Form_Element_Editor but returns Zend_Dojo_Form_Element_Dijit.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/Editor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_Element_Editor::clearExtraPlugins() should return Zend_Dojo_Form_Element_Editor but returns Zend_Dojo_Form_Element_Dijit.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/Editor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_Element_Editor::clearPlugins() should return Zend_Dojo_Form_Element_Editor but returns Zend_Dojo_Form_Element_Dijit.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/Editor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_Element_Editor::setEditActionInterval() should return Zend_Dojo_Form_Element_Editor but returns Zend_Dojo_Form_Element_Dijit.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/Editor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_Element_Editor::setFocusOnLoad() should return Zend_Dojo_Form_Element_Editor but returns Zend_Dojo_Form_Element_Dijit.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/Editor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_Element_Editor::setHeight() should return Zend_Dojo_Form_Element_Editor but returns Zend_Dojo_Form_Element_Dijit.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/Editor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_Element_Editor::setInheritWidth() should return Zend_Dojo_Form_Element_Editor but returns Zend_Dojo_Form_Element_Dijit.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/Editor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_Element_Editor::setMinHeight() should return Zend_Dojo_Form_Element_Editor but returns Zend_Dojo_Form_Element_Dijit.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/Editor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_Element_Editor::setUpdateInterval() should return Zend_Dojo_Form_Element_Editor but returns Zend_Dojo_Form_Element_Dijit.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/Editor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_Element_ValidationTextBox::clearConstraints() should return Zend_Dojo_Form_Element_ValidationTextBox but returns Zend_Dojo_Form_Element_Dijit.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/ValidationTextBox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::addHelperPath().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/SubForm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::getPluginLoader().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/SubForm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::headStyle().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/BorderContainer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formButton().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/Button.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $haystack of function strstr expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/CheckBox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formSelect().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/ComboBox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::dojo().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/Dijit.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $attribs might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/DijitContainer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $params might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/DijitContainer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::doctype().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/Dojo/Container.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/Dojo/Container.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formTextarea().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/Editor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formRadio().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/RadioButton.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/SimpleTextarea.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::htmlList().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/Slider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $subject of function str_replace expects array<string>|string, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/Slider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dom_Query::_getNodeList() should return array but returns DOMNodeList<DOMNameSpaceNode|DOMNode>|false.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dom/Query.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #4 $nodeList of class Zend_Dom_Query_Result constructor expects DOMNodeList, array given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dom/Query.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_object() with mixed will always evaluate to false.',
	'identifier' => 'function.impossibleType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/EventManager/Event.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $params (array|object) of method Zend_EventManager_Event::setParams() should be compatible with parameter $params (string) of method Zend_EventManager_EventDescription::setParams()',
	'identifier' => 'method.childParameterType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/EventManager/Event.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getListeners() on an unknown class Zend_EventManager_StaticEventCollection.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/EventManager/EventManager.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_EventManager_EventManager::getSharedCollections() has invalid return type Zend_EventManager_StaticEventCollection.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/EventManager/EventManager.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_EventManager_ListenerAggregate::attach() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/EventManager/EventManager.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $listeners of method Zend_EventManager_EventManager::insertListeners() expects Zend_Stdlib_PriorityQueue, array given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/EventManager/EventManager.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri::setFragment().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri::setPath().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri::setQuery().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset 1 on array{list<string>, list<non-falsy-string>} in isset() always exists and is not nullable.',
	'identifier' => 'isset.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Feed_Abstract::$_entryClassName.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Feed_Abstract::$_entryElementName.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $array of method Zend_Feed_Abstract::_mapFeedHeaders() expects array, Zend_Feed_Builder_Header given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $xml of static method Zend_Xml_Security::scan() expects string, DOMElement given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Feed_Element::$_element (DOMElement) does not accept DOMDocument.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Feed_Element::$_element (DOMElement) does not accept DOMDocument|SimpleXMLElement|true.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Feed_Element::$_element (DOMElement) does not accept string.',
	'identifier' => 'assign.propertyType',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Feed/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMElement::$encoding.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMElement::$version.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMElement::createCDATASection().',
	'identifier' => 'method.notFound',
	'count' => 5,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMElement::createElement().',
	'identifier' => 'method.notFound',
	'count' => 25,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMElement::createElementNS().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $author on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $copyright on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $description on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $generator on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $image on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $language on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $lastUpdate on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $link on array.',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $published on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $title on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Feed_Builder::$_data is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Builder.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Feed_Element::$_element (DOMElement) does not accept DOMNode.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Result of method DOMElement::setAttributeNS() (void) is used.',
	'identifier' => 'method.void',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Feed_Entry_Abstract has an unused parameter $uri.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Entry/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Http_Client::$responseBody.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Entry_Atom::id().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Http_Client::setHeader().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Feed_Element::$_element (DOMElement) does not accept DOMNode.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Entry_Rss::content().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_FeedInterface::getHubs().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Pubsubhubbub.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_object() with Zend_Feed_Abstract will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Pubsubhubbub.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instanceof between Zend_Feed_Abstract and Zend_Feed_Abstract will always evaluate to true.',
	'identifier' => 'instanceof.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Pubsubhubbub.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Db_Table_Row_Abstract::$created_time.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Pubsubhubbub/Model/Subscription.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using !== between mixed and null will always evaluate to true.',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Pubsubhubbub/Publisher.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $prefix of function uniqid expects string, int<0, max> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Pubsubhubbub/Subscriber.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using !== between mixed and null will always evaluate to true.',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Pubsubhubbub/Subscriber.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $haystack of function stripos expects string, bool given.',
	'identifier' => 'argument.type',
	'count' => 5,
	'path' => __DIR__ . '/library/Zend/Feed/Pubsubhubbub/Subscriber/Callback.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Assign to $value overwrites the last element from array.',
	'identifier' => 'assign.byRefForeachExpr',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method (DOMDocument&Zend_Feed_Reader_FeedInterface)|(Zend_Feed_Abstract&Zend_Feed_Reader_FeedInterface)::getDomDocument().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_FeedInterface::setOriginalSourceUri().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'If condition is always false.',
	'identifier' => 'if.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Left side of || is always false.',
	'identifier' => 'booleanOr.leftAlwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Right side of || is always false.',
	'identifier' => 'booleanOr.rightAlwaysFalse',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Feed/Reader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getAuthors().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getCategories().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getCommentCount().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getCommentFeedLink().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getCommentLink().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getContent().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getDateCreated().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getDateModified().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getDescription().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getEnclosure().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getId().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getLinks().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getSource().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getTitle().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMNameSpaceNode|DOMNode::getAttribute().',
	'identifier' => 'method.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getAuthors().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getCategories().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getCommentCount().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getCommentFeedLink().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getCommentLink().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getContent().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getDate().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getDateModified().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getDescription().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getEnclosure().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getId().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getLinks().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_EntryAbstract::getTitle().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $authors on left side of ?? always exists and is not nullable.',
	'identifier' => 'nullCoalesce.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$value.',
	'identifier' => 'property.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/Atom/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMNameSpaceNode|DOMNode::getAttribute().',
	'identifier' => 'method.notFound',
	'count' => 7,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/Atom/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $element of method Zend_Feed_Reader_Extension_Atom_Entry::_getAuthor() expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/Atom/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $source of class Zend_Feed_Reader_Feed_Atom_Source constructor expects DOMElement, DOMNameSpaceNode|DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/Atom/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMNameSpaceNode|DOMNode::getAttribute().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/Atom/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $element of method Zend_Feed_Reader_Extension_Atom_Feed::_getAuthor() expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/Atom/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMNameSpaceNode|DOMNode::getAttribute().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/Podcast/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMNode::getAttribute().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/Podcast/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "+" between string and 0 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/Slash/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getAuthors().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getBaseUrl().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getCategories().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getCopyright().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getDateCreated().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getDateModified().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getDescription().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getFeedLink().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getGenerator().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getHubs().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getId().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getImage().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getLanguage().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getLink().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getTitle().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Feed_Reader_Feed_Atom_Source::count() should be compatible with return type (int) of method Zend_Feed_Reader_FeedAbstract::count()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom/Source.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Feed_Reader_Feed_Atom_Source::count() should be compatible with return type (int<0, max>) of method Countable::count()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom/Source.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Feed_Reader_Feed_Atom_Source::current() should be compatible with return type (Zend_Feed_Reader_EntryInterface) of method Zend_Feed_Reader_FeedAbstract::current()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom/Source.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Feed_Reader_Feed_Atom_Source::valid() should be compatible with return type (bool) of method Iterator<mixed,mixed>::valid()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom/Source.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Feed_Reader_Feed_Atom_Source::valid() should be compatible with return type (bool) of method Zend_Feed_Reader_FeedAbstract::valid()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom/Source.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMNameSpaceNode|DOMNode::getAttribute().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getAuthors().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getCategories().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getCopyright().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getDate().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getDateModified().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getDescription().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getFeedLink().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getGenerator().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getHubs().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getId().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getLanguage().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getLink().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_Extension_FeedAbstract::getTitle().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $authors on left side of ?? always exists and is not nullable.',
	'identifier' => 'nullCoalesce.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri::getHost().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/FeedSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri::getPath().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/FeedSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMElement::createCDATASection().',
	'identifier' => 'method.notFound',
	'count' => 7,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMElement::createElement().',
	'identifier' => 'method.notFound',
	'count' => 41,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMElement::createElementNS().',
	'identifier' => 'method.notFound',
	'count' => 15,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $author on array.',
	'identifier' => 'property.nonObject',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $category on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $cloud on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $copyright on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $description on array.',
	'identifier' => 'property.nonObject',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $email on array.',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $generator on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $image on array.',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $itunes on array.',
	'identifier' => 'property.nonObject',
	'count' => 11,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $language on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $lastUpdate on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $link on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $published on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $rating on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $skipDays on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $skipHours on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $textInput on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $title on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $ttl on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $webmaster on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $flinks in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Extension/Atom/Renderer/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $hubs in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Extension/Atom/Renderer/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $authors in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Extension/DublinCore/Renderer/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $authors in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Extension/DublinCore/Renderer/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $authors in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Extension/ITunes/Renderer/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $keywords in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Extension/ITunes/Renderer/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $authors in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Extension/ITunes/Renderer/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $cats in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Extension/ITunes/Renderer/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $keywords in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Extension/ITunes/Renderer/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $owners in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Extension/ITunes/Renderer/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $links in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Extension/Threading/Renderer/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $links in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Extension/WellFormedWeb/Renderer/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Feed_Writer_Feed::current() has invalid return type Zend_Feed_Reader_Entry_Interface.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot cast tidy to string.',
	'identifier' => 'cast.string',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Renderer/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $authors in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Renderer/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $data in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Renderer/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $data in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Renderer/Entry/Atom/Deleted.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $authors in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Renderer/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $data in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Renderer/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $authors in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Renderer/Feed/Atom/AtomAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $container of method Zend_Feed_Writer_Renderer_Feed_Atom_AtomAbstract::__construct() expects Zend_Feed_Writer_Feed, Zend_Feed_Writer_Source given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Renderer/Feed/Atom/Source.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $authors in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Renderer/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method SplFileInfo::addClass().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/ClassFileLocator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method SplFileInfo::getClasses().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/ClassFileLocator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_File_ClassFileLocator::setInfoClass().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/ClassFileLocator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between null and string will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/ClassFileLocator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $saveNamespace might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/ClassFileLocator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $savedNamespace might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/ClassFileLocator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_File_Transfer::getAdapter() has invalid return type Zend_File_Transfer_Adapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/Transfer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_int() with int will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/Transfer/Adapter/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to preg_quote() is missing delimiter / to be effective.',
	'identifier' => 'argument.invalidPregQuote',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/File/Transfer/Adapter/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "<=" between 1 and int<1, max> is always true.',
	'identifier' => 'smallerOrEqual.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/Transfer/Adapter/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $filter of method Zend_File_Transfer_Adapter_Abstract::addFilter() expects array|string, Zend_Filter_Interface given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/Transfer/Adapter/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $prefix of function uniqid expects string, int<0, max> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/Transfer/Adapter/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $options might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/Transfer/Adapter/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $validator might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/File/Transfer/Adapter/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Filter_Interface::getNewName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/Transfer/Adapter/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_File_Transfer_Adapter_Http::setValidators() should return Zend_File_Transfer_Adapter_Http but returns Zend_File_Transfer_Adapter_Abstract.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/Transfer/Adapter/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_int() with string will always evaluate to false.',
	'identifier' => 'function.impossibleType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Boolean.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_string() with string will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Boolean.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "==" between *NEVER* and 0.0 results in an error.',
	'identifier' => 'equal.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Boolean.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "==" between *NEVER* and 1.0 results in an error.',
	'identifier' => 'equal.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Boolean.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $locale of static method Zend_Locale::getTranslation() expects string|Zend_Locale|null, array given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Boolean.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Result of && is always false.',
	'identifier' => 'booleanAnd.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Boolean.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between *NEVER* and 1 will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Boolean.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @param references unknown parameter: $callback',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Callback.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method create() on an unknown class Archive_Tar.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Compress/Tar.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method extract() on an unknown class Archive_Tar.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Compress/Tar.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instantiated class Archive_Tar not found.',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Filter/Compress/Tar.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $file might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Compress/Tar.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using !== between true and true will always evaluate to false.',
	'identifier' => 'notIdentical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Compress/Zip.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constant MCRYPT_DEV_RANDOM not found.',
	'identifier' => 'constant.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constant MCRYPT_DEV_URANDOM not found.',
	'identifier' => 'constant.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constant MCRYPT_RAND not found.',
	'identifier' => 'constant.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mcrypt_create_iv not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mcrypt_enc_get_iv_size not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mcrypt_enc_get_key_size not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mcrypt_enc_get_supported_key_sizes not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mcrypt_generic not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mcrypt_generic_deinit not found.',
	'identifier' => 'function.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mcrypt_generic_init not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mcrypt_list_algorithms not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mcrypt_list_modes not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mcrypt_module_close not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mcrypt_module_open not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mcrypt_module_self_test not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mdecrypt_generic not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Mcrypt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $keys might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Openssl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @param references unknown parameter: $overwrite',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/File/Rename.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @param references unknown parameter: $target',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/File/Rename.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Filter_HtmlEntities::setCharSet() should return $this(Zend_Filter_HtmlEntities) but returns Zend_Filter_HtmlEntities.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/HtmlEntities.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @param references unknown parameter: $charSet',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/HtmlEntities.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @param references unknown parameter: $quoteStyle',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/HtmlEntities.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $options of method Zend_Filter_Inflector::setOptions() expects array, Zend_Config given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Inflector.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $target of method Zend_Filter_Inflector::setTargetReference() has invalid type reference.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Inflector.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Filter_Inflector::$_target (string) does not accept reference.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Inflector.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Filter_Input::getTranslator() should return Zend_Translate_Adapter|null but returns Zend_Translate.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Input.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Filter_Input::$_translator (Zend_Translate) does not accept Zend_Translate_Adapter.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Input.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Filter_Input::$_translator (Zend_Translate) does not accept Zend_Translate_Adapter|null.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Input.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unreachable statement - code above always terminates.',
	'identifier' => 'deadCode.unreachable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Input.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with array<mixed, mixed> will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Null.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with array<mixed, mixed> will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/StripTags.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Controller_Action_Helper_Abstract::$view.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Loader_PluginLoader_Interface::getPaths().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function current() on a separate line has no effect.',
	'identifier' => 'function.resultUnused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "<=" between 1 and int<1, max> is always true.',
	'identifier' => 'smallerOrEqual.alwaysTrue',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $decorator of method Zend_Form::addDecorator() expects string|Zend_Form_Decorator_Interface, array<string, string|Zend_Form_Decorator_Interface> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $decorator might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $elements might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $name might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $spec might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $subForm might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $subordered in empty() always exists and is always falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $type might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formHidden().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Captcha/ReCaptcha.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formHidden().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Captcha/Word.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formText().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Captcha/Word.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Description.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formErrors().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Errors.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::fieldset().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Fieldset.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Form_Element::getMaxFileSize().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Form_Element::getMultiFile().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Form_Element::setMaxFileSize().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formHidden().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instanceof between *NEVER* and Zend_Form_DisplayGroup will always evaluate to false.',
	'identifier' => 'instanceof.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/FormElements.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instanceof between Zend_Form and Zend_Form will always evaluate to true.',
	'identifier' => 'instanceof.alwaysTrue',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/FormElements.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Form::setElementsBelongTo() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/FormElements.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/FormErrors.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formErrors().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/FormErrors.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Form|Zend_Form_Element::getImageValue().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Image.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formImage().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Image.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Form_Decorator_Label::getOptPrefix().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Label.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Form_Decorator_Label::getOptSuffix().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Label.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Form_Decorator_Label::getReqPrefix().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Label.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Form_Decorator_Label::getReqSuffix().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Label.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formLabel().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Label.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $label in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Label.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instanceof between Zend_Form and Zend_Form will always evaluate to true.',
	'identifier' => 'instanceof.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/PrepareElements.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Form::setElementsBelongTo() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/PrepareElements.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Form_Element::$content.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/ViewHelper.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Form|Zend_Form_Element::$options.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/ViewHelper.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formMultiCheckbox().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/ViewHelper.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formRadio().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/ViewHelper.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::formSelect().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/ViewHelper.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::getHelper().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/ViewHelper.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::partial().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/ViewScript.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Controller_Action_Helper_Abstract::$view.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/DisplayGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function current() on a separate line has no effect.',
	'identifier' => 'function.resultUnused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/DisplayGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "<=" between 1 and int<1, max> is always true.',
	'identifier' => 'smallerOrEqual.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/DisplayGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $decorator of method Zend_Form_DisplayGroup::addDecorator() expects string|Zend_Form_Decorator_Interface, array<string, string|Zend_Form_Decorator_Interface> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/DisplayGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $decorator might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/DisplayGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $name might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form/DisplayGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $spec might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form/DisplayGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Controller_Action_Helper_Abstract::$view.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "<=" between 1 and int<1, max> is always true.',
	'identifier' => 'smallerOrEqual.alwaysTrue',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Form/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Negated boolean expression is always true.',
	'identifier' => 'booleanNot.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $decorator might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $filter might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $name might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $pathSegment might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $spec might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $validator might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Session_Namespace::$hash.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Element/Hash.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata::decodeRequest().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Http_Client::getAuthSubToken().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Http_Client::getClientLoginToken().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getQueryUrl() on an unknown class Query.',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/Analytics.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getQueryUrl() on an unknown class Zend_Uri_Uri.',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/Analytics.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Class Query not found.',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/Analytics.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $uri of method Zend_Gdata_Analytics::getAccountFeed() has invalid type Zend_Uri_Uri.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Analytics.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $uri of method Zend_Gdata_Analytics::getDataFeed() has invalid type Zend_Uri_Uri.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Analytics.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method transferFromDOM() on an unknown class Zend_Gdata_Analytics_Extension_Goal.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Analytics/AccountEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instantiated class Zend_Gdata_Analytics_Extension_Goal not found.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Analytics/AccountEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Argument of an invalid type object|string supplied for foreach, only iterables are supported.',
	'identifier' => 'foreach.nonIterable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "+" between \'.\' and null results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Http_Client::setRawDataStream().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getLink() on object|string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNode::$name.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/App/Base.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_App_Base::__set() with return type void returns mixed but should not return anything.',
	'identifier' => 'return.void',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App/Base.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_App_BaseMediaSource::__set() with return type void returns mixed but should not return anything.',
	'identifier' => 'return.void',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App/BaseMediaSource.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_App_Entry::$service.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_App_Extension_Generator::getVersion() has invalid return type Zend_Gdata_App_Extension_Version.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App/Extension/Generator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $value of method Zend_Gdata_App_Extension_Generator::setVersion() has invalid type Zend_Gdata_App_Extension_Version.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App/Extension/Generator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_App_Feed::$entries.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/App/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_App_FeedEntryParent::getRights() has invalid return type Zend_Gdata_AppExtension_Rights.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App/FeedEntryParent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_App_FeedSourceParent::$_entry.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/App/FeedSourceParent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_App_FeedSourceParent::getGenerator() has invalid return type Zend_Gdata_AppExtension_Generator.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App/FeedSourceParent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_App_FeedSourceParent::getIcon() has invalid return type Zend_Gdata_AppExtension_Icon.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App/FeedSourceParent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_App_FeedSourceParent::getSubtitle() has invalid return type Zend_Gdata_AppExtension_Subtitle.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App/FeedSourceParent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_App_FeedSourceParent::getlogo() has invalid return type Zend_Gdata_AppExtension_logo.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App/FeedSourceParent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_App_MediaSource::getFilename().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/App/MediaEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $str of function urlencode expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/AuthSub.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $client of static method Zend_Gdata_AuthSub::getHttpClient() expects Zend_Gdata_HttpClient|null, Zend_Http_Client|null given.',
	'identifier' => 'argument.type',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Gdata/AuthSub.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_Calendar_Extension_SendEventNotifications::__toString() should return string but returns bool|null.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Calendar/Extension/SendEventNotifications.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Calendar_Extension_WebContent::$height.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Calendar/Extension/WebContent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Calendar_Extension_WebContent::$url.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Calendar/Extension/WebContent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Calendar_Extension_WebContent::$width.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Calendar/Extension/WebContent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Docs::newMediaFileSource().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Docs.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getDOM() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Exif/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $entryLink of method Zend_Gdata_Extension_RecurrenceException::__construct() has invalid type Zend_Gdata_EntryLink.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Extension/RecurrenceException.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $originalEvent of method Zend_Gdata_Extension_RecurrenceException::__construct() has invalid type Zend_Gdata_OriginalEvent.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Extension/RecurrenceException.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_Extension_Transparency::__toString() should return string but returns bool.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Extension/Transparency.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_Extension_Visibility::__toString() should return string but returns bool.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Extension/Visibility.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Extension_Where::$entryLink.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Extension/Where.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newEmailList().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newEmailListEntry().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newEmailListQuery().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newEmailListRecipientEntry().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newEmailListRecipientQuery().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newGroupEntry().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newGroupQuery().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newLogin().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newMemberEntry().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newMemberQuery().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newNickname().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newNicknameEntry().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newNicknameQuery().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newOwnerEntry().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newProperty().',
	'identifier' => 'method.notFound',
	'count' => 10,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newQuota().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newUserEntry().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newUserQuery().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Gapps::newWho().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $login on string|Zend_Gdata_App_Entry.',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Extension_FeedLink::$rel.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps/EmailListEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_App_Base::__construct() invoked with 1 parameter, 0 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps/Error.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Gapps_Extension_Property::$rel.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps/GroupEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Gapps_Extension_Property::$rel.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps/MemberEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Gapps_Extension_Property::$rel.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps/OwnerEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Extension_FeedLink::$rel.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps/UserEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Gbase has an unused parameter $applicationId.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gbase.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Gbase has an unused parameter $client.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gbase.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Gbase_Entry has an unused parameter $element.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gbase/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Gbase_Extension_BaseAttribute has an unused parameter $name.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gbase/Extension/BaseAttribute.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Gbase_Extension_BaseAttribute has an unused parameter $text.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gbase/Extension/BaseAttribute.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Gbase_Extension_BaseAttribute has an unused parameter $type.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gbase/Extension/BaseAttribute.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Gbase_Feed has an unused parameter $element.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gbase/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Gbase_Query has an unused parameter $url.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Gbase/Query.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Health has an unused parameter $applicationId.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Health.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Health has an unused parameter $client.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Health.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Health has an unused parameter $useH9Sandbox.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Health.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Health_Extension_Ccr has an unused parameter $element.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Health/Extension/Ccr.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Health_ProfileEntry has an unused parameter $element.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Health/ProfileEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Health_ProfileFeed has an unused parameter $element.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Health/ProfileFeed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Health_ProfileListEntry has an unused parameter $element.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Health/ProfileListEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Health_ProfileListFeed has an unused parameter $element.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Health/ProfileListFeed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constructor of class Zend_Gdata_Health_Query has an unused parameter $url.',
	'identifier' => 'constructor.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Health/Query.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method closeFileHandle() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/HttpAdapterStreamingProxy.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method read() on string.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/HttpAdapterStreamingProxy.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method closeFileHandle() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/HttpAdapterStreamingSocket.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method read() on string.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/HttpAdapterStreamingSocket.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_HttpClient::_streamingRequest().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/HttpClient.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getTotalSize() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/HttpClient.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Gdata_HttpClient::$_clientLoginKey is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/HttpClient.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $value of method Zend_Gdata_Kind_EventEntry::setTransparency() has invalid type Zend_Gdata_Transparency.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Kind/EventEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $value of method Zend_Gdata_Kind_EventEntry::setVisibility() has invalid type Zend_Gdata_Visibility.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Kind/EventEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getDOM() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Media/Extension/MediaGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_Extension::__construct() invoked with 1 parameter, 0 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Media/Extension/MediaGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Gdata_Media_Extension_MediaGroup::$_keywords (Zend_Gdata_Media_Extension_MediaKeywords) does not accept array.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Media/Extension/MediaGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $get_as_float of function microtime expects bool, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/MediaMimeStream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Gdata_Query::setUser().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Photos.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $element of class Zend_Gdata_Photos_AlbumEntry constructor expects DOMElement|null, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Photos.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $element of class Zend_Gdata_Photos_CommentEntry constructor expects DOMElement|null, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Photos.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $element of class Zend_Gdata_Photos_PhotoEntry constructor expects DOMElement|null, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Photos.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $element of class Zend_Gdata_Photos_TagEntry constructor expects DOMElement|null, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Photos.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Photos_AlbumEntry::$_location.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Photos/AlbumEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Photos_AlbumFeed::$_geoRssWhere.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/Photos/AlbumFeed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Gdata_Query::__set() with return type void returns mixed but should not return anything.',
	'identifier' => 'return.void',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Query.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method delete() on an unknown class ListEntry.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method save() on an unknown class ListEntry.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method setCustom() on an unknown class ListEntry.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method setCell() on string|Zend_Gdata_App_Entry.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $location of method Zend_Gdata_Spreadsheets::getCellEntry() expects string, Zend_Gdata_Spreadsheets_CellQuery given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $location of method Zend_Gdata_Spreadsheets::getCellFeed() expects string, Zend_Gdata_Spreadsheets_CellQuery given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $entry of method Zend_Gdata_Spreadsheets::deleteRow() has invalid type ListEntry.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $entry of method Zend_Gdata_Spreadsheets::updateRow() has invalid type ListEntry.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Spreadsheets_CellFeed::$colCount.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets/CellFeed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Spreadsheets_CellFeed::$rowCount.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets/CellFeed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Gdata_Spreadsheets_ListEntry::$customByName.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets/ListEntry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Http_Client_Adapter_Interface::setOutputStream().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unreachable statement - code above always terminates.',
	'identifier' => 'deadCode.unreachable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $stream might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Http/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with string will always evaluate to false.',
	'identifier' => 'function.impossibleType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Client/Adapter/Socket.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri::getHost().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Cookie.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri::getPath().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Cookie.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to preg_quote() is missing delimiter / to be effective.',
	'identifier' => 'argument.invalidPregQuote',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Cookie.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Http_Header_SetCookie::fromString() has invalid return type SetCookie.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Header/SetCookie.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_string() with string will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Response.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $path might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $prefix might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset \'AppleWebKit\'|\'Gecko\'|\'MSIE\'|\'Presto\' on array{AppleWebKit: \'Safari\', Gecko: \'Firefox\', MSIE: \'Internet Explorer\', Presto: \'Opera\'} in isset() always exists and is not nullable.',
	'identifier' => 'isset.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/AbstractDevice.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset \'browser_name\' on array{others: array{full: non-falsy-string, detail?: non-empty-list<array{non-falsy-string, string, string}>}, user_agent: string, product_name: string, browser_name: string, product_version?: non-falsy-string, browser_version?: string, comment?: array{full: string, detail: non-empty-list<string>}, compatibility_flag?: string, ...} in isset() always exists and is not nullable.',
	'identifier' => 'isset.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/AbstractDevice.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset \'others\' on array{others: array{full: non-falsy-string, detail?: non-empty-list<array{non-falsy-string, string, string}>}, user_agent: string, product_name: string, browser_name: string, product_version?: non-falsy-string, browser_version?: string, comment?: array{full: string, detail: non-empty-list<string>}, compatibility_flag?: string, ...} in isset() always exists and is not nullable.',
	'identifier' => 'isset.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/AbstractDevice.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset 2 on array{non-falsy-string, string, string} in isset() always exists and is not nullable.',
	'identifier' => 'isset.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/AbstractDevice.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to static method getProperties() on an unknown class Mobi_Mtld_DA_Api.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/Features/Adapter/DeviceAtlas.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to static method getTreeFromFile() on an unknown class Mobi_Mtld_DA_Api.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/Features/Adapter/DeviceAtlas.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to property $capabilities on an unknown class TeraWurfl.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/Features/Adapter/TeraWurfl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getDeviceCapabilitiesFromRequest() on an unknown class TeraWurfl.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/Features/Adapter/TeraWurfl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instantiated class TeraWurfl not found.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/Features/Adapter/TeraWurfl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $wurflObj of method Zend_Http_UserAgent_Features_Adapter_TeraWurfl::getAllCapabilities() has invalid type TeraWurfl.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/Features/Adapter/TeraWurfl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $features might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/Features/Adapter/TeraWurfl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $assoc of function json_decode expects bool|null, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $currentKey of static method Zend_Json::_recursiveJsonExprFinder() expects null, (int|string) given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter &$value by-ref type of method Zend_Json::_recursiveJsonExprFinder() expects array|object, string given.',
	'identifier' => 'parameterByRef.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $method might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Controller_Action_Helper_Abstract::$view.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Layout.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_Abstract::initView().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Layout.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $target of method Zend_Filter_Inflector::setTargetReference() expects reference, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Layout.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Layout::$_inflectorTarget (string) does not accept reference.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Layout.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method setLayoutActionHelper() on array|Zend_Controller_Plugin_Abstract|false.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Layout/Controller/Action/Helper/Layout.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Layout::$content.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Layout/Controller/Plugin/Layout.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Class LDAP\\Connection not found.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Ldap::getNode() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter &$aname by-ref type of method Zend_Ldap::_splitName() expects string, (string|false) given.',
	'identifier' => 'parameterByRef.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter &$dname by-ref type of method Zend_Ldap::_splitName() expects string, (string|false) given.',
	'identifier' => 'parameterByRef.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter &$dname by-ref type of method Zend_Ldap::_splitName() expects string, null given.',
	'identifier' => 'parameterByRef.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function function_exists() with callable-string will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Collection/Iterator/Default.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Class LDAP\\Result not found.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Collection/Iterator/Default.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Class LDAP\\ResultEntry not found.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Collection/Iterator/Default.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Ldap_Collection_Iterator_Default::getAttributeNameTreatment() has invalid return type callback.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Collection/Iterator/Default.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $ldap of class Zend_Ldap_Exception constructor expects Zend_Ldap|null, $this(Zend_Ldap_Collection_Iterator_Default) given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Collection/Iterator/Default.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $attributeNameTreatment of method Zend_Ldap_Collection_Iterator_Default::setAttributeNameTreatment() has invalid type callback.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Collection/Iterator/Default.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Ldap_Collection_Iterator_Default::$_attributeNameTreatment has unknown class callback as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Collection/Iterator/Default.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between int and false will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Collection/Iterator/Default.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $array of function implode expects array<string>, array<int, array|int|string> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Dn.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $base64 of method Zend_Ldap_Ldif_Encoder::_encodeString() has invalid type boolen.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Ldif/Encoder.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter &$base64 by-ref type of method Zend_Ldap_Ldif_Encoder::_encodeString() expects boolen|null, false given.',
	'identifier' => 'parameterByRef.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Ldif/Encoder.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter &$base64 by-ref type of method Zend_Ldap_Ldif_Encoder::_encodeString() expects boolen|null, true given.',
	'identifier' => 'parameterByRef.type',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Ldap/Ldif/Encoder.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between boolen|null and true will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Ldif/Encoder.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getRdnString() on array.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (Zend_Ldap_Node) of method Zend_Ldap_Node_Collection::_createEntry() should be compatible with return type (array) of method Zend_Ldap_Collection::_createEntry()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Collection.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_AttributeType_ActiveDirectory::$ldapdisplayname.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/AttributeType/ActiveDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Ldap_Node_Schema_AttributeType_ActiveDirectory::getDescription() should be compatible with return type (string) of method Zend_Ldap_Node_Schema_AttributeType_Interface::getDescription()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/AttributeType/ActiveDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Ldap_Node_Schema_AttributeType_ActiveDirectory::getMaxLength() should be compatible with return type (int|null) of method Zend_Ldap_Node_Schema_AttributeType_Interface::getMaxLength()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/AttributeType/ActiveDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Ldap_Node_Schema_AttributeType_ActiveDirectory::getOid() should be compatible with return type (string) of method Zend_Ldap_Node_Schema_AttributeType_Interface::getOid()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/AttributeType/ActiveDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Ldap_Node_Schema_AttributeType_ActiveDirectory::getSyntax() should be compatible with return type (string) of method Zend_Ldap_Node_Schema_AttributeType_Interface::getSyntax()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/AttributeType/ActiveDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Ldap_Node_Schema_AttributeType_ActiveDirectory::isSingleValued() should be compatible with return type (bool) of method Zend_Ldap_Node_Schema_AttributeType_Interface::isSingleValued()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/AttributeType/ActiveDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_AttributeType_OpenLdap::$_parents.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/AttributeType/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_AttributeType_OpenLdap::$desc.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/AttributeType/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_AttributeType_OpenLdap::$max-length.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/AttributeType/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_AttributeType_OpenLdap::$name.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/AttributeType/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_AttributeType_OpenLdap::$oid.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/AttributeType/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_AttributeType_OpenLdap::$single-value.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/AttributeType/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_AttributeType_OpenLdap::$syntax.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/AttributeType/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_ObjectClass_ActiveDirectory::$ldapdisplayname.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/ActiveDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Ldap_Node_Schema_ObjectClass_ActiveDirectory::getDescription() should be compatible with return type (string) of method Zend_Ldap_Node_Schema_ObjectClass_Interface::getDescription()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/ActiveDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Ldap_Node_Schema_ObjectClass_ActiveDirectory::getMayContain() should be compatible with return type (array) of method Zend_Ldap_Node_Schema_ObjectClass_Interface::getMayContain()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/ActiveDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Ldap_Node_Schema_ObjectClass_ActiveDirectory::getMustContain() should be compatible with return type (array) of method Zend_Ldap_Node_Schema_ObjectClass_Interface::getMustContain()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/ActiveDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Ldap_Node_Schema_ObjectClass_ActiveDirectory::getOid() should be compatible with return type (string) of method Zend_Ldap_Node_Schema_ObjectClass_Interface::getOid()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/ActiveDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Ldap_Node_Schema_ObjectClass_ActiveDirectory::getParentClasses() should be compatible with return type (array) of method Zend_Ldap_Node_Schema_ObjectClass_Interface::getParentClasses()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/ActiveDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (void) of method Zend_Ldap_Node_Schema_ObjectClass_ActiveDirectory::getType() should be compatible with return type (int) of method Zend_Ldap_Node_Schema_ObjectClass_Interface::getType()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/ActiveDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_ObjectClass_OpenLdap::$_parents.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_ObjectClass_OpenLdap::$abstract.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_ObjectClass_OpenLdap::$auxiliary.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_ObjectClass_OpenLdap::$desc.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_ObjectClass_OpenLdap::$may.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_ObjectClass_OpenLdap::$must.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_ObjectClass_OpenLdap::$name.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_ObjectClass_OpenLdap::$oid.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_ObjectClass_OpenLdap::$structural.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_ObjectClass_OpenLdap::$sup.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $array_arg of function sort contains unresolvable type.',
	'identifier' => 'argument.unresolvableType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_AttributeType_OpenLdap::$aliases.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_AttributeType_OpenLdap::$sup.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_ObjectClass_OpenLdap::$aliases.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Ldap_Node_Schema_ObjectClass_OpenLdap::$sup.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'If condition is always false.',
	'identifier' => 'if.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Loader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $autoload_function of function spl_autoload_register expects callable(string): void, array{\'Zend_Loader_Autoloader\', \'autoload\'} given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Loader/Autoloader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'If condition is always false.',
	'identifier' => 'if.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Loader/PluginLoader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $className might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Loader/PluginLoader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Loader_SplAutoloader::setOptions() has invalid return type SplAutoloader.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Loader/SplAutoloader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'If condition is always false.',
	'identifier' => 'if.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Loader/StandardAutoloader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $callback of function set_error_handler expects (callable(int, string, string, int, array): bool)|null, array{$this(Zend_Loader_StandardAutoloader), \'handleError\'} given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Loader/StandardAutoloader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $locale of function setlocale expects array|string|null, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Static method Zend_Locale_Data::clearCache() invoked with 1 parameter, 0 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Static property Zend_Locale_Data::$_list is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Data.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $value of static method Zend_Locale_Data::getList() expects bool|string, array<int, string> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Format.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $base of function bcpow expects numeric-string, 10 given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Math.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $number of function number_format expects float, string given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Locale/Math.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*" between string and string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Math/PhpMath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "+" between string and string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Math/PhpMath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "-" between string and string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Math/PhpMath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "/" between string and string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Math/PhpMath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Locale_Math_PhpMath::Mod() should return string but returns null.',
	'identifier' => 'return.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Locale/Math/PhpMath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Locale_Math_PhpMath::Sqrt() should return string but returns null.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Math/PhpMath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $base of function pow expects float|int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Math/PhpMath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $number of function ceil expects float, string given.',
	'identifier' => 'argument.type',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Locale/Math/PhpMath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $number of function floor expects float, string given.',
	'identifier' => 'argument.type',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Locale/Math/PhpMath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $number of function sqrt expects float, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Math/PhpMath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $stack of function array_shift expects array, string given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Log.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $var of function count expects array|Countable, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Log.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $version2 of function version_compare expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Log/Filter/Priority.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method insert() on an unknown class Zend_Db_Adapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Log/Writer/Db.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $db of method Zend_Log_Writer_Db::__construct() has invalid type Zend_Db_Adapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Log/Writer/Db.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Log_Writer_Db::$_db has unknown class Zend_Db_Adapter as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Log/Writer/Db.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Layout::$events.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Log/Writer/Mail.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation ">=" between int<0, 255> and 0 is always true.',
	'identifier' => 'greaterOrEqual.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Header/HeaderValue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Mail_Part::$contentType.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Part.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Mail_Storage_Abstract::$hasFetchPart.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Mail/Part.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $headers of static method Zend_Mime_Decode::splitMessage() expects array, null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Part.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @var above a method has no effect.',
	'identifier' => 'varTag.misplaced',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between array{string, int<0, max>}|string and null will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Negated boolean expression is always true.',
	'identifier' => 'booleanNot.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Imap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $start of function substr expects int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Imap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $length of function substr expects int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Imap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unreachable statement - code above always terminates.',
	'identifier' => 'deadCode.unreachable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Imap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter &$messages by-ref type of method Zend_Mail_Protocol_Pop3::status() expects int, string given.',
	'identifier' => 'parameterByRef.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Pop3.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter &$octets by-ref type of method Zend_Mail_Protocol_Pop3::status() expects int, string given.',
	'identifier' => 'parameterByRef.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Pop3.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Dead catch - Zend_Mail_Protocol_Exception is already caught above.',
	'identifier' => 'catch.alreadyCaught',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Smtp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "^" between (string|false) and non-empty-string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Smtp/Auth/Crammd5.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $id of method Zend_Mail_Storage_Abstract::offsetSet() has invalid type id.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Mail_Storage_Folder::$INBOX.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Folder/Maildir.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'If condition is always true.',
	'identifier' => 'if.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Folder/Maildir.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Mail_Storage_Folder_Maildir::_buildFolderTree() invoked with 1 parameter, 0 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Folder/Maildir.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'If condition is always true.',
	'identifier' => 'if.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Imap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (Zend_Mail_Message_File) of method Zend_Mail_Storage_Maildir::getMessage() should be compatible with return type (Zend_Mail_Message) of method Zend_Mail_Storage_Abstract::getMessage()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Maildir.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'If condition is always false.',
	'identifier' => 'if.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Mbox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (Zend_Mail_Message_File) of method Zend_Mail_Storage_Mbox::getMessage() should be compatible with return type (Zend_Mail_Message) of method Zend_Mail_Storage_Abstract::getMessage()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Mbox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Mail_Storage_Pop3::$hasUniqueid.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Pop3.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "<" between 0 and 1 is always true.',
	'identifier' => 'smaller.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Pop3.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Left side of || is always false.',
	'identifier' => 'booleanOr.leftAlwaysFalse',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Writable/Maildir.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $params of method Zend_Mail_Storage_Folder_Maildir::__construct() expects array, stdClass given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Writable/Maildir.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $message of method Zend_Mail_Storage_Writable_Maildir::appendMessage() has invalid type stream.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Writable/Maildir.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $callback of function set_error_handler expects (callable(int, string, string, int, array): bool)|null, array{$this(Zend_Mail_Transport_Sendmail), \'_handleMailErrors\'} given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Mail/Transport/Sendmail.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Mail_Transport_Smtp::$_connection (Zend_Mail_Protocol_Smtp) does not accept Zend_Mail_Protocol_Abstract.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Transport/Smtp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "&" between string and 16 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Markup/Renderer/RendererAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "&" between string and 4 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Markup/Renderer/RendererAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "^" between string and 16 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Markup/Renderer/RendererAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $str of function str_split expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Measure/Number.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $str of function strtoupper expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Measure/Number.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $string of function strlen expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Measure/Number.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $subject of function preg_match expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 8,
	'path' => __DIR__ . '/library/Zend/Measure/Number.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Memory_Container::destroy().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Memory/AccessController.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Memory_Manager::load().',
	'identifier' => 'method.internal',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Memory/Container/Movable.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Memory_Manager::processUpdate().',
	'identifier' => 'method.internal',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Memory/Container/Movable.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Memory_Manager::unlink().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Memory/Container/Movable.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Memory_Container_Movable::getId().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Memory/Manager.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Memory_Container_Movable::isSwapped().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Memory/Manager.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Memory_Container_Movable::markAsSwapped().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Memory/Manager.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Memory_Container_Movable::setValue().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Memory/Manager.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Memory_Container_Movable::startTrace().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Memory/Manager.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Memory_Container_Movable::unloadValue().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Memory/Manager.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Memory_Manager::$_backend (Zend_Cache_Backend_Interface) does not accept Zend_Cache_Backend.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Memory/Manager.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Memory_Container_Interface::processUpdate().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Memory/Value.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $get_as_float of function microtime expects bool, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mime.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter &$headers by-ref type of method Zend_Mime_Decode::splitMessage() expects array, array|false given.',
	'identifier' => 'parameterByRef.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mime/Decode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter &$headers by-ref type of method Zend_Mime_Decode::splitMessage() expects array, string given.',
	'identifier' => 'parameterByRef.type',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Mime/Decode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Mobile_Push_Message_Abstract::getAlert().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Apns.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Mobile_Push_Message_Abstract::getBadge().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Apns.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Mobile_Push_Message_Abstract::getCustomData().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Apns.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Mobile_Push_Message_Abstract::getExpire().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Apns.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Mobile_Push_Message_Abstract::getSound().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Apns.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $mode of function stream_set_blocking expects bool, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Apns.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #4 $timeout of function stream_socket_client expects float, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Apns.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Mobile_Push_Message_Abstract::toJson().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Gcm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $message of class Zend_Mobile_Push_Response_Gcm constructor expects Zend_Mobile_Push_Message_Gcm|null, Zend_Mobile_Push_Message_Abstract given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Gcm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (Zend_Mobile_Push_Response_Gcm) of method Zend_Mobile_Push_Gcm::send() should be compatible with return type (bool) of method Zend_Mobile_Push_Abstract::send()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Gcm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (Zend_Mobile_Push_Response_Gcm) of method Zend_Mobile_Push_Gcm::send() should be compatible with return type (bool) of method Zend_Mobile_Push_Interface::send()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Gcm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Mobile_Push_Interface::connect() has invalid return type Push.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Interface.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc type array of property Zend_Mobile_Push_Message_Gcm::$_token is not covariant with PHPDoc type string of overridden property Zend_Mobile_Push_Message_Abstract::$_token.',
	'identifier' => 'property.phpDocType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Message/Gcm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Mobile_Push_Message_Mpns::setToken() should return Zend_Mobile_Push_Message_Mpns but returns Zend_Mobile_Push_Message_Abstract.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Message/Mpns.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Mobile_Push_Message_Abstract::$_token (string) in isset() is not nullable.',
	'identifier' => 'isset.property',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Message/Mpns.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Mobile_Push_Message_Abstract::$_token (string) in isset() is not nullable.',
	'identifier' => 'isset.property',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Message/Mpns/Raw.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Mobile_Push_Message_Abstract::$_token (string) in isset() is not nullable.',
	'identifier' => 'isset.property',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Message/Mpns/Tile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Mobile_Push_Message_Abstract::$_token (string) in isset() is not nullable.',
	'identifier' => 'isset.property',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Message/Mpns/Toast.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Mobile_Push_Message_Abstract::getDelay().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Mpns.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Mobile_Push_Message_Abstract::getNotificationType().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Mpns.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Mobile_Push_Message_Abstract::getXmlPayload().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mobile/Push/Mpns.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function current() on a separate line has no effect.',
	'identifier' => 'function.resultUnused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Navigation/Container.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $pages of method Zend_Navigation_Container::addPages() expects (iterable<Zend_Navigation_Page>&Zend_Config)|(iterable<Zend_Navigation_Page>&Zend_Navigation_Container), array<Zend_Navigation_Page> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Navigation/Container.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "<" between *NEVER* and 0 results in an error.',
	'identifier' => 'smaller.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Navigation/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation ">" between *NEVER* and 0 results in an error.',
	'identifier' => 'greater.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Navigation/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_Abstract::url().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Navigation/Page/Mvc.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Static property Zend_Navigation_Page_Mvc::$_urlHelper (Zend_Controller_Action_Helper_Url) does not accept Zend_Controller_Action_Helper_Abstract.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Navigation/Page/Mvc.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Oauth_Client::getRealm().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Oauth_Client::getRequestMethod().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Oauth_Client::getRequestScheme().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Oauth_Client::getToken().',
	'identifier' => 'method.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Oauth/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Oauth_Client::setRequestMethod().',
	'identifier' => 'method.notFound',
	'count' => 6,
	'path' => __DIR__ . '/library/Zend/Oauth/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getTotalSize() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Oauth_Consumer::getRequestMethod().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Oauth/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instanceof between Zend_Oauth_Token_Request|null and Zend_Oauth_Http_UserAuthorization will always evaluate to false.',
	'identifier' => 'instanceof.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $token in isset() always exists and is not nullable.',
	'identifier' => 'isset.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Oauth_Consumer::getRequestScheme().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Oauth_Http::_attemptRequest().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Oauth_Http::getConsumer() should return Zend_Oauth_Consumer but returns string.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Oauth_Http::$_consumer (string) does not accept Zend_Oauth_Consumer.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getAccessTokenUrl() on string.',
	'identifier' => 'method.nonObject',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/AccessToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getConsumerKey() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/AccessToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getConsumerSecret() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/AccessToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getLastRequestToken() on string.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/AccessToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getSignatureMethod() on string.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/AccessToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getVersion() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/AccessToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $httpClient might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/AccessToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getCallbackUrl() on string.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/RequestToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getConsumerKey() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/RequestToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getConsumerSecret() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/RequestToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getRequestTokenUrl() on string.',
	'identifier' => 'method.nonObject',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/RequestToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getSignatureMethod() on string.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/RequestToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getVersion() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/RequestToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $httpClient might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/RequestToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getCallbackUrl() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/UserAuthorization.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getLastRequestToken() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/UserAuthorization.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getUserAuthorizationUrl() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/UserAuthorization.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $prefix of function uniqid expects string, int<0, max> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/Utility.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $privateKey of method Zend_Crypt_Rsa::sign() expects Zend_Crypt_Rsa_Key_Private|null, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Signature/Rsa.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Uri_Http::getUri() invoked with 1 parameter, 0 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Signature/SignatureAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Oauth_Client::setToken().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Token/Access.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Class Zend_Oauth_Client constructor invoked with 4 parameters, 1-3 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Token/Access.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_OpenId::createDhKey() has invalid return type OpenSSLAsymmetricKey.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $ascii of function chr expects int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $right_operand of function bcadd expects numeric-string, int<0, 255> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $right_operand of function bccomp expects numeric-string, 0 given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/OpenId.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $right_operand of function bcdiv expects numeric-string, 256 given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $right_operand of function bcmod expects numeric-string, 256 given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $right_operand of function bcmul expects numeric-string, 256 given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter &$id by-ref type of method Zend_OpenId::normalize() expects string, (string|false) given.',
	'identifier' => 'parameterByRef.type',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/OpenId.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $bn_pub_key might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/OpenId.php',
];
$ignoreErrors[] = [
	'rawMessage' => '',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Session_Namespace::$claimed_id.',
	'identifier' => 'property.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Session_Namespace::$identity.',
	'identifier' => 'property.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "+" between int<1, max> and string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Loose comparison using == between \'HMAC-SHA256\' and \'HMAC-SHA256\' will always evaluate to true.',
	'identifier' => 'equal.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Loose comparison using == between \'sha256\' and \'sha256\' will always evaluate to true.',
	'identifier' => 'equal.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #5 $expires of method Zend_OpenId_Consumer_Storage::addAssociation() expects long, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #5 $expires of method Zend_OpenId_Consumer_Storage::addDiscoveryInfo() expects long, int<3601, max> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #5 $expires of method Zend_OpenId_Consumer_Storage::getAssociation() expects long, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $expires of method Zend_OpenId_Consumer_Storage::addAssociation() has invalid type long.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $expires of method Zend_OpenId_Consumer_Storage::addDiscoveryInfo() has invalid type long.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $expires of method Zend_OpenId_Consumer_Storage::getAssociation() has invalid type long.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $expires of method Zend_OpenId_Consumer_Storage::getAssociationByHandle() has invalid type long.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $expires of method Zend_OpenId_Consumer_Storage::getDiscoveryInfo() has invalid type long.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_string() with string will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $recursive of function mkdir expects bool, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $expires of method Zend_OpenId_Consumer_Storage_File::addAssociation() has invalid type long.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $expires of method Zend_OpenId_Consumer_Storage_File::addDiscoveryInfo() has invalid type long.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $expires of method Zend_OpenId_Consumer_Storage_File::getAssociation() has invalid type long.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $expires of method Zend_OpenId_Consumer_Storage_File::getAssociationByHandle() has invalid type long.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $expires of method Zend_OpenId_Consumer_Storage_File::getDiscoveryInfo() has invalid type long.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between resource|false and null will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "^" between string|false and string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Provider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_string() with string will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Provider/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $recursive of function mkdir expects bool, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Provider/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between resource|false and null will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/OpenId/Provider/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Session_Namespace::$logged_in.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Provider/User/Session.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Controller_Action_Helper_Abstract::$view.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Paginator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Action_Helper_Abstract::initView().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Paginator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::paginationControl().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Paginator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Paginator::$_pages (array) does not accept stdClass.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Paginator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Db_Select::getTable().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Paginator/Adapter/DbTableSelect.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property RecursiveIterator::$next.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$items.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$ID.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Size.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Count.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Kids.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Names.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Pages.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Type.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Version.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object_Stream::$dictionary.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Reference::$AcroForm.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Reference::$Dests.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Reference::$JS.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Reference::$Kids.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Reference::$Names.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Reference::$Outlines.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Reference::$S.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Reference::$Version.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Trailer::$Info.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Trailer::$Root.',
	'identifier' => 'property.notFound',
	'count' => 16,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Trailer::$Size.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Trailer_Generator::$Root.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Trailer_Keeper::$Encrypt.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Trailer_Keeper::$Info.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Trailer_Keeper::$Root.',
	'identifier' => 'property.notFound',
	'count' => 5,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Element::add().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Element_Reference::getKeys().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Trailer::getPrev().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Action::dumpAction().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Outline_Loaded::__construct().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Target::getResource().',
	'identifier' => 'method.internal',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Expression "$root->Outlines->touch" on a separate line does not do anything.',
	'identifier' => 'expr.resultUnused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Pdf::_cleanUpAction() should return Zend_Pdf_Action|null but returns RecursiveIterator.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $factory of method Zend_Pdf_Action::dumpAction() expects Zend_Pdf_ElementFactory, Zend_Pdf_ElementFactory_Interface given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $prefix of function uniqid expects string, int<0, max> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Pdf::$_pageReferences (SplObjectStorage) does not accept array.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using !== between mixed and null will always evaluate to true.',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$S.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Next.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Next.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_GoTo constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_GoTo3DView constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_GoToE constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_GoToR constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_Hide constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_ImportData constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_JavaScript constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_Launch constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_Movie constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_Named constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_Rendition constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_ResetForm constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_SetOCGState constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_Sound constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_SubmitForm constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_Thread constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_Trans constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_URI constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dictionary of class Zend_Pdf_Action_Unknown constructor expects Zend_Pdf_Element_Dictionary, Zend_Pdf_Element given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$D.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/GoTo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Next.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/GoTo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$S.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/GoTo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Type.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/GoTo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$D.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/GoTo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Target::getResource().',
	'identifier' => 'method.internal',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/GoTo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal static method Zend_Pdf_Destination::load().',
	'identifier' => 'staticMethod.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/GoTo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$IsMap.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/URI.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Next.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/URI.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$S.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/URI.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Type.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/URI.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$URI.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/URI.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$IsMap.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/URI.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$URI.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Action/URI.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$Rect.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$Type.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Contents.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Rect.',
	'identifier' => 'property.notFound',
	'count' => 12,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Pdf_Annotation::$_annotationDictionary (Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference) does not accept Zend_Pdf_Element.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$Subtype.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/FileAttachment.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$F.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/FileAttachment.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$FS.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/FileAttachment.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Rect.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/FileAttachment.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Subtype.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/FileAttachment.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Type.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/FileAttachment.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$Subtype.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Link.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$A.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Link.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Dest.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Link.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Rect.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Link.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Subtype.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Link.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Type.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Link.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$A.',
	'identifier' => 'property.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Link.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Dest.',
	'identifier' => 'property.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Link.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Target::getResource().',
	'identifier' => 'method.internal',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Link.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal static method Zend_Pdf_Action::load().',
	'identifier' => 'staticMethod.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Link.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal static method Zend_Pdf_Destination::load().',
	'identifier' => 'staticMethod.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Link.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$Subtype.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Markup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Contents.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Markup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$QuadPoints.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Markup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Rect.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Markup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Subtype.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Markup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Type.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Markup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$Subtype.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Text.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Contents.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Text.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Rect.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Text.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Subtype.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Text.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Type.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Text.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Resource::getResource().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Canvas.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Resources.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Canvas/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Canvas_Interface::getContents().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Canvas/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Pdf_Style::instructions() invoked with 1 parameter, 0 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Canvas/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $box of method Zend_Pdf_Canvas_Abstract::drawLayoutBox() has invalid type Zend_Pdf_Element_LayoutBox.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Canvas/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $endAngle might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Canvas/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $box of method Zend_Pdf_Canvas_Interface::drawLayoutBox() has invalid type Zend_Pdf_Element_LayoutBox.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Canvas/Interface.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $subtableIndex might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 12,
	'path' => __DIR__ . '/library/Zend/Pdf/Cmap/SegmentToDelta.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$items.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Destination.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$items.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Destination/Explicit.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Pdf_Destination_Explicit::$_destinationArray (Zend_Pdf_Element_Array) does not accept Zend_Pdf_Element.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Destination/Explicit.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Page::getPageDictionary().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Destination/Fit.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Page::getPageDictionary().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Destination/FitBoundingBox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Page::getPageDictionary().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Destination/FitBoundingBoxHorizontally.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Page::getPageDictionary().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Destination/FitBoundingBoxVertically.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Page::getPageDictionary().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Destination/FitHorizontally.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Page::getPageDictionary().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Destination/FitRectangle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Page::getPageDictionary().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Destination/FitVertically.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Pdf_Destination_Named::$_nameElement (Zend_Pdf_Element_Name|Zend_Pdf_Element_String) does not accept Zend_Pdf_Element.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Destination/Named.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Page::getPageDictionary().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Destination/Zoom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $factory of method Zend_Pdf_Element::toString() has invalid type Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'ArrayObject<*NEVER*, *NEVER*> does not accept Zend_Pdf_Element.',
	'identifier' => 'offsetAssign.valueType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Array.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $factory of method Zend_Pdf_Element_Array::toString() has invalid type Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Array.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Pdf_Element_Array::$items (array) does not accept ArrayObject<*NEVER*, *NEVER*>.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Array.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using !== between null and null will always evaluate to false.',
	'identifier' => 'notIdentical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Array.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $factory of method Zend_Pdf_Element_Boolean::toString() has invalid type Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Boolean.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $factory of method Zend_Pdf_Element_Dictionary::toString() has invalid type Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Dictionary.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $ascii of function chr expects int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Name.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $factory of method Zend_Pdf_Element_Name::toString() has invalid type Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Name.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $factory of method Zend_Pdf_Element_Null::toString() has invalid type Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Null.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $factory of method Zend_Pdf_Element_Numeric::toString() has invalid type Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Numeric.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getEnumerationShift() on an unknown class Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $factory of method Zend_Pdf_Element::toString() expects Zend_Pdf_Factory|null, Zend_Pdf_ElementFactory given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $factory of method Zend_Pdf_Element_Object::toString() has invalid type Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$DecodeParms.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$F.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$FDecodeParms.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$FFilter.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Filter.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Length.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object_Stream::$dictionary.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Element::length().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $factory of method Zend_Pdf_Element::toString() expects Zend_Pdf_Factory|null, Zend_Pdf_ElementFactory given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getEnumerationShift() on an unknown class Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Reference.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $factory of method Zend_Pdf_Element_Reference::toString() has invalid type Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Reference.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Pdf_Element_Reference_Table::getNewGeneration() has invalid return type unknown.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Reference/Table.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $factory of method Zend_Pdf_Element_Stream::toString() has invalid type Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $factory of method Zend_Pdf_Element_String::toString() has invalid type Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/String.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $factory of method Zend_Pdf_Element_String_Binary::toString() has invalid type Zend_Pdf_Factory.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/String/Binary.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_ElementFactory_Interface::$_factoryId.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf/ElementFactory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Element_Object::compareFactory().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/ElementFactory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font::$fontType.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$ascent.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$averageCharWidth.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$baselineAtZero.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$capitalHeight.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$cmap.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$descent.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$fontWeight.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$fontWidth.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$glyphWidths.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isAdobeLatinSubset.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isBold.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isEmbeddable.',
	'identifier' => 'property.notFound',
	'count' => 5,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isItalic.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isMonospaced.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isOrnamentalFont.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isSansSerifFont.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isScriptFont.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isSerifFont.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isSubsettable.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isSymbolicFont.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$italicAngle.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$lineGap.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$metricDataFormat.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$names.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$numGlyphs.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$numberHMetrics.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$strikePosition.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$strikeThickness.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$subscriptXOffset.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$subscriptXSize.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$subscriptYOffset.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$subscriptYSize.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$superscriptXOffset.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$superscriptXSize.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$superscriptYOffset.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$superscriptYSize.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$underlinePosition.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$underlineThickness.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$unitsPerEm.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$useIntegerScaling.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$vendorID.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$xHeight.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$xMax.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$xMin.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$yMax.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$yMin.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $cmapLength might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $cmapOffset might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType_TrueType::$fontType.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType/TrueType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $hexCodeHigh might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Filter/AsciiHex.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $ascii of function chr expects int, float given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Filter/Compression.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $num of function array_fill expects int, float given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Filter/Compression.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $length of function substr expects int, float given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Filter/Compression.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Static method Zend_Pdf_Filter_Compression_Lzw::_getEarlyChangeValue() is unused.',
	'identifier' => 'method.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Filter/Compression/Lzw.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation ">" between int<129, 255> and 128 is always true.',
	'identifier' => 'greater.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Filter/RunLength.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between null and null will always evaluate to true.',
	'identifier' => 'identical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Font.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $imageFileName of class Zend_Pdf_Resource_Image_Png constructor expects string, Zend_Pdf_FileParser_Image_Png given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Image.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$Kids.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/NameTree.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$A.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Created.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$C.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Created.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Count.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Created.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Dest.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Created.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$F.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Created.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$First.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Created.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Last.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Created.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Parent.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Created.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Prev.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Created.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Title.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Created.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Action::getResource().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Created.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Target::getResource().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Created.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $resource of class Zend_Pdf_Destination_Named constructor expects Zend_Pdf_Element, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Created.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$Count.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$First.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$A.',
	'identifier' => 'property.notFound',
	'count' => 5,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$C.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Count.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Dest.',
	'identifier' => 'property.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$F.',
	'identifier' => 'property.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$First.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Last.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Next.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Parent.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Prev.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Title.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Action::getResource().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Target::getResource().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal static method Zend_Pdf_Action::load().',
	'identifier' => 'staticMethod.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal static method Zend_Pdf_Destination::load().',
	'identifier' => 'staticMethod.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Pdf_Outline_Loaded::$_outlineDictionary (Zend_Pdf_Element_Dictionary|Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference) does not accept Zend_Pdf_Element.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Right side of || is always true.',
	'identifier' => 'booleanOr.rightAlwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between Zend_Pdf_Color_Rgb and null will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Outline/Loaded.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Contents.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$LastModified.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$MediaBox.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Resources.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Type.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Annots.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Contents.',
	'identifier' => 'property.notFound',
	'count' => 11,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$MediaBox.',
	'identifier' => 'property.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$P.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::$Resources.',
	'identifier' => 'property.notFound',
	'count' => 20,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Element_Object|Zend_Pdf_Element_Reference::getKeys().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Annotation::getResource().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Resource::getFactory().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Resource::getResource().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Prev.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Parser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object_Stream::$dictionary.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Parser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Trailer_Keeper::$Prev.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Parser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Trailer_Keeper::$Size.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Parser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Trailer::getRefTable().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Parser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Page::clonePage().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Extractor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Type.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Ordering.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Registry.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Supplement.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$CIDSystemInfo.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$DW.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$W.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$ascent.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$cmap.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$descent.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$glyphWidths.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isBold.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isItalic.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isMonospaced.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$lineGap.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$names.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$strikePosition.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$strikeThickness.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$underlinePosition.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$underlineThickness.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$unitsPerEm.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Resource_Font::toEmSpace().',
	'identifier' => 'method.internal',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $charCodesSequense might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $sequenceStartCode might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$CIDToGIDMap.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont/TrueType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$FontDescriptor.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont/TrueType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Subtype.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont/TrueType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object_Stream::$dictionary.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont/TrueType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Cmap::getCoveredCharactersGlyphs().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont/TrueType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Pdf_Resource_Font_CidFont::__construct() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont/TrueType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Ascent.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$CapHeight.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Descent.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Flags.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$FontBBox.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$FontFile.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$FontFile2.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$FontFile3.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$FontName.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$ItalicAngle.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$MissingWidth.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$StemV.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Type.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object_Stream::$dictionary.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$ascent.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$capitalHeight.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$descent.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$glyphWidths.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isAdobeLatinSubset.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isEmbeddable.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isItalic.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isMonospaced.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isScriptFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isSerifFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$italicAngle.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$xMax.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$xMin.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$yMax.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$yMin.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Resource::getFactory().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Resource::getResource().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Resource_Font::toEmSpace().',
	'identifier' => 'method.internal',
	'count' => 6,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Class Zend_Pdf_FileParser_Font_OpenType_Type1 not found.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Encoding.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$FirstChar.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$LastChar.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Widths.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$ascent.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$cmap.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$descent.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$glyphWidths.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isBold.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isItalic.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$isMonospaced.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$lineGap.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$names.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$strikePosition.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$strikeThickness.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$underlinePosition.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$underlineThickness.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_FileParser_Font_OpenType::$unitsPerEm.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Resource_Font::toEmSpace().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$FontDescriptor.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed/TrueType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Subtype.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed/TrueType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Pdf_Resource_Font_Simple_Parsed::__construct() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed/TrueType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Subtype.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/Courier.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/CourierBold.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/CourierBoldOblique.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/CourierOblique.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/Helvetica.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/HelveticaBold.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/HelveticaBoldOblique.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/HelveticaOblique.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/Symbol.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Encoding.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/Symbol.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/TimesBold.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/TimesBoldItalic.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/TimesItalic.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/TimesRoman.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/ZapfDingbats.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Encoding.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Standard/ZapfDingbats.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BaseFont.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Type0.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$DescendantFonts.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Type0.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Encoding.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Type0.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$Subtype.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Type0.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$ToUnicode.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Type0.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Resource::getFactory().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Type0.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Pdf_Resource::getResource().',
	'identifier' => 'method.internal',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Type0.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Type.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/GraphicsState.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$BM.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/GraphicsState.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$CA.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/GraphicsState.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$ca.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/GraphicsState.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$dictionary.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$dictionary.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Jpeg.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Element_Object::skipFilters().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Jpeg.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Loose comparison using == between 9 and 9 will always evaluate to true.',
	'identifier' => 'equal.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Jpeg.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$BitsPerComponent.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Png.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Colors.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Png.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Columns.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Png.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Predictor.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Png.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$dictionary.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Png.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object_Stream::$dictionary.',
	'identifier' => 'property.notFound',
	'count' => 20,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Png.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Element_Object::skipFilters().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Png.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Object::$dictionary.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Tiff.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Element_Object::skipFilters().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Tiff.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $refOffset might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Tiff.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $value might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 9,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Image/Tiff.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element_Dictionary::$Length.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/StringParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Empty array passed to foreach.',
	'identifier' => 'foreach.emptyArray',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/StringParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Loose comparison using != between 10 and 13 will always evaluate to true.',
	'identifier' => 'notEqual.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/StringParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Pdf_StringParser::getObject() should return Zend_Pdf_Element_Object but returns Zend_Pdf_Element_Null.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/StringParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Result of || is always true.',
	'identifier' => 'booleanOr.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/StringParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $value on float.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Style.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method toString() on float.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Style.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Pdf_Style::$_lineDashingPhase (float) does not accept Zend_Pdf_Element_Numeric.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Style.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$D.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Target.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$S.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Target.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$Type.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Target.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal static method Zend_Pdf_Action::load().',
	'identifier' => 'staticMethod.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Target.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal static method Zend_Pdf_Destination::load().',
	'identifier' => 'staticMethod.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Target.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $current on string.',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/ProgressBar.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $isSet on string.',
	'identifier' => 'property.nonObject',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/ProgressBar.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $startTime on string.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/ProgressBar.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $statusText on string.',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/ProgressBar.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_ProgressBar::$_persistenceNamespace (string) does not accept Zend_Session_Namespace.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/ProgressBar.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $input of function str_pad expects string, float given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/ProgressBar/Adapter/Console.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $multiplier of function str_repeat expects int, float given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/ProgressBar/Adapter/Console.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $spec of class Zend_Queue constructor expects array|string|Zend_Config|Zend_Queue_Adapter|null, Zend_Queue_Adapter_AdapterInterface given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $spec of method Zend_Queue::__construct() has invalid type Zend_Queue_Adapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Queue_Message::$handle.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Activemq.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Queue_Message::$handle.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Array.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Queue_Message::$queue_name.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Array.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $prefix of function uniqid expects string, int<0, max> given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Array.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Db_Table_Row_Abstract::$body.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Db.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Db_Table_Row_Abstract::$created.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Db.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Db_Table_Row_Abstract::$md5.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Db.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Db_Table_Row_Abstract::$queue_id.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Db.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Db_Table_Row_Abstract::$queue_name.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Db.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Db_Table_Row_Abstract::$timeout.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Db.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Queue_Message::$handle.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Db.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $prefix of function uniqid expects string, int<0, max> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Db.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $prefix of function uniqid expects string, int<0, max> given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Memcacheq.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $errno might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Memcacheq.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $errstr might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Memcacheq.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Queue_Message::getJobId().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/PlatformJobQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method addJob() on an unknown class ZendApi_JobQueue.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/PlatformJobQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getJob() on an unknown class ZendApi_JobQueue.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/PlatformJobQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getJobsInQueue() on an unknown class ZendApi_JobQueue.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/PlatformJobQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getLastError() on an unknown class ZendApi_JobQueue.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/PlatformJobQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getNumOfJobsInQueue() on an unknown class ZendApi_JobQueue.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/PlatformJobQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method removeJob() on an unknown class ZendApi_JobQueue.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/PlatformJobQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Negated boolean expression is always false.',
	'identifier' => 'booleanNot.alwaysFalse',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/PlatformJobQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Queue_Adapter_PlatformJobQueue::$_zendQueue (ZendApi_JobQueue) does not accept ZendAPI_Queue.',
	'identifier' => 'assign.propertyType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/PlatformJobQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Queue_Adapter_PlatformJobQueue::$_zendQueue has unknown class ZendApi_JobQueue as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/PlatformJobQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (ArrayIterator) of method Zend_Queue_Adapter_PlatformJobQueue::receive() should be compatible with return type (Zend_Queue_Message_Iterator) of method Zend_Queue_Adapter_AdapterInterface::receive()',
	'identifier' => 'method.childReturnType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/PlatformJobQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset \'queue\' on array{data: mixed} in empty() does not exist.',
	'identifier' => 'empty.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Message/Iterator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function serialize invoked with 3 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Message/PlatformJob.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Queue_Message_PlatformJob::__sleep() should return array<int, string> but returns string.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Message/PlatformJob.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Queue_Stomp_Client::send() has invalid return type StompClientMock.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Stomp/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $mode of function stream_set_blocking expects bool, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Stomp/Client/Connection.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Reflector::getStartLine().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Reflection/Docblock.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Right side of && is always true.',
	'identifier' => 'booleanAnd.rightAlwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Reflection/Docblock/Tag.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $foundRealpath might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Reflection/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $input of function array_splice is passed by reference, so it expects variables only.',
	'identifier' => 'argument.byRef',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Reflection/Function.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $firstLine might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Reflection/Method.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Rest_Client::$_uri (Zend_Uri_Http) does not accept Zend_Uri.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $callback of function set_error_handler expects (callable(int, string, string, int, array): bool)|null, array{$this(Zend_Rest_Client_Result), \'handleXmlErrors\'} given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Client/Result.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Request_Abstract::getHeader().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Rest/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Request_Abstract::getMethod().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Controller_Request_Abstract::getPathInfo().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Rest/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $request (Zend_Controller_Request_Http) of method Zend_Rest_Route::match() should be compatible with parameter $path (string) of method Zend_Controller_Router_Route_Module::match()',
	'identifier' => 'method.childParameterType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Right side of && is always true.',
	'identifier' => 'booleanAnd.rightAlwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unsafe usage of new static().',
	'identifier' => 'new.static',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Class::getName().',
	'identifier' => 'method.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Rest/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Function_Abstract::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Function|Zend_Server_Reflection_Method::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Function|Zend_Server_Reflection_Method::getParameters().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Method::isPublic().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Method::isStatic().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $exception_handler of function set_exception_handler expects (callable(Throwable): void)|null, array{$this(Zend_Rest_Server), \'fault\'} given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $callback of function array_walk expects callable(int|string, int<0, max>): mixed, array{\'Zend_Rest_Server\', \'lowerCase\'} given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Search_Lucene::termDocsFilter() should return Zend_Search_Lucene_Index_DocsFilter but returns array.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $number of function base_convert expects string, int<min, -1>|int<1, max> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #6 $isTokenized of class Zend_Search_Lucene_Field constructor expects bool, int<0, 1> given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Search/Lucene.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unreachable statement - code above always terminates.',
	'identifier' => 'deadCode.unreachable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $isCompound might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $segInfo might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Search/Lucene.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $segmentInfo might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 5,
	'path' => __DIR__ . '/library/Zend/Search/Lucene.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $subResults might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNode::$tagName.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Document/Html.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMNameSpaceNode|DOMNode::getAttribute().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Document/Html.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $node of method Zend_Search_Lucene_Document_Html::_highlightTextNode() expects DOMText, DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Document/Html.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $callback of function array_filter expects (callable(string): bool)|null, \'strlen\' given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Document/OpenXml.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function bitset_empty not found.',
	'identifier' => 'function.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function bitset_in not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function bitset_incl not found.',
	'identifier' => 'function.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function bitset_to_array not found.',
	'identifier' => 'function.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function bitset_union not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @param references unknown parameter: $mode',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @param references unknown parameter: $startId',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $number of function base_convert expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $number of function base_convert expects string, int<min, -1>|int<1, max> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $multiplier of function str_repeat expects int, float given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Search_Lucene_Index_SegmentInfo::$_usesSharedDocStore (bool) is never assigned false so the property type can be changed to true.',
	'identifier' => 'property.tooWideBool',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $dataOffset might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $docFreq might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $fileName might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $skipOffset might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #6 $isTokenized of class Zend_Search_Lucene_Field constructor expects bool, int<0, 1> given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentMerger.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Search_Lucene_Index_SegmentMerger::$_fieldsMap is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentMerger.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Search_Lucene_Storage_File::close().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/Writer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Search_Lucene_Storage_Directory::createFile() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/Writer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $number of function base_convert expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/Writer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $docStoreIsCompoundFile might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/Writer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $docStoreOffset might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/Writer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $docStoreSegment might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/Writer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $isCompound might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/Writer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $normGens might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/Writer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Search_Lucene_Interface::addReference().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Proxy.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to internal method Zend_Search_Lucene_Interface::removeReference().',
	'identifier' => 'method.internal',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Proxy.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Search_Lucene_Search_Query::$_currentColorIndex is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Query.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Search_Lucene_Search_Query::$_weight (Zend_Search_Lucene_Search_Weight) does not accept null.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Query.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $termDocs might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Query/MultiTerm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Search_Lucene_Search_Query_Phrase::$_weights is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Query/Phrase.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to property $_matches of internal class Zend_Search_Lucene_Search_Query_Preprocessing.',
	'identifier' => 'property.internalClass',
	'count' => 5,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Query/Preprocessing/Fuzzy.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Class Zend_Search_Lucene_Search_Query_Preprocessing_Fuzzy extends internal class Zend_Search_Lucene_Search_Query_Preprocessing.',
	'identifier' => 'class.extendsInternalClass',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Query/Preprocessing/Fuzzy.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to property $_matches of internal class Zend_Search_Lucene_Search_Query_Preprocessing.',
	'identifier' => 'property.internalClass',
	'count' => 5,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Query/Preprocessing/Phrase.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Class Zend_Search_Lucene_Search_Query_Preprocessing_Phrase extends internal class Zend_Search_Lucene_Search_Query_Preprocessing.',
	'identifier' => 'class.extendsInternalClass',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Query/Preprocessing/Phrase.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to property $_matches of internal class Zend_Search_Lucene_Search_Query_Preprocessing.',
	'identifier' => 'property.internalClass',
	'count' => 7,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Query/Preprocessing/Term.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Class Zend_Search_Lucene_Search_Query_Preprocessing_Term extends internal class Zend_Search_Lucene_Search_Query_Preprocessing.',
	'identifier' => 'class.extendsInternalClass',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Query/Preprocessing/Term.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method __construct() of internal class Zend_Search_Lucene_Search_Query_Preprocessing_Phrase.',
	'identifier' => 'method.internalClass',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/QueryEntry/Phrase.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method setSlop() of internal class Zend_Search_Lucene_Search_Query_Preprocessing_Phrase.',
	'identifier' => 'method.internalClass',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/QueryEntry/Phrase.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instantiation of internal class Zend_Search_Lucene_Search_Query_Preprocessing_Phrase.',
	'identifier' => 'new.internalClass',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/QueryEntry/Phrase.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method __construct() of internal class Zend_Search_Lucene_Search_Query_Preprocessing_Fuzzy.',
	'identifier' => 'method.internalClass',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/QueryEntry/Term.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method __construct() of internal class Zend_Search_Lucene_Search_Query_Preprocessing_Term.',
	'identifier' => 'method.internalClass',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/QueryEntry/Term.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instantiation of internal class Zend_Search_Lucene_Search_Query_Preprocessing_Fuzzy.',
	'identifier' => 'new.internalClass',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/QueryEntry/Term.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instantiation of internal class Zend_Search_Lucene_Search_Query_Preprocessing_Term.',
	'identifier' => 'new.internalClass',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/QueryEntry/Term.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $position on int|string.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/QueryParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $text on int|string.',
	'identifier' => 'property.nonObject',
	'count' => 9,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/QueryParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $type on int|string.',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/QueryParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Invalid type Zend_Search_Lucene to throw.',
	'identifier' => 'throw.notThrowable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/QueryParserContext.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Search_Lucene_Search_Query::getSigns().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Weight/Boolean.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Search_Lucene_Search_Query::getSubqueries().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Weight/Boolean.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Search_Lucene_Search_Weight_Boolean::$_reader is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Weight/Boolean.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Search_Lucene_Search_Query::getSigns().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Weight/MultiTerm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Search_Lucene_Search_Query::getTerms().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Weight/MultiTerm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Search_Lucene_Search_Query::setWeight().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Weight/MultiTerm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Search_Lucene_Search_Weight_MultiTerm::$_reader is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Weight/MultiTerm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Serializer::getDefaultAdapter() has invalid return type Zend_Serializer_AdapterInterface.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Serializer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $serialized of method Zend_Serializer_Adapter_Igbinary::unserialize() has invalid type binary.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Serializer/Adapter/Igbinary.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Undefined variable: $ret',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Serializer/Adapter/PhpCode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between string and false will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Serializer/Adapter/PhpSerialize.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Serializer_Adapter_PythonPickle::setOption() should return Zend_Serializer_Adapter_PythonPickle but returns Zend_Serializer_Adapter_AdapterAbstract.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Serializer/Adapter/PythonPickle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $base of function bcpow expects numeric-string, 2 given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Serializer/Adapter/PythonPickle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $base of function bcpow expects numeric-string, 256 given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Serializer/Adapter/PythonPickle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $left_operand of function bcmul expects numeric-string, int<0, 255> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Serializer/Adapter/PythonPickle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $exponent of function bcpow expects numeric-string, int<0, max> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Serializer/Adapter/PythonPickle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $exponent of function bcpow expects numeric-string, int<64, max> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Serializer/Adapter/PythonPickle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Result of method Zend_Serializer_Adapter_PythonPickle::_write() (void) is used.',
	'identifier' => 'method.void',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Serializer/Adapter/PythonPickle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function wddx_deserialize not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Serializer/Adapter/Wddx.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function wddx_serialize_value not found.',
	'identifier' => 'function.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Serializer/Adapter/Wddx.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Class::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Server/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Function::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Server/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Function_Abstract::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Server/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Method::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Server/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Method::isStatic().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Server/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $parameter of method Zend_Server_Method_Prototype::addParameter() expects string, Zend_Server_Method_Parameter given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Server/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Class::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Server/Reflection/Class.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Function_Abstract::getName().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Server/Reflection/Function/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Class::getName().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Server/Reflection/Method.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Method::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Server/Reflection/Method.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using !== between null and mixed will always evaluate to true.',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Server/Reflection/Node.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/Amazon.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Amazon_Item constructor expects DOMElement|null, DOMNameSpaceNode|DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Accessories.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/CustomerReview.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $region in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Ec2/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $keyName of method Zend_Service_Amazon_Ec2_Keypair::describe() has invalid type rarray.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Ec2/Keypair.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Service_Amazon_Ec2_Response::$_errorCode is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Ec2/Response.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Service_Amazon_Ec2_Response::$_errorMessage is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Ec2/Response.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/EditorialReview.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Image.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 13,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Amazon_Accessories constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Amazon_CustomerReview constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Amazon_EditorialReview constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Amazon_Image constructor expects DOMElement, DOMNameSpaceNode|DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Amazon_ListmaniaList constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Amazon_SimilarProduct constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Service_Amazon_Item::$ListmaniaLists has unknown class Zend_Service_Amazon_ListmaniaLists as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Service_Amazon_Item::$SimilarProducts has unknown class Zend_Service_Amazon_SimilarProducts as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/ListmaniaList.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 8,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Offer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 8,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/OfferSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Amazon_Offer constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/OfferSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between null and \'asin\' will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Query.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/ResultSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Amazon_Item constructor expects DOMElement|null, DOMNameSpaceNode|DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/ResultSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Service_Amazon_Abstract::__construct() invoked with 3 parameters, 0-2 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/S3.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Service_Amazon_S3::$_endpoint (Zend_Uri_Http) does not accept Zend_Uri.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/S3.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Service_Amazon_SimpleDb_Response::$_errorCode is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/SimpleDb/Response.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Service_Amazon_SimpleDb_Response::$_errorMessage is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/SimpleDb/Response.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Service_Amazon_Abstract::__construct() invoked with 3 parameters, 0-2 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Sqs.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unreachable statement - code above always terminates.',
	'identifier' => 'deadCode.unreachable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Sqs.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $callback of function set_error_handler expects (callable(int, string, string, int, array): bool)|null, array{$this(Zend_Service_Audioscrobbler), \'_errorHandler\'} given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Audioscrobbler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_null() with null will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Console/Command.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $commands on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Console/Command.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $description on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Console/Command.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $footers on array.',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/Console/Command.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $headers on array.',
	'identifier' => 'property.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/Console/Command.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $exception_handler of function set_exception_handler expects (callable(Throwable): void)|null, array{\'Zend_Service…\', \'phpstdex\'} given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Console/Command.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $parameters of function call_user_func_array expects array<int, mixed>, array<int|string, mixed> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Console/Command.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_null() with array<string, string>|string|false will always evaluate to false.',
	'identifier' => 'function.impossibleType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Console/Command/ParameterSource/Env.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMNode::getAttribute().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/Delicious.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $micro_seconds of function usleep expects int, float given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Delicious.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $values of class Zend_Service_Delicious_Post constructor expects array|DOMElement, DOMNameSpaceNode|DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Delicious/PostList.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Response_Histograms constructor expects DOMElement, DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Response_Items constructor expects DOMElement, DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Response_Keywords constructor expects DOMElement, DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMDocument::$ebayFindingXPath.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Aspect_Histogram_Value constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Aspect/Histogram/Value/Set.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Aspect constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Aspect/Set.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Category_Histogram constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Category/Histogram/Set.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Error_Data constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Error/Data/Set.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Error_Message constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Response/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Aspect_Histogram_Container constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Response/Histograms.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Category_Histogram_Container constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Response/Histograms.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_PaginationOutput constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Response/Items.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Search_Result constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Response/Items.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Category constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Search/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_ListingInfo constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Search/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_SellerInfo constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Search/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_SellingStatus constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Search/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_ShippingInfo constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Search/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Storefront constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Search/Item.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $dom of class Zend_Service_Ebay_Finding_Search_Item constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Ebay/Finding/Search/Item/Set.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMNameSpaceNode|DOMNode::getAttribute().',
	'identifier' => 'method.notFound',
	'count' => 5,
	'path' => __DIR__ . '/library/Zend/Service/Flickr.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $image of class Zend_Service_Flickr_Image constructor expects DOMElement, DOMNameSpaceNode|DOMNode given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Flickr.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $options of class Zend_Validate_Between constructor expects array|Zend_Config, int given.',
	'identifier' => 'argument.type',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Service/Flickr.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$name.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Flickr/Result.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$value.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Flickr/Result.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMNameSpaceNode|DOMNode::getAttribute().',
	'identifier' => 'method.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Service/Flickr/ResultSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $image of class Zend_Service_Flickr_Result constructor expects DOMElement, DOMNameSpaceNode|DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Flickr/ResultSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::LogIn().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::LogOut().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::CreateDocument().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::DeleteImage().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::DeleteSharedDocument().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::DeleteTemplate().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::DownloadImage().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::DownloadSharedDocument().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::DownloadTemplate().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::GetAllBitmaps().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::GetAllMetafiles().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::GetBitmaps().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::GetBlockFieldNames().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::GetBlockNames().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::GetDocumentAccessOptions().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::GetDocumentFormats().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::GetFieldNames().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::GetFontNames().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::GetImageExportFormats().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::GetImageImportFormats().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::GetMetafiles().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::GetTemplateFormats().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::ImageExists().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::ListImages().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::ListSharedDocuments().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::ListTemplates().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::RetrieveDocument().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::SetBlockFieldValues().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::SetDocumentAccessPermissions().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::SetDocumentPassword().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::SetFieldValues().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::SetLocalTemplate().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::SetRemoteTemplate().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::ShareDocument().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::TemplateExists().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::UploadImage().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Soap_Client::UploadTemplate().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $ArrayOfString on array.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Service_LiveDocx_MailMerge::__construct() has invalid return type throws.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Service_Rackspace_Abstract::$httpClient (Zend_Http_Client) in empty() is not falsy.',
	'identifier' => 'empty.property',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Rackspace/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with non-empty-array will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Rackspace/Servers.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $service of class Zend_Service_Rackspace_Servers_ImageList constructor expects RackspaceServers, $this(Zend_Service_Rackspace_Servers) given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Rackspace/Servers.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $str of function rawurlencode expects string, int<min, -1>|int<1, max> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Rackspace/Servers.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $service of method Zend_Service_Rackspace_Servers_ImageList::__construct() has invalid type RackspaceServers.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Rackspace/Servers/ImageList.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constant MCRYPT_MODE_CBC not found.',
	'identifier' => 'constant.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/ReCaptcha/MailHide.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Constant MCRYPT_RIJNDAEL_128 not found.',
	'identifier' => 'constant.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/ReCaptcha/MailHide.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Function mcrypt_encrypt not found.',
	'identifier' => 'function.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/ReCaptcha/MailHide.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMNode::getAttribute().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/ShortUrl/TinyUrlCom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_null() with mixed will always evaluate to false.',
	'identifier' => 'function.impossibleType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/SqlAzure/Management/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property SoapHeader::$name.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/StrikeIron/Base.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 ...$args of function array_merge expects array, SimpleXMLElement given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/CommandLine/Package.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Default value of the parameter #4 $mode (string) of method Zend_Service_WindowsAzure_CommandLine_PackageScaffolder_PackageScaffolderAbstract::copyDirectory() is incompatible with type octal.',
	'identifier' => 'parameter.defaultValue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/CommandLine/PackageScaffolder/PackageScaffolderAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $mode of function chmod expects int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/CommandLine/PackageScaffolder/PackageScaffolderAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $mode of function mkdir expects int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/CommandLine/PackageScaffolder/PackageScaffolderAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $mode of method Zend_Service_WindowsAzure_CommandLine_PackageScaffolder_PackageScaffolderAbstract::copyDirectory() has invalid type octal.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/CommandLine/PackageScaffolder/PackageScaffolderAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Negated boolean expression is always true.',
	'identifier' => 'booleanNot.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Credentials/SharedKey.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unreachable statement - code above always terminates.',
	'identifier' => 'deadCode.unreachable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Diagnostics/Manager.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (Zend_Service_WindowsAzure_Storage_DynamicTableEntity) of method Zend_Service_WindowsAzure_Log_Formatter_WindowsAzure::format() should be compatible with return type (string) of method Zend_Log_Formatter_Interface::format()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Log/Formatter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_null() with mixed will always evaluate to false.',
	'identifier' => 'function.impossibleType',
	'count' => 9,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Management/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Path in require_once() "Zend/Service/Management/Exception.php" is not a file or it does not exist.',
	'identifier' => 'requireOnce.fileNotFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Management/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Service_WindowsAzure_Storage_DynamicTableEntity::$serializedData.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/SessionHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Service_WindowsAzure_Storage_DynamicTableEntity::$sessionExpires.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/SessionHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Service_WindowsAzure_Storage_TableEntity::$serializedData.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/SessionHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_null() with mixed will always evaluate to false.',
	'identifier' => 'function.impossibleType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Blob.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_null() with string will always evaluate to false.',
	'identifier' => 'function.impossibleType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Blob.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_null() with string will always evaluate to false.',
	'identifier' => 'function.impossibleType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Queue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $options of class Zend_Validate_Between constructor expects array|Zend_Config, int given.',
	'identifier' => 'argument.type',
	'count' => 7,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo/Image.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $result of class Zend_Service_Yahoo_ImageResult constructor expects DOMElement, DOMNameSpaceNode|DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo/ImageResultSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $result of class Zend_Service_Yahoo_InlinkDataResult constructor expects DOMElement, DOMNameSpaceNode|DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo/InlinkDataResultSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo/LocalResultSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $result of class Zend_Service_Yahoo_LocalResult constructor expects DOMElement, DOMNameSpaceNode|DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo/LocalResultSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $result of class Zend_Service_Yahoo_NewsResult constructor expects DOMElement, DOMNameSpaceNode|DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo/NewsResultSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $result of class Zend_Service_Yahoo_PageDataResult constructor expects DOMElement, DOMNameSpaceNode|DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo/PageDataResultSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNameSpaceNode|DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo/Result.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc type Zend_Service_Yahoo_Video of property Zend_Service_Yahoo_VideoResult::$Thumbnail is not covariant with PHPDoc type Zend_Service_Yahoo_Image|null of overridden property Zend_Service_Yahoo_Result::$Thumbnail.',
	'identifier' => 'property.phpDocType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo/VideoResult.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Service_Yahoo_VideoResult::$Thumbnail has unknown class Zend_Service_Yahoo_Video as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo/VideoResult.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $result of class Zend_Service_Yahoo_VideoResult constructor expects DOMElement, DOMNameSpaceNode|DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo/VideoResultSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNode::$data.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo/WebResult.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $result of class Zend_Service_Yahoo_WebResult constructor expects DOMElement, DOMNameSpaceNode|DOMNode|null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Yahoo/WebResultSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $callback of function set_error_handler expects (callable(int, string, string, int, array): bool)|null, array{\'Zend_Session…\', \'handleSessionStartE…\'} given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Session.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $callback of function set_error_handler expects (callable(int, string, string, int, array): bool)|null, array{\'Zend_Session…\', \'handleSilentWriteCl…\'} given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Session.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $value of function setcookie expects string, false given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Session.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Session::$_throwStartupExceptions has unknown class bitset as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Session.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Function_Abstract::getName().',
	'identifier' => 'method.notFound',
	'count' => 15,
	'path' => __DIR__ . '/library/Zend/Soap/AutoDiscover.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $options of method SoapClient::__soapCall() expects array, null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Soap/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between string|false and null will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Soap/Client/Local.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method __toString() on stdClass.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Soap/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $callback of function set_error_handler expects (callable(int, string, string, int, array): bool)|null, array{$this(Zend_Soap_Server), \'handlePhpErrors\'} given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Soap/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $newvalue of function ini_set expects string, bool given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Soap/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $newvalue of function ini_set expects string, false given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Soap/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $xml might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Soap/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $complexTypeName might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Soap/Wsdl/Strategy/ArrayOfTypeSequence.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method get() on an unknown class WeakRef.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Stdlib/CallbackHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Class WeakRef not found.',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Stdlib/CallbackHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instantiated class WeakRef not found.',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Stdlib/CallbackHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $callback of function set_error_handler expects (callable(int, string, string, int, array): bool)|null, array{$this(Zend_Stdlib_CallbackHandler), \'errorHandler\'} given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Stdlib/CallbackHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Stdlib_CallbackHandler::$callback (array|string) does not accept WeakRef.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Stdlib/CallbackHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Right side of || is always false.',
	'identifier' => 'booleanOr.rightAlwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Stdlib/CallbackHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $key might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Stdlib/PriorityQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to sscanf contains 11 placeholders, 7 values given.',
	'identifier' => 'argument.sscanf',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Text/Figlet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using !== between non-falsy-string and \'0\' will always evaluate to true.',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Text/Figlet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between mixed~\' \' and \' \' will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Text/Figlet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $lastSpace might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Text/Figlet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $multiplier of function str_repeat expects int, float given.',
	'identifier' => 'argument.type',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Text/MultiByte.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $length of function iconv_substr expects int, float given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Text/MultiByte.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between int<0, max>|false and null will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Text/MultiByte.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $lastColumnWidths might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Text/Table.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $padMode might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Text/Table/Column.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $input of function array_sum expects an array of values castable to number, array given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Text/Table/Row.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Right side of && is always true.',
	'identifier' => 'booleanAnd.rightAlwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/TimeSync.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $masterException might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/TimeSync.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "&" between non-falsy-string and 131071 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/TimeSync/Ntp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation ">>" between non-falsy-string and 17 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/TimeSync/Ntp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $input of function str_pad expects string, int<0, 255> given.',
	'identifier' => 'argument.type',
	'count' => 8,
	'path' => __DIR__ . '/library/Zend/TimeSync/Ntp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $date of class Zend_Date constructor expects array|int|string|Zend_Date|null, $this(Zend_TimeSync_Protocol) given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/TimeSync/Protocol.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Config::$resources.',
	'identifier' => 'property.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Tool/DatabaseSchemaProvider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Registry_Interface::getConfig().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/DatabaseSchemaProvider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::getPath().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/DatabaseSchemaProvider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Class Zend_Db_Adapter_Interface not found.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/DatabaseSchemaProvider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Tool_DatabaseSchemaProvider::_getDbAdapter() has invalid return type Zend_Db_Adapter_Interface.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/DatabaseSchemaProvider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $db of class Zend_Db_Schema_Manager constructor expects Zend_Db_Adapter_Abstract, Zend_Db_Adapter_Interface given.',
	'identifier' => 'argument.type',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Tool/DatabaseSchemaProvider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Tool_DatabaseSchemaProvider::$_db (Zend_Db_Adapter_Interface) does not accept Zend_Db_Adapter_Abstract.',
	'identifier' => 'assign.propertyType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/DatabaseSchemaProvider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Tool_DatabaseSchemaProvider::$_db has unknown class Zend_Db_Adapter_Interface as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/DatabaseSchemaProvider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Tool_Framework_Action_Repository::process() has invalid return type unknown.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Action/Repository.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $client of method Zend_Tool_Framework_Client_Interactive_InputHandler::setClient() expects Zend_Tool_Framework_Client_Interactive_InputInterface, $this(Zend_Tool_Framework_Client_Abstract) given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Tool_Framework_Client_Abstract::$_interactiveCallback has unknown class callback as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Tool_Framework_Client_Abstract::$_registry (Zend_Tool_Framework_Registry) does not accept Zend_Tool_Framework_Registry_Interface.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Tool_Framework_Client_Config::__set() with return type void returns mixed but should not return anything.',
	'identifier' => 'return.void',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Config.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Manifest_Metadata::getActionName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/ArgumentParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Manifest_Metadata::getProviderName().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/ArgumentParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Manifest_Metadata::getReference().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/ArgumentParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Manifest_Metadata::getSpecialtyName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/ArgumentParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Manifest_Metadata::getValue().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/ArgumentParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Manifest_Metadata::getActionName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/HelpSystem.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Manifest_Metadata::getProviderName().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/HelpSystem.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Manifest_Metadata::getReference().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/HelpSystem.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Manifest_Metadata::getValue().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/HelpSystem.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $providerMetadata of method Zend_Tool_Framework_Client_Console_HelpSystem::_respondWithCommand() expects Zend_Tool_Framework_Metadata_Tool, Zend_Tool_Framework_Manifest_Metadata given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/HelpSystem.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $providerMetadata of method Zend_Tool_Framework_Client_Console_HelpSystem::_respondWithProviderName() expects Zend_Tool_Framework_Metadata_Tool, Zend_Tool_Framework_Manifest_Metadata given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/HelpSystem.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $actionMetadata of method Zend_Tool_Framework_Client_Console_HelpSystem::_respondWithCommand() expects Zend_Tool_Framework_Metadata_Tool, Zend_Tool_Framework_Manifest_Metadata given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/HelpSystem.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $specialtyMetadata of method Zend_Tool_Framework_Client_Console_HelpSystem::_respondWithCommand() expects Zend_Tool_Framework_Metadata_Tool, Zend_Tool_Framework_Manifest_Metadata given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/HelpSystem.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #4 $parameterLongMetadata of method Zend_Tool_Framework_Client_Console_HelpSystem::_respondWithCommand() expects Zend_Tool_Framework_Metadata_Tool, Zend_Tool_Framework_Manifest_Metadata given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/HelpSystem.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Iterator<mixed, mixed>::getChildren().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Loader/IncludePathLoader/RecursiveFilterIterator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Default value of the parameter #1 $type (string) of method Zend_Tool_Framework_Metadata_Basic::getAttributes() is incompatible with type const.',
	'identifier' => 'parameter.defaultValue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Metadata/Basic.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $type of method Zend_Tool_Framework_Metadata_Basic::getAttributes() has invalid type const.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Metadata/Basic.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Tool_Framework_Metadata_Dynamic::__set() with return type void returns $this(Zend_Tool_Framework_Metadata_Dynamic) but should not return anything.',
	'identifier' => 'return.void',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Metadata/Dynamic.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instanceof between Zend_Tool_Framework_Provider_Signature and Zend_Tool_Framework_Registry_EnabledInterface will always evaluate to true.',
	'identifier' => 'instanceof.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Provider/Repository.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Provider_Interface::getSpecialties().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Provider/Signature.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Tool_Framework_Registry::$_loader (Zend_Tool_Framework_Loader_Abstract) does not accept Zend_Tool_Framework_Loader_Interface.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Registry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Tool_Framework_Client_Config::$basicloader.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/System/Provider/Config.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Registry_Interface::getConfig().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/System/Provider/Config.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "==" between *NEVER* and int<1, max> results in an error.',
	'identifier' => 'equal.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/System/Provider/Config.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $prefix of function http_build_query expects string, null given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/System/Provider/Manifest.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Tool_Framework_Registry_Interface::$response.',
	'identifier' => 'property.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/System/Provider/Version.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Tool_Project_Context_Content_Engine::getContent() should return false but returns mixed.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Content/Engine.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "." between non-falsy-string and Zend_Tool_Project_Context_Interface results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Content/Engine/Phtml.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getContext().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Filesystem/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::create().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Filesystem/Directory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method exists() on an unknown class Zend_Tool_Project_Context.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Filesystem/Directory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::create().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Filesystem/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method exists() on an unknown class Zend_Tool_Project_Context.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Filesystem/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getContext().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/ActionMethod.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Tool_Project_Context_Zf_ActionMethod::$_controllerResource (Zend_Tool_Project_Profile_Resource) does not accept Zend_Tool_Project_Profile_Resource_Container.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/ActionMethod.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::getPath().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/BootstrapFile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method exists() on string|Zend_Tool_Project_Context.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/BootstrapFile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getContext().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/TestApplicationActionMethod.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getForControllerName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/TestApplicationActionMethod.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getForModuleName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/TestApplicationActionMethod.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/TestApplicationActionMethod.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Tool_Project_Context_Zf_TestApplicationActionMethod::$_testApplicationControllerResource (Zend_Tool_Project_Profile_Resource) does not accept Zend_Tool_Project_Profile_Resource_Container.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/TestApplicationActionMethod.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getForModuleName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/TestApplicationControllerFile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/TestApplicationControllerFile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getModuleName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/ViewScriptFile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/ViewScriptFile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Tool_Project_Profile_Resource_Container::append() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Profile/FileParser/Xml.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $resources of method Zend_Tool_Project_Profile_FileParser_Xml::_serializeRecurser() expects array, Zend_Tool_Project_Profile given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Profile/FileParser/Xml.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Iterator<mixed, mixed>::getChildren().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Profile/Iterator/ContextFilter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getName() on an unknown class Zend_Tool_Project_Context.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Profile/Resource.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getName() on string|Zend_Tool_Project_Context.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Profile/Resource.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Tool_Project_Profile_Resource::getContext() has invalid return type Zend_Tool_Project_Context.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Profile/Resource.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Tool_Project_Profile_Resource::$_context has unknown class Zend_Tool_Project_Context as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Profile/Resource.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property ArrayObject::$name.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Profile/Resource/Container.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property ArrayObject::$params.',
	'identifier' => 'property.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Profile/Resource/Container.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot cast $this(Zend_Tool_Project_Profile_Resource_Container) to string.',
	'identifier' => 'cast.string',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Profile/Resource/Container.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $name might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Profile/Resource/SearchConstraints.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $params might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Profile/Resource/SearchConstraints.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Registry_Interface::getStorage().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::loadProviders().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getPath() on string|Zend_Tool_Project_Context.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method save() on string|Zend_Tool_Project_Context.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::create().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getContext().',
	'identifier' => 'method.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getPath() on string|Zend_Tool_Project_Context.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::addStringItem().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Application.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::create().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Application.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::getAsZendConfig().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Application.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::removeStringItem().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Application.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::setClassNamePrefix().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Application.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::create().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Controller.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::create().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Controller.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getContext().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Controller.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getPath() on string|Zend_Tool_Project_Context.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Controller.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $indexActionViewResource might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Controller.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::addItem().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/DbAdapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::create().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/DbAdapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::getContents().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/DbAdapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::getPath().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/DbAdapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::getApplicationInstance().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/DbTable.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::create().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getPath() on string|Zend_Tool_Project_Context.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'If condition is always false.',
	'identifier' => 'if.alwaysFalse',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::addStringItem().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Layout.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::create().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Layout.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::getAsZendConfig().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Layout.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'If condition is always false.',
	'identifier' => 'if.alwaysFalse',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Model.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::addStringItem().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Module.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::create().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Module.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::removeStringItem().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Module.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $currentChildResource might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Module.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Registry_Interface::getStorage().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Project.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::create().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/ProjectProvider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::getPath().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/ProjectProvider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @var above a method has no effect.',
	'identifier' => 'varTag.misplaced',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/ProjectProvider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::create().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Test.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getPath() on string|Zend_Tool_Project_Context.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Test.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Path in include() "PHPUnit/Runner/Version.php" is not a file or it does not exist.',
	'identifier' => 'include.fileNotFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Test.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $libraryFileResource might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Test.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource::create().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/View.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getPath() on string|Zend_Tool_Project_Context.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/View.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Tool_Framework_Registry_Interface::getResponse() invoked with 1 parameter, 0 required.',
	'identifier' => 'arguments.count',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/View.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $number might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $plocale might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset mixed on array{} in isset() does not exist.',
	'identifier' => 'isset.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Array.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset mixed on array{} in isset() does not exist.',
	'identifier' => 'isset.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Ini.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @param references unknown parameter: $option',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Qt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Translate_Adapter_Qt::$_cleared is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Qt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Translate_Adapter_Qt::$_source is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Qt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Translate_Adapter_Qt::$_transunit is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Qt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Translate_Adapter_Tbx::$_cleared is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Tbx.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @param references unknown parameter: $option',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Xliff.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Translate_Adapter_Xliff::$_cleared is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Xliff.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @param references unknown parameter: $option',
	'identifier' => 'parameter.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/XmlTm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Translate_Adapter_XmlTm::$_cleared is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/XmlTm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation ">" between int<1, max> and 0 is always true.',
	'identifier' => 'greater.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Uri/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using === between 0|1 and false will always evaluate to false.',
	'identifier' => 'identical.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Uri/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Validate_Abstract::getDefaultTranslator() should return Zend_Translate_Adapter|null but returns Zend_Translate.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Validate_Abstract::getTranslator() should return Zend_Translate_Adapter|null but returns Zend_Translate.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Validate_Abstract::$_translator (Zend_Translate) does not accept Zend_Translate_Adapter.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Validate_Abstract::$_translator (Zend_Translate) does not accept Zend_Translate_Adapter|null.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Static property Zend_Validate_Abstract::$_defaultTranslator (Zend_Translate) does not accept Zend_Translate_Adapter.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Static property Zend_Validate_Abstract::$_defaultTranslator (Zend_Translate) does not accept Zend_Translate_Adapter|null.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method checkChars() on an unknown class Zend_Validate_Barcode_BarcodeAdapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method checkLength() on an unknown class Zend_Validate_Barcode_BarcodeAdapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method checksum() on an unknown class Zend_Validate_Barcode_BarcodeAdapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getCheck() on an unknown class Zend_Validate_Barcode_BarcodeAdapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method getLength() on an unknown class Zend_Validate_Barcode_BarcodeAdapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method setCheck() on an unknown class Zend_Validate_Barcode_BarcodeAdapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Validate_Barcode::getAdapter() has invalid return type Zend_Validate_Barcode_BarcodeAdapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter $adapter of method Zend_Validate_Barcode::__construct() has invalid type Zend_Validate_Barcode_BarcodeAdapter.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Validate_Barcode::$_adapter has unknown class Zend_Validate_Barcode_BarcodeAdapter as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*" between non-empty-string and 3 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode/AdapterAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*" between non-empty-string and 4 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode/AdapterAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*" between non-empty-string and 9 results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode/AdapterAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "==" between *NEVER* and -1 results in an error.',
	'identifier' => 'equal.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode/AdapterAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "==" between int<0, max> and *NEVER* results in an error.',
	'identifier' => 'equal.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Barcode/AdapterAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*" between int<1, max> and non-empty-string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Ccnum.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*" between int<1, max> and non-empty-string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/CreditCard.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Validate_CreditCard::getService() has invalid return type callback.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/CreditCard.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Validate_CreditCard::$_service (callback) in empty() is not falsy.',
	'identifier' => 'empty.property',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/CreditCard.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Validate_CreditCard::$_service has unknown class callback as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/CreditCard.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Validate_EmailAddress::$localPart.',
	'identifier' => 'property.notFound',
	'count' => 5,
	'path' => __DIR__ . '/library/Zend/Validate/EmailAddress.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access offset *NEVER* on 0|1.',
	'identifier' => 'offsetAccess.nonOffsetAccessible',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Validate/EmailAddress.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "<" between int<4, max> and 4 is always false.',
	'identifier' => 'smaller.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/EmailAddress.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Validate_EmailAddress::getDomainCheck() has invalid return type unknown.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/EmailAddress.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $decimal_number of function decbin expects int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/EmailAddress.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $length of function substr expects int, string given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Validate/EmailAddress.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $pad_string of function str_pad expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Validate/EmailAddress.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $array of function array_unique expects array, null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Crc32.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $input of function array_keys expects array, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Crc32.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot assign new offset to string.',
	'identifier' => 'offsetAssign.dimType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Exists.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $array of function array_unique expects array, null given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Validate/File/Hash.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $input of function array_keys expects array, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Hash.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $input of function array_values expects array<T>, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Hash.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Validate_File_Hash::$_hash (string) does not accept null.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Hash.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset \'name\' does not exist on string.',
	'identifier' => 'offsetAccess.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/IsCompressed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset \'name\' does not exist on string.',
	'identifier' => 'offsetAccess.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/IsImage.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $array of function array_unique expects array, null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Md5.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $input of function array_keys expects array, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Md5.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot assign new offset to string.',
	'identifier' => 'offsetAssign.dimType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/NotExists.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $array of function array_unique expects array, null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Sha1.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $input of function array_keys expects array, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Sha1.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*=" between string and 1.1805916207174113E+21 results in an error.',
	'identifier' => 'assignOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Size.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*=" between string and 1.2089258196146292E+24 results in an error.',
	'identifier' => 'assignOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Size.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*=" between string and 1024 results in an error.',
	'identifier' => 'assignOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Size.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*=" between string and 1048576 results in an error.',
	'identifier' => 'assignOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Size.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*=" between string and 1073741824 results in an error.',
	'identifier' => 'assignOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Size.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*=" between string and 1099511627776 results in an error.',
	'identifier' => 'assignOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Size.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*=" between string and 1125899906842624 results in an error.',
	'identifier' => 'assignOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Size.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*=" between string and 1152921504606846976 results in an error.',
	'identifier' => 'assignOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Size.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $context in isset() always exists and is not nullable.',
	'identifier' => 'isset.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Identical.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*" between 3 and non-empty-string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Isbn.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "*" between int<2, 10> and non-empty-string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Isbn.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function method_exists() with object and \'__toString\' will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/NotEmpty.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Comparison operation "==" between *NEVER* and 0.0 results in an error.',
	'identifier' => 'equal.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/NotEmpty.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_string() with string will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/Sitemap/Changefreq.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_View_Abstract::_run() invoked with 1 parameter, 0 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_View_Abstract::_setFilterClass() is unused.',
	'identifier' => 'method.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_View_Abstract::_setHelperClass() is unused.',
	'identifier' => 'method.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_View_Abstract::_setPath() is unused.',
	'identifier' => 'method.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $storeVar might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $view in isset() is never defined.',
	'identifier' => 'isset.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/DeclareVars.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/Fieldset.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $escape might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Fieldset.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormButton.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $disable might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormButton.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $escape might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormButton.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $id might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormButton.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormCheckbox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Negated boolean expression is always false.',
	'identifier' => 'booleanNot.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormCheckbox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $disable might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormCheckbox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $id might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormCheckbox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormElement.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormErrors.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormFile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $disable might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormFile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $id might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormFile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with array will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormHidden.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 5,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormImage.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $disable might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormImage.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $id might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormImage.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormLabel.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Negated boolean expression is always false.',
	'identifier' => 'booleanNot.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormLabel.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $disable might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormLabel.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $escape might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormLabel.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $id might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormLabel.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormPassword.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $disable might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormPassword.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $id might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormPassword.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormRadio.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $disable might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormRadio.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $escape might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormRadio.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $id might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormRadio.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormReset.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $disable might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormReset.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $id might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormReset.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 7,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormSelect.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $disable might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormSelect.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $id might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormSelect.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $multiple in empty() always exists and is not falsy.',
	'identifier' => 'empty.variable',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormSelect.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormSubmit.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $disable might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormSubmit.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $id might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormSubmit.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormText.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $disable might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormText.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $id might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormText.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormTextarea.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $disable might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormTextarea.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $id might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormTextarea.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Abstract::doctype().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadLink.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadLink::getIndent().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadLink.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadLink::getSeparator().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadLink.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadLink::getWhitespace().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadLink.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadLink::setSeparator().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadLink.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Abstract::doctype().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadMeta.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadMeta::getIndent().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadMeta.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadMeta::getSeparator().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadMeta.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadMeta::getWhitespace().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadMeta.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadMeta::setSeparator().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadMeta.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::doctype().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadMeta.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Negated boolean expression is always false.',
	'identifier' => 'booleanNot.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadMeta.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Result of && is always false.',
	'identifier' => 'booleanAnd.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadMeta.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Result of method Zend_View_Helper_HeadMeta::offsetSet() (void) is used.',
	'identifier' => 'method.void',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadMeta.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Abstract::doctype().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadScript.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadScript::getIndent().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadScript.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadScript::getSeparator().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadScript.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadScript::getWhitespace().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadScript.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadScript::setSeparator().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadScript.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::doctype().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadScript.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadStyle::getIndent().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadStyle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadStyle::getSeparator().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadStyle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadStyle::getWhitespace().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadStyle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadStyle::setSeparator().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadStyle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $attributes of method Zend_View_Helper_HeadStyle::appendStyle() expects array, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadStyle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $attributes of method Zend_View_Helper_HeadStyle::prependStyle() expects array, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadStyle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $attributes of method Zend_View_Helper_HeadStyle::setStyle() expects array, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadStyle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_View_Helper_HeadStyle::$_captureAttrs (string) does not accept null.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadStyle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadTitle::getIndent().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadTitle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadTitle::getPostfix().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadTitle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadTitle::getPrefix().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadTitle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadTitle::getSeparator().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadTitle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Helper_HeadTitle::getWhitespace().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadTitle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::doctype().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/View/Helper/HtmlElement.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/HtmlElement.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HtmlList.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with array will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HtmlList.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_View_Helper_InlineScript::inlineScript() should return Zend_View_Helper_InlineScript but returns Zend_View_Helper_HeadScript.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/InlineScript.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $cycleCheck of static method Zend_Json::encode() expects bool, null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Json.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::addHelperPath().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::getHelper().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::getHelperPaths().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::getPluginLoader().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::setHelperPath().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Breadcrumbs.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::partial().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Breadcrumbs.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/HelperAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::escape().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Menu.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::partial().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Menu.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using !== between mixed and null will always evaluate to true.',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Menu.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $foundDepth might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Menu.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri::setFragment().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Sitemap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri::setPath().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Sitemap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri::setQuery().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Sitemap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri_Exception::setView().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Sitemap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::serverUrl().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Sitemap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::url().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Sitemap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to property $paginator on an unknown class Zend_View_Instance.',
	'identifier' => 'class.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/View/Helper/PaginationControl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to method partial() on an unknown class Zend_View_Instance.',
	'identifier' => 'class.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/PaginationControl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $obj of function get_object_vars expects object, array given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/PaginationControl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $view of method Zend_View_Exception::setView() expects Zend_View_Interface|null, Zend_View_Instance given.',
	'identifier' => 'argument.type',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/View/Helper/PaginationControl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_View_Helper_PaginationControl::$view (Zend_View_Instance) does not accept Zend_View_Interface.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/PaginationControl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_View_Helper_PaginationControl::$view has unknown class Zend_View_Instance as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/PaginationControl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Strict comparison using !== between mixed and null will always evaluate to true.',
	'identifier' => 'notIdentical.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/PaginationControl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_View_Interface::$partialCounter.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Partial.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_View_Interface::$partialTotalCount.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Partial.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with array will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Partial.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_object() with *NEVER* will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Partial.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_View_Helper_Partial::$partialCounter (int) in isset() is not nullable.',
	'identifier' => 'isset.property',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Partial.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_View_Helper_Partial::$partialTotalCount (int) in isset() is not nullable.',
	'identifier' => 'isset.property',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Partial.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_scalar() with *NEVER* will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Placeholder/Container/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_View_Interface::placeholder().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/View/Helper/RenderToPlaceholder.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Wildfire_Channel_Interface::getProtocol().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Wildfire/Plugin/FirePhp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot unset offset \'File\' on array{Type: string|null, Label?: mixed}.',
	'identifier' => 'unset.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Wildfire/Plugin/FirePhp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot unset offset \'Line\' on array{Type: string|null, Label?: mixed}.',
	'identifier' => 'unset.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Wildfire/Plugin/FirePhp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Negated boolean expression is always true.',
	'identifier' => 'booleanNot.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Wildfire/Plugin/FirePhp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset \'File\' on array{Type: mixed, Label?: mixed} in isset() does not exist.',
	'identifier' => 'isset.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Wildfire/Plugin/FirePhp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset \'Line\' on *NEVER* in isset() always exists and is not nullable.',
	'identifier' => 'isset.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Wildfire/Plugin/FirePhp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset \'function\' on array{function: string, line?: int, file?: string, class?: class-string, type?: \'->\'|\'::\', args?: list<mixed>, object?: object} in isset() always exists and is not nullable.',
	'identifier' => 'isset.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Wildfire/Plugin/FirePhp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Result of || is always true.',
	'identifier' => 'booleanOr.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Wildfire/Plugin/FirePhp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property DOMNode::$entities.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Xml/Security.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_XmlRpc_Client::getIntrospector() should return Zend_XmlRpc_Client_ServerIntrospection but returns Zend_Http_Client_Introspector.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_XmlRpc_Client::$_introspector (Zend_Http_Client_Introspector) does not accept Zend_XmlRpc_Client_ServerIntrospection.',
	'identifier' => 'assign.propertyType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_XmlRpc_Client::$_introspector has unknown class Zend_Http_Client_Introspector as its type.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_XmlRpc_Client_ServerProxy::listMethods().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Client/ServerIntrospection.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_XmlRpc_Client_ServerProxy::methodSignature().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Client/ServerIntrospection.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_XmlRpc_Client_ServerProxy::multicall().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Client/ServerIntrospection.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_XmlRpc_Generator_GeneratorAbstract::_init().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Generator/GeneratorAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_XmlRpc_Request::$_fault (Zend_XmlRpc_Fault) does not accept Zend_XmlRpc_Server_Exception.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Request/Stdin.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Array has 2 duplicate keys with value \'time\' (\'time\', \'time\').',
	'identifier' => 'array.duplicateKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Left side of && is always true.',
	'identifier' => 'booleanAnd.leftAlwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instanceof between Exception and (int|string) results in an error.',
	'identifier' => 'instanceof.invalidExprType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Server/Fault.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $return of function var_export expects bool, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Server/System.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_XmlRpc_Value::_generateXml().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Value.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with non-empty-array<mixed, mixed> will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Value.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot access property $member on string.',
	'identifier' => 'property.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Value.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method children() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Value.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'PHPDoc tag @param for parameter $type contains unresolvable type.',
	'identifier' => 'parameter.unresolvableType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Value.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter &$type by-ref type of method Zend_XmlRpc_Value::_extractTypeAndValue() expects string, int|string|null given.',
	'identifier' => 'parameterByRef.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Value.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Crypt_Math_BigInteger::init().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Value/BigInteger.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];
