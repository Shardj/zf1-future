![zf1-future logo](https://imgur.com/S0i6qOh.png)
<sub><sup>Thanks to [WebTigers](https://github.com/WebTigers) for the logo</sup></sub>
# Zend Framework 1 now for PHP 8.4!
### Classic ZF1 Reborn
Zend may have abandoned the original Zend Framework, but the global Zend Framework Community has not! Since Zend sentenced ZF1 to EOL, the Zend Framework community around the globe has continued to work and build on what we consider to be one of the best PHP frameworks of all time.
Framework is supported and tested on PHP 7.4 up to 8.4. PHP 8.5 is part of the regular test suite as well, but may still show deprecation notices; PHP 8.6 is tested as experimental.

# ZF1-Future Sponsors
### Products and Projects built with ZF1-Future:

<a href="https://webtigers.com"><img src="https://webtigers.s3.amazonaws.com/logos/Logo-New-1-Dark.png" width="50%" /></a>

Creators of the [Tiger Development Platform](https://webtigers.com) featuring ZF1-Future

<a href="https://seidengroup.com"><img src="https://www.seidengroup.com/wp-content/uploads/2017/03/SeidenLogo-180.png" alt="Seiden Group: IBM i modernization, PHP, Python, Node.js, and modern RPG" /></a>

Creators of [Seiden PHP+ for IBM i](https://www.seidengroup.com/seiden-php-for-ibm-i/) featuring ZF1-Future

# ZF1 is Now Version 1.27!
### Over 250 updates and bug fixes since 1.12!
The ZF1 community has been hard at work updating Zend Framework with all of the latest features of 8.4.

# Documentation
New ZF1-Future Manual: [ZF1-Future Docs](https://zf1future.com/manual)

### Original Docs
The original docs can be found here: https://framework.zend.com/manual/1.12/en/manual.html

### Installation

Installable through git clone or through  
`composer require shardj/zf1-future` https://packagist.org/packages/shardj/zf1-future  

Composer is the recommended way. If you install from git or from a release archive without Composer, add the `library` directory to your `include_path` and make sure the `ctype` and `mbstring` extensions are enabled. The Symfony polyfills from `composer.json` are not loaded in that case.

# System Requirements
ZF1 Future runs on any version of PHP between 7.4 and 8.4. PHP 8.5 is tested as well and works in practice, but is not officially supported yet (see the known issues below); PHP 8.6 is experimental (see the test matrix in `.github/workflows/phpunit.yml`).

# License
The files in this archive are released under the Zend Framework license. You can find a copy of this license in [LICENSE.txt](LICENSE.txt).

# Related Projects

*  [ZF1 Extras Future](https://github.com/Shardj/zf1-extras-future)
* [ZF1s](https://github.com/zf1s) - Another community supported continuation of ZF1, with a focus on splitting the frameworks original components into individual packages

# Mail: OAuth 2.0 (XOAUTH2) for Gmail and Microsoft 365

Since 1.26.0 `Zend_Mail` authenticates with an OAuth 2.0 access token where a password is no longer accepted: `'auth' => 'xoauth2'` with `username` and `accessToken` in `Zend_Mail_Transport_Smtp`, and `accessToken` instead of `password` in `Zend_Mail_Storage_Imap` / `Zend_Mail_Storage_Pop3`. Obtaining and refreshing the token is up to the application (e.g. with league/oauth2-google or thenetworg/oauth2-azure).

# Security

* **`unserialize()` and CVE-2020-29312.** The CVE describes no specific flaw in this library (it names a non-existent version 3.1.3, gives no affected class and no reference, and is marked as disputed by NVD); it restates that `unserialize()` of untrusted data is unsafe in PHP, whatever classes are loaded. ZF1-Future itself never unserializes request data. Where it unserializes data it wrote itself (cache metadata, locale and date caches, OpenID storage, Lucene index files) it passes `allowed_classes` to `unserialize()` since 1.26.0, so no object can be instantiated from such a file. Cache content stored with `automatic_serialization`, `Zend_Serializer`, sessions and the priority queues keep unserializing objects, because that is what they are for. In your application: never call `unserialize()` (or `Zend_Serializer::unserialize()`) on data a user can influence; use JSON for data exchange; for your own serialized data use the `unserialize_class_whitelist` option of `Zend_Serializer_Adapter_PhpSerialize` and/or an HMAC. See https://github.com/Shardj/zf1-future/issues/341

# Known issues and solutions

* ``Bootstrap error: Unable to resolve plugin "useragent"; no corresponding plugin with that name``  
   Fixed in 1.26.0 (https://github.com/Shardj/zf1-future/issues/407). On older versions the resource file has to be renamed to ``Zend/Application/Resource/Useragent.php``, see https://github.com/Shardj/zf1-future/issues/92
* ``Zend_Db_Adapter_Pdo_Mssql``: rows of a query with an offset but without ORDER BY (``limit($count, $offset)``) carry the column ``ZEND_DB_ROWNUM`` in addition to the selected columns. Such a query numbers the rows with ``ROW_NUMBER()``, which works on SQL Server 2005 and later; ``OFFSET ... FETCH``, which returns only the selected columns, needs SQL Server 2012. The SQL Server adapters are planned to change to ``OFFSET ... FETCH`` in 1.28.
* PHP 8.4: ``Zend_Session::setOptions()`` (or the ``resources.session`` options of ``Zend_Application``) with ``sid_length`` or ``sid_bits_per_character`` triggers PHP's deprecation notice, because PHP 8.4 deprecates changing ``session.sid_length`` and ``session.sid_bits_per_character``. Remove these options; PHP 9 drops the settings.
* PHP 8.4: ``Zend_Db_Adapter_Pdo_Pgsql`` returns the values of ``real`` and ``double precision`` columns as float instead of string, because pdo_pgsql does so since PHP 8.4. Code that compares such values as strings (``===``) has to cast them, or set ``PDO::ATTR_STRINGIFY_FETCHES => true`` in the ``driver_options`` of the adapter to get strings as before.
* PHP 8.4: ``Zend_Soap_Server`` turns ``E_USER_ERROR`` raised in a service method into a SOAP fault, but PHP 8.4 deprecates ``trigger_error()`` with ``E_USER_ERROR``. Throw a ``SoapFault`` or an exception in the service method instead.
* PHP 8.5: ``Zend_Soap_Client`` cannot be loaded, because the signature of ``Zend_Soap_Client_Common::__doRequest()`` is incompatible with ``SoapClient::__doRequest()`` of PHP 8.5 (fatal error). The fix changes the signature for subclasses and is planned for 1.28.
* ``Zend_Test_PHPUnit_Db`` (database fixtures for PHPUnit) is not supported. It extends the DbUnit classes ``PHPUnit_Extensions_Database_*``, which only exist for PHPUnit 5 and older; the component is shipped as is, without tests, and is not adapted to the DbUnit forks for current PHPUnit versions (their classes are namespaced and typed). Applications that need DbUnit have to use such a fork directly, see https://github.com/Shardj/zf1-future/issues/412

# Deprecated components

The following adapters and backends depend on technologies that are not available on any supported PHP version. They are kept for now, trigger an ``E_USER_DEPRECATED`` notice when instantiated, are not covered by the test suite and will be removed in a future version:

* ``Zend_Queue_Adapter_Memcacheq`` (MemcacheQ, unmaintained since 2009; use ``Zend_Queue_Adapter_Db`` or ``Zend_Queue_Adapter_Activemq``)
* ``Zend_Filter_Encrypt_Mcrypt`` (ext/mcrypt was removed in PHP 7.2; use ``Zend_Filter_Encrypt_Openssl``)
* ``Zend_Filter_Compress_Rar`` (no rar extension for current PHP versions)
* ``Zend_Cache_Backend_Sqlite`` (needs the SQLite 2 extension of PHP 5), ``Zend_Cache_Backend_Xcache``, ``Zend_Cache_Backend_ZendPlatform``, ``Zend_Cache_Backend_ZendServer_Disk``, ``Zend_Cache_Backend_ZendServer_ShMem``, ``Zend_Cache_Backend_WinCache``
* ``Zend_Serializer_Adapter_Wddx`` (ext/wddx was removed in PHP 7.4)
* ``Zend_Http_UserAgent_Features_Adapter_TeraWurfl``, ``Zend_Http_UserAgent_Features_Adapter_DeviceAtlas``
* ``Zend_Queue_Adapter_PlatformJobQueue`` and ``Zend_Queue_Message_PlatformJob`` (Zend Platform and its Job Queue are discontinued; use ``Zend_Queue_Adapter_Db`` or ``Zend_Queue_Adapter_Activemq``)
* ``Zend_Service_Ebay`` (the eBay Finding API, the only API it supports, was decommissioned on 2025-02-05)

The following components talk to services or use formats that no longer exist. They are deprecated in the same way:

* ``Zend_Amf`` and the serializer adapters ``Zend_Serializer_Adapter_Amf0`` and ``Zend_Serializer_Adapter_Amf3`` (AMF is the data format of Adobe Flash Player, which reached its end of life on 2020-12-31)
* ``Zend_Gdata`` (Google shut down the Google Data APIs it implements and the ClientLogin and AuthSub authentication)
* ``Zend_Cloud`` (the Simple Cloud API is not developed any further; use the SDK of the cloud provider)
* ``Zend_Service_ReCaptcha``, ``Zend_Captcha_ReCaptcha`` and ``Zend_Form_Decorator_Captcha_ReCaptcha`` (reCAPTCHA v1 was shut down on 2018-03-31; use ``Zend_Captcha_SiteVerify`` and ``Zend_Service_SiteVerify``)
* ``Zend_Service_Amazon``, ``Zend_Service_Amazon_Query`` and their result classes (the Product Advertising API 4.0 was shut down in 2020); ``Zend_Service_Amazon_Ec2``, ``_S3``, ``_Sqs`` and ``_SimpleDb`` are not affected
* ``Zend_Service_Delicious`` (the Delicious API was shut down on 2017-06-15)
* ``Zend_Service_Yahoo`` (the Yahoo! Search web services were shut down)
* ``Zend_Service_Audioscrobbler`` (the Audioscrobbler 1.0 web services were shut down in favour of the Last.fm API 2.0)
