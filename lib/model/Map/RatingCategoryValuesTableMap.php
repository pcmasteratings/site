<?php

namespace Map;

use \RatingCategoryValues;
use \RatingCategoryValuesQuery;
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
 * This class defines the structure of the 'rating_category_values' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class RatingCategoryValuesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.RatingCategoryValuesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'rating_category_values';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\RatingCategoryValues';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'RatingCategoryValues';

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
    const COL_ID = 'rating_category_values.id';

    /**
     * the column name for the rating_header_id field
     */
    const COL_RATING_HEADER_ID = 'rating_category_values.rating_header_id';

    /**
     * the column name for the rating_category_id field
     */
    const COL_RATING_CATEGORY_ID = 'rating_category_values.rating_category_id';

    /**
     * the column name for the rating_catgory_option_id field
     */
    const COL_RATING_CATGORY_OPTION_ID = 'rating_category_values.rating_catgory_option_id';

    /**
     * the column name for the original_value field
     */
    const COL_ORIGINAL_VALUE = 'rating_category_values.original_value';

    /**
     * the column name for the comments field
     */
    const COL_COMMENTS = 'rating_category_values.comments';

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
        self::TYPE_PHPNAME       => array('Id', 'RatingHeaderId', 'RatingCategoryId', 'RatingCatgoryOptionId', 'OriginalValue', 'Comments', ),
        self::TYPE_CAMELNAME     => array('id', 'ratingHeaderId', 'ratingCategoryId', 'ratingCatgoryOptionId', 'originalValue', 'comments', ),
        self::TYPE_COLNAME       => array(RatingCategoryValuesTableMap::COL_ID, RatingCategoryValuesTableMap::COL_RATING_HEADER_ID, RatingCategoryValuesTableMap::COL_RATING_CATEGORY_ID, RatingCategoryValuesTableMap::COL_RATING_CATGORY_OPTION_ID, RatingCategoryValuesTableMap::COL_ORIGINAL_VALUE, RatingCategoryValuesTableMap::COL_COMMENTS, ),
        self::TYPE_FIELDNAME     => array('id', 'rating_header_id', 'rating_category_id', 'rating_catgory_option_id', 'original_value', 'comments', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'RatingHeaderId' => 1, 'RatingCategoryId' => 2, 'RatingCatgoryOptionId' => 3, 'OriginalValue' => 4, 'Comments' => 5, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'ratingHeaderId' => 1, 'ratingCategoryId' => 2, 'ratingCatgoryOptionId' => 3, 'originalValue' => 4, 'comments' => 5, ),
        self::TYPE_COLNAME       => array(RatingCategoryValuesTableMap::COL_ID => 0, RatingCategoryValuesTableMap::COL_RATING_HEADER_ID => 1, RatingCategoryValuesTableMap::COL_RATING_CATEGORY_ID => 2, RatingCategoryValuesTableMap::COL_RATING_CATGORY_OPTION_ID => 3, RatingCategoryValuesTableMap::COL_ORIGINAL_VALUE => 4, RatingCategoryValuesTableMap::COL_COMMENTS => 5, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'rating_header_id' => 1, 'rating_category_id' => 2, 'rating_catgory_option_id' => 3, 'original_value' => 4, 'comments' => 5, ),
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
        $this->setName('rating_category_values');
        $this->setPhpName('RatingCategoryValues');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\RatingCategoryValues');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'BIGINT', true, null, null);
        $this->addForeignKey('rating_header_id', 'RatingHeaderId', 'BIGINT', 'rating_headers', 'id', true, null, null);
        $this->addForeignKey('rating_category_id', 'RatingCategoryId', 'BIGINT', 'rating_categories', 'ID', true, null, null);
        $this->addForeignKey('rating_catgory_option_id', 'RatingCatgoryOptionId', 'BIGINT', 'rating_category_options', 'id', true, null, null);
        $this->addColumn('original_value', 'OriginalValue', 'INTEGER', true, null, null);
        $this->addColumn('comments', 'Comments', 'LONGVARCHAR', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('RatingHeaders', '\\RatingHeaders', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':rating_header_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('RatingCategories', '\\RatingCategories', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':rating_category_id',
    1 => ':ID',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('RatingCategoryOptions', '\\RatingCategoryOptions', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':rating_catgory_option_id',
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
        return $withPrefix ? RatingCategoryValuesTableMap::CLASS_DEFAULT : RatingCategoryValuesTableMap::OM_CLASS;
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
     * @return array           (RatingCategoryValues object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = RatingCategoryValuesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RatingCategoryValuesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RatingCategoryValuesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RatingCategoryValuesTableMap::OM_CLASS;
            /** @var RatingCategoryValues $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RatingCategoryValuesTableMap::addInstanceToPool($obj, $key);
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
            $key = RatingCategoryValuesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RatingCategoryValuesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var RatingCategoryValues $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RatingCategoryValuesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RatingCategoryValuesTableMap::COL_ID);
            $criteria->addSelectColumn(RatingCategoryValuesTableMap::COL_RATING_HEADER_ID);
            $criteria->addSelectColumn(RatingCategoryValuesTableMap::COL_RATING_CATEGORY_ID);
            $criteria->addSelectColumn(RatingCategoryValuesTableMap::COL_RATING_CATGORY_OPTION_ID);
            $criteria->addSelectColumn(RatingCategoryValuesTableMap::COL_ORIGINAL_VALUE);
            $criteria->addSelectColumn(RatingCategoryValuesTableMap::COL_COMMENTS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.rating_header_id');
            $criteria->addSelectColumn($alias . '.rating_category_id');
            $criteria->addSelectColumn($alias . '.rating_catgory_option_id');
            $criteria->addSelectColumn($alias . '.original_value');
            $criteria->addSelectColumn($alias . '.comments');
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
        return Propel::getServiceContainer()->getDatabaseMap(RatingCategoryValuesTableMap::DATABASE_NAME)->getTable(RatingCategoryValuesTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(RatingCategoryValuesTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(RatingCategoryValuesTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new RatingCategoryValuesTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a RatingCategoryValues or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or RatingCategoryValues object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RatingCategoryValuesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \RatingCategoryValues) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RatingCategoryValuesTableMap::DATABASE_NAME);
            $criteria->add(RatingCategoryValuesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = RatingCategoryValuesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RatingCategoryValuesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RatingCategoryValuesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the rating_category_values table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return RatingCategoryValuesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a RatingCategoryValues or Criteria object.
     *
     * @param mixed               $criteria Criteria or RatingCategoryValues object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RatingCategoryValuesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from RatingCategoryValues object
        }

        if ($criteria->containsKey(RatingCategoryValuesTableMap::COL_ID) && $criteria->keyContainsValue(RatingCategoryValuesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RatingCategoryValuesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = RatingCategoryValuesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // RatingCategoryValuesTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
RatingCategoryValuesTableMap::buildTableMap();
