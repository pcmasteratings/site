<?php

namespace Base;

use \CategoryOption as ChildCategoryOption;
use \CategoryOptionQuery as ChildCategoryOptionQuery;
use \Exception;
use \PDO;
use Map\CategoryOptionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'category_option' table.
 *
 * 
 *
 * @method     ChildCategoryOptionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCategoryOptionQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 * @method     ChildCategoryOptionQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildCategoryOptionQuery orderByComment($order = Criteria::ASC) Order by the comment column
 * @method     ChildCategoryOptionQuery orderByModComment($order = Criteria::ASC) Order by the mod_comment column
 * @method     ChildCategoryOptionQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     ChildCategoryOptionQuery orderBySequence($order = Criteria::ASC) Order by the sequence column
 * @method     ChildCategoryOptionQuery orderByParentId($order = Criteria::ASC) Order by the parent_id column
 *
 * @method     ChildCategoryOptionQuery groupById() Group by the id column
 * @method     ChildCategoryOptionQuery groupByCategoryId() Group by the category_id column
 * @method     ChildCategoryOptionQuery groupByDescription() Group by the description column
 * @method     ChildCategoryOptionQuery groupByComment() Group by the comment column
 * @method     ChildCategoryOptionQuery groupByModComment() Group by the mod_comment column
 * @method     ChildCategoryOptionQuery groupByValue() Group by the value column
 * @method     ChildCategoryOptionQuery groupBySequence() Group by the sequence column
 * @method     ChildCategoryOptionQuery groupByParentId() Group by the parent_id column
 *
 * @method     ChildCategoryOptionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCategoryOptionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCategoryOptionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCategoryOptionQuery leftJoinCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the Category relation
 * @method     ChildCategoryOptionQuery rightJoinCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Category relation
 * @method     ChildCategoryOptionQuery innerJoinCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the Category relation
 *
 * @method     ChildCategoryOptionQuery leftJoinCategoryOptionRelatedByParentId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryOptionRelatedByParentId relation
 * @method     ChildCategoryOptionQuery rightJoinCategoryOptionRelatedByParentId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryOptionRelatedByParentId relation
 * @method     ChildCategoryOptionQuery innerJoinCategoryOptionRelatedByParentId($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryOptionRelatedByParentId relation
 *
 * @method     ChildCategoryOptionQuery leftJoinCategoryOptionRelatedById($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryOptionRelatedById relation
 * @method     ChildCategoryOptionQuery rightJoinCategoryOptionRelatedById($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryOptionRelatedById relation
 * @method     ChildCategoryOptionQuery innerJoinCategoryOptionRelatedById($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryOptionRelatedById relation
 *
 * @method     ChildCategoryOptionQuery leftJoinRatingValue($relationAlias = null) Adds a LEFT JOIN clause to the query using the RatingValue relation
 * @method     ChildCategoryOptionQuery rightJoinRatingValue($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RatingValue relation
 * @method     ChildCategoryOptionQuery innerJoinRatingValue($relationAlias = null) Adds a INNER JOIN clause to the query using the RatingValue relation
 *
 * @method     \CategoryQuery|\CategoryOptionQuery|\RatingValueQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCategoryOption findOne(ConnectionInterface $con = null) Return the first ChildCategoryOption matching the query
 * @method     ChildCategoryOption findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCategoryOption matching the query, or a new ChildCategoryOption object populated from the query conditions when no match is found
 *
 * @method     ChildCategoryOption findOneById(string $id) Return the first ChildCategoryOption filtered by the id column
 * @method     ChildCategoryOption findOneByCategoryId(string $category_id) Return the first ChildCategoryOption filtered by the category_id column
 * @method     ChildCategoryOption findOneByDescription(string $description) Return the first ChildCategoryOption filtered by the description column
 * @method     ChildCategoryOption findOneByComment(string $comment) Return the first ChildCategoryOption filtered by the comment column
 * @method     ChildCategoryOption findOneByModComment(string $mod_comment) Return the first ChildCategoryOption filtered by the mod_comment column
 * @method     ChildCategoryOption findOneByValue(int $value) Return the first ChildCategoryOption filtered by the value column
 * @method     ChildCategoryOption findOneBySequence(int $sequence) Return the first ChildCategoryOption filtered by the sequence column
 * @method     ChildCategoryOption findOneByParentId(string $parent_id) Return the first ChildCategoryOption filtered by the parent_id column *

 * @method     ChildCategoryOption requirePk($key, ConnectionInterface $con = null) Return the ChildCategoryOption by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoryOption requireOne(ConnectionInterface $con = null) Return the first ChildCategoryOption matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategoryOption requireOneById(string $id) Return the first ChildCategoryOption filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoryOption requireOneByCategoryId(string $category_id) Return the first ChildCategoryOption filtered by the category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoryOption requireOneByDescription(string $description) Return the first ChildCategoryOption filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoryOption requireOneByComment(string $comment) Return the first ChildCategoryOption filtered by the comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoryOption requireOneByModComment(string $mod_comment) Return the first ChildCategoryOption filtered by the mod_comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoryOption requireOneByValue(int $value) Return the first ChildCategoryOption filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoryOption requireOneBySequence(int $sequence) Return the first ChildCategoryOption filtered by the sequence column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoryOption requireOneByParentId(string $parent_id) Return the first ChildCategoryOption filtered by the parent_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategoryOption[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCategoryOption objects based on current ModelCriteria
 * @method     ChildCategoryOption[]|ObjectCollection findById(string $id) Return ChildCategoryOption objects filtered by the id column
 * @method     ChildCategoryOption[]|ObjectCollection findByCategoryId(string $category_id) Return ChildCategoryOption objects filtered by the category_id column
 * @method     ChildCategoryOption[]|ObjectCollection findByDescription(string $description) Return ChildCategoryOption objects filtered by the description column
 * @method     ChildCategoryOption[]|ObjectCollection findByComment(string $comment) Return ChildCategoryOption objects filtered by the comment column
 * @method     ChildCategoryOption[]|ObjectCollection findByModComment(string $mod_comment) Return ChildCategoryOption objects filtered by the mod_comment column
 * @method     ChildCategoryOption[]|ObjectCollection findByValue(int $value) Return ChildCategoryOption objects filtered by the value column
 * @method     ChildCategoryOption[]|ObjectCollection findBySequence(int $sequence) Return ChildCategoryOption objects filtered by the sequence column
 * @method     ChildCategoryOption[]|ObjectCollection findByParentId(string $parent_id) Return ChildCategoryOption objects filtered by the parent_id column
 * @method     ChildCategoryOption[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CategoryOptionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CategoryOptionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CategoryOption', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCategoryOptionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCategoryOptionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCategoryOptionQuery) {
            return $criteria;
        }
        $query = new ChildCategoryOptionQuery();
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
     * @return ChildCategoryOption|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CategoryOptionTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CategoryOptionTableMap::DATABASE_NAME);
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
     * @return ChildCategoryOption A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, category_id, description, comment, mod_comment, value, sequence, parent_id FROM category_option WHERE id = :p0';
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
            /** @var ChildCategoryOption $obj */
            $obj = new ChildCategoryOption();
            $obj->hydrate($row);
            CategoryOptionTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCategoryOption|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CategoryOptionTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CategoryOptionTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CategoryOptionTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CategoryOptionTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryOptionTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryId(1234); // WHERE category_id = 1234
     * $query->filterByCategoryId(array(12, 34)); // WHERE category_id IN (12, 34)
     * $query->filterByCategoryId(array('min' => 12)); // WHERE category_id > 12
     * </code>
     *
     * @see       filterByCategory()
     *
     * @param     mixed $categoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function filterByCategoryId($categoryId = null, $comparison = null)
    {
        if (is_array($categoryId)) {
            $useMinMax = false;
            if (isset($categoryId['min'])) {
                $this->addUsingAlias(CategoryOptionTableMap::COL_CATEGORY_ID, $categoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryId['max'])) {
                $this->addUsingAlias(CategoryOptionTableMap::COL_CATEGORY_ID, $categoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryOptionTableMap::COL_CATEGORY_ID, $categoryId, $comparison);
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
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CategoryOptionTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the comment column
     *
     * Example usage:
     * <code>
     * $query->filterByComment('fooValue');   // WHERE comment = 'fooValue'
     * $query->filterByComment('%fooValue%'); // WHERE comment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comment The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function filterByComment($comment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comment)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $comment)) {
                $comment = str_replace('*', '%', $comment);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CategoryOptionTableMap::COL_COMMENT, $comment, $comparison);
    }

    /**
     * Filter the query on the mod_comment column
     *
     * Example usage:
     * <code>
     * $query->filterByModComment('fooValue');   // WHERE mod_comment = 'fooValue'
     * $query->filterByModComment('%fooValue%'); // WHERE mod_comment LIKE '%fooValue%'
     * </code>
     *
     * @param     string $modComment The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function filterByModComment($modComment = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($modComment)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $modComment)) {
                $modComment = str_replace('*', '%', $modComment);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CategoryOptionTableMap::COL_MOD_COMMENT, $modComment, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue(1234); // WHERE value = 1234
     * $query->filterByValue(array(12, 34)); // WHERE value IN (12, 34)
     * $query->filterByValue(array('min' => 12)); // WHERE value > 12
     * </code>
     *
     * @param     mixed $value The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (is_array($value)) {
            $useMinMax = false;
            if (isset($value['min'])) {
                $this->addUsingAlias(CategoryOptionTableMap::COL_VALUE, $value['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($value['max'])) {
                $this->addUsingAlias(CategoryOptionTableMap::COL_VALUE, $value['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryOptionTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query on the sequence column
     *
     * Example usage:
     * <code>
     * $query->filterBySequence(1234); // WHERE sequence = 1234
     * $query->filterBySequence(array(12, 34)); // WHERE sequence IN (12, 34)
     * $query->filterBySequence(array('min' => 12)); // WHERE sequence > 12
     * </code>
     *
     * @param     mixed $sequence The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function filterBySequence($sequence = null, $comparison = null)
    {
        if (is_array($sequence)) {
            $useMinMax = false;
            if (isset($sequence['min'])) {
                $this->addUsingAlias(CategoryOptionTableMap::COL_SEQUENCE, $sequence['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sequence['max'])) {
                $this->addUsingAlias(CategoryOptionTableMap::COL_SEQUENCE, $sequence['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryOptionTableMap::COL_SEQUENCE, $sequence, $comparison);
    }

    /**
     * Filter the query on the parent_id column
     *
     * Example usage:
     * <code>
     * $query->filterByParentId(1234); // WHERE parent_id = 1234
     * $query->filterByParentId(array(12, 34)); // WHERE parent_id IN (12, 34)
     * $query->filterByParentId(array('min' => 12)); // WHERE parent_id > 12
     * </code>
     *
     * @see       filterByCategoryOptionRelatedByParentId()
     *
     * @param     mixed $parentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function filterByParentId($parentId = null, $comparison = null)
    {
        if (is_array($parentId)) {
            $useMinMax = false;
            if (isset($parentId['min'])) {
                $this->addUsingAlias(CategoryOptionTableMap::COL_PARENT_ID, $parentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parentId['max'])) {
                $this->addUsingAlias(CategoryOptionTableMap::COL_PARENT_ID, $parentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoryOptionTableMap::COL_PARENT_ID, $parentId, $comparison);
    }

    /**
     * Filter the query by a related \Category object
     *
     * @param \Category|ObjectCollection $category The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function filterByCategory($category, $comparison = null)
    {
        if ($category instanceof \Category) {
            return $this
                ->addUsingAlias(CategoryOptionTableMap::COL_CATEGORY_ID, $category->getId(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategoryOptionTableMap::COL_CATEGORY_ID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategory() only accepts arguments of type \Category or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Category relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function joinCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Category');

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
            $this->addJoinObject($join, 'Category');
        }

        return $this;
    }

    /**
     * Use the Category relation Category object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CategoryQuery A secondary query class using the current class as primary query
     */
    public function useCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Category', '\CategoryQuery');
    }

    /**
     * Filter the query by a related \CategoryOption object
     *
     * @param \CategoryOption|ObjectCollection $categoryOption The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function filterByCategoryOptionRelatedByParentId($categoryOption, $comparison = null)
    {
        if ($categoryOption instanceof \CategoryOption) {
            return $this
                ->addUsingAlias(CategoryOptionTableMap::COL_PARENT_ID, $categoryOption->getId(), $comparison);
        } elseif ($categoryOption instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CategoryOptionTableMap::COL_PARENT_ID, $categoryOption->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategoryOptionRelatedByParentId() only accepts arguments of type \CategoryOption or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryOptionRelatedByParentId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function joinCategoryOptionRelatedByParentId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryOptionRelatedByParentId');

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
            $this->addJoinObject($join, 'CategoryOptionRelatedByParentId');
        }

        return $this;
    }

    /**
     * Use the CategoryOptionRelatedByParentId relation CategoryOption object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CategoryOptionQuery A secondary query class using the current class as primary query
     */
    public function useCategoryOptionRelatedByParentIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCategoryOptionRelatedByParentId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryOptionRelatedByParentId', '\CategoryOptionQuery');
    }

    /**
     * Filter the query by a related \CategoryOption object
     *
     * @param \CategoryOption|ObjectCollection $categoryOption the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function filterByCategoryOptionRelatedById($categoryOption, $comparison = null)
    {
        if ($categoryOption instanceof \CategoryOption) {
            return $this
                ->addUsingAlias(CategoryOptionTableMap::COL_ID, $categoryOption->getParentId(), $comparison);
        } elseif ($categoryOption instanceof ObjectCollection) {
            return $this
                ->useCategoryOptionRelatedByIdQuery()
                ->filterByPrimaryKeys($categoryOption->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCategoryOptionRelatedById() only accepts arguments of type \CategoryOption or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryOptionRelatedById relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function joinCategoryOptionRelatedById($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryOptionRelatedById');

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
            $this->addJoinObject($join, 'CategoryOptionRelatedById');
        }

        return $this;
    }

    /**
     * Use the CategoryOptionRelatedById relation CategoryOption object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CategoryOptionQuery A secondary query class using the current class as primary query
     */
    public function useCategoryOptionRelatedByIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCategoryOptionRelatedById($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryOptionRelatedById', '\CategoryOptionQuery');
    }

    /**
     * Filter the query by a related \RatingValue object
     *
     * @param \RatingValue|ObjectCollection $ratingValue the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function filterByRatingValue($ratingValue, $comparison = null)
    {
        if ($ratingValue instanceof \RatingValue) {
            return $this
                ->addUsingAlias(CategoryOptionTableMap::COL_ID, $ratingValue->getCategoryOptionId(), $comparison);
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
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
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
     * @param   ChildCategoryOption $categoryOption Object to remove from the list of results
     *
     * @return $this|ChildCategoryOptionQuery The current query, for fluid interface
     */
    public function prune($categoryOption = null)
    {
        if ($categoryOption) {
            $this->addUsingAlias(CategoryOptionTableMap::COL_ID, $categoryOption->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the category_option table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryOptionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CategoryOptionTableMap::clearInstancePool();
            CategoryOptionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryOptionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CategoryOptionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            CategoryOptionTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            CategoryOptionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CategoryOptionQuery
