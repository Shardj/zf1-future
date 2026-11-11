<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Acl::_roleDFSAllPrivileges() invoked with 3 parameters, 1-2 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Acl.php',
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
	'rawMessage' => 'Access to an undefined property Zend_Application_Bootstrap_Bootstrapper::$frontController.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Frontcontroller.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Application_Bootstrap_Bootstrapper::getResource().',
	'identifier' => 'method.notFound',
	'count' => 1,
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
	'rawMessage' => 'Method Zend_Application_Resource_View::getView() should return Zend_View but returns Zend_View_Interface.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/View.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Auth_Adapter_OpenId::$_response (Zend_Controller_Response_Abstract) does not accept string.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Auth/Adapter/OpenId.php',
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
	'rawMessage' => 'Parameter #1 $adapter of class Zend_Validate_Barcode constructor expects string|Zend_Config|Zend_Validate_Barcode_AdapterInterface, array<string, string|false> given.',
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
	'rawMessage' => 'Parameter #1 $adapter of class Zend_Validate_Barcode constructor expects string|Zend_Config|Zend_Validate_Barcode_AdapterInterface, array<string, mixed> given.',
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
	'rawMessage' => 'Parameter #1 $adapter of class Zend_Validate_Barcode constructor expects string|Zend_Config|Zend_Validate_Barcode_AdapterInterface, array<string, string|false> given.',
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
	'rawMessage' => 'Call to an undefined method Zend_Controller_Request_Abstract::getRequestUri().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/Cache.php',
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
	'rawMessage' => 'Method Zend_Controller_Plugin_ActionStack::popStack() invoked with 1 parameter, 0 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Plugin/ActionStack.php',
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
	'rawMessage' => 'Unsafe usage of new static().',
	'identifier' => 'new.static',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Chain.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unsafe usage of new static().',
	'identifier' => 'new.static',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Hostname.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unsafe usage of new static().',
	'identifier' => 'new.static',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Module.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unsafe usage of new static().',
	'identifier' => 'new.static',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Regex.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Unsafe usage of new static().',
	'identifier' => 'new.static',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route/Static.php',
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
	'rawMessage' => 'Class Zend_Crypt_Rsa_Key_Public constructor invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Rsa.php',
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
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "-" between string and 1 results in an error.',
	'identifier' => 'binaryOp.invalid',
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
	'rawMessage' => 'Variable $type might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Mssql.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $name of method PDO::lastInsertId() expects string, null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Pgsql.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $type might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Sqlsrv.php',
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
	'rawMessage' => 'Method Zend_Db_Statement::fetchColumn() should return string but returns false.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Db_Statement::setAttribute() should return bool but return statement is missing.',
	'identifier' => 'return.missing',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Db_Statement::setFetchMode() should return bool but return statement is missing.',
	'identifier' => 'return.missing',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Db_Adapter_Abstract::_getExecuteMode().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Oracle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $attribute of method PDOStatement::setAttribute() expects int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $name of method PDOStatement::getAttribute() expects int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Pdo.php',
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
	'rawMessage' => 'Parameter $value of method Zend_Dojo_BuildLayer::addProfileOption() has invalid type value.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/BuildLayer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Dojo_Form_DisplayGroup::setView() should return Zend_Dojo_Form_DisplayGroup but returns Zend_Form_DisplayGroup.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/DisplayGroup.php',
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
	'rawMessage' => 'Method Zend_Dojo_Form_Element_ValidationTextBox::clearConstraints() should return Zend_Dojo_Form_Element_ValidationTextBox but returns Zend_Dojo_Form_Element_Dijit.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Element/ValidationTextBox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $haystack of function strstr expects string, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/CheckBox.php',
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
	'rawMessage' => 'Parameter #3 $subject of function str_replace expects array<string>|string, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/Slider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $params (array|object) of method Zend_EventManager_Event::setParams() should be compatible with parameter $params (string) of method Zend_EventManager_EventDescription::setParams()',
	'identifier' => 'method.childParameterType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/EventManager/Event.php',
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
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_FeedInterface::getHubs().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Pubsubhubbub.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $prefix of function uniqid expects string, int<0, max> given.',
	'identifier' => 'argument.type',
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
	'rawMessage' => 'Call to an undefined method Zend_Feed_Reader_FeedInterface::setOriginalSourceUri().',
	'identifier' => 'method.notFound',
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
	'rawMessage' => 'Method Zend_Feed_Reader_Entry_Atom::getAuthors() should return array but returns Zend_Feed_Reader_Collection_Author|null.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Feed_Reader_Entry_Rss::getAuthors() should return array but returns Zend_Feed_Reader_Collection_Author|null.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Feed_Reader_Entry_Rss::getCommentCount() should return string|null but returns int<min, -1>|int<1, max>|null.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Feed_Reader_Extension_Atom_Entry::getCommentCount() should return int but returns string|null.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/Atom/Entry.php',
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
	'rawMessage' => 'Method Zend_Feed_Reader_Feed_Atom::getAuthors() should return array but returns Zend_Feed_Reader_Collection_Author|null.',
	'identifier' => 'return.type',
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
	'rawMessage' => 'Method Zend_Feed_Reader_Feed_Rss::getAuthors() should return array but returns Zend_Feed_Reader_Collection_Author|null.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
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
	'rawMessage' => 'Parameter #1 $container of method Zend_Feed_Writer_Renderer_Feed_Atom_AtomAbstract::__construct() expects Zend_Feed_Writer_Feed, Zend_Feed_Writer_Source given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Renderer/Feed/Atom/Source.php',
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
	'rawMessage' => 'Parameter #3 $locale of static method Zend_Locale::getTranslation() expects string|Zend_Locale|null, array given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Boolean.php',
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
	'rawMessage' => 'Variable $keys might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Filter/Encrypt/Openssl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Filter_HtmlEntities::setCharSet() should return $this(Zend_Filter_HtmlEntities) but returns Zend_Filter_HtmlEntities.',
	'identifier' => 'return.type',
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
	'rawMessage' => 'Call to an undefined method Zend_Loader_PluginLoader_Interface::getPaths().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $decorator of method Zend_Form::addDecorator() expects string|Zend_Form_Decorator_Interface, array<string, string|Zend_Form_Decorator_Interface> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Form::setElementsBelongTo() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/FormElements.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Form::setElementsBelongTo() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/PrepareElements.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $decorator of method Zend_Form_DisplayGroup::addDecorator() expects string|Zend_Form_Decorator_Interface, array<string, string|Zend_Form_Decorator_Interface> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/DisplayGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Http_Client_Adapter_Interface::setOutputStream().',
	'identifier' => 'method.notFound',
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
	'rawMessage' => 'Method Zend_Http_Header_SetCookie::fromString() has invalid return type SetCookie.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Header/SetCookie.php',
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
	'rawMessage' => 'Parameter #1 $ldap of class Zend_Ldap_Exception constructor expects Zend_Ldap|null, $this(Zend_Ldap_Collection_Iterator_Default) given.',
	'identifier' => 'argument.type',
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
	'rawMessage' => 'Parameter #1 $array_arg of function sort contains unresolvable type.',
	'identifier' => 'argument.unresolvableType',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Ldap/Node/Schema/ObjectClass/OpenLdap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $autoload_function of function spl_autoload_register expects callable(string): void, array{\'Zend_Loader_Autoloader\', \'autoload\'} given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Loader/Autoloader.php',
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
	'rawMessage' => 'Method Zend_Mail_Storage_Folder_Maildir::_buildFolderTree() invoked with 1 parameter, 0 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Folder/Maildir.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (Zend_Mail_Message_File) of method Zend_Mail_Storage_Maildir::getMessage() should be compatible with return type (Zend_Mail_Message) of method Zend_Mail_Storage_Abstract::getMessage()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Maildir.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (Zend_Mail_Message_File) of method Zend_Mail_Storage_Mbox::getMessage() should be compatible with return type (Zend_Mail_Message) of method Zend_Mail_Storage_Abstract::getMessage()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Mbox.php',
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
	'rawMessage' => 'Call to an undefined method Zend_Memory_Container::destroy().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Memory/AccessController.php',
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
	'rawMessage' => 'Cannot call method getTotalSize() on string.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Oauth_Http::_attemptRequest().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $httpClient might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/AccessToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $httpClient might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/RequestToken.php',
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
	'rawMessage' => 'Binary operation "+" between int<1, max> and string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $recursive of function mkdir expects bool, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Binary operation "^" between string|false and string results in an error.',
	'identifier' => 'binaryOp.invalid',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Provider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $recursive of function mkdir expects bool, int given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Provider/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Paginator::$_pages (array) does not accept stdClass.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Paginator.php',
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
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Element::add().',
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
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$Subtype.',
	'identifier' => 'property.notFound',
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
	'rawMessage' => 'Access to an undefined property Zend_Pdf_Element::$Subtype.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Annotation/Text.php',
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
	'rawMessage' => 'Property Zend_Pdf_Destination_Named::$_nameElement (Zend_Pdf_Element_Name|Zend_Pdf_Element_String) does not accept Zend_Pdf_Element.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Destination/Named.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'ArrayObject<*NEVER*, *NEVER*> does not accept Zend_Pdf_Element.',
	'identifier' => 'offsetAssign.valueType',
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
	'rawMessage' => 'Parameter #1 $ascii of function chr expects int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Name.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Element::length().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Pdf_ElementFactory_Interface::$_factoryId.',
	'identifier' => 'property.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Pdf/ElementFactory.php',
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
	'rawMessage' => 'Call to an undefined method Zend_Pdf_Trailer::getRefTable().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Parser.php',
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
	'rawMessage' => 'Method Zend_Pdf_Resource_Font_CidFont::__construct() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/CidFont/TrueType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Class Zend_Pdf_FileParser_Font_OpenType_Type1 not found.',
	'identifier' => 'class.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/FontDescriptor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Pdf_Resource_Font_Simple_Parsed::__construct() invoked with 2 parameters, 1 required.',
	'identifier' => 'arguments.count',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Resource/Font/Simple/Parsed/TrueType.php',
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
	'rawMessage' => 'Empty array passed to foreach.',
	'identifier' => 'foreach.emptyArray',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/StringParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Pdf_StringParser::getObject() should return Zend_Pdf_Element_Object but returns Zend_Pdf_Element_Null.',
	'identifier' => 'return.type',
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
	'rawMessage' => 'Parameter #1 $prefix of function uniqid expects string, int<0, max> given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Array.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $prefix of function uniqid expects string, int<0, max> given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Db.php',
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
	'rawMessage' => 'Parameter #1 $parameter of method Zend_Server_Method_Prototype::addParameter() expects string, Zend_Server_Method_Parameter given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Server/Abstract.php',
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
	'rawMessage' => 'Method Zend_Service_Amazon_Abstract::__construct() invoked with 3 parameters, 0-2 required.',
	'identifier' => 'arguments.count',
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
	'rawMessage' => 'Parameter #3 $options of method SoapClient::__soapCall() expects array, null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Soap/Client.php',
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
	'rawMessage' => 'Return type (void) of method Zend_Stdlib_SplPriorityQueue::insert() should be compatible with return type (true) of method SplPriorityQueue<mixed,mixed>::insert()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Stdlib/SplPriorityQueue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Test_DbAdapter::lastInsertId() should return string but returns false.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Test/DbAdapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Test_DbStatement::fetchColumn() should return string but returns false.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Test/DbStatement.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (false) of method Zend_Test_DbStatement::errorCode() should be compatible with return type (string) of method Zend_Db_Statement_Interface::errorCode()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Test/DbStatement.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Return type (false) of method Zend_Test_DbStatement::errorInfo() should be compatible with return type (array) of method Zend_Db_Statement_Interface::errorInfo()',
	'identifier' => 'method.childReturnType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Test/DbStatement.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to sscanf contains 11 placeholders, 7 values given.',
	'identifier' => 'argument.sscanf',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Text/Figlet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $lastSpace might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Text/Figlet.php',
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
	'rawMessage' => 'Parameter #1 $date of class Zend_Date constructor expects array|int|string|Zend_Date|null, $this(Zend_TimeSync_Protocol) given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/TimeSync/Protocol.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Registry_Interface::getConfig().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/DatabaseSchemaProvider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $client of method Zend_Tool_Framework_Client_Interactive_InputHandler::setClient() expects Zend_Tool_Framework_Client_Interactive_InputInterface, $this(Zend_Tool_Framework_Client_Abstract) given.',
	'identifier' => 'argument.type',
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
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Metadata_Interface::getActionName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/ArgumentParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Metadata_Interface::getProviderName().',
	'identifier' => 'method.notFound',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/ArgumentParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Metadata_Interface::getReference().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/ArgumentParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Framework_Metadata_Interface::getSpecialtyName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/ArgumentParser.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Iterator<mixed, mixed>::getChildren().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Loader/IncludePathLoader/RecursiveFilterIterator.php',
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
	'rawMessage' => 'Cannot call method exists() on string|Zend_Tool_Project_Context_Interface.',
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
	'rawMessage' => 'Cannot call method getPath() on string|Zend_Tool_Project_Context_Interface.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method save() on string|Zend_Tool_Project_Context_Interface.',
	'identifier' => 'method.nonObject',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getContext().',
	'identifier' => 'method.notFound',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Action.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getPath() on string|Zend_Tool_Project_Context_Interface.',
	'identifier' => 'method.nonObject',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Action.php',
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
	'rawMessage' => 'Cannot call method getPath() on string|Zend_Tool_Project_Context_Interface.',
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
	'rawMessage' => 'Cannot call method getPath() on string|Zend_Tool_Project_Context_Interface.',
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
	'rawMessage' => 'If condition is always false.',
	'identifier' => 'if.alwaysFalse',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Model.php',
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
	'rawMessage' => 'PHPDoc tag @var above a method has no effect.',
	'identifier' => 'varTag.misplaced',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/ProjectProvider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Cannot call method getPath() on string|Zend_Tool_Project_Context_Interface.',
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
	'rawMessage' => 'Cannot call method getPath() on string|Zend_Tool_Project_Context_Interface.',
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
	'rawMessage' => 'Property Zend_Translate_Adapter_Xliff::$_cleared is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Xliff.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Translate_Adapter_XmlTm::$_cleared is never read, only written.',
	'identifier' => 'property.onlyWritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/XmlTm.php',
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
	'rawMessage' => 'Call to an undefined method Zend_Validate_Barcode_AdapterInterface::getLength().',
	'identifier' => 'method.notFound',
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
	'rawMessage' => 'Method Zend_Validate_File_Crc32::getCrc32() should return string but returns array.',
	'identifier' => 'return.type',
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
	'rawMessage' => 'Property Zend_Validate_File_Hash::$_hash (array) does not accept null.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Hash.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Validate_File_Md5::getMd5() should return string but returns array.',
	'identifier' => 'return.type',
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
	'rawMessage' => 'Method Zend_Validate_File_Sha1::getSha1() should return string but returns array.',
	'identifier' => 'return.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/Sha1.php',
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
	'rawMessage' => 'Variable $escape might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Fieldset.php',
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
	'rawMessage' => 'Result of method Zend_View_Helper_HeadMeta::offsetSet() (void) is used.',
	'identifier' => 'method.void',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/HeadMeta.php',
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
	'rawMessage' => 'Variable $foundDepth might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Menu.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Uri_Exception::setView().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Navigation/Sitemap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $obj of function get_object_vars expects object, array given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/PaginationControl.php',
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

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];
