<?php

namespace Map;

use \Game;
use \GameQuery;
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
 * This class defines the structure of the 'game' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class GameTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.GameTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'game';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Game';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Game';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id field
     */
    const COL_ID = 'game.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'game.name';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'game.title';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'game.description';

    /**
     * the column name for the publisher_id field
     */
    const COL_PUBLISHER_ID = 'game.publisher_id';

    /**
     * the column name for the developer_id field
     */
    const COL_DEVELOPER_ID = 'game.developer_id';

    /**
     * the column name for the gb_id field
     */
    const COL_GB_ID = 'game.gb_id';

    /**
     * the column name for the gb_url field
     */
    const COL_GB_URL = 'game.gb_url';

    /**
     * the column name for the gb_image field
     */
    const COL_GB_IMAGE = 'game.gb_image';

    /**
     * the column name for the gb_thumb field
     */
    const COL_GB_THUMB = 'game.gb_thumb';

    /**
     * the column name for the admin_lock field
     */
    const COL_ADMIN_LOCK = 'game.admin_lock';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Title', 'Description', 'PublisherId', 'DeveloperId', 'GbId', 'GbUrl', 'GbImage', 'GbThumb', 'AdminLock', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'title', 'description', 'publisherId', 'developerId', 'gbId', 'gbUrl', 'gbImage', 'gbThumb', 'adminLock', ),
        self::TYPE_COLNAME       => array(GameTableMap::COL_ID, GameTableMap::COL_NAME, GameTableMap::COL_TITLE, GameTableMap::COL_DESCRIPTION, GameTableMap::COL_PUBLISHER_ID, GameTableMap::COL_DEVELOPER_ID, GameTableMap::COL_GB_ID, GameTableMap::COL_GB_URL, GameTableMap::COL_GB_IMAGE, GameTableMap::COL_GB_THUMB, GameTableMap::COL_ADMIN_LOCK, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'title', 'description', 'publisher_id', 'developer_id', 'gb_id', 'gb_url', 'gb_image', 'gb_thumb', 'admin_lock', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Title' => 2, 'Description' => 3, 'PublisherId' => 4, 'DeveloperId' => 5, 'GbId' => 6, 'GbUrl' => 7, 'GbImage' => 8, 'GbThumb' => 9, 'AdminLock' => 10, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'title' => 2, 'description' => 3, 'publisherId' => 4, 'developerId' => 5, 'gbId' => 6, 'gbUrl' => 7, 'gbImage' => 8, 'gbThumb' => 9, 'adminLock' => 10, ),
        self::TYPE_COLNAME       => array(GameTableMap::COL_ID => 0, GameTableMap::COL_NAME => 1, GameTableMap::COL_TITLE => 2, GameTableMap::COL_DESCRIPTION => 3, GameTableMap::COL_PUBLISHER_ID => 4, GameTableMap::COL_DEVELOPER_ID => 5, GameTableMap::COL_GB_ID => 6, GameTableMap::COL_GB_URL => 7, GameTableMap::COL_GB_IMAGE => 8, GameTableMap::COL_GB_THUMB => 9, GameTableMap::COL_ADMIN_LOCK => 10, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'title' => 2, 'description' => 3, 'publisher_id' => 4, 'developer_id' => 5, 'gb_id' => 6, 'gb_url' => 7, 'gb_image' => 8, 'gb_thumb' => 9, 'admin_lock' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
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
        $this->setName('game');
        $this->setPhpName('Game');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Game');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'BIGINT', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('title', 'Title', 'CLOB', true, null, null);
        $this->addColumn('description', 'Description', 'CLOB', true, null, null);
        $this->addForeignKey('publisher_id', 'PublisherId', 'BIGINT', 'company', 'id', false, null, null);
        $this->addForeignKey('developer_id', 'DeveloperId', 'BIGINT', 'company', 'id', false, null, null);
        $this->addColumn('gb_id', 'GbId', 'BIGINT', true, null, null);
        $this->addColumn('gb_url', 'GbUrl', 'LONGVARCHAR', true, null, null);
        $this->addColumn('gb_image', 'GbImage', 'LONGVARCHAR', true, null, null);
        $this->addColumn('gb_thumb', 'GbThumb', 'LONGVARCHAR', true, null, null);
        $this->addColumn('admin_lock', 'AdminLock', 'BOOLEAN', true, 1, false);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('CompanyRelatedByPublisherId', '\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':publisher_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('CompanyRelatedByDeveloperId', '\\Company', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':developer_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('GameLink', '\\GameLink', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':game_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'GameLinks', false);
        $this->addRelation('GamePlatform', '\\GamePlatform', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':game_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'GamePlatforms', false);
        $this->addRelation('RatingHeader', '\\RatingHeader', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':game_id',
    1 => ':id',
  ),
), null, null, 'RatingHeaders', false);
        $this->addRelation('UserReview', '\\UserReview', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':game_id',
    1 => ':id',
  ),
), null, null, 'UserReviews', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to game     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        GameLinkTableMap::clearInstancePool();
        GamePlatformTableMap::clearInstancePool();
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
        return $withPrefix ? GameTableMap::CLASS_DEFAULT : GameTableMap::OM_CLASS;
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
     * @return array           (Game object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = GameTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = GameTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + GameTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = GameTableMap::OM_CLASS;
            /** @var Game $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            GameTableMap::addInstanceToPool($obj, $key);
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
            $key = GameTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = GameTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Game $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                GameTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(GameTableMap::COL_ID);
            $criteria->addSelectColumn(GameTableMap::COL_NAME);
            $criteria->addSelectColumn(GameTableMap::COL_TITLE);
            $criteria->addSelectColumn(GameTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(GameTableMap::COL_PUBLISHER_ID);
            $criteria->addSelectColumn(GameTableMap::COL_DEVELOPER_ID);
            $criteria->addSelectColumn(GameTableMap::COL_GB_ID);
            $criteria->addSelectColumn(GameTableMap::COL_GB_URL);
            $criteria->addSelectColumn(GameTableMap::COL_GB_IMAGE);
            $criteria->addSelectColumn(GameTableMap::COL_GB_THUMB);
            $criteria->addSelectColumn(GameTableMap::COL_ADMIN_LOCK);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.publisher_id');
            $criteria->addSelectColumn($alias . '.developer_id');
            $criteria->addSelectColumn($alias . '.gb_id');
            $criteria->addSelectColumn($alias . '.gb_url');
            $criteria->addSelectColumn($alias . '.gb_image');
            $criteria->addSelectColumn($alias . '.gb_thumb');
            $criteria->addSelectColumn($alias . '.admin_lock');
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
        return Propel::getServiceContainer()->getDatabaseMap(GameTableMap::DATABASE_NAME)->getTable(GameTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(GameTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(GameTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new GameTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Game or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Game object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(GameTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Game) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(GameTableMap::DATABASE_NAME);
            $criteria->add(GameTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = GameQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            GameTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                GameTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the game table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return GameQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Game or Criteria object.
     *
     * @param mixed               $criteria Criteria or Game object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GameTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Game object
        }

        if ($criteria->containsKey(GameTableMap::COL_ID) && $criteria->keyContainsValue(GameTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.GameTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = GameQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // GameTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
GameTableMap::buildTableMap();
