![zf1-future logo](https://imgur.com/S0i6qOh.png)
<sub><sup>Thanks to [WebTigers](https://github.com/WebTigers) for the logo</sup></sub>

#AIM of this doc.
As pressure to implement some PHP 8.2+ related changes are raising, we are goig to track any possible breaking change, starting from version 1.24.0

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

