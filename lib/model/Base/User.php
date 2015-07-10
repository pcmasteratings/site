<?php

namespace Base;

use \News as ChildNews;
use \NewsQuery as ChildNewsQuery;
use \RatingHeader as ChildRatingHeader;
use \RatingHeaderQuery as ChildRatingHeaderQuery;
use \Rig as ChildRig;
use \RigQuery as ChildRigQuery;
use \User as ChildUser;
use \UserAttributeValue as ChildUserAttributeValue;
use \UserAttributeValueQuery as ChildUserAttributeValueQuery;
use \UserQuery as ChildUserQuery;
use \UserReview as ChildUserReview;
use \UserReviewQuery as ChildUserReviewQuery;
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
     * The value for the mod field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $mod;

    /**
     * The value for the probation field.
     * @var        boolean
     */
    protected $probation;

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
     * @var        ObjectCollection|ChildRatingHeader[] Collection to store aggregation of ChildRatingHeader objects.
     */
    protected $collRatingHeaders;
    protected $collRatingHeadersPartial;

    /**
     * @var        ObjectCollection|ChildRig[] Collection to store aggregation of ChildRig objects.
     */
    protected $collRigs;
    protected $collRigsPartial;

    /**
     * @var        ObjectCollection|ChildUserAttributeValue[] Collection to store aggregation of ChildUserAttributeValue objects.
     */
    protected $collUserAttributeValues;
    protected $collUserAttributeValuesPartial;

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
     * @var ObjectCollection|ChildNews[]
     */
    protected $newsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRatingHeader[]
     */
    protected $ratingHeadersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRig[]
     */
    protected $rigsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserAttributeValue[]
     */
    protected $userAttributeValuesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserReview[]
     */
    protected $userReviewsScheduledForDeletion = null;

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
        $this->mod = false;
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
     * Get the [mod] column value.
     * 
     * @return boolean
     */
    public function getMod()
    {
        return $this->mod;
    }

    /**
     * Get the [mod] column value.
     * 
     * @return boolean
     */
    public function isMod()
    {
        return $this->getMod();
    }

    /**
     * Get the [probation] column value.
     * 
     * @return boolean
     */
    public function getProbation()
    {
        return $this->probation;
    }

    /**
     * Get the [probation] column value.
     * 
     * @return boolean
     */
    public function isProbation()
    {
        return $this->getProbation();
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
     * Sets the value of the [mod] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * 
     * @param  boolean|integer|string $v The new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setMod($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->mod !== $v) {
            $this->mod = $v;
            $this->modifiedColumns[UserTableMap::COL_MOD] = true;
        }

        return $this;
    } // setMod()

    /**
     * Sets the value of the [probation] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * 
     * @param  boolean|integer|string $v The new value
     * @return $this|\User The current object (for fluent API support)
     */
    public function setProbation($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->probation !== $v) {
            $this->probation = $v;
            $this->modifiedColumns[UserTableMap::COL_PROBATION] = true;
        }

        return $this;
    } // setProbation()

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

            if ($this->mod !== false) {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UserTableMap::translateFieldName('Mod', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mod = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UserTableMap::translateFieldName('Probation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->probation = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UserTableMap::translateFieldName('Banned', TableMap::TYPE_PHPNAME, $indexType)];
            $this->banned = (null !== $col) ? (boolean) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = UserTableMap::NUM_HYDRATE_COLUMNS.

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

            $this->collRatingHeaders = null;

            $this->collRigs = null;

            $this->collUserAttributeValues = null;

            $this->collUserReviews = null;

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

            if ($this->rigsScheduledForDeletion !== null) {
                if (!$this->rigsScheduledForDeletion->isEmpty()) {
                    \RigQuery::create()
                        ->filterByPrimaryKeys($this->rigsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->rigsScheduledForDeletion = null;
                }
            }

            if ($this->collRigs !== null) {
                foreach ($this->collRigs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userAttributeValuesScheduledForDeletion !== null) {
                if (!$this->userAttributeValuesScheduledForDeletion->isEmpty()) {
                    \UserAttributeValueQuery::create()
                        ->filterByPrimaryKeys($this->userAttributeValuesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userAttributeValuesScheduledForDeletion = null;
                }
            }

            if ($this->collUserAttributeValues !== null) {
                foreach ($this->collUserAttributeValues as $referrerFK) {
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
        if ($this->isColumnModified(UserTableMap::COL_MOD)) {
            $modifiedColumns[':p' . $index++]  = 'mod';
        }
        if ($this->isColumnModified(UserTableMap::COL_PROBATION)) {
            $modifiedColumns[':p' . $index++]  = 'probation';
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
                    case 'mod':
                        $stmt->bindValue($identifier, (int) $this->mod, PDO::PARAM_INT);
                        break;
                    case 'probation':
                        $stmt->bindValue($identifier, (int) $this->probation, PDO::PARAM_INT);
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
                return $this->getMod();
                break;
            case 7:
                return $this->getProbation();
                break;
            case 8:
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
            $keys[6] => $this->getMod(),
            $keys[7] => $this->getProbation(),
            $keys[8] => $this->getBanned(),
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
            if (null !== $this->collRigs) {
                
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
        
                $result[$key] = $this->collRigs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserAttributeValues) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userAttributeValues';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_attribute_values';
                        break;
                    default:
                        $key = 'UserAttributeValues';
                }
        
                $result[$key] = $this->collUserAttributeValues->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
                $this->setMod($value);
                break;
            case 7:
                $this->setProbation($value);
                break;
            case 8:
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
            $this->setMod($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setProbation($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setBanned($arr[$keys[8]]);
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
        if ($this->isColumnModified(UserTableMap::COL_MOD)) {
            $criteria->add(UserTableMap::COL_MOD, $this->mod);
        }
        if ($this->isColumnModified(UserTableMap::COL_PROBATION)) {
            $criteria->add(UserTableMap::COL_PROBATION, $this->probation);
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
        $copyObj->setMod($this->getMod());
        $copyObj->setProbation($this->getProbation());
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

            foreach ($this->getRatingHeaders() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRatingHeader($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRigs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRig($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserAttributeValues() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserAttributeValue($relObj->copy($deepCopy));
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
        if ('RatingHeader' == $relationName) {
            return $this->initRatingHeaders();
        }
        if ('Rig' == $relationName) {
            return $this->initRigs();
        }
        if ('UserAttributeValue' == $relationName) {
            return $this->initUserAttributeValues();
        }
        if ('UserReview' == $relationName) {
            return $this->initUserReviews();
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
     * If this ChildUser is new, it will return
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
                    ->filterByUser($this)
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
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setRatingHeaders(Collection $ratingHeaders, ConnectionInterface $con = null)
    {
        /** @var ChildRatingHeader[] $ratingHeadersToDelete */
        $ratingHeadersToDelete = $this->getRatingHeaders(new Criteria(), $con)->diff($ratingHeaders);

        
        $this->ratingHeadersScheduledForDeletion = $ratingHeadersToDelete;

        foreach ($ratingHeadersToDelete as $ratingHeaderRemoved) {
            $ratingHeaderRemoved->setUser(null);
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
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collRatingHeaders);
    }

    /**
     * Method called to associate a ChildRatingHeader object to this object
     * through the ChildRatingHeader foreign key attribute.
     *
     * @param  ChildRatingHeader $l ChildRatingHeader
     * @return $this|\User The current object (for fluent API support)
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
        $ratingHeader->setUser($this);
    }

    /**
     * @param  ChildRatingHeader $ratingHeader The ChildRatingHeader object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
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
            $ratingHeader->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related RatingHeaders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRatingHeader[] List of ChildRatingHeader objects
     */
    public function getRatingHeadersJoinGames(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRatingHeaderQuery::create(null, $criteria);
        $query->joinWith('Games', $joinBehavior);

        return $this->getRatingHeaders($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related RatingHeaders from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRatingHeader[] List of ChildRatingHeader objects
     */
    public function getRatingHeadersJoinPlatforms(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRatingHeaderQuery::create(null, $criteria);
        $query->joinWith('Platforms', $joinBehavior);

        return $this->getRatingHeaders($query, $con);
    }

    /**
     * Clears out the collRigs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRigs()
     */
    public function clearRigs()
    {
        $this->collRigs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collRigs collection loaded partially.
     */
    public function resetPartialRigs($v = true)
    {
        $this->collRigsPartial = $v;
    }

    /**
     * Initializes the collRigs collection.
     *
     * By default this just sets the collRigs collection to an empty array (like clearcollRigs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRigs($overrideExisting = true)
    {
        if (null !== $this->collRigs && !$overrideExisting) {
            return;
        }
        $this->collRigs = new ObjectCollection();
        $this->collRigs->setModel('\Rig');
    }

    /**
     * Gets an array of ChildRig objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRig[] List of ChildRig objects
     * @throws PropelException
     */
    public function getRigs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRigsPartial && !$this->isNew();
        if (null === $this->collRigs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRigs) {
                // return empty collection
                $this->initRigs();
            } else {
                $collRigs = ChildRigQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRigsPartial && count($collRigs)) {
                        $this->initRigs(false);

                        foreach ($collRigs as $obj) {
                            if (false == $this->collRigs->contains($obj)) {
                                $this->collRigs->append($obj);
                            }
                        }

                        $this->collRigsPartial = true;
                    }

                    return $collRigs;
                }

                if ($partial && $this->collRigs) {
                    foreach ($this->collRigs as $obj) {
                        if ($obj->isNew()) {
                            $collRigs[] = $obj;
                        }
                    }
                }

                $this->collRigs = $collRigs;
                $this->collRigsPartial = false;
            }
        }

        return $this->collRigs;
    }

    /**
     * Sets a collection of ChildRig objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $rigs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setRigs(Collection $rigs, ConnectionInterface $con = null)
    {
        /** @var ChildRig[] $rigsToDelete */
        $rigsToDelete = $this->getRigs(new Criteria(), $con)->diff($rigs);

        
        $this->rigsScheduledForDeletion = $rigsToDelete;

        foreach ($rigsToDelete as $rigRemoved) {
            $rigRemoved->setUser(null);
        }

        $this->collRigs = null;
        foreach ($rigs as $rig) {
            $this->addRig($rig);
        }

        $this->collRigs = $rigs;
        $this->collRigsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Rig objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Rig objects.
     * @throws PropelException
     */
    public function countRigs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRigsPartial && !$this->isNew();
        if (null === $this->collRigs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRigs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRigs());
            }

            $query = ChildRigQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collRigs);
    }

    /**
     * Method called to associate a ChildRig object to this object
     * through the ChildRig foreign key attribute.
     *
     * @param  ChildRig $l ChildRig
     * @return $this|\User The current object (for fluent API support)
     */
    public function addRig(ChildRig $l)
    {
        if ($this->collRigs === null) {
            $this->initRigs();
            $this->collRigsPartial = true;
        }

        if (!$this->collRigs->contains($l)) {
            $this->doAddRig($l);
        }

        return $this;
    }

    /**
     * @param ChildRig $rig The ChildRig object to add.
     */
    protected function doAddRig(ChildRig $rig)
    {
        $this->collRigs[]= $rig;
        $rig->setUser($this);
    }

    /**
     * @param  ChildRig $rig The ChildRig object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeRig(ChildRig $rig)
    {
        if ($this->getRigs()->contains($rig)) {
            $pos = $this->collRigs->search($rig);
            $this->collRigs->remove($pos);
            if (null === $this->rigsScheduledForDeletion) {
                $this->rigsScheduledForDeletion = clone $this->collRigs;
                $this->rigsScheduledForDeletion->clear();
            }
            $this->rigsScheduledForDeletion[]= clone $rig;
            $rig->setUser(null);
        }

        return $this;
    }

    /**
     * Clears out the collUserAttributeValues collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserAttributeValues()
     */
    public function clearUserAttributeValues()
    {
        $this->collUserAttributeValues = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserAttributeValues collection loaded partially.
     */
    public function resetPartialUserAttributeValues($v = true)
    {
        $this->collUserAttributeValuesPartial = $v;
    }

    /**
     * Initializes the collUserAttributeValues collection.
     *
     * By default this just sets the collUserAttributeValues collection to an empty array (like clearcollUserAttributeValues());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserAttributeValues($overrideExisting = true)
    {
        if (null !== $this->collUserAttributeValues && !$overrideExisting) {
            return;
        }
        $this->collUserAttributeValues = new ObjectCollection();
        $this->collUserAttributeValues->setModel('\UserAttributeValue');
    }

    /**
     * Gets an array of ChildUserAttributeValue objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserAttributeValue[] List of ChildUserAttributeValue objects
     * @throws PropelException
     */
    public function getUserAttributeValues(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserAttributeValuesPartial && !$this->isNew();
        if (null === $this->collUserAttributeValues || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserAttributeValues) {
                // return empty collection
                $this->initUserAttributeValues();
            } else {
                $collUserAttributeValues = ChildUserAttributeValueQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserAttributeValuesPartial && count($collUserAttributeValues)) {
                        $this->initUserAttributeValues(false);

                        foreach ($collUserAttributeValues as $obj) {
                            if (false == $this->collUserAttributeValues->contains($obj)) {
                                $this->collUserAttributeValues->append($obj);
                            }
                        }

                        $this->collUserAttributeValuesPartial = true;
                    }

                    return $collUserAttributeValues;
                }

                if ($partial && $this->collUserAttributeValues) {
                    foreach ($this->collUserAttributeValues as $obj) {
                        if ($obj->isNew()) {
                            $collUserAttributeValues[] = $obj;
                        }
                    }
                }

                $this->collUserAttributeValues = $collUserAttributeValues;
                $this->collUserAttributeValuesPartial = false;
            }
        }

        return $this->collUserAttributeValues;
    }

    /**
     * Sets a collection of ChildUserAttributeValue objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userAttributeValues A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setUserAttributeValues(Collection $userAttributeValues, ConnectionInterface $con = null)
    {
        /** @var ChildUserAttributeValue[] $userAttributeValuesToDelete */
        $userAttributeValuesToDelete = $this->getUserAttributeValues(new Criteria(), $con)->diff($userAttributeValues);

        
        $this->userAttributeValuesScheduledForDeletion = $userAttributeValuesToDelete;

        foreach ($userAttributeValuesToDelete as $userAttributeValueRemoved) {
            $userAttributeValueRemoved->setUser(null);
        }

        $this->collUserAttributeValues = null;
        foreach ($userAttributeValues as $userAttributeValue) {
            $this->addUserAttributeValue($userAttributeValue);
        }

        $this->collUserAttributeValues = $userAttributeValues;
        $this->collUserAttributeValuesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UserAttributeValue objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related UserAttributeValue objects.
     * @throws PropelException
     */
    public function countUserAttributeValues(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserAttributeValuesPartial && !$this->isNew();
        if (null === $this->collUserAttributeValues || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserAttributeValues) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserAttributeValues());
            }

            $query = ChildUserAttributeValueQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collUserAttributeValues);
    }

    /**
     * Method called to associate a ChildUserAttributeValue object to this object
     * through the ChildUserAttributeValue foreign key attribute.
     *
     * @param  ChildUserAttributeValue $l ChildUserAttributeValue
     * @return $this|\User The current object (for fluent API support)
     */
    public function addUserAttributeValue(ChildUserAttributeValue $l)
    {
        if ($this->collUserAttributeValues === null) {
            $this->initUserAttributeValues();
            $this->collUserAttributeValuesPartial = true;
        }

        if (!$this->collUserAttributeValues->contains($l)) {
            $this->doAddUserAttributeValue($l);
        }

        return $this;
    }

    /**
     * @param ChildUserAttributeValue $userAttributeValue The ChildUserAttributeValue object to add.
     */
    protected function doAddUserAttributeValue(ChildUserAttributeValue $userAttributeValue)
    {
        $this->collUserAttributeValues[]= $userAttributeValue;
        $userAttributeValue->setUser($this);
    }

    /**
     * @param  ChildUserAttributeValue $userAttributeValue The ChildUserAttributeValue object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function removeUserAttributeValue(ChildUserAttributeValue $userAttributeValue)
    {
        if ($this->getUserAttributeValues()->contains($userAttributeValue)) {
            $pos = $this->collUserAttributeValues->search($userAttributeValue);
            $this->collUserAttributeValues->remove($pos);
            if (null === $this->userAttributeValuesScheduledForDeletion) {
                $this->userAttributeValuesScheduledForDeletion = clone $this->collUserAttributeValues;
                $this->userAttributeValuesScheduledForDeletion->clear();
            }
            $this->userAttributeValuesScheduledForDeletion[]= clone $userAttributeValue;
            $userAttributeValue->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserAttributeValues from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserAttributeValue[] List of ChildUserAttributeValue objects
     */
    public function getUserAttributeValuesJoinUserAttribute(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserAttributeValueQuery::create(null, $criteria);
        $query->joinWith('UserAttribute', $joinBehavior);

        return $this->getUserAttributeValues($query, $con);
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
     * If this ChildUser is new, it will return
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
                    ->filterByUser($this)
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
     * @return $this|ChildUser The current object (for fluent API support)
     */
    public function setUserReviews(Collection $userReviews, ConnectionInterface $con = null)
    {
        /** @var ChildUserReview[] $userReviewsToDelete */
        $userReviewsToDelete = $this->getUserReviews(new Criteria(), $con)->diff($userReviews);

        
        $this->userReviewsScheduledForDeletion = $userReviewsToDelete;

        foreach ($userReviewsToDelete as $userReviewRemoved) {
            $userReviewRemoved->setUser(null);
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
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collUserReviews);
    }

    /**
     * Method called to associate a ChildUserReview object to this object
     * through the ChildUserReview foreign key attribute.
     *
     * @param  ChildUserReview $l ChildUserReview
     * @return $this|\User The current object (for fluent API support)
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
        $userReview->setUser($this);
    }

    /**
     * @param  ChildUserReview $userReview The ChildUserReview object to remove.
     * @return $this|ChildUser The current object (for fluent API support)
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
            $userReview->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserReviews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserReview[] List of ChildUserReview objects
     */
    public function getUserReviewsJoinGames(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserReviewQuery::create(null, $criteria);
        $query->joinWith('Games', $joinBehavior);

        return $this->getUserReviews($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserReviews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserReview[] List of ChildUserReview objects
     */
    public function getUserReviewsJoinPlatforms(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserReviewQuery::create(null, $criteria);
        $query->joinWith('Platforms', $joinBehavior);

        return $this->getUserReviews($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserReviews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
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
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UserReviews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
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
        $this->id = null;
        $this->username = null;
        $this->password = null;
        $this->reddit_id = null;
        $this->trusted = null;
        $this->admin = null;
        $this->mod = null;
        $this->probation = null;
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
            if ($this->collRatingHeaders) {
                foreach ($this->collRatingHeaders as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRigs) {
                foreach ($this->collRigs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserAttributeValues) {
                foreach ($this->collUserAttributeValues as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserReviews) {
                foreach ($this->collUserReviews as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collNews = null;
        $this->collRatingHeaders = null;
        $this->collRigs = null;
        $this->collUserAttributeValues = null;
        $this->collUserReviews = null;
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
