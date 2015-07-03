<?php

namespace Base;

use \RatingCategoryOptions as ChildRatingCategoryOptions;
use \RatingCategoryOptionsQuery as ChildRatingCategoryOptionsQuery;
use \Exception;
use \PDO;
use Map\RatingCategoryOptionsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'rating_category_options' table.
 *
 * 
 *
 * @method     ChildRatingCategoryOptionsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRatingCategoryOptionsQuery orderByRatingCategoryId($order = Criteria::ASC) Order by the rating_category_id column
 * @method     ChildRatingCategoryOptionsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildRatingCategoryOptionsQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method     ChildRatingCategoryOptionsQuery groupById() Group by the id column
 * @method     ChildRatingCategoryOptionsQuery groupByRatingCategoryId() Group by the rating_category_id column
 * @method     ChildRatingCategoryOptionsQuery groupByDescription() Group by the description column
 * @method     ChildRatingCategoryOptionsQuery groupByValue() Group by the value column
 *
 * @method     ChildRatingCategoryOptionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRatingCategoryOptionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRatingCategoryOptionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRatingCategoryOptionsQuery leftJoinRatingCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingCategories relation
 * @method     ChildRatingCategoryOptionsQuery rightJoinRatingCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingCategories relation
 * @method     ChildRatingCategoryOptionsQuery innerJoinRatingCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingCategories relation
 *
 * @method     ChildRatingCategoryOptionsQuery leftJoinRatingCategoryValues($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingCategoryValues relation
 * @method     ChildRatingCategoryOptionsQuery rightJoinRatingCategoryValues($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingCategoryValues relation
 * @method     ChildRatingCategoryOptionsQuery innerJoinRatingCategoryValues($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingCategoryValues relation
 *
 * @method     \RatingCategoriesQuery|\RatingCategoryValuesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRatingCategoryOptions findOne(ConnectionInterface $con = null) Return the first ChildRatingCategoryOptions matching the query
 * @method     ChildRatingCategoryOptions findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRatingCategoryOptions matching the query, or a new ChildRatingCategoryOptions object populated from the query conditions when no match is found
 *
 * @method     ChildRatingCategoryOptions findOneById(string $id) Return the first ChildRatingCategoryOptions filtered by the id column
 * @method     ChildRatingCategoryOptions findOneByRatingCategoryId(string $rating_category_id) Return the first ChildRatingCategoryOptions filtered by the rating_category_id column
 * @method     ChildRatingCategoryOptions findOneByDescription(string $description) Return the first ChildRatingCategoryOptions filtered by the description column
 * @method     ChildRatingCategoryOptions findOneByValue(int $value) Return the first ChildRatingCategoryOptions filtered by the value column *

 * @method     ChildRatingCategoryOptions requirePk($key, ConnectionInterface $con = null) Return the ChildRatingCategoryOptions by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategoryOptions requireOne(ConnectionInterface $con = null) Return the first ChildRatingCategoryOptions matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRatingCategoryOptions requireOneById(string $id) Return the first ChildRatingCategoryOptions filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategoryOptions requireOneByRatingCategoryId(string $rating_category_id) Return the first ChildRatingCategoryOptions filtered by the rating_category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategoryOptions requireOneByDescription(string $description) Return the first ChildRatingCategoryOptions filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategoryOptions requireOneByValue(int $value) Return the first ChildRatingCategoryOptions filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRatingCategoryOptions[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRatingCategoryOptions objects based on current ModelCriteria
 * @method     ChildRatingCategoryOptions[]|ObjectCollection findById(string $id) Return ChildRatingCategoryOptions objects filtered by the id column
 * @method     ChildRatingCategoryOptions[]|ObjectCollection findByRatingCategoryId(string $rating_category_id) Return ChildRatingCategoryOptions objects filtered by the rating_category_id column
 * @method     ChildRatingCategoryOptions[]|ObjectCollection findByDescription(string $description) Return ChildRatingCategoryOptions objects filtered by the description column
 * @method     ChildRatingCategoryOptions[]|ObjectCollection findByValue(int $value) Return ChildRatingCategoryOptions objects filtered by the value column
 * @method     ChildRatingCategoryOptions[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RatingCategoryOptionsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RatingCategoryOptionsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\RatingCategoryOptions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRatingCategoryOptionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRatingCategoryOptionsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRatingCategoryOptionsQuery) {
            return $criteria;
        }
        $query = new ChildRatingCategoryOptionsQuery();
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
     * @return ChildRatingCategoryOptions|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RatingCategoryOptionsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RatingCategoryOptionsTableMap::DATABASE_NAME);
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
     * @return ChildRatingCategoryOptions A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, rating_category_id, description, value FROM rating_category_options WHERE id = :p0';
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
            /** @var ChildRatingCategoryOptions $obj */
            $obj = new ChildRatingCategoryOptions();
            $obj->hydrate($row);
            RatingCategoryOptionsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildRatingCategoryOptions|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRatingCategoryOptionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RatingCategoryOptionsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRatingCategoryOptionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RatingCategoryOptionsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingCategoryOptionsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RatingCategoryOptionsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RatingCategoryOptionsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingCategoryOptionsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the rating_category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRatingCategoryId(1234); // WHERE rating_category_id = 1234
     * $query->filterByRatingCategoryId(array(12, 34)); // WHERE rating_category_id IN (12, 34)
     * $query->filterByRatingCategoryId(array('min' => 12)); // WHERE rating_category_id > 12
     * </code>
     *
     * @see       filterByRatingCategories()
     *
     * @param     mixed $ratingCategoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingCategoryOptionsQuery The current query, for fluid interface
     */
    public function filterByRatingCategoryId($ratingCategoryId = null, $comparison = null)
    {
        if (is_array($ratingCategoryId)) {
            $useMinMax = false;
            if (isset($ratingCategoryId['min'])) {
                $this->addUsingAlias(RatingCategoryOptionsTableMap::COL_RATING_CATEGORY_ID, $ratingCategoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratingCategoryId['max'])) {
                $this->addUsingAlias(RatingCategoryOptionsTableMap::COL_RATING_CATEGORY_ID, $ratingCategoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingCategoryOptionsTableMap::COL_RATING_CATEGORY_ID, $ratingCategoryId, $comparison);
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
     * @return $this|ChildRatingCategoryOptionsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RatingCategoryOptionsTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue(1234); // WHERE value = 1234
     * $query->filterByValue(array(12, 34)); // WHERE value IN (12, 34)
     * $query->filterByValue(array('min' => 12)); // WHERE value > 12
     * </code>
     *
     * @param     mixed $value The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingCategoryOptionsQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (is_array($value)) {
            $useMinMax = false;
            if (isset($value['min'])) {
                $this->addUsingAlias(RatingCategoryOptionsTableMap::COL_VALUE, $value['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($value['max'])) {
                $this->addUsingAlias(RatingCategoryOptionsTableMap::COL_VALUE, $value['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingCategoryOptionsTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query by a related \RatingCategories object
     *
     * @param \RatingCategories|ObjectCollection $ratingCategories The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRatingCategoryOptionsQuery The current query, for fluid interface
     */
    public function filterByRatingCategories($ratingCategories, $comparison = null)
    {
        if ($ratingCategories instanceof \RatingCategories) {
            return $this
                ->addUsingAlias(RatingCategoryOptionsTableMap::COL_RATING_CATEGORY_ID, $ratingCategories->getId(), $comparison);
        } elseif ($ratingCategories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RatingCategoryOptionsTableMap::COL_RATING_CATEGORY_ID, $ratingCategories->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRatingCategories() only accepts arguments of type \RatingCategories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RatingCategories relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRatingCategoryOptionsQuery The current query, for fluid interface
     */
    public function joinRatingCategories($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RatingCategories');

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
            $this->addJoinObject($join, 'RatingCategories');
        }

        return $this;
    }

    /**
     * Use the RatingCategories relation RatingCategories object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RatingCategoriesQuery A secondary query class using the current class as primary query
     */
    public function useRatingCategoriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRatingCategories($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RatingCategories', '\RatingCategoriesQuery');
    }

    /**
     * Filter the query by a related \RatingCategoryValues object
     *
     * @param \RatingCategoryValues|ObjectCollection $ratingCategoryValues the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRatingCategoryOptionsQuery The current query, for fluid interface
     */
    public function filterByRatingCategoryValues($ratingCategoryValues, $comparison = null)
    {
        if ($ratingCategoryValues instanceof \RatingCategoryValues) {
            return $this
                ->addUsingAlias(RatingCategoryOptionsTableMap::COL_ID, $ratingCategoryValues->getRatingCatgoryOptionId(), $comparison);
        } elseif ($ratingCategoryValues instanceof ObjectCollection) {
            return $this
                ->useRatingCategoryValuesQuery()
                ->filterByPrimaryKeys($ratingCategoryValues->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRatingCategoryValues() only accepts arguments of type \RatingCategoryValues or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RatingCategoryValues relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRatingCategoryOptionsQuery The current query, for fluid interface
     */
    public function joinRatingCategoryValues($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RatingCategoryValues');

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
            $this->addJoinObject($join, 'RatingCategoryValues');
        }

        return $this;
    }

    /**
     * Use the RatingCategoryValues relation RatingCategoryValues object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RatingCategoryValuesQuery A secondary query class using the current class as primary query
     */
    public function useRatingCategoryValuesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRatingCategoryValues($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RatingCategoryValues', '\RatingCategoryValuesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRatingCategoryOptions $ratingCategoryOptions Object to remove from the list of results
     *
     * @return $this|ChildRatingCategoryOptionsQuery The current query, for fluid interface
     */
    public function prune($ratingCategoryOptions = null)
    {
        if ($ratingCategoryOptions) {
            $this->addUsingAlias(RatingCategoryOptionsTableMap::COL_ID, $ratingCategoryOptions->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rating_category_options table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RatingCategoryOptionsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RatingCategoryOptionsTableMap::clearInstancePool();
            RatingCategoryOptionsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RatingCategoryOptionsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RatingCategoryOptionsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            RatingCategoryOptionsTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            RatingCategoryOptionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RatingCategoryOptionsQuery
