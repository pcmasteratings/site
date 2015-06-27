<?php

namespace Base;

use \RatingCategoryValues as ChildRatingCategoryValues;
use \RatingCategoryValuesQuery as ChildRatingCategoryValuesQuery;
use \Exception;
use \PDO;
use Map\RatingCategoryValuesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'rating_category_values' table.
 *
 * 
 *
 * @method     ChildRatingCategoryValuesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRatingCategoryValuesQuery orderByRatingHeaderId($order = Criteria::ASC) Order by the rating_header_id column
 * @method     ChildRatingCategoryValuesQuery orderByRatingCategoryId($order = Criteria::ASC) Order by the rating_category_id column
 * @method     ChildRatingCategoryValuesQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     ChildRatingCategoryValuesQuery orderBySequence($order = Criteria::ASC) Order by the sequence column
 * @method     ChildRatingCategoryValuesQuery orderByReview($order = Criteria::ASC) Order by the review column
 *
 * @method     ChildRatingCategoryValuesQuery groupById() Group by the id column
 * @method     ChildRatingCategoryValuesQuery groupByRatingHeaderId() Group by the rating_header_id column
 * @method     ChildRatingCategoryValuesQuery groupByRatingCategoryId() Group by the rating_category_id column
 * @method     ChildRatingCategoryValuesQuery groupByValue() Group by the value column
 * @method     ChildRatingCategoryValuesQuery groupBySequence() Group by the sequence column
 * @method     ChildRatingCategoryValuesQuery groupByReview() Group by the review column
 *
 * @method     ChildRatingCategoryValuesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRatingCategoryValuesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRatingCategoryValuesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRatingCategoryValuesQuery leftJoinRatingHeaders($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingHeaders relation
 * @method     ChildRatingCategoryValuesQuery rightJoinRatingHeaders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingHeaders relation
 * @method     ChildRatingCategoryValuesQuery innerJoinRatingHeaders($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingHeaders relation
 *
 * @method     ChildRatingCategoryValuesQuery leftJoinRatingCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingCategories relation
 * @method     ChildRatingCategoryValuesQuery rightJoinRatingCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingCategories relation
 * @method     ChildRatingCategoryValuesQuery innerJoinRatingCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingCategories relation
 *
 * @method     \RatingHeadersQuery|\RatingCategoriesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRatingCategoryValues findOne(ConnectionInterface $con = null) Return the first ChildRatingCategoryValues matching the query
 * @method     ChildRatingCategoryValues findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRatingCategoryValues matching the query, or a new ChildRatingCategoryValues object populated from the query conditions when no match is found
 *
 * @method     ChildRatingCategoryValues findOneById(string $id) Return the first ChildRatingCategoryValues filtered by the id column
 * @method     ChildRatingCategoryValues findOneByRatingHeaderId(string $rating_header_id) Return the first ChildRatingCategoryValues filtered by the rating_header_id column
 * @method     ChildRatingCategoryValues findOneByRatingCategoryId(string $rating_category_id) Return the first ChildRatingCategoryValues filtered by the rating_category_id column
 * @method     ChildRatingCategoryValues findOneByValue(int $value) Return the first ChildRatingCategoryValues filtered by the value column
 * @method     ChildRatingCategoryValues findOneBySequence(int $sequence) Return the first ChildRatingCategoryValues filtered by the sequence column
 * @method     ChildRatingCategoryValues findOneByReview(string $review) Return the first ChildRatingCategoryValues filtered by the review column *

 * @method     ChildRatingCategoryValues requirePk($key, ConnectionInterface $con = null) Return the ChildRatingCategoryValues by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategoryValues requireOne(ConnectionInterface $con = null) Return the first ChildRatingCategoryValues matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRatingCategoryValues requireOneById(string $id) Return the first ChildRatingCategoryValues filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategoryValues requireOneByRatingHeaderId(string $rating_header_id) Return the first ChildRatingCategoryValues filtered by the rating_header_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategoryValues requireOneByRatingCategoryId(string $rating_category_id) Return the first ChildRatingCategoryValues filtered by the rating_category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategoryValues requireOneByValue(int $value) Return the first ChildRatingCategoryValues filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategoryValues requireOneBySequence(int $sequence) Return the first ChildRatingCategoryValues filtered by the sequence column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategoryValues requireOneByReview(string $review) Return the first ChildRatingCategoryValues filtered by the review column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRatingCategoryValues[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRatingCategoryValues objects based on current ModelCriteria
 * @method     ChildRatingCategoryValues[]|ObjectCollection findById(string $id) Return ChildRatingCategoryValues objects filtered by the id column
 * @method     ChildRatingCategoryValues[]|ObjectCollection findByRatingHeaderId(string $rating_header_id) Return ChildRatingCategoryValues objects filtered by the rating_header_id column
 * @method     ChildRatingCategoryValues[]|ObjectCollection findByRatingCategoryId(string $rating_category_id) Return ChildRatingCategoryValues objects filtered by the rating_category_id column
 * @method     ChildRatingCategoryValues[]|ObjectCollection findByValue(int $value) Return ChildRatingCategoryValues objects filtered by the value column
 * @method     ChildRatingCategoryValues[]|ObjectCollection findBySequence(int $sequence) Return ChildRatingCategoryValues objects filtered by the sequence column
 * @method     ChildRatingCategoryValues[]|ObjectCollection findByReview(string $review) Return ChildRatingCategoryValues objects filtered by the review column
 * @method     ChildRatingCategoryValues[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RatingCategoryValuesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RatingCategoryValuesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\RatingCategoryValues', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRatingCategoryValuesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRatingCategoryValuesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRatingCategoryValuesQuery) {
            return $criteria;
        }
        $query = new ChildRatingCategoryValuesQuery();
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
     * @return ChildRatingCategoryValues|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RatingCategoryValuesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RatingCategoryValuesTableMap::DATABASE_NAME);
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
     * @return ChildRatingCategoryValues A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, rating_header_id, rating_category_id, value, sequence, review FROM rating_category_values WHERE id = :p0';
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
            /** @var ChildRatingCategoryValues $obj */
            $obj = new ChildRatingCategoryValues();
            $obj->hydrate($row);
            RatingCategoryValuesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildRatingCategoryValues|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRatingCategoryValuesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RatingCategoryValuesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRatingCategoryValuesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RatingCategoryValuesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRatingCategoryValuesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RatingCategoryValuesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RatingCategoryValuesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingCategoryValuesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the rating_header_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRatingHeaderId(1234); // WHERE rating_header_id = 1234
     * $query->filterByRatingHeaderId(array(12, 34)); // WHERE rating_header_id IN (12, 34)
     * $query->filterByRatingHeaderId(array('min' => 12)); // WHERE rating_header_id > 12
     * </code>
     *
     * @see       filterByRatingHeaders()
     *
     * @param     mixed $ratingHeaderId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingCategoryValuesQuery The current query, for fluid interface
     */
    public function filterByRatingHeaderId($ratingHeaderId = null, $comparison = null)
    {
        if (is_array($ratingHeaderId)) {
            $useMinMax = false;
            if (isset($ratingHeaderId['min'])) {
                $this->addUsingAlias(RatingCategoryValuesTableMap::COL_RATING_HEADER_ID, $ratingHeaderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratingHeaderId['max'])) {
                $this->addUsingAlias(RatingCategoryValuesTableMap::COL_RATING_HEADER_ID, $ratingHeaderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingCategoryValuesTableMap::COL_RATING_HEADER_ID, $ratingHeaderId, $comparison);
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
     * @return $this|ChildRatingCategoryValuesQuery The current query, for fluid interface
     */
    public function filterByRatingCategoryId($ratingCategoryId = null, $comparison = null)
    {
        if (is_array($ratingCategoryId)) {
            $useMinMax = false;
            if (isset($ratingCategoryId['min'])) {
                $this->addUsingAlias(RatingCategoryValuesTableMap::COL_RATING_CATEGORY_ID, $ratingCategoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratingCategoryId['max'])) {
                $this->addUsingAlias(RatingCategoryValuesTableMap::COL_RATING_CATEGORY_ID, $ratingCategoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingCategoryValuesTableMap::COL_RATING_CATEGORY_ID, $ratingCategoryId, $comparison);
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
     * @return $this|ChildRatingCategoryValuesQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (is_array($value)) {
            $useMinMax = false;
            if (isset($value['min'])) {
                $this->addUsingAlias(RatingCategoryValuesTableMap::COL_VALUE, $value['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($value['max'])) {
                $this->addUsingAlias(RatingCategoryValuesTableMap::COL_VALUE, $value['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingCategoryValuesTableMap::COL_VALUE, $value, $comparison);
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
     * @return $this|ChildRatingCategoryValuesQuery The current query, for fluid interface
     */
    public function filterBySequence($sequence = null, $comparison = null)
    {
        if (is_array($sequence)) {
            $useMinMax = false;
            if (isset($sequence['min'])) {
                $this->addUsingAlias(RatingCategoryValuesTableMap::COL_SEQUENCE, $sequence['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sequence['max'])) {
                $this->addUsingAlias(RatingCategoryValuesTableMap::COL_SEQUENCE, $sequence['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingCategoryValuesTableMap::COL_SEQUENCE, $sequence, $comparison);
    }

    /**
     * Filter the query on the review column
     *
     * Example usage:
     * <code>
     * $query->filterByReview('fooValue');   // WHERE review = 'fooValue'
     * $query->filterByReview('%fooValue%'); // WHERE review LIKE '%fooValue%'
     * </code>
     *
     * @param     string $review The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingCategoryValuesQuery The current query, for fluid interface
     */
    public function filterByReview($review = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($review)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $review)) {
                $review = str_replace('*', '%', $review);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RatingCategoryValuesTableMap::COL_REVIEW, $review, $comparison);
    }

    /**
     * Filter the query by a related \RatingHeaders object
     *
     * @param \RatingHeaders|ObjectCollection $ratingHeaders The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRatingCategoryValuesQuery The current query, for fluid interface
     */
    public function filterByRatingHeaders($ratingHeaders, $comparison = null)
    {
        if ($ratingHeaders instanceof \RatingHeaders) {
            return $this
                ->addUsingAlias(RatingCategoryValuesTableMap::COL_RATING_HEADER_ID, $ratingHeaders->getId(), $comparison);
        } elseif ($ratingHeaders instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RatingCategoryValuesTableMap::COL_RATING_HEADER_ID, $ratingHeaders->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRatingHeaders() only accepts arguments of type \RatingHeaders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RatingHeaders relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRatingCategoryValuesQuery The current query, for fluid interface
     */
    public function joinRatingHeaders($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RatingHeaders');

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
            $this->addJoinObject($join, 'RatingHeaders');
        }

        return $this;
    }

    /**
     * Use the RatingHeaders relation RatingHeaders object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RatingHeadersQuery A secondary query class using the current class as primary query
     */
    public function useRatingHeadersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRatingHeaders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RatingHeaders', '\RatingHeadersQuery');
    }

    /**
     * Filter the query by a related \RatingCategories object
     *
     * @param \RatingCategories|ObjectCollection $ratingCategories The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRatingCategoryValuesQuery The current query, for fluid interface
     */
    public function filterByRatingCategories($ratingCategories, $comparison = null)
    {
        if ($ratingCategories instanceof \RatingCategories) {
            return $this
                ->addUsingAlias(RatingCategoryValuesTableMap::COL_RATING_CATEGORY_ID, $ratingCategories->getId(), $comparison);
        } elseif ($ratingCategories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RatingCategoryValuesTableMap::COL_RATING_CATEGORY_ID, $ratingCategories->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildRatingCategoryValuesQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildRatingCategoryValues $ratingCategoryValues Object to remove from the list of results
     *
     * @return $this|ChildRatingCategoryValuesQuery The current query, for fluid interface
     */
    public function prune($ratingCategoryValues = null)
    {
        if ($ratingCategoryValues) {
            $this->addUsingAlias(RatingCategoryValuesTableMap::COL_ID, $ratingCategoryValues->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rating_category_values table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RatingCategoryValuesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RatingCategoryValuesTableMap::clearInstancePool();
            RatingCategoryValuesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RatingCategoryValuesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RatingCategoryValuesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            RatingCategoryValuesTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            RatingCategoryValuesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RatingCategoryValuesQuery
