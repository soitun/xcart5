<?php die(); ?>          0O:31:"Doctrine\ORM\Query\ParserResult":3:{s:45:" Doctrine\ORM\Query\ParserResult _sqlExecutor";O:44:"Doctrine\ORM\Query\Exec\SingleSelectExecutor":2:{s:17:" * _sqlStatements";s:1171:"SELECT x0_.moduleID AS moduleID0, x0_.name AS name1, x0_.author AS author2, x0_.authorEmail AS authorEmail3, x0_.enabled AS enabled4, x0_.installed AS installed5, x0_.yamlLoaded AS yamlLoaded6, x0_.date AS date7, x0_.rating AS rating8, x0_.votes AS votes9, x0_.downloads AS downloads10, x0_.price AS price11, x0_.currency AS currency12, x0_.majorVersion AS majorVersion13, x0_.minorVersion AS minorVersion14, x0_.minorRequiredCoreVersion AS minorRequiredCoreVersion15, x0_.revisionDate AS revisionDate16, x0_.packSize AS packSize17, x0_.xcnPlan AS xcnPlan18, x0_.moduleName AS moduleName19, x0_.authorName AS authorName20, x0_.description AS description21, x0_.iconURL AS iconURL22, x0_.pageURL AS pageURL23, x0_.authorPageURL AS authorPageURL24, x0_.dependencies AS dependencies25, x0_.tags AS tags26, x0_.fromMarketplace AS fromMarketplace27, x0_.isLanding AS isLanding28, x0_.landingPosition AS landingPosition29, x0_.isSystem AS isSystem30, x0_.hasLicense AS hasLicense31, x0_.editionState AS editionState32, x0_.editions AS editions33 FROM xc_modules x0_ WHERE x0_.installed = ? AND x0_.isSystem = ? GROUP BY x0_.name, x0_.author ORDER BY x0_.moduleName ASC LIMIT 30";s:20:" * queryCacheProfile";N;}s:50:" Doctrine\ORM\Query\ParserResult _resultSetMapping";O:35:"Doctrine\ORM\Query\ResultSetMapping":14:{s:7:"isMixed";b:0;s:8:"aliasMap";a:1:{s:1:"m";s:18:"XLite\Model\Module";}s:11:"relationMap";a:0:{}s:14:"parentAliasMap";a:0:{}s:13:"fieldMappings";a:34:{s:9:"moduleID0";s:8:"moduleID";s:5:"name1";s:4:"name";s:7:"author2";s:6:"author";s:12:"authorEmail3";s:11:"authorEmail";s:8:"enabled4";s:7:"enabled";s:10:"installed5";s:9:"installed";s:11:"yamlLoaded6";s:10:"yamlLoaded";s:5:"date7";s:4:"date";s:7:"rating8";s:6:"rating";s:6:"votes9";s:5:"votes";s:11:"downloads10";s:9:"downloads";s:7:"price11";s:5:"price";s:10:"currency12";s:8:"currency";s:14:"majorVersion13";s:12:"majorVersion";s:14:"minorVersion14";s:12:"minorVersion";s:26:"minorRequiredCoreVersion15";s:24:"minorRequiredCoreVersion";s:14:"revisionDate16";s:12:"revisionDate";s:10:"packSize17";s:8:"packSize";s:9:"xcnPlan18";s:7:"xcnPlan";s:12:"moduleName19";s:10:"moduleName";s:12:"authorName20";s:10:"authorName";s:13:"description21";s:11:"description";s:9:"iconURL22";s:7:"iconURL";s:9:"pageURL23";s:7:"pageURL";s:15:"authorPageURL24";s:13:"authorPageURL";s:14:"dependencies25";s:12:"dependencies";s:6:"tags26";s:4:"tags";s:17:"fromMarketplace27";s:15:"fromMarketplace";s:11:"isLanding28";s:9:"isLanding";s:17:"landingPosition29";s:15:"landingPosition";s:10:"isSystem30";s:8:"isSystem";s:12:"hasLicense31";s:10:"hasLicense";s:14:"editionState32";s:12:"editionState";s:10:"editions33";s:8:"editions";}s:14:"scalarMappings";a:0:{}s:12:"typeMappings";a:0:{}s:14:"entityMappings";a:1:{s:1:"m";N;}s:12:"metaMappings";a:0:{}s:14:"columnOwnerMap";a:34:{s:9:"moduleID0";s:1:"m";s:5:"name1";s:1:"m";s:7:"author2";s:1:"m";s:12:"authorEmail3";s:1:"m";s:8:"enabled4";s:1:"m";s:10:"installed5";s:1:"m";s:11:"yamlLoaded6";s:1:"m";s:5:"date7";s:1:"m";s:7:"rating8";s:1:"m";s:6:"votes9";s:1:"m";s:11:"downloads10";s:1:"m";s:7:"price11";s:1:"m";s:10:"currency12";s:1:"m";s:14:"majorVersion13";s:1:"m";s:14:"minorVersion14";s:1:"m";s:26:"minorRequiredCoreVersion15";s:1:"m";s:14:"revisionDate16";s:1:"m";s:10:"packSize17";s:1:"m";s:9:"xcnPlan18";s:1:"m";s:12:"moduleName19";s:1:"m";s:12:"authorName20";s:1:"m";s:13:"description21";s:1:"m";s:9:"iconURL22";s:1:"m";s:9:"pageURL23";s:1:"m";s:15:"authorPageURL24";s:1:"m";s:14:"dependencies25";s:1:"m";s:6:"tags26";s:1:"m";s:17:"fromMarketplace27";s:1:"m";s:11:"isLanding28";s:1:"m";s:17:"landingPosition29";s:1:"m";s:10:"isSystem30";s:1:"m";s:12:"hasLicense31";s:1:"m";s:14:"editionState32";s:1:"m";s:10:"editions33";s:1:"m";}s:20:"discriminatorColumns";a:0:{}s:10:"indexByMap";a:0:{}s:16:"declaringClasses";a:34:{s:9:"moduleID0";s:18:"XLite\Model\Module";s:5:"name1";s:18:"XLite\Model\Module";s:7:"author2";s:18:"XLite\Model\Module";s:12:"authorEmail3";s:18:"XLite\Model\Module";s:8:"enabled4";s:18:"XLite\Model\Module";s:10:"installed5";s:18:"XLite\Model\Module";s:11:"yamlLoaded6";s:18:"XLite\Model\Module";s:5:"date7";s:18:"XLite\Model\Module";s:7:"rating8";s:18:"XLite\Model\Module";s:6:"votes9";s:18:"XLite\Model\Module";s:11:"downloads10";s:18:"XLite\Model\Module";s:7:"price11";s:18:"XLite\Model\Module";s:10:"currency12";s:18:"XLite\Model\Module";s:14:"majorVersion13";s:18:"XLite\Model\Module";s:14:"minorVersion14";s:18:"XLite\Model\Module";s:26:"minorRequiredCoreVersion15";s:18:"XLite\Model\Module";s:14:"revisionDate16";s:18:"XLite\Model\Module";s:10:"packSize17";s:18:"XLite\Model\Module";s:9:"xcnPlan18";s:18:"XLite\Model\Module";s:12:"moduleName19";s:18:"XLite\Model\Module";s:12:"authorName20";s:18:"XLite\Model\Module";s:13:"description21";s:18:"XLite\Model\Module";s:9:"iconURL22";s:18:"XLite\Model\Module";s:9:"pageURL23";s:18:"XLite\Model\Module";s:15:"authorPageURL24";s:18:"XLite\Model\Module";s:14:"dependencies25";s:18:"XLite\Model\Module";s:6:"tags26";s:18:"XLite\Model\Module";s:17:"fromMarketplace27";s:18:"XLite\Model\Module";s:11:"isLanding28";s:18:"XLite\Model\Module";s:17:"landingPosition29";s:18:"XLite\Model\Module";s:10:"isSystem30";s:18:"XLite\Model\Module";s:12:"hasLicense31";s:18:"XLite\Model\Module";s:14:"editionState32";s:18:"XLite\Model\Module";s:10:"editions33";s:18:"XLite\Model\Module";}s:18:"isIdentifierColumn";a:0:{}}s:51:" Doctrine\ORM\Query\ParserResult _parameterMappings";a:2:{s:9:"installed";a:1:{i:0;i:0;}s:8:"isSystem";a:1:{i:0;i:1;}}}