<?php



class InstrumentMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.InstrumentMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('Instrument');
		$tMap->setPhpName('Instrument');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('STRIPPED', 'Stripped', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addForeignKey('SOFTWARE', 'Software', 'string', CreoleTypes::VARCHAR, 'Ware', 'SOFT', true, 25);

		$tMap->addColumn('TYPE', 'Type', 'string', CreoleTypes::VARCHAR, true, 5);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('OBJECT', 'Object', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('OWNER', 'Owner', 'string', CreoleTypes::VARCHAR, 'User', 'USERNAME', false, 255);

		$tMap->addColumn('AUTHOR', 'Author', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('AUTHOR_STRIP', 'AuthorStrip', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SHARE', 'Share', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('POPULARITY', 'Popularity', 'int', CreoleTypes::INTEGER, false, 3);

		$tMap->addColumn('SAMPLE', 'Sample', 'string', CreoleTypes::VARCHAR, false, 36);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 