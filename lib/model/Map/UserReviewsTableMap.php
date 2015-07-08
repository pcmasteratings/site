<?php

namespace Map;

use \UserReviews;
use \UserReviewsQuery;
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
 * This class defines the structure of the 'user_reviews' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UserReviewsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.UserReviewsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'user_reviews';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\UserReviews';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'UserReviews';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id field
     */
    const COL_ID = 'user_reviews.id';

    /**
     * the column name for the game_id field
     */
    const COL_GAME_ID = 'user_reviews.game_id';

    /**
     * the column name for the platform_id field
     */
    const COL_PLATFORM_ID = 'user_reviews.platform_id';

    /**
     * the column name for the user_id field
     */
    const COL_USER_ID = 'user_reviews.user_id';

    /**
     * the column name for the rig_id field
     */
    const COL_RIG_ID = 'user_reviews.rig_id';

    /**
     * the column name for the rating field
     */
    const COL_RATING = 'user_reviews.rating';

    /**
     * the column name for the review field
     */
    const COL_REVIEW = 'user_reviews.review';

    /**
     * the column name for the upvotes field
     */
    const COL_UPVOTES = 'user_reviews.upvotes';

    /**
     * the column name for the downvotes field
     */
    const COL_DOWNVOTES = 'user_reviews.downvotes';

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
        self::TYPE_PHPNAME       => array('Id', 'GameId', 'PlatformId', 'UserId', 'RigId', 'Rating', 'Review', 'Upvotes', 'Downvotes', ),
        self::TYPE_CAMELNAME     => array('id', 'gameId', 'platformId', 'userId', 'rigId', 'rating', 'review', 'upvotes', 'downvotes', ),
        self::TYPE_COLNAME       => array(UserReviewsTableMap::COL_ID, UserReviewsTableMap::COL_GAME_ID, UserReviewsTableMap::COL_PLATFORM_ID, UserReviewsTableMap::COL_USER_ID, UserReviewsTableMap::COL_RIG_ID, UserReviewsTableMap::COL_RATING, UserReviewsTableMap::COL_REVIEW, UserReviewsTableMap::COL_UPVOTES, UserReviewsTableMap::COL_DOWNVOTES, ),
        self::TYPE_FIELDNAME     => array('id', 'game_id', 'platform_id', 'user_id', 'rig_id', 'rating', 'review', 'upvotes', 'downvotes', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'GameId' => 1, 'PlatformId' => 2, 'UserId' => 3, 'RigId' => 4, 'Rating' => 5, 'Review' => 6, 'Upvotes' => 7, 'Downvotes' => 8, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'gameId' => 1, 'platformId' => 2, 'userId' => 3, 'rigId' => 4, 'rating' => 5, 'review' => 6, 'upvotes' => 7, 'downvotes' => 8, ),
        self::TYPE_COLNAME       => array(UserReviewsTableMap::COL_ID => 0, UserReviewsTableMap::COL_GAME_ID => 1, UserReviewsTableMap::COL_PLATFORM_ID => 2, UserReviewsTableMap::COL_USER_ID => 3, UserReviewsTableMap::COL_RIG_ID => 4, UserReviewsTableMap::COL_RATING => 5, UserReviewsTableMap::COL_REVIEW => 6, UserReviewsTableMap::COL_UPVOTES => 7, UserReviewsTableMap::COL_DOWNVOTES => 8, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'game_id' => 1, 'platform_id' => 2, 'user_id' => 3, 'rig_id' => 4, 'rating' => 5, 'review' => 6, 'upvotes' => 7, 'downvotes' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
        $this->setName('user_reviews');
        $this->setPhpName('UserReviews');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\UserReviews');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'BIGINT', true, null, null);
        $this->addForeignKey('game_id', 'GameId', 'BIGINT', 'games', 'id', true, null, null);
        $this->addForeignKey('platform_id', 'PlatformId', 'BIGINT', 'platforms', 'id', true, null, null);
        $this->addForeignKey('user_id', 'UserId', 'BIGINT', 'user', 'id', true, null, null);
        $this->addColumn('rig_id', 'RigId', 'BIGINT', true, null, null);
        $this->addForeignKey('rating', 'Rating', 'BIGINT', 'ratings', 'id', true, null, null);
        $this->addColumn('review', 'Review', 'CLOB', true, null, null);
        $this->addColumn('upvotes', 'Upvotes', 'BIGINT', true, null, null);
        $this->addColumn('downvotes', 'Downvotes', 'BIGINT', true, null, null);
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
        $this->addRelation('Platforms', '\\Platforms', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':platform_id',
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
        $this->addRelation('Ratings', '\\Ratings', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':rating',
    1 => ':id',
  ),
), null, null, null, false);
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
        return $withPrefix ? UserReviewsTableMap::CLASS_DEFAULT : UserReviewsTableMap::OM_CLASS;
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
     * @return array           (UserReviews object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UserReviewsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserReviewsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserReviewsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserReviewsTableMap::OM_CLASS;
            /** @var UserReviews $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserReviewsTableMap::addInstanceToPool($obj, $key);
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
            $key = UserReviewsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserReviewsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UserReviews $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserReviewsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UserReviewsTableMap::COL_ID);
            $criteria->addSelectColumn(UserReviewsTableMap::COL_GAME_ID);
            $criteria->addSelectColumn(UserReviewsTableMap::COL_PLATFORM_ID);
            $criteria->addSelectColumn(UserReviewsTableMap::COL_USER_ID);
            $criteria->addSelectColumn(UserReviewsTableMap::COL_RIG_ID);
            $criteria->addSelectColumn(UserReviewsTableMap::COL_RATING);
            $criteria->addSelectColumn(UserReviewsTableMap::COL_REVIEW);
            $criteria->addSelectColumn(UserReviewsTableMap::COL_UPVOTES);
            $criteria->addSelectColumn(UserReviewsTableMap::COL_DOWNVOTES);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.game_id');
            $criteria->addSelectColumn($alias . '.platform_id');
            $criteria->addSelectColumn($alias . '.user_id');
            $criteria->addSelectColumn($alias . '.rig_id');
            $criteria->addSelectColumn($alias . '.rating');
            $criteria->addSelectColumn($alias . '.review');
            $criteria->addSelectColumn($alias . '.upvotes');
            $criteria->addSelectColumn($alias . '.downvotes');
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
        return Propel::getServiceContainer()->getDatabaseMap(UserReviewsTableMap::DATABASE_NAME)->getTable(UserReviewsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UserReviewsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UserReviewsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UserReviewsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a UserReviews or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or UserReviews object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserReviewsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \UserReviews) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserReviewsTableMap::DATABASE_NAME);
            $criteria->add(UserReviewsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UserReviewsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserReviewsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserReviewsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the user_reviews table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UserReviewsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UserReviews or Criteria object.
     *
     * @param mixed               $criteria Criteria or UserReviews object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserReviewsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UserReviews object
        }

        if ($criteria->containsKey(UserReviewsTableMap::COL_ID) && $criteria->keyContainsValue(UserReviewsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserReviewsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UserReviewsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UserReviewsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UserReviewsTableMap::buildTableMap();
