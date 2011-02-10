<?php

/**
 * Subclass for performing query and update operations on the 'Ware' table.
 *
 * 
 *
 * @package lib.model
 */ 
class WarePeer extends BaseWarePeer
{
  public static function getAll() {
	return WarePeer::doSelect(new Criteria);
  }
}
