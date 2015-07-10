<?php

namespace Map;

use \ContestQueue;
use \ContestQueueQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'contest_queue' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ContestQueueTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ContestQueueTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'contest_queue';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ContestQueue';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ContestQueue';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id field
     */
    const COL_ID = 'contest_queue.id';

    /**
     * the column name for the user_id field
     */
    const COL_USER_ID = 'contest_queue.user_id';

    /**
     * the column name for the game_id field
     */
    const COL_GAME_ID = 'contest_queue.game_id';

    /**
     * the column name for the platform_id field
     */
    const COL_PLATFORM_ID = 'contest_queue.platform_id';

    /**
     * the column name for the message field
     */
    const COL_MESSAGE = 'contest_queue.message';

    /**
     * the column name for the resolved field
     */
    const COL_RESOLVED = 'contest_queue.resolved';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'UserId', 'GameId', 'PlatformId', 'Message', 'Resolved', ),
        self::TYPE_CAMELNAME     => array('id', 'userId', 'gameId', 'platformId', 'message', 'resolved', ),
        self::TYPE_COLNAME       => array(ContestQueueTableMap::COL_ID, ContestQueueTableMap::COL_USER_ID, ContestQueueTableMap::COL_GAME_ID, ContestQueueTableMap::COL_PLATFORM_ID, ContestQueueTableMap::COL_MESSAGE, ContestQueueTableMap::COL_RESOLVED, ),
        self::TYPE_FIELDNAME     => array('id', 'user_id', 'game_id', 'platform_id', 'message', 'resolved', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'UserId' => 1, 'GameId' => 2, 'PlatformId' => 3, 'Message' => 4, 'Resolved' => 5, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'userId' => 1, 'gameId' => 2, 'platformId' => 3, 'message' => 4, 'resolved' => 5, ),
        self::TYPE_COLNAME       => array(ContestQueueTableMap::COL_ID => 0, ContestQueueTableMap::COL_USER_ID => 1, ContestQueueTableMap::COL_GAME_ID => 2, ContestQueueTableMap::COL_PLATFORM_ID => 3, ContestQueueTableMap::COL_MESSAGE => 4, ContestQueueTableMap::COL_RESOLVED => 5, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'user_id' => 1, 'game_id' => 2, 'platform_id' => 3, 'message' => 4, 'resolved' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('contest_queue');
        $this->setPhpName('ContestQueue');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ContestQueue');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'BIGINT', true, null, null);
        $this->addColumn('user_id', 'UserId', 'BIGINT', true, null, null);
        $this->addColumn('game_id', 'GameId', 'BIGINT', true, null, null);
        $this->addColumn('platform_id', 'PlatformId', 'BIGINT', true, null, null);
        $this->addColumn('message', 'Message', 'CLOB', true, null, null);
        $this->addColumn('resolved', 'Resolved', 'BOOLEAN', true, 1, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }
    
    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ContestQueueTableMap::CLASS_DEFAULT : ContestQueueTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (ContestQueue object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ContestQueueTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ContestQueueTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ContestQueueTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ContestQueueTableMap::OM_CLASS;
            /** @var ContestQueue $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ContestQueueTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();
    
        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ContestQueueTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ContestQueueTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ContestQueue $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ContestQueueTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ContestQueueTableMap::COL_ID);
            $criteria->addSelectColumn(ContestQueueTableMap::COL_USER_ID);
            $criteria->addSelectColumn(ContestQueueTableMap::COL_GAME_ID);
            $criteria->addSelectColumn(ContestQueueTableMap::COL_PLATFORM_ID);
            $criteria->addSelectColumn(ContestQueueTableMap::COL_MESSAGE);
            $criteria->addSelectColumn(ContestQueueTableMap::COL_RESOLVED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.game_id');
            $criteria->addSelectColumn($alias . '.platform_id');
            $criteria->addSelectColumn($alias . '.message');
            $criteria->addSelectColumn($alias . '.resolved');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ContestQueueTableMap::DATABASE_NAME)->getTable(ContestQueueTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ContestQueueTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ContestQueueTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ContestQueueTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a ContestQueue or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ContestQueue object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContestQueueTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ContestQueue) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ContestQueueTableMap::DATABASE_NAME);
            $criteria->add(ContestQueueTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ContestQueueQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ContestQueueTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ContestQueueTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the contest_queue table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ContestQueueQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ContestQueue or Criteria object.
     *
     * @param mixed               $criteria Criteria or ContestQueue object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContestQueueTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ContestQueue object
        }

        if ($criteria->containsKey(ContestQueueTableMap::COL_ID) && $criteria->keyContainsValue(ContestQueueTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ContestQueueTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ContestQueueQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ContestQueueTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ContestQueueTableMap::buildTableMap();
