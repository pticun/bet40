<?php

namespace Map;

use \Options;
use \OptionsQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'options' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class OptionsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.OptionsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'sportsbet';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'options';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Options';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Options';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the optionID field
     */
    const COL_OPTIONID = 'options.optionID';

    /**
     * the column name for the eventID field
     */
    const COL_EVENTID = 'options.eventID';

    /**
     * the column name for the text field
     */
    const COL_TEXT = 'options.text';

    /**
     * the column name for the image field
     */
    const COL_IMAGE = 'options.image';

    /**
     * the column name for the voteCount field
     */
    const COL_VOTECOUNT = 'options.voteCount';

    /**
     * the column name for the correct field
     */
    const COL_CORRECT = 'options.correct';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Optionid', 'Eventid', 'Text', 'Image', 'Votecount', 'Correct', ),
        self::TYPE_CAMELNAME     => array('optionid', 'eventid', 'text', 'image', 'votecount', 'correct', ),
        self::TYPE_COLNAME       => array(OptionsTableMap::COL_OPTIONID, OptionsTableMap::COL_EVENTID, OptionsTableMap::COL_TEXT, OptionsTableMap::COL_IMAGE, OptionsTableMap::COL_VOTECOUNT, OptionsTableMap::COL_CORRECT, ),
        self::TYPE_FIELDNAME     => array('optionID', 'eventID', 'text', 'image', 'voteCount', 'correct', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Optionid' => 0, 'Eventid' => 1, 'Text' => 2, 'Image' => 3, 'Votecount' => 4, 'Correct' => 5, ),
        self::TYPE_CAMELNAME     => array('optionid' => 0, 'eventid' => 1, 'text' => 2, 'image' => 3, 'votecount' => 4, 'correct' => 5, ),
        self::TYPE_COLNAME       => array(OptionsTableMap::COL_OPTIONID => 0, OptionsTableMap::COL_EVENTID => 1, OptionsTableMap::COL_TEXT => 2, OptionsTableMap::COL_IMAGE => 3, OptionsTableMap::COL_VOTECOUNT => 4, OptionsTableMap::COL_CORRECT => 5, ),
        self::TYPE_FIELDNAME     => array('optionID' => 0, 'eventID' => 1, 'text' => 2, 'image' => 3, 'voteCount' => 4, 'correct' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('options');
        $this->setPhpName('Options');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Options');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('optionID', 'Optionid', 'INTEGER', true, null, null);
        $this->addForeignKey('eventID', 'Eventid', 'INTEGER', 'events', 'eventID', true, null, null);
        $this->addColumn('text', 'Text', 'VARCHAR', true, 128, null);
        $this->addColumn('image', 'Image', 'VARCHAR', true, 255, null);
        $this->addColumn('voteCount', 'Votecount', 'INTEGER', true, null, null);
        $this->addColumn('correct', 'Correct', 'BOOLEAN', false, 1, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Events', '\\Events', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':eventID',
    1 => ':eventID',
  ),
), null, null, null, false);
        $this->addRelation('Votes', '\\Votes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':optionID',
    1 => ':optionID',
  ),
), null, null, 'Votess', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Optionid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Optionid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Optionid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Optionid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Optionid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Optionid', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Optionid', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }
    
    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? OptionsTableMap::CLASS_DEFAULT : OptionsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Options object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OptionsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OptionsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OptionsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OptionsTableMap::OM_CLASS;
            /** @var Options $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OptionsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();
    
        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = OptionsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OptionsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Options $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OptionsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(OptionsTableMap::COL_OPTIONID);
            $criteria->addSelectColumn(OptionsTableMap::COL_EVENTID);
            $criteria->addSelectColumn(OptionsTableMap::COL_TEXT);
            $criteria->addSelectColumn(OptionsTableMap::COL_IMAGE);
            $criteria->addSelectColumn(OptionsTableMap::COL_VOTECOUNT);
            $criteria->addSelectColumn(OptionsTableMap::COL_CORRECT);
        } else {
            $criteria->addSelectColumn($alias . '.optionID');
            $criteria->addSelectColumn($alias . '.eventID');
            $criteria->addSelectColumn($alias . '.text');
            $criteria->addSelectColumn($alias . '.image');
            $criteria->addSelectColumn($alias . '.voteCount');
            $criteria->addSelectColumn($alias . '.correct');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(OptionsTableMap::DATABASE_NAME)->getTable(OptionsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(OptionsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(OptionsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new OptionsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Options or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Options object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OptionsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Options) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OptionsTableMap::DATABASE_NAME);
            $criteria->add(OptionsTableMap::COL_OPTIONID, (array) $values, Criteria::IN);
        }

        $query = OptionsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OptionsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OptionsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the options table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OptionsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Options or Criteria object.
     *
     * @param mixed               $criteria Criteria or Options object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OptionsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Options object
        }

        if ($criteria->containsKey(OptionsTableMap::COL_OPTIONID) && $criteria->keyContainsValue(OptionsTableMap::COL_OPTIONID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OptionsTableMap::COL_OPTIONID.')');
        }


        // Set the correct dbName
        $query = OptionsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OptionsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
OptionsTableMap::buildTableMap();
