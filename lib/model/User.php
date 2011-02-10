<?php

/**
 * Subclass for representing a row from the 'ask_user' table.
 *
 * 
 *
 * @package lib.model
 */ 
class User extends BaseUser
{
public function __toString()
{
  return $this->getUsername();
}

public function setUsername($v) {
  parent::setUsername($v);
  $stripped = myTools::url_encode($v);
  $this->setStripped($stripped);
}
}
