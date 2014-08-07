[05-Aug-2014 13:59:23] Error (code: -9999): We are deploying new changes to our store. One minute and they will go live!
Server API: apache2handler;
Request method: GET;
URI: /xcart/admin.php;
Backtrace: 
#0 /var/www/html/xcart/Includes/ErrorHandler.php(348): Includes\ErrorHandler::throwException('We are deployin...', -9999)
#1 /var/www/html/xcart/Includes/Decorator/Utils/CacheManager.php(484): Includes\ErrorHandler::fireError('We are deployin...', -9999)
#2 /var/www/html/xcart/Includes/Decorator/Utils/CacheManager.php(624): Includes\Decorator\Utils\CacheManager::checkIfRebuildStarted()
#3 /var/www/html/xcart/Includes/Decorator/Utils/CacheManager.php(654): Includes\Decorator\Utils\CacheManager::runStep(6)
#4 /var/www/html/xcart/Includes/Decorator/Utils/CacheManager.php(946): Includes\Decorator\Utils\CacheManager::runStepConditionally(6)
#5 /var/www/html/xcart/top.inc.PHP53.php(111): Includes\Decorator\Utils\CacheManager::rebuildCache()
#6 /var/www/html/xcart/top.inc.php(45): require_once('/var/www/html/x...')
#7 /var/www/html/xcart/admin.php(35): require_once('/var/www/html/x...')
#8 {main}

[05-Aug-2014 17:20:23] Error (code: -9999): We are deploying new changes to our store. One minute and they will go live!
Server API: apache2handler;
Request method: GET;
URI: /xcart/admin.php;
Backtrace: 
#0 /var/www/html/xcart/Includes/ErrorHandler.php(348): Includes\ErrorHandler::throwException('We are deployin...', -9999)
#1 /var/www/html/xcart/Includes/Decorator/Utils/CacheManager.php(484): Includes\ErrorHandler::fireError('We are deployin...', -9999)
#2 /var/www/html/xcart/Includes/Decorator/Utils/CacheManager.php(624): Includes\Decorator\Utils\CacheManager::checkIfRebuildStarted()
#3 /var/www/html/xcart/Includes/Decorator/Utils/CacheManager.php(654): Includes\Decorator\Utils\CacheManager::runStep(6)
#4 /var/www/html/xcart/Includes/Decorator/Utils/CacheManager.php(946): Includes\Decorator\Utils\CacheManager::runStepConditionally(6)
#5 /var/www/html/xcart/top.inc.PHP53.php(111): Includes\Decorator\Utils\CacheManager::rebuildCache()
#6 /var/www/html/xcart/top.inc.php(45): require_once('/var/www/html/x...')
#7 /var/www/html/xcart/admin.php(35): require_once('/var/www/html/x...')
#8 {main}

