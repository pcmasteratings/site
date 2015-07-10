<?php

namespace Base;

use \RatingHeader as ChildRatingHeader;
use \RatingHeaderQuery as ChildRatingHeaderQuery;
use \Exception;
use \PDO;
use Map\RatingHeaderTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'rating_header' table.
 *
 * 
 *
 * @method     ChildRatingHeaderQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRatingHeaderQuery orderByGameId($order = Criteria::ASC) Order by the game_id column
 * @method     ChildRatingHeaderQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildRatingHeaderQuery orderByPlatformId($order = Criteria::ASC) Order by the platform_id column
 * @method     ChildRatingHeaderQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method     ChildRatingHeaderQuery orderByUpdated($order = Criteria::ASC) Order by the updated column
 * @method     ChildRatingHeaderQuery orderByUpvotes($order = Criteria::ASC) Order by the upvotes column
 * @method     ChildRatingHeaderQuery orderByDownvotes($order = Criteria::ASC) Order by the downvotes column
 * @method     ChildRatingHeaderQuery orderByComments($order = Criteria::ASC) Order by the comments column
 * @method     ChildRatingHeaderQuery orderByScore($order = Criteria::ASC) Order by the score column
 *
 * @method     ChildRatingHeaderQuery groupById() Group by the id column
 * @method     ChildRatingHeaderQuery groupByGameId() Group by the game_id column
 * @method     ChildRatingHeaderQuery groupByUserId() Group by the user_id column
 * @method     ChildRatingHeaderQuery groupByPlatformId() Group by the platform_id column
 * @method     ChildRatingHeaderQuery groupByCreated() Group by the created column
 * @method     ChildRatingHeaderQuery groupByUpdated() Group by the updated column
 * @method     ChildRatingHeaderQuery groupByUpvotes() Group by the upvotes column
 * @method     ChildRatingHeaderQuery groupByDownvotes() Group by the downvotes column
 * @method     ChildRatingHeaderQuery groupByComments() Group by the comments column
 * @method     ChildRatingHeaderQuery groupByScore() Group by the score column
 *
 * @method     ChildRatingHeaderQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRatingHeaderQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRatingHeaderQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRatingHeaderQuery leftJoinGames($relationAlias = null) Adds a LEFT JOIN clause to the query using the Games relation
 * @method     ChildRatingHeaderQuery rightJoinGames($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Games relation
 * @method     ChildRatingHeaderQuery innerJoinGames($relationAlias = null) Adds a INNER JOIN clause to the query using the Games relation
 *
 * @method     ChildRatingHeaderQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildRatingHeaderQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildRatingHeaderQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildRatingHeaderQuery leftJoinPlatforms($relationAlias = null) Adds a LEFT JOIN clause to the query using the Platforms relation
 * @method     ChildRatingHeaderQuery rightJoinPlatforms($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Platforms relation
 * @method     ChildRatingHeaderQuery innerJoinPlatforms($relationAlias = null) Adds a INNER JOIN clause to the query using the Platforms relation
 *
 * @method     ChildRatingHeaderQuery leftJoinRatingValue($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingValue relation
 * @method     ChildRatingHeaderQuery rightJoinRatingValue($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingValue relation
 * @method     ChildRatingHeaderQuery innerJoinRatingValue($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingValue relation
 *
 * @method     \GamesQuery|\UserQuery|\PlatformsQuery|\RatingValueQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRatingHeader findOne(ConnectionInterface $con = null) Return the first ChildRatingHeader matching the query
 * @method     ChildRatingHeader findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRatingHeader matching the query, or a new ChildRatingHeader object populated from the query conditions when no match is found
 *
 * @method     ChildRatingHeader findOneById(string $id) Return the first ChildRatingHeader filtered by the id column
 * @method     ChildRatingHeader findOneByGameId(string $game_id) Return the first ChildRatingHeader filtered by the game_id column
 * @method     ChildRatingHeader findOneByUserId(string $user_id) Return the first ChildRatingHeader filtered by the user_id column
 * @method     ChildRatingHeader findOneByPlatformId(string $platform_id) Return the first ChildRatingHeader filtered by the platform_id column
 * @method     ChildRatingHeader findOneByCreated(string $created) Return the first ChildRatingHeader filtered by the created column
 * @method     ChildRatingHeader findOneByUpdated(string $updated) Return the first ChildRatingHeader filtered by the updated column
 * @method     ChildRatingHeader findOneByUpvotes(string $upvotes) Return the first ChildRatingHeader filtered by the upvotes column
 * @method     ChildRatingHeader findOneByDownvotes(string $downvotes) Return the first ChildRatingHeader filtered by the downvotes column
 * @method     ChildRatingHeader findOneByComments(string $comments) Return the first ChildRatingHeader filtered by the comments column
 * @method     ChildRatingHeader findOneByScore(int $score) Return the first ChildRatingHeader filtered by the score column *

 * @method     ChildRatingHeader requirePk($key, ConnectionInterface $con = null) Return the ChildRatingHeader by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeader requireOne(ConnectionInterface $con = null) Return the first ChildRatingHeader matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRatingHeader requireOneById(string $id) Return the first ChildRatingHeader filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeader requireOneByGameId(string $game_id) Return the first ChildRatingHeader filtered by the game_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeader requireOneByUserId(string $user_id) Return the first ChildRatingHeader filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeader requireOneByPlatformId(string $platform_id) Return the first ChildRatingHeader filtered by the platform_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeader requireOneByCreated(string $created) Return the first ChildRatingHeader filtered by the created column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeader requireOneByUpdated(string $updated) Return the first ChildRatingHeader filtered by the updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeader requireOneByUpvotes(string $upvotes) Return the first ChildRatingHeader filtered by the upvotes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeader requireOneByDownvotes(string $downvotes) Return the first ChildRatingHeader filtered by the downvotes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeader requireOneByComments(string $comments) Return the first ChildRatingHeader filtered by the comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRatingHeader requireOneByScore(int $score) Return the first ChildRatingHeader filtered by the score column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRatingHeader[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRatingHeader objects based on current ModelCriteria
 * @method     ChildRatingHeader[]|ObjectCollection findById(string $id) Return ChildRatingHeader objects filtered by the id column
 * @method     ChildRatingHeader[]|ObjectCollection findByGameId(string $game_id) Return ChildRatingHeader objects filtered by the game_id column
 * @method     ChildRatingHeader[]|ObjectCollection findByUserId(string $user_id) Return ChildRatingHeader objects filtered by the user_id column
 * @method     ChildRatingHeader[]|ObjectCollection findByPlatformId(string $platform_id) Return ChildRatingHeader objects filtered by the platform_id column
 * @method     ChildRatingHeader[]|ObjectCollection findByCreated(string $created) Return ChildRatingHeader objects filtered by the created column
 * @method     ChildRatingHeader[]|ObjectCollection findByUpdated(string $updated) Return ChildRatingHeader objects filtered by the updated column
 * @method     ChildRatingHeader[]|ObjectCollection findByUpvotes(string $upvotes) Return ChildRatingHeader objects filtered by the upvotes column
 * @method     ChildRatingHeader[]|ObjectCollection findByDownvotes(string $downvotes) Return ChildRatingHeader objects filtered by the downvotes column
 * @method     ChildRatingHeader[]|ObjectCollection findByComments(string $comments) Return ChildRatingHeader objects filtered by the comments column
 * @method     ChildRatingHeader[]|ObjectCollection findByScore(int $score) Return ChildRatingHeader objects filtered by the score column
 * @method     ChildRatingHeader[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RatingHeaderQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\RatingHeaderQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\RatingHeader', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRatingHeaderQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRatingHeaderQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRatingHeaderQuery) {
            return $criteria;
        }
        $query = new ChildRatingHeaderQuery();
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
     * @return ChildRatingHeader|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RatingHeaderTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RatingHeaderTableMap::DATABASE_NAME);
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
     * @return ChildRatingHeader A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, game_id, user_id, platform_id, created, updated, upvotes, downvotes, comments, score FROM rating_header WHERE id = :p0';
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
            /** @var ChildRatingHeader $obj */
            $obj = new ChildRatingHeader();
            $obj->hydrate($row);
            RatingHeaderTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildRatingHeader|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RatingHeaderTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RatingHeaderTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeaderTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByGameId($gameId = null, $comparison = null)
    {
        if (is_array($gameId)) {
            $useMinMax = false;
            if (isset($gameId['min'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_GAME_ID, $gameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameId['max'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_GAME_ID, $gameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeaderTableMap::COL_GAME_ID, $gameId, $comparison);
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
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeaderTableMap::COL_USER_ID, $userId, $comparison);
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
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByPlatformId($platformId = null, $comparison = null)
    {
        if (is_array($platformId)) {
            $useMinMax = false;
            if (isset($platformId['min'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_PLATFORM_ID, $platformId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($platformId['max'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_PLATFORM_ID, $platformId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeaderTableMap::COL_PLATFORM_ID, $platformId, $comparison);
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
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeaderTableMap::COL_CREATED, $created, $comparison);
    }

    /**
     * Filter the query on the updated column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdated('2011-03-14'); // WHERE updated = '2011-03-14'
     * $query->filterByUpdated('now'); // WHERE updated = '2011-03-14'
     * $query->filterByUpdated(array('max' => 'yesterday')); // WHERE updated > '2011-03-13'
     * </code>
     *
     * @param     mixed $updated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByUpdated($updated = null, $comparison = null)
    {
        if (is_array($updated)) {
            $useMinMax = false;
            if (isset($updated['min'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_UPDATED, $updated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updated['max'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_UPDATED, $updated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeaderTableMap::COL_UPDATED, $updated, $comparison);
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
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByUpvotes($upvotes = null, $comparison = null)
    {
        if (is_array($upvotes)) {
            $useMinMax = false;
            if (isset($upvotes['min'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_UPVOTES, $upvotes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upvotes['max'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_UPVOTES, $upvotes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeaderTableMap::COL_UPVOTES, $upvotes, $comparison);
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
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByDownvotes($downvotes = null, $comparison = null)
    {
        if (is_array($downvotes)) {
            $useMinMax = false;
            if (isset($downvotes['min'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_DOWNVOTES, $downvotes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($downvotes['max'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_DOWNVOTES, $downvotes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeaderTableMap::COL_DOWNVOTES, $downvotes, $comparison);
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
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RatingHeaderTableMap::COL_COMMENTS, $comments, $comparison);
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
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByScore($score = null, $comparison = null)
    {
        if (is_array($score)) {
            $useMinMax = false;
            if (isset($score['min'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_SCORE, $score['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($score['max'])) {
                $this->addUsingAlias(RatingHeaderTableMap::COL_SCORE, $score['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RatingHeaderTableMap::COL_SCORE, $score, $comparison);
    }

    /**
     * Filter the query by a related \Games object
     *
     * @param \Games|ObjectCollection $games The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByGames($games, $comparison = null)
    {
        if ($games instanceof \Games) {
            return $this
                ->addUsingAlias(RatingHeaderTableMap::COL_GAME_ID, $games->getId(), $comparison);
        } elseif ($games instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RatingHeaderTableMap::COL_GAME_ID, $games->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
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
     * @return ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(RatingHeaderTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RatingHeaderTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
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
     * Filter the query by a related \Platforms object
     *
     * @param \Platforms|ObjectCollection $platforms The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByPlatforms($platforms, $comparison = null)
    {
        if ($platforms instanceof \Platforms) {
            return $this
                ->addUsingAlias(RatingHeaderTableMap::COL_PLATFORM_ID, $platforms->getId(), $comparison);
        } elseif ($platforms instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RatingHeaderTableMap::COL_PLATFORM_ID, $platforms->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
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
     * Filter the query by a related \RatingValue object
     *
     * @param \RatingValue|ObjectCollection $ratingValue the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function filterByRatingValue($ratingValue, $comparison = null)
    {
        if ($ratingValue instanceof \RatingValue) {
            return $this
                ->addUsingAlias(RatingHeaderTableMap::COL_ID, $ratingValue->getRatingHeaderId(), $comparison);
        } elseif ($ratingValue instanceof ObjectCollection) {
            return $this
                ->useRatingValueQuery()
                ->filterByPrimaryKeys($ratingValue->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRatingValue() only accepts arguments of type \RatingValue or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RatingValue relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function joinRatingValue($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RatingValue');

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
            $this->addJoinObject($join, 'RatingValue');
        }

        return $this;
    }

    /**
     * Use the RatingValue relation RatingValue object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RatingValueQuery A secondary query class using the current class as primary query
     */
    public function useRatingValueQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRatingValue($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RatingValue', '\RatingValueQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRatingHeader $ratingHeader Object to remove from the list of results
     *
     * @return $this|ChildRatingHeaderQuery The current query, for fluid interface
     */
    public function prune($ratingHeader = null)
    {
        if ($ratingHeader) {
            $this->addUsingAlias(RatingHeaderTableMap::COL_ID, $ratingHeader->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the rating_header table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RatingHeaderTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RatingHeaderTableMap::clearInstancePool();
            RatingHeaderTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RatingHeaderTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RatingHeaderTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            RatingHeaderTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            RatingHeaderTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RatingHeaderQuery
