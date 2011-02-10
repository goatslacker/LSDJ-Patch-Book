<?php

/**
 * tag actions.
 *
 * @package    lsdjie
 * @subpackage tag
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class tagActions extends sfActions
{
public function executePopular()
{
  $this->tags = TagsPeer::getPopularTags(sfConfig::get('app_tag_cloud_max'));
}
public function executeAdd()
{
  $this->instrument = InstrumentPeer::retrieveByPk($this->getRequestParameter('instrument_id'));
  $this->forward404Unless($this->instrument);
 
  $userId = $this->getUser()->getSubscriberId();
  $phrase = $this->getRequestParameter('tag');
  try {
	$this->instrument->addTagsForUser($phrase, $userId);
  } catch(Exception $e) {
	return $this->redirect($this->getRequestParameter('referer', '@homepage'));
  }
 
  $this->tags = $this->instrument->getTags();

  return $this->redirect($this->getRequestParameter('referer', '@homepage'));
}
public function executeShow()
{
  $this->instrument_pager = InstrumentPeer::getPopularByTag($this->getRequestParameter('tag'), $this->getRequestParameter('page'));
}
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
}
