<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $roleParentId is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Acl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $ruleTypeOnePrivilege is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Acl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $ruleTypeOnePrivilege is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Acl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $length is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/Amf0/Deserializer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $className is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/Amf0/Serializer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $className is assigned value \'\' but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Parse/Amf0/Serializer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $message might not be defined.',
	'identifier' => 'variable.undefined',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Amf/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $basePath is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Module/Autoloader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $bootstrap is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Application/Resource/Frontcontroller.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset \'code\' of array assigned to variable $result is never read before being overwritten.',
	'identifier' => 'array.offsetOverwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Auth/Adapter/Digest.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset $messages[1] is assigned value \'\' but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Auth/Adapter/Ldap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to $messages[0] is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Auth/Adapter/Ldap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $code is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/Code128.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $fak is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/Code128.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $sum is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Barcode/Object/Code128.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $tmpdir is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $data is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend/Apc.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $data is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend/Libmemcached.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $data is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend/Memcached.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $res is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend/Sqlite.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $data is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Backend/WinCache.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $res is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Frontend/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Cache/Frontend/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $contentType is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cache/Frontend/Page.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $result is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/Infrastructure/Adapter/AbstractAdapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $removeTemporaryFilePath is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/StorageService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $temporaryFilePath is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/StorageService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $removeTemporaryFilePath is assigned value false but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Cloud/StorageService/Adapter/WindowsAzure.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Case \'integer\' in switch is a duplicate of case \'integer\' on line 210.',
	'identifier' => 'switch.duplicateCase',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/CodeGenerator/Php/Property/DefaultValue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $constName is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/CodeGenerator/Php/Property/DefaultValue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Config.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $inflector is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Action/Helper/ViewRenderer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $controller is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Dispatcher/Standard.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property ArrayObject<(int|string), mixed>::$exception.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Plugin/ErrorHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property ArrayObject<(int|string), mixed>::$request.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Plugin/ErrorHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property ArrayObject<(int|string), mixed>::$type.',
	'identifier' => 'property.notFound',
	'count' => 6,
	'path' => __DIR__ . '/library/Zend/Controller/Plugin/ErrorHandler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $httpCodeSent is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Response/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $locale is assigned value null but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Controller/Router/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $result is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Crypt/Rsa.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_array() with mixed will always evaluate to false.',
	'identifier' => 'function.impossibleType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Currency.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $month is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $tmpdate is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value of variable $numday after ++ is never read.',
	'identifier' => 'preInc.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Date/DateObject.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function array_key_exists() with \'autoQuoteIdentifiers\' and array{caseFolding: mixed, autoQuoteIdentifiers: mixed, fetchMode: mixed, ...} will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function array_key_exists() with \'caseFolding\' and array{caseFolding: mixed, autoQuoteIdentifiers: mixed, fetchMode: mixed, ...} will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function array_key_exists() with \'fetchMode\' and array{caseFolding: mixed, autoQuoteIdentifiers: mixed, fetchMode: mixed, ...} will always evaluate to true.',
	'identifier' => 'function.alreadyNarrowedType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Db2.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $quotedSequenceName is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Db2.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Oracle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $identity is assigned value false but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Oracle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Ibm/Db2.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Ibm/Ids.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Mssql.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $p is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Mssql.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $identity is assigned value false but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Mysql.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Oci.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $identity is assigned value false but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Oci.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Pgsql.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $atttypemod is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Pgsql.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Sqlite.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Sqlsrv.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $p is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Pdo/Sqlsrv.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Sqlsrv.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $p is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Adapter/Sqlsrv.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Profiler.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $data is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $retval is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Db2.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Case \\false in switch is a duplicate of case \\null on line 393.',
	'identifier' => 'switch.duplicateCase',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $stmt is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Statement/Mysqli.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $where is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Table/Row/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $where is assigned value array{} but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Db/Table/Row/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $helper is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/BuildLayer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $javascript is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/BuildLayer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $onLoadActions is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/BuildLayer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $dijitParams is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/Form/Decorator/DijitForm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $checked is assigned value false but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/CheckBox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $textareaName is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/Editor.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $dijit is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Dojo/View/Helper/Slider.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $elt is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $attr is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $httpCodeSent is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Pubsubhubbub/HttpResponse.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $type is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $dateModified is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $description is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $title is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $email is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $name is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Entry/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $copyright is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/Atom/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $description is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/Atom/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $description is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/DublinCore/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $id is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/DublinCore/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $title is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/DublinCore/Entry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $copyright is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/DublinCore/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $description is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/DublinCore/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $id is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/DublinCore/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $language is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/DublinCore/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $title is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Extension/DublinCore/Feed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $entries is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $dateModified is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $description is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $entries is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $lastBuildDate is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $link is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $title is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $date is assigned value null but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $email is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $name is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/Feed/Rss.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method DOMNameSpaceNode|DOMNode::getAttribute().',
	'identifier' => 'method.notFound',
	'count' => 11,
	'path' => __DIR__ . '/library/Zend/Feed/Reader/FeedSet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $nvalid is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Feed/FeedAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $nvalid is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Renderer/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $xhtml is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Feed/Writer/Renderer/Entry/Atom.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $line is never read.',
	'identifier' => 'variable.unused',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/File/ClassFileLocator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read before being overwritten.',
	'identifier' => 'foreach.keyOverwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/File/Transfer/Adapter/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $type is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Boolean.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Input.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $rule is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Input.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $type is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/Null.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $fullMatch is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Filter/RealPath.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read before being overwritten.',
	'identifier' => 'foreach.keyOverwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $name is never read before being overwritten.',
	'identifier' => 'foreach.keyOverwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Switch condition comparison between int<1, max> and true is always true.',
	'identifier' => 'switch.alwaysTrue',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $enctype is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $merge is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $elementContent is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/FormElements.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $separator is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/Label.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $elementContent is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/PrepareElements.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $separator is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/PrepareElements.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $placement is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Decorator/ViewScript.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $prefix is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/DisplayGroup.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $result is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $result is assigned value false but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Form/Element.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value of variable $i after ++ is never read.',
	'identifier' => 'postInc.unused',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Gdata/Gapps.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $cellQuery is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $location is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $newCustomArr is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Gdata/Spreadsheets.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $stream of method Zend_Http_Client_Adapter_Stream::setOutputStream() expects resource, null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $value of function curl_setopt expects array<int, string>, array given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Client/Adapter/Curl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $chunk is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Client/Adapter/Socket.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $host is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Client/Adapter/Test.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $name is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Cookie.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $value is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Cookie.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $body is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/Response.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $loader is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $server is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset \'others\' on array{others: array{full: non-falsy-string, detail?: non-empty-list<array{mixed, mixed, mixed}>}, user_agent: string, product_name: string, browser_name: mixed, product_version?: non-falsy-string, browser_version?: mixed, comment?: array{full: string, detail: non-empty-list<string>}, compatibility_flag?: string, ...} in isset() always exists and is not nullable.',
	'identifier' => 'isset.offset',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/AbstractDevice.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to $server[\'os\'] is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/AbstractDevice.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to $server[\'os\'] is never read.',
	'identifier' => 'assign.unused',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/AbstractDevice.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $i is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/AbstractDevice.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $last is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/AbstractDevice.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $i is assigned value 0 but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/AbstractDevice.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $matched is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/Features/Adapter/TeraWurfl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $return is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Http/UserAgent/Mobile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $ind is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $resultArray is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $ind is assigned value "\\t" but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $tok is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json/Decoder.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $delim is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json/Decoder.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $substr_chrs_c_2 is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json/Decoder.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $cnt is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json/Encoder.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $paramCount is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json/Encoder.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $refParams is never read.',
	'identifier' => 'variable.unused',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Json/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $name is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json/Server/Smd/Service.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $paramInfo is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Json/Server/Smd/Service.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Controller_Action_Helper_Abstract::$view.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Layout.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $inflector is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Layout.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $message is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $message is assigned value \'\' but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $offset is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Converter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #1 $str of function strtolower expects string, null given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Dn.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $key is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Dn.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $value is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Dn.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $last is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Ldap/Ldif/Encoder.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to function is_readable() with mixed will always evaluate to false.',
	'identifier' => 'function.impossibleType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Loader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $namespace is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Loader.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $final is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Loader/Autoloader/Resource.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset 0 of array assigned to variable $value is never read.',
	'identifier' => 'array.unusedOffset',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Locale/Data.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $temp is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Data.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $value is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Data.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $temp is assigned value array{} but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Data.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $position is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Format.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $count is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Format.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $rest is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Format.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $digitsBeforeDot is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Locale/Math.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $numBytes is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Header/HeaderValue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $cmd is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $more is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $msg is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $k is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Imap.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $result is never read.',
	'identifier' => 'variable.unused',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Mail/Protocol/Pop3.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Offset \'end\' of array assigned to variable $messagePos is never read before being overwritten.',
	'identifier' => 'array.offsetOverwritten',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Mail/Storage/Mbox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $newvalue is assigned value \'\' but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Measure/Number.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $query is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $className is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Oauth/Http/Utility.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $query is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $params is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $expires is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $macFunc is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $secret is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Consumer/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $props is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Extension/Sreg.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $props is assigned value array{} but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/OpenId/Extension/Sreg.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $storedPassword is never read.',
	'identifier' => 'variable.unused',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/OpenId/Provider/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $trusted is never read.',
	'identifier' => 'variable.unused',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/OpenId/Provider/Storage/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Access to an undefined property Zend_Controller_Action_Helper_Abstract::$view.',
	'identifier' => 'property.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Paginator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Switch condition comparison between *NEVER* and \'null\' is always false.',
	'identifier' => 'switch.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Paginator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $itemCount is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Paginator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Switch condition comparison between 0|0.0|\'\'|\'0\'|array{}|false|null and false is always true.',
	'identifier' => 'switch.alwaysTrue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value of variable $revisions after ++ is never read.',
	'identifier' => 'postInc.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $contentsToDraw is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Canvas/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Property Zend_Pdf_Element_Array::$items (array) does not accept ArrayObject<*NEVER*, Zend_Pdf_Element>.',
	'identifier' => 'assign.propertyType',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Array.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $streamDictionary is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $streamValue is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Element/Object/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $isSubsettable is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $tableVersion is never read.',
	'identifier' => 'variable.unused',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Pdf/FileParser/Font/OpenType.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $b is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Pdf/Filter/Ascii85.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $timeout is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Array.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $id is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Db.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $i is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Memcacheq.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $timeout is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Memcacheq.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $result is never read.',
	'identifier' => 'variable.unused',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Queue/Adapter/Memcacheq.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $i is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Message/Iterator.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $command is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Stomp/Frame.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $frame is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Stomp/Frame.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $header is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Queue/Stomp/Frame.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $lineNum is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Reflection/File.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $controllerName is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Route.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Server_Reflection_Function::getName().',
	'identifier' => 'method.notFound',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Rest/Server.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $result is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $segmentsFile is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $sheetKey is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Document/Xlsx.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $bitCount is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $byteCount is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $delFileSize is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $maxSkipLevels is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $result is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $result is assigned value array{} but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentInfo.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $segName is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/SegmentMerger.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to $mergePool[] is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Index/Writer.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to Zend_Search_Lucene::getSegmentFileName() on a separate line has no effect.',
	'identifier' => 'staticMethod.resultUnused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Proxy.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach value variable $prevSubquery is never read.',
	'identifier' => 'foreach.unusedValue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Query/Boolean.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $termId is never read before being overwritten.',
	'identifier' => 'foreach.keyOverwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Query/MultiTerm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach value variable $prevTerm is never read.',
	'identifier' => 'foreach.unusedValue',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/Query/MultiTerm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Case self::TC_NUMBER in switch is a duplicate of case self::TC_NUMBER on line 149.',
	'identifier' => 'switch.duplicateCase',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Search/Lucene/Search/QueryToken.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $k is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Serializer/Adapter/PythonPickle.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $response is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Akismet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $k is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Ec2/Availabilityzones.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $k is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Ec2/Elasticip.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $k is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Ec2/Keypair.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $k is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/Ec2/Region.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $response is never read.',
	'identifier' => 'variable.unused',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Service/Amazon/SimpleDb.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to $argvValues[$parameter->aliases[0]] is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/Console/Command.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach value variable $extra is never read.',
	'identifier' => 'foreach.unusedValue',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Service/Flickr.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $validExtras is never read.',
	'identifier' => 'assign.unused',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Service/Flickr.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $method is assigned value \'assocArrayToArrayOf…\' but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/LiveDocx/MailMerge.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $xmlServices is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/SqlAzure/Management/Client.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $result is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/CommandLine/Deployment.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #2 $permissions of function mkdir expects int, string given.',
	'identifier' => 'argument.type',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/CommandLine/PackageScaffolder/PackageScaffolderAbstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $requestDate is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Credentials/SharedKey.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $requestDate is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Credentials/SharedKeyLite.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $returnValue is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/RetryPolicy/NoRetry.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $fileContents is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Blob.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $xmlRanges is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Blob.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to $stat[\'ctime\'] is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Blob/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to $stat[\'mode\'] is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Blob/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to $stat[\'mtime\'] is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Blob/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to $stat[\'size\'] is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Blob/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $info is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Blob/Stream.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $xmlMessages is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Queue.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $key is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Table.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to $headers[\'Content-Length\'] is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Table.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to $headers[\'Content-Type\'] is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Table.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to $headers[\'If-Match\'] is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Table.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $entries is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Table.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $mergeEntity is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Table.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $response is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Service/WindowsAzure/Storage/Table.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instanceof between mixed and DOMDocumentFragment will always evaluate to false.',
	'identifier' => 'instanceof.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Soap/Wsdl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Instanceof between mixed and DOMElement will always evaluate to false.',
	'identifier' => 'instanceof.alwaysFalse',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Soap/Wsdl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $dom is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Soap/Wsdl.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $classList is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tag/Cloud/Decorator/HtmlTag.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $amount is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Text/Figlet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $tempLine is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Text/Figlet.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Parameter #3 $length of function iconv_substr expects int|null, float given.',
	'identifier' => 'argument.type',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Text/MultiByte.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $lastStringLeft is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Text/MultiByte.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $lastStringRight is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Text/MultiByte.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $return is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Text/MultiByte.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $alias is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/TimeSync.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $timestamp is never read.',
	'identifier' => 'variable.unused',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/TimeSync/Protocol.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $classKey is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $isSingleSpecialProviderAction is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/HelpSystem.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $errorMessages is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Client/Console/HelpSystem.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $specialties is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Framework/Provider/Signature.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Call to an undefined method Zend_Tool_Project_Profile_Resource_Container::getName().',
	'identifier' => 'method.notFound',
	'count' => 3,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/AbstractClassFile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Foreach key variable $stringItemIndex is never read.',
	'identifier' => 'foreach.unusedKey',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/ApplicationConfigFile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to $stringValues[] is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/ApplicationConfigFile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $lastDepth is never read.',
	'identifier' => 'variable.unused',
	'count' => 4,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/ApplicationConfigFile.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $rii is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Context/Zf/ZfStandardLibraryDirectory.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $domnode is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Profile/FileParser/Xml.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $testFormResource is assigned value null but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $testingEnabled is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Tool/Project/Provider/Form.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $prev is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 2,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $temp is assigned value array{} but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $input is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Gettext.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Translate_Adapter_Qt::_contentElement() has an unused parameter $file.',
	'identifier' => 'method.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Qt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Translate_Adapter_Qt::_endElement() has an unused parameter $file.',
	'identifier' => 'method.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Qt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Translate_Adapter_Qt::_startElement() has an unused parameter $attrib.',
	'identifier' => 'method.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Qt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Translate_Adapter_Qt::_startElement() has an unused parameter $file.',
	'identifier' => 'method.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Qt.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Translate_Adapter_Tbx::_contentElement() has an unused parameter $file.',
	'identifier' => 'method.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Tbx.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Translate_Adapter_Tbx::_endElement() has an unused parameter $file.',
	'identifier' => 'method.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Tbx.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Translate_Adapter_Tbx::_startElement() has an unused parameter $file.',
	'identifier' => 'method.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Tbx.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Translate_Adapter_Xliff::_contentElement() has an unused parameter $file.',
	'identifier' => 'method.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Xliff.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Translate_Adapter_Xliff::_endElement() has an unused parameter $file.',
	'identifier' => 'method.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Xliff.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Translate_Adapter_Xliff::_startElement() has an unused parameter $file.',
	'identifier' => 'method.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/Xliff.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Translate_Adapter_XmlTm::_contentElement() has an unused parameter $file.',
	'identifier' => 'method.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/XmlTm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Translate_Adapter_XmlTm::_endElement() has an unused parameter $file.',
	'identifier' => 'method.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/XmlTm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Method Zend_Translate_Adapter_XmlTm::_startElement() has an unused parameter $file.',
	'identifier' => 'method.unusedParameter',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Translate/Adapter/XmlTm.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $temp is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/IsCompressed.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $temp is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/File/IsImage.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $type is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Validate/NotEmpty.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $content is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormButton.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $checked is assigned value false but it already has that value.',
	'identifier' => 'assign.redundant',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/FormCheckbox.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $nextIndex is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/View/Helper/Placeholder/Container/Abstract.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $raw_name is never read.',
	'identifier' => 'assign.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Wildfire/Plugin/FirePhp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Value assigned to variable $var is never read before being overwritten.',
	'identifier' => 'assign.overwritten',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Wildfire/Plugin/FirePhp.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $encodingMap is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/Xml/Security.php',
];
$ignoreErrors[] = [
	'rawMessage' => 'Variable $exceptionClass is never read.',
	'identifier' => 'variable.unused',
	'count' => 1,
	'path' => __DIR__ . '/library/Zend/XmlRpc/Server/Fault.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];
