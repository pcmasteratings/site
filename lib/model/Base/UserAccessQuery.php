<?php

namespace Base;

use \UserAccess as ChildUserAccess;
use \UserAccessQuery as ChildUserAccessQuery;
use \Exception;
use \PDO;
use Map\UserAccessTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user_access' table.
 *
 * 
 *
 * @method     ChildUserAccessQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUserAccessQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUserAccessQuery orderByIpv4Address($order = Criteria::ASC) Order by the ipv4_address column
 * @method     ChildUserAccessQuery orderByUserAccessTypeId($order = Criteria::ASC) Order by the user_access_type_id column
 * @method     ChildUserAccessQuery orderByAccess($order = Criteria::ASC) Order by the access column
 *
 * @method     ChildUserAccessQuery groupById() Group by the id column
 * @method     ChildUserAccessQuery groupByUserId() Group by the user_id column
 * @method     ChildUserAccessQuery groupByIpv4Address() Group by the ipv4_address column
 * @method     ChildUserAccessQuery groupByUserAccessTypeId() Group by the user_access_type_id column
 * @method     ChildUserAccessQuery groupByAccess() Group by the access column
 *
 * @method     ChildUserAccessQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserAccessQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserAccessQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserAccessQuery leftJoinUserAccessType($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserAccessType relation
 * @method     ChildUserAccessQuery rightJoinUserAccessType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserAccessType relation
 * @method     ChildUserAccessQuery innerJoinUserAccessType($relationAlias = null) Adds a INNER JOIN clause to the query using the UserAccessType relation
 *
 * @method     ChildUserAccessQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildUserAccessQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildUserAccessQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     \UserAccessTypeQuery|\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserAccess findOne(ConnectionInterface $con = null) Return the first ChildUserAccess matching the query
 * @method     ChildUserAccess findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserAccess matching the query, or a new ChildUserAccess object populated from the query conditions when no match is found
 *
 * @method     ChildUserAccess findOneById(string $id) Return the first ChildUserAccess filtered by the id column
 * @method     ChildUserAccess findOneByUserId(string $user_id) Return the first ChildUserAccess filtered by the user_id column
 * @method     ChildUserAccess findOneByIpv4Address(string $ipv4_address) Return the first ChildUserAccess filtered by the ipv4_address column
 * @method     ChildUserAccess findOneByUserAccessTypeId(string $user_access_type_id) Return the first ChildUserAccess filtered by the user_access_type_id column
 * @method     ChildUserAccess findOneByAccess(string $access) Return the first ChildUserAccess filtered by the access column *

 * @method     ChildUserAccess requirePk($key, ConnectionInterface $con = null) Return the ChildUserAccess by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAccess requireOne(ConnectionInterface $con = null) Return the first ChildUserAccess matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserAccess requireOneById(string $id) Return the first ChildUserAccess filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAccess requireOneByUserId(string $user_id) Return the first ChildUserAccess filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAccess requireOneByIpv4Address(string $ipv4_address) Return the first ChildUserAccess filtered by the ipv4_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAccess requireOneByUserAccessTypeId(string $user_access_type_id) Return the first ChildUserAccess filtered by the user_access_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAccess requireOneByAccess(string $access) Return the first ChildUserAccess filtered by the access column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserAccess[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserAccess objects based on current ModelCriteria
 * @method     ChildUserAccess[]|ObjectCollection findById(string $id) Return ChildUserAccess objects filtered by the id column
 * @method     ChildUserAccess[]|ObjectCollection findByUserId(string $user_id) Return ChildUserAccess objects filtered by the user_id column
 * @method     ChildUserAccess[]|ObjectCollection findByIpv4Address(string $ipv4_address) Return ChildUserAccess objects filtered by the ipv4_address column
 * @method     ChildUserAccess[]|ObjectCollection findByUserAccessTypeId(string $user_access_type_id) Return ChildUserAccess objects filtered by the user_access_type_id column
 * @method     ChildUserAccess[]|ObjectCollection findByAccess(string $access) Return ChildUserAccess objects filtered by the access column
 * @method     ChildUserAccess[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserAccessQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserAccessQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\UserAccess', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserAccessQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserAccessQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserAccessQuery) {
            return $criteria;
        }
        $query = new ChildUserAccessQuery();
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
     * @return ChildUserAccess|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserAccessTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserAccessTableMap::DATABASE_NAME);
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
     * @return ChildUserAccess A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user_id, ipv4_address, user_access_type_id, access FROM user_access WHERE id = :p0';
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
            /** @var ChildUserAccess $obj */
            $obj = new ChildUserAccess();
            $obj->hydrate($row);
            UserAccessTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUserAccess|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserAccessQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserAccessTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserAccessQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserAccessTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUserAccessQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UserAccessTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserAccessTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAccessTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUserAccessQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UserAccessTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserAccessTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAccessTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the ipv4_address column
     *
     * Example usage:
     * <code>
     * $query->filterByIpv4Address('fooValue');   // WHERE ipv4_address = 'fooValue'
     * $query->filterByIpv4Address('%fooValue%'); // WHERE ipv4_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ipv4Address The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAccessQuery The current query, for fluid interface
     */
    public function filterByIpv4Address($ipv4Address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ipv4Address)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ipv4Address)) {
                $ipv4Address = str_replace('*', '%', $ipv4Address);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserAccessTableMap::COL_IPV4_ADDRESS, $ipv4Address, $comparison);
    }

    /**
     * Filter the query on the user_access_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserAccessTypeId(1234); // WHERE user_access_type_id = 1234
     * $query->filterByUserAccessTypeId(array(12, 34)); // WHERE user_access_type_id IN (12, 34)
     * $query->filterByUserAccessTypeId(array('min' => 12)); // WHERE user_access_type_id > 12
     * </code>
     *
     * @see       filterByUserAccessType()
     *
     * @param     mixed $userAccessTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAccessQuery The current query, for fluid interface
     */
    public function filterByUserAccessTypeId($userAccessTypeId = null, $comparison = null)
    {
        if (is_array($userAccessTypeId)) {
            $useMinMax = false;
            if (isset($userAccessTypeId['min'])) {
                $this->addUsingAlias(UserAccessTableMap::COL_USER_ACCESS_TYPE_ID, $userAccessTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userAccessTypeId['max'])) {
                $this->addUsingAlias(UserAccessTableMap::COL_USER_ACCESS_TYPE_ID, $userAccessTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAccessTableMap::COL_USER_ACCESS_TYPE_ID, $userAccessTypeId, $comparison);
    }

    /**
     * Filter the query on the access column
     *
     * Example usage:
     * <code>
     * $query->filterByAccess('2011-03-14'); // WHERE access = '2011-03-14'
     * $query->filterByAccess('now'); // WHERE access = '2011-03-14'
     * $query->filterByAccess(array('max' => 'yesterday')); // WHERE access > '2011-03-13'
     * </code>
     *
     * @param     mixed $access The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAccessQuery The current query, for fluid interface
     */
    public function filterByAccess($access = null, $comparison = null)
    {
        if (is_array($access)) {
            $useMinMax = false;
            if (isset($access['min'])) {
                $this->addUsingAlias(UserAccessTableMap::COL_ACCESS, $access['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($access['max'])) {
                $this->addUsingAlias(UserAccessTableMap::COL_ACCESS, $access['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAccessTableMap::COL_ACCESS, $access, $comparison);
    }

    /**
     * Filter the query by a related \UserAccessType object
     *
     * @param \UserAccessType|ObjectCollection $userAccessType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserAccessQuery The current query, for fluid interface
     */
    public function filterByUserAccessType($userAccessType, $comparison = null)
    {
        if ($userAccessType instanceof \UserAccessType) {
            return $this
                ->addUsingAlias(UserAccessTableMap::COL_USER_ACCESS_TYPE_ID, $userAccessType->getId(), $comparison);
        } elseif ($userAccessType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserAccessTableMap::COL_USER_ACCESS_TYPE_ID, $userAccessType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserAccessType() only accepts arguments of type \UserAccessType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserAccessType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserAccessQuery The current query, for fluid interface
     */
    public function joinUserAccessType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserAccessType');

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
            $this->addJoinObject($join, 'UserAccessType');
        }

        return $this;
    }

    /**
     * Use the UserAccessType relation UserAccessType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserAccessTypeQuery A secondary query class using the current class as primary query
     */
    public function useUserAccessTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserAccessType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserAccessType', '\UserAccessTypeQuery');
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserAccessQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(UserAccessTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserAccessTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildUserAccessQuery The current query, for fluid interface
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
     * @param   ChildUserAccess $userAccess Object to remove from the list of results
     *
     * @return $this|ChildUserAccessQuery The current query, for fluid interface
     */
    public function prune($userAccess = null)
    {
        if ($userAccess) {
            $this->addUsingAlias(UserAccessTableMap::COL_ID, $userAccess->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user_access table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserAccessTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserAccessTableMap::clearInstancePool();
            UserAccessTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserAccessTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserAccessTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            UserAccessTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            UserAccessTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserAccessQuery
