<?php

namespace Base;

use \Category as ChildCategory;
use \CategoryQuery as ChildCategoryQuery;
use \Exception;
use \PDO;
use Map\CategoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'category' table.
 *
 * 
 *
 * @method     ChildCategoryQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildCategoryQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildCategoryQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildCategoryQuery orderBySequence($order = Criteria::ASC) Order by the sequence column
 *
 * @method     ChildCategoryQuery groupById() Group by the ID column
 * @method     ChildCategoryQuery groupByTitle() Group by the title column
 * @method     ChildCategoryQuery groupByDescription() Group by the description column
 * @method     ChildCategoryQuery groupBySequence() Group by the sequence column
 *
 * @method     ChildCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCategoryQuery leftJoinCategoryOption($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryOption relation
 * @method     ChildCategoryQuery rightJoinCategoryOption($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryOption relation
 * @method     ChildCategoryQuery innerJoinCategoryOption($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryOption relation
 *
 * @method     ChildCategoryQuery leftJoinRatingValue($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingValue relation
 * @method     ChildCategoryQuery rightJoinRatingValue($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingValue relation
 * @method     ChildCategoryQuery innerJoinRatingValue($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingValue relation
 *
 * @method     \CategoryOptionQuery|\RatingValueQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCategory findOne(ConnectionInterface $con = null) Return the first ChildCategory matching the query
 * @method     ChildCategory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCategory matching the query, or a new ChildCategory object populated from the query conditions when no match is found
 *
 * @method     ChildCategory findOneById(string $ID) Return the first ChildCategory filtered by the ID column
 * @method     ChildCategory findOneByTitle(string $title) Return the first ChildCategory filtered by the title column
 * @method     ChildCategory findOneByDescription(string $description) Return the first ChildCategory filtered by the description column
 * @method     ChildCategory findOneBySequence(int $sequence) Return the first ChildCategory filtered by the sequence column *

 * @method     ChildCategory requirePk($key, ConnectionInterface $con = null) Return the ChildCategory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategory requireOne(ConnectionInterface $con = null) Return the first ChildCategory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategory requireOneById(string $ID) Return the first ChildCategory filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategory requireOneByTitle(string $title) Return the first ChildCategory filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategory requireOneByDescription(string $description) Return the first ChildCategory filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategory requireOneBySequence(int $sequence) Return the first ChildCategory filtered by the sequence column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCategory objects based on current ModelCriteria
 * @method     ChildCategory[]|ObjectCollection findById(string $ID) Return ChildCategory objects filtered by the ID column
 * @method     ChildCategory[]|ObjectCollection findByTitle(string $title) Return ChildCategory objects filtered by the title column
 * @method     ChildCategory[]|ObjectCollection findByDescription(string $description) Return ChildCategory objects filtered by the description column
 * @method     ChildCategory[]|ObjectCollection findBySequence(int $sequence) Return ChildCategory objects filtered by the sequence column
 * @method     ChildCategory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CategoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CategoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Category', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCategoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCategoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCategoryQuery) {
            return $criteria;
        }
        $query = new ChildCategoryQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCategory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CategoryTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CategoryTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, title, description, sequence FROM category WHERE ID = :p0';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCategory $obj */
            $obj = new ChildCategory();
            $obj->hydrate($row);
            CategoryTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildCategory|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CategoryTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CategoryTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ID column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE ID = 1234
     * $query->filterById(array(12, 34)); // WHERE ID IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE ID > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CategoryTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CategoryTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CategoryTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CategoryTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the sequence column
     *
     * Example usage:
     * <code>
     * $query->filterBySequence(1234); // WHERE sequence = 1234
     * $query->filterBySequence(array(12, 34)); // WHERE sequence IN (12, 34)
     * $query->filterBySequence(array('min' => 12)); // WHERE sequence > 12
     * </code>
     *
     * @param     mixed $sequence The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function filterBySequence($sequence = null, $comparison = null)
    {
        if (is_array($sequence)) {
            $useMinMax = false;
            if (isset($sequence['min'])) {
                $this->addUsingAlias(CategoryTableMap::COL_SEQUENCE, $sequence['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sequence['max'])) {
                $this->addUsingAlias(CategoryTableMap::COL_SEQUENCE, $sequence['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryTableMap::COL_SEQUENCE, $sequence, $comparison);
    }

    /**
     * Filter the query by a related \CategoryOption object
     *
     * @param \CategoryOption|ObjectCollection $categoryOption the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByCategoryOption($categoryOption, $comparison = null)
    {
        if ($categoryOption instanceof \CategoryOption) {
            return $this
                ->addUsingAlias(CategoryTableMap::COL_ID, $categoryOption->getCategoryId(), $comparison);
        } elseif ($categoryOption instanceof ObjectCollection) {
            return $this
                ->useCategoryOptionQuery()
                ->filterByPrimaryKeys($categoryOption->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCategoryOption() only accepts arguments of type \CategoryOption or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryOption relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function joinCategoryOption($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryOption');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'CategoryOption');
        }

        return $this;
    }

    /**
     * Use the CategoryOption relation CategoryOption object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CategoryOptionQuery A secondary query class using the current class as primary query
     */
    public function useCategoryOptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoryOption($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryOption', '\CategoryOptionQuery');
    }

    /**
     * Filter the query by a related \RatingValue object
     *
     * @param \RatingValue|ObjectCollection $ratingValue the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategoryQuery The current query, for fluid interface
     */
    public function filterByRatingValue($ratingValue, $comparison = null)
    {
        if ($ratingValue instanceof \RatingValue) {
            return $this
                ->addUsingAlias(CategoryTableMap::COL_ID, $ratingValue->getCategoryId(), $comparison);
        } elseif ($ratingValue instanceof ObjectCollection) {
            return $this
                ->useRatingValueQuery()
                ->filterByPrimaryKeys($ratingValue->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRatingValue() only accepts arguments of type \RatingValue or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RatingValue relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function joinRatingValue($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RatingValue');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'RatingValue');
        }

        return $this;
    }

    /**
     * Use the RatingValue relation RatingValue object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RatingValueQuery A secondary query class using the current class as primary query
     */
    public function useRatingValueQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRatingValue($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RatingValue', '\RatingValueQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCategory $category Object to remove from the list of results
     *
     * @return $this|ChildCategoryQuery The current query, for fluid interface
     */
    public function prune($category = null)
    {
        if ($category) {
            $this->addUsingAlias(CategoryTableMap::COL_ID, $category->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the category table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CategoryTableMap::clearInstancePool();
            CategoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CategoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            CategoryTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            CategoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CategoryQuery
