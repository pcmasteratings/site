<?php

namespace Base;

use \ContestQueue as ChildContestQueue;
use \ContestQueueQuery as ChildContestQueueQuery;
use \Exception;
use \PDO;
use Map\ContestQueueTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'contest_queue' table.
 *
 * 
 *
 * @method     ChildContestQueueQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildContestQueueQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildContestQueueQuery orderByGameId($order = Criteria::ASC) Order by the game_id column
 * @method     ChildContestQueueQuery orderByPlatformId($order = Criteria::ASC) Order by the platform_id column
 * @method     ChildContestQueueQuery orderByMessage($order = Criteria::ASC) Order by the message column
 * @method     ChildContestQueueQuery orderByAssignedUserId($order = Criteria::ASC) Order by the assigned_user_id column
 * @method     ChildContestQueueQuery orderByResolved($order = Criteria::ASC) Order by the resolved column
 *
 * @method     ChildContestQueueQuery groupById() Group by the id column
 * @method     ChildContestQueueQuery groupByUserId() Group by the user_id column
 * @method     ChildContestQueueQuery groupByGameId() Group by the game_id column
 * @method     ChildContestQueueQuery groupByPlatformId() Group by the platform_id column
 * @method     ChildContestQueueQuery groupByMessage() Group by the message column
 * @method     ChildContestQueueQuery groupByAssignedUserId() Group by the assigned_user_id column
 * @method     ChildContestQueueQuery groupByResolved() Group by the resolved column
 *
 * @method     ChildContestQueueQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildContestQueueQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildContestQueueQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildContestQueueQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildContestQueueQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildContestQueueQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     \UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildContestQueue findOne(ConnectionInterface $con = null) Return the first ChildContestQueue matching the query
 * @method     ChildContestQueue findOneOrCreate(ConnectionInterface $con = null) Return the first ChildContestQueue matching the query, or a new ChildContestQueue object populated from the query conditions when no match is found
 *
 * @method     ChildContestQueue findOneById(string $id) Return the first ChildContestQueue filtered by the id column
 * @method     ChildContestQueue findOneByUserId(string $user_id) Return the first ChildContestQueue filtered by the user_id column
 * @method     ChildContestQueue findOneByGameId(string $game_id) Return the first ChildContestQueue filtered by the game_id column
 * @method     ChildContestQueue findOneByPlatformId(string $platform_id) Return the first ChildContestQueue filtered by the platform_id column
 * @method     ChildContestQueue findOneByMessage(string $message) Return the first ChildContestQueue filtered by the message column
 * @method     ChildContestQueue findOneByAssignedUserId(string $assigned_user_id) Return the first ChildContestQueue filtered by the assigned_user_id column
 * @method     ChildContestQueue findOneByResolved(boolean $resolved) Return the first ChildContestQueue filtered by the resolved column *

 * @method     ChildContestQueue requirePk($key, ConnectionInterface $con = null) Return the ChildContestQueue by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContestQueue requireOne(ConnectionInterface $con = null) Return the first ChildContestQueue matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildContestQueue requireOneById(string $id) Return the first ChildContestQueue filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContestQueue requireOneByUserId(string $user_id) Return the first ChildContestQueue filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContestQueue requireOneByGameId(string $game_id) Return the first ChildContestQueue filtered by the game_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContestQueue requireOneByPlatformId(string $platform_id) Return the first ChildContestQueue filtered by the platform_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContestQueue requireOneByMessage(string $message) Return the first ChildContestQueue filtered by the message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContestQueue requireOneByAssignedUserId(string $assigned_user_id) Return the first ChildContestQueue filtered by the assigned_user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContestQueue requireOneByResolved(boolean $resolved) Return the first ChildContestQueue filtered by the resolved column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildContestQueue[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildContestQueue objects based on current ModelCriteria
 * @method     ChildContestQueue[]|ObjectCollection findById(string $id) Return ChildContestQueue objects filtered by the id column
 * @method     ChildContestQueue[]|ObjectCollection findByUserId(string $user_id) Return ChildContestQueue objects filtered by the user_id column
 * @method     ChildContestQueue[]|ObjectCollection findByGameId(string $game_id) Return ChildContestQueue objects filtered by the game_id column
 * @method     ChildContestQueue[]|ObjectCollection findByPlatformId(string $platform_id) Return ChildContestQueue objects filtered by the platform_id column
 * @method     ChildContestQueue[]|ObjectCollection findByMessage(string $message) Return ChildContestQueue objects filtered by the message column
 * @method     ChildContestQueue[]|ObjectCollection findByAssignedUserId(string $assigned_user_id) Return ChildContestQueue objects filtered by the assigned_user_id column
 * @method     ChildContestQueue[]|ObjectCollection findByResolved(boolean $resolved) Return ChildContestQueue objects filtered by the resolved column
 * @method     ChildContestQueue[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ContestQueueQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ContestQueueQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ContestQueue', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildContestQueueQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildContestQueueQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildContestQueueQuery) {
            return $criteria;
        }
        $query = new ChildContestQueueQuery();
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
     * @return ChildContestQueue|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ContestQueueTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ContestQueueTableMap::DATABASE_NAME);
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
     * @return ChildContestQueue A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user_id, game_id, platform_id, message, assigned_user_id, resolved FROM contest_queue WHERE id = :p0';
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
            /** @var ChildContestQueue $obj */
            $obj = new ChildContestQueue();
            $obj->hydrate($row);
            ContestQueueTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildContestQueue|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildContestQueueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ContestQueueTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildContestQueueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ContestQueueTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildContestQueueQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ContestQueueTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ContestQueueTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContestQueueTableMap::COL_ID, $id, $comparison);
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
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContestQueueQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(ContestQueueTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(ContestQueueTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContestQueueTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the game_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGameId(1234); // WHERE game_id = 1234
     * $query->filterByGameId(array(12, 34)); // WHERE game_id IN (12, 34)
     * $query->filterByGameId(array('min' => 12)); // WHERE game_id > 12
     * </code>
     *
     * @param     mixed $gameId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContestQueueQuery The current query, for fluid interface
     */
    public function filterByGameId($gameId = null, $comparison = null)
    {
        if (is_array($gameId)) {
            $useMinMax = false;
            if (isset($gameId['min'])) {
                $this->addUsingAlias(ContestQueueTableMap::COL_GAME_ID, $gameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameId['max'])) {
                $this->addUsingAlias(ContestQueueTableMap::COL_GAME_ID, $gameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContestQueueTableMap::COL_GAME_ID, $gameId, $comparison);
    }

    /**
     * Filter the query on the platform_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPlatformId(1234); // WHERE platform_id = 1234
     * $query->filterByPlatformId(array(12, 34)); // WHERE platform_id IN (12, 34)
     * $query->filterByPlatformId(array('min' => 12)); // WHERE platform_id > 12
     * </code>
     *
     * @param     mixed $platformId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContestQueueQuery The current query, for fluid interface
     */
    public function filterByPlatformId($platformId = null, $comparison = null)
    {
        if (is_array($platformId)) {
            $useMinMax = false;
            if (isset($platformId['min'])) {
                $this->addUsingAlias(ContestQueueTableMap::COL_PLATFORM_ID, $platformId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($platformId['max'])) {
                $this->addUsingAlias(ContestQueueTableMap::COL_PLATFORM_ID, $platformId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContestQueueTableMap::COL_PLATFORM_ID, $platformId, $comparison);
    }

    /**
     * Filter the query on the message column
     *
     * Example usage:
     * <code>
     * $query->filterByMessage('fooValue');   // WHERE message = 'fooValue'
     * $query->filterByMessage('%fooValue%'); // WHERE message LIKE '%fooValue%'
     * </code>
     *
     * @param     string $message The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContestQueueQuery The current query, for fluid interface
     */
    public function filterByMessage($message = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($message)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $message)) {
                $message = str_replace('*', '%', $message);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ContestQueueTableMap::COL_MESSAGE, $message, $comparison);
    }

    /**
     * Filter the query on the assigned_user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAssignedUserId(1234); // WHERE assigned_user_id = 1234
     * $query->filterByAssignedUserId(array(12, 34)); // WHERE assigned_user_id IN (12, 34)
     * $query->filterByAssignedUserId(array('min' => 12)); // WHERE assigned_user_id > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $assignedUserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContestQueueQuery The current query, for fluid interface
     */
    public function filterByAssignedUserId($assignedUserId = null, $comparison = null)
    {
        if (is_array($assignedUserId)) {
            $useMinMax = false;
            if (isset($assignedUserId['min'])) {
                $this->addUsingAlias(ContestQueueTableMap::COL_ASSIGNED_USER_ID, $assignedUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($assignedUserId['max'])) {
                $this->addUsingAlias(ContestQueueTableMap::COL_ASSIGNED_USER_ID, $assignedUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContestQueueTableMap::COL_ASSIGNED_USER_ID, $assignedUserId, $comparison);
    }

    /**
     * Filter the query on the resolved column
     *
     * Example usage:
     * <code>
     * $query->filterByResolved(true); // WHERE resolved = true
     * $query->filterByResolved('yes'); // WHERE resolved = true
     * </code>
     *
     * @param     boolean|string $resolved The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContestQueueQuery The current query, for fluid interface
     */
    public function filterByResolved($resolved = null, $comparison = null)
    {
        if (is_string($resolved)) {
            $resolved = in_array(strtolower($resolved), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ContestQueueTableMap::COL_RESOLVED, $resolved, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildContestQueueQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(ContestQueueTableMap::COL_ASSIGNED_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ContestQueueTableMap::COL_ASSIGNED_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildContestQueueQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildContestQueue $contestQueue Object to remove from the list of results
     *
     * @return $this|ChildContestQueueQuery The current query, for fluid interface
     */
    public function prune($contestQueue = null)
    {
        if ($contestQueue) {
            $this->addUsingAlias(ContestQueueTableMap::COL_ID, $contestQueue->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the contest_queue table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContestQueueTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ContestQueueTableMap::clearInstancePool();
            ContestQueueTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ContestQueueTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ContestQueueTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ContestQueueTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ContestQueueTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ContestQueueQuery
