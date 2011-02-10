<?php



class BankMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.BankMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('Bank');
		$tMap->setPhpName('Bank');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('OWNER', 'Owner', 'string', CreoleTypes::VARCHAR, 'User', 'USERNAME', false, 255);

		$tMap->addForeignKey('SOFTWARE', 'Software', 'string', CreoleTypes::VARCHAR, 'Ware', 'SOFT', true, 25);

		$tMap->addColumn('SHARE', 'Share', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 