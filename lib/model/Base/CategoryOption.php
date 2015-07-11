<?php

namespace Base;

use \Category as ChildCategory;
use \CategoryOption as ChildCategoryOption;
use \CategoryOptionQuery as ChildCategoryOptionQuery;
use \CategoryQuery as ChildCategoryQuery;
use \RatingValue as ChildRatingValue;
use \RatingValueQuery as ChildRatingValueQuery;
use \Exception;
use \PDO;
use Map\CategoryOptionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'category_option' table.
 *
 * 
 *
* @package    propel.generator..Base
*/
abstract class CategoryOption implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\CategoryOptionTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     * @var        string
     */
    protected $id;

    /**
     * The value for the category_id field.
     * @var        string
     */
    protected $category_id;

    /**
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the comment field.
     * @var        string
     */
    protected $comment;

    /**
     * The value for the value field.
     * @var        int
     */
    protected $value;

    /**
     * The value for the sequence field.
     * @var        int
     */
    protected $sequence;

    /**
     * The value for the parent_id field.
     * @var        string
     */
    protected $parent_id;

    /**
     * @var        ChildCategoryOption
     */
    protected $aCategoryOptionRelatedByParentId;

    /**
     * @var        ChildCategory
     */
    protected $aCategory;

    /**
     * @var        ObjectCollection|ChildCategoryOption[] Collection to store aggregation of ChildCategoryOption objects.
     */
    protected $collCategoryOptionsRelatedById;
    protected $collCategoryOptionsRelatedByIdPartial;

    /**
     * @var        ObjectCollection|ChildRatingValue[] Collection to store aggregation of ChildRatingValue objects.
     */
    protected $collRatingValues;
    protected $collRatingValuesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildCategoryOption[]
     */
    protected $categoryOptionsRelatedByIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRatingValue[]
     */
    protected $ratingValuesScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\CategoryOption object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>CategoryOption</code> instance.  If
     * <code>obj</code> is an instance of <code>CategoryOption</code>, delegates to
     * <code>equals(CategoryOption)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|CategoryOption The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     * 
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [category_id] column value.
     * 
     * @return string
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Get the [description] column value.
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [comment] column value.
     * 
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Get the [value] column value.
     * 
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the [sequence] column value.
     * 
     * @return int
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Get the [parent_id] column value.
     * 
     * @return string
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Set the value of [id] column.
     * 
     * @param string $v new value
     * @return $this|\CategoryOption The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[CategoryOptionTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [category_id] column.
     * 
     * @param string $v new value
     * @return $this|\CategoryOption The current object (for fluent API support)
     */
    public function setCategoryId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->category_id !== $v) {
            $this->category_id = $v;
            $this->modifiedColumns[CategoryOptionTableMap::COL_CATEGORY_ID] = true;
        }

        if ($this->aCategory !== null && $this->aCategory->getId() !== $v) {
            $this->aCategory = null;
        }

        return $this;
    } // setCategoryId()

    /**
     * Set the value of [description] column.
     * 
     * @param string $v new value
     * @return $this|\CategoryOption The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[CategoryOptionTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [comment] column.
     * 
     * @param string $v new value
     * @return $this|\CategoryOption The current object (for fluent API support)
     */
    public function setComment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comment !== $v) {
            $this->comment = $v;
            $this->modifiedColumns[CategoryOptionTableMap::COL_COMMENT] = true;
        }

        return $this;
    } // setComment()

    /**
     * Set the value of [value] column.
     * 
     * @param int $v new value
     * @return $this|\CategoryOption The current object (for fluent API support)
     */
    public function setValue($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->value !== $v) {
            $this->value = $v;
            $this->modifiedColumns[CategoryOptionTableMap::COL_VALUE] = true;
        }

        return $this;
    } // setValue()

    /**
     * Set the value of [sequence] column.
     * 
     * @param int $v new value
     * @return $this|\CategoryOption The current object (for fluent API support)
     */
    public function setSequence($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sequence !== $v) {
            $this->sequence = $v;
            $this->modifiedColumns[CategoryOptionTableMap::COL_SEQUENCE] = true;
        }

        return $this;
    } // setSequence()

    /**
     * Set the value of [parent_id] column.
     * 
     * @param string $v new value
     * @return $this|\CategoryOption The current object (for fluent API support)
     */
    public function setParentId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->parent_id !== $v) {
            $this->parent_id = $v;
            $this->modifiedColumns[CategoryOptionTableMap::COL_PARENT_ID] = true;
        }

        if ($this->aCategoryOptionRelatedByParentId !== null && $this->aCategoryOptionRelatedByParentId->getId() !== $v) {
            $this->aCategoryOptionRelatedByParentId = null;
        }

        return $this;
    } // setParentId()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CategoryOptionTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CategoryOptionTableMap::translateFieldName('CategoryId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->category_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CategoryOptionTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CategoryOptionTableMap::translateFieldName('Comment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comment = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CategoryOptionTableMap::translateFieldName('Value', TableMap::TYPE_PHPNAME, $indexType)];
            $this->value = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CategoryOptionTableMap::translateFieldName('Sequence', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sequence = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CategoryOptionTableMap::translateFieldName('ParentId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->parent_id = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = CategoryOptionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\CategoryOption'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aCategory !== null && $this->category_id !== $this->aCategory->getId()) {
            $this->aCategory = null;
        }
        if ($this->aCategoryOptionRelatedByParentId !== null && $this->parent_id !== $this->aCategoryOptionRelatedByParentId->getId()) {
            $this->aCategoryOptionRelatedByParentId = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CategoryOptionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCategoryOptionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCategoryOptionRelatedByParentId = null;
            $this->aCategory = null;
            $this->collCategoryOptionsRelatedById = null;

            $this->collRatingValues = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see CategoryOption::setDeleted()
     * @see CategoryOption::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryOptionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCategoryOptionQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoryOptionTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                CategoryOptionTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCategoryOptionRelatedByParentId !== null) {
                if ($this->aCategoryOptionRelatedByParentId->isModified() || $this->aCategoryOptionRelatedByParentId->isNew()) {
                    $affectedRows += $this->aCategoryOptionRelatedByParentId->save($con);
                }
                $this->setCategoryOptionRelatedByParentId($this->aCategoryOptionRelatedByParentId);
            }

            if ($this->aCategory !== null) {
                if ($this->aCategory->isModified() || $this->aCategory->isNew()) {
                    $affectedRows += $this->aCategory->save($con);
                }
                $this->setCategory($this->aCategory);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->categoryOptionsRelatedByIdScheduledForDeletion !== null) {
                if (!$this->categoryOptionsRelatedByIdScheduledForDeletion->isEmpty()) {
                    \CategoryOptionQuery::create()
                        ->filterByPrimaryKeys($this->categoryOptionsRelatedByIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->categoryOptionsRelatedByIdScheduledForDeletion = null;
                }
            }

            if ($this->collCategoryOptionsRelatedById !== null) {
                foreach ($this->collCategoryOptionsRelatedById as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ratingValuesScheduledForDeletion !== null) {
                if (!$this->ratingValuesScheduledForDeletion->isEmpty()) {
                    \RatingValueQuery::create()
                        ->filterByPrimaryKeys($this->ratingValuesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ratingValuesScheduledForDeletion = null;
                }
            }

            if ($this->collRatingValues !== null) {
                foreach ($this->collRatingValues as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[CategoryOptionTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CategoryOptionTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CategoryOptionTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(CategoryOptionTableMap::COL_CATEGORY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'category_id';
        }
        if ($this->isColumnModified(CategoryOptionTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(CategoryOptionTableMap::COL_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = 'comment';
        }
        if ($this->isColumnModified(CategoryOptionTableMap::COL_VALUE)) {
            $modifiedColumns[':p' . $index++]  = 'value';
        }
        if ($this->isColumnModified(CategoryOptionTableMap::COL_SEQUENCE)) {
            $modifiedColumns[':p' . $index++]  = 'sequence';
        }
        if ($this->isColumnModified(CategoryOptionTableMap::COL_PARENT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'parent_id';
        }

        $sql = sprintf(
            'INSERT INTO category_option (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':                        
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'category_id':                        
                        $stmt->bindValue($identifier, $this->category_id, PDO::PARAM_INT);
                        break;
                    case 'description':                        
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'comment':                        
                        $stmt->bindValue($identifier, $this->comment, PDO::PARAM_STR);
                        break;
                    case 'value':                        
                        $stmt->bindValue($identifier, $this->value, PDO::PARAM_INT);
                        break;
                    case 'sequence':                        
                        $stmt->bindValue($identifier, $this->sequence, PDO::PARAM_INT);
                        break;
                    case 'parent_id':                        
                        $stmt->bindValue($identifier, $this->parent_id, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CategoryOptionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getCategoryId();
                break;
            case 2:
                return $this->getDescription();
                break;
            case 3:
                return $this->getComment();
                break;
            case 4:
                return $this->getValue();
                break;
            case 5:
                return $this->getSequence();
                break;
            case 6:
                return $this->getParentId();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['CategoryOption'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['CategoryOption'][$this->hashCode()] = true;
        $keys = CategoryOptionTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getCategoryId(),
            $keys[2] => $this->getDescription(),
            $keys[3] => $this->getComment(),
            $keys[4] => $this->getValue(),
            $keys[5] => $this->getSequence(),
            $keys[6] => $this->getParentId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->aCategoryOptionRelatedByParentId) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'categoryOption';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'category_option';
                        break;
                    default:
                        $key = 'CategoryOption';
                }
        
                $result[$key] = $this->aCategoryOptionRelatedByParentId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCategory) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'category';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'category';
                        break;
                    default:
                        $key = 'Category';
                }
        
                $result[$key] = $this->aCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collCategoryOptionsRelatedById) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'categoryOptions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'category_options';
                        break;
                    default:
                        $key = 'CategoryOptions';
                }
        
                $result[$key] = $this->collCategoryOptionsRelatedById->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRatingValues) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ratingValues';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'rating_values';
                        break;
                    default:
                        $key = 'RatingValues';
                }
        
                $result[$key] = $this->collRatingValues->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\CategoryOption
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CategoryOptionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\CategoryOption
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setCategoryId($value);
                break;
            case 2:
                $this->setDescription($value);
                break;
            case 3:
                $this->setComment($value);
                break;
            case 4:
                $this->setValue($value);
                break;
            case 5:
                $this->setSequence($value);
                break;
            case 6:
                $this->setParentId($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = CategoryOptionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCategoryId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDescription($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setComment($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setValue($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSequence($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setParentId($arr[$keys[6]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\CategoryOption The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CategoryOptionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CategoryOptionTableMap::COL_ID)) {
            $criteria->add(CategoryOptionTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(CategoryOptionTableMap::COL_CATEGORY_ID)) {
            $criteria->add(CategoryOptionTableMap::COL_CATEGORY_ID, $this->category_id);
        }
        if ($this->isColumnModified(CategoryOptionTableMap::COL_DESCRIPTION)) {
            $criteria->add(CategoryOptionTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(CategoryOptionTableMap::COL_COMMENT)) {
            $criteria->add(CategoryOptionTableMap::COL_COMMENT, $this->comment);
        }
        if ($this->isColumnModified(CategoryOptionTableMap::COL_VALUE)) {
            $criteria->add(CategoryOptionTableMap::COL_VALUE, $this->value);
        }
        if ($this->isColumnModified(CategoryOptionTableMap::COL_SEQUENCE)) {
            $criteria->add(CategoryOptionTableMap::COL_SEQUENCE, $this->sequence);
        }
        if ($this->isColumnModified(CategoryOptionTableMap::COL_PARENT_ID)) {
            $criteria->add(CategoryOptionTableMap::COL_PARENT_ID, $this->parent_id);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildCategoryOptionQuery::create();
        $criteria->add(CategoryOptionTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }
        
    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \CategoryOption (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCategoryId($this->getCategoryId());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setComment($this->getComment());
        $copyObj->setValue($this->getValue());
        $copyObj->setSequence($this->getSequence());
        $copyObj->setParentId($this->getParentId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getCategoryOptionsRelatedById() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCategoryOptionRelatedById($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRatingValues() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRatingValue($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \CategoryOption Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildCategoryOption object.
     *
     * @param  ChildCategoryOption $v
     * @return $this|\CategoryOption The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategoryOptionRelatedByParentId(ChildCategoryOption $v = null)
    {
        if ($v === null) {
            $this->setParentId(NULL);
        } else {
            $this->setParentId($v->getId());
        }

        $this->aCategoryOptionRelatedByParentId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCategoryOption object, it will not be re-added.
        if ($v !== null) {
            $v->addCategoryOptionRelatedById($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCategoryOption object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCategoryOption The associated ChildCategoryOption object.
     * @throws PropelException
     */
    public function getCategoryOptionRelatedByParentId(ConnectionInterface $con = null)
    {
        if ($this->aCategoryOptionRelatedByParentId === null && (($this->parent_id !== "" && $this->parent_id !== null))) {
            $this->aCategoryOptionRelatedByParentId = ChildCategoryOptionQuery::create()->findPk($this->parent_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategoryOptionRelatedByParentId->addCategoryOptionsRelatedById($this);
             */
        }

        return $this->aCategoryOptionRelatedByParentId;
    }

    /**
     * Declares an association between this object and a ChildCategory object.
     *
     * @param  ChildCategory $v
     * @return $this|\CategoryOption The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategory(ChildCategory $v = null)
    {
        if ($v === null) {
            $this->setCategoryId(NULL);
        } else {
            $this->setCategoryId($v->getId());
        }

        $this->aCategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCategory object, it will not be re-added.
        if ($v !== null) {
            $v->addCategoryOption($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCategory object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCategory The associated ChildCategory object.
     * @throws PropelException
     */
    public function getCategory(ConnectionInterface $con = null)
    {
        if ($this->aCategory === null && (($this->category_id !== "" && $this->category_id !== null))) {
            $this->aCategory = ChildCategoryQuery::create()->findPk($this->category_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategory->addCategoryOptions($this);
             */
        }

        return $this->aCategory;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('CategoryOptionRelatedById' == $relationName) {
            return $this->initCategoryOptionsRelatedById();
        }
        if ('RatingValue' == $relationName) {
            return $this->initRatingValues();
        }
    }

    /**
     * Clears out the collCategoryOptionsRelatedById collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addCategoryOptionsRelatedById()
     */
    public function clearCategoryOptionsRelatedById()
    {
        $this->collCategoryOptionsRelatedById = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collCategoryOptionsRelatedById collection loaded partially.
     */
    public function resetPartialCategoryOptionsRelatedById($v = true)
    {
        $this->collCategoryOptionsRelatedByIdPartial = $v;
    }

    /**
     * Initializes the collCategoryOptionsRelatedById collection.
     *
     * By default this just sets the collCategoryOptionsRelatedById collection to an empty array (like clearcollCategoryOptionsRelatedById());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCategoryOptionsRelatedById($overrideExisting = true)
    {
        if (null !== $this->collCategoryOptionsRelatedById && !$overrideExisting) {
            return;
        }
        $this->collCategoryOptionsRelatedById = new ObjectCollection();
        $this->collCategoryOptionsRelatedById->setModel('\CategoryOption');
    }

    /**
     * Gets an array of ChildCategoryOption objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCategoryOption is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildCategoryOption[] List of ChildCategoryOption objects
     * @throws PropelException
     */
    public function getCategoryOptionsRelatedById(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collCategoryOptionsRelatedByIdPartial && !$this->isNew();
        if (null === $this->collCategoryOptionsRelatedById || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCategoryOptionsRelatedById) {
                // return empty collection
                $this->initCategoryOptionsRelatedById();
            } else {
                $collCategoryOptionsRelatedById = ChildCategoryOptionQuery::create(null, $criteria)
                    ->filterByCategoryOptionRelatedByParentId($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collCategoryOptionsRelatedByIdPartial && count($collCategoryOptionsRelatedById)) {
                        $this->initCategoryOptionsRelatedById(false);

                        foreach ($collCategoryOptionsRelatedById as $obj) {
                            if (false == $this->collCategoryOptionsRelatedById->contains($obj)) {
                                $this->collCategoryOptionsRelatedById->append($obj);
                            }
                        }

                        $this->collCategoryOptionsRelatedByIdPartial = true;
                    }

                    return $collCategoryOptionsRelatedById;
                }

                if ($partial && $this->collCategoryOptionsRelatedById) {
                    foreach ($this->collCategoryOptionsRelatedById as $obj) {
                        if ($obj->isNew()) {
                            $collCategoryOptionsRelatedById[] = $obj;
                        }
                    }
                }

                $this->collCategoryOptionsRelatedById = $collCategoryOptionsRelatedById;
                $this->collCategoryOptionsRelatedByIdPartial = false;
            }
        }

        return $this->collCategoryOptionsRelatedById;
    }

    /**
     * Sets a collection of ChildCategoryOption objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $categoryOptionsRelatedById A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCategoryOption The current object (for fluent API support)
     */
    public function setCategoryOptionsRelatedById(Collection $categoryOptionsRelatedById, ConnectionInterface $con = null)
    {
        /** @var ChildCategoryOption[] $categoryOptionsRelatedByIdToDelete */
        $categoryOptionsRelatedByIdToDelete = $this->getCategoryOptionsRelatedById(new Criteria(), $con)->diff($categoryOptionsRelatedById);

        
        $this->categoryOptionsRelatedByIdScheduledForDeletion = $categoryOptionsRelatedByIdToDelete;

        foreach ($categoryOptionsRelatedByIdToDelete as $categoryOptionRelatedByIdRemoved) {
            $categoryOptionRelatedByIdRemoved->setCategoryOptionRelatedByParentId(null);
        }

        $this->collCategoryOptionsRelatedById = null;
        foreach ($categoryOptionsRelatedById as $categoryOptionRelatedById) {
            $this->addCategoryOptionRelatedById($categoryOptionRelatedById);
        }

        $this->collCategoryOptionsRelatedById = $categoryOptionsRelatedById;
        $this->collCategoryOptionsRelatedByIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CategoryOption objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related CategoryOption objects.
     * @throws PropelException
     */
    public function countCategoryOptionsRelatedById(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collCategoryOptionsRelatedByIdPartial && !$this->isNew();
        if (null === $this->collCategoryOptionsRelatedById || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCategoryOptionsRelatedById) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCategoryOptionsRelatedById());
            }

            $query = ChildCategoryOptionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCategoryOptionRelatedByParentId($this)
                ->count($con);
        }

        return count($this->collCategoryOptionsRelatedById);
    }

    /**
     * Method called to associate a ChildCategoryOption object to this object
     * through the ChildCategoryOption foreign key attribute.
     *
     * @param  ChildCategoryOption $l ChildCategoryOption
     * @return $this|\CategoryOption The current object (for fluent API support)
     */
    public function addCategoryOptionRelatedById(ChildCategoryOption $l)
    {
        if ($this->collCategoryOptionsRelatedById === null) {
            $this->initCategoryOptionsRelatedById();
            $this->collCategoryOptionsRelatedByIdPartial = true;
        }

        if (!$this->collCategoryOptionsRelatedById->contains($l)) {
            $this->doAddCategoryOptionRelatedById($l);
        }

        return $this;
    }

    /**
     * @param ChildCategoryOption $categoryOptionRelatedById The ChildCategoryOption object to add.
     */
    protected function doAddCategoryOptionRelatedById(ChildCategoryOption $categoryOptionRelatedById)
    {
        $this->collCategoryOptionsRelatedById[]= $categoryOptionRelatedById;
        $categoryOptionRelatedById->setCategoryOptionRelatedByParentId($this);
    }

    /**
     * @param  ChildCategoryOption $categoryOptionRelatedById The ChildCategoryOption object to remove.
     * @return $this|ChildCategoryOption The current object (for fluent API support)
     */
    public function removeCategoryOptionRelatedById(ChildCategoryOption $categoryOptionRelatedById)
    {
        if ($this->getCategoryOptionsRelatedById()->contains($categoryOptionRelatedById)) {
            $pos = $this->collCategoryOptionsRelatedById->search($categoryOptionRelatedById);
            $this->collCategoryOptionsRelatedById->remove($pos);
            if (null === $this->categoryOptionsRelatedByIdScheduledForDeletion) {
                $this->categoryOptionsRelatedByIdScheduledForDeletion = clone $this->collCategoryOptionsRelatedById;
                $this->categoryOptionsRelatedByIdScheduledForDeletion->clear();
            }
            $this->categoryOptionsRelatedByIdScheduledForDeletion[]= $categoryOptionRelatedById;
            $categoryOptionRelatedById->setCategoryOptionRelatedByParentId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this CategoryOption is new, it will return
     * an empty collection; or if this CategoryOption has previously
     * been saved, it will retrieve related CategoryOptionsRelatedById from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in CategoryOption.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildCategoryOption[] List of ChildCategoryOption objects
     */
    public function getCategoryOptionsRelatedByIdJoinCategory(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildCategoryOptionQuery::create(null, $criteria);
        $query->joinWith('Category', $joinBehavior);

        return $this->getCategoryOptionsRelatedById($query, $con);
    }

    /**
     * Clears out the collRatingValues collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRatingValues()
     */
    public function clearRatingValues()
    {
        $this->collRatingValues = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collRatingValues collection loaded partially.
     */
    public function resetPartialRatingValues($v = true)
    {
        $this->collRatingValuesPartial = $v;
    }

    /**
     * Initializes the collRatingValues collection.
     *
     * By default this just sets the collRatingValues collection to an empty array (like clearcollRatingValues());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRatingValues($overrideExisting = true)
    {
        if (null !== $this->collRatingValues && !$overrideExisting) {
            return;
        }
        $this->collRatingValues = new ObjectCollection();
        $this->collRatingValues->setModel('\RatingValue');
    }

    /**
     * Gets an array of ChildRatingValue objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCategoryOption is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRatingValue[] List of ChildRatingValue objects
     * @throws PropelException
     */
    public function getRatingValues(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRatingValuesPartial && !$this->isNew();
        if (null === $this->collRatingValues || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRatingValues) {
                // return empty collection
                $this->initRatingValues();
            } else {
                $collRatingValues = ChildRatingValueQuery::create(null, $criteria)
                    ->filterByCategoryOption($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRatingValuesPartial && count($collRatingValues)) {
                        $this->initRatingValues(false);

                        foreach ($collRatingValues as $obj) {
                            if (false == $this->collRatingValues->contains($obj)) {
                                $this->collRatingValues->append($obj);
                            }
                        }

                        $this->collRatingValuesPartial = true;
                    }

                    return $collRatingValues;
                }

                if ($partial && $this->collRatingValues) {
                    foreach ($this->collRatingValues as $obj) {
                        if ($obj->isNew()) {
                            $collRatingValues[] = $obj;
                        }
                    }
                }

                $this->collRatingValues = $collRatingValues;
                $this->collRatingValuesPartial = false;
            }
        }

        return $this->collRatingValues;
    }

    /**
     * Sets a collection of ChildRatingValue objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $ratingValues A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCategoryOption The current object (for fluent API support)
     */
    public function setRatingValues(Collection $ratingValues, ConnectionInterface $con = null)
    {
        /** @var ChildRatingValue[] $ratingValuesToDelete */
        $ratingValuesToDelete = $this->getRatingValues(new Criteria(), $con)->diff($ratingValues);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->ratingValuesScheduledForDeletion = clone $ratingValuesToDelete;

        foreach ($ratingValuesToDelete as $ratingValueRemoved) {
            $ratingValueRemoved->setCategoryOption(null);
        }

        $this->collRatingValues = null;
        foreach ($ratingValues as $ratingValue) {
            $this->addRatingValue($ratingValue);
        }

        $this->collRatingValues = $ratingValues;
        $this->collRatingValuesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related RatingValue objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related RatingValue objects.
     * @throws PropelException
     */
    public function countRatingValues(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRatingValuesPartial && !$this->isNew();
        if (null === $this->collRatingValues || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRatingValues) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRatingValues());
            }

            $query = ChildRatingValueQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCategoryOption($this)
                ->count($con);
        }

        return count($this->collRatingValues);
    }

    /**
     * Method called to associate a ChildRatingValue object to this object
     * through the ChildRatingValue foreign key attribute.
     *
     * @param  ChildRatingValue $l ChildRatingValue
     * @return $this|\CategoryOption The current object (for fluent API support)
     */
    public function addRatingValue(ChildRatingValue $l)
    {
        if ($this->collRatingValues === null) {
            $this->initRatingValues();
            $this->collRatingValuesPartial = true;
        }

        if (!$this->collRatingValues->contains($l)) {
            $this->doAddRatingValue($l);
        }

        return $this;
    }

    /**
     * @param ChildRatingValue $ratingValue The ChildRatingValue object to add.
     */
    protected function doAddRatingValue(ChildRatingValue $ratingValue)
    {
        $this->collRatingValues[]= $ratingValue;
        $ratingValue->setCategoryOption($this);
    }

    /**
     * @param  ChildRatingValue $ratingValue The ChildRatingValue object to remove.
     * @return $this|ChildCategoryOption The current object (for fluent API support)
     */
    public function removeRatingValue(ChildRatingValue $ratingValue)
    {
        if ($this->getRatingValues()->contains($ratingValue)) {
            $pos = $this->collRatingValues->search($ratingValue);
            $this->collRatingValues->remove($pos);
            if (null === $this->ratingValuesScheduledForDeletion) {
                $this->ratingValuesScheduledForDeletion = clone $this->collRatingValues;
                $this->ratingValuesScheduledForDeletion->clear();
            }
            $this->ratingValuesScheduledForDeletion[]= clone $ratingValue;
            $ratingValue->setCategoryOption(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this CategoryOption is new, it will return
     * an empty collection; or if this CategoryOption has previously
     * been saved, it will retrieve related RatingValues from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in CategoryOption.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRatingValue[] List of ChildRatingValue objects
     */
    public function getRatingValuesJoinRatingHeader(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRatingValueQuery::create(null, $criteria);
        $query->joinWith('RatingHeader', $joinBehavior);

        return $this->getRatingValues($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCategoryOptionRelatedByParentId) {
            $this->aCategoryOptionRelatedByParentId->removeCategoryOptionRelatedById($this);
        }
        if (null !== $this->aCategory) {
            $this->aCategory->removeCategoryOption($this);
        }
        $this->id = null;
        $this->category_id = null;
        $this->description = null;
        $this->comment = null;
        $this->value = null;
        $this->sequence = null;
        $this->parent_id = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collCategoryOptionsRelatedById) {
                foreach ($this->collCategoryOptionsRelatedById as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRatingValues) {
                foreach ($this->collRatingValues as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collCategoryOptionsRelatedById = null;
        $this->collRatingValues = null;
        $this->aCategoryOptionRelatedByParentId = null;
        $this->aCategory = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CategoryOptionTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
