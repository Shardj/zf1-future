![zf1-future logo](https://imgur.com/S0i6qOh.png)
<sub><sup>Thanks to [WebTigers](https://github.com/WebTigers) for the logo</sup></sub>

#AIM of this doc.
As pressure to implement some PHP 8.2+ related changes are raising, we are goig to track any possible breaking change, starting from version 1.24.0

### 1.27.0
* Methods that returned null on some paths return what their docblock and their parent method declare. Code that tested the result for null or for falsiness on these paths has to be adjusted:
  * Zend_Console_Getopt::parse() returns the instance also when the options were parsed already.
  * Zend_Controller_Action_Helper_ContextSwitch::addActionContext() and setActionContext() return the instance also without an action controller.
  * Zend_Tool_Project_Profile_Resource::initializeContext() returns the instance also when the context is initialized already; the init() methods of the Zend_Tool_Project_Context_Zf file and directory contexts (ApplicationDirectory, BootstrapFile, ControllerFile, DbTableFile, FormFile, ModelFile) return the instance.
  * Zend_Dojo_Form::loadDefaultDecorators(), Zend_Dojo_Form_SubForm::loadDefaultDecorators() and Zend_Measure_Number::setType() return the instance, as Zend_Form::loadDefaultDecorators() and Zend_Measure_Abstract::setType() do.
  * Zend_Db_Profiler_Firebug::queryEnd() returns the state of the query (`Zend_Db_Profiler::STORED` or `Zend_Db_Profiler::IGNORED`), as Zend_Db_Profiler::queryEnd() does.
  * Zend_Search_Lucene_Storage_File_Memory::seek() returns 0, as the filesystem implementation does on success.

### 1.26.1
* Zend_Text_Table::__toString() and the __toString() of the navigation view helpers (`Zend_View_Helper_Navigation_HelperAbstract`) throw an exception of the rendering, as `render()` does, which PHP allows since 7.4. They caught it and triggered `E_USER_ERROR` with its message, which PHP 8.4 deprecated. Without an error handler, the script still ends on such an error, now with the uncaught exception. An error handler that took the `E_USER_ERROR` and returned `true` let the navigation render as an empty string; the exception now reaches the caller, e.g. the error controller (Zend_Text_Table::__toString() returned null there, which was already an error).
* Zend_Date::getSunrise(), getSunset() and getSunInfo() with the horizon `civil`, `nautic` or `astronomic` return the begin and end of that twilight (sun 6, 12 or 18 degrees below the horizon), from `date_sun_info()`. Before, PHP 8.1+ returned the sunrise and sunset for every horizon, and older PHP a time about a minute off the sunrise and sunset. On PHP 7.4 and 8.0, the sunrise and sunset of the default horizon (`effective`) are those of `date_sun_info()` too, as on PHP 8.1+, a few minutes off the former `date_sunrise()`/`date_sunset()` times.
* Zend_Filter_Encrypt_Openssl seals the content with `aes-256-cbc` and stores the IV of the cipher (16 bytes) in front of the sealed content; the `cipher` option selects another cipher of `openssl_get_cipher_methods()`. Before, the content was sealed with RC4, which OpenSSL 3 (Ubuntu 22.04+, Debian 12+, RHEL 9+) only provides in its legacy provider, so the adapter could neither encrypt nor decrypt there. Content sealed by earlier versions is decrypted with `'cipher' => 'rc4'` on a system whose OpenSSL still provides RC4; it cannot be decrypted on OpenSSL 3 without the legacy provider, as before.
* Zend_Filter_Encrypt and Zend_Filter_Decrypt (and the file filters) use the Openssl adapter when no adapter is named. The previous default, the deprecated Mcrypt adapter, threw an exception on every PHP without the mcrypt extension.

### 1.26.0
* Zend_Db_Select: a union part (`Zend_Db_Select` instance) with its own `ORDER BY` or `LIMIT` is rendered in parentheses, `… UNION (SELECT … ORDER BY … LIMIT …)`. Before, the clauses were rendered unparenthesized and applied to the whole union on MySQL and PostgreSQL (and were a syntax error on SQLite). To sort or limit the whole union, call `order()` / `limit()` on the select that holds the union (#505).
* locale data was updated from CLDR 25 (2014) to CLDR 48.2 (#554). Localized output of Zend_Locale, Zend_Date, Zend_Currency, Zend_Locale_Format and the localized filters/validators follows the current data, for example:
  * no-break spaces (U+00A0) and narrow no-break spaces (U+202F) are used where a plain space was used before, e.g. before AM/PM in English times and in the de_AT and fr number formats
  * the de_AT group separator is a space (`1 234,56`), de/de_DE still uses a dot
  * date and time are separated by a comma in many locales (`13.02.2009, 23:31:30`)
  * de has no own AM/PM names anymore and uses `AM`/`PM`
  * ar uses Latin digits by default, ar_EG still uses Arabic digits
  * currencies without a symbol of their own (e.g. ARS) are shown with their ISO code instead of `$`
  * en_GB inherits from en_001
  * territories of a language (`territorytolanguage`, `languagetoterritory`) are taken from the official languages in `territoryInfo`
* don't compare localized strings against hardcoded values in your application, they change with the CLDR data
* input parsing accepts a plain space for space-like group separators (no-break and narrow no-break space)
* Zend_Validate_Hostname (and so Zend_Validate_EmailAddress) accepts more internationalized hostnames when the intl extension is loaded: under an internationalized TLD that has no character table in the validator, a non-ASCII label is checked against IDNA 2008 (UTS #46) with `idn_to_ascii()` and accepted when it is valid there, e.g. `نمونه.ایران` or `пример.укр`. TLDs with a table (`.de`, `.se`, `.com`, …) and ASCII TLDs without one (`.uk`) keep their rules, so nothing that was valid before becomes invalid. Without intl the behaviour is unchanged (#477).
* `Zend_Db_Table_Row_Abstract::offsetUnset()` returns nothing, as `ArrayAccess::offsetUnset()` is declared `void` since PHP 8.1. It returned `$this` (the result of `__unset()`) before, so chained calls on its return value have to be split (#360):
  ```php
  $row->offsetUnset($x)->offsetUnset($y);   // before
  $row->offsetUnset($x);                     // now, or
  unset($row[$x], $row[$y]);
  ```
  `__unset()` itself still returns `$this`. The method keeps `#[\ReturnTypeWillChange]` and no native return type, so row subclasses that override it without a return type keep working.
* `next()` and `rewind()` of the Zend_Pdf iterators (`Zend_Pdf_Action`, `Zend_Pdf_Outline`, `Zend_Pdf_NameTree`, `Zend_Pdf_RecursivelyIteratableObjectsContainer`) return nothing instead of the result of PHP's `next()` / `reset()` (#360).
* Zend_Application_Resource_Useragent lives in `Zend/Application/Resource/Useragent.php` (the class is `Zend_Application_Resource_Useragent`), so the `useragent` bootstrap resource (`resources.useragent.*`) is resolved by the plugin loader on case-sensitive file systems, as in ZF 1.12. Code that includes the file by its previous path `Zend/Application/Resource/UserAgent.php` has to use the new name; class names are case-insensitive in PHP, so `Zend_Application_Resource_UserAgent` in `extends` or `instanceof` keeps working (#407).

### 1.25.3
These are bug fixes that restore the behaviour ZF1 documents; they are listed here because the output can differ from 1.25.2 in edge cases.
* Zend_Validate_Hostname: the list of known TLDs follows the IANA root zone (2026-11-02). TLDs retired by IANA (brand TLDs such as `.intel` or `.symantec`, and the IANA test TLDs) are no longer accepted, TLDs delegated since 2020 are. A TLD missing from the list is looked up in DNS (NS record of the TLD), which `setValidateTldDns(false)` or the `tldDns` option turns off (#314).
* Zend_Db_Adapter_Db2 and Zend_Db_Adapter_Pdo_Ibm (DB2): limit() with an offset generates `OFFSET n ROWS FETCH FIRST m ROWS ONLY` instead of the `ROW_NUMBER()` subquery, and the result set no longer contains the extra `ZEND_DB_ROWNUM` column. Supported since Db2 for i 7.1 TR11 / 7.2 TR3 and Db2 LUW 11.1; older versions cannot run the PHP versions this release supports (#393).
* Zend_Db mysqli adapter: `mysqli_sql_exception` (thrown by mysqli since PHP 8.1) is converted into `Zend_Db_Adapter_Mysqli_Exception` / `Zend_Db_Statement_Mysqli_Exception`, so `catch (Zend_Db_Exception $e)` works again. Code that caught `mysqli_sql_exception` directly has to catch the Zend_Db exception; the original is available via `getPrevious()` (#561).

### 1.25.0
* since this release, any support for PHP 7.1-7.3 is officially dropped. Fix the version to ~1.24 if you still need to run PHP below 7.4
* deprecation notice is not considered a bug 

### 1.24.0
* some depracation messages have been suppresses for 8.1, but reverted: https://github.com/Shardj/zf1-future/issues/377

