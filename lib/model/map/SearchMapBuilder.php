<?php



class SearchMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SearchMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('Search');
		$tMap->setPhpName('Search');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('INSTRUMENT_ID', 'InstrumentId', 'int', CreoleTypes::INTEGER, 'Instrument', 'ID', false, null);

		$tMap->addColumn('WORD', 'Word', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('WEIGHT', 'Weight', 'int', CreoleTypes::INTEGER, false, 3);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 