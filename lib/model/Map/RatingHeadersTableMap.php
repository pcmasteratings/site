<?php

namespace Map;

use \RatingHeaders;
use \RatingHeadersQuery;
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
 * This class defines the structure of the 'rating_headers' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class RatingHeadersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.RatingHeadersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'rating_headers';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\RatingHeaders';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'RatingHeaders';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    const COL_ID = 'rating_headers.id';

    /**
     * the column name for the game_id field
     */
    const COL_GAME_ID = 'rating_headers.game_id';

    /**
     * the column name for the user_id field
     */
    const COL_USER_ID = 'rating_headers.user_id';

    /**
     * the column name for the game_platform_id field
     */
    const COL_GAME_PLATFORM_ID = 'rating_headers.game_platform_id';

    /**
     * the column name for the rig_id field
     */
    const COL_RIG_ID = 'rating_headers.rig_id';

    /**
     * the column name for the created field
     */
    const COL_CREATED = 'rating_headers.created';

    /**
     * the column name for the upvotes field
     */
    const COL_UPVOTES = 'rating_headers.upvotes';

    /**
     * the column name for the downvotes field
     */
    const COL_DOWNVOTES = 'rating_headers.downvotes';

    /**
     * the column name for the comments field
     */
    const COL_COMMENTS = 'rating_headers.comments';

    /**
     * the column name for the score field
     */
    const COL_SCORE = 'rating_headers.score';

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
        self::TYPE_PHPNAME       => array('Id', 'GameId', 'UserId', 'GamePlatformId', 'RigId', 'Created', 'Upvotes', 'Downvotes', 'Comments', 'Score', ),
        self::TYPE_CAMELNAME     => array('id', 'gameId', 'userId', 'gamePlatformId', 'rigId', 'created', 'upvotes', 'downvotes', 'comments', 'score', ),
        self::TYPE_COLNAME       => array(RatingHeadersTableMap::COL_ID, RatingHeadersTableMap::COL_GAME_ID, RatingHeadersTableMap::COL_USER_ID, RatingHeadersTableMap::COL_GAME_PLATFORM_ID, RatingHeadersTableMap::COL_RIG_ID, RatingHeadersTableMap::COL_CREATED, RatingHeadersTableMap::COL_UPVOTES, RatingHeadersTableMap::COL_DOWNVOTES, RatingHeadersTableMap::COL_COMMENTS, RatingHeadersTableMap::COL_SCORE, ),
        self::TYPE_FIELDNAME     => array('id', 'game_id', 'user_id', 'game_platform_id', 'rig_id', 'created', 'upvotes', 'downvotes', 'comments', 'score', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'GameId' => 1, 'UserId' => 2, 'GamePlatformId' => 3, 'RigId' => 4, 'Created' => 5, 'Upvotes' => 6, 'Downvotes' => 7, 'Comments' => 8, 'Score' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'gameId' => 1, 'userId' => 2, 'gamePlatformId' => 3, 'rigId' => 4, 'created' => 5, 'upvotes' => 6, 'downvotes' => 7, 'comments' => 8, 'score' => 9, ),
        self::TYPE_COLNAME       => array(RatingHeadersTableMap::COL_ID => 0, RatingHeadersTableMap::COL_GAME_ID => 1, RatingHeadersTableMap::COL_USER_ID => 2, RatingHeadersTableMap::COL_GAME_PLATFORM_ID => 3, RatingHeadersTableMap::COL_RIG_ID => 4, RatingHeadersTableMap::COL_CREATED => 5, RatingHeadersTableMap::COL_UPVOTES => 6, RatingHeadersTableMap::COL_DOWNVOTES => 7, RatingHeadersTableMap::COL_COMMENTS => 8, RatingHeadersTableMap::COL_SCORE => 9, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'game_id' => 1, 'user_id' => 2, 'game_platform_id' => 3, 'rig_id' => 4, 'created' => 5, 'upvotes' => 6, 'downvotes' => 7, 'comments' => 8, 'score' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('rating_headers');
        $this->setPhpName('RatingHeaders');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\RatingHeaders');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'BIGINT', true, null, null);
        $this->addForeignKey('game_id', 'GameId', 'BIGINT', 'games', 'id', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'BIGINT', 'user', 'id', true, null, null);
        $this->addForeignKey('game_platform_id', 'GamePlatformId', 'BIGINT', 'game_platforms', 'id', true, null, null);
        $this->addForeignKey('rig_id', 'RigId', 'BIGINT', 'rigs', 'id', true, null, null);
        $this->addColumn('created', 'Created', 'TIMESTAMP', true, null, null);
        $this->addColumn('upvotes', 'Upvotes', 'BIGINT', true, null, null);
        $this->addColumn('downvotes', 'Downvotes', 'BIGINT', true, null, null);
        $this->addColumn('comments', 'Comments', 'CLOB', true, null, null);
        $this->addColumn('score', 'Score', 'INTEGER', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Games', '\\Games', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':game_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('User', '\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':user_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Rigs', '\\Rigs', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':rig_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('GamePlatforms', '\\GamePlatforms', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':game_platform_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('RatingCategoryValues', '\\RatingCategoryValues', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':rating_header_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'RatingCategoryValuess', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to rating_headers     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        RatingCategoryValuesTableMap::clearInstancePool();
    }

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
        return $withPrefix ? RatingHeadersTableMap::CLASS_DEFAULT : RatingHeadersTableMap::OM_CLASS;
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
     * @return array           (RatingHeaders object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = RatingHeadersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RatingHeadersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RatingHeadersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RatingHeadersTableMap::OM_CLASS;
            /** @var RatingHeaders $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RatingHeadersTableMap::addInstanceToPool($obj, $key);
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
            $key = RatingHeadersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RatingHeadersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var RatingHeaders $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RatingHeadersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RatingHeadersTableMap::COL_ID);
            $criteria->addSelectColumn(RatingHeadersTableMap::COL_GAME_ID);
            $criteria->addSelectColumn(RatingHeadersTableMap::COL_USER_ID);
            $criteria->addSelectColumn(RatingHeadersTableMap::COL_GAME_PLATFORM_ID);
            $criteria->addSelectColumn(RatingHeadersTableMap::COL_RIG_ID);
            $criteria->addSelectColumn(RatingHeadersTableMap::COL_CREATED);
            $criteria->addSelectColumn(RatingHeadersTableMap::COL_UPVOTES);
            $criteria->addSelectColumn(RatingHeadersTableMap::COL_DOWNVOTES);
            $criteria->addSelectColumn(RatingHeadersTableMap::COL_COMMENTS);
            $criteria->addSelectColumn(RatingHeadersTableMap::COL_SCORE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.game_id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.game_platform_id');
            $criteria->addSelectColumn($alias . '.rig_id');
            $criteria->addSelectColumn($alias . '.created');
            $criteria->addSelectColumn($alias . '.upvotes');
            $criteria->addSelectColumn($alias . '.downvotes');
            $criteria->addSelectColumn($alias . '.comments');
            $criteria->addSelectColumn($alias . '.score');
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
        return Propel::getServiceContainer()->getDatabaseMap(RatingHeadersTableMap::DATABASE_NAME)->getTable(RatingHeadersTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(RatingHeadersTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(RatingHeadersTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new RatingHeadersTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a RatingHeaders or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or RatingHeaders object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RatingHeadersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \RatingHeaders) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RatingHeadersTableMap::DATABASE_NAME);
            $criteria->add(RatingHeadersTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = RatingHeadersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RatingHeadersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RatingHeadersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the rating_headers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return RatingHeadersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a RatingHeaders or Criteria object.
     *
     * @param mixed               $criteria Criteria or RatingHeaders object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RatingHeadersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from RatingHeaders object
        }

        if ($criteria->containsKey(RatingHeadersTableMap::COL_ID) && $criteria->keyContainsValue(RatingHeadersTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RatingHeadersTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = RatingHeadersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // RatingHeadersTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
RatingHeadersTableMap::buildTableMap();
