<?php

namespace Map;

use \CategoryOption;
use \CategoryOptionQuery;
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
 * This class defines the structure of the 'category_option' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CategoryOptionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.CategoryOptionTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'category_option';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\CategoryOption';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'CategoryOption';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'category_option.id';

    /**
     * the column name for the category_id field
     */
    const COL_CATEGORY_ID = 'category_option.category_id';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'category_option.description';

    /**
     * the column name for the comment field
     */
    const COL_COMMENT = 'category_option.comment';

    /**
     * the column name for the mod_comment field
     */
    const COL_MOD_COMMENT = 'category_option.mod_comment';

    /**
     * the column name for the value field
     */
    const COL_VALUE = 'category_option.value';

    /**
     * the column name for the sequence field
     */
    const COL_SEQUENCE = 'category_option.sequence';

    /**
     * the column name for the parent_id field
     */
    const COL_PARENT_ID = 'category_option.parent_id';

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
        self::TYPE_PHPNAME       => array('Id', 'CategoryId', 'Description', 'Comment', 'ModComment', 'Value', 'Sequence', 'ParentId', ),
        self::TYPE_CAMELNAME     => array('id', 'categoryId', 'description', 'comment', 'modComment', 'value', 'sequence', 'parentId', ),
        self::TYPE_COLNAME       => array(CategoryOptionTableMap::COL_ID, CategoryOptionTableMap::COL_CATEGORY_ID, CategoryOptionTableMap::COL_DESCRIPTION, CategoryOptionTableMap::COL_COMMENT, CategoryOptionTableMap::COL_MOD_COMMENT, CategoryOptionTableMap::COL_VALUE, CategoryOptionTableMap::COL_SEQUENCE, CategoryOptionTableMap::COL_PARENT_ID, ),
        self::TYPE_FIELDNAME     => array('id', 'category_id', 'description', 'comment', 'mod_comment', 'value', 'sequence', 'parent_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'CategoryId' => 1, 'Description' => 2, 'Comment' => 3, 'ModComment' => 4, 'Value' => 5, 'Sequence' => 6, 'ParentId' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'categoryId' => 1, 'description' => 2, 'comment' => 3, 'modComment' => 4, 'value' => 5, 'sequence' => 6, 'parentId' => 7, ),
        self::TYPE_COLNAME       => array(CategoryOptionTableMap::COL_ID => 0, CategoryOptionTableMap::COL_CATEGORY_ID => 1, CategoryOptionTableMap::COL_DESCRIPTION => 2, CategoryOptionTableMap::COL_COMMENT => 3, CategoryOptionTableMap::COL_MOD_COMMENT => 4, CategoryOptionTableMap::COL_VALUE => 5, CategoryOptionTableMap::COL_SEQUENCE => 6, CategoryOptionTableMap::COL_PARENT_ID => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'category_id' => 1, 'description' => 2, 'comment' => 3, 'mod_comment' => 4, 'value' => 5, 'sequence' => 6, 'parent_id' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('category_option');
        $this->setPhpName('CategoryOption');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\CategoryOption');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'BIGINT', true, null, null);
        $this->addForeignKey('category_id', 'CategoryId', 'BIGINT', 'category', 'ID', true, null, null);
        $this->addColumn('description', 'Description', 'CLOB', true, null, null);
        $this->addColumn('comment', 'Comment', 'CLOB', true, null, null);
        $this->addColumn('mod_comment', 'ModComment', 'LONGVARCHAR', true, null, null);
        $this->addColumn('value', 'Value', 'INTEGER', true, null, null);
        $this->addColumn('sequence', 'Sequence', 'INTEGER', true, null, null);
        $this->addForeignKey('parent_id', 'ParentId', 'BIGINT', 'category_option', 'id', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Category', '\\Category', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':category_id',
    1 => ':ID',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('CategoryOptionRelatedByParentId', '\\CategoryOption', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':parent_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('CategoryOptionRelatedById', '\\CategoryOption', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':parent_id',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'CategoryOptionsRelatedById', false);
        $this->addRelation('RatingValue', '\\RatingValue', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':category_option_id',
    1 => ':id',
  ),
), null, null, 'RatingValues', false);
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to category_option     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        CategoryOptionTableMap::clearInstancePool();
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
        return $withPrefix ? CategoryOptionTableMap::CLASS_DEFAULT : CategoryOptionTableMap::OM_CLASS;
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
     * @return array           (CategoryOption object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CategoryOptionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CategoryOptionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CategoryOptionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CategoryOptionTableMap::OM_CLASS;
            /** @var CategoryOption $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CategoryOptionTableMap::addInstanceToPool($obj, $key);
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
            $key = CategoryOptionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CategoryOptionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CategoryOption $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CategoryOptionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CategoryOptionTableMap::COL_ID);
            $criteria->addSelectColumn(CategoryOptionTableMap::COL_CATEGORY_ID);
            $criteria->addSelectColumn(CategoryOptionTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(CategoryOptionTableMap::COL_COMMENT);
            $criteria->addSelectColumn(CategoryOptionTableMap::COL_MOD_COMMENT);
            $criteria->addSelectColumn(CategoryOptionTableMap::COL_VALUE);
            $criteria->addSelectColumn(CategoryOptionTableMap::COL_SEQUENCE);
            $criteria->addSelectColumn(CategoryOptionTableMap::COL_PARENT_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.category_id');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.comment');
            $criteria->addSelectColumn($alias . '.mod_comment');
            $criteria->addSelectColumn($alias . '.value');
            $criteria->addSelectColumn($alias . '.sequence');
            $criteria->addSelectColumn($alias . '.parent_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(CategoryOptionTableMap::DATABASE_NAME)->getTable(CategoryOptionTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CategoryOptionTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CategoryOptionTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CategoryOptionTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CategoryOption or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CategoryOption object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryOptionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \CategoryOption) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CategoryOptionTableMap::DATABASE_NAME);
            $criteria->add(CategoryOptionTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CategoryOptionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CategoryOptionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CategoryOptionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the category_option table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CategoryOptionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CategoryOption or Criteria object.
     *
     * @param mixed               $criteria Criteria or CategoryOption object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryOptionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CategoryOption object
        }

        if ($criteria->containsKey(CategoryOptionTableMap::COL_ID) && $criteria->keyContainsValue(CategoryOptionTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CategoryOptionTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CategoryOptionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CategoryOptionTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CategoryOptionTableMap::buildTableMap();
