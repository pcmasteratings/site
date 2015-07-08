<?php

namespace Base;

use \News as ChildNews;
use \NewsQuery as ChildNewsQuery;
use \RatingHeaders as ChildRatingHeaders;
use \RatingHeadersQuery as ChildRatingHeadersQuery;
use \Rigs as ChildRigs;
use \RigsQuery as ChildRigsQuery;
use \User as ChildUser;
use \UserAttributeValues as ChildUserAttributeValues;
use \UserAttributeValuesQuery as ChildUserAttributeValuesQuery;
use \UserQuery as ChildUserQuery;
use \UserReviews as ChildUserReviews;
use \UserReviewsQuery as ChildUserReviewsQuery;
use \UserWeights as ChildUserWeights;
use \UserWeightsQuery as ChildUserWeightsQuery;
use \Exception;
use \PDO;
use Map\UserTableMap;
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
 * Base class that represents a row from the 'user' table.
 *
 * 
 *
* @package    propel.generator..Base
*/
abstract class User implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\UserTableMap';


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
     * The value for the username field.
     * @var        string
     */
    protected $username;

    /**
     * The value for the password field.
     * @var        string
     */
    protected $password;

    /**
     * The value for the reddit_id field.
     * @var        string
     */
    protected $reddit_id;

    /**
     * The value for the trusted field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $trusted;

    /**
     * The value for the admin field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $admin;

    /**
     * The value for the banned field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $banned;

    /**
     * @var        ObjectCollection|ChildNews[] Collection to store aggregation of ChildNews objects.
     */
    protected $collNews;
    protected $collNewsPartial;

    /**
     * @var        ObjectCollection|ChildRatingHeaders[] Collection to store aggregation of ChildRatingHeaders objects.
     */
    protected $collRatingHeaderss;
    protected $collRatingHeaderssPartial;

    /**
     * @var        ObjectCollection|ChildRigs[] Collection to store aggregation of ChildRigs objects.
     */
    protected $collRigss;
    protected $collRigssPartial;

    /**
     * @var        ObjectCollection|ChildUserAttributeValues[] Collection to store aggregation of ChildUserAttributeValues objects.
     */
    protected $collUserAttributeValuess;
    protected $collUserAttributeValuessPartial;

    /**
     * @var        ObjectCollection|ChildUserReviews[] Collection to store aggregation of ChildUserReviews objects.
     */
    protected $collUserReviewss;
    protected $collUserReviewssPartial;

    /**
     * @var        ObjectCollection|ChildUserWeights[] Collection to store aggregation of ChildUserWeights objects.
     */
    protected $collUserWeightss;
    protected $collUserWeightssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildNews[]
     */
    protected $newsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRatingHeaders[]
     */
    protected $ratingHeaderssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRigs[]
     */
    protected $rigssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserAttributeValues[]
     */
    protected $userAttributeValuessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserReviews[]
     */
    protected $userReviewssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserWeights[]
     */
    protected $userWeightssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->trusted = false;
        $this->admin = false;
        $this->banned = false;
    }

    /**
     * Initializes internal state of Base\User object.
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
     * Compares this with another <code>User</code> instance.  If
     * <code>obj</code> is an instance of <code>User</code>, delegates to
     * <code>equals(User)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|User The current object, for fluid interface
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
     * Get the [username] column value.
     * 
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the [password] column value.
     * 
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [reddit_id] column value.
     * 
     * @return string
     */
    public function getRedditId()
    {
        return $this->reddit_id;
    }

    /**
     * Get the [trusted] column value.
     * 
     * @return boolean
     */
    public function getTrusted()
    {
        return $this->trusted;
    }

    /**
     * Get the [trusted] column value.
     * 
     * @return boolean
     */
    public function isTrusted()
    {
        return $this->getTrusted();
    }

    /**
     * Get the [admin] column value.
     * 
     * @return boolean
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Get the [admin] column value.
     * 
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->getAdmin();
    }

    /**
     * Get the [banned] column value.
     * 
     * @return boolean
     */
    public function getBanned()
    {
        return $this->banned;
    }

    /**
     * Get the [banned] column value.
     * 
     * @return boolean
     */
    public function isBanned()
    {
        return $this->getBanned();
    }

    /**
     * Set the value of [id] column.
     * 
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[UserTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [username] column.
     * 
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[UserTableMap::COL_USERNAME] = true;
        }

        return $this;
    } // setUsername()

    /**
     * Set the value of [password] column.
     * 
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[UserTableMap::COL_PASSWORD] = true;
        }

        return $this;
    } // setPassword()

    /**
     * Set the value of [reddit_id] column.
     * 
     * @param string $v new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setRedditId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->reddit_id !== $v) {
            $this->reddit_id = $v;
            $this->modifiedColumns[UserTableMap::COL_REDDIT_ID] = true;
        }

        return $this;
    } // setRedditId()

    /**
     * Sets the value of the [trusted] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * 
     * @param  boolean|integer|string $v The new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setTrusted($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->trusted !== $v) {
            $this->trusted = $v;
            $this->modifiedColumns[UserTableMap::COL_TRUSTED] = true;
        }

        return $this;
    } // setTrusted()

    /**
     * Sets the value of the [admin] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * 
     * @param  boolean|integer|string $v The new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setAdmin($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->admin !== $v) {
            $this->admin = $v;
            $this->modifiedColumns[UserTableMap::COL_ADMIN] = true;
        }

        return $this;
    } // setAdmin()

    /**
     * Sets the value of the [banned] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * 
     * @param  boolean|integer|string $v The new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setBanned($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->banned !== $v) {
            $this->banned = $v;
            $this->modifiedColumns[UserTableMap::COL_BANNED] = true;
        }

        return $this;
    } // setBanned()

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
            if ($this->trusted !== false) {
                return false;
            }

            if ($this->admin !== false) {
                return false;
            }

            if ($this->banned !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UserTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UserTableMap::translateFieldName('Username', TableMap::TYPE_PHPNAME, $indexType)];
            $this->username = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UserTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UserTableMap::translateFieldName('RedditId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reddit_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UserTableMap::translateFieldName('Trusted', TableMap::TYPE_PHPNAME, $indexType)];
            $this->trusted = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UserTableMap::translateFieldName('Admin', TableMap::TYPE_PHPNAME, $indexType)];
            $this->admin = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UserTableMap::translateFieldName('Banned', TableMap::TYPE_PHPNAME, $indexType)];
            $this->banned = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = UserTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\User'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(UserTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUserQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collNews = null;

            $this->collRatingHeaderss = null;

            $this->collRigss = null;

            $this->collUserAttributeValuess = null;

            $this->collUserReviewss = null;

            $this->collUserWeightss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see User::setDeleted()
     * @see User::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUserQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserTableMap::DATABASE_NAME);
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
                UserTableMap::addInstanceToPool($this);
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

            if ($this->newsScheduledForDeletion !== null) {
                if (!$this->newsScheduledForDeletion->isEmpty()) {
                    \NewsQuery::create()
                        ->filterByPrimaryKeys($this->newsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->newsScheduledForDeletion = null;
                }
            }

            if ($this->collNews !== null) {
                foreach ($this->collNews as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->ratingHeaderssScheduledForDeletion !== null) {
                if (!$this->ratingHeaderssScheduledForDeletion->isEmpty()) {
                    \RatingHeadersQuery::create()
                        ->filterByPrimaryKeys($this->ratingHeaderssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->ratingHeaderssScheduledForDeletion = null;
                }
            }

            if ($this->collRatingHeaderss !== null) {
                foreach ($this->collRatingHeaderss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->rigssScheduledForDeletion !== null) {
                if (!$this->rigssScheduledForDeletion->isEmpty()) {
                    \RigsQuery::create()
                        ->filterByPrimaryKeys($this->rigssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->rigssScheduledForDeletion = null;
                }
            }

            if ($this->collRigss !== null) {
                foreach ($this->collRigss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userAttributeValuessScheduledForDeletion !== null) {
                if (!$this->userAttributeValuessScheduledForDeletion->isEmpty()) {
                    \UserAttributeValuesQuery::create()
                        ->filterByPrimaryKeys($this->userAttributeValuessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userAttributeValuessScheduledForDeletion = null;
                }
            }

            if ($this->collUserAttributeValuess !== null) {
                foreach ($this->collUserAttributeValuess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userReviewssScheduledForDeletion !== null) {
                if (!$this->userReviewssScheduledForDeletion->isEmpty()) {
                    \UserReviewsQuery::create()
                        ->filterByPrimaryKeys($this->userReviewssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userReviewssScheduledForDeletion = null;
                }
            }

            if ($this->collUserReviewss !== null) {
                foreach ($this->collUserReviewss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userWeightssScheduledForDeletion !== null) {
                if (!$this->userWeightssScheduledForDeletion->isEmpty()) {
                    \UserWeightsQuery::create()
                        ->filterByPrimaryKeys($this->userWeightssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userWeightssScheduledForDeletion = null;
                }
            }

            if ($this->collUserWeightss !== null) {
                foreach ($this->collUserWeightss as $referrerFK) {
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

        $this->modifiedColumns[UserTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UserTableMap::COL_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = 'username';
        }
        if ($this->isColumnModified(UserTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(UserTableMap::COL_REDDIT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'reddit_id';
        }
        if ($this->isColumnModified(UserTableMap::COL_TRUSTED)) {
            $modifiedColumns[':p' . $index++]  = 'trusted';
        }
        if ($this->isColumnModified(UserTableMap::COL_ADMIN)) {
            $modifiedColumns[':p' . $index++]  = 'admin';
        }
        if ($this->isColumnModified(UserTableMap::COL_BANNED)) {
            $modifiedColumns[':p' . $index++]  = 'banned';
        }

        $sql = sprintf(
            'INSERT INTO user (%s) VALUES (%s)',
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
                    case 'username':                        
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case 'password':                        
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case 'reddit_id':                        
                        $stmt->bindValue($identifier, $this->reddit_id, PDO::PARAM_STR);
                        break;
                    case 'trusted':
                        $stmt->bindValue($identifier, (int) $this->trusted, PDO::PARAM_INT);
                        break;
                    case 'admin':
                        $stmt->bindValue($identifier, (int) $this->admin, PDO::PARAM_INT);
                        break;
                    case 'banned':
                        $stmt->bindValue($identifier, (int) $this->banned, PDO::PARAM_INT);
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
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getUsername();
                break;
            case 2:
                return $this->getPassword();
                break;
            case 3:
                return $this->getRedditId();
                break;
            case 4:
                return $this->getTrusted();
                break;
            case 5:
                return $this->getAdmin();
                break;
            case 6:
                return $this->getBanned();
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

        if (isset($alreadyDumpedObjects['User'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->hashCode()] = true;
        $keys = UserTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUsername(),
            $keys[2] => $this->getPassword(),
            $keys[3] => $this->getRedditId(),
            $keys[4] => $this->getTrusted(),
            $keys[5] => $this->getAdmin(),
            $keys[6] => $this->getBanned(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->collNews) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'news';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'news';
                        break;
                    default:
                        $key = 'News';
                }
        
                $result[$key] = $this->collNews->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRatingHeaderss) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ratingHeaderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'rating_headerss';
                        break;
                    default:
                        $key = 'RatingHeaderss';
                }
        
                $result[$key] = $this->collRatingHeaderss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRigss) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'rigss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'rigss';
                        break;
                    default:
                        $key = 'Rigss';
                }
        
                $result[$key] = $this->collRigss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserAttributeValuess) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userAttributeValuess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_attribute_valuess';
                        break;
                    default:
                        $key = 'UserAttributeValuess';
                }
        
                $result[$key] = $this->collUserAttributeValuess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserReviewss) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userReviewss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_reviewss';
                        break;
                    default:
                        $key = 'UserReviewss';
                }
        
                $result[$key] = $this->collUserReviewss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserWeightss) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userWeightss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_weightss';
                        break;
                    default:
                        $key = 'UserWeightss';
                }
        
                $result[$key] = $this->collUserWeightss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\User
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\User
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUsername($value);
                break;
            case 2:
                $this->setPassword($value);
                break;
            case 3:
                $this->setRedditId($value);
                break;
            case 4:
                $this->setTrusted($value);
                break;
            case 5:
                $this->setAdmin($value);
                break;
            case 6:
                $this->setBanned($value);
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
        $keys = UserTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setUsername($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPassword($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setRedditId($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTrusted($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAdmin($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setBanned($arr[$keys[6]]);
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
     * @return $this|\User The current object, for fluid interface
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
        $criteria = new Criteria(UserTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UserTableMap::COL_ID)) {
            $criteria->add(UserTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UserTableMap::COL_USERNAME)) {
            $criteria->add(UserTableMap::COL_USERNAME, $this->username);
        }
        if ($this->isColumnModified(UserTableMap::COL_PASSWORD)) {
            $criteria->add(UserTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(UserTableMap::COL_REDDIT_ID)) {
            $criteria->add(UserTableMap::COL_REDDIT_ID, $this->reddit_id);
        }
        if ($this->isColumnModified(UserTableMap::COL_TRUSTED)) {
            $criteria->add(UserTableMap::COL_TRUSTED, $this->trusted);
        }
        if ($this->isColumnModified(UserTableMap::COL_ADMIN)) {
            $criteria->add(UserTableMap::COL_ADMIN, $this->admin);
        }
        if ($this->isColumnModified(UserTableMap::COL_BANNED)) {
            $criteria->add(UserTableMap::COL_BANNED, $this->banned);
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
        $criteria = ChildUserQuery::create();
        $criteria->add(UserTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \User (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUsername($this->getUsername());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setRedditId($this->getRedditId());
        $copyObj->setTrusted($this->getTrusted());
        $copyObj->setAdmin($this->getAdmin());
        $copyObj->setBanned($this->getBanned());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getNews() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNews($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRatingHeaderss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRatingHeaders($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRigss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRigs($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserAttributeValuess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserAttributeValues($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserReviewss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserReviews($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserWeightss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserWeights($relObj->copy($deepCopy));
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
     * @return \User Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('News' == $relationName) {
            return $this->initNews();
        }
        if ('RatingHeaders' == $relationName) {
            return $this->initRatingHeaderss();
        }
        if ('Rigs' == $relationName) {
            return $this->initRigss();
        }
        if ('UserAttributeValues' == $relationName) {
            return $this->initUserAttributeValuess();
        }
        if ('UserReviews' == $relationName) {
            return $this->initUserReviewss();
        }
        if ('UserWeights' == $relationName) {
            return $this->initUserWeightss();
        }
    }

    /**
     * Clears out the collNews collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addNews()
     */
    public function clearNews()
    {
        $this->collNews = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collNews collection loaded partially.
     */
    public function resetPartialNews($v = true)
    {
        $this->collNewsPartial = $v;
    }

    /**
     * Initializes the collNews collection.
     *
     * By default this just sets the collNews collection to an empty array (like clearcollNews());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNews($overrideExisting = true)
    {
        if (null !== $this->collNews && !$overrideExisting) {
            return;
        }
        $this->collNews = new ObjectCollection();
        $this->collNews->setModel('\News');
    }

    /**
     * Gets an array of ChildNews objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildNews[] List of ChildNews objects
     * @throws PropelException
     */
    public function getNews(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collNewsPartial && !$this->isNew();
        if (null === $this->collNews || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNews) {
                // return empty collection
                $this->initNews();
            } else {
                $collNews = ChildNewsQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collNewsPartial && count($collNews)) {
                        $this->initNews(false);

                        foreach ($collNews as $obj) {
                            if (false == $this->collNews->contains($obj)) {
                                $this->collNews->append($obj);
                            }
                        }

                        $this->collNewsPartial = true;
                    }

                    return $collNews;
                }

                if ($partial && $this->collNews) {
                    foreach ($this->collNews as $obj) {
                        if ($obj->isNew()) {
                            $collNews[] = $obj;
                        }
                    }
                }

                $this->collNews = $collNews;
                $this->collNewsPartial = false;
            }
        }

        return $this->collNews;
    }

    /**
     * Sets a collection of ChildNews objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $news A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setNews(Collection $news, ConnectionInterface $con = null)
    {
        /** @var ChildNews[] $newsToDelete */
        $newsToDelete = $this->getNews(new Criteria(), $con)->diff($news);

        
        $this->newsScheduledForDeletion = $newsToDelete;

        foreach ($newsToDelete as $newsRemoved) {
            $newsRemoved->setUser(null);
        }

        $this->collNews = null;
        foreach ($news as $news) {
            $this->addNews($news);
        }

        $this->collNews = $news;
        $this->collNewsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related News objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related News objects.
     * @throws PropelException
     */
    public function countNews(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collNewsPartial && !$this->isNew();
        if (null === $this->collNews || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNews) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNews());
            }

            $query = ChildNewsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collNews);
    }

    /**
     * Method called to associate a ChildNews object to this object
     * through the ChildNews foreign key attribute.
     *
     * @param  ChildNews $l ChildNews
     * @return $this|\User The current object (for fluent API support)
     */
    public function addNews(ChildNews $l)
    {
        if ($this->collNews === null) {
            $this->initNews();
            $this->collNewsPartial = true;
        }

        if (!$this->collNews->contains($l)) {
            $this->doAddNews($l);
        }

        return $this;
    }

    /**
     * @param ChildNews $news The ChildNews object to add.
     */
    protected function doAddNews(ChildNews $news)
    {
        $this->collNews[]= $news;
        $news->setUser($this);
    }

    /**
     * @param  ChildNews $news The ChildNews object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeNews(ChildNews $news)
    {
        if ($this->getNews()->contains($news)) {
            $pos = $this->collNews->search($news);
            $this->collNews->remove($pos);
            if (null === $this->newsScheduledForDeletion) {
                $this->newsScheduledForDeletion = clone $this->collNews;
                $this->newsScheduledForDeletion->clear();
            }
            $this->newsScheduledForDeletion[]= clone $news;
            $news->setUser(null);
        }

        return $this;
    }

    /**
     * Clears out the collRatingHeaderss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRatingHeaderss()
     */
    public function clearRatingHeaderss()
    {
        $this->collRatingHeaderss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collRatingHeaderss collection loaded partially.
     */
    public function resetPartialRatingHeaderss($v = true)
    {
        $this->collRatingHeaderssPartial = $v;
    }

    /**
     * Initializes the collRatingHeaderss collection.
     *
     * By default this just sets the collRatingHeaderss collection to an empty array (like clearcollRatingHeaderss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRatingHeaderss($overrideExisting = true)
    {
        if (null !== $this->collRatingHeaderss && !$overrideExisting) {
            return;
        }
        $this->collRatingHeaderss = new ObjectCollection();
        $this->collRatingHeaderss->setModel('\RatingHeaders');
    }

    /**
     * Gets an array of ChildRatingHeaders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRatingHeaders[] List of ChildRatingHeaders objects
     * @throws PropelException
     */
    public function getRatingHeaderss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRatingHeaderssPartial && !$this->isNew();
        if (null === $this->collRatingHeaderss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRatingHeaderss) {
                // return empty collection
                $this->initRatingHeaderss();
            } else {
                $collRatingHeaderss = ChildRatingHeadersQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRatingHeaderssPartial && count($collRatingHeaderss)) {
                        $this->initRatingHeaderss(false);

                        foreach ($collRatingHeaderss as $obj) {
                            if (false == $this->collRatingHeaderss->contains($obj)) {
                                $this->collRatingHeaderss->append($obj);
                            }
                        }

                        $this->collRatingHeaderssPartial = true;
                    }

                    return $collRatingHeaderss;
                }

                if ($partial && $this->collRatingHeaderss) {
                    foreach ($this->collRatingHeaderss as $obj) {
                        if ($obj->isNew()) {
                            $collRatingHeaderss[] = $obj;
                        }
                    }
                }

                $this->collRatingHeaderss = $collRatingHeaderss;
                $this->collRatingHeaderssPartial = false;
            }
        }

        return $this->collRatingHeaderss;
    }

    /**
     * Sets a collection of ChildRatingHeaders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $ratingHeaderss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setRatingHeaderss(Collection $ratingHeaderss, ConnectionInterface $con = null)
    {
        /** @var ChildRatingHeaders[] $ratingHeaderssToDelete */
        $ratingHeaderssToDelete = $this->getRatingHeaderss(new Criteria(), $con)->diff($ratingHeaderss);

        
        $this->ratingHeaderssScheduledForDeletion = $ratingHeaderssToDelete;

        foreach ($ratingHeaderssToDelete as $ratingHeadersRemoved) {
            $ratingHeadersRemoved->setUser(null);
        }

        $this->collRatingHeaderss = null;
        foreach ($ratingHeaderss as $ratingHeaders) {
            $this->addRatingHeaders($ratingHeaders);
        }

        $this->collRatingHeaderss = $ratingHeaderss;
        $this->collRatingHeaderssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related RatingHeaders objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related RatingHeaders objects.
     * @throws PropelException
     */
    public function countRatingHeaderss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRatingHeaderssPartial && !$this->isNew();
        if (null === $this->collRatingHeaderss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRatingHeaderss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRatingHeaderss());
            }

            $query = ChildRatingHeadersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collRatingHeaderss);
    }

    /**
     * Method called to associate a ChildRatingHeaders object to this object
     * through the ChildRatingHeaders foreign key attribute.
     *
     * @param  ChildRatingHeaders $l ChildRatingHeaders
     * @return $this|\User The current object (for fluent API support)
     */
    public function addRatingHeaders(ChildRatingHeaders $l)
    {
        if ($this->collRatingHeaderss === null) {
            $this->initRatingHeaderss();
            $this->collRatingHeaderssPartial = true;
        }

        if (!$this->collRatingHeaderss->contains($l)) {
            $this->doAddRatingHeaders($l);
        }

        return $this;
    }

    /**
     * @param ChildRatingHeaders $ratingHeaders The ChildRatingHeaders object to add.
     */
    protected function doAddRatingHeaders(ChildRatingHeaders $ratingHeaders)
    {
        $this->collRatingHeaderss[]= $ratingHeaders;
        $ratingHeaders->setUser($this);
    }

    /**
     * @param  ChildRatingHeaders $ratingHeaders The ChildRatingHeaders object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeRatingHeaders(ChildRatingHeaders $ratingHeaders)
    {
        if ($this->getRatingHeaderss()->contains($ratingHeaders)) {
            $pos = $this->collRatingHeaderss->search($ratingHeaders);
            $this->collRatingHeaderss->remove($pos);
            if (null === $this->ratingHeaderssScheduledForDeletion) {
                $this->ratingHeaderssScheduledForDeletion = clone $this->collRatingHeaderss;
                $this->ratingHeaderssScheduledForDeletion->clear();
            }
            $this->ratingHeaderssScheduledForDeletion[]= clone $ratingHeaders;
            $ratingHeaders->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related RatingHeaderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRatingHeaders[] List of ChildRatingHeaders objects
     */
    public function getRatingHeaderssJoinGames(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRatingHeadersQuery::create(null, $criteria);
        $query->joinWith('Games', $joinBehavior);

        return $this->getRatingHeaderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related RatingHeaderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRatingHeaders[] List of ChildRatingHeaders objects
     */
    public function getRatingHeaderssJoinRigs(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRatingHeadersQuery::create(null, $criteria);
        $query->joinWith('Rigs', $joinBehavior);

        return $this->getRatingHeaderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related RatingHeaderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRatingHeaders[] List of ChildRatingHeaders objects
     */
    public function getRatingHeaderssJoinPlatforms(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRatingHeadersQuery::create(null, $criteria);
        $query->joinWith('Platforms', $joinBehavior);

        return $this->getRatingHeaderss($query, $con);
    }

    /**
     * Clears out the collRigss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRigss()
     */
    public function clearRigss()
    {
        $this->collRigss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collRigss collection loaded partially.
     */
    public function resetPartialRigss($v = true)
    {
        $this->collRigssPartial = $v;
    }

    /**
     * Initializes the collRigss collection.
     *
     * By default this just sets the collRigss collection to an empty array (like clearcollRigss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRigss($overrideExisting = true)
    {
        if (null !== $this->collRigss && !$overrideExisting) {
            return;
        }
        $this->collRigss = new ObjectCollection();
        $this->collRigss->setModel('\Rigs');
    }

    /**
     * Gets an array of ChildRigs objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRigs[] List of ChildRigs objects
     * @throws PropelException
     */
    public function getRigss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRigssPartial && !$this->isNew();
        if (null === $this->collRigss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRigss) {
                // return empty collection
                $this->initRigss();
            } else {
                $collRigss = ChildRigsQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRigssPartial && count($collRigss)) {
                        $this->initRigss(false);

                        foreach ($collRigss as $obj) {
                            if (false == $this->collRigss->contains($obj)) {
                                $this->collRigss->append($obj);
                            }
                        }

                        $this->collRigssPartial = true;
                    }

                    return $collRigss;
                }

                if ($partial && $this->collRigss) {
                    foreach ($this->collRigss as $obj) {
                        if ($obj->isNew()) {
                            $collRigss[] = $obj;
                        }
                    }
                }

                $this->collRigss = $collRigss;
                $this->collRigssPartial = false;
            }
        }

        return $this->collRigss;
    }

    /**
     * Sets a collection of ChildRigs objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $rigss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setRigss(Collection $rigss, ConnectionInterface $con = null)
    {
        /** @var ChildRigs[] $rigssToDelete */
        $rigssToDelete = $this->getRigss(new Criteria(), $con)->diff($rigss);

        
        $this->rigssScheduledForDeletion = $rigssToDelete;

        foreach ($rigssToDelete as $rigsRemoved) {
            $rigsRemoved->setUser(null);
        }

        $this->collRigss = null;
        foreach ($rigss as $rigs) {
            $this->addRigs($rigs);
        }

        $this->collRigss = $rigss;
        $this->collRigssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Rigs objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Rigs objects.
     * @throws PropelException
     */
    public function countRigss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRigssPartial && !$this->isNew();
        if (null === $this->collRigss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRigss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRigss());
            }

            $query = ChildRigsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collRigss);
    }

    /**
     * Method called to associate a ChildRigs object to this object
     * through the ChildRigs foreign key attribute.
     *
     * @param  ChildRigs $l ChildRigs
     * @return $this|\User The current object (for fluent API support)
     */
    public function addRigs(ChildRigs $l)
    {
        if ($this->collRigss === null) {
            $this->initRigss();
            $this->collRigssPartial = true;
        }

        if (!$this->collRigss->contains($l)) {
            $this->doAddRigs($l);
        }

        return $this;
    }

    /**
     * @param ChildRigs $rigs The ChildRigs object to add.
     */
    protected function doAddRigs(ChildRigs $rigs)
    {
        $this->collRigss[]= $rigs;
        $rigs->setUser($this);
    }

    /**
     * @param  ChildRigs $rigs The ChildRigs object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeRigs(ChildRigs $rigs)
    {
        if ($this->getRigss()->contains($rigs)) {
            $pos = $this->collRigss->search($rigs);
            $this->collRigss->remove($pos);
            if (null === $this->rigssScheduledForDeletion) {
                $this->rigssScheduledForDeletion = clone $this->collRigss;
                $this->rigssScheduledForDeletion->clear();
            }
            $this->rigssScheduledForDeletion[]= clone $rigs;
            $rigs->setUser(null);
        }

        return $this;
    }

    /**
     * Clears out the collUserAttributeValuess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserAttributeValuess()
     */
    public function clearUserAttributeValuess()
    {
        $this->collUserAttributeValuess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserAttributeValuess collection loaded partially.
     */
    public function resetPartialUserAttributeValuess($v = true)
    {
        $this->collUserAttributeValuessPartial = $v;
    }

    /**
     * Initializes the collUserAttributeValuess collection.
     *
     * By default this just sets the collUserAttributeValuess collection to an empty array (like clearcollUserAttributeValuess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserAttributeValuess($overrideExisting = true)
    {
        if (null !== $this->collUserAttributeValuess && !$overrideExisting) {
            return;
        }
        $this->collUserAttributeValuess = new ObjectCollection();
        $this->collUserAttributeValuess->setModel('\UserAttributeValues');
    }

    /**
     * Gets an array of ChildUserAttributeValues objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserAttributeValues[] List of ChildUserAttributeValues objects
     * @throws PropelException
     */
    public function getUserAttributeValuess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserAttributeValuessPartial && !$this->isNew();
        if (null === $this->collUserAttributeValuess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserAttributeValuess) {
                // return empty collection
                $this->initUserAttributeValuess();
            } else {
                $collUserAttributeValuess = ChildUserAttributeValuesQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserAttributeValuessPartial && count($collUserAttributeValuess)) {
                        $this->initUserAttributeValuess(false);

                        foreach ($collUserAttributeValuess as $obj) {
                            if (false == $this->collUserAttributeValuess->contains($obj)) {
                                $this->collUserAttributeValuess->append($obj);
                            }
                        }

                        $this->collUserAttributeValuessPartial = true;
                    }

                    return $collUserAttributeValuess;
                }

                if ($partial && $this->collUserAttributeValuess) {
                    foreach ($this->collUserAttributeValuess as $obj) {
                        if ($obj->isNew()) {
                            $collUserAttributeValuess[] = $obj;
                        }
                    }
                }

                $this->collUserAttributeValuess = $collUserAttributeValuess;
                $this->collUserAttributeValuessPartial = false;
            }
        }

        return $this->collUserAttributeValuess;
    }

    /**
     * Sets a collection of ChildUserAttributeValues objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userAttributeValuess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setUserAttributeValuess(Collection $userAttributeValuess, ConnectionInterface $con = null)
    {
        /** @var ChildUserAttributeValues[] $userAttributeValuessToDelete */
        $userAttributeValuessToDelete = $this->getUserAttributeValuess(new Criteria(), $con)->diff($userAttributeValuess);

        
        $this->userAttributeValuessScheduledForDeletion = $userAttributeValuessToDelete;

        foreach ($userAttributeValuessToDelete as $userAttributeValuesRemoved) {
            $userAttributeValuesRemoved->setUser(null);
        }

        $this->collUserAttributeValuess = null;
        foreach ($userAttributeValuess as $userAttributeValues) {
            $this->addUserAttributeValues($userAttributeValues);
        }

        $this->collUserAttributeValuess = $userAttributeValuess;
        $this->collUserAttributeValuessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserAttributeValues objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related UserAttributeValues objects.
     * @throws PropelException
     */
    public function countUserAttributeValuess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserAttributeValuessPartial && !$this->isNew();
        if (null === $this->collUserAttributeValuess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserAttributeValuess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserAttributeValuess());
            }

            $query = ChildUserAttributeValuesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collUserAttributeValuess);
    }

    /**
     * Method called to associate a ChildUserAttributeValues object to this object
     * through the ChildUserAttributeValues foreign key attribute.
     *
     * @param  ChildUserAttributeValues $l ChildUserAttributeValues
     * @return $this|\User The current object (for fluent API support)
     */
    public function addUserAttributeValues(ChildUserAttributeValues $l)
    {
        if ($this->collUserAttributeValuess === null) {
            $this->initUserAttributeValuess();
            $this->collUserAttributeValuessPartial = true;
        }

        if (!$this->collUserAttributeValuess->contains($l)) {
            $this->doAddUserAttributeValues($l);
        }

        return $this;
    }

    /**
     * @param ChildUserAttributeValues $userAttributeValues The ChildUserAttributeValues object to add.
     */
    protected function doAddUserAttributeValues(ChildUserAttributeValues $userAttributeValues)
    {
        $this->collUserAttributeValuess[]= $userAttributeValues;
        $userAttributeValues->setUser($this);
    }

    /**
     * @param  ChildUserAttributeValues $userAttributeValues The ChildUserAttributeValues object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeUserAttributeValues(ChildUserAttributeValues $userAttributeValues)
    {
        if ($this->getUserAttributeValuess()->contains($userAttributeValues)) {
            $pos = $this->collUserAttributeValuess->search($userAttributeValues);
            $this->collUserAttributeValuess->remove($pos);
            if (null === $this->userAttributeValuessScheduledForDeletion) {
                $this->userAttributeValuessScheduledForDeletion = clone $this->collUserAttributeValuess;
                $this->userAttributeValuessScheduledForDeletion->clear();
            }
            $this->userAttributeValuessScheduledForDeletion[]= clone $userAttributeValues;
            $userAttributeValues->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserAttributeValuess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserAttributeValues[] List of ChildUserAttributeValues objects
     */
    public function getUserAttributeValuessJoinUserAttributes(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserAttributeValuesQuery::create(null, $criteria);
        $query->joinWith('UserAttributes', $joinBehavior);

        return $this->getUserAttributeValuess($query, $con);
    }

    /**
     * Clears out the collUserReviewss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserReviewss()
     */
    public function clearUserReviewss()
    {
        $this->collUserReviewss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserReviewss collection loaded partially.
     */
    public function resetPartialUserReviewss($v = true)
    {
        $this->collUserReviewssPartial = $v;
    }

    /**
     * Initializes the collUserReviewss collection.
     *
     * By default this just sets the collUserReviewss collection to an empty array (like clearcollUserReviewss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserReviewss($overrideExisting = true)
    {
        if (null !== $this->collUserReviewss && !$overrideExisting) {
            return;
        }
        $this->collUserReviewss = new ObjectCollection();
        $this->collUserReviewss->setModel('\UserReviews');
    }

    /**
     * Gets an array of ChildUserReviews objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserReviews[] List of ChildUserReviews objects
     * @throws PropelException
     */
    public function getUserReviewss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserReviewssPartial && !$this->isNew();
        if (null === $this->collUserReviewss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserReviewss) {
                // return empty collection
                $this->initUserReviewss();
            } else {
                $collUserReviewss = ChildUserReviewsQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserReviewssPartial && count($collUserReviewss)) {
                        $this->initUserReviewss(false);

                        foreach ($collUserReviewss as $obj) {
                            if (false == $this->collUserReviewss->contains($obj)) {
                                $this->collUserReviewss->append($obj);
                            }
                        }

                        $this->collUserReviewssPartial = true;
                    }

                    return $collUserReviewss;
                }

                if ($partial && $this->collUserReviewss) {
                    foreach ($this->collUserReviewss as $obj) {
                        if ($obj->isNew()) {
                            $collUserReviewss[] = $obj;
                        }
                    }
                }

                $this->collUserReviewss = $collUserReviewss;
                $this->collUserReviewssPartial = false;
            }
        }

        return $this->collUserReviewss;
    }

    /**
     * Sets a collection of ChildUserReviews objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userReviewss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setUserReviewss(Collection $userReviewss, ConnectionInterface $con = null)
    {
        /** @var ChildUserReviews[] $userReviewssToDelete */
        $userReviewssToDelete = $this->getUserReviewss(new Criteria(), $con)->diff($userReviewss);

        
        $this->userReviewssScheduledForDeletion = $userReviewssToDelete;

        foreach ($userReviewssToDelete as $userReviewsRemoved) {
            $userReviewsRemoved->setUser(null);
        }

        $this->collUserReviewss = null;
        foreach ($userReviewss as $userReviews) {
            $this->addUserReviews($userReviews);
        }

        $this->collUserReviewss = $userReviewss;
        $this->collUserReviewssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserReviews objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related UserReviews objects.
     * @throws PropelException
     */
    public function countUserReviewss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserReviewssPartial && !$this->isNew();
        if (null === $this->collUserReviewss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserReviewss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserReviewss());
            }

            $query = ChildUserReviewsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collUserReviewss);
    }

    /**
     * Method called to associate a ChildUserReviews object to this object
     * through the ChildUserReviews foreign key attribute.
     *
     * @param  ChildUserReviews $l ChildUserReviews
     * @return $this|\User The current object (for fluent API support)
     */
    public function addUserReviews(ChildUserReviews $l)
    {
        if ($this->collUserReviewss === null) {
            $this->initUserReviewss();
            $this->collUserReviewssPartial = true;
        }

        if (!$this->collUserReviewss->contains($l)) {
            $this->doAddUserReviews($l);
        }

        return $this;
    }

    /**
     * @param ChildUserReviews $userReviews The ChildUserReviews object to add.
     */
    protected function doAddUserReviews(ChildUserReviews $userReviews)
    {
        $this->collUserReviewss[]= $userReviews;
        $userReviews->setUser($this);
    }

    /**
     * @param  ChildUserReviews $userReviews The ChildUserReviews object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeUserReviews(ChildUserReviews $userReviews)
    {
        if ($this->getUserReviewss()->contains($userReviews)) {
            $pos = $this->collUserReviewss->search($userReviews);
            $this->collUserReviewss->remove($pos);
            if (null === $this->userReviewssScheduledForDeletion) {
                $this->userReviewssScheduledForDeletion = clone $this->collUserReviewss;
                $this->userReviewssScheduledForDeletion->clear();
            }
            $this->userReviewssScheduledForDeletion[]= clone $userReviews;
            $userReviews->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserReviewss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserReviews[] List of ChildUserReviews objects
     */
    public function getUserReviewssJoinGames(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserReviewsQuery::create(null, $criteria);
        $query->joinWith('Games', $joinBehavior);

        return $this->getUserReviewss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserReviewss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserReviews[] List of ChildUserReviews objects
     */
    public function getUserReviewssJoinPlatforms(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserReviewsQuery::create(null, $criteria);
        $query->joinWith('Platforms', $joinBehavior);

        return $this->getUserReviewss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserReviewss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserReviews[] List of ChildUserReviews objects
     */
    public function getUserReviewssJoinRatings(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserReviewsQuery::create(null, $criteria);
        $query->joinWith('Ratings', $joinBehavior);

        return $this->getUserReviewss($query, $con);
    }

    /**
     * Clears out the collUserWeightss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserWeightss()
     */
    public function clearUserWeightss()
    {
        $this->collUserWeightss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserWeightss collection loaded partially.
     */
    public function resetPartialUserWeightss($v = true)
    {
        $this->collUserWeightssPartial = $v;
    }

    /**
     * Initializes the collUserWeightss collection.
     *
     * By default this just sets the collUserWeightss collection to an empty array (like clearcollUserWeightss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserWeightss($overrideExisting = true)
    {
        if (null !== $this->collUserWeightss && !$overrideExisting) {
            return;
        }
        $this->collUserWeightss = new ObjectCollection();
        $this->collUserWeightss->setModel('\UserWeights');
    }

    /**
     * Gets an array of ChildUserWeights objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserWeights[] List of ChildUserWeights objects
     * @throws PropelException
     */
    public function getUserWeightss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserWeightssPartial && !$this->isNew();
        if (null === $this->collUserWeightss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserWeightss) {
                // return empty collection
                $this->initUserWeightss();
            } else {
                $collUserWeightss = ChildUserWeightsQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserWeightssPartial && count($collUserWeightss)) {
                        $this->initUserWeightss(false);

                        foreach ($collUserWeightss as $obj) {
                            if (false == $this->collUserWeightss->contains($obj)) {
                                $this->collUserWeightss->append($obj);
                            }
                        }

                        $this->collUserWeightssPartial = true;
                    }

                    return $collUserWeightss;
                }

                if ($partial && $this->collUserWeightss) {
                    foreach ($this->collUserWeightss as $obj) {
                        if ($obj->isNew()) {
                            $collUserWeightss[] = $obj;
                        }
                    }
                }

                $this->collUserWeightss = $collUserWeightss;
                $this->collUserWeightssPartial = false;
            }
        }

        return $this->collUserWeightss;
    }

    /**
     * Sets a collection of ChildUserWeights objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userWeightss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setUserWeightss(Collection $userWeightss, ConnectionInterface $con = null)
    {
        /** @var ChildUserWeights[] $userWeightssToDelete */
        $userWeightssToDelete = $this->getUserWeightss(new Criteria(), $con)->diff($userWeightss);

        
        $this->userWeightssScheduledForDeletion = $userWeightssToDelete;

        foreach ($userWeightssToDelete as $userWeightsRemoved) {
            $userWeightsRemoved->setUser(null);
        }

        $this->collUserWeightss = null;
        foreach ($userWeightss as $userWeights) {
            $this->addUserWeights($userWeights);
        }

        $this->collUserWeightss = $userWeightss;
        $this->collUserWeightssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserWeights objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related UserWeights objects.
     * @throws PropelException
     */
    public function countUserWeightss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserWeightssPartial && !$this->isNew();
        if (null === $this->collUserWeightss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserWeightss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserWeightss());
            }

            $query = ChildUserWeightsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collUserWeightss);
    }

    /**
     * Method called to associate a ChildUserWeights object to this object
     * through the ChildUserWeights foreign key attribute.
     *
     * @param  ChildUserWeights $l ChildUserWeights
     * @return $this|\User The current object (for fluent API support)
     */
    public function addUserWeights(ChildUserWeights $l)
    {
        if ($this->collUserWeightss === null) {
            $this->initUserWeightss();
            $this->collUserWeightssPartial = true;
        }

        if (!$this->collUserWeightss->contains($l)) {
            $this->doAddUserWeights($l);
        }

        return $this;
    }

    /**
     * @param ChildUserWeights $userWeights The ChildUserWeights object to add.
     */
    protected function doAddUserWeights(ChildUserWeights $userWeights)
    {
        $this->collUserWeightss[]= $userWeights;
        $userWeights->setUser($this);
    }

    /**
     * @param  ChildUserWeights $userWeights The ChildUserWeights object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeUserWeights(ChildUserWeights $userWeights)
    {
        if ($this->getUserWeightss()->contains($userWeights)) {
            $pos = $this->collUserWeightss->search($userWeights);
            $this->collUserWeightss->remove($pos);
            if (null === $this->userWeightssScheduledForDeletion) {
                $this->userWeightssScheduledForDeletion = clone $this->collUserWeightss;
                $this->userWeightssScheduledForDeletion->clear();
            }
            $this->userWeightssScheduledForDeletion[]= clone $userWeights;
            $userWeights->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserWeightss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserWeights[] List of ChildUserWeights objects
     */
    public function getUserWeightssJoinRatingCategories(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserWeightsQuery::create(null, $criteria);
        $query->joinWith('RatingCategories', $joinBehavior);

        return $this->getUserWeightss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->username = null;
        $this->password = null;
        $this->reddit_id = null;
        $this->trusted = null;
        $this->admin = null;
        $this->banned = null;
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
            if ($this->collNews) {
                foreach ($this->collNews as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRatingHeaderss) {
                foreach ($this->collRatingHeaderss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRigss) {
                foreach ($this->collRigss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserAttributeValuess) {
                foreach ($this->collUserAttributeValuess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserReviewss) {
                foreach ($this->collUserReviewss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserWeightss) {
                foreach ($this->collUserWeightss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collNews = null;
        $this->collRatingHeaderss = null;
        $this->collRigss = null;
        $this->collUserAttributeValuess = null;
        $this->collUserReviewss = null;
        $this->collUserWeightss = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserTableMap::DEFAULT_STRING_FORMAT);
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
