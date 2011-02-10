<?php



class TagsMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TagsMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('Tags');
		$tMap->setPhpName('Tags');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('INSTRUMENT_ID', 'InstrumentId', 'int' , CreoleTypes::INTEGER, 'Instrument', 'ID', true, null);

		$tMap->addForeignPrimaryKey('USER_ID', 'UserId', 'string' , CreoleTypes::VARCHAR, 'User', 'USERNAME', true, 255);

		$tMap->addColumn('TAG', 'Tag', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addPrimaryKey('NORMALIZED', 'Normalized', 'string', CreoleTypes::VARCHAR, true, 100);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 