<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfFeed.
 *
 * based on feedgenerator.py from django project
 *
 * @package    symfony
 * @subpackage addon
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfFeed.class.php 3283 2007-01-15 12:28:15Z fabien $
 */
class sfFeed
{
  protected
    $items = array(),
    $title,
    $link,
    $description,
    $language = 'en',
    $authorEmail,
    $authorName,
    $authorLink,
    $subtitle,
    $categories = array(),
    $feedItemsRouteName = '',
    $feedUrl,
    $encoding = 'UTF-8';

  private
    $context = null;

  /**
   * Retrieve a new sfFeed implementation instance.
   *
   * @param string A sfFeed implementation name.
   *
   * @return sfFeed A sfFeed implementation instance.
   *
   * @throws sfFactoryException If a new syndication feed implementation instance cannot be created.
   */
  public static function newInstance ($class)
  {
    try
    {
      $class = 'sf'.ucfirst($class).'Feed';

      // the class exists
      $object = new $class();

      if (!($object instanceof sfFeed))
      {
          // the class name is of the wrong type
          $error = 'Class "%s" is not of the type sfFeed';
          $error = sprintf($error, $class);

          throw new sfFactoryException($error);
      }

      $object->context = sfContext::getInstance();

      return $object;
    }
    catch (sfException $e)
    {
      $e->printStackTrace();
    }
  }

  public function addItem($item)
  {
    $this->items[] = $item;
  }

  public function setItems($items)
  {
    $this->items = $items;
  }

  public function getItems()
  {
    return $this->items;
  }

  public function addItemFromArray($item_array)
  {
    $item = new sfFeedItem();

    $item->setTitle(isset($item_array['title']) ? $item_array['title'] : '');
    $item->setLink(isset($item_array['link']) ? $item_array['link'] : '');
    $item->setDescription(isset($item_array['description']) ? $item_array['description'] : '');
    $item->setAuthorEmail(isset($item_array['authorEmail']) ? $item_array['authorEmail'] : '');
    $item->setAuthorName(isset($item_array['authorName']) ? $item_array['authorName'] : '');
    $item->setAuthorLink(isset($item_array['authorLink']) ? $item_array['authorLink'] : '');
    $item->setPubdate(isset($item_array['pubdate']) ? $item_array['pubdate'] : '');
    $item->setComments(isset($item_array['comments']) ? $item_array['comments'] : '');
    $item->setUniqueId(isset($item_array['uniqueId']) ? $item_array['uniqueId'] : '');
    $item->setEnclosure(isset($item_array['enclosure']) ? $item_array['enclosure'] : '');
    $item->setCategories(isset($item_array['categories']) ? $item_array['categories'] : '');

    $this->items[] = $item;
  }

  public function getFeed()
  {
    throw new sfException('You must use newInstance to get a real feed.');
  }

  public function setFeedItemsRouteName($routeName)
  {
    $this->feedItemsRouteName = $routeName;
  }

  public function getFeedItemsRouteName()
  {
    return $this->feedItemsRouteName;
  }

  public function setTitle ($title)
  {
    $this->title = $title;
  }

  public function getTitle ()
  {
    return $this->title;
  }

  public function setLink ($link)
  {
    $this->link = $link;
  }

  public function getLink ()
  {
    return $this->link;
  }

  public function setDescription ($description)
  {
    $this->description = $description;
  }

  public function getDescription ()
  {
    return $this->description;
  }

  public function setLanguage ($language)
  {
    $this->language = $language;
  }

  public function getLanguage ()
  {
    return $this->language;
  }

  public function setAuthorEmail ($authorEmail)
  {
    $this->authorEmail = $authorEmail;
  }

  public function getAuthorEmail ()
  {
    return $this->authorEmail;
  }

  public function setAuthorName ($authorName)
  {
    $this->authorName = $authorName;
  }

  public function getAuthorName ()
  {
    return $this->authorName;
  }

  public function setAuthorLink ($authorLink)
  {
    $this->authorLink = $authorLink;
  }

  public function getAuthorLink ()
  {
    return $this->authorLink;
  }

  public function setSubtitle ($subtitle)
  {
    $this->subtitle = $subtitle;
  }

  public function getSubtitle ()
  {
    return $this->subtitle;
  }

  public function setFeedUrl ($feedUrl)
  {
    $this->feedUrl = $feedUrl;
  }

  public function getFeedUrl ()
  {
    return $this->feedUrl;
  }

  public function setCategories ($categories)
  {
    $this->categories = $categories;
  }

  public function getCategories ()
  {
    return $this->categories;
  }

  // item feed methods
  public function getItemFeedTitle ($item)
  {
    foreach (array('getFeedTitle', 'getTitle', 'getName', '__toString') as $methodName)
    {
      if (method_exists($item, $methodName))
      {
        return $item->$methodName();
      }
    }

    return '';
  }

  public function getItemFeedDescription ($item)
  {
    foreach (array('getFeedDescription', 'getDescription', 'getBody') as $methodName)
    {
      if (method_exists($item, $methodName))
      {
        return $item->$methodName();
      }
    }

    return '';
  }

  public function getItemFeedLink ($item)
  {
    if ($routeName = $this->getFeedItemsRouteName())
    {
      $routing = sfRouting::getInstance();
      $route = $routing->getRouteByName($routeName);

      $url = $route[0];
      $defaults = $route[4];

      // we get all parameters
      $params = array();
      if (preg_match_all('/\:([^\/]+)/', $url, $matches))
      {
        foreach ($matches[1] as $paramName)
        {
          $value = null;
          $name = ucfirst(sfInflector::camelize($paramName));

          $found = false;
          foreach (array('getFeed'.$name, 'get'.$name) as $methodName)
          {
            if (method_exists($item, $methodName))
            {
              $value = $item->$methodName();
              $found = true;
              break;
            }
          }

          if (!$found)
          {
            if (array_key_exists($paramName, $defaults))
            {
              $value = $defaults[$paramName];
            }
            else
            {
              $error = 'Cannot find a "getFeed%s()" or "get%s()" method for object "%s" to generate URL with the "%s" route';
              $error = sprintf($error, $name, $name, get_class($item), $routeName);
              throw new sfException($error);
            }
          }

          $params[] = $paramName.'='.$value;
        }
      }

      return $this->context->getController()->genUrl($routeName.($params ? '?'.implode('&', $params) : ''), true);
    }

    foreach (array('getFeedLink', 'getLink', 'getUrl') as $methodName)
    {
      if (method_exists($item, $methodName))
      {
        return $this->context->getController()->genUrl($item->$methodName(), true);
      }
    }

    if ($this->getLink())
    {
      return sfContext::getInstance()->getController()->genUrl($this->getLink(), true);
    }
    else
    {
      return $this->context->getController()->genUrl('/', true);
    }
  }

  public function getItemFeedUniqueId ($item)
  {
    foreach (array('getFeedUniqueId', 'getUniqueId', 'getId') as $methodName)
    {
      if (method_exists($item, $methodName))
      {
        return $item->$methodName();
      }
    }

    return '';
  }

  public function getItemFeedAuthorEmail ($item)
  {
    foreach (array('getFeedAuthorEmail', 'getAuthorEmail') as $methodName)
    {
      if (method_exists($item, $methodName))
      {
        return $item->$methodName();
      }
    }

    // author as an object link
    if ($author = $this->getItemFeedAuthor($item))
    {
      foreach (array('getEmail', 'getMail') as $methodName)
      {
        if (method_exists($author, $methodName))
        {
          return $author->$methodName();
        }
      }
    }

    return '';
  }

  public function getItemFeedAuthorName ($item)
  {
    foreach (array('getFeedAuthorName', 'getAuthorName') as $methodName)
    {
      if (method_exists($item, $methodName))
      {
        return $item->$methodName();
      }
    }

    // author as an object link
    if ($author = $this->getItemFeedAuthor($item))
    {
      foreach (array('getName', '__toString') as $methodName)
      {
        if (method_exists($author, $methodName))
        {
          return $author->$methodName();
        }
      }
    }

    return '';
  }

  public function getItemFeedAuthorLink ($item)
  {
    foreach (array('getFeedAuthorLink', 'getAuthorLink') as $methodName)
    {
      if (method_exists($item, $methodName))
      {
        return $item->$methodName();
      }
    }

    // author as an object link
    if ($author = $this->getItemFeedAuthor($item))
    {
      foreach (array('getLink') as $methodName)
      {
        if (method_exists($author, $methodName))
        {
          return $author->$methodName();
        }
      }
    }

    return '';
  }

  public function getItemFeedPubdate ($item)
  {
    foreach (array('getFeedPubdate', 'getPubdate', 'getCreatedAt', 'getDate') as $methodName)
    {
      if (method_exists($item, $methodName))
      {
        return $item->$methodName('U');
      }
    }

    return '';
  }

  public function getItemFeedComments ($item)
  {
    foreach (array('getFeedComments', 'getComments') as $methodName)
    {
      if (method_exists($item, $methodName))
      {
        return $item->$methodName();
      }
    }

    return '';
  }

  public function getItemFeedCategories ($item)
  {
    foreach (array('getFeedCategories', 'getCategories') as $methodName)
    {
      if (method_exists($item, $methodName) && is_object($item->$methodName()))
      {
        // categories as an object
        $categories = $item->$methodName();
        if (is_array($categories))
        {
          $cats = array();
          foreach ($categories as $category)
          {
            $cats[] = (string) $category;
          }

          return $cats;
        }
      }
    }

    return array();
  }

  public function getContext()
  {
    return $this->context;
  }

  public function getEncoding()
  {
    return $this->encoding;
  }

  public function setEncoding($encoding)
  {
    $this->encoding = $encoding;
  }

  private function getItemFeedAuthor ($item)
  {
    foreach (array('getAuthor', 'getUser', 'getPerson') as $methodName)
    {
      if (method_exists($item, $methodName) && is_object($item->$methodName()))
      {
        return $item->$methodName();
      }
    }

    return null;
  }
}

?>