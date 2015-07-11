<?php

namespace Base;

use \UserAccessType as ChildUserAccessType;
use \UserAccessTypeQuery as ChildUserAccessTypeQuery;
use \Exception;
use \PDO;
use Map\UserAccessTypeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user_access_type' table.
 *
 * 
 *
 * @method     ChildUserAccessTypeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUserAccessTypeQuery orderByType($order = Criteria::ASC) Order by the type column
 *
 * @method     ChildUserAccessTypeQuery groupById() Group by the id column
 * @method     ChildUserAccessTypeQuery groupByType() Group by the type column
 *
 * @method     ChildUserAccessTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserAccessTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserAccessTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserAccessTypeQuery leftJoinUserAccess($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserAccess relation
 * @method     ChildUserAccessTypeQuery rightJoinUserAccess($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserAccess relation
 * @method     ChildUserAccessTypeQuery innerJoinUserAccess($relationAlias = null) Adds a INNER JOIN clause to the query using the UserAccess relation
 *
 * @method     \UserAccessQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserAccessType findOne(ConnectionInterface $con = null) Return the first ChildUserAccessType matching the query
 * @method     ChildUserAccessType findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserAccessType matching the query, or a new ChildUserAccessType object populated from the query conditions when no match is found
 *
 * @method     ChildUserAccessType findOneById(string $id) Return the first ChildUserAccessType filtered by the id column
 * @method     ChildUserAccessType findOneByType(string $type) Return the first ChildUserAccessType filtered by the type column *

 * @method     ChildUserAccessType requirePk($key, ConnectionInterface $con = null) Return the ChildUserAccessType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAccessType requireOne(ConnectionInterface $con = null) Return the first ChildUserAccessType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserAccessType requireOneById(string $id) Return the first ChildUserAccessType filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserAccessType requireOneByType(string $type) Return the first ChildUserAccessType filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserAccessType[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserAccessType objects based on current ModelCriteria
 * @method     ChildUserAccessType[]|ObjectCollection findById(string $id) Return ChildUserAccessType objects filtered by the id column
 * @method     ChildUserAccessType[]|ObjectCollection findByType(string $type) Return ChildUserAccessType objects filtered by the type column
 * @method     ChildUserAccessType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserAccessTypeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserAccessTypeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\UserAccessType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserAccessTypeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserAccessTypeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserAccessTypeQuery) {
            return $criteria;
        }
        $query = new ChildUserAccessTypeQuery();
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
     * @return ChildUserAccessType|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserAccessTypeTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserAccessTypeTableMap::DATABASE_NAME);
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
     * @return ChildUserAccessType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, type FROM user_access_type WHERE id = :p0';
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
            /** @var ChildUserAccessType $obj */
            $obj = new ChildUserAccessType();
            $obj->hydrate($row);
            UserAccessTypeTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUserAccessType|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserAccessTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserAccessTypeTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserAccessTypeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserAccessTypeTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUserAccessTypeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UserAccessTypeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserAccessTypeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserAccessTypeTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserAccessTypeQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserAccessTypeTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query by a related \UserAccess object
     *
     * @param \UserAccess|ObjectCollection $userAccess the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUserAccessTypeQuery The current query, for fluid interface
     */
    public function filterByUserAccess($userAccess, $comparison = null)
    {
        if ($userAccess instanceof \UserAccess) {
            return $this
                ->addUsingAlias(UserAccessTypeTableMap::COL_ID, $userAccess->getUserAccessTypeId(), $comparison);
        } elseif ($userAccess instanceof ObjectCollection) {
            return $this
                ->useUserAccessQuery()
                ->filterByPrimaryKeys($userAccess->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserAccess() only accepts arguments of type \UserAccess or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserAccess relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserAccessTypeQuery The current query, for fluid interface
     */
    public function joinUserAccess($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserAccess');

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
            $this->addJoinObject($join, 'UserAccess');
        }

        return $this;
    }

    /**
     * Use the UserAccess relation UserAccess object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserAccessQuery A secondary query class using the current class as primary query
     */
    public function useUserAccessQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserAccess($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserAccess', '\UserAccessQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUserAccessType $userAccessType Object to remove from the list of results
     *
     * @return $this|ChildUserAccessTypeQuery The current query, for fluid interface
     */
    public function prune($userAccessType = null)
    {
        if ($userAccessType) {
            $this->addUsingAlias(UserAccessTypeTableMap::COL_ID, $userAccessType->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user_access_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserAccessTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserAccessTypeTableMap::clearInstancePool();
            UserAccessTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserAccessTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserAccessTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            UserAccessTypeTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            UserAccessTypeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserAccessTypeQuery
