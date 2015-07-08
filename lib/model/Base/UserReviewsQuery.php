<?php

namespace Base;

use \UserReviews as ChildUserReviews;
use \UserReviewsQuery as ChildUserReviewsQuery;
use \Exception;
use \PDO;
use Map\UserReviewsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user_reviews' table.
 *
 *
 *
 * @method     ChildUserReviewsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUserReviewsQuery orderByGameId($order = Criteria::ASC) Order by the game_id column
 * @method     ChildUserReviewsQuery orderByPlatformId($order = Criteria::ASC) Order by the platform_id column
 * @method     ChildUserReviewsQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUserReviewsQuery orderByRigId($order = Criteria::ASC) Order by the rig_id column
 * @method     ChildUserReviewsQuery orderByRating($order = Criteria::ASC) Order by the rating column
 * @method     ChildUserReviewsQuery orderByReview($order = Criteria::ASC) Order by the review column
 * @method     ChildUserReviewsQuery orderByUpvotes($order = Criteria::ASC) Order by the upvotes column
 * @method     ChildUserReviewsQuery orderByDownvotes($order = Criteria::ASC) Order by the downvotes column
 *
 * @method     ChildUserReviewsQuery groupById() Group by the id column
 * @method     ChildUserReviewsQuery groupByGameId() Group by the game_id column
 * @method     ChildUserReviewsQuery groupByPlatformId() Group by the platform_id column
 * @method     ChildUserReviewsQuery groupByUserId() Group by the user_id column
 * @method     ChildUserReviewsQuery groupByRigId() Group by the rig_id column
 * @method     ChildUserReviewsQuery groupByRating() Group by the rating column
 * @method     ChildUserReviewsQuery groupByReview() Group by the review column
 * @method     ChildUserReviewsQuery groupByUpvotes() Group by the upvotes column
 * @method     ChildUserReviewsQuery groupByDownvotes() Group by the downvotes column
 *
 * @method     ChildUserReviewsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserReviewsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserReviewsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserReviewsQuery leftJoinGames($relationAlias = null) Adds a LEFT JOIN clause to the query using the Games relation
 * @method     ChildUserReviewsQuery rightJoinGames($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Games relation
 * @method     ChildUserReviewsQuery innerJoinGames($relationAlias = null) Adds a INNER JOIN clause to the query using the Games relation
 *
 * @method     ChildUserReviewsQuery leftJoinPlatforms($relationAlias = null) Adds a LEFT JOIN clause to the query using the Platforms relation
 * @method     ChildUserReviewsQuery rightJoinPlatforms($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Platforms relation
 * @method     ChildUserReviewsQuery innerJoinPlatforms($relationAlias = null) Adds a INNER JOIN clause to the query using the Platforms relation
 *
 * @method     ChildUserReviewsQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildUserReviewsQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildUserReviewsQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildUserReviewsQuery leftJoinRatings($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ratings relation
 * @method     ChildUserReviewsQuery rightJoinRatings($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ratings relation
 * @method     ChildUserReviewsQuery innerJoinRatings($relationAlias = null) Adds a INNER JOIN clause to the query using the Ratings relation
 *
 * @method     \GamesQuery|\PlatformsQuery|\UserQuery|\RatingsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserReviews findOne(ConnectionInterface $con = null) Return the first ChildUserReviews matching the query
 * @method     ChildUserReviews findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserReviews matching the query, or a new ChildUserReviews object populated from the query conditions when no match is found
 *
 * @method     ChildUserReviews findOneById(string $id) Return the first ChildUserReviews filtered by the id column
 * @method     ChildUserReviews findOneByGameId(string $game_id) Return the first ChildUserReviews filtered by the game_id column
 * @method     ChildUserReviews findOneByPlatformId(string $platform_id) Return the first ChildUserReviews filtered by the platform_id column
 * @method     ChildUserReviews findOneByUserId(string $user_id) Return the first ChildUserReviews filtered by the user_id column
 * @method     ChildUserReviews findOneByRigId(string $rig_id) Return the first ChildUserReviews filtered by the rig_id column
 * @method     ChildUserReviews findOneByRating(string $rating) Return the first ChildUserReviews filtered by the rating column
 * @method     ChildUserReviews findOneByReview(string $review) Return the first ChildUserReviews filtered by the review column
 * @method     ChildUserReviews findOneByUpvotes(string $upvotes) Return the first ChildUserReviews filtered by the upvotes column
 * @method     ChildUserReviews findOneByDownvotes(string $downvotes) Return the first ChildUserReviews filtered by the downvotes column *

 * @method     ChildUserReviews requirePk($key, ConnectionInterface $con = null) Return the ChildUserReviews by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReviews requireOne(ConnectionInterface $con = null) Return the first ChildUserReviews matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserReviews requireOneById(string $id) Return the first ChildUserReviews filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReviews requireOneByGameId(string $game_id) Return the first ChildUserReviews filtered by the game_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReviews requireOneByPlatformId(string $platform_id) Return the first ChildUserReviews filtered by the platform_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReviews requireOneByUserId(string $user_id) Return the first ChildUserReviews filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReviews requireOneByRigId(string $rig_id) Return the first ChildUserReviews filtered by the rig_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReviews requireOneByRating(string $rating) Return the first ChildUserReviews filtered by the rating column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReviews requireOneByReview(string $review) Return the first ChildUserReviews filtered by the review column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReviews requireOneByUpvotes(string $upvotes) Return the first ChildUserReviews filtered by the upvotes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReviews requireOneByDownvotes(string $downvotes) Return the first ChildUserReviews filtered by the downvotes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserReviews[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserReviews objects based on current ModelCriteria
 * @method     ChildUserReviews[]|ObjectCollection findById(string $id) Return ChildUserReviews objects filtered by the id column
 * @method     ChildUserReviews[]|ObjectCollection findByGameId(string $game_id) Return ChildUserReviews objects filtered by the game_id column
 * @method     ChildUserReviews[]|ObjectCollection findByPlatformId(string $platform_id) Return ChildUserReviews objects filtered by the platform_id column
 * @method     ChildUserReviews[]|ObjectCollection findByUserId(string $user_id) Return ChildUserReviews objects filtered by the user_id column
 * @method     ChildUserReviews[]|ObjectCollection findByRigId(string $rig_id) Return ChildUserReviews objects filtered by the rig_id column
 * @method     ChildUserReviews[]|ObjectCollection findByRating(string $rating) Return ChildUserReviews objects filtered by the rating column
 * @method     ChildUserReviews[]|ObjectCollection findByReview(string $review) Return ChildUserReviews objects filtered by the review column
 * @method     ChildUserReviews[]|ObjectCollection findByUpvotes(string $upvotes) Return ChildUserReviews objects filtered by the upvotes column
 * @method     ChildUserReviews[]|ObjectCollection findByDownvotes(string $downvotes) Return ChildUserReviews objects filtered by the downvotes column
 * @method     ChildUserReviews[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserReviewsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserReviewsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\UserReviews', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserReviewsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserReviewsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserReviewsQuery) {
            return $criteria;
        }
        $query = new ChildUserReviewsQuery();
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
     * @return ChildUserReviews|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserReviewsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserReviewsTableMap::DATABASE_NAME);
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
     * @return ChildUserReviews A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, game_id, platform_id, user_id, rig_id, rating, review, upvotes, downvotes FROM user_reviews WHERE id = :p0';
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
            /** @var ChildUserReviews $obj */
            $obj = new ChildUserReviews();
            $obj->hydrate($row);
            UserReviewsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUserReviews|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserReviewsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserReviewsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByGameId($gameId = null, $comparison = null)
    {
        if (is_array($gameId)) {
            $useMinMax = false;
            if (isset($gameId['min'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_GAME_ID, $gameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameId['max'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_GAME_ID, $gameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewsTableMap::COL_GAME_ID, $gameId, $comparison);
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
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByPlatformId($platformId = null, $comparison = null)
    {
        if (is_array($platformId)) {
            $useMinMax = false;
            if (isset($platformId['min'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_PLATFORM_ID, $platformId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($platformId['max'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_PLATFORM_ID, $platformId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewsTableMap::COL_PLATFORM_ID, $platformId, $comparison);
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
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewsTableMap::COL_USER_ID, $userId, $comparison);
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
     * @param     mixed $rigId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByRigId($rigId = null, $comparison = null)
    {
        if (is_array($rigId)) {
            $useMinMax = false;
            if (isset($rigId['min'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_RIG_ID, $rigId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rigId['max'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_RIG_ID, $rigId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewsTableMap::COL_RIG_ID, $rigId, $comparison);
    }

    /**
     * Filter the query on the rating column
     *
     * Example usage:
     * <code>
     * $query->filterByRating(1234); // WHERE rating = 1234
     * $query->filterByRating(array(12, 34)); // WHERE rating IN (12, 34)
     * $query->filterByRating(array('min' => 12)); // WHERE rating > 12
     * </code>
     *
     * @see       filterByRatings()
     *
     * @param     mixed $rating The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByRating($rating = null, $comparison = null)
    {
        if (is_array($rating)) {
            $useMinMax = false;
            if (isset($rating['min'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_RATING, $rating['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rating['max'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_RATING, $rating['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewsTableMap::COL_RATING, $rating, $comparison);
    }

    /**
     * Filter the query on the review column
     *
     * Example usage:
     * <code>
     * $query->filterByReview('fooValue');   // WHERE review = 'fooValue'
     * $query->filterByReview('%fooValue%'); // WHERE review LIKE '%fooValue%'
     * </code>
     *
     * @param     string $review The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByReview($review = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($review)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $review)) {
                $review = str_replace('*', '%', $review);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserReviewsTableMap::COL_REVIEW, $review, $comparison);
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
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByUpvotes($upvotes = null, $comparison = null)
    {
        if (is_array($upvotes)) {
            $useMinMax = false;
            if (isset($upvotes['min'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_UPVOTES, $upvotes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upvotes['max'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_UPVOTES, $upvotes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewsTableMap::COL_UPVOTES, $upvotes, $comparison);
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
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByDownvotes($downvotes = null, $comparison = null)
    {
        if (is_array($downvotes)) {
            $useMinMax = false;
            if (isset($downvotes['min'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_DOWNVOTES, $downvotes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($downvotes['max'])) {
                $this->addUsingAlias(UserReviewsTableMap::COL_DOWNVOTES, $downvotes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewsTableMap::COL_DOWNVOTES, $downvotes, $comparison);
    }

    /**
     * Filter the query by a related \Games object
     *
     * @param \Games|ObjectCollection $games The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByGames($games, $comparison = null)
    {
        if ($games instanceof \Games) {
            return $this
                ->addUsingAlias(UserReviewsTableMap::COL_GAME_ID, $games->getId(), $comparison);
        } elseif ($games instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserReviewsTableMap::COL_GAME_ID, $games->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
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
     * Filter the query by a related \Platforms object
     *
     * @param \Platforms|ObjectCollection $platforms The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByPlatforms($platforms, $comparison = null)
    {
        if ($platforms instanceof \Platforms) {
            return $this
                ->addUsingAlias(UserReviewsTableMap::COL_PLATFORM_ID, $platforms->getId(), $comparison);
        } elseif ($platforms instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserReviewsTableMap::COL_PLATFORM_ID, $platforms->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
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
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(UserReviewsTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserReviewsTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
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
     * Filter the query by a related \Ratings object
     *
     * @param \Ratings|ObjectCollection $ratings The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserReviewsQuery The current query, for fluid interface
     */
    public function filterByRatings($ratings, $comparison = null)
    {
        if ($ratings instanceof \Ratings) {
            return $this
                ->addUsingAlias(UserReviewsTableMap::COL_RATING, $ratings->getId(), $comparison);
        } elseif ($ratings instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserReviewsTableMap::COL_RATING, $ratings->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRatings() only accepts arguments of type \Ratings or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ratings relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
     */
    public function joinRatings($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ratings');

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
            $this->addJoinObject($join, 'Ratings');
        }

        return $this;
    }

    /**
     * Use the Ratings relation Ratings object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RatingsQuery A secondary query class using the current class as primary query
     */
    public function useRatingsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRatings($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ratings', '\RatingsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUserReviews $userReviews Object to remove from the list of results
     *
     * @return $this|ChildUserReviewsQuery The current query, for fluid interface
     */
    public function prune($userReviews = null)
    {
        if ($userReviews) {
            $this->addUsingAlias(UserReviewsTableMap::COL_ID, $userReviews->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user_reviews table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserReviewsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserReviewsTableMap::clearInstancePool();
            UserReviewsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserReviewsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserReviewsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserReviewsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserReviewsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserReviewsQuery
