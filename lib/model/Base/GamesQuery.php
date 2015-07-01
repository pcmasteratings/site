<?php

namespace Base;

use \Games as ChildGames;
use \GamesQuery as ChildGamesQuery;
use \Exception;
use \PDO;
use Map\GamesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'games' table.
 *
 * 
 *
 * @method     ChildGamesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGamesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildGamesQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildGamesQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildGamesQuery orderByPublisherId($order = Criteria::ASC) Order by the publisher_id column
 * @method     ChildGamesQuery orderByDeveloperId($order = Criteria::ASC) Order by the developer_id column
 * @method     ChildGamesQuery orderByPort($order = Criteria::ASC) Order by the port column
 *
 * @method     ChildGamesQuery groupById() Group by the id column
 * @method     ChildGamesQuery groupByName() Group by the name column
 * @method     ChildGamesQuery groupByTitle() Group by the title column
 * @method     ChildGamesQuery groupByDescription() Group by the description column
 * @method     ChildGamesQuery groupByPublisherId() Group by the publisher_id column
 * @method     ChildGamesQuery groupByDeveloperId() Group by the developer_id column
 * @method     ChildGamesQuery groupByPort() Group by the port column
 *
 * @method     ChildGamesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGamesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGamesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGamesQuery leftJoinCompaniesRelatedByPublisherId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompaniesRelatedByPublisherId relation
 * @method     ChildGamesQuery rightJoinCompaniesRelatedByPublisherId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompaniesRelatedByPublisherId relation
 * @method     ChildGamesQuery innerJoinCompaniesRelatedByPublisherId($relationAlias = null) Adds a INNER JOIN clause to the query using the CompaniesRelatedByPublisherId relation
 *
 * @method     ChildGamesQuery leftJoinCompaniesRelatedByDeveloperId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompaniesRelatedByDeveloperId relation
 * @method     ChildGamesQuery rightJoinCompaniesRelatedByDeveloperId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompaniesRelatedByDeveloperId relation
 * @method     ChildGamesQuery innerJoinCompaniesRelatedByDeveloperId($relationAlias = null) Adds a INNER JOIN clause to the query using the CompaniesRelatedByDeveloperId relation
 *
 * @method     ChildGamesQuery leftJoinGameLinks($relationAlias = null) Adds a LEFT JOIN clause to the query using the GameLinks relation
 * @method     ChildGamesQuery rightJoinGameLinks($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GameLinks relation
 * @method     ChildGamesQuery innerJoinGameLinks($relationAlias = null) Adds a INNER JOIN clause to the query using the GameLinks relation
 *
 * @method     ChildGamesQuery leftJoinRatingHeaders($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingHeaders relation
 * @method     ChildGamesQuery rightJoinRatingHeaders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingHeaders relation
 * @method     ChildGamesQuery innerJoinRatingHeaders($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingHeaders relation
 *
 * @method     \CompaniesQuery|\GameLinksQuery|\RatingHeadersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGames findOne(ConnectionInterface $con = null) Return the first ChildGames matching the query
 * @method     ChildGames findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGames matching the query, or a new ChildGames object populated from the query conditions when no match is found
 *
 * @method     ChildGames findOneById(string $id) Return the first ChildGames filtered by the id column
 * @method     ChildGames findOneByName(string $name) Return the first ChildGames filtered by the name column
 * @method     ChildGames findOneByTitle(string $title) Return the first ChildGames filtered by the title column
 * @method     ChildGames findOneByDescription(string $description) Return the first ChildGames filtered by the description column
 * @method     ChildGames findOneByPublisherId(string $publisher_id) Return the first ChildGames filtered by the publisher_id column
 * @method     ChildGames findOneByDeveloperId(string $developer_id) Return the first ChildGames filtered by the developer_id column
 * @method     ChildGames findOneByPort(boolean $port) Return the first ChildGames filtered by the port column *

 * @method     ChildGames requirePk($key, ConnectionInterface $con = null) Return the ChildGames by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGames requireOne(ConnectionInterface $con = null) Return the first ChildGames matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGames requireOneById(string $id) Return the first ChildGames filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGames requireOneByName(string $name) Return the first ChildGames filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGames requireOneByTitle(string $title) Return the first ChildGames filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGames requireOneByDescription(string $description) Return the first ChildGames filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGames requireOneByPublisherId(string $publisher_id) Return the first ChildGames filtered by the publisher_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGames requireOneByDeveloperId(string $developer_id) Return the first ChildGames filtered by the developer_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGames requireOneByPort(boolean $port) Return the first ChildGames filtered by the port column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGames[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGames objects based on current ModelCriteria
 * @method     ChildGames[]|ObjectCollection findById(string $id) Return ChildGames objects filtered by the id column
 * @method     ChildGames[]|ObjectCollection findByName(string $name) Return ChildGames objects filtered by the name column
 * @method     ChildGames[]|ObjectCollection findByTitle(string $title) Return ChildGames objects filtered by the title column
 * @method     ChildGames[]|ObjectCollection findByDescription(string $description) Return ChildGames objects filtered by the description column
 * @method     ChildGames[]|ObjectCollection findByPublisherId(string $publisher_id) Return ChildGames objects filtered by the publisher_id column
 * @method     ChildGames[]|ObjectCollection findByDeveloperId(string $developer_id) Return ChildGames objects filtered by the developer_id column
 * @method     ChildGames[]|ObjectCollection findByPort(boolean $port) Return ChildGames objects filtered by the port column
 * @method     ChildGames[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GamesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\GamesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Games', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGamesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGamesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGamesQuery) {
            return $criteria;
        }
        $query = new ChildGamesQuery();
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
     * @return ChildGames|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GamesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GamesTableMap::DATABASE_NAME);
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
     * @return ChildGames A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, title, description, publisher_id, developer_id, port FROM games WHERE id = :p0';
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
            /** @var ChildGames $obj */
            $obj = new ChildGames();
            $obj->hydrate($row);
            GamesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildGames|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGamesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GamesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGamesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GamesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildGamesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GamesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GamesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamesTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildGamesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(GamesTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildGamesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(GamesTableMap::COL_TITLE, $title, $comparison);
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
     * @return $this|ChildGamesQuery The current query, for fluid interface
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

        return $this->addUsingAlias(GamesTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @see       filterByCompaniesRelatedByPublisherId()
     *
     * @param     mixed $publisherId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGamesQuery The current query, for fluid interface
     */
    public function filterByPublisherId($publisherId = null, $comparison = null)
    {
        if (is_array($publisherId)) {
            $useMinMax = false;
            if (isset($publisherId['min'])) {
                $this->addUsingAlias(GamesTableMap::COL_PUBLISHER_ID, $publisherId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($publisherId['max'])) {
                $this->addUsingAlias(GamesTableMap::COL_PUBLISHER_ID, $publisherId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamesTableMap::COL_PUBLISHER_ID, $publisherId, $comparison);
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
     * @see       filterByCompaniesRelatedByDeveloperId()
     *
     * @param     mixed $developerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGamesQuery The current query, for fluid interface
     */
    public function filterByDeveloperId($developerId = null, $comparison = null)
    {
        if (is_array($developerId)) {
            $useMinMax = false;
            if (isset($developerId['min'])) {
                $this->addUsingAlias(GamesTableMap::COL_DEVELOPER_ID, $developerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($developerId['max'])) {
                $this->addUsingAlias(GamesTableMap::COL_DEVELOPER_ID, $developerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GamesTableMap::COL_DEVELOPER_ID, $developerId, $comparison);
    }

    /**
     * Filter the query on the port column
     *
     * Example usage:
     * <code>
     * $query->filterByPort(true); // WHERE port = true
     * $query->filterByPort('yes'); // WHERE port = true
     * </code>
     *
     * @param     boolean|string $port The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGamesQuery The current query, for fluid interface
     */
    public function filterByPort($port = null, $comparison = null)
    {
        if (is_string($port)) {
            $port = in_array(strtolower($port), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(GamesTableMap::COL_PORT, $port, $comparison);
    }

    /**
     * Filter the query by a related \Companies object
     *
     * @param \Companies|ObjectCollection $companies The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGamesQuery The current query, for fluid interface
     */
    public function filterByCompaniesRelatedByPublisherId($companies, $comparison = null)
    {
        if ($companies instanceof \Companies) {
            return $this
                ->addUsingAlias(GamesTableMap::COL_PUBLISHER_ID, $companies->getId(), $comparison);
        } elseif ($companies instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GamesTableMap::COL_PUBLISHER_ID, $companies->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCompaniesRelatedByPublisherId() only accepts arguments of type \Companies or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompaniesRelatedByPublisherId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGamesQuery The current query, for fluid interface
     */
    public function joinCompaniesRelatedByPublisherId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompaniesRelatedByPublisherId');

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
            $this->addJoinObject($join, 'CompaniesRelatedByPublisherId');
        }

        return $this;
    }

    /**
     * Use the CompaniesRelatedByPublisherId relation Companies object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CompaniesQuery A secondary query class using the current class as primary query
     */
    public function useCompaniesRelatedByPublisherIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompaniesRelatedByPublisherId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompaniesRelatedByPublisherId', '\CompaniesQuery');
    }

    /**
     * Filter the query by a related \Companies object
     *
     * @param \Companies|ObjectCollection $companies The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGamesQuery The current query, for fluid interface
     */
    public function filterByCompaniesRelatedByDeveloperId($companies, $comparison = null)
    {
        if ($companies instanceof \Companies) {
            return $this
                ->addUsingAlias(GamesTableMap::COL_DEVELOPER_ID, $companies->getId(), $comparison);
        } elseif ($companies instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GamesTableMap::COL_DEVELOPER_ID, $companies->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCompaniesRelatedByDeveloperId() only accepts arguments of type \Companies or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompaniesRelatedByDeveloperId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGamesQuery The current query, for fluid interface
     */
    public function joinCompaniesRelatedByDeveloperId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompaniesRelatedByDeveloperId');

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
            $this->addJoinObject($join, 'CompaniesRelatedByDeveloperId');
        }

        return $this;
    }

    /**
     * Use the CompaniesRelatedByDeveloperId relation Companies object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CompaniesQuery A secondary query class using the current class as primary query
     */
    public function useCompaniesRelatedByDeveloperIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompaniesRelatedByDeveloperId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompaniesRelatedByDeveloperId', '\CompaniesQuery');
    }

    /**
     * Filter the query by a related \GameLinks object
     *
     * @param \GameLinks|ObjectCollection $gameLinks the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGamesQuery The current query, for fluid interface
     */
    public function filterByGameLinks($gameLinks, $comparison = null)
    {
        if ($gameLinks instanceof \GameLinks) {
            return $this
                ->addUsingAlias(GamesTableMap::COL_ID, $gameLinks->getGameId(), $comparison);
        } elseif ($gameLinks instanceof ObjectCollection) {
            return $this
                ->useGameLinksQuery()
                ->filterByPrimaryKeys($gameLinks->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGameLinks() only accepts arguments of type \GameLinks or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GameLinks relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGamesQuery The current query, for fluid interface
     */
    public function joinGameLinks($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GameLinks');

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
            $this->addJoinObject($join, 'GameLinks');
        }

        return $this;
    }

    /**
     * Use the GameLinks relation GameLinks object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GameLinksQuery A secondary query class using the current class as primary query
     */
    public function useGameLinksQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGameLinks($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GameLinks', '\GameLinksQuery');
    }

    /**
     * Filter the query by a related \RatingHeaders object
     *
     * @param \RatingHeaders|ObjectCollection $ratingHeaders the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildGamesQuery The current query, for fluid interface
     */
    public function filterByRatingHeaders($ratingHeaders, $comparison = null)
    {
        if ($ratingHeaders instanceof \RatingHeaders) {
            return $this
                ->addUsingAlias(GamesTableMap::COL_ID, $ratingHeaders->getGameId(), $comparison);
        } elseif ($ratingHeaders instanceof ObjectCollection) {
            return $this
                ->useRatingHeadersQuery()
                ->filterByPrimaryKeys($ratingHeaders->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRatingHeaders() only accepts arguments of type \RatingHeaders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RatingHeaders relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildGamesQuery The current query, for fluid interface
     */
    public function joinRatingHeaders($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RatingHeaders');

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
            $this->addJoinObject($join, 'RatingHeaders');
        }

        return $this;
    }

    /**
     * Use the RatingHeaders relation RatingHeaders object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RatingHeadersQuery A secondary query class using the current class as primary query
     */
    public function useRatingHeadersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRatingHeaders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RatingHeaders', '\RatingHeadersQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGames $games Object to remove from the list of results
     *
     * @return $this|ChildGamesQuery The current query, for fluid interface
     */
    public function prune($games = null)
    {
        if ($games) {
            $this->addUsingAlias(GamesTableMap::COL_ID, $games->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the games table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GamesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GamesTableMap::clearInstancePool();
            GamesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GamesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GamesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            GamesTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            GamesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GamesQuery
