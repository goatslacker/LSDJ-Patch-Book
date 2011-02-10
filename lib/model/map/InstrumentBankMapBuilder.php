<?php



class InstrumentBankMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.InstrumentBankMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('InstrumentBank');
		$tMap->setPhpName('InstrumentBank');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('BANK_ID', 'BankId', 'int', CreoleTypes::INTEGER, 'Bank', 'ID', true, null);

		$tMap->addForeignKey('INSTRUMENT_ID', 'InstrumentId', 'int', CreoleTypes::INTEGER, 'Instrument', 'ID', true, null);

	} 
} 