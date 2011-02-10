<?php

class myUser extends sfBasicSecurityUser
{
public function signIn($user)
{
  $this->setAttribute('subscriber_id', $user->getUsername(), 'subscriber');
  $this->setAuthenticated(true);
  $this->addCredential('subscriber');
  if ($user->getIsAdmin()) $this->addCredential('admin');
  $this->setAttribute('username', $user->getUsername(), 'subscriber');
}
 
public function signOut()
{
  $this->getAttributeHolder()->removeNamespace('subscriber');
  $this->getAttributeHolder()->removeNamespace('admin');
 
  $this->setAuthenticated(false);
  $this->clearCredentials();
}
public function getSubscriberId()
{
  return $this->getAttribute('subscriber_id', '', 'subscriber');
}
 
public function getSubscriber()
{
  return UserPeer::retrieveByPk($this->getSubscriberId());
}
 
public function getUsername()
{
  return $this->getAttribute('username', '', 'subscriber');
}
}
