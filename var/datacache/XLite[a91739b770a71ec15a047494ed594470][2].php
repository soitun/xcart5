<?php die(); ?>          0O:31:"Doctrine\ORM\Query\ParserResult":3:{s:45:" Doctrine\ORM\Query\ParserResult _sqlExecutor";O:44:"Doctrine\ORM\Query\Exec\SingleSelectExecutor":2:{s:17:" * _sqlStatements";s:487:"SELECT x0_.method_id AS method_id0, x0_.service_name AS service_name1, x0_.class AS class2, x0_.moduleName AS moduleName3, x0_.orderby AS orderby4, x0_.enabled AS enabled5, x0_.moduleEnabled AS moduleEnabled6, x0_.added AS added7, x0_.type AS type8 FROM xc_payment_methods x0_ LEFT JOIN xc_payment_method_translations x1_ ON x0_.method_id = x1_.id AND (x1_.code = ?) WHERE x0_.moduleEnabled = ? AND x0_.added = ? AND (x0_.class <> ? AND x0_.type = ?) ORDER BY x0_.class ASC, x1_.name ASC";s:20:" * queryCacheProfile";N;}s:50:" Doctrine\ORM\Query\ParserResult _resultSetMapping";O:35:"Doctrine\ORM\Query\ResultSetMapping":14:{s:7:"isMixed";b:0;s:8:"aliasMap";a:1:{s:1:"m";s:26:"XLite\Model\Payment\Method";}s:11:"relationMap";a:0:{}s:14:"parentAliasMap";a:0:{}s:13:"fieldMappings";a:9:{s:10:"method_id0";s:9:"method_id";s:13:"service_name1";s:12:"service_name";s:6:"class2";s:5:"class";s:11:"moduleName3";s:10:"moduleName";s:8:"orderby4";s:7:"orderby";s:8:"enabled5";s:7:"enabled";s:14:"moduleEnabled6";s:13:"moduleEnabled";s:6:"added7";s:5:"added";s:5:"type8";s:4:"type";}s:14:"scalarMappings";a:0:{}s:12:"typeMappings";a:0:{}s:14:"entityMappings";a:1:{s:1:"m";N;}s:12:"metaMappings";a:0:{}s:14:"columnOwnerMap";a:9:{s:10:"method_id0";s:1:"m";s:13:"service_name1";s:1:"m";s:6:"class2";s:1:"m";s:11:"moduleName3";s:1:"m";s:8:"orderby4";s:1:"m";s:8:"enabled5";s:1:"m";s:14:"moduleEnabled6";s:1:"m";s:6:"added7";s:1:"m";s:5:"type8";s:1:"m";}s:20:"discriminatorColumns";a:0:{}s:10:"indexByMap";a:0:{}s:16:"declaringClasses";a:9:{s:10:"method_id0";s:26:"XLite\Model\Payment\Method";s:13:"service_name1";s:26:"XLite\Model\Payment\Method";s:6:"class2";s:26:"XLite\Model\Payment\Method";s:11:"moduleName3";s:26:"XLite\Model\Payment\Method";s:8:"orderby4";s:26:"XLite\Model\Payment\Method";s:8:"enabled5";s:26:"XLite\Model\Payment\Method";s:14:"moduleEnabled6";s:26:"XLite\Model\Payment\Method";s:6:"added7";s:26:"XLite\Model\Payment\Method";s:5:"type8";s:26:"XLite\Model\Payment\Method";}s:18:"isIdentifierColumn";a:0:{}}s:51:" Doctrine\ORM\Query\ParserResult _parameterMappings";a:5:{s:3:"lng";a:1:{i:0;i:0;}s:20:"module_enabled_value";a:1:{i:0;i:1;}s:11:"added_value";a:1:{i:0;i:2;}s:5:"class";a:1:{i:0;i:3;}s:11:"offlineType";a:1:{i:0;i:4;}}}