<?php

namespace Base;

use \Rigs as ChildRigs;
use \RigsQuery as ChildRigsQuery;
use \Exception;
use \PDO;
use Map\RigsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'rigs' table.
 *
 * 
 *
 * @method     ChildRigsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRigsQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildRigsQuery orderByTitle($order = Criteria::ASC) Order by the title column
 *
 * @method     ChildRigsQuery groupById() Group by the id column
 * @method     ChildRigsQuery groupByUserId() Group by the user_id column
 * @method     ChildRigsQuery groupByTitle() Group by the title column
 *
 * @method     ChildRigsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRigsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRigsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRigsQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildRigsQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildRigsQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildRigsQuery leftJoinRatingHeaders($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingHeaders relation
 * @method     ChildRigsQuery rightJoinRatingHeaders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingHeaders relation
 * @method     ChildRigsQuery innerJoinRatingHeaders($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingHeaders relation
 *
 * @method     ChildRigsQuery leftJoinRigAttributeValues($relationAlias = null) Adds a LEFT JOIN clause to the query using the RigAttributeValues relation
 * @method     ChildRigsQuery rightJoinRigAttributeValues($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RigAttributeValues relation
 * @method     ChildRigsQuery innerJoinRigAttributeValues($relationAlias = null) Adds a INNER JOIN clause to the query using the RigAttributeValues relation
 *
 * @method     ChildRigsQuery leftJoinUserReviews($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserReviews relation
 * @method     ChildRigsQuery rightJoinUserReviews($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserReviews relation
 * @method     ChildRigsQuery innerJoinUserReviews($relationAlias = null) Adds a INNER JOIN clause to the query using the UserReviews relation
 *
 * @method     \UserQuery|\RatingHeadersQuery|\RigAttributeValuesQuery|\UserReviewsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRigs findOne(ConnectionInterface $con = null) Return the first ChildRigs matching the query
 * @method     ChildRigs findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRigs matching the query, or a new ChildRigs object populated from the query conditions when no match is found
 *
 * @method     ChildRigs findOneById(string $id) Return the first ChildRigs filtered by the id column
 * @method     ChildRigs findOneByUserId(string $user_id) Return the first ChildRigs filtered by the user_id column
 * @method     ChildRigs findOneByTitle(string $title) Return the first ChildRigs filtered by the title column *

 * @method     ChildRigs requirePk($key, ConnectionInterface $con = null) Return the ChildRigs by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRigs requireOne(ConnectionInterface $con = null) Return the first ChildRigs matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRigs requireOneById(string $id) Return the first ChildRigs filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRigs requireOneByUserId(string $user_id) Return the first ChildRigs filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRigs requireOneByTitle(string $title) Return the first ChildRigs filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRigs[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRigs objects based on current ModelCriteria
 * @method     ChildRigs[]|ObjectCollection findById(string $id) Return ChildRigs objects filtered by the id column
 * @method     ChildRigs[]|ObjectCollection findByUserId(string $user_id) Return ChildRigs objects filtered by the user_id column
 * @method     ChildRigs[]|ObjectCollection findByTitle(string $title) Return ChildRigs objects filtered by the title column
 * @method     ChildRigs[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RigsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RigsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Rigs', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRigsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRigsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRigsQuery) {
            return $criteria;
        }
        $query = new ChildRigsQuery();
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
     * @return ChildRigs|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RigsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RigsTableMap::DATABASE_NAME);
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
     * @return ChildRigs A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user_id, title FROM rigs WHERE id = :p0';
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
            /** @var ChildRigs $obj */
            $obj = new ChildRigs();
            $obj->hydrate($row);
            RigsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildRigs|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRigsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RigsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRigsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RigsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRigsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RigsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RigsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RigsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRigsQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(RigsTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(RigsTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RigsTableMap::COL_USER_ID, $userId, $comparison);
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
     * @return $this|ChildRigsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RigsTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRigsQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(RigsTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RigsTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRigsQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\UserQuery');
    }

    /**
     * Filter the query by a related \RatingHeaders object
     *
     * @param \RatingHeaders|ObjectCollection $ratingHeaders the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRigsQuery The current query, for fluid interface
     */
    public function filterByRatingHeaders($ratingHeaders, $comparison = null)
    {
        if ($ratingHeaders instanceof \RatingHeaders) {
            return $this
                ->addUsingAlias(RigsTableMap::COL_ID, $ratingHeaders->getRigId(), $comparison);
        } elseif ($ratingHeaders instanceof ObjectCollection) {
            return $this
                ->useRatingHeadersQuery()
                ->filterByPrimaryKeys($ratingHeaders->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildRigsQuery The current query, for fluid interface
     */
    public function joinRatingHeaders($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useRatingHeadersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRatingHeaders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RatingHeaders', '\RatingHeadersQuery');
    }

    /**
     * Filter the query by a related \RigAttributeValues object
     *
     * @param \RigAttributeValues|ObjectCollection $rigAttributeValues the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRigsQuery The current query, for fluid interface
     */
    public function filterByRigAttributeValues($rigAttributeValues, $comparison = null)
    {
        if ($rigAttributeValues instanceof \RigAttributeValues) {
            return $this
                ->addUsingAlias(RigsTableMap::COL_ID, $rigAttributeValues->getRigId(), $comparison);
        } elseif ($rigAttributeValues instanceof ObjectCollection) {
            return $this
                ->useRigAttributeValuesQuery()
                ->filterByPrimaryKeys($rigAttributeValues->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRigAttributeValues() only accepts arguments of type \RigAttributeValues or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RigAttributeValues relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRigsQuery The current query, for fluid interface
     */
    public function joinRigAttributeValues($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RigAttributeValues');

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
            $this->addJoinObject($join, 'RigAttributeValues');
        }

        return $this;
    }

    /**
     * Use the RigAttributeValues relation RigAttributeValues object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RigAttributeValuesQuery A secondary query class using the current class as primary query
     */
    public function useRigAttributeValuesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRigAttributeValues($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RigAttributeValues', '\RigAttributeValuesQuery');
    }

    /**
     * Filter the query by a related \UserReviews object
     *
     * @param \UserReviews|ObjectCollection $userReviews the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRigsQuery The current query, for fluid interface
     */
    public function filterByUserReviews($userReviews, $comparison = null)
    {
        if ($userReviews instanceof \UserReviews) {
            return $this
                ->addUsingAlias(RigsTableMap::COL_ID, $userReviews->getRigId(), $comparison);
        } elseif ($userReviews instanceof ObjectCollection) {
            return $this
                ->useUserReviewsQuery()
                ->filterByPrimaryKeys($userReviews->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserReviews() only accepts arguments of type \UserReviews or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserReviews relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRigsQuery The current query, for fluid interface
     */
    public function joinUserReviews($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserReviews');

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
            $this->addJoinObject($join, 'UserReviews');
        }

        return $this;
    }

    /**
     * Use the UserReviews relation UserReviews object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserReviewsQuery A secondary query class using the current class as primary query
     */
    public function useUserReviewsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserReviews($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserReviews', '\UserReviewsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRigs $rigs Object to remove from the list of results
     *
     * @return $this|ChildRigsQuery The current query, for fluid interface
     */
    public function prune($rigs = null)
    {
        if ($rigs) {
            $this->addUsingAlias(RigsTableMap::COL_ID, $rigs->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rigs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RigsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RigsTableMap::clearInstancePool();
            RigsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RigsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RigsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            RigsTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            RigsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RigsQuery
