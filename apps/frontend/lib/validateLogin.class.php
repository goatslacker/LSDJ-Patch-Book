<?php
 
class validateLogin extends sfValidator
{    
  public function initialize($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);
 
    // set defaults
    $this->setParameter('login_error', 'Invalid input');
 
    $this->getParameterHolder()->add($parameters);
 
    return true;
  }
 
  public function execute(&$value, &$error)
  {
    $password_param = $this->getParameter('password');
    $password = $this->getContext()->getRequest()->getParameter($password_param);
 
    $login = $value;
 
    // anonymous is not a real user
    if ($login == 'anonymous')
    {
      $error = $this->getParameter('login_error');
      return false;
    }

  // <!-- 8bc connect
	define('POSTURL', 'http://8bitcollective.com/forums/login.php?action=in&8bcConnect=true');
  define('POSTVARS', "req_username={$login}&req_password={$password}&form_sent=true");  // POST VARIABLES TO BE SENT

	$ch = curl_init(POSTURL);
	curl_setopt($ch, CURLOPT_POST      ,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS    ,POSTVARS);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
	curl_setopt($ch, CURLOPT_HEADER      ,0);  // DO NOT RETURN HTTP HEADERS
	curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
	$xml = curl_exec($ch);

	$data = myTools::Xml2Array($xml); //var_dump($data);

	if ($data['user']['authenticated'] == "true") {
	  $user = UserPeer::retrieveByPk($data['user']['username']);
	  $change = false;

	  if ($user == NULL) {
		$user = new User;
		$user->setUsername($data['user']['username']);
		$change = true;
	  }

	  if ($user->getDescription() != substr($data['user']['description'],0,500)) {
		$user->setDescription(substr($data['user']['description'],0,500));
		$change = true;
	  }
	  if ($user->getRealname() != $data['user']['name']) {
		$user->setRealname($data['user']['name']); 
		$change = true;
	  }
	  if ($user->getLocation() != $data['user']['location']) {
		$user->setLocation($data['user']['location']); 
		$change = true;
	  }
	  if ($user->getAvatar() != $data['user']['avatar']) {
		$user->setAvatar($data['user']['avatar']);
		$change = true;
	  }

	  if ($change == true) $user->save();
	  
	  //  user sign in.
	  $this->getContext()->getUser()->signIn($user);
	  return true;
	}
  // -->

    $error = $this->getParameter('login_error');
    return false;
  }
}
