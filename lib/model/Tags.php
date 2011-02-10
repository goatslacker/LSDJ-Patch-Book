<?php

/**
 * Subclass for representing a row from the 'Tags' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Tags extends BaseTags
{
public function save($con = null)
{
  $con = sfContext::getInstance()->getDatabaseConnection('propel');
  try
  {
    $con->begin();
 
    $ret = parent::save($con);
    $this->getInstrument()->updateSearchIndex();
 
    $con->commit();
 
    return $ret;
  }
  catch (Exception $e)
  {
    $con->rollback();
    throw $e;
  }
}
public function setTag($v)
{
  parent::setTag($v);
 
  $this->setNormalized(Tag::normalize($v));
}
}
