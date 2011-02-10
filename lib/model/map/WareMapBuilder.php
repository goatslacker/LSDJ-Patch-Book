<?php



class WareMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.WareMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('Ware');
		$tMap->setPhpName('Ware');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('SOFT', 'Soft', 'string', CreoleTypes::VARCHAR, true, 25);

		$tMap->addColumn('HARD', 'Hard', 'string', CreoleTypes::VARCHAR, false, 25);

	} 
} 