![zf1-future logo](https://imgur.com/S0i6qOh.png)
<sub><sup>Thanks to [WebTigers](https://github.com/WebTigers) for the logo</sup></sub>

#AIM of this doc.
As pressure to implement some PHP 8.2+ related changes are raising, we are goig to track any possible breaking change, starting from version 1.24.0

### Unreleased
* Zend_Validate_Hostname rejects TLDs that IANA has retired since 2020 (mostly brand TLDs such as `.intel`, `.symantec` or `.volkswagen`, and the IANA test TLDs). An unknown TLD is now looked up in DNS by default, which makes a network request; `setValidateTldDns(false)` or the `tldDns` option disables the lookup (#314).
* Zend_Db_Adapter_Db2 and Zend_Db_Adapter_Pdo_Ibm (DB2) generate `OFFSET n ROWS FETCH FIRST m ROWS ONLY` for limit() with an offset (#393). It requires Db2 for i 7.1 TR11 / 7.2 TR3 or Db2 LUW 11.1 and newer. The result set no longer contains the `ZEND_DB_ROWNUM` column.

### 1.25.0
* since this release, any support for PHP 7.1-7.3 is officially dropped. Fix the version to ~1.24 if you still need to run PHP below 7.4
* deprecation notice is not considered a bug 

### 1.24.0
* some depracation messages have been suppresses for 8.1, but reverted: https://github.com/Shardj/zf1-future/issues/377

