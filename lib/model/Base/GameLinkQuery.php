<?php

namespace Base;

use \GameLink as ChildGameLink;
use \GameLinkQuery as ChildGameLinkQuery;
use \Exception;
use \PDO;
use Map\GameLinkTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'game_link' table.
 *
 * 
 *
 * @method     ChildGameLinkQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGameLinkQuery orderByGameId($order = Criteria::ASC) Order by the game_id column
 * @method     ChildGameLinkQuery orderByGameLinkTypeId($order = Criteria::ASC) Order by the game_link_type_id column
 * @method     ChildGameLinkQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method     ChildGameLinkQuery groupById() Group by the id column
 * @method     ChildGameLinkQuery groupByGameId() Group by the game_id column
 * @method     ChildGameLinkQuery groupByGameLinkTypeId() Group by the game_link_type_id column
 * @method     ChildGameLinkQuery groupByValue() Group by the value column
 *
 * @method     ChildGameLinkQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGameLinkQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGameLinkQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGameLinkQuery leftJoinGame($relationAlias = null) Adds a LEFT JOIN clause to the query using the Game relation
 * @method     ChildGameLinkQuery rightJoinGame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Game relation
 * @method     ChildGameLinkQuery innerJoinGame($relationAlias = null) Adds a INNER JOIN clause to the query using the Game relation
 *
 * @method     ChildGameLinkQuery leftJoinGameLinkType($relationAlias = null) Adds a LEFT JOIN clause to the query using the GameLinkType relation
 * @method     ChildGameLinkQuery rightJoinGameLinkType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GameLinkType relation
 * @method     ChildGameLinkQuery innerJoinGameLinkType($relationAlias = null) Adds a INNER JOIN clause to the query using the GameLinkType relation
 *
 * @method     \GameQuery|\GameLinkTypeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGameLink findOne(ConnectionInterface $con = null) Return the first ChildGameLink matching the query
 * @method     ChildGameLink findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGameLink matching the query, or a new ChildGameLink object populated from the query conditions when no match is found
 *
 * @method     ChildGameLink findOneById(string $id) Return the first ChildGameLink filtered by the id column
 * @method     ChildGameLink findOneByGameId(string $game_id) Return the first ChildGameLink filtered by the game_id column
 * @method     ChildGameLink findOneByGameLinkTypeId(string $game_link_type_id) Return the first ChildGameLink filtered by the game_link_type_id column
 * @method     ChildGameLink findOneByValue(string $value) Return the first ChildGameLink filtered by the value column *

 * @method     ChildGameLink requirePk($key, ConnectionInterface $con = null) Return the ChildGameLink by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGameLink requireOne(ConnectionInterface $con = null) Return the first ChildGameLink matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGameLink requireOneById(string $id) Return the first ChildGameLink filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGameLink requireOneByGameId(string $game_id) Return the first ChildGameLink filtered by the game_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGameLink requireOneByGameLinkTypeId(string $game_link_type_id) Return the first ChildGameLink filtered by the game_link_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGameLink requireOneByValue(string $value) Return the first ChildGameLink filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGameLink[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGameLink objects based on current ModelCriteria
 * @method     ChildGameLink[]|ObjectCollection findById(string $id) Return ChildGameLink objects filtered by the id column
 * @method     ChildGameLink[]|ObjectCollection findByGameId(string $game_id) Return ChildGameLink objects filtered by the game_id column
 * @method     ChildGameLink[]|ObjectCollection findByGameLinkTypeId(string $game_link_type_id) Return ChildGameLink objects filtered by the game_link_type_id column
 * @method     ChildGameLink[]|ObjectCollection findByValue(string $value) Return ChildGameLink objects filtered by the value column
 * @method     ChildGameLink[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GameLinkQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\GameLinkQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\GameLink', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGameLinkQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGameLinkQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGameLinkQuery) {
            return $criteria;
        }
        $query = new ChildGameLinkQuery();
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
     * @return ChildGameLink|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GameLinkTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GameLinkTableMap::DATABASE_NAME);
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
     * @return ChildGameLink A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, game_id, game_link_type_id, value FROM game_link WHERE id = :p0';
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
            /** @var ChildGameLink $obj */
            $obj = new ChildGameLink();
            $obj->hydrate($row);
            GameLinkTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildGameLink|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGameLinkQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GameLinkTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGameLinkQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GameLinkTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildGameLinkQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GameLinkTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GameLinkTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameLinkTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildGameLinkQuery The current query, for fluid interface
     */
    public function filterByGameId($gameId = null, $comparison = null)
    {
        if (is_array($gameId)) {
            $useMinMax = false;
            if (isset($gameId['min'])) {
                $this->addUsingAlias(GameLinkTableMap::COL_GAME_ID, $gameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameId['max'])) {
                $this->addUsingAlias(GameLinkTableMap::COL_GAME_ID, $gameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameLinkTableMap::COL_GAME_ID, $gameId, $comparison);
    }

    /**
     * Filter the query on the game_link_type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGameLinkTypeId(1234); // WHERE game_link_type_id = 1234
     * $query->filterByGameLinkTypeId(array(12, 34)); // WHERE game_link_type_id IN (12, 34)
     * $query->filterByGameLinkTypeId(array('min' => 12)); // WHERE game_link_type_id > 12
     * </code>
     *
     * @see       filterByGameLinkType()
     *
     * @param     mixed $gameLinkTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGameLinkQuery The current query, for fluid interface
     */
    public function filterByGameLinkTypeId($gameLinkTypeId = null, $comparison = null)
    {
        if (is_array($gameLinkTypeId)) {
            $useMinMax = false;
            if (isset($gameLinkTypeId['min'])) {
                $this->addUsingAlias(GameLinkTableMap::COL_GAME_LINK_TYPE_ID, $gameLinkTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameLinkTypeId['max'])) {
                $this->addUsingAlias(GameLinkTableMap::COL_GAME_LINK_TYPE_ID, $gameLinkTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameLinkTableMap::COL_GAME_LINK_TYPE_ID, $gameLinkTypeId, $comparison);
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
     * @return $this|ChildGameLinkQuery The current query, for fluid interface
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

        return $this->addUsingAlias(GameLinkTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query by a related \Game object
     *
     * @param \Game|ObjectCollection $game The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGameLinkQuery The current query, for fluid interface
     */
    public function filterByGame($game, $comparison = null)
    {
        if ($game instanceof \Game) {
            return $this
                ->addUsingAlias(GameLinkTableMap::COL_GAME_ID, $game->getId(), $comparison);
        } elseif ($game instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GameLinkTableMap::COL_GAME_ID, $game->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildGameLinkQuery The current query, for fluid interface
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
     * Filter the query by a related \GameLinkType object
     *
     * @param \GameLinkType|ObjectCollection $gameLinkType The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGameLinkQuery The current query, for fluid interface
     */
    public function filterByGameLinkType($gameLinkType, $comparison = null)
    {
        if ($gameLinkType instanceof \GameLinkType) {
            return $this
                ->addUsingAlias(GameLinkTableMap::COL_GAME_LINK_TYPE_ID, $gameLinkType->getId(), $comparison);
        } elseif ($gameLinkType instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GameLinkTableMap::COL_GAME_LINK_TYPE_ID, $gameLinkType->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGameLinkType() only accepts arguments of type \GameLinkType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GameLinkType relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGameLinkQuery The current query, for fluid interface
     */
    public function joinGameLinkType($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GameLinkType');

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
            $this->addJoinObject($join, 'GameLinkType');
        }

        return $this;
    }

    /**
     * Use the GameLinkType relation GameLinkType object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GameLinkTypeQuery A secondary query class using the current class as primary query
     */
    public function useGameLinkTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGameLinkType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GameLinkType', '\GameLinkTypeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGameLink $gameLink Object to remove from the list of results
     *
     * @return $this|ChildGameLinkQuery The current query, for fluid interface
     */
    public function prune($gameLink = null)
    {
        if ($gameLink) {
            $this->addUsingAlias(GameLinkTableMap::COL_ID, $gameLink->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the game_link table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GameLinkTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GameLinkTableMap::clearInstancePool();
            GameLinkTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GameLinkTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GameLinkTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            GameLinkTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            GameLinkTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GameLinkQuery
