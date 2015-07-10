<?php

namespace Base;

use \RigAttributeValue as ChildRigAttributeValue;
use \RigAttributeValueQuery as ChildRigAttributeValueQuery;
use \Exception;
use \PDO;
use Map\RigAttributeValueTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'rig_attribute_value' table.
 *
 * 
 *
 * @method     ChildRigAttributeValueQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRigAttributeValueQuery orderByRigId($order = Criteria::ASC) Order by the rig_id column
 * @method     ChildRigAttributeValueQuery orderByRigAttributeId($order = Criteria::ASC) Order by the rig_attribute_id column
 * @method     ChildRigAttributeValueQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method     ChildRigAttributeValueQuery groupById() Group by the id column
 * @method     ChildRigAttributeValueQuery groupByRigId() Group by the rig_id column
 * @method     ChildRigAttributeValueQuery groupByRigAttributeId() Group by the rig_attribute_id column
 * @method     ChildRigAttributeValueQuery groupByValue() Group by the value column
 *
 * @method     ChildRigAttributeValueQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRigAttributeValueQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRigAttributeValueQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRigAttributeValueQuery leftJoinRig($relationAlias = null) Adds a LEFT JOIN clause to the query using the Rig relation
 * @method     ChildRigAttributeValueQuery rightJoinRig($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Rig relation
 * @method     ChildRigAttributeValueQuery innerJoinRig($relationAlias = null) Adds a INNER JOIN clause to the query using the Rig relation
 *
 * @method     ChildRigAttributeValueQuery leftJoinRigAttribute($relationAlias = null) Adds a LEFT JOIN clause to the query using the RigAttribute relation
 * @method     ChildRigAttributeValueQuery rightJoinRigAttribute($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RigAttribute relation
 * @method     ChildRigAttributeValueQuery innerJoinRigAttribute($relationAlias = null) Adds a INNER JOIN clause to the query using the RigAttribute relation
 *
 * @method     \RigQuery|\RigAttributeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRigAttributeValue findOne(ConnectionInterface $con = null) Return the first ChildRigAttributeValue matching the query
 * @method     ChildRigAttributeValue findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRigAttributeValue matching the query, or a new ChildRigAttributeValue object populated from the query conditions when no match is found
 *
 * @method     ChildRigAttributeValue findOneById(string $id) Return the first ChildRigAttributeValue filtered by the id column
 * @method     ChildRigAttributeValue findOneByRigId(string $rig_id) Return the first ChildRigAttributeValue filtered by the rig_id column
 * @method     ChildRigAttributeValue findOneByRigAttributeId(string $rig_attribute_id) Return the first ChildRigAttributeValue filtered by the rig_attribute_id column
 * @method     ChildRigAttributeValue findOneByValue(string $value) Return the first ChildRigAttributeValue filtered by the value column *

 * @method     ChildRigAttributeValue requirePk($key, ConnectionInterface $con = null) Return the ChildRigAttributeValue by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRigAttributeValue requireOne(ConnectionInterface $con = null) Return the first ChildRigAttributeValue matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRigAttributeValue requireOneById(string $id) Return the first ChildRigAttributeValue filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRigAttributeValue requireOneByRigId(string $rig_id) Return the first ChildRigAttributeValue filtered by the rig_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRigAttributeValue requireOneByRigAttributeId(string $rig_attribute_id) Return the first ChildRigAttributeValue filtered by the rig_attribute_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRigAttributeValue requireOneByValue(string $value) Return the first ChildRigAttributeValue filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRigAttributeValue[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRigAttributeValue objects based on current ModelCriteria
 * @method     ChildRigAttributeValue[]|ObjectCollection findById(string $id) Return ChildRigAttributeValue objects filtered by the id column
 * @method     ChildRigAttributeValue[]|ObjectCollection findByRigId(string $rig_id) Return ChildRigAttributeValue objects filtered by the rig_id column
 * @method     ChildRigAttributeValue[]|ObjectCollection findByRigAttributeId(string $rig_attribute_id) Return ChildRigAttributeValue objects filtered by the rig_attribute_id column
 * @method     ChildRigAttributeValue[]|ObjectCollection findByValue(string $value) Return ChildRigAttributeValue objects filtered by the value column
 * @method     ChildRigAttributeValue[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RigAttributeValueQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RigAttributeValueQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\RigAttributeValue', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRigAttributeValueQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRigAttributeValueQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRigAttributeValueQuery) {
            return $criteria;
        }
        $query = new ChildRigAttributeValueQuery();
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
     * @return ChildRigAttributeValue|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RigAttributeValueTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RigAttributeValueTableMap::DATABASE_NAME);
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
     * @return ChildRigAttributeValue A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, rig_id, rig_attribute_id, value FROM rig_attribute_value WHERE id = :p0';
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
            /** @var ChildRigAttributeValue $obj */
            $obj = new ChildRigAttributeValue();
            $obj->hydrate($row);
            RigAttributeValueTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildRigAttributeValue|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRigAttributeValueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RigAttributeValueTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRigAttributeValueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RigAttributeValueTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRigAttributeValueQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RigAttributeValueTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RigAttributeValueTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RigAttributeValueTableMap::COL_ID, $id, $comparison);
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
     * @see       filterByRig()
     *
     * @param     mixed $rigId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRigAttributeValueQuery The current query, for fluid interface
     */
    public function filterByRigId($rigId = null, $comparison = null)
    {
        if (is_array($rigId)) {
            $useMinMax = false;
            if (isset($rigId['min'])) {
                $this->addUsingAlias(RigAttributeValueTableMap::COL_RIG_ID, $rigId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rigId['max'])) {
                $this->addUsingAlias(RigAttributeValueTableMap::COL_RIG_ID, $rigId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RigAttributeValueTableMap::COL_RIG_ID, $rigId, $comparison);
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
     * @see       filterByRigAttribute()
     *
     * @param     mixed $rigAttributeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRigAttributeValueQuery The current query, for fluid interface
     */
    public function filterByRigAttributeId($rigAttributeId = null, $comparison = null)
    {
        if (is_array($rigAttributeId)) {
            $useMinMax = false;
            if (isset($rigAttributeId['min'])) {
                $this->addUsingAlias(RigAttributeValueTableMap::COL_RIG_ATTRIBUTE_ID, $rigAttributeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rigAttributeId['max'])) {
                $this->addUsingAlias(RigAttributeValueTableMap::COL_RIG_ATTRIBUTE_ID, $rigAttributeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RigAttributeValueTableMap::COL_RIG_ATTRIBUTE_ID, $rigAttributeId, $comparison);
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
     * @return $this|ChildRigAttributeValueQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RigAttributeValueTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query by a related \Rig object
     *
     * @param \Rig|ObjectCollection $rig The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRigAttributeValueQuery The current query, for fluid interface
     */
    public function filterByRig($rig, $comparison = null)
    {
        if ($rig instanceof \Rig) {
            return $this
                ->addUsingAlias(RigAttributeValueTableMap::COL_RIG_ID, $rig->getId(), $comparison);
        } elseif ($rig instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RigAttributeValueTableMap::COL_RIG_ID, $rig->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRig() only accepts arguments of type \Rig or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Rig relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRigAttributeValueQuery The current query, for fluid interface
     */
    public function joinRig($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Rig');

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
            $this->addJoinObject($join, 'Rig');
        }

        return $this;
    }

    /**
     * Use the Rig relation Rig object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RigQuery A secondary query class using the current class as primary query
     */
    public function useRigQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRig($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Rig', '\RigQuery');
    }

    /**
     * Filter the query by a related \RigAttribute object
     *
     * @param \RigAttribute|ObjectCollection $rigAttribute The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRigAttributeValueQuery The current query, for fluid interface
     */
    public function filterByRigAttribute($rigAttribute, $comparison = null)
    {
        if ($rigAttribute instanceof \RigAttribute) {
            return $this
                ->addUsingAlias(RigAttributeValueTableMap::COL_RIG_ATTRIBUTE_ID, $rigAttribute->getId(), $comparison);
        } elseif ($rigAttribute instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RigAttributeValueTableMap::COL_RIG_ATTRIBUTE_ID, $rigAttribute->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRigAttribute() only accepts arguments of type \RigAttribute or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RigAttribute relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRigAttributeValueQuery The current query, for fluid interface
     */
    public function joinRigAttribute($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RigAttribute');

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
            $this->addJoinObject($join, 'RigAttribute');
        }

        return $this;
    }

    /**
     * Use the RigAttribute relation RigAttribute object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RigAttributeQuery A secondary query class using the current class as primary query
     */
    public function useRigAttributeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRigAttribute($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RigAttribute', '\RigAttributeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRigAttributeValue $rigAttributeValue Object to remove from the list of results
     *
     * @return $this|ChildRigAttributeValueQuery The current query, for fluid interface
     */
    public function prune($rigAttributeValue = null)
    {
        if ($rigAttributeValue) {
            $this->addUsingAlias(RigAttributeValueTableMap::COL_ID, $rigAttributeValue->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rig_attribute_value table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RigAttributeValueTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RigAttributeValueTableMap::clearInstancePool();
            RigAttributeValueTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RigAttributeValueTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RigAttributeValueTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            RigAttributeValueTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            RigAttributeValueTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RigAttributeValueQuery
