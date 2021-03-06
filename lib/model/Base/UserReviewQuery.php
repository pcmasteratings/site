<?php

namespace Base;

use \UserReview as ChildUserReview;
use \UserReviewQuery as ChildUserReviewQuery;
use \Exception;
use \PDO;
use Map\UserReviewTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'user_review' table.
 *
 * 
 *
 * @method     ChildUserReviewQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUserReviewQuery orderByGameId($order = Criteria::ASC) Order by the game_id column
 * @method     ChildUserReviewQuery orderByPlatformId($order = Criteria::ASC) Order by the platform_id column
 * @method     ChildUserReviewQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildUserReviewQuery orderByRigId($order = Criteria::ASC) Order by the rig_id column
 * @method     ChildUserReviewQuery orderByRatingId($order = Criteria::ASC) Order by the rating_id column
 * @method     ChildUserReviewQuery orderByReview($order = Criteria::ASC) Order by the review column
 * @method     ChildUserReviewQuery orderByUpvotes($order = Criteria::ASC) Order by the upvotes column
 * @method     ChildUserReviewQuery orderByDownvotes($order = Criteria::ASC) Order by the downvotes column
 *
 * @method     ChildUserReviewQuery groupById() Group by the id column
 * @method     ChildUserReviewQuery groupByGameId() Group by the game_id column
 * @method     ChildUserReviewQuery groupByPlatformId() Group by the platform_id column
 * @method     ChildUserReviewQuery groupByUserId() Group by the user_id column
 * @method     ChildUserReviewQuery groupByRigId() Group by the rig_id column
 * @method     ChildUserReviewQuery groupByRatingId() Group by the rating_id column
 * @method     ChildUserReviewQuery groupByReview() Group by the review column
 * @method     ChildUserReviewQuery groupByUpvotes() Group by the upvotes column
 * @method     ChildUserReviewQuery groupByDownvotes() Group by the downvotes column
 *
 * @method     ChildUserReviewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserReviewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserReviewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserReviewQuery leftJoinGame($relationAlias = null) Adds a LEFT JOIN clause to the query using the Game relation
 * @method     ChildUserReviewQuery rightJoinGame($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Game relation
 * @method     ChildUserReviewQuery innerJoinGame($relationAlias = null) Adds a INNER JOIN clause to the query using the Game relation
 *
 * @method     ChildUserReviewQuery leftJoinPlatform($relationAlias = null) Adds a LEFT JOIN clause to the query using the Platform relation
 * @method     ChildUserReviewQuery rightJoinPlatform($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Platform relation
 * @method     ChildUserReviewQuery innerJoinPlatform($relationAlias = null) Adds a INNER JOIN clause to the query using the Platform relation
 *
 * @method     ChildUserReviewQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildUserReviewQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildUserReviewQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildUserReviewQuery leftJoinRating($relationAlias = null) Adds a LEFT JOIN clause to the query using the Rating relation
 * @method     ChildUserReviewQuery rightJoinRating($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Rating relation
 * @method     ChildUserReviewQuery innerJoinRating($relationAlias = null) Adds a INNER JOIN clause to the query using the Rating relation
 *
 * @method     ChildUserReviewQuery leftJoinRig($relationAlias = null) Adds a LEFT JOIN clause to the query using the Rig relation
 * @method     ChildUserReviewQuery rightJoinRig($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Rig relation
 * @method     ChildUserReviewQuery innerJoinRig($relationAlias = null) Adds a INNER JOIN clause to the query using the Rig relation
 *
 * @method     \GameQuery|\PlatformQuery|\UserQuery|\RatingQuery|\RigQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserReview findOne(ConnectionInterface $con = null) Return the first ChildUserReview matching the query
 * @method     ChildUserReview findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserReview matching the query, or a new ChildUserReview object populated from the query conditions when no match is found
 *
 * @method     ChildUserReview findOneById(string $id) Return the first ChildUserReview filtered by the id column
 * @method     ChildUserReview findOneByGameId(string $game_id) Return the first ChildUserReview filtered by the game_id column
 * @method     ChildUserReview findOneByPlatformId(string $platform_id) Return the first ChildUserReview filtered by the platform_id column
 * @method     ChildUserReview findOneByUserId(string $user_id) Return the first ChildUserReview filtered by the user_id column
 * @method     ChildUserReview findOneByRigId(string $rig_id) Return the first ChildUserReview filtered by the rig_id column
 * @method     ChildUserReview findOneByRatingId(string $rating_id) Return the first ChildUserReview filtered by the rating_id column
 * @method     ChildUserReview findOneByReview(string $review) Return the first ChildUserReview filtered by the review column
 * @method     ChildUserReview findOneByUpvotes(string $upvotes) Return the first ChildUserReview filtered by the upvotes column
 * @method     ChildUserReview findOneByDownvotes(string $downvotes) Return the first ChildUserReview filtered by the downvotes column *

 * @method     ChildUserReview requirePk($key, ConnectionInterface $con = null) Return the ChildUserReview by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReview requireOne(ConnectionInterface $con = null) Return the first ChildUserReview matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserReview requireOneById(string $id) Return the first ChildUserReview filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReview requireOneByGameId(string $game_id) Return the first ChildUserReview filtered by the game_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReview requireOneByPlatformId(string $platform_id) Return the first ChildUserReview filtered by the platform_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReview requireOneByUserId(string $user_id) Return the first ChildUserReview filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReview requireOneByRigId(string $rig_id) Return the first ChildUserReview filtered by the rig_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReview requireOneByRatingId(string $rating_id) Return the first ChildUserReview filtered by the rating_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReview requireOneByReview(string $review) Return the first ChildUserReview filtered by the review column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReview requireOneByUpvotes(string $upvotes) Return the first ChildUserReview filtered by the upvotes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserReview requireOneByDownvotes(string $downvotes) Return the first ChildUserReview filtered by the downvotes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserReview[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserReview objects based on current ModelCriteria
 * @method     ChildUserReview[]|ObjectCollection findById(string $id) Return ChildUserReview objects filtered by the id column
 * @method     ChildUserReview[]|ObjectCollection findByGameId(string $game_id) Return ChildUserReview objects filtered by the game_id column
 * @method     ChildUserReview[]|ObjectCollection findByPlatformId(string $platform_id) Return ChildUserReview objects filtered by the platform_id column
 * @method     ChildUserReview[]|ObjectCollection findByUserId(string $user_id) Return ChildUserReview objects filtered by the user_id column
 * @method     ChildUserReview[]|ObjectCollection findByRigId(string $rig_id) Return ChildUserReview objects filtered by the rig_id column
 * @method     ChildUserReview[]|ObjectCollection findByRatingId(string $rating_id) Return ChildUserReview objects filtered by the rating_id column
 * @method     ChildUserReview[]|ObjectCollection findByReview(string $review) Return ChildUserReview objects filtered by the review column
 * @method     ChildUserReview[]|ObjectCollection findByUpvotes(string $upvotes) Return ChildUserReview objects filtered by the upvotes column
 * @method     ChildUserReview[]|ObjectCollection findByDownvotes(string $downvotes) Return ChildUserReview objects filtered by the downvotes column
 * @method     ChildUserReview[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserReviewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserReviewQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\UserReview', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserReviewQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserReviewQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserReviewQuery) {
            return $criteria;
        }
        $query = new ChildUserReviewQuery();
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
     * @return ChildUserReview|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserReviewTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserReviewTableMap::DATABASE_NAME);
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
     * @return ChildUserReview A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, game_id, platform_id, user_id, rig_id, rating_id, review, upvotes, downvotes FROM user_review WHERE id = :p0';
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
            /** @var ChildUserReview $obj */
            $obj = new ChildUserReview();
            $obj->hydrate($row);
            UserReviewTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUserReview|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserReviewTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserReviewTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByGameId($gameId = null, $comparison = null)
    {
        if (is_array($gameId)) {
            $useMinMax = false;
            if (isset($gameId['min'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_GAME_ID, $gameId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gameId['max'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_GAME_ID, $gameId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewTableMap::COL_GAME_ID, $gameId, $comparison);
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
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByPlatformId($platformId = null, $comparison = null)
    {
        if (is_array($platformId)) {
            $useMinMax = false;
            if (isset($platformId['min'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_PLATFORM_ID, $platformId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($platformId['max'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_PLATFORM_ID, $platformId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewTableMap::COL_PLATFORM_ID, $platformId, $comparison);
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
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewTableMap::COL_USER_ID, $userId, $comparison);
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
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByRigId($rigId = null, $comparison = null)
    {
        if (is_array($rigId)) {
            $useMinMax = false;
            if (isset($rigId['min'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_RIG_ID, $rigId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rigId['max'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_RIG_ID, $rigId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewTableMap::COL_RIG_ID, $rigId, $comparison);
    }

    /**
     * Filter the query on the rating_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRatingId(1234); // WHERE rating_id = 1234
     * $query->filterByRatingId(array(12, 34)); // WHERE rating_id IN (12, 34)
     * $query->filterByRatingId(array('min' => 12)); // WHERE rating_id > 12
     * </code>
     *
     * @see       filterByRating()
     *
     * @param     mixed $ratingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByRatingId($ratingId = null, $comparison = null)
    {
        if (is_array($ratingId)) {
            $useMinMax = false;
            if (isset($ratingId['min'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_RATING_ID, $ratingId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratingId['max'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_RATING_ID, $ratingId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewTableMap::COL_RATING_ID, $ratingId, $comparison);
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
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UserReviewTableMap::COL_REVIEW, $review, $comparison);
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
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByUpvotes($upvotes = null, $comparison = null)
    {
        if (is_array($upvotes)) {
            $useMinMax = false;
            if (isset($upvotes['min'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_UPVOTES, $upvotes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($upvotes['max'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_UPVOTES, $upvotes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewTableMap::COL_UPVOTES, $upvotes, $comparison);
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
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByDownvotes($downvotes = null, $comparison = null)
    {
        if (is_array($downvotes)) {
            $useMinMax = false;
            if (isset($downvotes['min'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_DOWNVOTES, $downvotes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($downvotes['max'])) {
                $this->addUsingAlias(UserReviewTableMap::COL_DOWNVOTES, $downvotes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserReviewTableMap::COL_DOWNVOTES, $downvotes, $comparison);
    }

    /**
     * Filter the query by a related \Game object
     *
     * @param \Game|ObjectCollection $game The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByGame($game, $comparison = null)
    {
        if ($game instanceof \Game) {
            return $this
                ->addUsingAlias(UserReviewTableMap::COL_GAME_ID, $game->getId(), $comparison);
        } elseif ($game instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserReviewTableMap::COL_GAME_ID, $game->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
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
     * Filter the query by a related \Platform object
     *
     * @param \Platform|ObjectCollection $platform The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByPlatform($platform, $comparison = null)
    {
        if ($platform instanceof \Platform) {
            return $this
                ->addUsingAlias(UserReviewTableMap::COL_PLATFORM_ID, $platform->getId(), $comparison);
        } elseif ($platform instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserReviewTableMap::COL_PLATFORM_ID, $platform->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
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
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(UserReviewTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserReviewTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
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
     * Filter the query by a related \Rating object
     *
     * @param \Rating|ObjectCollection $rating The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByRating($rating, $comparison = null)
    {
        if ($rating instanceof \Rating) {
            return $this
                ->addUsingAlias(UserReviewTableMap::COL_RATING_ID, $rating->getId(), $comparison);
        } elseif ($rating instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserReviewTableMap::COL_RATING_ID, $rating->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRating() only accepts arguments of type \Rating or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Rating relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
     */
    public function joinRating($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Rating');

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
            $this->addJoinObject($join, 'Rating');
        }

        return $this;
    }

    /**
     * Use the Rating relation Rating object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RatingQuery A secondary query class using the current class as primary query
     */
    public function useRatingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRating($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Rating', '\RatingQuery');
    }

    /**
     * Filter the query by a related \Rig object
     *
     * @param \Rig|ObjectCollection $rig The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserReviewQuery The current query, for fluid interface
     */
    public function filterByRig($rig, $comparison = null)
    {
        if ($rig instanceof \Rig) {
            return $this
                ->addUsingAlias(UserReviewTableMap::COL_RIG_ID, $rig->getId(), $comparison);
        } elseif ($rig instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserReviewTableMap::COL_RIG_ID, $rig->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
     */
    public function joinRig($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useRigQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRig($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Rig', '\RigQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUserReview $userReview Object to remove from the list of results
     *
     * @return $this|ChildUserReviewQuery The current query, for fluid interface
     */
    public function prune($userReview = null)
    {
        if ($userReview) {
            $this->addUsingAlias(UserReviewTableMap::COL_ID, $userReview->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the user_review table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserReviewTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserReviewTableMap::clearInstancePool();
            UserReviewTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserReviewTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserReviewTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            UserReviewTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            UserReviewTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserReviewQuery
