<?php

namespace Base;

use \Rating as ChildRating;
use \RatingQuery as ChildRatingQuery;
use \Exception;
use \PDO;
use Map\RatingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'rating' table.
 *
 * 
 *
 * @method     ChildRatingQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRatingQuery orderByInitial($order = Criteria::ASC) Order by the initial column
 * @method     ChildRatingQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildRatingQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildRatingQuery orderByThreshold($order = Criteria::ASC) Order by the threshold column
 *
 * @method     ChildRatingQuery groupById() Group by the id column
 * @method     ChildRatingQuery groupByInitial() Group by the initial column
 * @method     ChildRatingQuery groupByTitle() Group by the title column
 * @method     ChildRatingQuery groupByDescription() Group by the description column
 * @method     ChildRatingQuery groupByThreshold() Group by the threshold column
 *
 * @method     ChildRatingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRatingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRatingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRatingQuery leftJoinUserReview($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserReview relation
 * @method     ChildRatingQuery rightJoinUserReview($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserReview relation
 * @method     ChildRatingQuery innerJoinUserReview($relationAlias = null) Adds a INNER JOIN clause to the query using the UserReview relation
 *
 * @method     \UserReviewQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRating findOne(ConnectionInterface $con = null) Return the first ChildRating matching the query
 * @method     ChildRating findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRating matching the query, or a new ChildRating object populated from the query conditions when no match is found
 *
 * @method     ChildRating findOneById(string $id) Return the first ChildRating filtered by the id column
 * @method     ChildRating findOneByInitial(string $initial) Return the first ChildRating filtered by the initial column
 * @method     ChildRating findOneByTitle(string $title) Return the first ChildRating filtered by the title column
 * @method     ChildRating findOneByDescription(string $description) Return the first ChildRating filtered by the description column
 * @method     ChildRating findOneByThreshold(int $threshold) Return the first ChildRating filtered by the threshold column *

 * @method     ChildRating requirePk($key, ConnectionInterface $con = null) Return the ChildRating by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRating requireOne(ConnectionInterface $con = null) Return the first ChildRating matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRating requireOneById(string $id) Return the first ChildRating filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRating requireOneByInitial(string $initial) Return the first ChildRating filtered by the initial column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRating requireOneByTitle(string $title) Return the first ChildRating filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRating requireOneByDescription(string $description) Return the first ChildRating filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRating requireOneByThreshold(int $threshold) Return the first ChildRating filtered by the threshold column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRating[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRating objects based on current ModelCriteria
 * @method     ChildRating[]|ObjectCollection findById(string $id) Return ChildRating objects filtered by the id column
 * @method     ChildRating[]|ObjectCollection findByInitial(string $initial) Return ChildRating objects filtered by the initial column
 * @method     ChildRating[]|ObjectCollection findByTitle(string $title) Return ChildRating objects filtered by the title column
 * @method     ChildRating[]|ObjectCollection findByDescription(string $description) Return ChildRating objects filtered by the description column
 * @method     ChildRating[]|ObjectCollection findByThreshold(int $threshold) Return ChildRating objects filtered by the threshold column
 * @method     ChildRating[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RatingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RatingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Rating', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRatingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRatingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRatingQuery) {
            return $criteria;
        }
        $query = new ChildRatingQuery();
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
     * @return ChildRating|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RatingTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RatingTableMap::DATABASE_NAME);
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
     * @return ChildRating A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, initial, title, description, threshold FROM rating WHERE id = :p0';
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
            /** @var ChildRating $obj */
            $obj = new ChildRating();
            $obj->hydrate($row);
            RatingTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildRating|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRatingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RatingTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRatingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RatingTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRatingQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RatingTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RatingTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the initial column
     *
     * Example usage:
     * <code>
     * $query->filterByInitial('fooValue');   // WHERE initial = 'fooValue'
     * $query->filterByInitial('%fooValue%'); // WHERE initial LIKE '%fooValue%'
     * </code>
     *
     * @param     string $initial The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingQuery The current query, for fluid interface
     */
    public function filterByInitial($initial = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($initial)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $initial)) {
                $initial = str_replace('*', '%', $initial);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RatingTableMap::COL_INITIAL, $initial, $comparison);
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
     * @return $this|ChildRatingQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RatingTableMap::COL_TITLE, $title, $comparison);
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
     * @return $this|ChildRatingQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RatingTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the threshold column
     *
     * Example usage:
     * <code>
     * $query->filterByThreshold(1234); // WHERE threshold = 1234
     * $query->filterByThreshold(array(12, 34)); // WHERE threshold IN (12, 34)
     * $query->filterByThreshold(array('min' => 12)); // WHERE threshold > 12
     * </code>
     *
     * @param     mixed $threshold The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingQuery The current query, for fluid interface
     */
    public function filterByThreshold($threshold = null, $comparison = null)
    {
        if (is_array($threshold)) {
            $useMinMax = false;
            if (isset($threshold['min'])) {
                $this->addUsingAlias(RatingTableMap::COL_THRESHOLD, $threshold['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($threshold['max'])) {
                $this->addUsingAlias(RatingTableMap::COL_THRESHOLD, $threshold['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingTableMap::COL_THRESHOLD, $threshold, $comparison);
    }

    /**
     * Filter the query by a related \UserReview object
     *
     * @param \UserReview|ObjectCollection $userReview the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRatingQuery The current query, for fluid interface
     */
    public function filterByUserReview($userReview, $comparison = null)
    {
        if ($userReview instanceof \UserReview) {
            return $this
                ->addUsingAlias(RatingTableMap::COL_ID, $userReview->getRatingId(), $comparison);
        } elseif ($userReview instanceof ObjectCollection) {
            return $this
                ->useUserReviewQuery()
                ->filterByPrimaryKeys($userReview->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserReview() only accepts arguments of type \UserReview or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserReview relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRatingQuery The current query, for fluid interface
     */
    public function joinUserReview($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserReview');

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
            $this->addJoinObject($join, 'UserReview');
        }

        return $this;
    }

    /**
     * Use the UserReview relation UserReview object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserReviewQuery A secondary query class using the current class as primary query
     */
    public function useUserReviewQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserReview($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserReview', '\UserReviewQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRating $rating Object to remove from the list of results
     *
     * @return $this|ChildRatingQuery The current query, for fluid interface
     */
    public function prune($rating = null)
    {
        if ($rating) {
            $this->addUsingAlias(RatingTableMap::COL_ID, $rating->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rating table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RatingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RatingTableMap::clearInstancePool();
            RatingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RatingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RatingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            RatingTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            RatingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RatingQuery
