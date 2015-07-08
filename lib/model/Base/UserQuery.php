<?php

namespace Base;

use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \Exception;
use \PDO;
use Map\UserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user' table.
 *
 *
 *
 * @method     ChildUserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUserQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildUserQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUserQuery orderByRedditId($order = Criteria::ASC) Order by the reddit_id column
 * @method     ChildUserQuery orderByTrusted($order = Criteria::ASC) Order by the trusted column
 * @method     ChildUserQuery orderByAdmin($order = Criteria::ASC) Order by the admin column
 * @method     ChildUserQuery orderByBanned($order = Criteria::ASC) Order by the banned column
 *
 * @method     ChildUserQuery groupById() Group by the id column
 * @method     ChildUserQuery groupByUsername() Group by the username column
 * @method     ChildUserQuery groupByPassword() Group by the password column
 * @method     ChildUserQuery groupByRedditId() Group by the reddit_id column
 * @method     ChildUserQuery groupByTrusted() Group by the trusted column
 * @method     ChildUserQuery groupByAdmin() Group by the admin column
 * @method     ChildUserQuery groupByBanned() Group by the banned column
 *
 * @method     ChildUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserQuery leftJoinNews($relationAlias = null) Adds a LEFT JOIN clause to the query using the News relation
 * @method     ChildUserQuery rightJoinNews($relationAlias = null) Adds a RIGHT JOIN clause to the query using the News relation
 * @method     ChildUserQuery innerJoinNews($relationAlias = null) Adds a INNER JOIN clause to the query using the News relation
 *
 * @method     ChildUserQuery leftJoinRatingHeaders($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingHeaders relation
 * @method     ChildUserQuery rightJoinRatingHeaders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingHeaders relation
 * @method     ChildUserQuery innerJoinRatingHeaders($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingHeaders relation
 *
 * @method     ChildUserQuery leftJoinRigs($relationAlias = null) Adds a LEFT JOIN clause to the query using the Rigs relation
 * @method     ChildUserQuery rightJoinRigs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Rigs relation
 * @method     ChildUserQuery innerJoinRigs($relationAlias = null) Adds a INNER JOIN clause to the query using the Rigs relation
 *
 * @method     ChildUserQuery leftJoinUserAttributeValues($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserAttributeValues relation
 * @method     ChildUserQuery rightJoinUserAttributeValues($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserAttributeValues relation
 * @method     ChildUserQuery innerJoinUserAttributeValues($relationAlias = null) Adds a INNER JOIN clause to the query using the UserAttributeValues relation
 *
 * @method     ChildUserQuery leftJoinUserReviews($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserReviews relation
 * @method     ChildUserQuery rightJoinUserReviews($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserReviews relation
 * @method     ChildUserQuery innerJoinUserReviews($relationAlias = null) Adds a INNER JOIN clause to the query using the UserReviews relation
 *
 * @method     ChildUserQuery leftJoinUserWeights($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserWeights relation
 * @method     ChildUserQuery rightJoinUserWeights($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserWeights relation
 * @method     ChildUserQuery innerJoinUserWeights($relationAlias = null) Adds a INNER JOIN clause to the query using the UserWeights relation
 *
 * @method     \NewsQuery|\RatingHeadersQuery|\RigsQuery|\UserAttributeValuesQuery|\UserReviewsQuery|\UserWeightsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUser findOne(ConnectionInterface $con = null) Return the first ChildUser matching the query
 * @method     ChildUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUser matching the query, or a new ChildUser object populated from the query conditions when no match is found
 *
 * @method     ChildUser findOneById(string $id) Return the first ChildUser filtered by the id column
 * @method     ChildUser findOneByUsername(string $username) Return the first ChildUser filtered by the username column
 * @method     ChildUser findOneByPassword(string $password) Return the first ChildUser filtered by the password column
 * @method     ChildUser findOneByRedditId(string $reddit_id) Return the first ChildUser filtered by the reddit_id column
 * @method     ChildUser findOneByTrusted(boolean $trusted) Return the first ChildUser filtered by the trusted column
 * @method     ChildUser findOneByAdmin(boolean $admin) Return the first ChildUser filtered by the admin column
 * @method     ChildUser findOneByBanned(boolean $banned) Return the first ChildUser filtered by the banned column *

 * @method     ChildUser requirePk($key, ConnectionInterface $con = null) Return the ChildUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOne(ConnectionInterface $con = null) Return the first ChildUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser requireOneById(string $id) Return the first ChildUser filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByUsername(string $username) Return the first ChildUser filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByPassword(string $password) Return the first ChildUser filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByRedditId(string $reddit_id) Return the first ChildUser filtered by the reddit_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByTrusted(boolean $trusted) Return the first ChildUser filtered by the trusted column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByAdmin(boolean $admin) Return the first ChildUser filtered by the admin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUser requireOneByBanned(boolean $banned) Return the first ChildUser filtered by the banned column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUser objects based on current ModelCriteria
 * @method     ChildUser[]|ObjectCollection findById(string $id) Return ChildUser objects filtered by the id column
 * @method     ChildUser[]|ObjectCollection findByUsername(string $username) Return ChildUser objects filtered by the username column
 * @method     ChildUser[]|ObjectCollection findByPassword(string $password) Return ChildUser objects filtered by the password column
 * @method     ChildUser[]|ObjectCollection findByRedditId(string $reddit_id) Return ChildUser objects filtered by the reddit_id column
 * @method     ChildUser[]|ObjectCollection findByTrusted(boolean $trusted) Return ChildUser objects filtered by the trusted column
 * @method     ChildUser[]|ObjectCollection findByAdmin(boolean $admin) Return ChildUser objects filtered by the admin column
 * @method     ChildUser[]|ObjectCollection findByBanned(boolean $banned) Return ChildUser objects filtered by the banned column
 * @method     ChildUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserQuery) {
            return $criteria;
        }
        $query = new ChildUserQuery();
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
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
     * @return ChildUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, username, password, reddit_id, trusted, admin, banned FROM user WHERE id = :p0';
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
            /** @var ChildUser $obj */
            $obj = new ChildUser();
            $obj->hydrate($row);
            UserTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UserTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%'); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $username)) {
                $username = str_replace('*', '%', $username);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the reddit_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRedditId('fooValue');   // WHERE reddit_id = 'fooValue'
     * $query->filterByRedditId('%fooValue%'); // WHERE reddit_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $redditId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByRedditId($redditId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($redditId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $redditId)) {
                $redditId = str_replace('*', '%', $redditId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserTableMap::COL_REDDIT_ID, $redditId, $comparison);
    }

    /**
     * Filter the query on the trusted column
     *
     * Example usage:
     * <code>
     * $query->filterByTrusted(true); // WHERE trusted = true
     * $query->filterByTrusted('yes'); // WHERE trusted = true
     * </code>
     *
     * @param     boolean|string $trusted The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByTrusted($trusted = null, $comparison = null)
    {
        if (is_string($trusted)) {
            $trusted = in_array(strtolower($trusted), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserTableMap::COL_TRUSTED, $trusted, $comparison);
    }

    /**
     * Filter the query on the admin column
     *
     * Example usage:
     * <code>
     * $query->filterByAdmin(true); // WHERE admin = true
     * $query->filterByAdmin('yes'); // WHERE admin = true
     * </code>
     *
     * @param     boolean|string $admin The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByAdmin($admin = null, $comparison = null)
    {
        if (is_string($admin)) {
            $admin = in_array(strtolower($admin), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserTableMap::COL_ADMIN, $admin, $comparison);
    }

    /**
     * Filter the query on the banned column
     *
     * Example usage:
     * <code>
     * $query->filterByBanned(true); // WHERE banned = true
     * $query->filterByBanned('yes'); // WHERE banned = true
     * </code>
     *
     * @param     boolean|string $banned The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function filterByBanned($banned = null, $comparison = null)
    {
        if (is_string($banned)) {
            $banned = in_array(strtolower($banned), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserTableMap::COL_BANNED, $banned, $comparison);
    }

    /**
     * Filter the query by a related \News object
     *
     * @param \News|ObjectCollection $news the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByNews($news, $comparison = null)
    {
        if ($news instanceof \News) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID, $news->getUserId(), $comparison);
        } elseif ($news instanceof ObjectCollection) {
            return $this
                ->useNewsQuery()
                ->filterByPrimaryKeys($news->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNews() only accepts arguments of type \News or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the News relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinNews($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('News');

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
            $this->addJoinObject($join, 'News');
        }

        return $this;
    }

    /**
     * Use the News relation News object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \NewsQuery A secondary query class using the current class as primary query
     */
    public function useNewsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNews($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'News', '\NewsQuery');
    }

    /**
     * Filter the query by a related \RatingHeaders object
     *
     * @param \RatingHeaders|ObjectCollection $ratingHeaders the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByRatingHeaders($ratingHeaders, $comparison = null)
    {
        if ($ratingHeaders instanceof \RatingHeaders) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID, $ratingHeaders->getUserId(), $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
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
     * Filter the query by a related \Rigs object
     *
     * @param \Rigs|ObjectCollection $rigs the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByRigs($rigs, $comparison = null)
    {
        if ($rigs instanceof \Rigs) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID, $rigs->getUserId(), $comparison);
        } elseif ($rigs instanceof ObjectCollection) {
            return $this
                ->useRigsQuery()
                ->filterByPrimaryKeys($rigs->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRigs() only accepts arguments of type \Rigs or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Rigs relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinRigs($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Rigs');

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
            $this->addJoinObject($join, 'Rigs');
        }

        return $this;
    }

    /**
     * Use the Rigs relation Rigs object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RigsQuery A secondary query class using the current class as primary query
     */
    public function useRigsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRigs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Rigs', '\RigsQuery');
    }

    /**
     * Filter the query by a related \UserAttributeValues object
     *
     * @param \UserAttributeValues|ObjectCollection $userAttributeValues the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserAttributeValues($userAttributeValues, $comparison = null)
    {
        if ($userAttributeValues instanceof \UserAttributeValues) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID, $userAttributeValues->getUserId(), $comparison);
        } elseif ($userAttributeValues instanceof ObjectCollection) {
            return $this
                ->useUserAttributeValuesQuery()
                ->filterByPrimaryKeys($userAttributeValues->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserAttributeValues() only accepts arguments of type \UserAttributeValues or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserAttributeValues relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function joinUserAttributeValues($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserAttributeValues');

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
            $this->addJoinObject($join, 'UserAttributeValues');
        }

        return $this;
    }

    /**
     * Use the UserAttributeValues relation UserAttributeValues object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserAttributeValuesQuery A secondary query class using the current class as primary query
     */
    public function useUserAttributeValuesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserAttributeValues($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserAttributeValues', '\UserAttributeValuesQuery');
    }

    /**
     * Filter the query by a related \UserReviews object
     *
     * @param \UserReviews|ObjectCollection $userReviews the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserReviews($userReviews, $comparison = null)
    {
        if ($userReviews instanceof \UserReviews) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID, $userReviews->getUserId(), $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
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
     * Filter the query by a related \UserWeights object
     *
     * @param \UserWeights|ObjectCollection $userWeights the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserQuery The current query, for fluid interface
     */
    public function filterByUserWeights($userWeights, $comparison = null)
    {
        if ($userWeights instanceof \UserWeights) {
            return $this
                ->addUsingAlias(UserTableMap::COL_ID, $userWeights->getUserId(), $comparison);
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
     * @return $this|ChildUserQuery The current query, for fluid interface
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
     * @param   ChildUser $user Object to remove from the list of results
     *
     * @return $this|ChildUserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserTableMap::COL_ID, $user->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserTableMap::clearInstancePool();
            UserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserQuery
