<?php

namespace Base;

use \Game as ChildGame;
use \GameQuery as ChildGameQuery;
use \Platform as ChildPlatform;
use \PlatformQuery as ChildPlatformQuery;
use \Rating as ChildRating;
use \RatingQuery as ChildRatingQuery;
use \Rig as ChildRig;
use \RigQuery as ChildRigQuery;
use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \UserReviewQuery as ChildUserReviewQuery;
use \Exception;
use \PDO;
use Map\UserReviewTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'user_review' table.
 *
 * 
 *
* @package    propel.generator..Base
*/
abstract class UserReview implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\UserReviewTableMap';


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
     * The value for the platform_id field.
     * @var        string
     */
    protected $platform_id;

    /**
     * The value for the user_id field.
     * @var        string
     */
    protected $user_id;

    /**
     * The value for the rig_id field.
     * @var        string
     */
    protected $rig_id;

    /**
     * The value for the rating_id field.
     * @var        string
     */
    protected $rating_id;

    /**
     * The value for the review field.
     * @var        string
     */
    protected $review;

    /**
     * The value for the upvotes field.
     * @var        string
     */
    protected $upvotes;

    /**
     * The value for the downvotes field.
     * @var        string
     */
    protected $downvotes;

    /**
     * @var        ChildGame
     */
    protected $aGame;

    /**
     * @var        ChildPlatform
     */
    protected $aPlatform;

    /**
     * @var        ChildUser
     */
    protected $aUser;

    /**
     * @var        ChildRating
     */
    protected $aRating;

    /**
     * @var        ChildRig
     */
    protected $aRig;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\UserReview object.
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
     * Compares this with another <code>UserReview</code> instance.  If
     * <code>obj</code> is an instance of <code>UserReview</code>, delegates to
     * <code>equals(UserReview)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|UserReview The current object, for fluid interface
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
     * Get the [platform_id] column value.
     * 
     * @return string
     */
    public function getPlatformId()
    {
        return $this->platform_id;
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
     * Get the [rig_id] column value.
     * 
     * @return string
     */
    public function getRigId()
    {
        return $this->rig_id;
    }

    /**
     * Get the [rating_id] column value.
     * 
     * @return string
     */
    public function getRatingId()
    {
        return $this->rating_id;
    }

    /**
     * Get the [review] column value.
     * 
     * @return string
     */
    public function getReview()
    {
        return $this->review;
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
     * Set the value of [id] column.
     * 
     * @param string $v new value
     * @return $this|\UserReview The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[UserReviewTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [game_id] column.
     * 
     * @param string $v new value
     * @return $this|\UserReview The current object (for fluent API support)
     */
    public function setGameId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->game_id !== $v) {
            $this->game_id = $v;
            $this->modifiedColumns[UserReviewTableMap::COL_GAME_ID] = true;
        }

        if ($this->aGame !== null && $this->aGame->getId() !== $v) {
            $this->aGame = null;
        }

        return $this;
    } // setGameId()

    /**
     * Set the value of [platform_id] column.
     * 
     * @param string $v new value
     * @return $this|\UserReview The current object (for fluent API support)
     */
    public function setPlatformId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->platform_id !== $v) {
            $this->platform_id = $v;
            $this->modifiedColumns[UserReviewTableMap::COL_PLATFORM_ID] = true;
        }

        if ($this->aPlatform !== null && $this->aPlatform->getId() !== $v) {
            $this->aPlatform = null;
        }

        return $this;
    } // setPlatformId()

    /**
     * Set the value of [user_id] column.
     * 
     * @param string $v new value
     * @return $this|\UserReview The current object (for fluent API support)
     */
    public function setUserId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->user_id !== $v) {
            $this->user_id = $v;
            $this->modifiedColumns[UserReviewTableMap::COL_USER_ID] = true;
        }

        if ($this->aUser !== null && $this->aUser->getId() !== $v) {
            $this->aUser = null;
        }

        return $this;
    } // setUserId()

    /**
     * Set the value of [rig_id] column.
     * 
     * @param string $v new value
     * @return $this|\UserReview The current object (for fluent API support)
     */
    public function setRigId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rig_id !== $v) {
            $this->rig_id = $v;
            $this->modifiedColumns[UserReviewTableMap::COL_RIG_ID] = true;
        }

        if ($this->aRig !== null && $this->aRig->getId() !== $v) {
            $this->aRig = null;
        }

        return $this;
    } // setRigId()

    /**
     * Set the value of [rating_id] column.
     * 
     * @param string $v new value
     * @return $this|\UserReview The current object (for fluent API support)
     */
    public function setRatingId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rating_id !== $v) {
            $this->rating_id = $v;
            $this->modifiedColumns[UserReviewTableMap::COL_RATING_ID] = true;
        }

        if ($this->aRating !== null && $this->aRating->getId() !== $v) {
            $this->aRating = null;
        }

        return $this;
    } // setRatingId()

    /**
     * Set the value of [review] column.
     * 
     * @param string $v new value
     * @return $this|\UserReview The current object (for fluent API support)
     */
    public function setReview($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->review !== $v) {
            $this->review = $v;
            $this->modifiedColumns[UserReviewTableMap::COL_REVIEW] = true;
        }

        return $this;
    } // setReview()

    /**
     * Set the value of [upvotes] column.
     * 
     * @param string $v new value
     * @return $this|\UserReview The current object (for fluent API support)
     */
    public function setUpvotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->upvotes !== $v) {
            $this->upvotes = $v;
            $this->modifiedColumns[UserReviewTableMap::COL_UPVOTES] = true;
        }

        return $this;
    } // setUpvotes()

    /**
     * Set the value of [downvotes] column.
     * 
     * @param string $v new value
     * @return $this|\UserReview The current object (for fluent API support)
     */
    public function setDownvotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->downvotes !== $v) {
            $this->downvotes = $v;
            $this->modifiedColumns[UserReviewTableMap::COL_DOWNVOTES] = true;
        }

        return $this;
    } // setDownvotes()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UserReviewTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UserReviewTableMap::translateFieldName('GameId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->game_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UserReviewTableMap::translateFieldName('PlatformId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->platform_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UserReviewTableMap::translateFieldName('UserId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UserReviewTableMap::translateFieldName('RigId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rig_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UserReviewTableMap::translateFieldName('RatingId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rating_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UserReviewTableMap::translateFieldName('Review', TableMap::TYPE_PHPNAME, $indexType)];
            $this->review = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UserReviewTableMap::translateFieldName('Upvotes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->upvotes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UserReviewTableMap::translateFieldName('Downvotes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->downvotes = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = UserReviewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\UserReview'), 0, $e);
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
        if ($this->aGame !== null && $this->game_id !== $this->aGame->getId()) {
            $this->aGame = null;
        }
        if ($this->aPlatform !== null && $this->platform_id !== $this->aPlatform->getId()) {
            $this->aPlatform = null;
        }
        if ($this->aUser !== null && $this->user_id !== $this->aUser->getId()) {
            $this->aUser = null;
        }
        if ($this->aRig !== null && $this->rig_id !== $this->aRig->getId()) {
            $this->aRig = null;
        }
        if ($this->aRating !== null && $this->rating_id !== $this->aRating->getId()) {
            $this->aRating = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(UserReviewTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUserReviewQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aGame = null;
            $this->aPlatform = null;
            $this->aUser = null;
            $this->aRating = null;
            $this->aRig = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see UserReview::setDeleted()
     * @see UserReview::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserReviewTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUserReviewQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserReviewTableMap::DATABASE_NAME);
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
                UserReviewTableMap::addInstanceToPool($this);
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

            if ($this->aGame !== null) {
                if ($this->aGame->isModified() || $this->aGame->isNew()) {
                    $affectedRows += $this->aGame->save($con);
                }
                $this->setGame($this->aGame);
            }

            if ($this->aPlatform !== null) {
                if ($this->aPlatform->isModified() || $this->aPlatform->isNew()) {
                    $affectedRows += $this->aPlatform->save($con);
                }
                $this->setPlatform($this->aPlatform);
            }

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
            }

            if ($this->aRating !== null) {
                if ($this->aRating->isModified() || $this->aRating->isNew()) {
                    $affectedRows += $this->aRating->save($con);
                }
                $this->setRating($this->aRating);
            }

            if ($this->aRig !== null) {
                if ($this->aRig->isModified() || $this->aRig->isNew()) {
                    $affectedRows += $this->aRig->save($con);
                }
                $this->setRig($this->aRig);
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

        $this->modifiedColumns[UserReviewTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserReviewTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserReviewTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_GAME_ID)) {
            $modifiedColumns[':p' . $index++]  = 'game_id';
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_PLATFORM_ID)) {
            $modifiedColumns[':p' . $index++]  = 'platform_id';
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_USER_ID)) {
            $modifiedColumns[':p' . $index++]  = 'user_id';
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_RIG_ID)) {
            $modifiedColumns[':p' . $index++]  = 'rig_id';
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_RATING_ID)) {
            $modifiedColumns[':p' . $index++]  = 'rating_id';
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_REVIEW)) {
            $modifiedColumns[':p' . $index++]  = 'review';
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_UPVOTES)) {
            $modifiedColumns[':p' . $index++]  = 'upvotes';
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_DOWNVOTES)) {
            $modifiedColumns[':p' . $index++]  = 'downvotes';
        }

        $sql = sprintf(
            'INSERT INTO user_review (%s) VALUES (%s)',
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
                    case 'platform_id':                        
                        $stmt->bindValue($identifier, $this->platform_id, PDO::PARAM_INT);
                        break;
                    case 'user_id':                        
                        $stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
                        break;
                    case 'rig_id':                        
                        $stmt->bindValue($identifier, $this->rig_id, PDO::PARAM_INT);
                        break;
                    case 'rating_id':                        
                        $stmt->bindValue($identifier, $this->rating_id, PDO::PARAM_INT);
                        break;
                    case 'review':                        
                        $stmt->bindValue($identifier, $this->review, PDO::PARAM_STR);
                        break;
                    case 'upvotes':                        
                        $stmt->bindValue($identifier, $this->upvotes, PDO::PARAM_INT);
                        break;
                    case 'downvotes':                        
                        $stmt->bindValue($identifier, $this->downvotes, PDO::PARAM_INT);
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
        $pos = UserReviewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPlatformId();
                break;
            case 3:
                return $this->getUserId();
                break;
            case 4:
                return $this->getRigId();
                break;
            case 5:
                return $this->getRatingId();
                break;
            case 6:
                return $this->getReview();
                break;
            case 7:
                return $this->getUpvotes();
                break;
            case 8:
                return $this->getDownvotes();
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

        if (isset($alreadyDumpedObjects['UserReview'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['UserReview'][$this->hashCode()] = true;
        $keys = UserReviewTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getGameId(),
            $keys[2] => $this->getPlatformId(),
            $keys[3] => $this->getUserId(),
            $keys[4] => $this->getRigId(),
            $keys[5] => $this->getRatingId(),
            $keys[6] => $this->getReview(),
            $keys[7] => $this->getUpvotes(),
            $keys[8] => $this->getDownvotes(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->aGame) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'game';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'game';
                        break;
                    default:
                        $key = 'Game';
                }
        
                $result[$key] = $this->aGame->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPlatform) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'platform';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'platform';
                        break;
                    default:
                        $key = 'Platform';
                }
        
                $result[$key] = $this->aPlatform->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aRating) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'rating';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'rating';
                        break;
                    default:
                        $key = 'Rating';
                }
        
                $result[$key] = $this->aRating->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aRig) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'rig';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'rig';
                        break;
                    default:
                        $key = 'Rig';
                }
        
                $result[$key] = $this->aRig->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\UserReview
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UserReviewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\UserReview
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
                $this->setPlatformId($value);
                break;
            case 3:
                $this->setUserId($value);
                break;
            case 4:
                $this->setRigId($value);
                break;
            case 5:
                $this->setRatingId($value);
                break;
            case 6:
                $this->setReview($value);
                break;
            case 7:
                $this->setUpvotes($value);
                break;
            case 8:
                $this->setDownvotes($value);
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
        $keys = UserReviewTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setGameId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPlatformId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setUserId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setRigId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setRatingId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setReview($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUpvotes($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDownvotes($arr[$keys[8]]);
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
     * @return $this|\UserReview The current object, for fluid interface
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
        $criteria = new Criteria(UserReviewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UserReviewTableMap::COL_ID)) {
            $criteria->add(UserReviewTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_GAME_ID)) {
            $criteria->add(UserReviewTableMap::COL_GAME_ID, $this->game_id);
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_PLATFORM_ID)) {
            $criteria->add(UserReviewTableMap::COL_PLATFORM_ID, $this->platform_id);
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_USER_ID)) {
            $criteria->add(UserReviewTableMap::COL_USER_ID, $this->user_id);
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_RIG_ID)) {
            $criteria->add(UserReviewTableMap::COL_RIG_ID, $this->rig_id);
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_RATING_ID)) {
            $criteria->add(UserReviewTableMap::COL_RATING_ID, $this->rating_id);
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_REVIEW)) {
            $criteria->add(UserReviewTableMap::COL_REVIEW, $this->review);
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_UPVOTES)) {
            $criteria->add(UserReviewTableMap::COL_UPVOTES, $this->upvotes);
        }
        if ($this->isColumnModified(UserReviewTableMap::COL_DOWNVOTES)) {
            $criteria->add(UserReviewTableMap::COL_DOWNVOTES, $this->downvotes);
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
        $criteria = ChildUserReviewQuery::create();
        $criteria->add(UserReviewTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \UserReview (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setGameId($this->getGameId());
        $copyObj->setPlatformId($this->getPlatformId());
        $copyObj->setUserId($this->getUserId());
        $copyObj->setRigId($this->getRigId());
        $copyObj->setRatingId($this->getRatingId());
        $copyObj->setReview($this->getReview());
        $copyObj->setUpvotes($this->getUpvotes());
        $copyObj->setDownvotes($this->getDownvotes());
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
     * @return \UserReview Clone of current object.
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
     * Declares an association between this object and a ChildGame object.
     *
     * @param  ChildGame $v
     * @return $this|\UserReview The current object (for fluent API support)
     * @throws PropelException
     */
    public function setGame(ChildGame $v = null)
    {
        if ($v === null) {
            $this->setGameId(NULL);
        } else {
            $this->setGameId($v->getId());
        }

        $this->aGame = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGame object, it will not be re-added.
        if ($v !== null) {
            $v->addUserReview($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGame object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildGame The associated ChildGame object.
     * @throws PropelException
     */
    public function getGame(ConnectionInterface $con = null)
    {
        if ($this->aGame === null && (($this->game_id !== "" && $this->game_id !== null))) {
            $this->aGame = ChildGameQuery::create()->findPk($this->game_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGame->addUserReviews($this);
             */
        }

        return $this->aGame;
    }

    /**
     * Declares an association between this object and a ChildPlatform object.
     *
     * @param  ChildPlatform $v
     * @return $this|\UserReview The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPlatform(ChildPlatform $v = null)
    {
        if ($v === null) {
            $this->setPlatformId(NULL);
        } else {
            $this->setPlatformId($v->getId());
        }

        $this->aPlatform = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPlatform object, it will not be re-added.
        if ($v !== null) {
            $v->addUserReview($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPlatform object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPlatform The associated ChildPlatform object.
     * @throws PropelException
     */
    public function getPlatform(ConnectionInterface $con = null)
    {
        if ($this->aPlatform === null && (($this->platform_id !== "" && $this->platform_id !== null))) {
            $this->aPlatform = ChildPlatformQuery::create()->findPk($this->platform_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPlatform->addUserReviews($this);
             */
        }

        return $this->aPlatform;
    }

    /**
     * Declares an association between this object and a ChildUser object.
     *
     * @param  ChildUser $v
     * @return $this|\UserReview The current object (for fluent API support)
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
            $v->addUserReview($this);
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
                $this->aUser->addUserReviews($this);
             */
        }

        return $this->aUser;
    }

    /**
     * Declares an association between this object and a ChildRating object.
     *
     * @param  ChildRating $v
     * @return $this|\UserReview The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRating(ChildRating $v = null)
    {
        if ($v === null) {
            $this->setRatingId(NULL);
        } else {
            $this->setRatingId($v->getId());
        }

        $this->aRating = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildRating object, it will not be re-added.
        if ($v !== null) {
            $v->addUserReview($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildRating object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildRating The associated ChildRating object.
     * @throws PropelException
     */
    public function getRating(ConnectionInterface $con = null)
    {
        if ($this->aRating === null && (($this->rating_id !== "" && $this->rating_id !== null))) {
            $this->aRating = ChildRatingQuery::create()->findPk($this->rating_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aRating->addUserReviews($this);
             */
        }

        return $this->aRating;
    }

    /**
     * Declares an association between this object and a ChildRig object.
     *
     * @param  ChildRig $v
     * @return $this|\UserReview The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRig(ChildRig $v = null)
    {
        if ($v === null) {
            $this->setRigId(NULL);
        } else {
            $this->setRigId($v->getId());
        }

        $this->aRig = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildRig object, it will not be re-added.
        if ($v !== null) {
            $v->addUserReview($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildRig object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildRig The associated ChildRig object.
     * @throws PropelException
     */
    public function getRig(ConnectionInterface $con = null)
    {
        if ($this->aRig === null && (($this->rig_id !== "" && $this->rig_id !== null))) {
            $this->aRig = ChildRigQuery::create()->findPk($this->rig_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aRig->addUserReviews($this);
             */
        }

        return $this->aRig;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aGame) {
            $this->aGame->removeUserReview($this);
        }
        if (null !== $this->aPlatform) {
            $this->aPlatform->removeUserReview($this);
        }
        if (null !== $this->aUser) {
            $this->aUser->removeUserReview($this);
        }
        if (null !== $this->aRating) {
            $this->aRating->removeUserReview($this);
        }
        if (null !== $this->aRig) {
            $this->aRig->removeUserReview($this);
        }
        $this->id = null;
        $this->game_id = null;
        $this->platform_id = null;
        $this->user_id = null;
        $this->rig_id = null;
        $this->rating_id = null;
        $this->review = null;
        $this->upvotes = null;
        $this->downvotes = null;
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
        } // if ($deep)

        $this->aGame = null;
        $this->aPlatform = null;
        $this->aUser = null;
        $this->aRating = null;
        $this->aRig = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserReviewTableMap::DEFAULT_STRING_FORMAT);
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
