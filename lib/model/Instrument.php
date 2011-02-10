<?php

/**
 * Subclass for representing a row from the 'Instrument' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Instrument extends BaseInstrument
{

public function __toString()
{
  return $this->getName();
}

public function getAuthor() {
  return htmlentities(parent::getAuthor());
}

public function save($con = null)
{
  $con = sfContext::getInstance()->getDatabaseConnection('propel');
  try
  {
    $con->begin();
 
    $ret = parent::save($con);
    $this->updateSearchIndex();
 
    $con->commit();
 
    return $ret;
  }
  catch (Exception $e)
  {
    $con->rollback();
    throw $e;
  }
}
 
public function updateSearchIndex()
{
  // delete existing Search entries
  $c = new Criteria();
  $c->add(SearchPeer::INSTRUMENT_ID, $this->getId());
  SearchPeer::doDelete($c);
 
  // create a new entry for each of the words of the question
  foreach ($this->getWords() as $word => $weight)
  {
    $index = new Search();
    $index->setInstrumentId($this->getId());
    $index->setWord($word);
    $index->setWeight($weight);
    $index->save();
  }
}
 
public function getWords()
{
  // add weight
  $raw_text =  str_repeat(' '.strip_tags($this->getDescription()), sfConfig::get('app_search_body_weight'));
  $raw_text .= str_repeat(' '.$this->getName(), sfConfig::get('app_search_title_weight'));
 
  // title and body stemming
  $stemmed_words = myTools::stemPhrase($raw_text);
 
  // unique words with weight
  $words = array_count_values($stemmed_words);
 
  // add tags
  $max = 0;
  foreach ($this->getPopularTags(20) as $tag => $count)
  {
    if (!$max)
    {
      $max = $count;
    }
 
    $stemmed_tag = PorterStemmer::stem($tag);
 
    if (!isset($words[$stemmed_tag]))
    {
      $words[$stemmed_tag] = 0;
    }
    $words[$stemmed_tag] += ceil(($count / $max) * sfConfig::get('app_search_tag_weight'));
  }
 
  return $words;
}

public function setOwner($v)
{
  $author = ($this->getAuthor() == "") ? $v : $this->getAuthor();
  parent::setOwner($v);
  $this->setAuthor($author);
}

public function setName($v)
{
  parent::setName($v);
  $stripped = myTools::url_encode($v);
  $this->setStripped($stripped);
}

public function setAuthor($v) {
  parent::setAuthor($v);
  $stripped = myTools::url_encode($v);
  $this->setAuthorStrip($stripped);
}

public function addTagsForUser($phrase, $userId)
{
  // split phrase into individual tags
  $tags = Tag::splitPhrase($phrase);
 
  // add tags
  foreach ($tags as $tag)
  {
    $instrumentTag = new Tags();
    $instrumentTag->setInstrumentId($this->getId());
    $instrumentTag->setUserId($userId);
    $instrumentTag->setTag($tag);
    $instrumentTag->save();
  }
}
public function getPopularTags($max = 5)
{ //gets most popular tags to display on homepage while listing instruments
  $tags = array();
 
  $con = Propel::getConnection();
  $query = '
    SELECT %s AS tag, COUNT(%s) AS count
    FROM %s
    WHERE %s = ?
    GROUP BY %s
    ORDER BY count DESC
  ';
 
  $query = sprintf($query,
    TagsPeer::NORMALIZED,
    TagsPeer::NORMALIZED,
    TagsPeer::TABLE_NAME,
    TagsPeer::INSTRUMENT_ID,
    TagsPeer::NORMALIZED
  );
 
  $stmt = $con->prepareStatement($query);
  $stmt->setInt(1, $this->getId());
  $stmt->setLimit($max);
  $rs = $stmt->executeQuery();
  while ($rs->next())
  {
    $tags[$rs->getString('tag')] = $rs->getInt('count');
  }
 
  return $tags;
}
public function getTags()
{
  $c = new Criteria();
  $c->clearSelectColumns();
  $c->addSelectColumn(TagsPeer::NORMALIZED);
  $c->add(TagsPeer::INSTRUMENT_ID, $this->getId());
  $c->setDistinct();
  $c->addAscendingOrderByColumn(TagsPeer::NORMALIZED);
 
  $tags = array();
  $rs = TagsPeer::doSelectRS($c);
  while ($rs->next())
  {
    $tags[] = $rs->getString(1);
  }
 
  return $tags;
}

public function getLink() {
  return link_to(substr(parent::getName(),0,32),'@instrument?author='.parent::getAuthorStrip().'&name='.parent::getStripped());
}
}
