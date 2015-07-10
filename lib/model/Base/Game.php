<?php

namespace Base;

use \Company as ChildCompany;
use \CompanyQuery as ChildCompanyQuery;
use \Game as ChildGame;
use \GameLink as ChildGameLink;
use \GameLinkQuery as ChildGameLinkQuery;
use \GamePlatform as ChildGamePlatform;
use \GamePlatformQuery as ChildGamePlatformQuery;
use \GameQuery as ChildGameQuery;
use \RatingHeader as ChildRatingHeader;
use \RatingHeaderQuery as ChildRatingHeaderQuery;
use \UserReview as ChildUserReview;
use \UserReviewQuery as ChildUserReviewQuery;
use \Exception;
use \PDO;
use Map\GameTableMap;
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
 * Base class that represents a row from the 'game' table.
 *
 * 
 *
* @package    propel.generator..Base
*/
abstract class Game implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\GameTableMap';


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
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the title field.
     * @var        string
     */
    protected $title;

    /**
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the publisher_id field.
     * @var        string
     */
    protected $publisher_id;

    /**
     * The value for the developer_id field.
     * @var        string
     */
    protected $developer_id;

    /**
     * The value for the gb_id field.
     * @var        string
     */
    protected $gb_id;

    /**
     * The value for the gb_url field.
     * @var        string
     */
    protected $gb_url;

    /**
     * The value for the gb_image field.
     * @var        string
     */
    protected $gb_image;

    /**
     * The value for the gb_thumb field.
     * @var        string
     */
    protected $gb_thumb;

    /**
     * @var        ChildCompany
     */
    protected $aCompanyRelatedByPublisherId;

    /**
     * @var        ChildCompany
     */
    protected $aCompanyRelatedByDeveloperId;

    /**
     * @var        ObjectCollection|ChildGameLink[] Collection to store aggregation of ChildGameLink objects.
     */
    protected $collGameLinks;
    protected $collGameLinksPartial;

    /**
     * @var        ObjectCollection|ChildGamePlatform[] Collection to store aggregation of ChildGamePlatform objects.
     */
    protected $collGamePlatforms;
    protected $collGamePlatformsPartial;

    /**
     * @var        ObjectCollection|ChildRatingHeader[] Collection to store aggregation of ChildRatingHeader objects.
     */
    protected $collRatingHeaders;
    protected $collRatingHeadersPartial;

    /**
     * @var        ObjectCollection|ChildUserReview[] Collection to store aggregation of ChildUserReview objects.
     */
    protected $collUserReviews;
    protected $collUserReviewsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGameLink[]
     */
    protected $gameLinksScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGamePlatform[]
     */
    protected $gamePlatformsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRatingHeader[]
     */
    protected $ratingHeadersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserReview[]
     */
    protected $userReviewsScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Game object.
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
     * Compares this with another <code>Game</code> instance.  If
     * <code>obj</code> is an instance of <code>Game</code>, delegates to
     * <code>equals(Game)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Game The current object, for fluid interface
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
     * Get the [name] column value.
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [title] column value.
     * 
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
     * Get the [publisher_id] column value.
     * 
     * @return string
     */
    public function getPublisherId()
    {
        return $this->publisher_id;
    }

    /**
     * Get the [developer_id] column value.
     * 
     * @return string
     */
    public function getDeveloperId()
    {
        return $this->developer_id;
    }

    /**
     * Get the [gb_id] column value.
     * 
     * @return string
     */
    public function getGbId()
    {
        return $this->gb_id;
    }

    /**
     * Get the [gb_url] column value.
     * 
     * @return string
     */
    public function getGbUrl()
    {
        return $this->gb_url;
    }

    /**
     * Get the [gb_image] column value.
     * 
     * @return string
     */
    public function getGbImage()
    {
        return $this->gb_image;
    }

    /**
     * Get the [gb_thumb] column value.
     * 
     * @return string
     */
    public function getGbThumb()
    {
        return $this->gb_thumb;
    }

    /**
     * Set the value of [id] column.
     * 
     * @param string $v new value
     * @return $this|\Game The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[GameTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     * 
     * @param string $v new value
     * @return $this|\Game The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[GameTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [title] column.
     * 
     * @param string $v new value
     * @return $this|\Game The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[GameTableMap::COL_TITLE] = true;
        }

        return $this;
    } // setTitle()

    /**
     * Set the value of [description] column.
     * 
     * @param string $v new value
     * @return $this|\Game The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[GameTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [publisher_id] column.
     * 
     * @param string $v new value
     * @return $this|\Game The current object (for fluent API support)
     */
    public function setPublisherId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->publisher_id !== $v) {
            $this->publisher_id = $v;
            $this->modifiedColumns[GameTableMap::COL_PUBLISHER_ID] = true;
        }

        if ($this->aCompanyRelatedByPublisherId !== null && $this->aCompanyRelatedByPublisherId->getId() !== $v) {
            $this->aCompanyRelatedByPublisherId = null;
        }

        return $this;
    } // setPublisherId()

    /**
     * Set the value of [developer_id] column.
     * 
     * @param string $v new value
     * @return $this|\Game The current object (for fluent API support)
     */
    public function setDeveloperId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->developer_id !== $v) {
            $this->developer_id = $v;
            $this->modifiedColumns[GameTableMap::COL_DEVELOPER_ID] = true;
        }

        if ($this->aCompanyRelatedByDeveloperId !== null && $this->aCompanyRelatedByDeveloperId->getId() !== $v) {
            $this->aCompanyRelatedByDeveloperId = null;
        }

        return $this;
    } // setDeveloperId()

    /**
     * Set the value of [gb_id] column.
     * 
     * @param string $v new value
     * @return $this|\Game The current object (for fluent API support)
     */
    public function setGbId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gb_id !== $v) {
            $this->gb_id = $v;
            $this->modifiedColumns[GameTableMap::COL_GB_ID] = true;
        }

        return $this;
    } // setGbId()

    /**
     * Set the value of [gb_url] column.
     * 
     * @param string $v new value
     * @return $this|\Game The current object (for fluent API support)
     */
    public function setGbUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gb_url !== $v) {
            $this->gb_url = $v;
            $this->modifiedColumns[GameTableMap::COL_GB_URL] = true;
        }

        return $this;
    } // setGbUrl()

    /**
     * Set the value of [gb_image] column.
     * 
     * @param string $v new value
     * @return $this|\Game The current object (for fluent API support)
     */
    public function setGbImage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gb_image !== $v) {
            $this->gb_image = $v;
            $this->modifiedColumns[GameTableMap::COL_GB_IMAGE] = true;
        }

        return $this;
    } // setGbImage()

    /**
     * Set the value of [gb_thumb] column.
     * 
     * @param string $v new value
     * @return $this|\Game The current object (for fluent API support)
     */
    public function setGbThumb($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->gb_thumb !== $v) {
            $this->gb_thumb = $v;
            $this->modifiedColumns[GameTableMap::COL_GB_THUMB] = true;
        }

        return $this;
    } // setGbThumb()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : GameTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : GameTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : GameTableMap::translateFieldName('Title', TableMap::TYPE_PHPNAME, $indexType)];
            $this->title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : GameTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : GameTableMap::translateFieldName('PublisherId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->publisher_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : GameTableMap::translateFieldName('DeveloperId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->developer_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : GameTableMap::translateFieldName('GbId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gb_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : GameTableMap::translateFieldName('GbUrl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gb_url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : GameTableMap::translateFieldName('GbImage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gb_image = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : GameTableMap::translateFieldName('GbThumb', TableMap::TYPE_PHPNAME, $indexType)];
            $this->gb_thumb = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = GameTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Game'), 0, $e);
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
        if ($this->aCompanyRelatedByPublisherId !== null && $this->publisher_id !== $this->aCompanyRelatedByPublisherId->getId()) {
            $this->aCompanyRelatedByPublisherId = null;
        }
        if ($this->aCompanyRelatedByDeveloperId !== null && $this->developer_id !== $this->aCompanyRelatedByDeveloperId->getId()) {
            $this->aCompanyRelatedByDeveloperId = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(GameTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildGameQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCompanyRelatedByPublisherId = null;
            $this->aCompanyRelatedByDeveloperId = null;
            $this->collGameLinks = null;

            $this->collGamePlatforms = null;

            $this->collRatingHeaders = null;

            $this->collUserReviews = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Game::setDeleted()
     * @see Game::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(GameTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildGameQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(GameTableMap::DATABASE_NAME);
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
                GameTableMap::addInstanceToPool($this);
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

            if ($this->aCompanyRelatedByPublisherId !== null) {
                if ($this->aCompanyRelatedByPublisherId->isModified() || $this->aCompanyRelatedByPublisherId->isNew()) {
                    $affectedRows += $this->aCompanyRelatedByPublisherId->save($con);
                }
                $this->setCompanyRelatedByPublisherId($this->aCompanyRelatedByPublisherId);
            }

            if ($this->aCompanyRelatedByDeveloperId !== null) {
                if ($this->aCompanyRelatedByDeveloperId->isModified() || $this->aCompanyRelatedByDeveloperId->isNew()) {
                    $affectedRows += $this->aCompanyRelatedByDeveloperId->save($con);
                }
                $this->setCompanyRelatedByDeveloperId($this->aCompanyRelatedByDeveloperId);
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

            if ($this->gameLinksScheduledForDeletion !== null) {
                if (!$this->gameLinksScheduledForDeletion->isEmpty()) {
                    \GameLinkQuery::create()
                        ->filterByPrimaryKeys($this->gameLinksScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->gameLinksScheduledForDeletion = null;
                }
            }

            if ($this->collGameLinks !== null) {
                foreach ($this->collGameLinks as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->gamePlatformsScheduledForDeletion !== null) {
                if (!$this->gamePlatformsScheduledForDeletion->isEmpty()) {
                    \GamePlatformQuery::create()
                        ->filterByPrimaryKeys($this->gamePlatformsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->gamePlatformsScheduledForDeletion = null;
                }
            }

            if ($this->collGamePlatforms !== null) {
                foreach ($this->collGamePlatforms as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ratingHeadersScheduledForDeletion !== null) {
                if (!$this->ratingHeadersScheduledForDeletion->isEmpty()) {
                    \RatingHeaderQuery::create()
                        ->filterByPrimaryKeys($this->ratingHeadersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ratingHeadersScheduledForDeletion = null;
                }
            }

            if ($this->collRatingHeaders !== null) {
                foreach ($this->collRatingHeaders as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userReviewsScheduledForDeletion !== null) {
                if (!$this->userReviewsScheduledForDeletion->isEmpty()) {
                    \UserReviewQuery::create()
                        ->filterByPrimaryKeys($this->userReviewsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userReviewsScheduledForDeletion = null;
                }
            }

            if ($this->collUserReviews !== null) {
                foreach ($this->collUserReviews as $referrerFK) {
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

        $this->modifiedColumns[GameTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GameTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GameTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(GameTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(GameTableMap::COL_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'title';
        }
        if ($this->isColumnModified(GameTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(GameTableMap::COL_PUBLISHER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'publisher_id';
        }
        if ($this->isColumnModified(GameTableMap::COL_DEVELOPER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'developer_id';
        }
        if ($this->isColumnModified(GameTableMap::COL_GB_ID)) {
            $modifiedColumns[':p' . $index++]  = 'gb_id';
        }
        if ($this->isColumnModified(GameTableMap::COL_GB_URL)) {
            $modifiedColumns[':p' . $index++]  = 'gb_url';
        }
        if ($this->isColumnModified(GameTableMap::COL_GB_IMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'gb_image';
        }
        if ($this->isColumnModified(GameTableMap::COL_GB_THUMB)) {
            $modifiedColumns[':p' . $index++]  = 'gb_thumb';
        }

        $sql = sprintf(
            'INSERT INTO game (%s) VALUES (%s)',
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
                    case 'name':                        
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'title':                        
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case 'description':                        
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'publisher_id':                        
                        $stmt->bindValue($identifier, $this->publisher_id, PDO::PARAM_INT);
                        break;
                    case 'developer_id':                        
                        $stmt->bindValue($identifier, $this->developer_id, PDO::PARAM_INT);
                        break;
                    case 'gb_id':                        
                        $stmt->bindValue($identifier, $this->gb_id, PDO::PARAM_INT);
                        break;
                    case 'gb_url':                        
                        $stmt->bindValue($identifier, $this->gb_url, PDO::PARAM_STR);
                        break;
                    case 'gb_image':                        
                        $stmt->bindValue($identifier, $this->gb_image, PDO::PARAM_STR);
                        break;
                    case 'gb_thumb':                        
                        $stmt->bindValue($identifier, $this->gb_thumb, PDO::PARAM_STR);
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
        $pos = GameTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getName();
                break;
            case 2:
                return $this->getTitle();
                break;
            case 3:
                return $this->getDescription();
                break;
            case 4:
                return $this->getPublisherId();
                break;
            case 5:
                return $this->getDeveloperId();
                break;
            case 6:
                return $this->getGbId();
                break;
            case 7:
                return $this->getGbUrl();
                break;
            case 8:
                return $this->getGbImage();
                break;
            case 9:
                return $this->getGbThumb();
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

        if (isset($alreadyDumpedObjects['Game'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Game'][$this->hashCode()] = true;
        $keys = GameTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getTitle(),
            $keys[3] => $this->getDescription(),
            $keys[4] => $this->getPublisherId(),
            $keys[5] => $this->getDeveloperId(),
            $keys[6] => $this->getGbId(),
            $keys[7] => $this->getGbUrl(),
            $keys[8] => $this->getGbImage(),
            $keys[9] => $this->getGbThumb(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->aCompanyRelatedByPublisherId) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'company';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'company';
                        break;
                    default:
                        $key = 'Company';
                }
        
                $result[$key] = $this->aCompanyRelatedByPublisherId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCompanyRelatedByDeveloperId) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'company';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'company';
                        break;
                    default:
                        $key = 'Company';
                }
        
                $result[$key] = $this->aCompanyRelatedByDeveloperId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collGameLinks) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'gameLinks';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'game_links';
                        break;
                    default:
                        $key = 'GameLinks';
                }
        
                $result[$key] = $this->collGameLinks->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGamePlatforms) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'gamePlatforms';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'game_platforms';
                        break;
                    default:
                        $key = 'GamePlatforms';
                }
        
                $result[$key] = $this->collGamePlatforms->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRatingHeaders) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ratingHeaders';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'rating_headers';
                        break;
                    default:
                        $key = 'RatingHeaders';
                }
        
                $result[$key] = $this->collRatingHeaders->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserReviews) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userReviews';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_reviews';
                        break;
                    default:
                        $key = 'UserReviews';
                }
        
                $result[$key] = $this->collUserReviews->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Game
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = GameTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Game
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setTitle($value);
                break;
            case 3:
                $this->setDescription($value);
                break;
            case 4:
                $this->setPublisherId($value);
                break;
            case 5:
                $this->setDeveloperId($value);
                break;
            case 6:
                $this->setGbId($value);
                break;
            case 7:
                $this->setGbUrl($value);
                break;
            case 8:
                $this->setGbImage($value);
                break;
            case 9:
                $this->setGbThumb($value);
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
        $keys = GameTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTitle($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDescription($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPublisherId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDeveloperId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setGbId($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setGbUrl($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setGbImage($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setGbThumb($arr[$keys[9]]);
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
     * @return $this|\Game The current object, for fluid interface
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
        $criteria = new Criteria(GameTableMap::DATABASE_NAME);

        if ($this->isColumnModified(GameTableMap::COL_ID)) {
            $criteria->add(GameTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(GameTableMap::COL_NAME)) {
            $criteria->add(GameTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(GameTableMap::COL_TITLE)) {
            $criteria->add(GameTableMap::COL_TITLE, $this->title);
        }
        if ($this->isColumnModified(GameTableMap::COL_DESCRIPTION)) {
            $criteria->add(GameTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(GameTableMap::COL_PUBLISHER_ID)) {
            $criteria->add(GameTableMap::COL_PUBLISHER_ID, $this->publisher_id);
        }
        if ($this->isColumnModified(GameTableMap::COL_DEVELOPER_ID)) {
            $criteria->add(GameTableMap::COL_DEVELOPER_ID, $this->developer_id);
        }
        if ($this->isColumnModified(GameTableMap::COL_GB_ID)) {
            $criteria->add(GameTableMap::COL_GB_ID, $this->gb_id);
        }
        if ($this->isColumnModified(GameTableMap::COL_GB_URL)) {
            $criteria->add(GameTableMap::COL_GB_URL, $this->gb_url);
        }
        if ($this->isColumnModified(GameTableMap::COL_GB_IMAGE)) {
            $criteria->add(GameTableMap::COL_GB_IMAGE, $this->gb_image);
        }
        if ($this->isColumnModified(GameTableMap::COL_GB_THUMB)) {
            $criteria->add(GameTableMap::COL_GB_THUMB, $this->gb_thumb);
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
        $criteria = ChildGameQuery::create();
        $criteria->add(GameTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Game (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setPublisherId($this->getPublisherId());
        $copyObj->setDeveloperId($this->getDeveloperId());
        $copyObj->setGbId($this->getGbId());
        $copyObj->setGbUrl($this->getGbUrl());
        $copyObj->setGbImage($this->getGbImage());
        $copyObj->setGbThumb($this->getGbThumb());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getGameLinks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGameLink($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGamePlatforms() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGamePlatform($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRatingHeaders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRatingHeader($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserReviews() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserReview($relObj->copy($deepCopy));
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
     * @return \Game Clone of current object.
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
     * Declares an association between this object and a ChildCompany object.
     *
     * @param  ChildCompany $v
     * @return $this|\Game The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCompanyRelatedByPublisherId(ChildCompany $v = null)
    {
        if ($v === null) {
            $this->setPublisherId(NULL);
        } else {
            $this->setPublisherId($v->getId());
        }

        $this->aCompanyRelatedByPublisherId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addGameRelatedByPublisherId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCompany object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCompany The associated ChildCompany object.
     * @throws PropelException
     */
    public function getCompanyRelatedByPublisherId(ConnectionInterface $con = null)
    {
        if ($this->aCompanyRelatedByPublisherId === null && (($this->publisher_id !== "" && $this->publisher_id !== null))) {
            $this->aCompanyRelatedByPublisherId = ChildCompanyQuery::create()->findPk($this->publisher_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompanyRelatedByPublisherId->addGamesRelatedByPublisherId($this);
             */
        }

        return $this->aCompanyRelatedByPublisherId;
    }

    /**
     * Declares an association between this object and a ChildCompany object.
     *
     * @param  ChildCompany $v
     * @return $this|\Game The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCompanyRelatedByDeveloperId(ChildCompany $v = null)
    {
        if ($v === null) {
            $this->setDeveloperId(NULL);
        } else {
            $this->setDeveloperId($v->getId());
        }

        $this->aCompanyRelatedByDeveloperId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCompany object, it will not be re-added.
        if ($v !== null) {
            $v->addGameRelatedByDeveloperId($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCompany object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCompany The associated ChildCompany object.
     * @throws PropelException
     */
    public function getCompanyRelatedByDeveloperId(ConnectionInterface $con = null)
    {
        if ($this->aCompanyRelatedByDeveloperId === null && (($this->developer_id !== "" && $this->developer_id !== null))) {
            $this->aCompanyRelatedByDeveloperId = ChildCompanyQuery::create()->findPk($this->developer_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCompanyRelatedByDeveloperId->addGamesRelatedByDeveloperId($this);
             */
        }

        return $this->aCompanyRelatedByDeveloperId;
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
        if ('GameLink' == $relationName) {
            return $this->initGameLinks();
        }
        if ('GamePlatform' == $relationName) {
            return $this->initGamePlatforms();
        }
        if ('RatingHeader' == $relationName) {
            return $this->initRatingHeaders();
        }
        if ('UserReview' == $relationName) {
            return $this->initUserReviews();
        }
    }

    /**
     * Clears out the collGameLinks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addGameLinks()
     */
    public function clearGameLinks()
    {
        $this->collGameLinks = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collGameLinks collection loaded partially.
     */
    public function resetPartialGameLinks($v = true)
    {
        $this->collGameLinksPartial = $v;
    }

    /**
     * Initializes the collGameLinks collection.
     *
     * By default this just sets the collGameLinks collection to an empty array (like clearcollGameLinks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGameLinks($overrideExisting = true)
    {
        if (null !== $this->collGameLinks && !$overrideExisting) {
            return;
        }
        $this->collGameLinks = new ObjectCollection();
        $this->collGameLinks->setModel('\GameLink');
    }

    /**
     * Gets an array of ChildGameLink objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGame is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGameLink[] List of ChildGameLink objects
     * @throws PropelException
     */
    public function getGameLinks(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collGameLinksPartial && !$this->isNew();
        if (null === $this->collGameLinks || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGameLinks) {
                // return empty collection
                $this->initGameLinks();
            } else {
                $collGameLinks = ChildGameLinkQuery::create(null, $criteria)
                    ->filterByGame($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGameLinksPartial && count($collGameLinks)) {
                        $this->initGameLinks(false);

                        foreach ($collGameLinks as $obj) {
                            if (false == $this->collGameLinks->contains($obj)) {
                                $this->collGameLinks->append($obj);
                            }
                        }

                        $this->collGameLinksPartial = true;
                    }

                    return $collGameLinks;
                }

                if ($partial && $this->collGameLinks) {
                    foreach ($this->collGameLinks as $obj) {
                        if ($obj->isNew()) {
                            $collGameLinks[] = $obj;
                        }
                    }
                }

                $this->collGameLinks = $collGameLinks;
                $this->collGameLinksPartial = false;
            }
        }

        return $this->collGameLinks;
    }

    /**
     * Sets a collection of ChildGameLink objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $gameLinks A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildGame The current object (for fluent API support)
     */
    public function setGameLinks(Collection $gameLinks, ConnectionInterface $con = null)
    {
        /** @var ChildGameLink[] $gameLinksToDelete */
        $gameLinksToDelete = $this->getGameLinks(new Criteria(), $con)->diff($gameLinks);

        
        $this->gameLinksScheduledForDeletion = $gameLinksToDelete;

        foreach ($gameLinksToDelete as $gameLinkRemoved) {
            $gameLinkRemoved->setGame(null);
        }

        $this->collGameLinks = null;
        foreach ($gameLinks as $gameLink) {
            $this->addGameLink($gameLink);
        }

        $this->collGameLinks = $gameLinks;
        $this->collGameLinksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GameLink objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related GameLink objects.
     * @throws PropelException
     */
    public function countGameLinks(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collGameLinksPartial && !$this->isNew();
        if (null === $this->collGameLinks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGameLinks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGameLinks());
            }

            $query = ChildGameLinkQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGame($this)
                ->count($con);
        }

        return count($this->collGameLinks);
    }

    /**
     * Method called to associate a ChildGameLink object to this object
     * through the ChildGameLink foreign key attribute.
     *
     * @param  ChildGameLink $l ChildGameLink
     * @return $this|\Game The current object (for fluent API support)
     */
    public function addGameLink(ChildGameLink $l)
    {
        if ($this->collGameLinks === null) {
            $this->initGameLinks();
            $this->collGameLinksPartial = true;
        }

        if (!$this->collGameLinks->contains($l)) {
            $this->doAddGameLink($l);
        }

        return $this;
    }

    /**
     * @param ChildGameLink $gameLink The ChildGameLink object to add.
     */
    protected function doAddGameLink(ChildGameLink $gameLink)
    {
        $this->collGameLinks[]= $gameLink;
        $gameLink->setGame($this);
    }

    /**
     * @param  ChildGameLink $gameLink The ChildGameLink object to remove.
     * @return $this|ChildGame The current object (for fluent API support)
     */
    public function removeGameLink(ChildGameLink $gameLink)
    {
        if ($this->getGameLinks()->contains($gameLink)) {
            $pos = $this->collGameLinks->search($gameLink);
            $this->collGameLinks->remove($pos);
            if (null === $this->gameLinksScheduledForDeletion) {
                $this->gameLinksScheduledForDeletion = clone $this->collGameLinks;
                $this->gameLinksScheduledForDeletion->clear();
            }
            $this->gameLinksScheduledForDeletion[]= clone $gameLink;
            $gameLink->setGame(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Game is new, it will return
     * an empty collection; or if this Game has previously
     * been saved, it will retrieve related GameLinks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Game.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGameLink[] List of ChildGameLink objects
     */
    public function getGameLinksJoinGameLinkType(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGameLinkQuery::create(null, $criteria);
        $query->joinWith('GameLinkType', $joinBehavior);

        return $this->getGameLinks($query, $con);
    }

    /**
     * Clears out the collGamePlatforms collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addGamePlatforms()
     */
    public function clearGamePlatforms()
    {
        $this->collGamePlatforms = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collGamePlatforms collection loaded partially.
     */
    public function resetPartialGamePlatforms($v = true)
    {
        $this->collGamePlatformsPartial = $v;
    }

    /**
     * Initializes the collGamePlatforms collection.
     *
     * By default this just sets the collGamePlatforms collection to an empty array (like clearcollGamePlatforms());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGamePlatforms($overrideExisting = true)
    {
        if (null !== $this->collGamePlatforms && !$overrideExisting) {
            return;
        }
        $this->collGamePlatforms = new ObjectCollection();
        $this->collGamePlatforms->setModel('\GamePlatform');
    }

    /**
     * Gets an array of ChildGamePlatform objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGame is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGamePlatform[] List of ChildGamePlatform objects
     * @throws PropelException
     */
    public function getGamePlatforms(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collGamePlatformsPartial && !$this->isNew();
        if (null === $this->collGamePlatforms || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGamePlatforms) {
                // return empty collection
                $this->initGamePlatforms();
            } else {
                $collGamePlatforms = ChildGamePlatformQuery::create(null, $criteria)
                    ->filterByGame($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGamePlatformsPartial && count($collGamePlatforms)) {
                        $this->initGamePlatforms(false);

                        foreach ($collGamePlatforms as $obj) {
                            if (false == $this->collGamePlatforms->contains($obj)) {
                                $this->collGamePlatforms->append($obj);
                            }
                        }

                        $this->collGamePlatformsPartial = true;
                    }

                    return $collGamePlatforms;
                }

                if ($partial && $this->collGamePlatforms) {
                    foreach ($this->collGamePlatforms as $obj) {
                        if ($obj->isNew()) {
                            $collGamePlatforms[] = $obj;
                        }
                    }
                }

                $this->collGamePlatforms = $collGamePlatforms;
                $this->collGamePlatformsPartial = false;
            }
        }

        return $this->collGamePlatforms;
    }

    /**
     * Sets a collection of ChildGamePlatform objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $gamePlatforms A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildGame The current object (for fluent API support)
     */
    public function setGamePlatforms(Collection $gamePlatforms, ConnectionInterface $con = null)
    {
        /** @var ChildGamePlatform[] $gamePlatformsToDelete */
        $gamePlatformsToDelete = $this->getGamePlatforms(new Criteria(), $con)->diff($gamePlatforms);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->gamePlatformsScheduledForDeletion = clone $gamePlatformsToDelete;

        foreach ($gamePlatformsToDelete as $gamePlatformRemoved) {
            $gamePlatformRemoved->setGame(null);
        }

        $this->collGamePlatforms = null;
        foreach ($gamePlatforms as $gamePlatform) {
            $this->addGamePlatform($gamePlatform);
        }

        $this->collGamePlatforms = $gamePlatforms;
        $this->collGamePlatformsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related GamePlatform objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related GamePlatform objects.
     * @throws PropelException
     */
    public function countGamePlatforms(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collGamePlatformsPartial && !$this->isNew();
        if (null === $this->collGamePlatforms || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGamePlatforms) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGamePlatforms());
            }

            $query = ChildGamePlatformQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGame($this)
                ->count($con);
        }

        return count($this->collGamePlatforms);
    }

    /**
     * Method called to associate a ChildGamePlatform object to this object
     * through the ChildGamePlatform foreign key attribute.
     *
     * @param  ChildGamePlatform $l ChildGamePlatform
     * @return $this|\Game The current object (for fluent API support)
     */
    public function addGamePlatform(ChildGamePlatform $l)
    {
        if ($this->collGamePlatforms === null) {
            $this->initGamePlatforms();
            $this->collGamePlatformsPartial = true;
        }

        if (!$this->collGamePlatforms->contains($l)) {
            $this->doAddGamePlatform($l);
        }

        return $this;
    }

    /**
     * @param ChildGamePlatform $gamePlatform The ChildGamePlatform object to add.
     */
    protected function doAddGamePlatform(ChildGamePlatform $gamePlatform)
    {
        $this->collGamePlatforms[]= $gamePlatform;
        $gamePlatform->setGame($this);
    }

    /**
     * @param  ChildGamePlatform $gamePlatform The ChildGamePlatform object to remove.
     * @return $this|ChildGame The current object (for fluent API support)
     */
    public function removeGamePlatform(ChildGamePlatform $gamePlatform)
    {
        if ($this->getGamePlatforms()->contains($gamePlatform)) {
            $pos = $this->collGamePlatforms->search($gamePlatform);
            $this->collGamePlatforms->remove($pos);
            if (null === $this->gamePlatformsScheduledForDeletion) {
                $this->gamePlatformsScheduledForDeletion = clone $this->collGamePlatforms;
                $this->gamePlatformsScheduledForDeletion->clear();
            }
            $this->gamePlatformsScheduledForDeletion[]= clone $gamePlatform;
            $gamePlatform->setGame(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Game is new, it will return
     * an empty collection; or if this Game has previously
     * been saved, it will retrieve related GamePlatforms from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Game.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildGamePlatform[] List of ChildGamePlatform objects
     */
    public function getGamePlatformsJoinPlatform(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildGamePlatformQuery::create(null, $criteria);
        $query->joinWith('Platform', $joinBehavior);

        return $this->getGamePlatforms($query, $con);
    }

    /**
     * Clears out the collRatingHeaders collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRatingHeaders()
     */
    public function clearRatingHeaders()
    {
        $this->collRatingHeaders = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collRatingHeaders collection loaded partially.
     */
    public function resetPartialRatingHeaders($v = true)
    {
        $this->collRatingHeadersPartial = $v;
    }

    /**
     * Initializes the collRatingHeaders collection.
     *
     * By default this just sets the collRatingHeaders collection to an empty array (like clearcollRatingHeaders());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRatingHeaders($overrideExisting = true)
    {
        if (null !== $this->collRatingHeaders && !$overrideExisting) {
            return;
        }
        $this->collRatingHeaders = new ObjectCollection();
        $this->collRatingHeaders->setModel('\RatingHeader');
    }

    /**
     * Gets an array of ChildRatingHeader objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGame is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRatingHeader[] List of ChildRatingHeader objects
     * @throws PropelException
     */
    public function getRatingHeaders(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRatingHeadersPartial && !$this->isNew();
        if (null === $this->collRatingHeaders || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRatingHeaders) {
                // return empty collection
                $this->initRatingHeaders();
            } else {
                $collRatingHeaders = ChildRatingHeaderQuery::create(null, $criteria)
                    ->filterByGame($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRatingHeadersPartial && count($collRatingHeaders)) {
                        $this->initRatingHeaders(false);

                        foreach ($collRatingHeaders as $obj) {
                            if (false == $this->collRatingHeaders->contains($obj)) {
                                $this->collRatingHeaders->append($obj);
                            }
                        }

                        $this->collRatingHeadersPartial = true;
                    }

                    return $collRatingHeaders;
                }

                if ($partial && $this->collRatingHeaders) {
                    foreach ($this->collRatingHeaders as $obj) {
                        if ($obj->isNew()) {
                            $collRatingHeaders[] = $obj;
                        }
                    }
                }

                $this->collRatingHeaders = $collRatingHeaders;
                $this->collRatingHeadersPartial = false;
            }
        }

        return $this->collRatingHeaders;
    }

    /**
     * Sets a collection of ChildRatingHeader objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $ratingHeaders A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildGame The current object (for fluent API support)
     */
    public function setRatingHeaders(Collection $ratingHeaders, ConnectionInterface $con = null)
    {
        /** @var ChildRatingHeader[] $ratingHeadersToDelete */
        $ratingHeadersToDelete = $this->getRatingHeaders(new Criteria(), $con)->diff($ratingHeaders);

        
        $this->ratingHeadersScheduledForDeletion = $ratingHeadersToDelete;

        foreach ($ratingHeadersToDelete as $ratingHeaderRemoved) {
            $ratingHeaderRemoved->setGame(null);
        }

        $this->collRatingHeaders = null;
        foreach ($ratingHeaders as $ratingHeader) {
            $this->addRatingHeader($ratingHeader);
        }

        $this->collRatingHeaders = $ratingHeaders;
        $this->collRatingHeadersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related RatingHeader objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related RatingHeader objects.
     * @throws PropelException
     */
    public function countRatingHeaders(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRatingHeadersPartial && !$this->isNew();
        if (null === $this->collRatingHeaders || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRatingHeaders) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRatingHeaders());
            }

            $query = ChildRatingHeaderQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGame($this)
                ->count($con);
        }

        return count($this->collRatingHeaders);
    }

    /**
     * Method called to associate a ChildRatingHeader object to this object
     * through the ChildRatingHeader foreign key attribute.
     *
     * @param  ChildRatingHeader $l ChildRatingHeader
     * @return $this|\Game The current object (for fluent API support)
     */
    public function addRatingHeader(ChildRatingHeader $l)
    {
        if ($this->collRatingHeaders === null) {
            $this->initRatingHeaders();
            $this->collRatingHeadersPartial = true;
        }

        if (!$this->collRatingHeaders->contains($l)) {
            $this->doAddRatingHeader($l);
        }

        return $this;
    }

    /**
     * @param ChildRatingHeader $ratingHeader The ChildRatingHeader object to add.
     */
    protected function doAddRatingHeader(ChildRatingHeader $ratingHeader)
    {
        $this->collRatingHeaders[]= $ratingHeader;
        $ratingHeader->setGame($this);
    }

    /**
     * @param  ChildRatingHeader $ratingHeader The ChildRatingHeader object to remove.
     * @return $this|ChildGame The current object (for fluent API support)
     */
    public function removeRatingHeader(ChildRatingHeader $ratingHeader)
    {
        if ($this->getRatingHeaders()->contains($ratingHeader)) {
            $pos = $this->collRatingHeaders->search($ratingHeader);
            $this->collRatingHeaders->remove($pos);
            if (null === $this->ratingHeadersScheduledForDeletion) {
                $this->ratingHeadersScheduledForDeletion = clone $this->collRatingHeaders;
                $this->ratingHeadersScheduledForDeletion->clear();
            }
            $this->ratingHeadersScheduledForDeletion[]= clone $ratingHeader;
            $ratingHeader->setGame(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Game is new, it will return
     * an empty collection; or if this Game has previously
     * been saved, it will retrieve related RatingHeaders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Game.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRatingHeader[] List of ChildRatingHeader objects
     */
    public function getRatingHeadersJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRatingHeaderQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getRatingHeaders($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Game is new, it will return
     * an empty collection; or if this Game has previously
     * been saved, it will retrieve related RatingHeaders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Game.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRatingHeader[] List of ChildRatingHeader objects
     */
    public function getRatingHeadersJoinPlatform(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRatingHeaderQuery::create(null, $criteria);
        $query->joinWith('Platform', $joinBehavior);

        return $this->getRatingHeaders($query, $con);
    }

    /**
     * Clears out the collUserReviews collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserReviews()
     */
    public function clearUserReviews()
    {
        $this->collUserReviews = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserReviews collection loaded partially.
     */
    public function resetPartialUserReviews($v = true)
    {
        $this->collUserReviewsPartial = $v;
    }

    /**
     * Initializes the collUserReviews collection.
     *
     * By default this just sets the collUserReviews collection to an empty array (like clearcollUserReviews());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserReviews($overrideExisting = true)
    {
        if (null !== $this->collUserReviews && !$overrideExisting) {
            return;
        }
        $this->collUserReviews = new ObjectCollection();
        $this->collUserReviews->setModel('\UserReview');
    }

    /**
     * Gets an array of ChildUserReview objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildGame is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserReview[] List of ChildUserReview objects
     * @throws PropelException
     */
    public function getUserReviews(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserReviewsPartial && !$this->isNew();
        if (null === $this->collUserReviews || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserReviews) {
                // return empty collection
                $this->initUserReviews();
            } else {
                $collUserReviews = ChildUserReviewQuery::create(null, $criteria)
                    ->filterByGame($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserReviewsPartial && count($collUserReviews)) {
                        $this->initUserReviews(false);

                        foreach ($collUserReviews as $obj) {
                            if (false == $this->collUserReviews->contains($obj)) {
                                $this->collUserReviews->append($obj);
                            }
                        }

                        $this->collUserReviewsPartial = true;
                    }

                    return $collUserReviews;
                }

                if ($partial && $this->collUserReviews) {
                    foreach ($this->collUserReviews as $obj) {
                        if ($obj->isNew()) {
                            $collUserReviews[] = $obj;
                        }
                    }
                }

                $this->collUserReviews = $collUserReviews;
                $this->collUserReviewsPartial = false;
            }
        }

        return $this->collUserReviews;
    }

    /**
     * Sets a collection of ChildUserReview objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userReviews A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildGame The current object (for fluent API support)
     */
    public function setUserReviews(Collection $userReviews, ConnectionInterface $con = null)
    {
        /** @var ChildUserReview[] $userReviewsToDelete */
        $userReviewsToDelete = $this->getUserReviews(new Criteria(), $con)->diff($userReviews);

        
        $this->userReviewsScheduledForDeletion = $userReviewsToDelete;

        foreach ($userReviewsToDelete as $userReviewRemoved) {
            $userReviewRemoved->setGame(null);
        }

        $this->collUserReviews = null;
        foreach ($userReviews as $userReview) {
            $this->addUserReview($userReview);
        }

        $this->collUserReviews = $userReviews;
        $this->collUserReviewsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserReview objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related UserReview objects.
     * @throws PropelException
     */
    public function countUserReviews(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserReviewsPartial && !$this->isNew();
        if (null === $this->collUserReviews || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserReviews) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserReviews());
            }

            $query = ChildUserReviewQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGame($this)
                ->count($con);
        }

        return count($this->collUserReviews);
    }

    /**
     * Method called to associate a ChildUserReview object to this object
     * through the ChildUserReview foreign key attribute.
     *
     * @param  ChildUserReview $l ChildUserReview
     * @return $this|\Game The current object (for fluent API support)
     */
    public function addUserReview(ChildUserReview $l)
    {
        if ($this->collUserReviews === null) {
            $this->initUserReviews();
            $this->collUserReviewsPartial = true;
        }

        if (!$this->collUserReviews->contains($l)) {
            $this->doAddUserReview($l);
        }

        return $this;
    }

    /**
     * @param ChildUserReview $userReview The ChildUserReview object to add.
     */
    protected function doAddUserReview(ChildUserReview $userReview)
    {
        $this->collUserReviews[]= $userReview;
        $userReview->setGame($this);
    }

    /**
     * @param  ChildUserReview $userReview The ChildUserReview object to remove.
     * @return $this|ChildGame The current object (for fluent API support)
     */
    public function removeUserReview(ChildUserReview $userReview)
    {
        if ($this->getUserReviews()->contains($userReview)) {
            $pos = $this->collUserReviews->search($userReview);
            $this->collUserReviews->remove($pos);
            if (null === $this->userReviewsScheduledForDeletion) {
                $this->userReviewsScheduledForDeletion = clone $this->collUserReviews;
                $this->userReviewsScheduledForDeletion->clear();
            }
            $this->userReviewsScheduledForDeletion[]= clone $userReview;
            $userReview->setGame(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Game is new, it will return
     * an empty collection; or if this Game has previously
     * been saved, it will retrieve related UserReviews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Game.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserReview[] List of ChildUserReview objects
     */
    public function getUserReviewsJoinPlatform(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserReviewQuery::create(null, $criteria);
        $query->joinWith('Platform', $joinBehavior);

        return $this->getUserReviews($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Game is new, it will return
     * an empty collection; or if this Game has previously
     * been saved, it will retrieve related UserReviews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Game.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserReview[] List of ChildUserReview objects
     */
    public function getUserReviewsJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserReviewQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getUserReviews($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Game is new, it will return
     * an empty collection; or if this Game has previously
     * been saved, it will retrieve related UserReviews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Game.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserReview[] List of ChildUserReview objects
     */
    public function getUserReviewsJoinRating(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserReviewQuery::create(null, $criteria);
        $query->joinWith('Rating', $joinBehavior);

        return $this->getUserReviews($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Game is new, it will return
     * an empty collection; or if this Game has previously
     * been saved, it will retrieve related UserReviews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Game.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserReview[] List of ChildUserReview objects
     */
    public function getUserReviewsJoinRig(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserReviewQuery::create(null, $criteria);
        $query->joinWith('Rig', $joinBehavior);

        return $this->getUserReviews($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCompanyRelatedByPublisherId) {
            $this->aCompanyRelatedByPublisherId->removeGameRelatedByPublisherId($this);
        }
        if (null !== $this->aCompanyRelatedByDeveloperId) {
            $this->aCompanyRelatedByDeveloperId->removeGameRelatedByDeveloperId($this);
        }
        $this->id = null;
        $this->name = null;
        $this->title = null;
        $this->description = null;
        $this->publisher_id = null;
        $this->developer_id = null;
        $this->gb_id = null;
        $this->gb_url = null;
        $this->gb_image = null;
        $this->gb_thumb = null;
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
            if ($this->collGameLinks) {
                foreach ($this->collGameLinks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGamePlatforms) {
                foreach ($this->collGamePlatforms as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRatingHeaders) {
                foreach ($this->collRatingHeaders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserReviews) {
                foreach ($this->collUserReviews as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collGameLinks = null;
        $this->collGamePlatforms = null;
        $this->collRatingHeaders = null;
        $this->collUserReviews = null;
        $this->aCompanyRelatedByPublisherId = null;
        $this->aCompanyRelatedByDeveloperId = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(GameTableMap::DEFAULT_STRING_FORMAT);
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
