<?php

/**
 * Subclass for performing query and update operations on the 'InstrumentBank' table.
 *
 * 
 *
 * @package lib.model
 */ 
class InstrumentBankPeer extends BaseInstrumentBankPeer
{
  public static function Clear($bank_id) {
	$c = new Criteria();
    $c->add(InstrumentBankPeer::BANK_ID,$bank_id);
	$bank = InstrumentBankPeer::doDelete($c);

	return $bank ? true : false;
  }

  public static function getAllInstruments($bank_id) {
    $c = new Criteria();
    $c->add(InstrumentBankPeer::BANK_ID,$bank_id);
    $instruments = self::doSelect($c);
    $where = array();
    foreach ($instruments as $instrument) {
      $where[] = $instrument->getInstrumentId();
    }
    return InstrumentPeer::retrieveWhereIn($where);
  }
}
