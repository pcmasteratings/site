<?php

namespace Base;

use \RatingHeaders as ChildRatingHeaders;
use \RatingHeadersQuery as ChildRatingHeadersQuery;
use \Exception;
use \PDO;
use Map\RatingHeadersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'rating_headers' table.
 *
 * 
 *
 * @method     ChildRatingHeadersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRatingHeadersQuery orderByGameId($order = Criteria::ASC) Order by the game_id column
 * @method     ChildRatingHeadersQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildRatingHeadersQuery orderByGamePlatformId($order = Criteria::ASC) Order by the game_platform_id column
 * @method     ChildRatingHeadersQuery orderByRigId($order = Criteria::ASC) Order by the rig_id column
 * @method     ChildRatingHeadersQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method     ChildRatingHeadersQuery orderByUpvotes($order = Criteria::ASC) Order by the upvotes column
 * @method     ChildRatingHeadersQuery orderByDownvotes($order = Criteria::ASC) Order by the downvotes column
 * @method     ChildRatingHeadersQuery orderByComments($order = Criteria::ASC) Order by the comments column
 * @method     ChildRatingHeadersQuery orderByScore($order = Criteria::ASC) Order by the score column
 *
 * @method     ChildRatingHeadersQuery groupById() Group by the id column
 * @method     ChildRatingHeadersQuery groupByGameId() Group by the game_id column
 * @method     ChildRatingHeadersQuery groupByUserId() Group by the user_id column
 * @method     ChildRatingHeadersQuery groupByGamePlatformId() Group by the game_platform_id column
 * @method     ChildRatingHeadersQuery groupByRigId() Group by the rig_id column
 * @method     ChildRatingHeadersQuery groupByCreated() Group by the created column
 * @method     ChildRatingHeadersQuery groupByUpvotes() Group by the upvotes column
 * @method     ChildRatingHeadersQuery groupByDownvotes() Group by the downvotes column
 * @method     ChildRatingHeadersQuery groupByComments() Group by the comments column
 * @method     ChildRatingHeadersQuery groupByScore() Group by the score column
 *
 * @method     ChildRatingHeadersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRatingHeadersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRatingHeadersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRatingHeadersQuery leftJoinGames($relationAlias = null) Adds a LEFT JOIN clause to the query using the Games relation
 * @method     ChildRatingHeadersQuery rightJoinGames($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Games relation
 * @method     ChildRatingHeadersQuery innerJoinGames($relationAlias = null) Adds a INNER JOIN clause to the query using the Games relation
 *
 * @method     ChildRatingHeadersQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildRatingHeadersQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildRatingHeadersQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildRatingHeadersQuery leftJoinRigs($relationAlias = null) Adds a LEFT JOIN clause to the query using the Rigs relation
 * @method     ChildRatingHeadersQuery rightJoinRigs($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Rigs relation
 * @method     ChildRatingHeadersQuery innerJoinRigs($relationAlias = null) Adds a INNER JOIN clause to the query using the Rigs relation
 *
 * @method     ChildRatingHeadersQuery leftJoinGamePlatforms($relationAlias = null) Adds a LEFT JOIN clause to the query using the GamePlatforms relation
 * @method     ChildRatingHeadersQuery rightJoinGamePlatforms($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GamePlatforms relation
 * @method     ChildRatingHeadersQuery innerJoinGamePlatforms($relationAlias = null) Adds a INNER JOIN clause to the query using the GamePlatforms relation
 *
 * @method     ChildRatingHeadersQuery leftJoinRatingCategoryValues($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingCategoryValues relation
 * @method     ChildRatingHeadersQuery rightJoinRatingCategoryValues($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingCategoryValues relation
 * @method     ChildRatingHeadersQuery innerJoinRatingCategoryValues($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingCategoryValues relation
 *
 * @method     \GamesQuery|\UserQuery|\RigsQuery|\GamePlatformsQuery|\RatingCategoryValuesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRatingHeaders findOne(ConnectionInterface $con = null) Return the first ChildRatingHeaders matching the query
 * @method     ChildRatingHeaders findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRatingHeaders matching the query, or a new ChildRatingHeaders object populated from the query conditions when no match is found
 *
 * @method     ChildRatingHeaders findOneById(string $id) Return the first ChildRatingHeaders filtered by the id column
 * @method     ChildRatingHeaders findOneByGameId(string $game_id) Return the first ChildRatingHeaders filtered by the game_id column
 * @method     ChildRatingHeaders findOneByUserId(string $user_id) Return the first ChildRatingHeaders filtered by the user_id column
 * @method     ChildRatingHeaders findOneByGamePlatformId(string $game_platform_id) Return the first ChildRatingHeaders filtered by the game_platform_id column
 * @method     ChildRatingHeaders findOneByRigId(string $rig_id) Return the first ChildRatingHeaders filtered by the rig_id column
 * @method     ChildRatingHeaders findOneByCreated(string $created) Return the first ChildRatingHeaders filtered by the created column
 * @method     ChildRatingHeaders findOneByUpvotes(string $upvotes) Return the first ChildRatingHeaders filtered by the upvotes column
 * @method     ChildRatingHeaders findOneByDownvotes(string $downvotes) Return the first ChildRatingHeaders filtered by the downvotes column
 * @method     ChildRatingHeaders findOneByComments(string $comments) Return the first ChildRatingHeaders filtered by the comments column
 * @method     ChildRatingHeaders findOneByScore(int $score) Return the first ChildRatingHeaders filtered by the score column *

 * @method     ChildRatingHeaders requirePk($key, ConnectionInterface $con = null) Return the ChildRatingHeaders by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeaders requireOne(ConnectionInterface $con = null) Return the first ChildRatingHeaders matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRatingHeaders requireOneById(string $id) Return the first ChildRatingHeaders filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeaders requireOneByGameId(string $game_id) Return the first ChildRatingHeaders filtered by the game_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeaders requireOneByUserId(string $user_id) Return the first ChildRatingHeaders filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeaders requireOneByGamePlatformId(string $game_platform_id) Return the first ChildRatingHeaders filtered by the game_platform_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeaders requireOneByRigId(string $rig_id) Return the first ChildRatingHeaders filtered by the rig_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeaders requireOneByCreated(string $created) Return the first ChildRatingHeaders filtered by the created column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeaders requireOneByUpvotes(string $upvotes) Return the first ChildRatingHeaders filtered by the upvotes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeaders requireOneByDownvotes(string $downvotes) Return the first ChildRatingHeaders filtered by the downvotes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeaders requireOneByComments(string $comments) Return the first ChildRatingHeaders filtered by the comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeaders requireOneByScore(int $score) Return the first ChildRatingHeaders filtered by the score column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRatingHeaders[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRatingHeaders objects based on current ModelCriteria
 * @method     ChildRatingHeaders[]|ObjectCollection findById(string $id) Return ChildRatingHeaders objects filtered by the id column
 * @method     ChildRatingHeaders[]|ObjectCollection findByGameId(string $game_id) Return ChildRatingHeaders objects filtered by the game_id column
 * @method     ChildRatingHeaders[]|ObjectCollection findByUserId(string $user_id) Return ChildRatingHeaders objects filtered by the user_id column
 * @method     ChildRatingHeaders[]|ObjectCollection findByGamePlatformId(string $game_platform_id) Return ChildRatingHeaders objects filtered by the game_platform_id column
 * @method     ChildRatingHeaders[]|ObjectCollection findByRigId(string $rig_id) Return ChildRatingHeaders objects filtered by the rig_id column
 * @method     ChildRatingHeaders[]|ObjectCollection findByCreated(string $created) Return ChildRatingHeaders objects filtered by the created column
 * @method     ChildRatingHeaders[]|ObjectCollection findByUpvotes(string $upvotes) Return ChildRatingHeaders objects filtered by the upvotes column
 * @method     ChildRatingHeaders[]|ObjectCollection findByDownvotes(string $downvotes) Return ChildRatingHeaders objects filtered by the downvotes column
 * @method     ChildRatingHeaders[]|ObjectCollection findByComments(string $comments) Return ChildRatingHeaders objects filtered by the comments column
 * @method     ChildRatingHeaders[]|ObjectCollection findByScore(int $score) Return ChildRatingHeaders objects filtered by the score column
 * @method     ChildRatingHeaders[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RatingHeadersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RatingHeadersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\RatingHeaders', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRatingHeadersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRatingHeadersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRatingHeadersQuery) {
            return $criteria;
        }
        $query = new ChildRatingHeadersQuery();
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
     * @return ChildRatingHeaders|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RatingHeadersTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RatingHeadersTableMap::DATABASE_NAME);
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
     * @return ChildRatingHeaders A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, game_id, user_id, game_platform_id, rig_id, created, upvotes, downvotes, comments, score FROM rating_headers WHERE id = :p0';
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
            /** @var ChildRatingHeaders $obj */
            $obj = new ChildRatingHeaders();
            $obj->hydrate($row);
            RatingHeadersTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildRatingHeaders|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RatingHeadersTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RatingHeadersTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeadersTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByGameId($gameId = null, $comparison = null)
    {
        if (is_array($gameId)) {
            $useMinMax = false;
            if (isset($gameId['min'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_GAME_ID, $gameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameId['max'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_GAME_ID, $gameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeadersTableMap::COL_GAME_ID, $gameId, $comparison);
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
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeadersTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the game_platform_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGamePlatformId(1234); // WHERE game_platform_id = 1234
     * $query->filterByGamePlatformId(array(12, 34)); // WHERE game_platform_id IN (12, 34)
     * $query->filterByGamePlatformId(array('min' => 12)); // WHERE game_platform_id > 12
     * </code>
     *
     * @see       filterByGamePlatforms()
     *
     * @param     mixed $gamePlatformId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByGamePlatformId($gamePlatformId = null, $comparison = null)
    {
        if (is_array($gamePlatformId)) {
            $useMinMax = false;
            if (isset($gamePlatformId['min'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_GAME_PLATFORM_ID, $gamePlatformId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gamePlatformId['max'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_GAME_PLATFORM_ID, $gamePlatformId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeadersTableMap::COL_GAME_PLATFORM_ID, $gamePlatformId, $comparison);
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
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByRigId($rigId = null, $comparison = null)
    {
        if (is_array($rigId)) {
            $useMinMax = false;
            if (isset($rigId['min'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_RIG_ID, $rigId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rigId['max'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_RIG_ID, $rigId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeadersTableMap::COL_RIG_ID, $rigId, $comparison);
    }

    /**
     * Filter the query on the created column
     *
     * Example usage:
     * <code>
     * $query->filterByCreated('2011-03-14'); // WHERE created = '2011-03-14'
     * $query->filterByCreated('now'); // WHERE created = '2011-03-14'
     * $query->filterByCreated(array('max' => 'yesterday')); // WHERE created > '2011-03-13'
     * </code>
     *
     * @param     mixed $created The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeadersTableMap::COL_CREATED, $created, $comparison);
    }

    /**
     * Filter the query on the upvotes column
     *
     * Example usage:
     * <code>
     * $query->filterByUpvotes(1234); // WHERE upvotes = 1234
     * $query->filterByUpvotes(array(12, 34)); // WHERE upvotes IN (12, 34)
     * $query->filterByUpvotes(array('min' => 12)); // WHERE upvotes > 12
     * </code>
     *
     * @param     mixed $upvotes The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByUpvotes($upvotes = null, $comparison = null)
    {
        if (is_array($upvotes)) {
            $useMinMax = false;
            if (isset($upvotes['min'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_UPVOTES, $upvotes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upvotes['max'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_UPVOTES, $upvotes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeadersTableMap::COL_UPVOTES, $upvotes, $comparison);
    }

    /**
     * Filter the query on the downvotes column
     *
     * Example usage:
     * <code>
     * $query->filterByDownvotes(1234); // WHERE downvotes = 1234
     * $query->filterByDownvotes(array(12, 34)); // WHERE downvotes IN (12, 34)
     * $query->filterByDownvotes(array('min' => 12)); // WHERE downvotes > 12
     * </code>
     *
     * @param     mixed $downvotes The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByDownvotes($downvotes = null, $comparison = null)
    {
        if (is_array($downvotes)) {
            $useMinMax = false;
            if (isset($downvotes['min'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_DOWNVOTES, $downvotes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($downvotes['max'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_DOWNVOTES, $downvotes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeadersTableMap::COL_DOWNVOTES, $downvotes, $comparison);
    }

    /**
     * Filter the query on the comments column
     *
     * Example usage:
     * <code>
     * $query->filterByComments('fooValue');   // WHERE comments = 'fooValue'
     * $query->filterByComments('%fooValue%'); // WHERE comments LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comments The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByComments($comments = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comments)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $comments)) {
                $comments = str_replace('*', '%', $comments);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RatingHeadersTableMap::COL_COMMENTS, $comments, $comparison);
    }

    /**
     * Filter the query on the score column
     *
     * Example usage:
     * <code>
     * $query->filterByScore(1234); // WHERE score = 1234
     * $query->filterByScore(array(12, 34)); // WHERE score IN (12, 34)
     * $query->filterByScore(array('min' => 12)); // WHERE score > 12
     * </code>
     *
     * @param     mixed $score The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByScore($score = null, $comparison = null)
    {
        if (is_array($score)) {
            $useMinMax = false;
            if (isset($score['min'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_SCORE, $score['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($score['max'])) {
                $this->addUsingAlias(RatingHeadersTableMap::COL_SCORE, $score['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeadersTableMap::COL_SCORE, $score, $comparison);
    }

    /**
     * Filter the query by a related \Games object
     *
     * @param \Games|ObjectCollection $games The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByGames($games, $comparison = null)
    {
        if ($games instanceof \Games) {
            return $this
                ->addUsingAlias(RatingHeadersTableMap::COL_GAME_ID, $games->getId(), $comparison);
        } elseif ($games instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RatingHeadersTableMap::COL_GAME_ID, $games->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
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
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(RatingHeadersTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RatingHeadersTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
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
     * Filter the query by a related \Rigs object
     *
     * @param \Rigs|ObjectCollection $rigs The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByRigs($rigs, $comparison = null)
    {
        if ($rigs instanceof \Rigs) {
            return $this
                ->addUsingAlias(RatingHeadersTableMap::COL_RIG_ID, $rigs->getId(), $comparison);
        } elseif ($rigs instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RatingHeadersTableMap::COL_RIG_ID, $rigs->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function joinRigs($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useRigsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRigs($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Rigs', '\RigsQuery');
    }

    /**
     * Filter the query by a related \GamePlatforms object
     *
     * @param \GamePlatforms|ObjectCollection $gamePlatforms The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByGamePlatforms($gamePlatforms, $comparison = null)
    {
        if ($gamePlatforms instanceof \GamePlatforms) {
            return $this
                ->addUsingAlias(RatingHeadersTableMap::COL_GAME_PLATFORM_ID, $gamePlatforms->getId(), $comparison);
        } elseif ($gamePlatforms instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RatingHeadersTableMap::COL_GAME_PLATFORM_ID, $gamePlatforms->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGamePlatforms() only accepts arguments of type \GamePlatforms or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GamePlatforms relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function joinGamePlatforms($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GamePlatforms');

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
            $this->addJoinObject($join, 'GamePlatforms');
        }

        return $this;
    }

    /**
     * Use the GamePlatforms relation GamePlatforms object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GamePlatformsQuery A secondary query class using the current class as primary query
     */
    public function useGamePlatformsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGamePlatforms($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GamePlatforms', '\GamePlatformsQuery');
    }

    /**
     * Filter the query by a related \RatingCategoryValues object
     *
     * @param \RatingCategoryValues|ObjectCollection $ratingCategoryValues the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function filterByRatingCategoryValues($ratingCategoryValues, $comparison = null)
    {
        if ($ratingCategoryValues instanceof \RatingCategoryValues) {
            return $this
                ->addUsingAlias(RatingHeadersTableMap::COL_ID, $ratingCategoryValues->getRatingHeaderId(), $comparison);
        } elseif ($ratingCategoryValues instanceof ObjectCollection) {
            return $this
                ->useRatingCategoryValuesQuery()
                ->filterByPrimaryKeys($ratingCategoryValues->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRatingCategoryValues() only accepts arguments of type \RatingCategoryValues or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RatingCategoryValues relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function joinRatingCategoryValues($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RatingCategoryValues');

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
            $this->addJoinObject($join, 'RatingCategoryValues');
        }

        return $this;
    }

    /**
     * Use the RatingCategoryValues relation RatingCategoryValues object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RatingCategoryValuesQuery A secondary query class using the current class as primary query
     */
    public function useRatingCategoryValuesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRatingCategoryValues($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RatingCategoryValues', '\RatingCategoryValuesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRatingHeaders $ratingHeaders Object to remove from the list of results
     *
     * @return $this|ChildRatingHeadersQuery The current query, for fluid interface
     */
    public function prune($ratingHeaders = null)
    {
        if ($ratingHeaders) {
            $this->addUsingAlias(RatingHeadersTableMap::COL_ID, $ratingHeaders->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rating_headers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RatingHeadersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RatingHeadersTableMap::clearInstancePool();
            RatingHeadersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RatingHeadersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RatingHeadersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            RatingHeadersTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            RatingHeadersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RatingHeadersQuery
