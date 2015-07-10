<?php

namespace Base;

use \RigAttribute as ChildRigAttribute;
use \RigAttributeQuery as ChildRigAttributeQuery;
use \Exception;
use \PDO;
use Map\RigAttributeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'rig_attribute' table.
 *
 * 
 *
 * @method     ChildRigAttributeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRigAttributeQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method     ChildRigAttributeQuery groupById() Group by the id column
 * @method     ChildRigAttributeQuery groupByName() Group by the name column
 *
 * @method     ChildRigAttributeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRigAttributeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRigAttributeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRigAttributeQuery leftJoinRigAttributeValue($relationAlias = null) Adds a LEFT JOIN clause to the query using the RigAttributeValue relation
 * @method     ChildRigAttributeQuery rightJoinRigAttributeValue($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RigAttributeValue relation
 * @method     ChildRigAttributeQuery innerJoinRigAttributeValue($relationAlias = null) Adds a INNER JOIN clause to the query using the RigAttributeValue relation
 *
 * @method     \RigAttributeValueQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRigAttribute findOne(ConnectionInterface $con = null) Return the first ChildRigAttribute matching the query
 * @method     ChildRigAttribute findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRigAttribute matching the query, or a new ChildRigAttribute object populated from the query conditions when no match is found
 *
 * @method     ChildRigAttribute findOneById(string $id) Return the first ChildRigAttribute filtered by the id column
 * @method     ChildRigAttribute findOneByName(string $name) Return the first ChildRigAttribute filtered by the name column *

 * @method     ChildRigAttribute requirePk($key, ConnectionInterface $con = null) Return the ChildRigAttribute by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRigAttribute requireOne(ConnectionInterface $con = null) Return the first ChildRigAttribute matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRigAttribute requireOneById(string $id) Return the first ChildRigAttribute filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRigAttribute requireOneByName(string $name) Return the first ChildRigAttribute filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRigAttribute[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRigAttribute objects based on current ModelCriteria
 * @method     ChildRigAttribute[]|ObjectCollection findById(string $id) Return ChildRigAttribute objects filtered by the id column
 * @method     ChildRigAttribute[]|ObjectCollection findByName(string $name) Return ChildRigAttribute objects filtered by the name column
 * @method     ChildRigAttribute[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RigAttributeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RigAttributeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\RigAttribute', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRigAttributeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRigAttributeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRigAttributeQuery) {
            return $criteria;
        }
        $query = new ChildRigAttributeQuery();
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
     * @return ChildRigAttribute|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RigAttributeTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RigAttributeTableMap::DATABASE_NAME);
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
     * @return ChildRigAttribute A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name FROM rig_attribute WHERE id = :p0';
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
            /** @var ChildRigAttribute $obj */
            $obj = new ChildRigAttribute();
            $obj->hydrate($row);
            RigAttributeTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildRigAttribute|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRigAttributeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RigAttributeTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRigAttributeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RigAttributeTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRigAttributeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RigAttributeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RigAttributeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RigAttributeTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName(1234); // WHERE name = 1234
     * $query->filterByName(array(12, 34)); // WHERE name IN (12, 34)
     * $query->filterByName(array('min' => 12)); // WHERE name > 12
     * </code>
     *
     * @param     mixed $name The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRigAttributeQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (is_array($name)) {
            $useMinMax = false;
            if (isset($name['min'])) {
                $this->addUsingAlias(RigAttributeTableMap::COL_NAME, $name['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($name['max'])) {
                $this->addUsingAlias(RigAttributeTableMap::COL_NAME, $name['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RigAttributeTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related \RigAttributeValue object
     *
     * @param \RigAttributeValue|ObjectCollection $rigAttributeValue the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRigAttributeQuery The current query, for fluid interface
     */
    public function filterByRigAttributeValue($rigAttributeValue, $comparison = null)
    {
        if ($rigAttributeValue instanceof \RigAttributeValue) {
            return $this
                ->addUsingAlias(RigAttributeTableMap::COL_ID, $rigAttributeValue->getRigAttributeId(), $comparison);
        } elseif ($rigAttributeValue instanceof ObjectCollection) {
            return $this
                ->useRigAttributeValueQuery()
                ->filterByPrimaryKeys($rigAttributeValue->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRigAttributeValue() only accepts arguments of type \RigAttributeValue or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RigAttributeValue relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRigAttributeQuery The current query, for fluid interface
     */
    public function joinRigAttributeValue($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RigAttributeValue');

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
            $this->addJoinObject($join, 'RigAttributeValue');
        }

        return $this;
    }

    /**
     * Use the RigAttributeValue relation RigAttributeValue object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RigAttributeValueQuery A secondary query class using the current class as primary query
     */
    public function useRigAttributeValueQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRigAttributeValue($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RigAttributeValue', '\RigAttributeValueQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRigAttribute $rigAttribute Object to remove from the list of results
     *
     * @return $this|ChildRigAttributeQuery The current query, for fluid interface
     */
    public function prune($rigAttribute = null)
    {
        if ($rigAttribute) {
            $this->addUsingAlias(RigAttributeTableMap::COL_ID, $rigAttribute->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rig_attribute table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RigAttributeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RigAttributeTableMap::clearInstancePool();
            RigAttributeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RigAttributeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RigAttributeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            RigAttributeTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            RigAttributeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RigAttributeQuery
