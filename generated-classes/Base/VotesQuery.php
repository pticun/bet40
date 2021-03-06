<?php

namespace Base;

use \Votes as ChildVotes;
use \VotesQuery as ChildVotesQuery;
use \Exception;
use \PDO;
use Map\VotesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'votes' table.
 *
 * 
 *
 * @method     ChildVotesQuery orderByVoteid($order = Criteria::ASC) Order by the voteID column
 * @method     ChildVotesQuery orderByIpaddress($order = Criteria::ASC) Order by the IPAddress column
 * @method     ChildVotesQuery orderByUserid($order = Criteria::ASC) Order by the userID column
 * @method     ChildVotesQuery orderByOptionid($order = Criteria::ASC) Order by the optionID column
 *
 * @method     ChildVotesQuery groupByVoteid() Group by the voteID column
 * @method     ChildVotesQuery groupByIpaddress() Group by the IPAddress column
 * @method     ChildVotesQuery groupByUserid() Group by the userID column
 * @method     ChildVotesQuery groupByOptionid() Group by the optionID column
 *
 * @method     ChildVotesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVotesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVotesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVotesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVotesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVotesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVotesQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildVotesQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildVotesQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildVotesQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildVotesQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildVotesQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildVotesQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildVotesQuery leftJoinOptions($relationAlias = null) Adds a LEFT JOIN clause to the query using the Options relation
 * @method     ChildVotesQuery rightJoinOptions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Options relation
 * @method     ChildVotesQuery innerJoinOptions($relationAlias = null) Adds a INNER JOIN clause to the query using the Options relation
 *
 * @method     ChildVotesQuery joinWithOptions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Options relation
 *
 * @method     ChildVotesQuery leftJoinWithOptions() Adds a LEFT JOIN clause and with to the query using the Options relation
 * @method     ChildVotesQuery rightJoinWithOptions() Adds a RIGHT JOIN clause and with to the query using the Options relation
 * @method     ChildVotesQuery innerJoinWithOptions() Adds a INNER JOIN clause and with to the query using the Options relation
 *
 * @method     \UsersQuery|\OptionsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVotes findOne(ConnectionInterface $con = null) Return the first ChildVotes matching the query
 * @method     ChildVotes findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVotes matching the query, or a new ChildVotes object populated from the query conditions when no match is found
 *
 * @method     ChildVotes findOneByVoteid(int $voteID) Return the first ChildVotes filtered by the voteID column
 * @method     ChildVotes findOneByIpaddress(string $IPAddress) Return the first ChildVotes filtered by the IPAddress column
 * @method     ChildVotes findOneByUserid(int $userID) Return the first ChildVotes filtered by the userID column
 * @method     ChildVotes findOneByOptionid(int $optionID) Return the first ChildVotes filtered by the optionID column *

 * @method     ChildVotes requirePk($key, ConnectionInterface $con = null) Return the ChildVotes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVotes requireOne(ConnectionInterface $con = null) Return the first ChildVotes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVotes requireOneByVoteid(int $voteID) Return the first ChildVotes filtered by the voteID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVotes requireOneByIpaddress(string $IPAddress) Return the first ChildVotes filtered by the IPAddress column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVotes requireOneByUserid(int $userID) Return the first ChildVotes filtered by the userID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVotes requireOneByOptionid(int $optionID) Return the first ChildVotes filtered by the optionID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVotes[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVotes objects based on current ModelCriteria
 * @method     ChildVotes[]|ObjectCollection findByVoteid(int $voteID) Return ChildVotes objects filtered by the voteID column
 * @method     ChildVotes[]|ObjectCollection findByIpaddress(string $IPAddress) Return ChildVotes objects filtered by the IPAddress column
 * @method     ChildVotes[]|ObjectCollection findByUserid(int $userID) Return ChildVotes objects filtered by the userID column
 * @method     ChildVotes[]|ObjectCollection findByOptionid(int $optionID) Return ChildVotes objects filtered by the optionID column
 * @method     ChildVotes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VotesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\VotesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'sportsbet', $modelName = '\\Votes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVotesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVotesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVotesQuery) {
            return $criteria;
        }
        $query = new ChildVotesQuery();
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
     * @return ChildVotes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VotesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VotesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
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
     * @return ChildVotes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT voteID, IPAddress, userID, optionID FROM votes WHERE voteID = :p0';
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
            /** @var ChildVotes $obj */
            $obj = new ChildVotes();
            $obj->hydrate($row);
            VotesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVotes|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVotesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VotesTableMap::COL_VOTEID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVotesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VotesTableMap::COL_VOTEID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the voteID column
     *
     * Example usage:
     * <code>
     * $query->filterByVoteid(1234); // WHERE voteID = 1234
     * $query->filterByVoteid(array(12, 34)); // WHERE voteID IN (12, 34)
     * $query->filterByVoteid(array('min' => 12)); // WHERE voteID > 12
     * </code>
     *
     * @param     mixed $voteid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVotesQuery The current query, for fluid interface
     */
    public function filterByVoteid($voteid = null, $comparison = null)
    {
        if (is_array($voteid)) {
            $useMinMax = false;
            if (isset($voteid['min'])) {
                $this->addUsingAlias(VotesTableMap::COL_VOTEID, $voteid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($voteid['max'])) {
                $this->addUsingAlias(VotesTableMap::COL_VOTEID, $voteid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotesTableMap::COL_VOTEID, $voteid, $comparison);
    }

    /**
     * Filter the query on the IPAddress column
     *
     * Example usage:
     * <code>
     * $query->filterByIpaddress('fooValue');   // WHERE IPAddress = 'fooValue'
     * $query->filterByIpaddress('%fooValue%', Criteria::LIKE); // WHERE IPAddress LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ipaddress The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVotesQuery The current query, for fluid interface
     */
    public function filterByIpaddress($ipaddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ipaddress)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotesTableMap::COL_IPADDRESS, $ipaddress, $comparison);
    }

    /**
     * Filter the query on the userID column
     *
     * Example usage:
     * <code>
     * $query->filterByUserid(1234); // WHERE userID = 1234
     * $query->filterByUserid(array(12, 34)); // WHERE userID IN (12, 34)
     * $query->filterByUserid(array('min' => 12)); // WHERE userID > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param     mixed $userid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVotesQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(VotesTableMap::COL_USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(VotesTableMap::COL_USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotesTableMap::COL_USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the optionID column
     *
     * Example usage:
     * <code>
     * $query->filterByOptionid(1234); // WHERE optionID = 1234
     * $query->filterByOptionid(array(12, 34)); // WHERE optionID IN (12, 34)
     * $query->filterByOptionid(array('min' => 12)); // WHERE optionID > 12
     * </code>
     *
     * @see       filterByOptions()
     *
     * @param     mixed $optionid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVotesQuery The current query, for fluid interface
     */
    public function filterByOptionid($optionid = null, $comparison = null)
    {
        if (is_array($optionid)) {
            $useMinMax = false;
            if (isset($optionid['min'])) {
                $this->addUsingAlias(VotesTableMap::COL_OPTIONID, $optionid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($optionid['max'])) {
                $this->addUsingAlias(VotesTableMap::COL_OPTIONID, $optionid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VotesTableMap::COL_OPTIONID, $optionid, $comparison);
    }

    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVotesQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(VotesTableMap::COL_USERID, $users->getUserid(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VotesTableMap::COL_USERID, $users->toKeyValue('PrimaryKey', 'Userid'), $comparison);
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVotesQuery The current query, for fluid interface
     */
    public function joinUsers($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

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
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\UsersQuery');
    }

    /**
     * Filter the query by a related \Options object
     *
     * @param \Options|ObjectCollection $options The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVotesQuery The current query, for fluid interface
     */
    public function filterByOptions($options, $comparison = null)
    {
        if ($options instanceof \Options) {
            return $this
                ->addUsingAlias(VotesTableMap::COL_OPTIONID, $options->getOptionid(), $comparison);
        } elseif ($options instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VotesTableMap::COL_OPTIONID, $options->toKeyValue('PrimaryKey', 'Optionid'), $comparison);
        } else {
            throw new PropelException('filterByOptions() only accepts arguments of type \Options or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Options relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVotesQuery The current query, for fluid interface
     */
    public function joinOptions($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Options');

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
            $this->addJoinObject($join, 'Options');
        }

        return $this;
    }

    /**
     * Use the Options relation Options object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OptionsQuery A secondary query class using the current class as primary query
     */
    public function useOptionsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOptions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Options', '\OptionsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVotes $votes Object to remove from the list of results
     *
     * @return $this|ChildVotesQuery The current query, for fluid interface
     */
    public function prune($votes = null)
    {
        if ($votes) {
            $this->addUsingAlias(VotesTableMap::COL_VOTEID, $votes->getVoteid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the votes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VotesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VotesTableMap::clearInstancePool();
            VotesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VotesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VotesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            VotesTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            VotesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VotesQuery
