<?php

/**
 * user actions.
 *
 * @package    lsdjie
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class userActions extends sfActions
{
public function executeLogin()
{
  if ($this->getRequest()->getMethod() != sfRequest::POST)
  {
    // display the form
    $this->getRequest()->getParameterHolder()->set('referer', $this->getRequest()->getReferer());
 
    return sfView::SUCCESS;
  }
  else
  {
    // handle the form submission
    // redirect to last page
    return $this->redirect($this->getRequestParameter('referer', '@homepage'));
  }
}

public function executeLogout()
{
  $this->getUser()->signOut();
  $this->redirect($_SERVER['HTTP_REFERER']);
}

public function handleErrorLogin()
{
  return sfView::SUCCESS;
}

  /**
   * Executes index action
   *
   */

public function executeShow()
{
  $this->subscriber = UserPeer::retrieveByStripped($this->getRequestParameter('username', $this->getUser()->getSubscriberId()));
  $this->forward404Unless($this->subscriber);
  
  $this->instruments = $this->subscriber->getInstruments();

  $this->authored_instruments = InstrumentPeer::getByAuthorNoStrip($this->subscriber);
  $this->getResponse()->setTitle("Patch Book - ". $this->subscriber);
}

public function executeAuthor()
{
  $this->author = $this->getRequestParameter('author');
  $user_exists = UserPeer::retrieveByStripped($this->author);
  if ($user_exists) $this->redirect('user/show?username='.$this->author);
  $this->instruments = InstrumentPeer::getByAuthor($this->author);
  $this->forward404Unless($this->instruments);
  $this->getResponse()->setTitle("Patch Book - ". $this->author);
}

public function executePopularUser()
{
  $this->popular = UserPeer::getPopularUser();
}

public function executePopularAuthor()
{
  $this->popular = InstrumentPeer::getPopularAuthor();
}

  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
}
