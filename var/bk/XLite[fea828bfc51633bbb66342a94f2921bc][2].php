<?php die(); ?>          0O:31:"Doctrine\ORM\Query\ParserResult":3:{s:45:" Doctrine\ORM\Query\ParserResult _sqlExecutor";O:44:"Doctrine\ORM\Query\Exec\SingleSelectExecutor":2:{s:17:" * _sqlStatements";s:277:"SELECT COUNT(x0_.order_id) AS sclr0 FROM xc_orders x0_ INNER JOIN xc_profiles x1_ ON x0_.profile_id = x1_.profile_id LEFT JOIN xc_profiles x2_ ON x0_.orig_profile_id = x2_.profile_id WHERE (x0_.is_order IN ('1')) AND x0_.is_order IN ('1', '0') ORDER BY x0_.order_id ASC LIMIT 1";s:20:" * queryCacheProfile";N;}s:50:" Doctrine\ORM\Query\ParserResult _resultSetMapping";O:35:"Doctrine\ORM\Query\ResultSetMapping":14:{s:7:"isMixed";b:0;s:8:"aliasMap";a:0:{}s:11:"relationMap";a:0:{}s:14:"parentAliasMap";a:0:{}s:13:"fieldMappings";a:0:{}s:14:"scalarMappings";a:1:{s:5:"sclr0";i:1;}s:12:"typeMappings";a:1:{s:5:"sclr0";s:6:"string";}s:14:"entityMappings";a:0:{}s:12:"metaMappings";a:0:{}s:14:"columnOwnerMap";a:0:{}s:20:"discriminatorColumns";a:0:{}s:10:"indexByMap";a:0:{}s:16:"declaringClasses";a:0:{}s:18:"isIdentifierColumn";a:0:{}}s:51:" Doctrine\ORM\Query\ParserResult _parameterMappings";a:0:{}}