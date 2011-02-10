<?php


abstract class BaseUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $username;


	
	protected $stripped;


	
	protected $realname;


	
	protected $description;


	
	protected $avatar;


	
	protected $location;


	
	protected $is_admin = false;

	
	protected $collInstruments;

	
	protected $lastInstrumentCriteria = null;

	
	protected $collTagss;

	
	protected $lastTagsCriteria = null;

	
	protected $collComments;

	
	protected $lastCommentCriteria = null;

	
	protected $collBanks;

	
	protected $lastBankCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getUsername()
	{

		return $this->username;
	}

	
	public function getStripped()
	{

		return $this->stripped;
	}

	
	public function getRealname()
	{

		return $this->realname;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getAvatar()
	{

		return $this->avatar;
	}

	
	public function getLocation()
	{

		return $this->location;
	}

	
	public function getIsAdmin()
	{

		return $this->is_admin;
	}

	
	public function setUsername($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->username !== $v) {
			$this->username = $v;
			$this->modifiedColumns[] = UserPeer::USERNAME;
		}

	} 
	
	public function setStripped($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stripped !== $v) {
			$this->stripped = $v;
			$this->modifiedColumns[] = UserPeer::STRIPPED;
		}

	} 
	
	public function setRealname($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->realname !== $v) {
			$this->realname = $v;
			$this->modifiedColumns[] = UserPeer::REALNAME;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = UserPeer::DESCRIPTION;
		}

	} 
	
	public function setAvatar($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->avatar !== $v) {
			$this->avatar = $v;
			$this->modifiedColumns[] = UserPeer::AVATAR;
		}

	} 
	
	public function setLocation($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->location !== $v) {
			$this->location = $v;
			$this->modifiedColumns[] = UserPeer::LOCATION;
		}

	} 
	
	public function setIsAdmin($v)
	{

		if ($this->is_admin !== $v || $v === false) {
			$this->is_admin = $v;
			$this->modifiedColumns[] = UserPeer::IS_ADMIN;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->username = $rs->getString($startcol + 0);

			$this->stripped = $rs->getString($startcol + 1);

			$this->realname = $rs->getString($startcol + 2);

			$this->description = $rs->getString($startcol + 3);

			$this->avatar = $rs->getString($startcol + 4);

			$this->location = $rs->getString($startcol + 5);

			$this->is_admin = $rs->getBoolean($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating User object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += UserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collInstruments !== null) {
				foreach($this->collInstruments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTagss !== null) {
				foreach($this->collTagss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collComments !== null) {
				foreach($this->collComments as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collBanks !== null) {
				foreach($this->collBanks as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInstruments !== null) {
					foreach($this->collInstruments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTagss !== null) {
					foreach($this->collTagss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collComments !== null) {
					foreach($this->collComments as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collBanks !== null) {
					foreach($this->collBanks as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUsername();
				break;
			case 1:
				return $this->getStripped();
				break;
			case 2:
				return $this->getRealname();
				break;
			case 3:
				return $this->getDescription();
				break;
			case 4:
				return $this->getAvatar();
				break;
			case 5:
				return $this->getLocation();
				break;
			case 6:
				return $this->getIsAdmin();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUsername(),
			$keys[1] => $this->getStripped(),
			$keys[2] => $this->getRealname(),
			$keys[3] => $this->getDescription(),
			$keys[4] => $this->getAvatar(),
			$keys[5] => $this->getLocation(),
			$keys[6] => $this->getIsAdmin(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUsername($value);
				break;
			case 1:
				$this->setStripped($value);
				break;
			case 2:
				$this->setRealname($value);
				break;
			case 3:
				$this->setDescription($value);
				break;
			case 4:
				$this->setAvatar($value);
				break;
			case 5:
				$this->setLocation($value);
				break;
			case 6:
				$this->setIsAdmin($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUsername($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setStripped($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRealname($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescription($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAvatar($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLocation($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsAdmin($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserPeer::USERNAME)) $criteria->add(UserPeer::USERNAME, $this->username);
		if ($this->isColumnModified(UserPeer::STRIPPED)) $criteria->add(UserPeer::STRIPPED, $this->stripped);
		if ($this->isColumnModified(UserPeer::REALNAME)) $criteria->add(UserPeer::REALNAME, $this->realname);
		if ($this->isColumnModified(UserPeer::DESCRIPTION)) $criteria->add(UserPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(UserPeer::AVATAR)) $criteria->add(UserPeer::AVATAR, $this->avatar);
		if ($this->isColumnModified(UserPeer::LOCATION)) $criteria->add(UserPeer::LOCATION, $this->location);
		if ($this->isColumnModified(UserPeer::IS_ADMIN)) $criteria->add(UserPeer::IS_ADMIN, $this->is_admin);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		$criteria->add(UserPeer::USERNAME, $this->username);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getUsername();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setUsername($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setStripped($this->stripped);

		$copyObj->setRealname($this->realname);

		$copyObj->setDescription($this->description);

		$copyObj->setAvatar($this->avatar);

		$copyObj->setLocation($this->location);

		$copyObj->setIsAdmin($this->is_admin);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getInstruments() as $relObj) {
				$copyObj->addInstrument($relObj->copy($deepCopy));
			}

			foreach($this->getTagss() as $relObj) {
				$copyObj->addTags($relObj->copy($deepCopy));
			}

			foreach($this->getComments() as $relObj) {
				$copyObj->addComment($relObj->copy($deepCopy));
			}

			foreach($this->getBanks() as $relObj) {
				$copyObj->addBank($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setUsername(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UserPeer();
		}
		return self::$peer;
	}

	
	public function initInstruments()
	{
		if ($this->collInstruments === null) {
			$this->collInstruments = array();
		}
	}

	
	public function getInstruments($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInstrumentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInstruments === null) {
			if ($this->isNew()) {
			   $this->collInstruments = array();
			} else {

				$criteria->add(InstrumentPeer::OWNER, $this->getUsername());

				InstrumentPeer::addSelectColumns($criteria);
				$this->collInstruments = InstrumentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InstrumentPeer::OWNER, $this->getUsername());

				InstrumentPeer::addSelectColumns($criteria);
				if (!isset($this->lastInstrumentCriteria) || !$this->lastInstrumentCriteria->equals($criteria)) {
					$this->collInstruments = InstrumentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInstrumentCriteria = $criteria;
		return $this->collInstruments;
	}

	
	public function countInstruments($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseInstrumentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InstrumentPeer::OWNER, $this->getUsername());

		return InstrumentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInstrument(Instrument $l)
	{
		$this->collInstruments[] = $l;
		$l->setUser($this);
	}


	
	public function getInstrumentsJoinWare($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInstrumentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInstruments === null) {
			if ($this->isNew()) {
				$this->collInstruments = array();
			} else {

				$criteria->add(InstrumentPeer::OWNER, $this->getUsername());

				$this->collInstruments = InstrumentPeer::doSelectJoinWare($criteria, $con);
			}
		} else {
									
			$criteria->add(InstrumentPeer::OWNER, $this->getUsername());

			if (!isset($this->lastInstrumentCriteria) || !$this->lastInstrumentCriteria->equals($criteria)) {
				$this->collInstruments = InstrumentPeer::doSelectJoinWare($criteria, $con);
			}
		}
		$this->lastInstrumentCriteria = $criteria;

		return $this->collInstruments;
	}

	
	public function initTagss()
	{
		if ($this->collTagss === null) {
			$this->collTagss = array();
		}
	}

	
	public function getTagss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTagsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTagss === null) {
			if ($this->isNew()) {
			   $this->collTagss = array();
			} else {

				$criteria->add(TagsPeer::USER_ID, $this->getUsername());

				TagsPeer::addSelectColumns($criteria);
				$this->collTagss = TagsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TagsPeer::USER_ID, $this->getUsername());

				TagsPeer::addSelectColumns($criteria);
				if (!isset($this->lastTagsCriteria) || !$this->lastTagsCriteria->equals($criteria)) {
					$this->collTagss = TagsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTagsCriteria = $criteria;
		return $this->collTagss;
	}

	
	public function countTagss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseTagsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TagsPeer::USER_ID, $this->getUsername());

		return TagsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTags(Tags $l)
	{
		$this->collTagss[] = $l;
		$l->setUser($this);
	}


	
	public function getTagssJoinInstrument($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTagsPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTagss === null) {
			if ($this->isNew()) {
				$this->collTagss = array();
			} else {

				$criteria->add(TagsPeer::USER_ID, $this->getUsername());

				$this->collTagss = TagsPeer::doSelectJoinInstrument($criteria, $con);
			}
		} else {
									
			$criteria->add(TagsPeer::USER_ID, $this->getUsername());

			if (!isset($this->lastTagsCriteria) || !$this->lastTagsCriteria->equals($criteria)) {
				$this->collTagss = TagsPeer::doSelectJoinInstrument($criteria, $con);
			}
		}
		$this->lastTagsCriteria = $criteria;

		return $this->collTagss;
	}

	
	public function initComments()
	{
		if ($this->collComments === null) {
			$this->collComments = array();
		}
	}

	
	public function getComments($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collComments === null) {
			if ($this->isNew()) {
			   $this->collComments = array();
			} else {

				$criteria->add(CommentPeer::AUTHOR, $this->getUsername());

				CommentPeer::addSelectColumns($criteria);
				$this->collComments = CommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CommentPeer::AUTHOR, $this->getUsername());

				CommentPeer::addSelectColumns($criteria);
				if (!isset($this->lastCommentCriteria) || !$this->lastCommentCriteria->equals($criteria)) {
					$this->collComments = CommentPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCommentCriteria = $criteria;
		return $this->collComments;
	}

	
	public function countComments($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CommentPeer::AUTHOR, $this->getUsername());

		return CommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addComment(Comment $l)
	{
		$this->collComments[] = $l;
		$l->setUser($this);
	}


	
	public function getCommentsJoinInstrument($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCommentPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collComments === null) {
			if ($this->isNew()) {
				$this->collComments = array();
			} else {

				$criteria->add(CommentPeer::AUTHOR, $this->getUsername());

				$this->collComments = CommentPeer::doSelectJoinInstrument($criteria, $con);
			}
		} else {
									
			$criteria->add(CommentPeer::AUTHOR, $this->getUsername());

			if (!isset($this->lastCommentCriteria) || !$this->lastCommentCriteria->equals($criteria)) {
				$this->collComments = CommentPeer::doSelectJoinInstrument($criteria, $con);
			}
		}
		$this->lastCommentCriteria = $criteria;

		return $this->collComments;
	}

	
	public function initBanks()
	{
		if ($this->collBanks === null) {
			$this->collBanks = array();
		}
	}

	
	public function getBanks($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseBankPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBanks === null) {
			if ($this->isNew()) {
			   $this->collBanks = array();
			} else {

				$criteria->add(BankPeer::OWNER, $this->getUsername());

				BankPeer::addSelectColumns($criteria);
				$this->collBanks = BankPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(BankPeer::OWNER, $this->getUsername());

				BankPeer::addSelectColumns($criteria);
				if (!isset($this->lastBankCriteria) || !$this->lastBankCriteria->equals($criteria)) {
					$this->collBanks = BankPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastBankCriteria = $criteria;
		return $this->collBanks;
	}

	
	public function countBanks($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseBankPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(BankPeer::OWNER, $this->getUsername());

		return BankPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBank(Bank $l)
	{
		$this->collBanks[] = $l;
		$l->setUser($this);
	}


	
	public function getBanksJoinWare($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseBankPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBanks === null) {
			if ($this->isNew()) {
				$this->collBanks = array();
			} else {

				$criteria->add(BankPeer::OWNER, $this->getUsername());

				$this->collBanks = BankPeer::doSelectJoinWare($criteria, $con);
			}
		} else {
									
			$criteria->add(BankPeer::OWNER, $this->getUsername());

			if (!isset($this->lastBankCriteria) || !$this->lastBankCriteria->equals($criteria)) {
				$this->collBanks = BankPeer::doSelectJoinWare($criteria, $con);
			}
		}
		$this->lastBankCriteria = $criteria;

		return $this->collBanks;
	}

} 