![zf1-future logo](https://imgur.com/S0i6qOh.png)
<sub><sup>Thanks to [WebTigers](https://github.com/WebTigers) for the logo</sup></sub>

#AIM of this doc.
As pressure to implement some PHP 8.2+ related changes are raising, we are goig to track any possible breaking change, starting from version 1.24.0

### Unreleased
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

