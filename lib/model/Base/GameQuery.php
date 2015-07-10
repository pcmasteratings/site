<?php

namespace Base;

use \Game as ChildGame;
use \GameQuery as ChildGameQuery;
use \Exception;
use \PDO;
use Map\GameTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'game' table.
 *
 * 
 *
 * @method     ChildGameQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGameQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildGameQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildGameQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildGameQuery orderByPublisherId($order = Criteria::ASC) Order by the publisher_id column
 * @method     ChildGameQuery orderByDeveloperId($order = Criteria::ASC) Order by the developer_id column
 * @method     ChildGameQuery orderByGbId($order = Criteria::ASC) Order by the gb_id column
 * @method     ChildGameQuery orderByGbUrl($order = Criteria::ASC) Order by the gb_url column
 * @method     ChildGameQuery orderByGbImage($order = Criteria::ASC) Order by the gb_image column
 * @method     ChildGameQuery orderByGbThumb($order = Criteria::ASC) Order by the gb_thumb column
 *
 * @method     ChildGameQuery groupById() Group by the id column
 * @method     ChildGameQuery groupByName() Group by the name column
 * @method     ChildGameQuery groupByTitle() Group by the title column
 * @method     ChildGameQuery groupByDescription() Group by the description column
 * @method     ChildGameQuery groupByPublisherId() Group by the publisher_id column
 * @method     ChildGameQuery groupByDeveloperId() Group by the developer_id column
 * @method     ChildGameQuery groupByGbId() Group by the gb_id column
 * @method     ChildGameQuery groupByGbUrl() Group by the gb_url column
 * @method     ChildGameQuery groupByGbImage() Group by the gb_image column
 * @method     ChildGameQuery groupByGbThumb() Group by the gb_thumb column
 *
 * @method     ChildGameQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGameQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGameQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGameQuery leftJoinCompanyRelatedByPublisherId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompanyRelatedByPublisherId relation
 * @method     ChildGameQuery rightJoinCompanyRelatedByPublisherId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompanyRelatedByPublisherId relation
 * @method     ChildGameQuery innerJoinCompanyRelatedByPublisherId($relationAlias = null) Adds a INNER JOIN clause to the query using the CompanyRelatedByPublisherId relation
 *
 * @method     ChildGameQuery leftJoinCompanyRelatedByDeveloperId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompanyRelatedByDeveloperId relation
 * @method     ChildGameQuery rightJoinCompanyRelatedByDeveloperId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompanyRelatedByDeveloperId relation
 * @method     ChildGameQuery innerJoinCompanyRelatedByDeveloperId($relationAlias = null) Adds a INNER JOIN clause to the query using the CompanyRelatedByDeveloperId relation
 *
 * @method     ChildGameQuery leftJoinGameLink($relationAlias = null) Adds a LEFT JOIN clause to the query using the GameLink relation
 * @method     ChildGameQuery rightJoinGameLink($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GameLink relation
 * @method     ChildGameQuery innerJoinGameLink($relationAlias = null) Adds a INNER JOIN clause to the query using the GameLink relation
 *
 * @method     ChildGameQuery leftJoinGamePlatform($relationAlias = null) Adds a LEFT JOIN clause to the query using the GamePlatform relation
 * @method     ChildGameQuery rightJoinGamePlatform($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GamePlatform relation
 * @method     ChildGameQuery innerJoinGamePlatform($relationAlias = null) Adds a INNER JOIN clause to the query using the GamePlatform relation
 *
 * @method     ChildGameQuery leftJoinRatingHeader($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingHeader relation
 * @method     ChildGameQuery rightJoinRatingHeader($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingHeader relation
 * @method     ChildGameQuery innerJoinRatingHeader($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingHeader relation
 *
 * @method     ChildGameQuery leftJoinUserReview($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserReview relation
 * @method     ChildGameQuery rightJoinUserReview($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserReview relation
 * @method     ChildGameQuery innerJoinUserReview($relationAlias = null) Adds a INNER JOIN clause to the query using the UserReview relation
 *
 * @method     \CompanyQuery|\GameLinkQuery|\GamePlatformQuery|\RatingHeaderQuery|\UserReviewQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGame findOne(ConnectionInterface $con = null) Return the first ChildGame matching the query
 * @method     ChildGame findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGame matching the query, or a new ChildGame object populated from the query conditions when no match is found
 *
 * @method     ChildGame findOneById(string $id) Return the first ChildGame filtered by the id column
 * @method     ChildGame findOneByName(string $name) Return the first ChildGame filtered by the name column
 * @method     ChildGame findOneByTitle(string $title) Return the first ChildGame filtered by the title column
 * @method     ChildGame findOneByDescription(string $description) Return the first ChildGame filtered by the description column
 * @method     ChildGame findOneByPublisherId(string $publisher_id) Return the first ChildGame filtered by the publisher_id column
 * @method     ChildGame findOneByDeveloperId(string $developer_id) Return the first ChildGame filtered by the developer_id column
 * @method     ChildGame findOneByGbId(string $gb_id) Return the first ChildGame filtered by the gb_id column
 * @method     ChildGame findOneByGbUrl(string $gb_url) Return the first ChildGame filtered by the gb_url column
 * @method     ChildGame findOneByGbImage(string $gb_image) Return the first ChildGame filtered by the gb_image column
 * @method     ChildGame findOneByGbThumb(string $gb_thumb) Return the first ChildGame filtered by the gb_thumb column *

 * @method     ChildGame requirePk($key, ConnectionInterface $con = null) Return the ChildGame by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGame requireOne(ConnectionInterface $con = null) Return the first ChildGame matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGame requireOneById(string $id) Return the first ChildGame filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGame requireOneByName(string $name) Return the first ChildGame filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGame requireOneByTitle(string $title) Return the first ChildGame filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGame requireOneByDescription(string $description) Return the first ChildGame filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGame requireOneByPublisherId(string $publisher_id) Return the first ChildGame filtered by the publisher_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGame requireOneByDeveloperId(string $developer_id) Return the first ChildGame filtered by the developer_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGame requireOneByGbId(string $gb_id) Return the first ChildGame filtered by the gb_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGame requireOneByGbUrl(string $gb_url) Return the first ChildGame filtered by the gb_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGame requireOneByGbImage(string $gb_image) Return the first ChildGame filtered by the gb_image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGame requireOneByGbThumb(string $gb_thumb) Return the first ChildGame filtered by the gb_thumb column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGame[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGame objects based on current ModelCriteria
 * @method     ChildGame[]|ObjectCollection findById(string $id) Return ChildGame objects filtered by the id column
 * @method     ChildGame[]|ObjectCollection findByName(string $name) Return ChildGame objects filtered by the name column
 * @method     ChildGame[]|ObjectCollection findByTitle(string $title) Return ChildGame objects filtered by the title column
 * @method     ChildGame[]|ObjectCollection findByDescription(string $description) Return ChildGame objects filtered by the description column
 * @method     ChildGame[]|ObjectCollection findByPublisherId(string $publisher_id) Return ChildGame objects filtered by the publisher_id column
 * @method     ChildGame[]|ObjectCollection findByDeveloperId(string $developer_id) Return ChildGame objects filtered by the developer_id column
 * @method     ChildGame[]|ObjectCollection findByGbId(string $gb_id) Return ChildGame objects filtered by the gb_id column
 * @method     ChildGame[]|ObjectCollection findByGbUrl(string $gb_url) Return ChildGame objects filtered by the gb_url column
 * @method     ChildGame[]|ObjectCollection findByGbImage(string $gb_image) Return ChildGame objects filtered by the gb_image column
 * @method     ChildGame[]|ObjectCollection findByGbThumb(string $gb_thumb) Return ChildGame objects filtered by the gb_thumb column
 * @method     ChildGame[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GameQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\GameQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Game', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGameQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGameQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGameQuery) {
            return $criteria;
        }
        $query = new ChildGameQuery();
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
     * @return ChildGame|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GameTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GameTableMap::DATABASE_NAME);
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
     * @return ChildGame A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, title, description, publisher_id, developer_id, gb_id, gb_url, gb_image, gb_thumb FROM game WHERE id = :p0';
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
            /** @var ChildGame $obj */
            $obj = new ChildGame();
            $obj->hydrate($row);
            GameTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildGame|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GameTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GameTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GameTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GameTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GameTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GameTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GameTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the publisher_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPublisherId(1234); // WHERE publisher_id = 1234
     * $query->filterByPublisherId(array(12, 34)); // WHERE publisher_id IN (12, 34)
     * $query->filterByPublisherId(array('min' => 12)); // WHERE publisher_id > 12
     * </code>
     *
     * @see       filterByCompanyRelatedByPublisherId()
     *
     * @param     mixed $publisherId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function filterByPublisherId($publisherId = null, $comparison = null)
    {
        if (is_array($publisherId)) {
            $useMinMax = false;
            if (isset($publisherId['min'])) {
                $this->addUsingAlias(GameTableMap::COL_PUBLISHER_ID, $publisherId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($publisherId['max'])) {
                $this->addUsingAlias(GameTableMap::COL_PUBLISHER_ID, $publisherId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameTableMap::COL_PUBLISHER_ID, $publisherId, $comparison);
    }

    /**
     * Filter the query on the developer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDeveloperId(1234); // WHERE developer_id = 1234
     * $query->filterByDeveloperId(array(12, 34)); // WHERE developer_id IN (12, 34)
     * $query->filterByDeveloperId(array('min' => 12)); // WHERE developer_id > 12
     * </code>
     *
     * @see       filterByCompanyRelatedByDeveloperId()
     *
     * @param     mixed $developerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function filterByDeveloperId($developerId = null, $comparison = null)
    {
        if (is_array($developerId)) {
            $useMinMax = false;
            if (isset($developerId['min'])) {
                $this->addUsingAlias(GameTableMap::COL_DEVELOPER_ID, $developerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($developerId['max'])) {
                $this->addUsingAlias(GameTableMap::COL_DEVELOPER_ID, $developerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameTableMap::COL_DEVELOPER_ID, $developerId, $comparison);
    }

    /**
     * Filter the query on the gb_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGbId(1234); // WHERE gb_id = 1234
     * $query->filterByGbId(array(12, 34)); // WHERE gb_id IN (12, 34)
     * $query->filterByGbId(array('min' => 12)); // WHERE gb_id > 12
     * </code>
     *
     * @param     mixed $gbId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function filterByGbId($gbId = null, $comparison = null)
    {
        if (is_array($gbId)) {
            $useMinMax = false;
            if (isset($gbId['min'])) {
                $this->addUsingAlias(GameTableMap::COL_GB_ID, $gbId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gbId['max'])) {
                $this->addUsingAlias(GameTableMap::COL_GB_ID, $gbId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GameTableMap::COL_GB_ID, $gbId, $comparison);
    }

    /**
     * Filter the query on the gb_url column
     *
     * Example usage:
     * <code>
     * $query->filterByGbUrl('fooValue');   // WHERE gb_url = 'fooValue'
     * $query->filterByGbUrl('%fooValue%'); // WHERE gb_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gbUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function filterByGbUrl($gbUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gbUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gbUrl)) {
                $gbUrl = str_replace('*', '%', $gbUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GameTableMap::COL_GB_URL, $gbUrl, $comparison);
    }

    /**
     * Filter the query on the gb_image column
     *
     * Example usage:
     * <code>
     * $query->filterByGbImage('fooValue');   // WHERE gb_image = 'fooValue'
     * $query->filterByGbImage('%fooValue%'); // WHERE gb_image LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gbImage The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function filterByGbImage($gbImage = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gbImage)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gbImage)) {
                $gbImage = str_replace('*', '%', $gbImage);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GameTableMap::COL_GB_IMAGE, $gbImage, $comparison);
    }

    /**
     * Filter the query on the gb_thumb column
     *
     * Example usage:
     * <code>
     * $query->filterByGbThumb('fooValue');   // WHERE gb_thumb = 'fooValue'
     * $query->filterByGbThumb('%fooValue%'); // WHERE gb_thumb LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gbThumb The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function filterByGbThumb($gbThumb = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gbThumb)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $gbThumb)) {
                $gbThumb = str_replace('*', '%', $gbThumb);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GameTableMap::COL_GB_THUMB, $gbThumb, $comparison);
    }

    /**
     * Filter the query by a related \Company object
     *
     * @param \Company|ObjectCollection $company The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGameQuery The current query, for fluid interface
     */
    public function filterByCompanyRelatedByPublisherId($company, $comparison = null)
    {
        if ($company instanceof \Company) {
            return $this
                ->addUsingAlias(GameTableMap::COL_PUBLISHER_ID, $company->getId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GameTableMap::COL_PUBLISHER_ID, $company->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCompanyRelatedByPublisherId() only accepts arguments of type \Company or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompanyRelatedByPublisherId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function joinCompanyRelatedByPublisherId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompanyRelatedByPublisherId');

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
            $this->addJoinObject($join, 'CompanyRelatedByPublisherId');
        }

        return $this;
    }

    /**
     * Use the CompanyRelatedByPublisherId relation Company object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CompanyQuery A secondary query class using the current class as primary query
     */
    public function useCompanyRelatedByPublisherIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompanyRelatedByPublisherId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompanyRelatedByPublisherId', '\CompanyQuery');
    }

    /**
     * Filter the query by a related \Company object
     *
     * @param \Company|ObjectCollection $company The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGameQuery The current query, for fluid interface
     */
    public function filterByCompanyRelatedByDeveloperId($company, $comparison = null)
    {
        if ($company instanceof \Company) {
            return $this
                ->addUsingAlias(GameTableMap::COL_DEVELOPER_ID, $company->getId(), $comparison);
        } elseif ($company instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GameTableMap::COL_DEVELOPER_ID, $company->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCompanyRelatedByDeveloperId() only accepts arguments of type \Company or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompanyRelatedByDeveloperId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function joinCompanyRelatedByDeveloperId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompanyRelatedByDeveloperId');

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
            $this->addJoinObject($join, 'CompanyRelatedByDeveloperId');
        }

        return $this;
    }

    /**
     * Use the CompanyRelatedByDeveloperId relation Company object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CompanyQuery A secondary query class using the current class as primary query
     */
    public function useCompanyRelatedByDeveloperIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompanyRelatedByDeveloperId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompanyRelatedByDeveloperId', '\CompanyQuery');
    }

    /**
     * Filter the query by a related \GameLink object
     *
     * @param \GameLink|ObjectCollection $gameLink the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGameQuery The current query, for fluid interface
     */
    public function filterByGameLink($gameLink, $comparison = null)
    {
        if ($gameLink instanceof \GameLink) {
            return $this
                ->addUsingAlias(GameTableMap::COL_ID, $gameLink->getGameId(), $comparison);
        } elseif ($gameLink instanceof ObjectCollection) {
            return $this
                ->useGameLinkQuery()
                ->filterByPrimaryKeys($gameLink->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGameLink() only accepts arguments of type \GameLink or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GameLink relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function joinGameLink($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GameLink');

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
            $this->addJoinObject($join, 'GameLink');
        }

        return $this;
    }

    /**
     * Use the GameLink relation GameLink object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GameLinkQuery A secondary query class using the current class as primary query
     */
    public function useGameLinkQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGameLink($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GameLink', '\GameLinkQuery');
    }

    /**
     * Filter the query by a related \GamePlatform object
     *
     * @param \GamePlatform|ObjectCollection $gamePlatform the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGameQuery The current query, for fluid interface
     */
    public function filterByGamePlatform($gamePlatform, $comparison = null)
    {
        if ($gamePlatform instanceof \GamePlatform) {
            return $this
                ->addUsingAlias(GameTableMap::COL_ID, $gamePlatform->getGameId(), $comparison);
        } elseif ($gamePlatform instanceof ObjectCollection) {
            return $this
                ->useGamePlatformQuery()
                ->filterByPrimaryKeys($gamePlatform->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGamePlatform() only accepts arguments of type \GamePlatform or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GamePlatform relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function joinGamePlatform($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GamePlatform');

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
            $this->addJoinObject($join, 'GamePlatform');
        }

        return $this;
    }

    /**
     * Use the GamePlatform relation GamePlatform object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GamePlatformQuery A secondary query class using the current class as primary query
     */
    public function useGamePlatformQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGamePlatform($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GamePlatform', '\GamePlatformQuery');
    }

    /**
     * Filter the query by a related \RatingHeader object
     *
     * @param \RatingHeader|ObjectCollection $ratingHeader the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGameQuery The current query, for fluid interface
     */
    public function filterByRatingHeader($ratingHeader, $comparison = null)
    {
        if ($ratingHeader instanceof \RatingHeader) {
            return $this
                ->addUsingAlias(GameTableMap::COL_ID, $ratingHeader->getGameId(), $comparison);
        } elseif ($ratingHeader instanceof ObjectCollection) {
            return $this
                ->useRatingHeaderQuery()
                ->filterByPrimaryKeys($ratingHeader->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRatingHeader() only accepts arguments of type \RatingHeader or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RatingHeader relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function joinRatingHeader($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RatingHeader');

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
            $this->addJoinObject($join, 'RatingHeader');
        }

        return $this;
    }

    /**
     * Use the RatingHeader relation RatingHeader object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RatingHeaderQuery A secondary query class using the current class as primary query
     */
    public function useRatingHeaderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRatingHeader($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RatingHeader', '\RatingHeaderQuery');
    }

    /**
     * Filter the query by a related \UserReview object
     *
     * @param \UserReview|ObjectCollection $userReview the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGameQuery The current query, for fluid interface
     */
    public function filterByUserReview($userReview, $comparison = null)
    {
        if ($userReview instanceof \UserReview) {
            return $this
                ->addUsingAlias(GameTableMap::COL_ID, $userReview->getGameId(), $comparison);
        } elseif ($userReview instanceof ObjectCollection) {
            return $this
                ->useUserReviewQuery()
                ->filterByPrimaryKeys($userReview->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserReview() only accepts arguments of type \UserReview or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserReview relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function joinUserReview($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserReview');

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
            $this->addJoinObject($join, 'UserReview');
        }

        return $this;
    }

    /**
     * Use the UserReview relation UserReview object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserReviewQuery A secondary query class using the current class as primary query
     */
    public function useUserReviewQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserReview($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserReview', '\UserReviewQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGame $game Object to remove from the list of results
     *
     * @return $this|ChildGameQuery The current query, for fluid interface
     */
    public function prune($game = null)
    {
        if ($game) {
            $this->addUsingAlias(GameTableMap::COL_ID, $game->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the game table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GameTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GameTableMap::clearInstancePool();
            GameTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GameTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GameTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            GameTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            GameTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GameQuery
