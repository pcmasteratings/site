<?php

namespace Base;

use \GamePlatform as ChildGamePlatform;
use \GamePlatformQuery as ChildGamePlatformQuery;
use \Exception;
use \PDO;
use Map\GamePlatformTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'game_platform' table.
 *
 * 
 *
 * @method     ChildGamePlatformQuery orderByGameId($order = Criteria::ASC) Order by the game_id column
 * @method     ChildGamePlatformQuery orderByPlatformId($order = Criteria::ASC) Order by the platform_id column
 *
 * @method     ChildGamePlatformQuery groupByGameId() Group by the game_id column
 * @method     ChildGamePlatformQuery groupByPlatformId() Group by the platform_id column
 *
 * @method     ChildGamePlatformQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGamePlatformQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGamePlatformQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGamePlatformQuery leftJoinPlatform($relationAlias = null) Adds a LEFT JOIN clause to the query using the Platform relation
 * @method     ChildGamePlatformQuery rightJoinPlatform($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Platform relation
 * @method     ChildGamePlatformQuery innerJoinPlatform($relationAlias = null) Adds a INNER JOIN clause to the query using the Platform relation
 *
 * @method     ChildGamePlatformQuery leftJoinGame($relationAlias = null) Adds a LEFT JOIN clause to the query using the Game relation
 * @method     ChildGamePlatformQuery rightJoinGame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Game relation
 * @method     ChildGamePlatformQuery innerJoinGame($relationAlias = null) Adds a INNER JOIN clause to the query using the Game relation
 *
 * @method     \PlatformQuery|\GameQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGamePlatform findOne(ConnectionInterface $con = null) Return the first ChildGamePlatform matching the query
 * @method     ChildGamePlatform findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGamePlatform matching the query, or a new ChildGamePlatform object populated from the query conditions when no match is found
 *
 * @method     ChildGamePlatform findOneByGameId(string $game_id) Return the first ChildGamePlatform filtered by the game_id column
 * @method     ChildGamePlatform findOneByPlatformId(string $platform_id) Return the first ChildGamePlatform filtered by the platform_id column *

 * @method     ChildGamePlatform requirePk($key, ConnectionInterface $con = null) Return the ChildGamePlatform by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGamePlatform requireOne(ConnectionInterface $con = null) Return the first ChildGamePlatform matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGamePlatform requireOneByGameId(string $game_id) Return the first ChildGamePlatform filtered by the game_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGamePlatform requireOneByPlatformId(string $platform_id) Return the first ChildGamePlatform filtered by the platform_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGamePlatform[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGamePlatform objects based on current ModelCriteria
 * @method     ChildGamePlatform[]|ObjectCollection findByGameId(string $game_id) Return ChildGamePlatform objects filtered by the game_id column
 * @method     ChildGamePlatform[]|ObjectCollection findByPlatformId(string $platform_id) Return ChildGamePlatform objects filtered by the platform_id column
 * @method     ChildGamePlatform[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GamePlatformQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\GamePlatformQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\GamePlatform', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGamePlatformQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGamePlatformQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGamePlatformQuery) {
            return $criteria;
        }
        $query = new ChildGamePlatformQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$game_id, $platform_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildGamePlatform|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GamePlatformTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GamePlatformTableMap::DATABASE_NAME);
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
     * @return ChildGamePlatform A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT game_id, platform_id FROM game_platform WHERE game_id = :p0 AND platform_id = :p1';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);            
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildGamePlatform $obj */
            $obj = new ChildGamePlatform();
            $obj->hydrate($row);
            GamePlatformTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildGamePlatform|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildGamePlatformQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(GamePlatformTableMap::COL_GAME_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(GamePlatformTableMap::COL_PLATFORM_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGamePlatformQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(GamePlatformTableMap::COL_GAME_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(GamePlatformTableMap::COL_PLATFORM_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByGame()
     *
     * @param     mixed $gameId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGamePlatformQuery The current query, for fluid interface
     */
    public function filterByGameId($gameId = null, $comparison = null)
    {
        if (is_array($gameId)) {
            $useMinMax = false;
            if (isset($gameId['min'])) {
                $this->addUsingAlias(GamePlatformTableMap::COL_GAME_ID, $gameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameId['max'])) {
                $this->addUsingAlias(GamePlatformTableMap::COL_GAME_ID, $gameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamePlatformTableMap::COL_GAME_ID, $gameId, $comparison);
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
     * @see       filterByPlatform()
     *
     * @param     mixed $platformId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGamePlatformQuery The current query, for fluid interface
     */
    public function filterByPlatformId($platformId = null, $comparison = null)
    {
        if (is_array($platformId)) {
            $useMinMax = false;
            if (isset($platformId['min'])) {
                $this->addUsingAlias(GamePlatformTableMap::COL_PLATFORM_ID, $platformId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($platformId['max'])) {
                $this->addUsingAlias(GamePlatformTableMap::COL_PLATFORM_ID, $platformId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamePlatformTableMap::COL_PLATFORM_ID, $platformId, $comparison);
    }

    /**
     * Filter the query by a related \Platform object
     *
     * @param \Platform|ObjectCollection $platform The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGamePlatformQuery The current query, for fluid interface
     */
    public function filterByPlatform($platform, $comparison = null)
    {
        if ($platform instanceof \Platform) {
            return $this
                ->addUsingAlias(GamePlatformTableMap::COL_PLATFORM_ID, $platform->getId(), $comparison);
        } elseif ($platform instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GamePlatformTableMap::COL_PLATFORM_ID, $platform->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPlatform() only accepts arguments of type \Platform or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Platform relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGamePlatformQuery The current query, for fluid interface
     */
    public function joinPlatform($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Platform');

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
            $this->addJoinObject($join, 'Platform');
        }

        return $this;
    }

    /**
     * Use the Platform relation Platform object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PlatformQuery A secondary query class using the current class as primary query
     */
    public function usePlatformQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPlatform($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Platform', '\PlatformQuery');
    }

    /**
     * Filter the query by a related \Game object
     *
     * @param \Game|ObjectCollection $game The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGamePlatformQuery The current query, for fluid interface
     */
    public function filterByGame($game, $comparison = null)
    {
        if ($game instanceof \Game) {
            return $this
                ->addUsingAlias(GamePlatformTableMap::COL_GAME_ID, $game->getId(), $comparison);
        } elseif ($game instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GamePlatformTableMap::COL_GAME_ID, $game->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGame() only accepts arguments of type \Game or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Game relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGamePlatformQuery The current query, for fluid interface
     */
    public function joinGame($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Game');

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
            $this->addJoinObject($join, 'Game');
        }

        return $this;
    }

    /**
     * Use the Game relation Game object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GameQuery A secondary query class using the current class as primary query
     */
    public function useGameQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGame($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Game', '\GameQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGamePlatform $gamePlatform Object to remove from the list of results
     *
     * @return $this|ChildGamePlatformQuery The current query, for fluid interface
     */
    public function prune($gamePlatform = null)
    {
        if ($gamePlatform) {
            $this->addCond('pruneCond0', $this->getAliasedColName(GamePlatformTableMap::COL_GAME_ID), $gamePlatform->getGameId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(GamePlatformTableMap::COL_PLATFORM_ID), $gamePlatform->getPlatformId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the game_platform table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GamePlatformTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GamePlatformTableMap::clearInstancePool();
            GamePlatformTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GamePlatformTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GamePlatformTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            GamePlatformTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            GamePlatformTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GamePlatformQuery
