# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Changed

* Locale data updated from CLDR 25 (2014) to CLDR 48.2, Zend_Locale_Data reads the current LDML structure (inherited aliases, alternative variants, numbering systems, default number formats) (#554).
  BC note: localized output follows current CLDR data and can differ from previous versions, see BREAKING-CHANGES.md.

## [1.25.3] - 2026-11-03

### Added

* Zend_Session: `use_strict_mode` session option, so `session.use_strict_mode` can be set through Zend_Session::setOptions() (#553).

### Changed

* Zend_Date and Zend_Debug no longer depend on the str_decrement() / str_contains() polyfills, so the library works without Composer, e.g. from a release archive (#564, #512).
* README: supported PHP versions and installation without Composer (#564).

* Zend_Validate_Hostname: the list of known TLDs is updated to the IANA root zone of 2026-11-02; a TLD missing from the list is looked up in DNS (NS record of the TLD), which the new `tldDns` option (`setValidateTldDns(false)`) turns off (#314).
  BC note: TLDs retired by IANA are no longer accepted, see BREAKING-CHANGES.md.

* Zend_Db DB2 adapters (ibm_db2 and PDO_IBM) use `OFFSET … ROWS FETCH FIRST … ROWS ONLY` for limit() with an offset instead of the `ROW_NUMBER()` subquery (#393).
  BC note: requires Db2 for i 7.1 TR11 / 7.2 TR3 or Db2 LUW 11.1 and newer.

* Zend_Db mysqli adapter and statement now convert mysqli_sql_exception (thrown by default since PHP 8.1) into Zend_Db_Adapter_Mysqli_Exception / Zend_Db_Statement_Mysqli_Exception, so catching Zend_Db_Exception works again (#561).
  BC note: code that catches mysqli_sql_exception directly must catch the Zend_Db exception instead; the original exception is available via getPrevious().

### Fixed

* Zend_Validate_StringLength: a string with an invalid byte sequence fails with the `stringLengthInvalid` error instead of passing the maximum length check, because iconv_strlen() returned false (#548).
* Zend_Service_Amazon_S3::removeObject() throws an exception for an object name without a key instead of sending a DeleteBucket request for the bucket (#547).
* Zend_Form_Element::clearDecorators() no longer resets the break-chain-on-failure flags of the validators (#550).
* Zend_Form_Element: fluent methods are documented with `@return $this`, so chained calls keep the subclass type in IDEs and static analysis (#552).
* Zend_Soap_Client: the default transport calls the parent __doRequest() directly instead of through a callable of the form `[$client, 'SoapClient::__doRequest']`, which PHP 8.2 deprecates (#556).
* Zend_Cache_Frontend_Page: repeated headers (`Link`, `Vary`, `Set-Cookie`, …) are all sent when a page is served from the cache; only the last one survived before (#557).
* PHP 8.5 deprecations: no null array keys in Zend_Translate_Adapter, Zend_Validate_File_Upload and Zend_Rest_Server, no xml_parser_free() in the Zend_Translate XML adapters on PHP 8.0 and newer (#565).
* Zend_Test_PHPUnit constraint classes (DomQuery, Redirect, ResponseHeader) work with PHPUnit 6 to 9, so assertQuery(), assertRedirect() and the response header assertions of Zend_Test_PHPUnit_ControllerTestCase can be used again (#569).
* Zend_Mail_Protocol_Smtp ends an open session with QUIT in its destructor and ignores protocol errors there, so a connection closed by the server cannot end in a fatal error during shutdown (#530).
* Zend_Cache_Backend_File writes cache files atomically (temporary file and rename), so concurrent writers can no longer produce a file with the content twice (`unserialize(): Extra data`) and readers never see a truncated file (#420).
* Zend_Db_Adapter_Abstract::fetchPairs() gives null values for a single column result instead of an undefined key warning (#408); fetchAll() is documented as returning array (#384).
* Zend_Filter::filterStatic() passes an array with string keys as the options array instead of named constructor arguments (#394).
* Zend_File_Transfer_Adapter_Abstract uses a unique probe file in _isPathWriteable(), so parallel transfers no longer report a writable destination as not writable (#399).
* Zend_Db_Select: whitespace before AS in a column no longer turns an expression into a quoted identifier (#400).
* Zend_Cache_Backend_TwoLevels gives the fast backend a finite lifetime on save(); the fast entries never expired before (#423).
* Zend_View: a view variable assigned with null is no longer reported as missing when strictVars is on (#426).
* Zend_Navigation_Page_Mvc::isActive() accepts array values in the request params without an "Array to string conversion" warning (#474).
* Zend_File_ClassFileLocator (and so the classmap generator) finds enums (#551).
* Zend_Session_SaveHandler_DbTable::read() returns a string for a NULL data column, Zend_Db_Adapter_Oracle passes no null encoding to oci_connect() (#563).

## [1.25.2] - 2026-08-21

### Fixed

* Fix misnamed file which was not being autoloaded and was breaking custom session handlers by @JonathanFinch-awin in https://github.com/Shardj/zf1-future/pull/545

## [1.25.1] - 2026-08-14

### Added

* Test php8.5 by @sreichel in https://github.com/Shardj/zf1-future/pull/486

### Fixed

* Update MultiSearcher.php and loaded.php by @Stevehans in https://github.com/Shardj/zf1-future/pull/526
* Updated dependencies and added composer.lock by @sreichel in https://github.com/Shardj/zf1-future/pull/528
* Code tidy - cosmetic - use braces on interpolated variables by @Stevehans in https://github.com/Shardj/zf1-future/pull/527
* Fix: str_decrement on 0 by @sreichel in https://github.com/Shardj/zf1-future/pull/529
* PHP8.4: Replace xml_set_object() with callable arrays in Translate ad… by @geoalexidis in https://github.com/Shardj/zf1-future/pull/534
* Fix Zend_Debug::dump() xdebug quirk. by @GNfsys in https://github.com/Shardj/zf1-future/pull/536
* PHPUnit Compatibility by @arnoschaefer in https://github.com/Shardj/zf1-future/pull/537
* php 8.5: Replace deprecated methods for `SplObjectStorage()` by @sreichel in https://github.com/Shardj/zf1-future/pull/533
* Fix Zend_Session::start() false-positive on PHP 8.x (SID constant persists after session_write_close) by @kevoriordan in https://github.com/Shardj/zf1-future/pull/538
* Fix/session set save handler deprecation by @sanosuke-s74 in https://github.com/Shardj/zf1-future/pull/539
* PHP 8.5 compatibility fixes by @oakimov in https://github.com/Shardj/zf1-future/pull/540
* Fix implicit float to int deprecation in S3/Sqs retry backoff by @thenguyenit in https://github.com/Shardj/zf1-future/pull/541

## [1.25.0] - 2026-02-24

* dropped PHP 7.1-7.3 support, added 8.2 support (without explicitly aiming to remove all deprecation notices)


## [1.24.5] - 2026-02-24

### Added

* Customizable regex in Zend_Db_Select by @mauriziosmt in https://github.com/Shardj/zf1-future/pull/513
* Add missing polyfill for 8.2 by @gnovaro in https://github.com/Shardj/zf1-future/pull/500
* feat: add extra TLD support to hostname validator by @lukebsh in https://github.com/Shardj/zf1-future/pull/522

### Fixed

* Zend_File_Transfer_Adapter_Abstract::addValidator(): fix $validator parameter type in PHPDoc by @holtkamp in https://github.com/Shardj/zf1-future/pull/503
* Fix object caching in Zend_Translate_Adapter by @BorislavSabev in https://github.com/Shardj/zf1-future/pull/504
* PHP8.5: Fixes non-canonical cast by @sreichel in https://github.com/Shardj/zf1-future/pull/509
* Fixes some DocsBlocks by @sreichel in https://github.com/Shardj/zf1-future/pull/514
* PHP8.4: Fixes missing escape parameter by @sreichel in https://github.com/Shardj/zf1-future/pull/510
* Update Imap.php by @kamildabrowski in https://github.com/Shardj/zf1-future/pull/499
* Fix broken PhpUnit tests by @sreichel in https://github.com/Shardj/zf1-future/pull/515
* PHP8.5: Fix missing non-canonical cast by @sukhwinder33445 in https://github.com/Shardj/zf1-future/pull/517
* Silence deprecation warning for SOAP_FUNCTIONS_ALL on 8.4+ by @NattyNarwhal in https://github.com/Shardj/zf1-future/pull/519


## [1.24.4] - 2025-06-26

### Added

* feat: Support for OS/2 table v4 by @wex in https://github.com/Shardj/zf1-future/pull/493
* Adds Straight Join to Zend_Db_Select by @kazsaj in https://github.com/Shardj/zf1-future/pull/497

### Fixed

* Declare dynamic property to avoid error in PHP8.4 when Session is started by @vuvanly in https://github.com/Shardj/zf1-future/pull/496
* Fix Zend_Pdf_Element regression by added $value prop by @onlime in https://github.com/Shardj/zf1-future/pull/490
* Update fgetcsv call to specify $escape parameter due to deprecation by @DrRago in https://github.com/Shardj/zf1-future/pull/498

## [1.24.3] - 2025-04-11

### Added

* Quality: add phpstan to checks by @sreichel in https://github.com/Shardj/zf1-future/pull/431
* Made all E_STRICT uses conditional. by @boenrobot in https://github.com/Shardj/zf1-future/pull/485

### Fixed

* Fix placement of distinct in sqlsrv limit by @muuvmuuv in https://github.com/Shardj/zf1-future/pull/458
* Fixed null deprecation in Zend/Pdf/Resource/Font/Simple by @kiatng in https://github.com/Shardj/zf1-future/pull/459
* Fix str_replace null in Zend_Form_Element::_getErrorMessages() by @t-gebauer in https://github.com/Shardj/zf1-future/pull/460
* Update HeaderValue.php by @icyz in https://github.com/Shardj/zf1-future/pull/463
* fix Dojo ComboBox autocomplete param in declarative mode by @timum-viw in https://github.com/Shardj/zf1-future/pull/464
* Updated Seiden PHP+ branding by @alanseiden in https://github.com/Shardj/zf1-future/pull/466
* PHP-8.3.: fix decrement on bool by @sreichel in https://github.com/Shardj/zf1-future/pull/465

* Fix deprecation notice when using AjaxContext by @robskr in https://github.com/Shardj/zf1-future/pull/469
* Fixed bug #467: Added trait check in Zend_Loader to prevent Zend_Exce… by @sanhe in https://github.com/Shardj/zf1-future/pull/471
* Update INSTALL.md fix requirements url by @gnovaro in https://github.com/Shardj/zf1-future/pull/472
* Handle edge case for failed splitText in lucene Html.php by @GuillaumeCible in https://github.com/Shardj/zf1-future/pull/473
* Fix phpstan errors by @sreichel in https://github.com/Shardj/zf1-future/pull/475
* Fix #437 empty null parameter in Statement.php by @gnovaro in https://github.com/Shardj/zf1-future/pull/482
* Fix Passing null to parameter 4 ($exptime) of type int is deprecated by @simonschaufi in https://github.com/Shardj/zf1-future/pull/476
* Workaround for return type deprecation notice at PHP 8.4 by @alexgit2k in https://github.com/Shardj/zf1-future/pull/487
* Fix: Passing null is deprecated in `Zend_Mail::_filterEmail()` by @sreichel in https://github.com/Shardj/zf1-future/pull/488


## [1.24.2] - 2024-10-25

### Fixed
 Revert undefined property declarations #453 

## [1.24.1] - 2024-10-15

### Added

* Added TLS v1.3 protocol by @ADDISON74 in https://github.com/Shardj/zf1-future/pull/447
* Updated github workflow by @sreichel in https://github.com/Shardj/zf1-future/pull/445

### Fixed

* Fix for very slow chunk processing for larger content in the http res… by @aleksandar-mitrev in https://github.com/Shardj/zf1-future/pull/354
* Add check in DbTable Authentication Adapter for empty results when AmbiguityIdentity is TRUE by @rruchte in https://github.com/Shardj/zf1-future/pull/419
* Fix deprecation message in php8 with null param with realpath() by @tsmgeek in https://github.com/Shardj/zf1-future/pull/413
* Fix deprecated usage of string functions in `BaseUrl` helper. by @muli in https://github.com/Shardj/zf1-future/pull/410
* Support for PHP 8.2 by @Fredthelead in https://github.com/Shardj/zf1-future/pull/438
* PHP8.4: Implicitly nullable by @sreichel in https://github.com/Shardj/zf1-future/pull/442
* Skip broken PhpUnit tests by @sreichel in https://github.com/Shardj/zf1-future/pull/443
* Update composer.json homepage property by @B3none in https://github.com/Shardj/zf1-future/pull/432
* PHPStan fixes by @thomaslauria in https://github.com/Shardj/zf1-future/pull/434
* Fix "Undefined variable $c" in Zend_XmlRpc_Server::setResponseClass() by @lapiudevgit in https://github.com/Shardj/zf1-future/pull/451
* Fix PHP Deprecated: Creation of dynamic property $zfBreakChainOnFailure from Zend_Form_Element by @hung202028 in https://github.com/Shardj/zf1-future/pull/440

## [1.24.0] - 2024-02-05
- introduced BREAKING CHANGES doc.

### Added
- support "samesite" cookie attribute in Zend_Http_Header_SetCookie in https://github.com/Shardj/zf1-future/issues/315
- Support X-Forwarded-Proto header in https://github.com/Shardj/zf1-future/pull/386
- added setting to disable automatic strigify of pdo mysql in https://github.com/Shardj/zf1-future/pull/378

### Fixed
- reverted Deprecated : Return type on Zend_Session_SaveHandler_DbTable in https://github.com/Shardj/zf1-future/issues/377
- Zend_Db_Adapter_Db2 limit does not work in https://github.com/Shardj/zf1-future/issues/391
- Zend_Http_Client-Adapter_Socket - check transfer-encoding header is a string (and not an array) in https://github.com/Shardj/zf1-future/pull/396
- Fixes A non-numeric value encountered in PhpMath.php in https://github.com/Shardj/zf1-future/pull/402
- Updated DocBlocks to return $this for fluent interface in https://github.com/Shardj/zf1-future/pull/390
- add "array" as allowed type of $value in https://github.com/Shardj/zf1-future/pull/387
- Avoid undefined array key access inside url assembly in https://github.com/Shardj/zf1-future/pull/383
- Fixed #357 return type backward-compatible issue reported in https://github.com/Shardj/zf1-future/pull/379
- Fixed missing property in https://github.com/Shardj/zf1-future/pull/376


## [1.23.5] - 2023-08-24
### Fixed
- further Zend Mail sendmail transport validation tweak

## [1.23.4] - 2023-08-24
### Fixed
- corrected Zend Mail sendmail transport comparison

## [1.23.3] - 2023-08-23
### Added
- Enabled testing of APCU for all PHP versions when running with all extensions enabled by @boenrobot in https://github.com/Shardj/zf1-future/pull/363
    
### Fixed
- Finnish date translations by @Lodewyk in https://github.com/Shardj/zf1-future/pull/368
- addressed 5th sendmail param validation using -f (#326) by @develart-projects in https://github.com/Shardj/zf1-future/pull/371

## [1.23.2] - 2023-08-15
### Fixed
- corrected versioning and changelog

## [1.23.1] - 2023-08-15
### Fixed
- Pdo transaction bring back like php7 by @hungtrinh in #365
- sendmail header sanitization quick-fix, as described in #326 by @develart-projects in #366

## [1.23.0] - 2023-08-10
### Added
- Made tests be able to run on all supported PHP versions, and run successfully by @boenrobot in #353
- Extend native SessionHandlerInterface by @holtkamp in #357
    
### Fixed
- Added typecast to stop depreciation messages by @krytenuk in #325
- Version and minor fixes by @develart-projects in #364

## [1.22.1] - 2023-08-07
### Fixed
- getTranslator() docblocks for the Zend_Form family by @boenrobot in #311
- Fixed the version test since the latest release. by @boenrobot in #312
- Fix: pin phpunit to 9 instead of latest (10) in github actions by @hungtrinh in #321
- Pdo sqlite keep bc since php81 by @hungtrinh in #320
- Keep pdo mysql adapter fetch digit field type BC with php <= 8.0 by @hungtrinh in #324
- PDO: Fix partial error return when using a encrypted connection by @TAINCER in #327
- Partial helper pull vars from view model by @hungtrinh in #329
- [Zend_Ldap] php 8.1 & 8.2 compatibility fixes by @hungtrinh in #333
- SUPEE-10752 from Magento 1.9.3.9 by @fballiano in #313
- Set stream context before opening socket by @tsmgeek in #330
- Fixed PHPDoc in Zend_Validate_Regex by @PHPGangsta in #332
- [Github action] - On test zend ldap by @hungtrinh in #335
- zend-validate fix issue: File "Intelligentmail.php" does not exist by @hungtrinh in #336
- Fixing typo in README.txt generation part by @me-ve in #338
- isNumber() bugfix by @develart-projects in #262
- PHP8.2 - Fix null beeing passed to urlencode by @griesi007 in #358
- Basic Sendgrid Transport Class by @tsmgeek in #331
- Fix/cache apcu update by @emelyanov-s in #342
- Fix PHPDoc for @methods to ensure static analysers understand it by @holtkamp in #349
- Added more precise return types on Zend_Controller_Request_Http by @staabm in #347
- Fix docblock in Zend_Json_Server by @kiatng in #361

## [1.22.0] - 2023-01-16
### Added
- Github actions and test improvements #298, #292, #287, #285, #284, #280, #275, #273, #272, #269
- Add AllowDynamicProperties Attribute to classes
- Rector added for easier version upgrades #290
- Mysqli support for connection flags #300

### Fixed
- Limit mktime() YEAR input to prevent 504 error #299
- Generic fixes #310, #303, #297, #296, #295, #279 
- Parameter type corrections #306, #294, #266
- Removed code supporting PHP 5.3.3 #265
- stream_set_option is not implemented error fixed #263
- Further PHP 8.2 fixes #291, #289, #281, #261, #268, #277
- Depreciation message fixed for strtoupper #260
- Further PHP 8.1 fixes #301, #258, #269

## [1.21.4] - 2022-09-22
### Added
- CHANGELOG.md
- Now accepting HTTP 2 in Zend_Http_Response #247
### Fixed
- preg_match deprication fixed #256
- Annotation correction #255
- utf8_encode() and utf8_decode() which PHP 8.2 will depricate, have been replaced #252
- Fix for deprecation of ${var} string interpolation for PHP 8.2 #253
- Fixes array keys in filter constructor call #249
- Fixes re-encoding in PDF properties #245
