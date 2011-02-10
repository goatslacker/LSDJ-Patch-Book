<?php



class UserMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UserMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('User');
		$tMap->setPhpName('User');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('USERNAME', 'Username', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('STRIPPED', 'Stripped', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('REALNAME', 'Realname', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('AVATAR', 'Avatar', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('LOCATION', 'Location', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('IS_ADMIN', 'IsAdmin', 'boolean', CreoleTypes::BOOLEAN, false, null);

	} 
} 