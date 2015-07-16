<?php

namespace Base;

use \RatingRules as ChildRatingRules;
use \RatingRulesQuery as ChildRatingRulesQuery;
use \Exception;
use \PDO;
use Map\RatingRulesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'rating_rules' table.
 *
 * 
 *
 * @method     ChildRatingRulesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRatingRulesQuery orderByRule($order = Criteria::ASC) Order by the rule column
 * @method     ChildRatingRulesQuery orderBySequence($order = Criteria::ASC) Order by the sequence column
 * @method     ChildRatingRulesQuery orderByUpdated($order = Criteria::ASC) Order by the updated column
 *
 * @method     ChildRatingRulesQuery groupById() Group by the id column
 * @method     ChildRatingRulesQuery groupByRule() Group by the rule column
 * @method     ChildRatingRulesQuery groupBySequence() Group by the sequence column
 * @method     ChildRatingRulesQuery groupByUpdated() Group by the updated column
 *
 * @method     ChildRatingRulesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRatingRulesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRatingRulesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRatingRules findOne(ConnectionInterface $con = null) Return the first ChildRatingRules matching the query
 * @method     ChildRatingRules findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRatingRules matching the query, or a new ChildRatingRules object populated from the query conditions when no match is found
 *
 * @method     ChildRatingRules findOneById(string $id) Return the first ChildRatingRules filtered by the id column
 * @method     ChildRatingRules findOneByRule(string $rule) Return the first ChildRatingRules filtered by the rule column
 * @method     ChildRatingRules findOneBySequence(int $sequence) Return the first ChildRatingRules filtered by the sequence column
 * @method     ChildRatingRules findOneByUpdated(string $updated) Return the first ChildRatingRules filtered by the updated column *

 * @method     ChildRatingRules requirePk($key, ConnectionInterface $con = null) Return the ChildRatingRules by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingRules requireOne(ConnectionInterface $con = null) Return the first ChildRatingRules matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRatingRules requireOneById(string $id) Return the first ChildRatingRules filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingRules requireOneByRule(string $rule) Return the first ChildRatingRules filtered by the rule column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingRules requireOneBySequence(int $sequence) Return the first ChildRatingRules filtered by the sequence column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingRules requireOneByUpdated(string $updated) Return the first ChildRatingRules filtered by the updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRatingRules[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRatingRules objects based on current ModelCriteria
 * @method     ChildRatingRules[]|ObjectCollection findById(string $id) Return ChildRatingRules objects filtered by the id column
 * @method     ChildRatingRules[]|ObjectCollection findByRule(string $rule) Return ChildRatingRules objects filtered by the rule column
 * @method     ChildRatingRules[]|ObjectCollection findBySequence(int $sequence) Return ChildRatingRules objects filtered by the sequence column
 * @method     ChildRatingRules[]|ObjectCollection findByUpdated(string $updated) Return ChildRatingRules objects filtered by the updated column
 * @method     ChildRatingRules[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RatingRulesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RatingRulesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\RatingRules', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRatingRulesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRatingRulesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRatingRulesQuery) {
            return $criteria;
        }
        $query = new ChildRatingRulesQuery();
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
     * @return ChildRatingRules|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RatingRulesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RatingRulesTableMap::DATABASE_NAME);
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
     * @return ChildRatingRules A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, rule, sequence, updated FROM rating_rules WHERE id = :p0';
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
            /** @var ChildRatingRules $obj */
            $obj = new ChildRatingRules();
            $obj->hydrate($row);
            RatingRulesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildRatingRules|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRatingRulesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RatingRulesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRatingRulesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RatingRulesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRatingRulesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RatingRulesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RatingRulesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingRulesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the rule column
     *
     * Example usage:
     * <code>
     * $query->filterByRule('fooValue');   // WHERE rule = 'fooValue'
     * $query->filterByRule('%fooValue%'); // WHERE rule LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rule The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingRulesQuery The current query, for fluid interface
     */
    public function filterByRule($rule = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rule)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rule)) {
                $rule = str_replace('*', '%', $rule);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RatingRulesTableMap::COL_RULE, $rule, $comparison);
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
     * @return $this|ChildRatingRulesQuery The current query, for fluid interface
     */
    public function filterBySequence($sequence = null, $comparison = null)
    {
        if (is_array($sequence)) {
            $useMinMax = false;
            if (isset($sequence['min'])) {
                $this->addUsingAlias(RatingRulesTableMap::COL_SEQUENCE, $sequence['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sequence['max'])) {
                $this->addUsingAlias(RatingRulesTableMap::COL_SEQUENCE, $sequence['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingRulesTableMap::COL_SEQUENCE, $sequence, $comparison);
    }

    /**
     * Filter the query on the updated column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdated('2011-03-14'); // WHERE updated = '2011-03-14'
     * $query->filterByUpdated('now'); // WHERE updated = '2011-03-14'
     * $query->filterByUpdated(array('max' => 'yesterday')); // WHERE updated > '2011-03-13'
     * </code>
     *
     * @param     mixed $updated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingRulesQuery The current query, for fluid interface
     */
    public function filterByUpdated($updated = null, $comparison = null)
    {
        if (is_array($updated)) {
            $useMinMax = false;
            if (isset($updated['min'])) {
                $this->addUsingAlias(RatingRulesTableMap::COL_UPDATED, $updated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updated['max'])) {
                $this->addUsingAlias(RatingRulesTableMap::COL_UPDATED, $updated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingRulesTableMap::COL_UPDATED, $updated, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRatingRules $ratingRules Object to remove from the list of results
     *
     * @return $this|ChildRatingRulesQuery The current query, for fluid interface
     */
    public function prune($ratingRules = null)
    {
        if ($ratingRules) {
            $this->addUsingAlias(RatingRulesTableMap::COL_ID, $ratingRules->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rating_rules table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RatingRulesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RatingRulesTableMap::clearInstancePool();
            RatingRulesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RatingRulesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RatingRulesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            RatingRulesTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            RatingRulesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RatingRulesQuery
