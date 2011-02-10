<?php

/**
 * user actions.
 *
 * @package    lsdj-patches
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class userActions extends autouserActions
{

public function executeEdit() {
  $this->forward404Unless(false);
}

}
