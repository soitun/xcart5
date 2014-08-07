<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * X-Cart
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the software license agreement
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.x-cart.com/license-agreement.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to licensing@x-cart.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not modify this file if you wish to upgrade X-Cart to newer versions
 * in the future. If you wish to customize X-Cart for your needs please
 * refer to http://www.x-cart.com/ for more information.
 *
 * @category  X-Cart 5
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

namespace XLite\Core;

/**
 * Database
 */
class Database extends \XLite\Base\Singleton
{
    /**
     * Schema generation modes
     */
    const SCHEMA_CREATE = 'create';
    const SCHEMA_UPDATE = 'update';
    const SCHEMA_DELETE = 'delete';

    /**
     * DB schema file ident
     */
    const SCHEMA_FILE_IDENT = '  ';

    /**
     * Charset which is used for DB connection
     */
    const DB_CONNECTION_CHARSET = 'utf8';

    /**
     * Doctrine entity manager
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected static $em = null;

    /**
     * Doctrine cache driver
     *
     * @var \Doctrine\Common\Cache\AbtractCache
     */
    protected static $cacheDriver = null;

    /**
     * Cache drivers query
     *
     * @var array
     */
    protected static $cacheDriversQuery = array(
        'apc',
        'xcache',
        'memcache',
    );

    /**
     * Doctrine config object
     *
     * @var \Doctrine\ORM\Configuration
     */
    protected $configuration;

    /**
     * Table prefix
     *
     * @var string
     */
    protected $tablePrefix = '';

    /**
     * connected
     *
     * @var boolean
     */
    protected $connected;

    /**
     * Doctrine unmanaged table names list
     *
     * @var array
     */
    protected $unmanagedTables = array();

    /**
     * Forbid truncate tables if will truncate store-based tables
     *
     * @var array
     */
    protected $forbidTruncateTablesStore = array(
        'profiles',
        'currencies',
        'payment_methods',
        'shipping_methods',
        'memberships',
    );

    /**
     * Fixtures loading procedure options
     *
     * @var array
     */
    protected $fixturesLoadingOptions = array(
        'insert'    => false,
        'addModel'  => null,
        'addParent' => true,
    );

    /**
     * Get entity manager
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public static function getEM()
    {
        // FIXME
        if (!isset(static::$em)) {
            \XLite\Core\Database::getInstance();
        }

        return static::$em;
    }

    /**
     * Get repository (short method)
     *
     * @param string $repository Entity class name
     *
     * @return \Doctrine\ORM\EntityRepository
     */
    public static function getRepo($repository)
    {
        return static::loadAnnotationClass(static::getEntityClass($repository))
            ? static::getEM()->getRepository($repository)
            : null;
    }

    /**
     * Calculate the class name for entity
     *
     * @param  string $repository
     * @return string
     */
    public static function getEntityClass($entity)
    {
        return '\\' . ltrim($entity, '\\');
    }

    /**
     * Register custom types
     *
     * @return void
     */
    public static function registerCustomTypes(\Doctrine\ORM\EntityManager $em)
    {
        // Fixed string
        if (!\Doctrine\DBAL\Types\Type::hasType('fixedstring')) {
            \Doctrine\DBAL\Types\Type::addType('fixedstring', 'XLite\Core\ColumnType\FixedString');
        }
        $em->getConnection()
            ->getDatabasePlatform()
            ->registerDoctrineTypeMapping('char', 'fixedstring');

        // Unsigned integer
        if (!\Doctrine\DBAL\Types\Type::hasType('uinteger')) {
            \Doctrine\DBAL\Types\Type::addType('uinteger', 'XLite\Core\ColumnType\Uinteger');
        }
        $em->getConnection()
            ->getDatabasePlatform()
            ->registerDoctrineTypeMapping('int', 'uinteger');

        // Money
        if (!\Doctrine\DBAL\Types\Type::hasType('money')) {
            \Doctrine\DBAL\Types\Type::addType('money', 'XLite\Core\ColumnType\Money');
        }
        $em->getConnection()
            ->getDatabasePlatform()
            ->registerDoctrineTypeMapping('decimal', 'money');

        // Varbinary
        if (!\Doctrine\DBAL\Types\Type::hasType('varbinary')) {
            \Doctrine\DBAL\Types\Type::addType('varbinary', 'XLite\Core\ColumnType\VarBinary');
        }
        $em->getConnection()
            ->getDatabasePlatform()
            ->registerDoctrineTypeMapping('varbinary', 'varbinary');

        // Decimal
        if (\Doctrine\DBAL\Types\Type::hasType('decimal')) {
            \Doctrine\DBAL\Types\Type::overrideType('decimal', 'XLite\Core\ColumnType\Decimal');
        }

        // Register annotation class loader
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(
            array(get_called_class(), 'loadAnnotationClass')
        );
    }

    /**
     * Load annotation class
     *
     * @param string $class Short class name
     *
     * @return boolean
     */
    public static function loadAnnotationClass($class)
    {
        return \XLite\Core\Operator::isClassExists($class) && class_exists($class);
    }


    /**
     * Get cache driver
     *
     * @return \Doctrine\Common\Cache\CacheProvider
     */
    public static function getCacheDriver()
    {
        return static::$cacheDriver;
    }

    /**
     * Get last query length
     *
     * @return integer
     */
    public static function getLastQueryLength()
    {
        $length = static::getEM()
            ->getConnection()
            ->executeQuery('SELECT FOUND_ROWS()', array())
            ->fetchColumn();

        return intval($length);
    }

    /**
     * Prepare array for IN () DQL function
     *
     * @param array  $data   Hash array
     * @param string $prefix Placeholder prefix OPTIONAL
     *
     * @return array (keys for IN () function & parameters hash array)
     */
    public static function prepareArray(array $data, $prefix = 'arr')
    {
        $keys = array();
        $parameters = array();

        foreach ($data as $k => $v) {
            $k = $prefix . $k;
            $keys[] = ':' . $k;
            $parameters[$k] = $v;
        }

        return array($keys, $parameters);
    }

    /**
     * Build IN () condition
     *
     * @param \Doctrine\ORM\QueryBuilder $qb     Query builder
     * @param array                      $data   Hash array
     * @param string                     $prefix Placeholder prefix OPTIONAL
     *
     * @return array Keys for IN () function
     */
    public static function buildInCondition(\Doctrine\ORM\QueryBuilder $qb, array $data, $prefix = 'arr')
    {
        list($keys, $data) = static::prepareArray($data, $prefix);

        $qb->setParameters($data);

        return $keys;
    }


    /**
     * Detect APC cache driver
     *
     * @return boolean
     */
    protected static function detectCacheDriverApc()
    {
        return function_exists('apc_cache_info');
    }

    /**
     * Detect XCache cache driver
     *
     * @return boolean
     */
    protected static function detectCacheDriverXcache()
    {
        return function_exists('xcache_get');
    }

    /**
     * Detect Memcache cache driver
     *
     * @return void
     */
    protected static function detectCacheDriverMemcache()
    {
        return function_exists('memcache_connect');
    }


    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        if (!$this->connected) {
            $this->connect();
        }
    }

    /**
     * Connect and set-up Doctrine
     *
     * @return void
     */
    public function connect()
    {
        $this->configuration = new \Doctrine\ORM\Configuration();

        // Setup cache
        $this->setDoctrineCache();

        // Set metadata driver
        $chain = new \Doctrine\ORM\Mapping\Driver\DriverChain();
        $chain->addDriver($this->createAnnotationDriver(LC_DIR_CACHE_MODEL), 'XLite\Model');

        $iterator = new \RecursiveDirectoryIterator(
            LC_DIR_CACHE_CLASSES . 'XLite' . LC_DS . 'Module',
            \FilesystemIterator::SKIP_DOTS
        );

        foreach ($iterator as $dir) {
            if (
                \Includes\Utils\FileManager::isDir($dir->getPathName())
            ) {
                $iterator2 = new \RecursiveDirectoryIterator(
                    $dir->getPathName(),
                    \FilesystemIterator::SKIP_DOTS
                );

                foreach ($iterator2 as $dir2) {
                    if (
                        \Includes\Utils\FileManager::isDir($dir2->getPathName())
                        && \Includes\Utils\FileManager::isDir($dir2->getPathName() . LC_DS . 'Model')
                    ) {
                        $chain->addDriver(
                            $this->createAnnotationDriver($dir2->getPathName() . LC_DS . 'Model'),
                            'XLite\Module\\' . $dir->getBaseName() . '\\' . $dir2->getBaseName() . '\Model'
                        );
                    }
                }
            }
        }

        $this->configuration->setMetadataDriverImpl($chain);

        // Set proxy settings
        $this->configuration->setProxyDir(rtrim(LC_DIR_CACHE_PROXY, LC_DS));
        $this->configuration->setProxyNamespace(LC_MODEL_PROXY_NS);
        $this->configuration->setAutoGenerateProxyClasses(false);

        // Register custom functions
        $this->configuration->addCustomStringFunction('if', '\\XLite\\Core\\Doctrine\\IfFunction');
        $this->configuration->addCustomStringFunction('relevance', '\\XLite\\Core\\Doctrine\\RelevanceFunction');
        $this->configuration->addCustomNumericFunction('intval', '\\XLite\\Core\\Doctrine\\IntvalFunction');
        $this->configuration->addCustomStringFunction('findInSet', '\\XLite\\Core\\Doctrine\\FindInSetFunction');
        $this->configuration->addCustomStringFunction('castChar', '\\XLite\\Core\\Doctrine\\CastCharFunction');

        $this->tablePrefix = \XLite::getInstance()->getOptions(array('database_details', 'table_prefix'));

        // Initialize DB connection and entity manager
        $this->startEntityManager();
    }

    /**
     * Start Doctrine entity manager
     *
     * @return void
     */
    public function startEntityManager()
    {
        // Initialize DB connection and entity manager
        static::$em = \Doctrine\ORM\EntityManager::create($this->getDSN(), $this->configuration);

        static::registerCustomTypes(static::$em);

        // Set charset for DB connection
        $this->setCharset();

        // Bind events
        $events = array(\Doctrine\ORM\Events::loadClassMetadata);
        if (static::$cacheDriver) {

            // Bind cache chekers
            $events[] = \Doctrine\ORM\Events::postPersist;
            $events[] = \Doctrine\ORM\Events::postUpdate;
            $events[] = \Doctrine\ORM\Events::postRemove;
        }

        static::$em->getEventManager()->addEventListener($events, $this);
    }

    // {{{ Export SQL to file

    /**
     * Export SQL dump from database to the specified file
     *
     * @param string  $path    File path or directory where SQL dump should be exported OPTIONAL
     * @param boolean $verbose Is export should be verbose flag OPTIONAL
     *
     * @return boolean
     */
    public function exportSQLToFile($path = null, $verbose = false)
    {
        $result = false;

        // Suppose that $path is var directory if it's null
        if (!$path) {
            $path = LC_DIR_VAR;
        }

        // Prepare file path
        $schemaFileName = is_dir($path)
            ? $path . LC_DS . 'schema.sql'
            : $path;

        try {
            $dsn = $this->getDSN();
            $dump = new \Rah\Danpu\Dump;
            $dump->file($schemaFileName)
                ->dsn($dsn['path'])
                ->user($dsn['user'])
                ->pass($dsn['password'])
                ->prefix($this->getTablePrefix())
                ->disableForeignKeyChecks(true)
                ->tmp(sys_get_temp_dir());

            new \Rah\Danpu\Export($dump);

            $result = true;

        } catch (\Exception $e) {
            \XLite\Logger::getInstance()->registerException($e);
        }

        return $result;
    }

    /**
     * Returns database schema as an array ('create_tables' => array(...), 'alter_table' => array(...))
     *
     * @param string $path Export directory path OPTIONAL
     *
     * @return array
     */
    public function getExportDBSchema($path = null)
    {
        $result = array();

        // Get database platform
        $platform = static::getEM()->getConnection()->getDatabasePlatform();

        // Get array of SQL queries which are described of DB schema
        $schema = $this->getDBSchema();

        // Separate schema to the different parts: drop-create and alter-table queries
        foreach ($schema as $row) {

            if (preg_match('/^ALTER TABLE .+ ADD (CONSTRAINT|FOREIGN KEY)/', $row)) {
                $result['alter_table'][] = $row;

            } else {
                $result['create_table'][] = $row;
            }
        }

        return $result;
    }

    /**
     * Returns array of database data
     *
     * @return array
     * @throws
     */
    public function getExportDBData()
    {
        $result = array();

        // Get X-Cart table names
        $tableNames = static::$em->getConnection()->getSchemaManager()->listTableNames();

        // Get connection to the database
        $dbConnection = static::$em->getConnection();

        // Begin transaction to avoid data inconsistency
        $dbConnection->beginTransaction();

        try {

            foreach ($tableNames as $tableName) {

                // Get full data from each table
                $statement = $dbConnection->query('SELECT * FROM ' . $tableName);
                $rows = $statement->fetchAll(\PDO::FETCH_NUM);
                $statement->closeCursor();
                $statement = null;

                $insertValues = array();

                // Prepare compact INSERT statements for data
                if (count($rows) > 0) {

                    foreach ($rows as $row) {
                        $insertValues[] = '(' . implode(',', array_map(array($this, 'doQuote'), $row)) . ')';
                    }

                    $result[] = 'INSERT INTO ' . $tableName . ' VALUES ' . implode(',', $insertValues);
                }
            }

        } catch(\PDOException $e) {
            // Throws an exceptiop if something wrong with transaction
            throw new \Exception($e);
        }

        $dbConnection->commit();

        return $result;
    }

    /**
     * Quote data gathered from database for writing to the file
     *
     * @param mixed $value Data of any type gathered from database
     *
     * @return string
     */
    public function doQuote($value)
    {
        // Array for replacements
        $search  = array("\x00", "\x0a", "\x0d", "\x1a");
        $replace = array('\0', '\n', '\r', '\Z');

        if (is_null($value)) {
            // Null must be presented as 'NULL' string
            $result = 'NULL';

        } elseif (is_string($value)) {
            // Do quoting string value
            $result = '\'' . str_replace($search, $replace, addslashes($value)) . '\'';

        } else {
            // Numeric values should not be quoted
            $result = $value;
        }

        return $result;
    }

    // }}}

    /**
     * Check - DB is empty or not
     *
     * @return boolean
     */
    public function isDBEmpty()
    {
        return 0 == count(static::$em->getConnection()->getSchemaManager()->listTableNames());
    }

    /**
     * Get DB schema mode
     *
     * @return string
     */
    public function getDBSchemaMode()
    {
        return $this->isDBEmpty() ? static::SCHEMA_CREATE : static::SCHEMA_UPDATE;
    }

    /**
     * Create / update DB schema
     *
     * @return integer
     */
    public function updateDBSchema()
    {
        return $this->executeQueries(
            $this->getDBSchema($this->isDBEmpty() ? static::SCHEMA_CREATE : static::SCHEMA_UPDATE)
        );
    }

    /**
     * Drop DB schema
     *
     * @return integer
     */
    public function dropDBSchema()
    {
        return $this->executeQueries($this->getDBSchema(static::SCHEMA_DELETE));
    }

    /**
     * Execute queries list
     *
     * @param array $queries Queries list
     *
     * @return integer
     */
    public function executeQueries(array $queries)
    {
        $i = 0;
        $connection = static::$em->getConnection();
        foreach ($queries as $sql) {
            $connection->executeQuery($sql);
            $i++;
        }

        return $i;
    }

    /**
     * Get DB schema as file
     *
     * @param string $mode Schema generation mode OPTIONAL
     *
     * @return string
     */
    public function getDBSchemaAsFile($mode = self::SCHEMA_CREATE)
    {
        return implode(';' . PHP_EOL, $this->getDBSchema($mode)) . ';' . PHP_EOL;
    }

    /**
     * Get DB schema
     *
     * @param string $mode Schema generation mode OPTIONAL
     *
     * @return array(string)
     */
    public function getDBSchema($mode = self::SCHEMA_CREATE)
    {
        $tool = new \Doctrine\ORM\Tools\SchemaTool(static::$em);
        $schemas = array();

        $rawSchemas = null;
        $postprocessMethod = null;

        if (static::SCHEMA_CREATE == $mode) {
            $rawSchemas = $tool->getCreateSchemaSql($this->getAllMetadata());
            $postprocessMethod = 'postprocessCreateSchema';

        } elseif (static::SCHEMA_UPDATE == $mode) {
            $rawSchemas = $tool->getUpdateSchemaSql($this->getAllMetadata());
            $postprocessMethod = 'postprocessUpdateSchema';

        } elseif (static::SCHEMA_DELETE == $mode) {
            $rawSchemas = $tool->getDropSchemaSql($this->getAllMetadata());
            $postprocessMethod = 'postprocessDropSchema';
        }

        if ($rawSchemas) {

            $rawSchemas = array_unique($rawSchemas);

            foreach ($rawSchemas as $schema) {

                // $postprocessMethod detected by $mode
                $schema = $this->$postprocessMethod($schema);

                if (is_array($schema)) {
                    $schemas = array_merge($schemas, $schema);

                } elseif (isset($schema) && $schema) {
                    $schemas[] = $schema;
                }
            }

            foreach (static::$em->getMetadataFactory()->getAllMetadata() as $cmd) {
                if (!$cmd->isMappedSuperclass) {
                    $schemas = static::getRepo($cmd->name)->processSchema($schemas, $mode);
                }
            }

            $schemas = array_map('trim', $schemas);
            $schemas = preg_grep('/^.+$/Ss', $schemas);
        }

        return $schemas;
    }

    /**
     * Get fixtures loading procedure option
     *
     * @param string $name Option name
     *
     * @return mixed
     */
    public function getFixturesLoadingOption($name)
    {
        return \Includes\Utils\ArrayManager::getIndex($this->fixturesLoadingOptions, $name, true);
    }

    /**
     * Set fixtures loading procedure option
     *
     * @param string $name  Option name
     * @param mixed  $value Option value OPTIONAL
     *
     * @return void
     */
    public function setFixturesLoadingOption($name, $value = null)
    {
        $this->fixturesLoadingOptions[$name] = $value;
    }

    /**
     * Load fixtures from YAML file
     *
     * @param string $path YAML file path
     *
     * @return void
     */
    public function loadFixturesFromYaml($path)
    {
        $data = \Symfony\Component\Yaml\Yaml::parse($path);

        if (is_array($data)) {
            foreach ($data as $entityName => $rows) {
                $repo = static::getRepo($entityName);

                if ($repo) {
                    $rows = $this->detectDirectives($rows);
                    $repo->loadFixtures($rows);

                    static::$em->flush();
                    static::$em->clear();

                    $this->resetDirectives();
                }
            }
        }
    }

    /**
     * Unload fixtures from YAML file
     *
     * @param string $path YAML file path
     *
     * @return boolean|integer
     */
    public function unloadFixturesFromYaml($path)
    {
        $data = \Symfony\Component\Yaml\Yaml::parse($path);

        $result = false;

        if (is_array($data)) {
            $result = 0;
            foreach ($data as $entityName => $rows) {
                $repo = static::getRepo($entityName);

                if ($repo) {
                    $rows = $this->detectDirectives($rows);

                    $result += $repo->unloadFixtures($rows);

                    static::$em->flush();
                    static::$em->clear();

                    $this->resetDirectives();
                }
            }
        }

        return $result;
    }

    /**
     * Get table prefix
     *
     * @return string
     */
    public function getTablePrefix()
    {
        return $this->tablePrefix;
    }

    /**
     * postPersist event handler
     *
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $arg Event argument
     *
     * @return void
     */
    public function postPersist(\Doctrine\ORM\Event\LifecycleEventArgs $arg)
    {
        $arg->getEntity()->checkCache();
    }

    /**
     * postUpdate event handler
     *
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $arg Event argument
     *
     * @return void
     */
    public function postUpdate(\Doctrine\ORM\Event\LifecycleEventArgs $arg)
    {
        $arg->getEntity()->checkCache();
    }

    /**
     * postRemove event handler
     *
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $arg Event argument
     *
     * @return void
     */
    public function postRemove(\Doctrine\ORM\Event\LifecycleEventArgs $arg)
    {
        $arg->getEntity()->checkCache();
    }

    /**
     * loadClassMetadata event handler
     *
     * @param \Doctrine\ORM\Event\LoadClassMetadataEventArgs $eventArgs Event arguments
     *
     * @return void
     */
    public function loadClassMetadata(\Doctrine\ORM\Event\LoadClassMetadataEventArgs $eventArgs)
    {
        $classMetadata = $eventArgs->getClassMetadata();

        // Set table name prefix
        if ($this->tablePrefix && strpos($classMetadata->getTableName(), $this->tablePrefix) !== 0) {
            $classMetadata->setTableName($this->tablePrefix . $classMetadata->getTableName());

            foreach ($classMetadata->associationMappings as &$mapping) {
                if (isset($mapping['joinTable']) && $mapping['joinTable']) {
                    if (strpos($mapping['joinTable']['name'], $this->tablePrefix) !== 0) {
                        $mapping['joinTable']['name'] = $this->tablePrefix . $mapping['joinTable']['name'];
                    }
                }
            }

        }
    }

    /**
     * Get structures which must not be removed (do not remove tables)
     *
     * @return array
     */
    public function getEnabledStructuresToStore()
    {
        return $this->getRegistryStructures(true);
    }

    /**
     * Get structures which must not be removed (do not remove tables and foreign keys)
     *
     * @return array
     */
    public function getDisabledStructuresToStore()
    {
        return $this->getRegistryStructures(false);
    }

    /**
     * Get Registry structures
     *
     * @param bool $enabled Flag: if true then get enabled modules structure otherwise disabled
     *
     * @return array
     */
    public function getRegistryStructures($enabled)
    {
        $tables = array();
        $columns = array();

        $path = $enabled
            ? $this->getEnabledStructuresPath()
            : $this->getDisabledStructuresPath();

        if (file_exists($path)) {

            $modules = \XLite\Core\Operator::getInstance()->loadServiceYAML($path);

            if (is_array($modules)) {

                foreach ($modules as $module => $list) {

                    if ($this->checkModuleState($module, $enabled)) {

                        if (isset($list['tables']) && is_array($list['tables'])) {
                            $tables = array_merge($tables, $list['tables']);
                        }

                        if (isset($list['columns']) && is_array($list['columns'])) {
                            $columns = array_merge_recursive($columns, $list['columns']);
                        }

                    } elseif (!$enabled) {
                        \Includes\Utils\ModulesManager::removeModuleFromDisabledStructure($module);
                    }
                }
            }
        }

        return array($tables, $columns);
    }

    /**
     * Return true if module state equals the specified state
     *
     * @param string  $module Module Author\Name
     * @param boolean $state  Module state to check
     *
     * @return boolean
     */
    protected function checkModuleState($module, $state)
    {
        $result = true;

        $moduleState = static::getRepo('XLite\Model\Module')->getModuleState($module);

        if (isset($moduleState)) {
            $result = ($state == $moduleState);
        }

        return $result;
    }

    /**
     * Set disabled tables list
     *
     * @param string $module     Module unique name
     * @param array  $structures Disabled structures OPTIONAL
     *
     * @return void
     */
    public function setDisabledStructures($module, array $structures = array())
    {
        $remove = !$structures || (!$structures['tables'] && !$structures['columns']);

        if ($remove) {
            \Includes\Utils\ModulesManager::removeModuleFromDisabledStructure($module);

        } else {

            if (!\Includes\Utils\ModulesManager::moveModuleToDisabledRegistry($module)) {

                $path = $this->getDisabledStructuresPath();

                $data = file_exists($path)
                    ? \XLite\Core\Operator::getInstance()->loadServiceYAML($path)
                    : array();

                  $data[$module] = $structures;

                \Includes\Utils\ModulesManager::storeModuleRegistry($path, $data);
            }
        }
    }

    /**
     * Register Module in the ENABLED module registry
     *
     * @param string $module Module unique name
     * @param array  $data   Registry info structures OPTIONAL
     *
     * @return void
     */
    public function registerModuleToEnabledRegistry($module, array $data = array())
    {
        \Includes\Utils\ModulesManager::registerModuleToEnabledRegistry($module, $data);
    }

    /**
     * Clean entities cache
     *
     * @return void
     */
    public function cleanEntitiesCache()
    {
        foreach (static::getEM()->getMetadataFactory()->getAllMetadata() as $metadata) {
            if (!$metadata->isMappedSuperclass) {
                static::getRepo($metadata->name)->cleanCache();
            }
        }
    }

    /**
     * Import SQL
     *
     * @param string $sql SQL
     *
     * @return integer Lines count
     */
    public function importSQL($sql)
    {
        $lines = 0;

        $conn = static::$em->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        do {
            // Required due to "MySQL has gone away!" issue
            $stmt->fetch();
            $stmt->closeCursor();

            $lines++;
        } while ($stmt->nextRowset());

        return $lines;
    }

    /**
     * Import SQL from file
     *
     * @param string  $path    File path
     * @param boolean $verbose Is import should be verbose flag OPTIONAL
     *
     * @return integer Lines count
     * @throws
     */
    public function importSQLFromFile($path, $verbose = false)
    {
        if (!file_exists($path)) {

            throw new \InvalidArgumentException(
                sprintf('SQL file \'%s\' does not exist.', $path)
            );

        } elseif (!is_readable($path)) {

            throw new \InvalidArgumentException(
                sprintf('SQL file \'%s\' does not have read permissions.', $path)
            );

        }

        return $this->importSQL(file_get_contents($path));
    }

    /**
     * Truncate data by repository type
     *
     * @param string $type Repository type
     *
     * @return integer
     */
    public function truncateByType($type)
    {
        return $this->truncate($this->getTruncateTableNames($type));
    }

    /**
     * Truncate all data
     *
     * @param array $tableNames Table names OPTIONAL
     *
     * @return integer
     */
    public function truncate(array $tableNames = array())
    {
        if (!$tableNames) {
            $tableNames = $this->detectTruncateTables($metadatas);
        }

        $sql = array();
        foreach ($tableNames as $tableName) {
            $sql[] = static::$em->getConnection()->getDatabasePlatform()->getTruncateTableSQL($tableName);
        }

        return $this->executeQueries($sql);
    }


    /**
     * Postprocess creation schema
     *
     * @param string $schema Schema
     *
     * @return string
     */
    protected function postprocessCreateSchema($schema)
    {
        if (preg_match('/^CREATE TABLE /Ss', $schema)) {
            $schema = $this->postprocessCreateSchemaTable($schema);

        } elseif (preg_match('/^ALTER TABLE /Ss', $schema)) {
            $schema = $this->postprocessAlterSchemaTable($schema);
        }

        return $schema;
    }

    /**
     * Postprocess table creation schema line
     *
     * @param string $schema Schema
     *
     * @return string
     */
    protected function postprocessCreateSchemaTable($schema)
    {
        preg_match('/CREATE TABLE (\S+) /Ss', $schema, $m);
        $tableName = $m[1];

        $schema = preg_replace_callback(
            '/CREATE TABLE (\S+) \((.+)(\) ENGINE = \w+)/Ss',
            function ($m) {
                return 'CREATE TABLE `' . $m[1] . '` (' . PHP_EOL
                    . $m[2] . PHP_EOL
                    . $m[3] . ' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci';
            },
            $schema
        );

        $schema = explode(PHP_EOL, $schema);

        $str = $schema[1];

        $str = preg_replace('/numeric\((\d+), (\d+)\)/Ssi', 'NUMERIC($1,$2)', $str);
        $str = preg_replace_callback(
            '/ index (\S+) \(([\w_, ]+)\)/Ssi',
            function ($m) {
                return ' INDEX ' . $m[1] . ' ('
                    . str_replace(', ', ',', $m[2]) . ')';
            },
            $str
        );

        $id = null;
        if (preg_match('/PRIMARY KEY *\(([^)]+)\)/Ssi', $str, $m)) {
            $id = trim($m[1]);
        }

        if ($id) {
            $str = preg_replace('/UNIQUE INDEX \S+ \(' . $id . '\),/Ssi', '', $str);
            $str = str_replace(PHP_EOL . PHP_EOL, PHP_EOL, $str);
        }

        $str = preg_replace('/PRIMARY KEY\(([^)]+)\)/Ssi', 'PRIMARY KEY ($1)', $str);

        $parts = array_map('trim', explode(', ', $str));
        foreach ($parts as $k => $v) {
            $v = preg_replace('/^((?:UNIQUE )?INDEX) (\S+) \(/Ss', '$1 `$2` (', $v);

            $v = preg_replace('/^(INDEX \S+ \()([^,)]+)/Ss', '$1`$2`', $v);
            $v = preg_replace('/^(INDEX \S+ \(.+,)([^`,)]+)/Ss', '$1`$2`', $v);

            $v = preg_replace('/^(PRIMARY KEY \()([^,\)]+)/Ss', '$1`$2`', $v);
            $v = preg_replace('/^(PRIMARY KEY \(.+,)([^`,\)]+)/Ss', '$1`$2`', $v);

            $v = static::SCHEMA_FILE_IDENT . preg_replace('/^([a-z][\w\d_]+) ([A-Z]+)/Ss', '`$1` $2', $v);

            $parts[$k] = $v;
        }

        $schema[1] = implode(',' . PHP_EOL, $parts);

        return array(
            'DROP TABLE IF EXISTS `' . $tableName . '`',
            implode(PHP_EOL, $schema),
        );
    }

    /**
     * Postprocess table altering schema line
     *
     * @param string $schema Schema
     *
     * @return string
     */
    protected function postprocessAlterSchemaTable($schema)
    {
        $schema = preg_replace('/ALTER TABLE (\S+) /USs', 'ALTER TABLE `$1` ', $schema);

        $schema = preg_replace('/( FOREIGN KEY \()([^,)]+)/Ss', '$1`$2`', $schema);
        $schema = preg_replace('/( FOREIGN KEY \(.+,)([^`,)]+)/Ss', '$1`$2`', $schema);

        $schema = preg_replace('/ REFERENCES (\S+) *\(([^,)]+)/Ss', ' REFERENCES `$1` (`$2`', $schema);
        $schema = preg_replace('/( REFERENCES \S+ \(.+,)([^`,)]+)/Ss', '$1`$2`', $schema);

        $schema = preg_replace('/ (DROP(?: FOREIGN KEY)?) ([a-z][^\s,`]+)(,)? /Ss', ' $1 `$2`$3 ', $schema);
        $schema = preg_replace('/ CHANGE ([a-z]\S+) (\S+) /Ss', ' CHANGE `$1` `$2` ', $schema);
        $schema = preg_replace('/ ADD ([a-z]\S+) /Ss', ' ADD `$1` ', $schema);

        $schema = preg_replace(
            '/(`\S+` ADD CONSTRAINT \w+ FOREIGN KEY \([^\)]+\) REFERENCES `\S+` \([^\)]+\)$\s*)$/Ss',
            '$1 ON DELETE CASCADE',
            $schema
        );

        // Fix AUTO_INCREMENT rename
        $schema = preg_replace('/^ALTER TABLE `\S+` DROP PRIMARY KEY$/Ss', '', $schema);
        $schema = preg_replace('/^ALTER TABLE `\S+` ADD PRIMARY KEY \(\S+\)$/Ss', '', $schema);
        $pattern = '/^ALTER TABLE (`\S+`).+ADD (`\S+`) ([^,`]+) AUTO_INCREMENT([^,`]*), DROP (`\S+`)/Ss';
        if (preg_match($pattern, $schema, $match)) {
            $schema = array(
                'ALTER TABLE ' . $match[1] . ' MODIFY ' . $match[5] . ' ' . $match[3],
                'ALTER TABLE ' . $match[1] . ' DROP PRIMARY KEY',
                preg_replace('/(ADD `\S+` [^,`]+ AUTO_INCREMENT[^,`]*)(, DROP `\S+`)/Ss', '$1 PRIMARY KEY$2', $schema),
            );
        }

        return $schema;
    }

    /**
     * Postprocess update schema
     *
     * @param string $schema Schema
     *
     * @return string
     */
    protected function postprocessUpdateSchema($schema)
    {
        if (preg_match('/^CREATE TABLE /Ss', $schema)) {
            $schema = $this->postprocessCreateSchemaTable($schema);

        } elseif (preg_match('/^ALTER TABLE /Ss', $schema)) {
            $schema = $this->postprocessAlterSchemaTable($schema);

        } elseif (preg_match('/DROP TABLE /Ss', $schema)) {

            $check = preg_match(
                '/^DROP TABLE ' . $this->tablePrefix . '(?:' . implode('|', $this->unmanagedTables) . ')$/Ss',
                $schema
            );

            if ($check) {
                $schema = null;

            } else {
                $schema = preg_replace('/^DROP TABLE (\S+)/Ss', 'DROP TABLE IF EXISTS `$1`', $schema);
            }

        } else {

            $schema = preg_replace('/^(CREATE (?:UNIQUE )?INDEX) (\S+) ON ([^\s(]+)/Ss', '$1 `$2` ON `$3`', $schema);
            $schema = preg_replace('/^(CREATE (?:UNIQUE )?INDEX [^(]+ \()([^,)]+)/Ss', '$1`$2`', $schema);
            $schema = preg_replace('/^(CREATE (?:UNIQUE )?INDEX [^(]+ \(.+, *)([^`,)]+)/Ss', '$1`$2`', $schema);

            $schema = preg_replace('/^DROP INDEX (\S+) ON (\S+)/Ss', 'DROP INDEX `$1` ON `$2`', $schema);

            $schema = preg_replace(
                '/^ALTER TABLE `?(\S+)`? DROP FOREIGN KEY `?(\S+)`?/Ss',
                'ALTER TABLE `$1` DROP FOREIGN KEY `$2`',
                $schema
            );
        }

        return $schema;
    }

    /**
     * Postprocess drop schema
     *
     * @param string $schema Schema
     *
     * @return string
     */
    protected function postprocessDropSchema($schema)
    {
        $schema = preg_replace(
            '/^ALTER TABLE `?(\S+)`? DROP FOREIGN KEY `?(\S+)`?/Ss',
            'ALTER TABLE `$1` DROP FOREIGN KEY `$2`',
            $schema
        );

        $schema = preg_replace(
            '/^DROP TABLE (\S+)/Ss',
            'DROP TABLE IF EXISTS `$1`',
            $schema
        );

        return $schema;
    }

    /**
     * Get all metadata
     *
     * @return array
     */
    protected function getAllMetadata()
    {
        $entities = array();
        foreach (static::$em->getMetadataFactory()->getAllMetadata() as $md) {
            if (!$md->isMappedSuperclass) {
                $entities[] = $md;
            }
        }

        return $entities;
    }

    /**
     * Detect fixtures loading directives
     *
     * @param array $rows Entity fixtures
     *
     * @return array
     */
    protected function detectDirectives(array $rows)
    {
        if (isset($rows['directives'])) {
            $this->fixturesLoadingOptions['insert'] = !empty($rows['directives']['insert']);

            if (isset($rows['directives']['addModel'])) {
                $this->fixturesLoadingOptions['addModel'] = $rows['directives']['addModel'];
            }

            if (isset($rows['directives']['addParent'])) {
                $this->fixturesLoadingOptions['addParent'] = (bool) $rows['directives']['addParent'];
            }

            unset($rows['directives']);
        }

        return $rows;
    }

    /**
     * Reset fixtures loading directives
     *
     * @return void
     */
    protected function resetDirectives()
    {
        $this->fixturesLoadingOptions['insert']    = false;
        $this->fixturesLoadingOptions['addModel']  = null;
        $this->fixturesLoadingOptions['addParent'] = true;
    }

    /**
     * Setup doctrine cache
     *
     * @return void
     */
    protected function setDoctrineCache()
    {
        static::$cacheDriver = new \XLite\Core\Cache();

        $driver = static::$cacheDriver->getDriver();
        $this->configuration->setMetadataCacheImpl($driver);
        $this->configuration->setQueryCacheImpl($driver);
        $this->configuration->setResultCacheImpl($driver);
    }

    /**
     * Get DSN in Doctrine style
     *
     * @return array
     */
    protected function getDSN()
    {
        $options = \XLite::getInstance()->getOptions('database_details');

        $dsnFields = array(
            'host'        => 'hostspec',
            'port'        => 'port',
            'unix_socket' => 'socket',
            'dbname'      => 'database',
        );
        $dsnList = array(
            'driver'       => 'pdo_mysql',
            'wrapperClass' => '\XLite\Core\Connection',
        );
        $dsnString = array();

        foreach ($dsnFields as $pdoOption => $lcOption) {

            if (!empty($options[$lcOption])) {
                $dsnList[$pdoOption] = $options[$lcOption];
                $dsnString[] = $pdoOption . '=' . $options[$lcOption];
            }
        }

        $dsnList['path'] = 'mysql:' . implode(';', $dsnString);
        $dsnList['user'] = $options['username'];
        $dsnList['password'] = $options['password'];
        $dsnList['charset'] = static::DB_CONNECTION_CHARSET;

        if ('pdo_mysql' == $dsnList['driver']) {
            $dsnList['driverClass'] = '\XLite\Core\PDOMySqlDriver';
        }

        return $dsnList;
    }

    /**
     * Get disabled tables list storage path
     *
     * @return string
     */
    protected function getDisabledStructuresPath()
    {
        return \Includes\Utils\ModulesManager::getDisabledStructuresPath();
    }

    /**
     * Get enabled tables list storage path
     *
     * @return string
     */
    protected function getEnabledStructuresPath()
    {
        return \Includes\Utils\ModulesManager::getEnabledStructurePath();
    }

    /**
     * Detect custom repository class name by entity class name
     *
     * @param string $class Entity class name
     *
     * @return string
     */
    protected function detectCustomRepositoryClassName($class)
    {
        $class = \Includes\Utils\Converter::getPureClassName($class);
        $class = \Includes\Utils\Converter::prepareClassName(str_replace('\Model\\', '\Model\Repo\\', $class), false);

        if (!\XLite\Core\Operator::isClassExists($class)) {
            $class = '\XLite\Model\Repo\Base\\' . (preg_match('/\wTranslation$/Ss', $class) ? 'Translation' : 'Common');

        } elseif (\Includes\Pattern\Factory::getClassHandler($class)->isAbstract()) {
            $class = null;
        }

        return $class;
    }

    /**
     * Get table names by type for truncate
     *
     * @param string $type Repository type
     *
     * @return array
     */
    protected function getTruncateTableNames($type)
    {
        $list = $this->detectTruncateTables($this->getTruncateMetadatas($type));

        if (\XLite\Model\Repo\ARepo::TYPE_STORE == $type) {

            $forbid = array();
            foreach ($this->forbidTruncateTablesStore as $n) {
                $forbid[] = $this->tablePrefix . $n;
            }

            $list = array_diff($list, $forbid);
        }

        return $list;
    }

    /**
     * Get class metadata by type for truncate
     *
     * @param string $type Repository type
     *
     * @return array
     */
    protected function getTruncateMetadatas($type)
    {
        $list = array();

        foreach ($this->getAllMetadata() as $cmd) {
            if (static::getRepo($cmd->name)->getRepoType() == $type) {
                $list[] = $cmd;
            }
        }

        return $list;
    }

    /**
     * Detect truncate table names by class metadatas
     *
     * @param array $metadatas Class metadata list
     *
     * @return array
     */
    protected function detectTruncateTables(array $metadatas)
    {
        $calc = new \Doctrine\ORM\Internal\CommitOrderCalculator;

        foreach ($metadatas as $class) {
            $calc->addClass($class);

            foreach ($class->associationMappings as $assoc) {
                if ($assoc['isOwningSide']) {
                    $targetClass = static::$em->getClassMetadata($assoc['targetEntity']);

                    if (!$calc->hasClass($targetClass->name)) {
                        $calc->addClass($targetClass);
                    }

                    // add dependency ($targetClass before $class)
                    $calc->addDependency($targetClass, $class);
                }
            }
        }

        $commitOrder = $calc->getCommitOrder();

        $associationTables = array();

        foreach ($commitOrder as $class) {
            foreach ($class->associationMappings as $assoc) {
                if ($assoc['isOwningSide'] && $assoc['type'] == \Doctrine\ORM\Mapping\ClassMetadata::MANY_TO_MANY) {
                    $associationTables[] = $assoc['joinTable']['name'];
                }
            }
        }

        $orderedTables = array_unique($associationTables);

        // Truncate tables in reverse commit order
        foreach (array_reverse($commitOrder) as $class) {
            if (
                (!$class->isInheritanceTypeSingleTable() || $class->name == $class->rootEntityName)
                && !$class->isMappedSuperclass
                && !in_array($class->getTableName(), $orderedTables)
            ) {
                $orderedTables[] = $class->getTableName();
            }
        }

        return $orderedTables;
    }

    /**
     * Set charset for DB connection
     *
     * @return void
     */
    protected function setCharset()
    {
        static::$em->getConnection()->setCharset(static::DB_CONNECTION_CHARSET);
    }

    /**
     * Create annotation driver
     *
     * @param string $path Path
     *
     * @return \Doctrine\ORM\Mapping\Driver\AnnotationDriver
     */
    protected function createAnnotationDriver($path)
    {
        return $this->configuration->newDefaultAnnotationDriver(array($path));
    }
}
