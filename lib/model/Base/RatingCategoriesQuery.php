<?php

namespace Base;

use \RatingCategories as ChildRatingCategories;
use \RatingCategoriesQuery as ChildRatingCategoriesQuery;
use \Exception;
use \PDO;
use Map\RatingCategoriesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'rating_categories' table.
 *
 * 
 *
 * @method     ChildRatingCategoriesQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildRatingCategoriesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildRatingCategoriesQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildRatingCategoriesQuery orderByWeight($order = Criteria::ASC) Order by the weight column
 * @method     ChildRatingCategoriesQuery orderBySequence($order = Criteria::ASC) Order by the sequence column
 *
 * @method     ChildRatingCategoriesQuery groupById() Group by the ID column
 * @method     ChildRatingCategoriesQuery groupByName() Group by the name column
 * @method     ChildRatingCategoriesQuery groupByDescription() Group by the description column
 * @method     ChildRatingCategoriesQuery groupByWeight() Group by the weight column
 * @method     ChildRatingCategoriesQuery groupBySequence() Group by the sequence column
 *
 * @method     ChildRatingCategoriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRatingCategoriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRatingCategoriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRatingCategoriesQuery leftJoinRatingCategoryOptions($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingCategoryOptions relation
 * @method     ChildRatingCategoriesQuery rightJoinRatingCategoryOptions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingCategoryOptions relation
 * @method     ChildRatingCategoriesQuery innerJoinRatingCategoryOptions($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingCategoryOptions relation
 *
 * @method     ChildRatingCategoriesQuery leftJoinRatingCategoryValues($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingCategoryValues relation
 * @method     ChildRatingCategoriesQuery rightJoinRatingCategoryValues($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingCategoryValues relation
 * @method     ChildRatingCategoriesQuery innerJoinRatingCategoryValues($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingCategoryValues relation
 *
 * @method     ChildRatingCategoriesQuery leftJoinUserWeights($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserWeights relation
 * @method     ChildRatingCategoriesQuery rightJoinUserWeights($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserWeights relation
 * @method     ChildRatingCategoriesQuery innerJoinUserWeights($relationAlias = null) Adds a INNER JOIN clause to the query using the UserWeights relation
 *
 * @method     \RatingCategoryOptionsQuery|\RatingCategoryValuesQuery|\UserWeightsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRatingCategories findOne(ConnectionInterface $con = null) Return the first ChildRatingCategories matching the query
 * @method     ChildRatingCategories findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRatingCategories matching the query, or a new ChildRatingCategories object populated from the query conditions when no match is found
 *
 * @method     ChildRatingCategories findOneById(string $ID) Return the first ChildRatingCategories filtered by the ID column
 * @method     ChildRatingCategories findOneByName(string $name) Return the first ChildRatingCategories filtered by the name column
 * @method     ChildRatingCategories findOneByDescription(string $description) Return the first ChildRatingCategories filtered by the description column
 * @method     ChildRatingCategories findOneByWeight(int $weight) Return the first ChildRatingCategories filtered by the weight column
 * @method     ChildRatingCategories findOneBySequence(int $sequence) Return the first ChildRatingCategories filtered by the sequence column *

 * @method     ChildRatingCategories requirePk($key, ConnectionInterface $con = null) Return the ChildRatingCategories by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategories requireOne(ConnectionInterface $con = null) Return the first ChildRatingCategories matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRatingCategories requireOneById(string $ID) Return the first ChildRatingCategories filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategories requireOneByName(string $name) Return the first ChildRatingCategories filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategories requireOneByDescription(string $description) Return the first ChildRatingCategories filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategories requireOneByWeight(int $weight) Return the first ChildRatingCategories filtered by the weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingCategories requireOneBySequence(int $sequence) Return the first ChildRatingCategories filtered by the sequence column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRatingCategories[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRatingCategories objects based on current ModelCriteria
 * @method     ChildRatingCategories[]|ObjectCollection findById(string $ID) Return ChildRatingCategories objects filtered by the ID column
 * @method     ChildRatingCategories[]|ObjectCollection findByName(string $name) Return ChildRatingCategories objects filtered by the name column
 * @method     ChildRatingCategories[]|ObjectCollection findByDescription(string $description) Return ChildRatingCategories objects filtered by the description column
 * @method     ChildRatingCategories[]|ObjectCollection findByWeight(int $weight) Return ChildRatingCategories objects filtered by the weight column
 * @method     ChildRatingCategories[]|ObjectCollection findBySequence(int $sequence) Return ChildRatingCategories objects filtered by the sequence column
 * @method     ChildRatingCategories[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RatingCategoriesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RatingCategoriesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\RatingCategories', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRatingCategoriesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRatingCategoriesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRatingCategoriesQuery) {
            return $criteria;
        }
        $query = new ChildRatingCategoriesQuery();
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
     * @return ChildRatingCategories|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RatingCategoriesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RatingCategoriesTableMap::DATABASE_NAME);
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
     * @return ChildRatingCategories A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, name, description, weight, sequence FROM rating_categories WHERE ID = :p0';
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
            /** @var ChildRatingCategories $obj */
            $obj = new ChildRatingCategories();
            $obj->hydrate($row);
            RatingCategoriesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildRatingCategories|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRatingCategoriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RatingCategoriesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRatingCategoriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RatingCategoriesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRatingCategoriesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RatingCategoriesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RatingCategoriesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingCategoriesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingCategoriesQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RatingCategoriesTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildRatingCategoriesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RatingCategoriesTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the weight column
     *
     * Example usage:
     * <code>
     * $query->filterByWeight(1234); // WHERE weight = 1234
     * $query->filterByWeight(array(12, 34)); // WHERE weight IN (12, 34)
     * $query->filterByWeight(array('min' => 12)); // WHERE weight > 12
     * </code>
     *
     * @param     mixed $weight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingCategoriesQuery The current query, for fluid interface
     */
    public function filterByWeight($weight = null, $comparison = null)
    {
        if (is_array($weight)) {
            $useMinMax = false;
            if (isset($weight['min'])) {
                $this->addUsingAlias(RatingCategoriesTableMap::COL_WEIGHT, $weight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($weight['max'])) {
                $this->addUsingAlias(RatingCategoriesTableMap::COL_WEIGHT, $weight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingCategoriesTableMap::COL_WEIGHT, $weight, $comparison);
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
     * @return $this|ChildRatingCategoriesQuery The current query, for fluid interface
     */
    public function filterBySequence($sequence = null, $comparison = null)
    {
        if (is_array($sequence)) {
            $useMinMax = false;
            if (isset($sequence['min'])) {
                $this->addUsingAlias(RatingCategoriesTableMap::COL_SEQUENCE, $sequence['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sequence['max'])) {
                $this->addUsingAlias(RatingCategoriesTableMap::COL_SEQUENCE, $sequence['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingCategoriesTableMap::COL_SEQUENCE, $sequence, $comparison);
    }

    /**
     * Filter the query by a related \RatingCategoryOptions object
     *
     * @param \RatingCategoryOptions|ObjectCollection $ratingCategoryOptions the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRatingCategoriesQuery The current query, for fluid interface
     */
    public function filterByRatingCategoryOptions($ratingCategoryOptions, $comparison = null)
    {
        if ($ratingCategoryOptions instanceof \RatingCategoryOptions) {
            return $this
                ->addUsingAlias(RatingCategoriesTableMap::COL_ID, $ratingCategoryOptions->getRatingCategoryId(), $comparison);
        } elseif ($ratingCategoryOptions instanceof ObjectCollection) {
            return $this
                ->useRatingCategoryOptionsQuery()
                ->filterByPrimaryKeys($ratingCategoryOptions->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRatingCategoryOptions() only accepts arguments of type \RatingCategoryOptions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RatingCategoryOptions relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRatingCategoriesQuery The current query, for fluid interface
     */
    public function joinRatingCategoryOptions($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RatingCategoryOptions');

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
            $this->addJoinObject($join, 'RatingCategoryOptions');
        }

        return $this;
    }

    /**
     * Use the RatingCategoryOptions relation RatingCategoryOptions object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RatingCategoryOptionsQuery A secondary query class using the current class as primary query
     */
    public function useRatingCategoryOptionsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRatingCategoryOptions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RatingCategoryOptions', '\RatingCategoryOptionsQuery');
    }

    /**
     * Filter the query by a related \RatingCategoryValues object
     *
     * @param \RatingCategoryValues|ObjectCollection $ratingCategoryValues the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRatingCategoriesQuery The current query, for fluid interface
     */
    public function filterByRatingCategoryValues($ratingCategoryValues, $comparison = null)
    {
        if ($ratingCategoryValues instanceof \RatingCategoryValues) {
            return $this
                ->addUsingAlias(RatingCategoriesTableMap::COL_ID, $ratingCategoryValues->getRatingCategoryId(), $comparison);
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
     * @return $this|ChildRatingCategoriesQuery The current query, for fluid interface
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
     * Filter the query by a related \UserWeights object
     *
     * @param \UserWeights|ObjectCollection $userWeights the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRatingCategoriesQuery The current query, for fluid interface
     */
    public function filterByUserWeights($userWeights, $comparison = null)
    {
        if ($userWeights instanceof \UserWeights) {
            return $this
                ->addUsingAlias(RatingCategoriesTableMap::COL_ID, $userWeights->getRatingCategoryId(), $comparison);
        } elseif ($userWeights instanceof ObjectCollection) {
            return $this
                ->useUserWeightsQuery()
                ->filterByPrimaryKeys($userWeights->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserWeights() only accepts arguments of type \UserWeights or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserWeights relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRatingCategoriesQuery The current query, for fluid interface
     */
    public function joinUserWeights($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserWeights');

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
            $this->addJoinObject($join, 'UserWeights');
        }

        return $this;
    }

    /**
     * Use the UserWeights relation UserWeights object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserWeightsQuery A secondary query class using the current class as primary query
     */
    public function useUserWeightsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserWeights($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserWeights', '\UserWeightsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRatingCategories $ratingCategories Object to remove from the list of results
     *
     * @return $this|ChildRatingCategoriesQuery The current query, for fluid interface
     */
    public function prune($ratingCategories = null)
    {
        if ($ratingCategories) {
            $this->addUsingAlias(RatingCategoriesTableMap::COL_ID, $ratingCategories->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rating_categories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RatingCategoriesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RatingCategoriesTableMap::clearInstancePool();
            RatingCategoriesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RatingCategoriesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RatingCategoriesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            RatingCategoriesTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            RatingCategoriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RatingCategoriesQuery
