<?php

/**
 * Subclass for representing a row from the 'Bank' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Bank extends BaseBank
{

public function getInstruments() {
  return InstrumentBankPeer::getAllInstruments($this->getId());
}
}
