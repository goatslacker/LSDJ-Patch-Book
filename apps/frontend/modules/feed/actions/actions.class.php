<?php

/**
 * feed actions.
 *
 * @package    lsdjie
 * @subpackage feed
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class feedActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
public function executeNew() {
  // instruments
  $c = new Criteria();
  $c->setLimit(sfConfig::get('app_feed_max'));
  $c->add(InstrumentPeer::SHARE, '1');
  $c->addDescendingOrderByColumn(InstrumentPeer::UPDATED_AT);
  $instruments = InstrumentPeer::doSelect($c);

  $feed = sfFeed::newInstance('rss201rev2');
 
  // channel
  $feed->setTitle('New instruments on lsdjie');
  $feed->setLink('@homepage');
  $feed->setDescription('Latest instruments on LSDJIE.');
 
  // items
  $feed->setFeedItemsRouteName('@instrumentFeed');
  $feed->setItems($instruments);
 
  $this->feed = $feed;
}

public function executeUser() {
  // instruments
  $c = new Criteria();
  $c->setLimit(sfConfig::get('app_feed_max'));
  $USER = $this->getRequestParameter('username');
  $c1 = $c->getNewCriterion(InstrumentPeer::OWNER, $USER);
  $c2 = $c->getNewCriterion(InstrumentPeer::AUTHOR, $USER);
  $c1->addOr($c2);
  $c->add($c1); 
  $c->addAnd(InstrumentPeer::SHARE, '1');
  $c->addDescendingOrderByColumn(InstrumentPeer::UPDATED_AT);
  $instruments = InstrumentPeer::doSelect($c);

  $feed = sfFeed::newInstance('rss201rev2');

  // channel
  $feed->setTitle($USER. '\'s Instrument Patches');
  $feed->setLink('@homepage');
  $feed->setDescription($USER. '\'s Latest contributions to the patch book.');

  // items
  $feed->setFeedItemsRouteName('@instrumentFeed');
  $feed->setItems($instruments);

  $this->feed = $feed;
}

public function executePopular()
{
  // instruments
  $c = new Criteria();
  $c->setLimit(sfConfig::get('app_feed_max'));
  $c->add(InstrumentPeer::SHARE, '1');
  $c->addDescendingOrderByColumn(InstrumentPeer::POPULARITY);
  $instruments = InstrumentPeer::doSelect($c);

  $feed = sfFeed::newInstance('rss201rev2');
 
  // channel
  $feed->setTitle('Popular instruments on lsdjie');
  $feed->setLink('@homepage');
  $feed->setDescription('Most popular instruments on LSDJIE.');
 
  // items
  $feed->setFeedItemsRouteName('@instrument');
  $feed->setItems($instruments);
 
  $this->feed = $feed;
}

}
