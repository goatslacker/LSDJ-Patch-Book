<?php


abstract class BaseInstrumentPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'Instrument';

	
	const CLASS_DEFAULT = 'lib.model.Instrument';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'Instrument.ID';

	
	const NAME = 'Instrument.NAME';

	
	const STRIPPED = 'Instrument.STRIPPED';

	
	const SOFTWARE = 'Instrument.SOFTWARE';

	
	const TYPE = 'Instrument.TYPE';

	
	const DESCRIPTION = 'Instrument.DESCRIPTION';

	
	const OBJECT = 'Instrument.OBJECT';

	
	const OWNER = 'Instrument.OWNER';

	
	const AUTHOR = 'Instrument.AUTHOR';

	
	const AUTHOR_STRIP = 'Instrument.AUTHOR_STRIP';

	
	const SHARE = 'Instrument.SHARE';

	
	const POPULARITY = 'Instrument.POPULARITY';

	
	const SAMPLE = 'Instrument.SAMPLE';

	
	const UPDATED_AT = 'Instrument.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Stripped', 'Software', 'Type', 'Description', 'Object', 'Owner', 'Author', 'AuthorStrip', 'Share', 'Popularity', 'Sample', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (InstrumentPeer::ID, InstrumentPeer::NAME, InstrumentPeer::STRIPPED, InstrumentPeer::SOFTWARE, InstrumentPeer::TYPE, InstrumentPeer::DESCRIPTION, InstrumentPeer::OBJECT, InstrumentPeer::OWNER, InstrumentPeer::AUTHOR, InstrumentPeer::AUTHOR_STRIP, InstrumentPeer::SHARE, InstrumentPeer::POPULARITY, InstrumentPeer::SAMPLE, InstrumentPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'stripped', 'software', 'type', 'description', 'object', 'owner', 'author', 'author_strip', 'share', 'popularity', 'sample', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Stripped' => 2, 'Software' => 3, 'Type' => 4, 'Description' => 5, 'Object' => 6, 'Owner' => 7, 'Author' => 8, 'AuthorStrip' => 9, 'Share' => 10, 'Popularity' => 11, 'Sample' => 12, 'UpdatedAt' => 13, ),
		BasePeer::TYPE_COLNAME => array (InstrumentPeer::ID => 0, InstrumentPeer::NAME => 1, InstrumentPeer::STRIPPED => 2, InstrumentPeer::SOFTWARE => 3, InstrumentPeer::TYPE => 4, InstrumentPeer::DESCRIPTION => 5, InstrumentPeer::OBJECT => 6, InstrumentPeer::OWNER => 7, InstrumentPeer::AUTHOR => 8, InstrumentPeer::AUTHOR_STRIP => 9, InstrumentPeer::SHARE => 10, InstrumentPeer::POPULARITY => 11, InstrumentPeer::SAMPLE => 12, InstrumentPeer::UPDATED_AT => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'stripped' => 2, 'software' => 3, 'type' => 4, 'description' => 5, 'object' => 6, 'owner' => 7, 'author' => 8, 'author_strip' => 9, 'share' => 10, 'popularity' => 11, 'sample' => 12, 'updated_at' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/InstrumentMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.InstrumentMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = InstrumentPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(InstrumentPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InstrumentPeer::ID);

		$criteria->addSelectColumn(InstrumentPeer::NAME);

		$criteria->addSelectColumn(InstrumentPeer::STRIPPED);

		$criteria->addSelectColumn(InstrumentPeer::SOFTWARE);

		$criteria->addSelectColumn(InstrumentPeer::TYPE);

		$criteria->addSelectColumn(InstrumentPeer::DESCRIPTION);

		$criteria->addSelectColumn(InstrumentPeer::OBJECT);

		$criteria->addSelectColumn(InstrumentPeer::OWNER);

		$criteria->addSelectColumn(InstrumentPeer::AUTHOR);

		$criteria->addSelectColumn(InstrumentPeer::AUTHOR_STRIP);

		$criteria->addSelectColumn(InstrumentPeer::SHARE);

		$criteria->addSelectColumn(InstrumentPeer::POPULARITY);

		$criteria->addSelectColumn(InstrumentPeer::SAMPLE);

		$criteria->addSelectColumn(InstrumentPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(Instrument.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT Instrument.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InstrumentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InstrumentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InstrumentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = InstrumentPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return InstrumentPeer::populateObjects(InstrumentPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			InstrumentPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = InstrumentPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinWare(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InstrumentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InstrumentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InstrumentPeer::SOFTWARE, WarePeer::SOFT);

		$rs = InstrumentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InstrumentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InstrumentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InstrumentPeer::OWNER, UserPeer::USERNAME);

		$rs = InstrumentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinWare(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InstrumentPeer::addSelectColumns($c);
		$startcol = (InstrumentPeer::NUM_COLUMNS - InstrumentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		WarePeer::addSelectColumns($c);

		$c->addJoin(InstrumentPeer::SOFTWARE, WarePeer::SOFT);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InstrumentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = WarePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getWare(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addInstrument($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInstruments();
				$obj2->addInstrument($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUser(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InstrumentPeer::addSelectColumns($c);
		$startcol = (InstrumentPeer::NUM_COLUMNS - InstrumentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(InstrumentPeer::OWNER, UserPeer::USERNAME);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InstrumentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addInstrument($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInstruments();
				$obj2->addInstrument($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InstrumentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InstrumentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InstrumentPeer::SOFTWARE, WarePeer::SOFT);

		$criteria->addJoin(InstrumentPeer::OWNER, UserPeer::USERNAME);

		$rs = InstrumentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InstrumentPeer::addSelectColumns($c);
		$startcol2 = (InstrumentPeer::NUM_COLUMNS - InstrumentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		WarePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + WarePeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		$c->addJoin(InstrumentPeer::SOFTWARE, WarePeer::SOFT);

		$c->addJoin(InstrumentPeer::OWNER, UserPeer::USERNAME);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InstrumentPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = WarePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getWare(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInstrument($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initInstruments();
				$obj2->addInstrument($obj1);
			}


					
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUser(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInstrument($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initInstruments();
				$obj3->addInstrument($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptWare(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InstrumentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InstrumentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InstrumentPeer::OWNER, UserPeer::USERNAME);

		$rs = InstrumentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InstrumentPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InstrumentPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InstrumentPeer::SOFTWARE, WarePeer::SOFT);

		$rs = InstrumentPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptWare(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InstrumentPeer::addSelectColumns($c);
		$startcol2 = (InstrumentPeer::NUM_COLUMNS - InstrumentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		$c->addJoin(InstrumentPeer::OWNER, UserPeer::USERNAME);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InstrumentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInstrument($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInstruments();
				$obj2->addInstrument($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUser(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InstrumentPeer::addSelectColumns($c);
		$startcol2 = (InstrumentPeer::NUM_COLUMNS - InstrumentPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		WarePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + WarePeer::NUM_COLUMNS;

		$c->addJoin(InstrumentPeer::SOFTWARE, WarePeer::SOFT);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InstrumentPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = WarePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getWare(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInstrument($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInstruments();
				$obj2->addInstrument($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return InstrumentPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(InstrumentPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(InstrumentPeer::ID);
			$selectCriteria->add(InstrumentPeer::ID, $criteria->remove(InstrumentPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += InstrumentPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(InstrumentPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(InstrumentPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Instrument) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InstrumentPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			$affectedRows += InstrumentPeer::doOnDeleteCascade($criteria, $con);
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected static function doOnDeleteCascade(Criteria $criteria, Connection $con)
	{
				$affectedRows = 0;

				$objects = InstrumentPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/Search.php';

						$c = new Criteria();
			
			$c->add(SearchPeer::INSTRUMENT_ID, $obj->getId());
			$affectedRows += SearchPeer::doDelete($c, $con);

			include_once 'lib/model/Comment.php';

						$c = new Criteria();
			
			$c->add(CommentPeer::INSTRUMENT_ID, $obj->getId());
			$affectedRows += CommentPeer::doDelete($c, $con);

			include_once 'lib/model/InstrumentBank.php';

						$c = new Criteria();
			
			$c->add(InstrumentBankPeer::INSTRUMENT_ID, $obj->getId());
			$affectedRows += InstrumentBankPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	
	public static function doValidate(Instrument $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InstrumentPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InstrumentPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(InstrumentPeer::DATABASE_NAME, InstrumentPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InstrumentPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(InstrumentPeer::DATABASE_NAME);

		$criteria->add(InstrumentPeer::ID, $pk);


		$v = InstrumentPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(InstrumentPeer::ID, $pks, Criteria::IN);
			$objs = InstrumentPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseInstrumentPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/InstrumentMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.InstrumentMapBuilder');
}
