<?php

namespace Base;

use \Games as ChildGames;
use \GamesQuery as ChildGamesQuery;
use \Platforms as ChildPlatforms;
use \PlatformsQuery as ChildPlatformsQuery;
use \RatingCategoryValues as ChildRatingCategoryValues;
use \RatingCategoryValuesQuery as ChildRatingCategoryValuesQuery;
use \RatingHeaders as ChildRatingHeaders;
use \RatingHeadersQuery as ChildRatingHeadersQuery;
use \Rigs as ChildRigs;
use \RigsQuery as ChildRigsQuery;
use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\RatingHeadersTableMap;
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
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'rating_headers' table.
 *
 * 
 *
* @package    propel.generator..Base
*/
abstract class RatingHeaders implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\RatingHeadersTableMap';


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
     * The value for the game_id field.
     * @var        string
     */
    protected $game_id;

    /**
     * The value for the user_id field.
     * @var        string
     */
    protected $user_id;

    /**
     * The value for the game_platform_id field.
     * @var        string
     */
    protected $game_platform_id;

    /**
     * The value for the rig_id field.
     * @var        string
     */
    protected $rig_id;

    /**
     * The value for the created field.
     * @var        \DateTime
     */
    protected $created;

    /**
     * The value for the updated field.
     * @var        \DateTime
     */
    protected $updated;

    /**
     * The value for the upvotes field.
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $upvotes;

    /**
     * The value for the downvotes field.
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $downvotes;

    /**
     * The value for the comments field.
     * @var        string
     */
    protected $comments;

    /**
     * The value for the score field.
     * @var        int
     */
    protected $score;

    /**
     * @var        ChildGames
     */
    protected $aGames;

    /**
     * @var        ChildUser
     */
    protected $aUser;

    /**
     * @var        ChildRigs
     */
    protected $aRigs;

    /**
     * @var        ChildPlatforms
     */
    protected $aPlatforms;

    /**
     * @var        ObjectCollection|ChildRatingCategoryValues[] Collection to store aggregation of ChildRatingCategoryValues objects.
     */
    protected $collRatingCategoryValuess;
    protected $collRatingCategoryValuessPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRatingCategoryValues[]
     */
    protected $ratingCategoryValuessScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->upvotes = '0';
        $this->downvotes = '0';
    }

    /**
     * Initializes internal state of Base\RatingHeaders object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
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
     * Compares this with another <code>RatingHeaders</code> instance.  If
     * <code>obj</code> is an instance of <code>RatingHeaders</code>, delegates to
     * <code>equals(RatingHeaders)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|RatingHeaders The current object, for fluid interface
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
     * Get the [game_id] column value.
     * 
     * @return string
     */
    public function getGameId()
    {
        return $this->game_id;
    }

    /**
     * Get the [user_id] column value.
     * 
     * @return string
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the [game_platform_id] column value.
     * 
     * @return string
     */
    public function getGamePlatformId()
    {
        return $this->game_platform_id;
    }

    /**
     * Get the [rig_id] column value.
     * 
     * @return string
     */
    public function getRigId()
    {
        return $this->rig_id;
    }

    /**
     * Get the [optionally formatted] temporal [created] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreated($format = NULL)
    {
        if ($format === null) {
            return $this->created;
        } else {
            return $this->created instanceof \DateTime ? $this->created->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdated($format = NULL)
    {
        if ($format === null) {
            return $this->updated;
        } else {
            return $this->updated instanceof \DateTime ? $this->updated->format($format) : null;
        }
    }

    /**
     * Get the [upvotes] column value.
     * 
     * @return string
     */
    public function getUpvotes()
    {
        return $this->upvotes;
    }

    /**
     * Get the [downvotes] column value.
     * 
     * @return string
     */
    public function getDownvotes()
    {
        return $this->downvotes;
    }

    /**
     * Get the [comments] column value.
     * 
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Get the [score] column value.
     * 
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set the value of [id] column.
     * 
     * @param string $v new value
     * @return $this|\RatingHeaders The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[RatingHeadersTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [game_id] column.
     * 
     * @param string $v new value
     * @return $this|\RatingHeaders The current object (for fluent API support)
     */
    public function setGameId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->game_id !== $v) {
            $this->game_id = $v;
            $this->modifiedColumns[RatingHeadersTableMap::COL_GAME_ID] = true;
        }

        if ($this->aGames !== null && $this->aGames->getId() !== $v) {
            $this->aGames = null;
        }

        return $this;
    } // setGameId()

    /**
     * Set the value of [user_id] column.
     * 
     * @param string $v new value
     * @return $this|\RatingHeaders The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[RatingHeadersTableMap::COL_USER_ID] = true;
        }

        if ($this->aUser !== null && $this->aUser->getId() !== $v) {
            $this->aUser = null;
        }

        return $this;
    } // setUserId()

    /**
     * Set the value of [game_platform_id] column.
     * 
     * @param string $v new value
     * @return $this|\RatingHeaders The current object (for fluent API support)
     */
    public function setGamePlatformId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->game_platform_id !== $v) {
            $this->game_platform_id = $v;
            $this->modifiedColumns[RatingHeadersTableMap::COL_GAME_PLATFORM_ID] = true;
        }

        if ($this->aPlatforms !== null && $this->aPlatforms->getId() !== $v) {
            $this->aPlatforms = null;
        }

        return $this;
    } // setGamePlatformId()

    /**
     * Set the value of [rig_id] column.
     * 
     * @param string $v new value
     * @return $this|\RatingHeaders The current object (for fluent API support)
     */
    public function setRigId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rig_id !== $v) {
            $this->rig_id = $v;
            $this->modifiedColumns[RatingHeadersTableMap::COL_RIG_ID] = true;
        }

        if ($this->aRigs !== null && $this->aRigs->getId() !== $v) {
            $this->aRigs = null;
        }

        return $this;
    } // setRigId()

    /**
     * Sets the value of [created] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\RatingHeaders The current object (for fluent API support)
     */
    public function setCreated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created !== null || $dt !== null) {
            if ($this->created === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created->format("Y-m-d H:i:s")) {
                $this->created = $dt === null ? null : clone $dt;
                $this->modifiedColumns[RatingHeadersTableMap::COL_CREATED] = true;
            }
        } // if either are not null

        return $this;
    } // setCreated()

    /**
     * Sets the value of [updated] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\RatingHeaders The current object (for fluent API support)
     */
    public function setUpdated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated !== null || $dt !== null) {
            if ($this->updated === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated->format("Y-m-d H:i:s")) {
                $this->updated = $dt === null ? null : clone $dt;
                $this->modifiedColumns[RatingHeadersTableMap::COL_UPDATED] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdated()

    /**
     * Set the value of [upvotes] column.
     * 
     * @param string $v new value
     * @return $this|\RatingHeaders The current object (for fluent API support)
     */
    public function setUpvotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->upvotes !== $v) {
            $this->upvotes = $v;
            $this->modifiedColumns[RatingHeadersTableMap::COL_UPVOTES] = true;
        }

        return $this;
    } // setUpvotes()

    /**
     * Set the value of [downvotes] column.
     * 
     * @param string $v new value
     * @return $this|\RatingHeaders The current object (for fluent API support)
     */
    public function setDownvotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->downvotes !== $v) {
            $this->downvotes = $v;
            $this->modifiedColumns[RatingHeadersTableMap::COL_DOWNVOTES] = true;
        }

        return $this;
    } // setDownvotes()

    /**
     * Set the value of [comments] column.
     * 
     * @param string $v new value
     * @return $this|\RatingHeaders The current object (for fluent API support)
     */
    public function setComments($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comments !== $v) {
            $this->comments = $v;
            $this->modifiedColumns[RatingHeadersTableMap::COL_COMMENTS] = true;
        }

        return $this;
    } // setComments()

    /**
     * Set the value of [score] column.
     * 
     * @param int $v new value
     * @return $this|\RatingHeaders The current object (for fluent API support)
     */
    public function setScore($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->score !== $v) {
            $this->score = $v;
            $this->modifiedColumns[RatingHeadersTableMap::COL_SCORE] = true;
        }

        return $this;
    } // setScore()

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
            if ($this->upvotes !== '0') {
                return false;
            }

            if ($this->downvotes !== '0') {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : RatingHeadersTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : RatingHeadersTableMap::translateFieldName('GameId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->game_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : RatingHeadersTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : RatingHeadersTableMap::translateFieldName('GamePlatformId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->game_platform_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : RatingHeadersTableMap::translateFieldName('RigId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rig_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : RatingHeadersTableMap::translateFieldName('Created', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : RatingHeadersTableMap::translateFieldName('Updated', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : RatingHeadersTableMap::translateFieldName('Upvotes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->upvotes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : RatingHeadersTableMap::translateFieldName('Downvotes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->downvotes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : RatingHeadersTableMap::translateFieldName('Comments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comments = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : RatingHeadersTableMap::translateFieldName('Score', TableMap::TYPE_PHPNAME, $indexType)];
            $this->score = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = RatingHeadersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\RatingHeaders'), 0, $e);
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
        if ($this->aGames !== null && $this->game_id !== $this->aGames->getId()) {
            $this->aGames = null;
        }
        if ($this->aUser !== null && $this->user_id !== $this->aUser->getId()) {
            $this->aUser = null;
        }
        if ($this->aPlatforms !== null && $this->game_platform_id !== $this->aPlatforms->getId()) {
            $this->aPlatforms = null;
        }
        if ($this->aRigs !== null && $this->rig_id !== $this->aRigs->getId()) {
            $this->aRigs = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(RatingHeadersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildRatingHeadersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aGames = null;
            $this->aUser = null;
            $this->aRigs = null;
            $this->aPlatforms = null;
            $this->collRatingCategoryValuess = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see RatingHeaders::setDeleted()
     * @see RatingHeaders::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(RatingHeadersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildRatingHeadersQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(RatingHeadersTableMap::DATABASE_NAME);
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
                RatingHeadersTableMap::addInstanceToPool($this);
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

            if ($this->aGames !== null) {
                if ($this->aGames->isModified() || $this->aGames->isNew()) {
                    $affectedRows += $this->aGames->save($con);
                }
                $this->setGames($this->aGames);
            }

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
            }

            if ($this->aRigs !== null) {
                if ($this->aRigs->isModified() || $this->aRigs->isNew()) {
                    $affectedRows += $this->aRigs->save($con);
                }
                $this->setRigs($this->aRigs);
            }

            if ($this->aPlatforms !== null) {
                if ($this->aPlatforms->isModified() || $this->aPlatforms->isNew()) {
                    $affectedRows += $this->aPlatforms->save($con);
                }
                $this->setPlatforms($this->aPlatforms);
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

            if ($this->ratingCategoryValuessScheduledForDeletion !== null) {
                if (!$this->ratingCategoryValuessScheduledForDeletion->isEmpty()) {
                    \RatingCategoryValuesQuery::create()
                        ->filterByPrimaryKeys($this->ratingCategoryValuessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ratingCategoryValuessScheduledForDeletion = null;
                }
            }

            if ($this->collRatingCategoryValuess !== null) {
                foreach ($this->collRatingCategoryValuess as $referrerFK) {
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

        $this->modifiedColumns[RatingHeadersTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . RatingHeadersTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RatingHeadersTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_GAME_ID)) {
            $modifiedColumns[':p' . $index++]  = 'game_id';
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'user_id';
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_GAME_PLATFORM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'game_platform_id';
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_RIG_ID)) {
            $modifiedColumns[':p' . $index++]  = 'rig_id';
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_CREATED)) {
            $modifiedColumns[':p' . $index++]  = 'created';
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_UPDATED)) {
            $modifiedColumns[':p' . $index++]  = 'updated';
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_UPVOTES)) {
            $modifiedColumns[':p' . $index++]  = 'upvotes';
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_DOWNVOTES)) {
            $modifiedColumns[':p' . $index++]  = 'downvotes';
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_COMMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'comments';
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_SCORE)) {
            $modifiedColumns[':p' . $index++]  = 'score';
        }

        $sql = sprintf(
            'INSERT INTO rating_headers (%s) VALUES (%s)',
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
                    case 'game_id':                        
                        $stmt->bindValue($identifier, $this->game_id, PDO::PARAM_INT);
                        break;
                    case 'user_id':                        
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                    case 'game_platform_id':                        
                        $stmt->bindValue($identifier, $this->game_platform_id, PDO::PARAM_INT);
                        break;
                    case 'rig_id':                        
                        $stmt->bindValue($identifier, $this->rig_id, PDO::PARAM_INT);
                        break;
                    case 'created':                        
                        $stmt->bindValue($identifier, $this->created ? $this->created->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'updated':                        
                        $stmt->bindValue($identifier, $this->updated ? $this->updated->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'upvotes':                        
                        $stmt->bindValue($identifier, $this->upvotes, PDO::PARAM_INT);
                        break;
                    case 'downvotes':                        
                        $stmt->bindValue($identifier, $this->downvotes, PDO::PARAM_INT);
                        break;
                    case 'comments':                        
                        $stmt->bindValue($identifier, $this->comments, PDO::PARAM_STR);
                        break;
                    case 'score':                        
                        $stmt->bindValue($identifier, $this->score, PDO::PARAM_INT);
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
        $pos = RatingHeadersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getGameId();
                break;
            case 2:
                return $this->getUserId();
                break;
            case 3:
                return $this->getGamePlatformId();
                break;
            case 4:
                return $this->getRigId();
                break;
            case 5:
                return $this->getCreated();
                break;
            case 6:
                return $this->getUpdated();
                break;
            case 7:
                return $this->getUpvotes();
                break;
            case 8:
                return $this->getDownvotes();
                break;
            case 9:
                return $this->getComments();
                break;
            case 10:
                return $this->getScore();
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

        if (isset($alreadyDumpedObjects['RatingHeaders'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['RatingHeaders'][$this->hashCode()] = true;
        $keys = RatingHeadersTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getGameId(),
            $keys[2] => $this->getUserId(),
            $keys[3] => $this->getGamePlatformId(),
            $keys[4] => $this->getRigId(),
            $keys[5] => $this->getCreated(),
            $keys[6] => $this->getUpdated(),
            $keys[7] => $this->getUpvotes(),
            $keys[8] => $this->getDownvotes(),
            $keys[9] => $this->getComments(),
            $keys[10] => $this->getScore(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[5]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[5]];
            $result[$keys[5]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        if ($result[$keys[6]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[6]];
            $result[$keys[6]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }
        
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->aGames) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'games';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'games';
                        break;
                    default:
                        $key = 'Games';
                }
        
                $result[$key] = $this->aGames->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUser) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user';
                        break;
                    default:
                        $key = 'User';
                }
        
                $result[$key] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aRigs) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'rigs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'rigs';
                        break;
                    default:
                        $key = 'Rigs';
                }
        
                $result[$key] = $this->aRigs->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPlatforms) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'platforms';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'platforms';
                        break;
                    default:
                        $key = 'Platforms';
                }
        
                $result[$key] = $this->aPlatforms->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collRatingCategoryValuess) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ratingCategoryValuess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'rating_category_valuess';
                        break;
                    default:
                        $key = 'RatingCategoryValuess';
                }
        
                $result[$key] = $this->collRatingCategoryValuess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\RatingHeaders
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = RatingHeadersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\RatingHeaders
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setGameId($value);
                break;
            case 2:
                $this->setUserId($value);
                break;
            case 3:
                $this->setGamePlatformId($value);
                break;
            case 4:
                $this->setRigId($value);
                break;
            case 5:
                $this->setCreated($value);
                break;
            case 6:
                $this->setUpdated($value);
                break;
            case 7:
                $this->setUpvotes($value);
                break;
            case 8:
                $this->setDownvotes($value);
                break;
            case 9:
                $this->setComments($value);
                break;
            case 10:
                $this->setScore($value);
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
        $keys = RatingHeadersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setGameId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setUserId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setGamePlatformId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setRigId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCreated($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setUpdated($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUpvotes($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDownvotes($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setComments($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setScore($arr[$keys[10]]);
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
     * @return $this|\RatingHeaders The current object, for fluid interface
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
        $criteria = new Criteria(RatingHeadersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(RatingHeadersTableMap::COL_ID)) {
            $criteria->add(RatingHeadersTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_GAME_ID)) {
            $criteria->add(RatingHeadersTableMap::COL_GAME_ID, $this->game_id);
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_USER_ID)) {
            $criteria->add(RatingHeadersTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_GAME_PLATFORM_ID)) {
            $criteria->add(RatingHeadersTableMap::COL_GAME_PLATFORM_ID, $this->game_platform_id);
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_RIG_ID)) {
            $criteria->add(RatingHeadersTableMap::COL_RIG_ID, $this->rig_id);
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_CREATED)) {
            $criteria->add(RatingHeadersTableMap::COL_CREATED, $this->created);
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_UPDATED)) {
            $criteria->add(RatingHeadersTableMap::COL_UPDATED, $this->updated);
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_UPVOTES)) {
            $criteria->add(RatingHeadersTableMap::COL_UPVOTES, $this->upvotes);
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_DOWNVOTES)) {
            $criteria->add(RatingHeadersTableMap::COL_DOWNVOTES, $this->downvotes);
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_COMMENTS)) {
            $criteria->add(RatingHeadersTableMap::COL_COMMENTS, $this->comments);
        }
        if ($this->isColumnModified(RatingHeadersTableMap::COL_SCORE)) {
            $criteria->add(RatingHeadersTableMap::COL_SCORE, $this->score);
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
        $criteria = ChildRatingHeadersQuery::create();
        $criteria->add(RatingHeadersTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \RatingHeaders (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setGameId($this->getGameId());
        $copyObj->setUserId($this->getUserId());
        $copyObj->setGamePlatformId($this->getGamePlatformId());
        $copyObj->setRigId($this->getRigId());
        $copyObj->setCreated($this->getCreated());
        $copyObj->setUpdated($this->getUpdated());
        $copyObj->setUpvotes($this->getUpvotes());
        $copyObj->setDownvotes($this->getDownvotes());
        $copyObj->setComments($this->getComments());
        $copyObj->setScore($this->getScore());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getRatingCategoryValuess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRatingCategoryValues($relObj->copy($deepCopy));
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
     * @return \RatingHeaders Clone of current object.
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
     * Declares an association between this object and a ChildGames object.
     *
     * @param  ChildGames $v
     * @return $this|\RatingHeaders The current object (for fluent API support)
     * @throws PropelException
     */
    public function setGames(ChildGames $v = null)
    {
        if ($v === null) {
            $this->setGameId(NULL);
        } else {
            $this->setGameId($v->getId());
        }

        $this->aGames = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGames object, it will not be re-added.
        if ($v !== null) {
            $v->addRatingHeaders($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGames object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildGames The associated ChildGames object.
     * @throws PropelException
     */
    public function getGames(ConnectionInterface $con = null)
    {
        if ($this->aGames === null && (($this->game_id !== "" && $this->game_id !== null))) {
            $this->aGames = ChildGamesQuery::create()->findPk($this->game_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGames->addRatingHeaderss($this);
             */
        }

        return $this->aGames;
    }

    /**
     * Declares an association between this object and a ChildUser object.
     *
     * @param  ChildUser $v
     * @return $this|\RatingHeaders The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUser(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setUserId(NULL);
        } else {
            $this->setUserId($v->getId());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addRatingHeaders($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUser object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUser The associated ChildUser object.
     * @throws PropelException
     */
    public function getUser(ConnectionInterface $con = null)
    {
        if ($this->aUser === null && (($this->user_id !== "" && $this->user_id !== null))) {
            $this->aUser = ChildUserQuery::create()->findPk($this->user_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addRatingHeaderss($this);
             */
        }

        return $this->aUser;
    }

    /**
     * Declares an association between this object and a ChildRigs object.
     *
     * @param  ChildRigs $v
     * @return $this|\RatingHeaders The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRigs(ChildRigs $v = null)
    {
        if ($v === null) {
            $this->setRigId(NULL);
        } else {
            $this->setRigId($v->getId());
        }

        $this->aRigs = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildRigs object, it will not be re-added.
        if ($v !== null) {
            $v->addRatingHeaders($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildRigs object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildRigs The associated ChildRigs object.
     * @throws PropelException
     */
    public function getRigs(ConnectionInterface $con = null)
    {
        if ($this->aRigs === null && (($this->rig_id !== "" && $this->rig_id !== null))) {
            $this->aRigs = ChildRigsQuery::create()->findPk($this->rig_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aRigs->addRatingHeaderss($this);
             */
        }

        return $this->aRigs;
    }

    /**
     * Declares an association between this object and a ChildPlatforms object.
     *
     * @param  ChildPlatforms $v
     * @return $this|\RatingHeaders The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPlatforms(ChildPlatforms $v = null)
    {
        if ($v === null) {
            $this->setGamePlatformId(NULL);
        } else {
            $this->setGamePlatformId($v->getId());
        }

        $this->aPlatforms = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPlatforms object, it will not be re-added.
        if ($v !== null) {
            $v->addRatingHeaders($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPlatforms object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPlatforms The associated ChildPlatforms object.
     * @throws PropelException
     */
    public function getPlatforms(ConnectionInterface $con = null)
    {
        if ($this->aPlatforms === null && (($this->game_platform_id !== "" && $this->game_platform_id !== null))) {
            $this->aPlatforms = ChildPlatformsQuery::create()->findPk($this->game_platform_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPlatforms->addRatingHeaderss($this);
             */
        }

        return $this->aPlatforms;
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
        if ('RatingCategoryValues' == $relationName) {
            return $this->initRatingCategoryValuess();
        }
    }

    /**
     * Clears out the collRatingCategoryValuess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRatingCategoryValuess()
     */
    public function clearRatingCategoryValuess()
    {
        $this->collRatingCategoryValuess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collRatingCategoryValuess collection loaded partially.
     */
    public function resetPartialRatingCategoryValuess($v = true)
    {
        $this->collRatingCategoryValuessPartial = $v;
    }

    /**
     * Initializes the collRatingCategoryValuess collection.
     *
     * By default this just sets the collRatingCategoryValuess collection to an empty array (like clearcollRatingCategoryValuess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRatingCategoryValuess($overrideExisting = true)
    {
        if (null !== $this->collRatingCategoryValuess && !$overrideExisting) {
            return;
        }
        $this->collRatingCategoryValuess = new ObjectCollection();
        $this->collRatingCategoryValuess->setModel('\RatingCategoryValues');
    }

    /**
     * Gets an array of ChildRatingCategoryValues objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRatingHeaders is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRatingCategoryValues[] List of ChildRatingCategoryValues objects
     * @throws PropelException
     */
    public function getRatingCategoryValuess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRatingCategoryValuessPartial && !$this->isNew();
        if (null === $this->collRatingCategoryValuess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRatingCategoryValuess) {
                // return empty collection
                $this->initRatingCategoryValuess();
            } else {
                $collRatingCategoryValuess = ChildRatingCategoryValuesQuery::create(null, $criteria)
                    ->filterByRatingHeaders($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRatingCategoryValuessPartial && count($collRatingCategoryValuess)) {
                        $this->initRatingCategoryValuess(false);

                        foreach ($collRatingCategoryValuess as $obj) {
                            if (false == $this->collRatingCategoryValuess->contains($obj)) {
                                $this->collRatingCategoryValuess->append($obj);
                            }
                        }

                        $this->collRatingCategoryValuessPartial = true;
                    }

                    return $collRatingCategoryValuess;
                }

                if ($partial && $this->collRatingCategoryValuess) {
                    foreach ($this->collRatingCategoryValuess as $obj) {
                        if ($obj->isNew()) {
                            $collRatingCategoryValuess[] = $obj;
                        }
                    }
                }

                $this->collRatingCategoryValuess = $collRatingCategoryValuess;
                $this->collRatingCategoryValuessPartial = false;
            }
        }

        return $this->collRatingCategoryValuess;
    }

    /**
     * Sets a collection of ChildRatingCategoryValues objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $ratingCategoryValuess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildRatingHeaders The current object (for fluent API support)
     */
    public function setRatingCategoryValuess(Collection $ratingCategoryValuess, ConnectionInterface $con = null)
    {
        /** @var ChildRatingCategoryValues[] $ratingCategoryValuessToDelete */
        $ratingCategoryValuessToDelete = $this->getRatingCategoryValuess(new Criteria(), $con)->diff($ratingCategoryValuess);

        
        $this->ratingCategoryValuessScheduledForDeletion = $ratingCategoryValuessToDelete;

        foreach ($ratingCategoryValuessToDelete as $ratingCategoryValuesRemoved) {
            $ratingCategoryValuesRemoved->setRatingHeaders(null);
        }

        $this->collRatingCategoryValuess = null;
        foreach ($ratingCategoryValuess as $ratingCategoryValues) {
            $this->addRatingCategoryValues($ratingCategoryValues);
        }

        $this->collRatingCategoryValuess = $ratingCategoryValuess;
        $this->collRatingCategoryValuessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related RatingCategoryValues objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related RatingCategoryValues objects.
     * @throws PropelException
     */
    public function countRatingCategoryValuess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRatingCategoryValuessPartial && !$this->isNew();
        if (null === $this->collRatingCategoryValuess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRatingCategoryValuess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRatingCategoryValuess());
            }

            $query = ChildRatingCategoryValuesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRatingHeaders($this)
                ->count($con);
        }

        return count($this->collRatingCategoryValuess);
    }

    /**
     * Method called to associate a ChildRatingCategoryValues object to this object
     * through the ChildRatingCategoryValues foreign key attribute.
     *
     * @param  ChildRatingCategoryValues $l ChildRatingCategoryValues
     * @return $this|\RatingHeaders The current object (for fluent API support)
     */
    public function addRatingCategoryValues(ChildRatingCategoryValues $l)
    {
        if ($this->collRatingCategoryValuess === null) {
            $this->initRatingCategoryValuess();
            $this->collRatingCategoryValuessPartial = true;
        }

        if (!$this->collRatingCategoryValuess->contains($l)) {
            $this->doAddRatingCategoryValues($l);
        }

        return $this;
    }

    /**
     * @param ChildRatingCategoryValues $ratingCategoryValues The ChildRatingCategoryValues object to add.
     */
    protected function doAddRatingCategoryValues(ChildRatingCategoryValues $ratingCategoryValues)
    {
        $this->collRatingCategoryValuess[]= $ratingCategoryValues;
        $ratingCategoryValues->setRatingHeaders($this);
    }

    /**
     * @param  ChildRatingCategoryValues $ratingCategoryValues The ChildRatingCategoryValues object to remove.
     * @return $this|ChildRatingHeaders The current object (for fluent API support)
     */
    public function removeRatingCategoryValues(ChildRatingCategoryValues $ratingCategoryValues)
    {
        if ($this->getRatingCategoryValuess()->contains($ratingCategoryValues)) {
            $pos = $this->collRatingCategoryValuess->search($ratingCategoryValues);
            $this->collRatingCategoryValuess->remove($pos);
            if (null === $this->ratingCategoryValuessScheduledForDeletion) {
                $this->ratingCategoryValuessScheduledForDeletion = clone $this->collRatingCategoryValuess;
                $this->ratingCategoryValuessScheduledForDeletion->clear();
            }
            $this->ratingCategoryValuessScheduledForDeletion[]= clone $ratingCategoryValues;
            $ratingCategoryValues->setRatingHeaders(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this RatingHeaders is new, it will return
     * an empty collection; or if this RatingHeaders has previously
     * been saved, it will retrieve related RatingCategoryValuess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in RatingHeaders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRatingCategoryValues[] List of ChildRatingCategoryValues objects
     */
    public function getRatingCategoryValuessJoinRatingCategories(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRatingCategoryValuesQuery::create(null, $criteria);
        $query->joinWith('RatingCategories', $joinBehavior);

        return $this->getRatingCategoryValuess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this RatingHeaders is new, it will return
     * an empty collection; or if this RatingHeaders has previously
     * been saved, it will retrieve related RatingCategoryValuess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in RatingHeaders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRatingCategoryValues[] List of ChildRatingCategoryValues objects
     */
    public function getRatingCategoryValuessJoinRatingCategoryOptions(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRatingCategoryValuesQuery::create(null, $criteria);
        $query->joinWith('RatingCategoryOptions', $joinBehavior);

        return $this->getRatingCategoryValuess($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aGames) {
            $this->aGames->removeRatingHeaders($this);
        }
        if (null !== $this->aUser) {
            $this->aUser->removeRatingHeaders($this);
        }
        if (null !== $this->aRigs) {
            $this->aRigs->removeRatingHeaders($this);
        }
        if (null !== $this->aPlatforms) {
            $this->aPlatforms->removeRatingHeaders($this);
        }
        $this->id = null;
        $this->game_id = null;
        $this->user_id = null;
        $this->game_platform_id = null;
        $this->rig_id = null;
        $this->created = null;
        $this->updated = null;
        $this->upvotes = null;
        $this->downvotes = null;
        $this->comments = null;
        $this->score = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
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
            if ($this->collRatingCategoryValuess) {
                foreach ($this->collRatingCategoryValuess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collRatingCategoryValuess = null;
        $this->aGames = null;
        $this->aUser = null;
        $this->aRigs = null;
        $this->aPlatforms = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(RatingHeadersTableMap::DEFAULT_STRING_FORMAT);
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
