<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage addon
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfFeedEnclosure.class.php 1406 2006-06-09 12:55:59Z fabien $
 */
class sfFeedEnclosure
{
  private
    $url,
    $length,
    $mimeType;

  public function setUrl ($url)
  {
    $this->url = $url;
  }

  public function getUrl ()
  {
    return $this->url;
  }

  public function setLength ($length)
  {
    $this->length = $length;
  }

  public function getLength ()
  {
    return $this->length;
  }

  public function setMimeType ($mimeType)
  {
    $this->mimeType = $mimeType;
  }

  public function getMimeType ()
  {
    return $this->mimeType;
  }
}

?>