<?php



class CommentMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.CommentMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('Comment');
		$tMap->setPhpName('Comment');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('INSTRUMENT_ID', 'InstrumentId', 'int', CreoleTypes::INTEGER, 'Instrument', 'ID', false, null);

		$tMap->addForeignKey('AUTHOR', 'Author', 'string', CreoleTypes::VARCHAR, 'User', 'USERNAME', false, 255);

		$tMap->addColumn('COMMENT', 'Comment', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 