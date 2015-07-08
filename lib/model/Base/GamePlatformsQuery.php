<?php

namespace Base;

use \GamePlatforms as ChildGamePlatforms;
use \GamePlatformsQuery as ChildGamePlatformsQuery;
use \Exception;
use \PDO;
use Map\GamePlatformsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'game_platforms' table.
 *
 * 
 *
 * @method     ChildGamePlatformsQuery orderByGameId($order = Criteria::ASC) Order by the game_id column
 * @method     ChildGamePlatformsQuery orderByPlatformId($order = Criteria::ASC) Order by the platform_id column
 *
 * @method     ChildGamePlatformsQuery groupByGameId() Group by the game_id column
 * @method     ChildGamePlatformsQuery groupByPlatformId() Group by the platform_id column
 *
 * @method     ChildGamePlatformsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGamePlatformsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGamePlatformsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGamePlatformsQuery leftJoinPlatforms($relationAlias = null) Adds a LEFT JOIN clause to the query using the Platforms relation
 * @method     ChildGamePlatformsQuery rightJoinPlatforms($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Platforms relation
 * @method     ChildGamePlatformsQuery innerJoinPlatforms($relationAlias = null) Adds a INNER JOIN clause to the query using the Platforms relation
 *
 * @method     ChildGamePlatformsQuery leftJoinGames($relationAlias = null) Adds a LEFT JOIN clause to the query using the Games relation
 * @method     ChildGamePlatformsQuery rightJoinGames($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Games relation
 * @method     ChildGamePlatformsQuery innerJoinGames($relationAlias = null) Adds a INNER JOIN clause to the query using the Games relation
 *
 * @method     \PlatformsQuery|\GamesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGamePlatforms findOne(ConnectionInterface $con = null) Return the first ChildGamePlatforms matching the query
 * @method     ChildGamePlatforms findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGamePlatforms matching the query, or a new ChildGamePlatforms object populated from the query conditions when no match is found
 *
 * @method     ChildGamePlatforms findOneByGameId(string $game_id) Return the first ChildGamePlatforms filtered by the game_id column
 * @method     ChildGamePlatforms findOneByPlatformId(string $platform_id) Return the first ChildGamePlatforms filtered by the platform_id column *

 * @method     ChildGamePlatforms requirePk($key, ConnectionInterface $con = null) Return the ChildGamePlatforms by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGamePlatforms requireOne(ConnectionInterface $con = null) Return the first ChildGamePlatforms matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGamePlatforms requireOneByGameId(string $game_id) Return the first ChildGamePlatforms filtered by the game_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGamePlatforms requireOneByPlatformId(string $platform_id) Return the first ChildGamePlatforms filtered by the platform_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGamePlatforms[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGamePlatforms objects based on current ModelCriteria
 * @method     ChildGamePlatforms[]|ObjectCollection findByGameId(string $game_id) Return ChildGamePlatforms objects filtered by the game_id column
 * @method     ChildGamePlatforms[]|ObjectCollection findByPlatformId(string $platform_id) Return ChildGamePlatforms objects filtered by the platform_id column
 * @method     ChildGamePlatforms[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GamePlatformsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\GamePlatformsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\GamePlatforms', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGamePlatformsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGamePlatformsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGamePlatformsQuery) {
            return $criteria;
        }
        $query = new ChildGamePlatformsQuery();
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
     * @return ChildGamePlatforms|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GamePlatformsTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GamePlatformsTableMap::DATABASE_NAME);
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
     * @return ChildGamePlatforms A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT game_id, platform_id FROM game_platforms WHERE game_id = :p0 AND platform_id = :p1';
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
            /** @var ChildGamePlatforms $obj */
            $obj = new ChildGamePlatforms();
            $obj->hydrate($row);
            GamePlatformsTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildGamePlatforms|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGamePlatformsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(GamePlatformsTableMap::COL_GAME_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(GamePlatformsTableMap::COL_PLATFORM_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGamePlatformsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(GamePlatformsTableMap::COL_GAME_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(GamePlatformsTableMap::COL_PLATFORM_ID, $key[1], Criteria::EQUAL);
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
     * @see       filterByGames()
     *
     * @param     mixed $gameId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGamePlatformsQuery The current query, for fluid interface
     */
    public function filterByGameId($gameId = null, $comparison = null)
    {
        if (is_array($gameId)) {
            $useMinMax = false;
            if (isset($gameId['min'])) {
                $this->addUsingAlias(GamePlatformsTableMap::COL_GAME_ID, $gameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameId['max'])) {
                $this->addUsingAlias(GamePlatformsTableMap::COL_GAME_ID, $gameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamePlatformsTableMap::COL_GAME_ID, $gameId, $comparison);
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
     * @see       filterByPlatforms()
     *
     * @param     mixed $platformId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGamePlatformsQuery The current query, for fluid interface
     */
    public function filterByPlatformId($platformId = null, $comparison = null)
    {
        if (is_array($platformId)) {
            $useMinMax = false;
            if (isset($platformId['min'])) {
                $this->addUsingAlias(GamePlatformsTableMap::COL_PLATFORM_ID, $platformId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($platformId['max'])) {
                $this->addUsingAlias(GamePlatformsTableMap::COL_PLATFORM_ID, $platformId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamePlatformsTableMap::COL_PLATFORM_ID, $platformId, $comparison);
    }

    /**
     * Filter the query by a related \Platforms object
     *
     * @param \Platforms|ObjectCollection $platforms The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGamePlatformsQuery The current query, for fluid interface
     */
    public function filterByPlatforms($platforms, $comparison = null)
    {
        if ($platforms instanceof \Platforms) {
            return $this
                ->addUsingAlias(GamePlatformsTableMap::COL_PLATFORM_ID, $platforms->getId(), $comparison);
        } elseif ($platforms instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GamePlatformsTableMap::COL_PLATFORM_ID, $platforms->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPlatforms() only accepts arguments of type \Platforms or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Platforms relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGamePlatformsQuery The current query, for fluid interface
     */
    public function joinPlatforms($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Platforms');

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
            $this->addJoinObject($join, 'Platforms');
        }

        return $this;
    }

    /**
     * Use the Platforms relation Platforms object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PlatformsQuery A secondary query class using the current class as primary query
     */
    public function usePlatformsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPlatforms($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Platforms', '\PlatformsQuery');
    }

    /**
     * Filter the query by a related \Games object
     *
     * @param \Games|ObjectCollection $games The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGamePlatformsQuery The current query, for fluid interface
     */
    public function filterByGames($games, $comparison = null)
    {
        if ($games instanceof \Games) {
            return $this
                ->addUsingAlias(GamePlatformsTableMap::COL_GAME_ID, $games->getId(), $comparison);
        } elseif ($games instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GamePlatformsTableMap::COL_GAME_ID, $games->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGames() only accepts arguments of type \Games or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Games relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGamePlatformsQuery The current query, for fluid interface
     */
    public function joinGames($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Games');

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
            $this->addJoinObject($join, 'Games');
        }

        return $this;
    }

    /**
     * Use the Games relation Games object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GamesQuery A secondary query class using the current class as primary query
     */
    public function useGamesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGames($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Games', '\GamesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGamePlatforms $gamePlatforms Object to remove from the list of results
     *
     * @return $this|ChildGamePlatformsQuery The current query, for fluid interface
     */
    public function prune($gamePlatforms = null)
    {
        if ($gamePlatforms) {
            $this->addCond('pruneCond0', $this->getAliasedColName(GamePlatformsTableMap::COL_GAME_ID), $gamePlatforms->getGameId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(GamePlatformsTableMap::COL_PLATFORM_ID), $gamePlatforms->getPlatformId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the game_platforms table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GamePlatformsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GamePlatformsTableMap::clearInstancePool();
            GamePlatformsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GamePlatformsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GamePlatformsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            GamePlatformsTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            GamePlatformsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GamePlatformsQuery
