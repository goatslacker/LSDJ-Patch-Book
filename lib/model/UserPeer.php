<?php

/**
 * Subclass for performing query and update operations on the 'ask_user' table.
 *
 * 
 *
 * @package lib.model
 */ 
class UserPeer extends BaseUserPeer
{
public static function getPopularUser()
{
  $c = new Criteria();
  $c->addJoin(self::USERNAME, InstrumentPeer::OWNER);
  $c->addGroupByColumn(InstrumentPeer::OWNER);
  if (sfConfig::get('app_universe')) $c->add(InstrumentPeer::SOFTWARE,sfConfig::get('app_tag'));
  $c->addDescendingOrderByColumn('count(*)');
  $owner = self::doSelect($c);

  return $owner;
}
public static function retrieveByStripped($name) {
  $c = new Criteria();
  $c->add(self::STRIPPED,$name);
  $owner = self::doSelect($c);

  return !empty($owner) > 0 ? $owner[0] : null;
}
}
