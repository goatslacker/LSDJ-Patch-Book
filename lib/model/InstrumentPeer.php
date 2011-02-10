<?php

/**
 * Subclass for performing query and update operations on the 'Instrument' table.
 *
 * lots of redundancy, try and minimize
 *
 * @package lib.model
 */ 
class InstrumentPeer extends BaseInstrumentPeer
{
    public static function getByAuthor($author)
    {
      $c = new Criteria();
      $c->add(InstrumentPeer::AUTHOR_STRIP,$author);
	  if (sfConfig::get('app_universe')) $c->add(InstrumentPeer::SOFTWARE,sfConfig::get('app_tag'));
      $c->addAnd(InstrumentPeer::SHARE,'1');
      $instruments = InstrumentPeer::doSelect($c);

      return $instruments;
    }

    public static function getByAuthorNoStrip($author)
    {
      $c = new Criteria();
      $c->add(InstrumentPeer::AUTHOR,$author);
	  if (sfConfig::get('app_universe')) $c->add(InstrumentPeer::SOFTWARE,sfConfig::get('app_tag'));
      $c->addAnd(InstrumentPeer::SHARE,'1');
      $instruments = InstrumentPeer::doSelect($c);

      return $instruments;
    }

	public static function getByBank($bank_id) {
      $c = new Criteria();
	  $c->addJoin(InstrumentBankPeer::INSTRUMENT_ID, InstrumentPeer::ID);
      $c->add(InstrumentBankPeer::BANK_ID,$bank_id);
      $c->addAnd(InstrumentPeer::SHARE,'1');
      $instruments = InstrumentPeer::doSelect($c);

      return $instruments;
	}
	
	public static function getByType($type,$page=1) {
	  $pager = new sfPropelPager('Instrument', sfConfig::get('app_pager_homepage_max'));
      $c = new Criteria();
      $c->add(InstrumentPeer::TYPE,$type);
      $c->addAnd(InstrumentPeer::SHARE,'1');
	  $pager->setCriteria($c);
	  $pager->setPage($page);
	  $pager->init();

      return $pager;
	}

  public static function retrieveWhereIn($where) {
      $c = new Criteria();
      $c->add(InstrumentPeer::ID,$where,Criteria::IN);
	  if (sfConfig::get('app_universe')) $c->add(InstrumentPeer::SOFTWARE,sfConfig::get('app_tag'));
      $c->addAnd(InstrumentPeer::SHARE,'1');
	  $orderBy = '';
	  foreach($where as $item) {
  		$orderBy .= $item . ',';
	  }
	  $orderBy = ($orderBy)? "FIELD(".InstrumentPeer::ID.",".rtrim($orderBy,',').")":InstrumentPeer::ID;
	  $c->addAscendingOrderByColumn($orderBy);
      $instruments = InstrumentPeer::doSelect($c);

      return $instruments;
  }

  public static function search($phrase, $exact = false, $offset = 0, $max = 10)
  {
    $words    = array_values(myTools::stemPhrase($phrase));
    $nb_words = count($words);

    if (!$words)
    {
      return array();
    }

    $con = Propel::getConnection();
    $query = '
      SELECT DISTINCT %s, COUNT(*) AS nb, SUM(%s) AS total_weight
      FROM %s
	  WHERE
    ';

    $query .= '('.implode(' OR ', array_fill(0, $nb_words, SearchPeer::WORD.' = ?')).')
      GROUP BY %s
    ';

    // AND query?
    if ($exact)
    {
      $query .= ' HAVING nb = '.$nb_words;
    }

    $query .= ' ORDER BY nb DESC, total_weight DESC';

    $query = sprintf($query,
      SearchPeer::INSTRUMENT_ID,
      SearchPeer::WEIGHT,
      SearchPeer::TABLE_NAME,
      SearchPeer::INSTRUMENT_ID
    );

    $stmt = $con->prepareStatement($query);
    $stmt->setOffset($offset);
    $stmt->setLimit($max);
    $placeholder_offset = 1;

    for ($i = 0; $i < $nb_words; $i++)
    {
      $stmt->setString($i + $placeholder_offset, $words[$i]);
    }
    $rs = $stmt->executeQuery(ResultSet::FETCHMODE_NUM);
    $instruments = array();
    while ($rs->next())
    {
	  $instruments[] = $rs->getInt(1);
    }
	$instruments = self::retrieveWhereIn($instruments);

    return $instruments;
  }

public static function getHomepagePager($page)
{
  $pager = new sfPropelPager('Instrument', sfConfig::get('app_pager_homepage_max'));
  $c = new Criteria();
  $USER = sfContext::getInstance()->getUser();
  $c1 = $c->getNewCriterion(InstrumentPeer::OWNER, $USER->getUsername());
  $c2 = $c->getNewCriterion(InstrumentPeer::SHARE, '1');
  $c1->addOr($c2);
  $c->add($c1);
  if (sfConfig::get('app_universe')) $c->add(InstrumentPeer::SOFTWARE,sfConfig::get('app_tag'));
  $c->addDescendingOrderByColumn(self::UPDATED_AT);
  $pager->setCriteria($c);
  $pager->setPage($page);
  $pager->init();
 
  return $pager;
}

public static function getPopularPager($page)
{
  $pager = new sfPropelPager('Instrument', sfConfig::get('app_pager_homepage_max'));
  $c = new Criteria();
  $USER = sfContext::getInstance()->getUser();
  $c1 = $c->getNewCriterion(InstrumentPeer::OWNER, $USER->getUsername());
  $c2 = $c->getNewCriterion(InstrumentPeer::SHARE, '1');
  $c1->addOr($c2);
  $c->add($c1);
  if (sfConfig::get('app_universe')) $c->add(InstrumentPeer::SOFTWARE,sfConfig::get('app_tag'));
  $c->addDescendingOrderByColumn(self::POPULARITY);
  $pager->setCriteria($c);
  $pager->setPage($page);
  $pager->init();
 
  return $pager;
}

public static function getPopularAuthor()
{
  $c = new Criteria();
  if (sfConfig::get('app_universe')) $c->add(InstrumentPeer::SOFTWARE,sfConfig::get('app_tag'));
  $c->addGroupByColumn(self::AUTHOR);
  $c->addDescendingOrderByColumn('count(*)');
  $author = self::doSelect($c);
 
  return $author;
}

public static function getPopularByTag($tag, $page)
{
  $c = new Criteria();
  $c->add(TagsPeer::NORMALIZED, $tag);
  if (sfConfig::get('app_universe')) $c->add(InstrumentPeer::SOFTWARE,sfConfig::get('app_tag'));
  $c->addJoin(TagsPeer::INSTRUMENT_ID, InstrumentPeer::ID, Criteria::LEFT_JOIN);
 
  $pager = new sfPropelPager('Instrument', sfConfig::get('app_pager_homepage_max'));
  $pager->setCriteria($c);
  $pager->setPage($page);
  $pager->init();
 
  return $pager;
}

public static function retrieveByName($name,$author) {
    $c = new Criteria();
    $c->add(InstrumentPeer::STRIPPED, $name);
    $c->addAnd(InstrumentPeer::AUTHOR_STRIP, $author);

    return InstrumentPeer::doSelectOne($c);
}

public static function addLike($instrument) {
  $count = $instrument->getPopularity() + 1;
  $instrument->setPopularity($count);
  $instrument->save();
}

}
