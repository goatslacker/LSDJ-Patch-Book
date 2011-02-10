<?php

/**
 * Subclass for performing query and update operations on the 'Tags' table.
 *
 * 
 *
 * @package lib.model
 */ 
class TagsPeer extends BaseTagsPeer
{
public static function getPopularTags($max = 5)
{ //gets most popular tags alltogether to create a tag cloud
  $tags = array();

  $con = Propel::getConnection();
  $query = '
    SELECT '.TagsPeer::NORMALIZED.' AS tag,
    COUNT('.TagsPeer::NORMALIZED.') AS count
    FROM '.TagsPeer::TABLE_NAME.'
    GROUP BY '.TagsPeer::NORMALIZED.'
    ORDER BY count DESC';

  $stmt = $con->prepareStatement($query);
  $stmt->setLimit($max);
  $rs = $stmt->executeQuery();
  $max_popularity = 0;
  while ($rs->next())
  {
    if (!$max_popularity)
    {
      $max_popularity = $rs->getInt('count');
    }

    $tags[$rs->getString('tag')] = floor(($rs->getInt('count') / $max_popularity * 3) + 1);
  }

  ksort($tags);

  return $tags;
}
}
