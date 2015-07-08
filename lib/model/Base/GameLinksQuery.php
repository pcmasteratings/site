<?php

namespace Base;

use \GameLinks as ChildGameLinks;
use \GameLinksQuery as ChildGameLinksQuery;
use \Exception;
use \PDO;
use Map\GameLinksTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'game_links' table.
 *
 * 
 *
 * @method     ChildGameLinksQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGameLinksQuery orderByGameId($order = Criteria::ASC) Order by the game_id column
 * @method     ChildGameLinksQuery orderByGameLinkTypeId($order = Criteria::ASC) Order by the game_link_type_id column
 * @method     ChildGameLinksQuery orderByValue($order = Criteria::ASC) Order by the value column
 *
 * @method     ChildGameLinksQuery groupById() Group by the id column
 * @method     ChildGameLinksQuery groupByGameId() Group by the game_id column
 * @method     ChildGameLinksQuery groupByGameLinkTypeId() Group by the game_link_type_id column
 * @method     ChildGameLinksQuery groupByValue() Group by the value column
 *
 * @method     ChildGameLinksQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGameLinksQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGameLinksQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGameLinksQuery leftJoinGames($relationAlias = null) Adds a LEFT JOIN clause to the query using the Games relation
 * @method     ChildGameLinksQuery rightJoinGames($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Games relation
 * @method     ChildGameLinksQuery innerJoinGames($relationAlias = null) Adds a INNER JOIN clause to the query using the Games relation
 *
 * @method     ChildGameLinksQuery leftJoinGameLinkTypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the GameLinkTypes relation
 * @method     ChildGameLinksQuery rightJoinGameLinkTypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GameLinkTypes relation
 * @method     ChildGameLinksQuery innerJoinGameLinkTypes($relationAlias = null) Adds a INNER JOIN clause to the query using the GameLinkTypes relation
 *
 * @method     \GamesQuery|\GameLinkTypesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGameLinks findOne(ConnectionInterface $con = null) Return the first ChildGameLinks matching the query
 * @method     ChildGameLinks findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGameLinks matching the query, or a new ChildGameLinks object populated from the query conditions when no match is found
 *
 * @method     ChildGameLinks findOneById(string $id) Return the first ChildGameLinks filtered by the id column
 * @method     ChildGameLinks findOneByGameId(string $game_id) Return the first ChildGameLinks filtered by the game_id column
 * @method     ChildGameLinks findOneByGameLinkTypeId(string $game_link_type_id) Return the first ChildGameLinks filtered by the game_link_type_id column
 * @method     ChildGameLinks findOneByValue(string $value) Return the first ChildGameLinks filtered by the value column *

 * @method     ChildGameLinks requirePk($key, ConnectionInterface $con = null) Return the ChildGameLinks by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGameLinks requireOne(ConnectionInterface $con = null) Return the first ChildGameLinks matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGameLinks requireOneById(string $id) Return the first ChildGameLinks filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGameLinks requireOneByGameId(string $game_id) Return the first ChildGameLinks filtered by the game_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGameLinks requireOneByGameLinkTypeId(string $game_link_type_id) Return the first ChildGameLinks filtered by the game_link_type_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGameLinks requireOneByValue(string $value) Return the first ChildGameLinks filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGameLinks[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGameLinks objects based on current ModelCriteria
 * @method     ChildGameLinks[]|ObjectCollection findById(string $id) Return ChildGameLinks objects filtered by the id column
 * @method     ChildGameLinks[]|ObjectCollection findByGameId(string $game_id) Return ChildGameLinks objects filtered by the game_id column
 * @method     ChildGameLinks[]|ObjectCollection findByGameLinkTypeId(string $game_link_type_id) Return ChildGameLinks objects filtered by the game_link_type_id column
 * @method     ChildGameLinks[]|ObjectCollection findByValue(string $value) Return ChildGameLinks objects filtered by the value column
 * @method     ChildGameLinks[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GameLinksQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\GameLinksQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\GameLinks', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGameLinksQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGameLinksQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGameLinksQuery) {
            return $criteria;
        }
        $query = new ChildGameLinksQuery();
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
     * @return ChildGameLinks|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GameLinksTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GameLinksTableMap::DATABASE_NAME);
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
     * @return ChildGameLinks A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, game_id, game_link_type_id, value FROM game_links WHERE id = :p0';
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
            /** @var ChildGameLinks $obj */
            $obj = new ChildGameLinks();
            $obj->hydrate($row);
            GameLinksTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildGameLinks|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGameLinksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GameLinksTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGameLinksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GameLinksTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildGameLinksQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GameLinksTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GameLinksTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameLinksTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildGameLinksQuery The current query, for fluid interface
     */
    public function filterByGameId($gameId = null, $comparison = null)
    {
        if (is_array($gameId)) {
            $useMinMax = false;
            if (isset($gameId['min'])) {
                $this->addUsingAlias(GameLinksTableMap::COL_GAME_ID, $gameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameId['max'])) {
                $this->addUsingAlias(GameLinksTableMap::COL_GAME_ID, $gameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameLinksTableMap::COL_GAME_ID, $gameId, $comparison);
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
     * @see       filterByGameLinkTypes()
     *
     * @param     mixed $gameLinkTypeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGameLinksQuery The current query, for fluid interface
     */
    public function filterByGameLinkTypeId($gameLinkTypeId = null, $comparison = null)
    {
        if (is_array($gameLinkTypeId)) {
            $useMinMax = false;
            if (isset($gameLinkTypeId['min'])) {
                $this->addUsingAlias(GameLinksTableMap::COL_GAME_LINK_TYPE_ID, $gameLinkTypeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameLinkTypeId['max'])) {
                $this->addUsingAlias(GameLinksTableMap::COL_GAME_LINK_TYPE_ID, $gameLinkTypeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameLinksTableMap::COL_GAME_LINK_TYPE_ID, $gameLinkTypeId, $comparison);
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
     * @return $this|ChildGameLinksQuery The current query, for fluid interface
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

        return $this->addUsingAlias(GameLinksTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query by a related \Games object
     *
     * @param \Games|ObjectCollection $games The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGameLinksQuery The current query, for fluid interface
     */
    public function filterByGames($games, $comparison = null)
    {
        if ($games instanceof \Games) {
            return $this
                ->addUsingAlias(GameLinksTableMap::COL_GAME_ID, $games->getId(), $comparison);
        } elseif ($games instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GameLinksTableMap::COL_GAME_ID, $games->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildGameLinksQuery The current query, for fluid interface
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
     * Filter the query by a related \GameLinkTypes object
     *
     * @param \GameLinkTypes|ObjectCollection $gameLinkTypes The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGameLinksQuery The current query, for fluid interface
     */
    public function filterByGameLinkTypes($gameLinkTypes, $comparison = null)
    {
        if ($gameLinkTypes instanceof \GameLinkTypes) {
            return $this
                ->addUsingAlias(GameLinksTableMap::COL_GAME_LINK_TYPE_ID, $gameLinkTypes->getId(), $comparison);
        } elseif ($gameLinkTypes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GameLinksTableMap::COL_GAME_LINK_TYPE_ID, $gameLinkTypes->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGameLinkTypes() only accepts arguments of type \GameLinkTypes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GameLinkTypes relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGameLinksQuery The current query, for fluid interface
     */
    public function joinGameLinkTypes($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GameLinkTypes');

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
            $this->addJoinObject($join, 'GameLinkTypes');
        }

        return $this;
    }

    /**
     * Use the GameLinkTypes relation GameLinkTypes object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GameLinkTypesQuery A secondary query class using the current class as primary query
     */
    public function useGameLinkTypesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGameLinkTypes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GameLinkTypes', '\GameLinkTypesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGameLinks $gameLinks Object to remove from the list of results
     *
     * @return $this|ChildGameLinksQuery The current query, for fluid interface
     */
    public function prune($gameLinks = null)
    {
        if ($gameLinks) {
            $this->addUsingAlias(GameLinksTableMap::COL_ID, $gameLinks->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the game_links table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GameLinksTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GameLinksTableMap::clearInstancePool();
            GameLinksTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GameLinksTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GameLinksTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            GameLinksTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            GameLinksTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GameLinksQuery
