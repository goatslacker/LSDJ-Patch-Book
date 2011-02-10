<?php


abstract class BaseBank extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $owner;


	
	protected $software = 'LSDJ';


	
	protected $share = true;


	
	protected $updated_at;

	
	protected $aUser;

	
	protected $aWare;

	
	protected $collInstrumentBanks;

	
	protected $lastInstrumentBankCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getOwner()
	{

		return $this->owner;
	}

	
	public function getSoftware()
	{

		return $this->software;
	}

	
	public function getShare()
	{

		return $this->share;
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = BankPeer::ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = BankPeer::NAME;
		}

	} 
	
	public function setOwner($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->owner !== $v) {
			$this->owner = $v;
			$this->modifiedColumns[] = BankPeer::OWNER;
		}

		if ($this->aUser !== null && $this->aUser->getUsername() !== $v) {
			$this->aUser = null;
		}

	} 
	
	public function setSoftware($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->software !== $v || $v === 'LSDJ') {
			$this->software = $v;
			$this->modifiedColumns[] = BankPeer::SOFTWARE;
		}

		if ($this->aWare !== null && $this->aWare->getSoft() !== $v) {
			$this->aWare = null;
		}

	} 
	
	public function setShare($v)
	{

		if ($this->share !== $v || $v === true) {
			$this->share = $v;
			$this->modifiedColumns[] = BankPeer::SHARE;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = BankPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->owner = $rs->getString($startcol + 2);

			$this->software = $rs->getString($startcol + 3);

			$this->share = $rs->getBoolean($startcol + 4);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Bank object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BankPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BankPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(BankPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BankPeer::DATABASE_NAME);
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


												
			if ($this->aUser !== null) {
				if ($this->aUser->isModified()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}

			if ($this->aWare !== null) {
				if ($this->aWare->isModified()) {
					$affectedRows += $this->aWare->save($con);
				}
				$this->setWare($this->aWare);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = BankPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += BankPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collInstrumentBanks !== null) {
				foreach($this->collInstrumentBanks as $referrerFK) {
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


												
			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}

			if ($this->aWare !== null) {
				if (!$this->aWare->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWare->getValidationFailures());
				}
			}


			if (($retval = BankPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInstrumentBanks !== null) {
					foreach($this->collInstrumentBanks as $referrerFK) {
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
		$pos = BankPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getOwner();
				break;
			case 3:
				return $this->getSoftware();
				break;
			case 4:
				return $this->getShare();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BankPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getOwner(),
			$keys[3] => $this->getSoftware(),
			$keys[4] => $this->getShare(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BankPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setOwner($value);
				break;
			case 3:
				$this->setSoftware($value);
				break;
			case 4:
				$this->setShare($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BankPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setOwner($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSoftware($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setShare($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(BankPeer::DATABASE_NAME);

		if ($this->isColumnModified(BankPeer::ID)) $criteria->add(BankPeer::ID, $this->id);
		if ($this->isColumnModified(BankPeer::NAME)) $criteria->add(BankPeer::NAME, $this->name);
		if ($this->isColumnModified(BankPeer::OWNER)) $criteria->add(BankPeer::OWNER, $this->owner);
		if ($this->isColumnModified(BankPeer::SOFTWARE)) $criteria->add(BankPeer::SOFTWARE, $this->software);
		if ($this->isColumnModified(BankPeer::SHARE)) $criteria->add(BankPeer::SHARE, $this->share);
		if ($this->isColumnModified(BankPeer::UPDATED_AT)) $criteria->add(BankPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BankPeer::DATABASE_NAME);

		$criteria->add(BankPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setOwner($this->owner);

		$copyObj->setSoftware($this->software);

		$copyObj->setShare($this->share);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getInstrumentBanks() as $relObj) {
				$copyObj->addInstrumentBank($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
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
			self::$peer = new BankPeer();
		}
		return self::$peer;
	}

	
	public function setUser($v)
	{


		if ($v === null) {
			$this->setOwner(NULL);
		} else {
			$this->setOwner($v->getUsername());
		}


		$this->aUser = $v;
	}


	
	public function getUser($con = null)
	{
		if ($this->aUser === null && (($this->owner !== "" && $this->owner !== null))) {
						include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUser = UserPeer::retrieveByPK($this->owner, $con);

			
		}
		return $this->aUser;
	}

	
	public function setWare($v)
	{


		if ($v === null) {
			$this->setSoftware('LSDJ');
		} else {
			$this->setSoftware($v->getSoft());
		}


		$this->aWare = $v;
	}


	
	public function getWare($con = null)
	{
		if ($this->aWare === null && (($this->software !== "" && $this->software !== null))) {
						include_once 'lib/model/om/BaseWarePeer.php';

			$this->aWare = WarePeer::retrieveByPK($this->software, $con);

			
		}
		return $this->aWare;
	}

	
	public function initInstrumentBanks()
	{
		if ($this->collInstrumentBanks === null) {
			$this->collInstrumentBanks = array();
		}
	}

	
	public function getInstrumentBanks($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInstrumentBankPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInstrumentBanks === null) {
			if ($this->isNew()) {
			   $this->collInstrumentBanks = array();
			} else {

				$criteria->add(InstrumentBankPeer::BANK_ID, $this->getId());

				InstrumentBankPeer::addSelectColumns($criteria);
				$this->collInstrumentBanks = InstrumentBankPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InstrumentBankPeer::BANK_ID, $this->getId());

				InstrumentBankPeer::addSelectColumns($criteria);
				if (!isset($this->lastInstrumentBankCriteria) || !$this->lastInstrumentBankCriteria->equals($criteria)) {
					$this->collInstrumentBanks = InstrumentBankPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInstrumentBankCriteria = $criteria;
		return $this->collInstrumentBanks;
	}

	
	public function countInstrumentBanks($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseInstrumentBankPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InstrumentBankPeer::BANK_ID, $this->getId());

		return InstrumentBankPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInstrumentBank(InstrumentBank $l)
	{
		$this->collInstrumentBanks[] = $l;
		$l->setBank($this);
	}


	
	public function getInstrumentBanksJoinInstrument($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInstrumentBankPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInstrumentBanks === null) {
			if ($this->isNew()) {
				$this->collInstrumentBanks = array();
			} else {

				$criteria->add(InstrumentBankPeer::BANK_ID, $this->getId());

				$this->collInstrumentBanks = InstrumentBankPeer::doSelectJoinInstrument($criteria, $con);
			}
		} else {
									
			$criteria->add(InstrumentBankPeer::BANK_ID, $this->getId());

			if (!isset($this->lastInstrumentBankCriteria) || !$this->lastInstrumentBankCriteria->equals($criteria)) {
				$this->collInstrumentBanks = InstrumentBankPeer::doSelectJoinInstrument($criteria, $con);
			}
		}
		$this->lastInstrumentBankCriteria = $criteria;

		return $this->collInstrumentBanks;
	}

} 