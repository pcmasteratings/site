<?php

namespace Base;

use \RigAttributeValues as ChildRigAttributeValues;
use \RigAttributeValuesQuery as ChildRigAttributeValuesQuery;
use \Exception;
use \PDO;
use Map\RigAttributeValuesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'rig_attribute_values' table.
 *
 * 
 *
 * @method     ChildRigAttributeValuesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRigAttributeValuesQuery orderByRigId($order = Criteria::ASC) Order by the rig_id column
 * @method     ChildRigAttributeValuesQuery orderByRigAttributeId($order = Criteria::ASC) Order by the rig_attribute_id column
 * @method     ChildRigAttributeValuesQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method     ChildRigAttributeValuesQuery groupById() Group by the id column
 * @method     ChildRigAttributeValuesQuery groupByRigId() Group by the rig_id column
 * @method     ChildRigAttributeValuesQuery groupByRigAttributeId() Group by the rig_attribute_id column
 * @method     ChildRigAttributeValuesQuery groupByValue() Group by the value column
 *
 * @method     ChildRigAttributeValuesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRigAttributeValuesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRigAttributeValuesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRigAttributeValuesQuery leftJoinRigs($relationAlias = null) Adds a LEFT JOIN clause to the query using the Rigs relation
 * @method     ChildRigAttributeValuesQuery rightJoinRigs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Rigs relation
 * @method     ChildRigAttributeValuesQuery innerJoinRigs($relationAlias = null) Adds a INNER JOIN clause to the query using the Rigs relation
 *
 * @method     ChildRigAttributeValuesQuery leftJoinRigAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the RigAttributes relation
 * @method     ChildRigAttributeValuesQuery rightJoinRigAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RigAttributes relation
 * @method     ChildRigAttributeValuesQuery innerJoinRigAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the RigAttributes relation
 *
 * @method     \RigsQuery|\RigAttributesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRigAttributeValues findOne(ConnectionInterface $con = null) Return the first ChildRigAttributeValues matching the query
 * @method     ChildRigAttributeValues findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRigAttributeValues matching the query, or a new ChildRigAttributeValues object populated from the query conditions when no match is found
 *
 * @method     ChildRigAttributeValues findOneById(string $id) Return the first ChildRigAttributeValues filtered by the id column
 * @method     ChildRigAttributeValues findOneByRigId(string $rig_id) Return the first ChildRigAttributeValues filtered by the rig_id column
 * @method     ChildRigAttributeValues findOneByRigAttributeId(string $rig_attribute_id) Return the first ChildRigAttributeValues filtered by the rig_attribute_id column
 * @method     ChildRigAttributeValues findOneByValue(string $value) Return the first ChildRigAttributeValues filtered by the value column *

 * @method     ChildRigAttributeValues requirePk($key, ConnectionInterface $con = null) Return the ChildRigAttributeValues by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRigAttributeValues requireOne(ConnectionInterface $con = null) Return the first ChildRigAttributeValues matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRigAttributeValues requireOneById(string $id) Return the first ChildRigAttributeValues filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRigAttributeValues requireOneByRigId(string $rig_id) Return the first ChildRigAttributeValues filtered by the rig_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRigAttributeValues requireOneByRigAttributeId(string $rig_attribute_id) Return the first ChildRigAttributeValues filtered by the rig_attribute_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRigAttributeValues requireOneByValue(string $value) Return the first ChildRigAttributeValues filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRigAttributeValues[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRigAttributeValues objects based on current ModelCriteria
 * @method     ChildRigAttributeValues[]|ObjectCollection findById(string $id) Return ChildRigAttributeValues objects filtered by the id column
 * @method     ChildRigAttributeValues[]|ObjectCollection findByRigId(string $rig_id) Return ChildRigAttributeValues objects filtered by the rig_id column
 * @method     ChildRigAttributeValues[]|ObjectCollection findByRigAttributeId(string $rig_attribute_id) Return ChildRigAttributeValues objects filtered by the rig_attribute_id column
 * @method     ChildRigAttributeValues[]|ObjectCollection findByValue(string $value) Return ChildRigAttributeValues objects filtered by the value column
 * @method     ChildRigAttributeValues[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RigAttributeValuesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RigAttributeValuesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\RigAttributeValues', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRigAttributeValuesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRigAttributeValuesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRigAttributeValuesQuery) {
            return $criteria;
        }
        $query = new ChildRigAttributeValuesQuery();
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
     * @return ChildRigAttributeValues|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RigAttributeValuesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RigAttributeValuesTableMap::DATABASE_NAME);
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
     * @return ChildRigAttributeValues A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, rig_id, rig_attribute_id, value FROM rig_attribute_values WHERE id = :p0';
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
            /** @var ChildRigAttributeValues $obj */
            $obj = new ChildRigAttributeValues();
            $obj->hydrate($row);
            RigAttributeValuesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildRigAttributeValues|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRigAttributeValuesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RigAttributeValuesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRigAttributeValuesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RigAttributeValuesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRigAttributeValuesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RigAttributeValuesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RigAttributeValuesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RigAttributeValuesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the rig_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRigId(1234); // WHERE rig_id = 1234
     * $query->filterByRigId(array(12, 34)); // WHERE rig_id IN (12, 34)
     * $query->filterByRigId(array('min' => 12)); // WHERE rig_id > 12
     * </code>
     *
     * @see       filterByRigs()
     *
     * @param     mixed $rigId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRigAttributeValuesQuery The current query, for fluid interface
     */
    public function filterByRigId($rigId = null, $comparison = null)
    {
        if (is_array($rigId)) {
            $useMinMax = false;
            if (isset($rigId['min'])) {
                $this->addUsingAlias(RigAttributeValuesTableMap::COL_RIG_ID, $rigId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rigId['max'])) {
                $this->addUsingAlias(RigAttributeValuesTableMap::COL_RIG_ID, $rigId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RigAttributeValuesTableMap::COL_RIG_ID, $rigId, $comparison);
    }

    /**
     * Filter the query on the rig_attribute_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRigAttributeId(1234); // WHERE rig_attribute_id = 1234
     * $query->filterByRigAttributeId(array(12, 34)); // WHERE rig_attribute_id IN (12, 34)
     * $query->filterByRigAttributeId(array('min' => 12)); // WHERE rig_attribute_id > 12
     * </code>
     *
     * @see       filterByRigAttributes()
     *
     * @param     mixed $rigAttributeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRigAttributeValuesQuery The current query, for fluid interface
     */
    public function filterByRigAttributeId($rigAttributeId = null, $comparison = null)
    {
        if (is_array($rigAttributeId)) {
            $useMinMax = false;
            if (isset($rigAttributeId['min'])) {
                $this->addUsingAlias(RigAttributeValuesTableMap::COL_RIG_ATTRIBUTE_ID, $rigAttributeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rigAttributeId['max'])) {
                $this->addUsingAlias(RigAttributeValuesTableMap::COL_RIG_ATTRIBUTE_ID, $rigAttributeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RigAttributeValuesTableMap::COL_RIG_ATTRIBUTE_ID, $rigAttributeId, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
     * $query->filterByValue('%fooValue%'); // WHERE value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $value The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRigAttributeValuesQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($value)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $value)) {
                $value = str_replace('*', '%', $value);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RigAttributeValuesTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query by a related \Rigs object
     *
     * @param \Rigs|ObjectCollection $rigs The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRigAttributeValuesQuery The current query, for fluid interface
     */
    public function filterByRigs($rigs, $comparison = null)
    {
        if ($rigs instanceof \Rigs) {
            return $this
                ->addUsingAlias(RigAttributeValuesTableMap::COL_RIG_ID, $rigs->getId(), $comparison);
        } elseif ($rigs instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RigAttributeValuesTableMap::COL_RIG_ID, $rigs->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildRigAttributeValuesQuery The current query, for fluid interface
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
     * Filter the query by a related \RigAttributes object
     *
     * @param \RigAttributes|ObjectCollection $rigAttributes The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRigAttributeValuesQuery The current query, for fluid interface
     */
    public function filterByRigAttributes($rigAttributes, $comparison = null)
    {
        if ($rigAttributes instanceof \RigAttributes) {
            return $this
                ->addUsingAlias(RigAttributeValuesTableMap::COL_RIG_ATTRIBUTE_ID, $rigAttributes->getId(), $comparison);
        } elseif ($rigAttributes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RigAttributeValuesTableMap::COL_RIG_ATTRIBUTE_ID, $rigAttributes->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRigAttributes() only accepts arguments of type \RigAttributes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RigAttributes relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRigAttributeValuesQuery The current query, for fluid interface
     */
    public function joinRigAttributes($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RigAttributes');

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
            $this->addJoinObject($join, 'RigAttributes');
        }

        return $this;
    }

    /**
     * Use the RigAttributes relation RigAttributes object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RigAttributesQuery A secondary query class using the current class as primary query
     */
    public function useRigAttributesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRigAttributes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RigAttributes', '\RigAttributesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRigAttributeValues $rigAttributeValues Object to remove from the list of results
     *
     * @return $this|ChildRigAttributeValuesQuery The current query, for fluid interface
     */
    public function prune($rigAttributeValues = null)
    {
        if ($rigAttributeValues) {
            $this->addUsingAlias(RigAttributeValuesTableMap::COL_ID, $rigAttributeValues->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rig_attribute_values table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RigAttributeValuesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RigAttributeValuesTableMap::clearInstancePool();
            RigAttributeValuesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RigAttributeValuesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RigAttributeValuesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            RigAttributeValuesTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            RigAttributeValuesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RigAttributeValuesQuery
