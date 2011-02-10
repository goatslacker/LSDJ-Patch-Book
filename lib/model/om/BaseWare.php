<?php


abstract class BaseWare extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $soft;


	
	protected $hard;

	
	protected $collInstruments;

	
	protected $lastInstrumentCriteria = null;

	
	protected $collBanks;

	
	protected $lastBankCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getSoft()
	{

		return $this->soft;
	}

	
	public function getHard()
	{

		return $this->hard;
	}

	
	public function setSoft($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->soft !== $v) {
			$this->soft = $v;
			$this->modifiedColumns[] = WarePeer::SOFT;
		}

	} 
	
	public function setHard($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->hard !== $v) {
			$this->hard = $v;
			$this->modifiedColumns[] = WarePeer::HARD;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->soft = $rs->getString($startcol + 0);

			$this->hard = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Ware object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(WarePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			WarePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(WarePeer::DATABASE_NAME);
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
					$pk = WarePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += WarePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collInstruments !== null) {
				foreach($this->collInstruments as $referrerFK) {
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


			if (($retval = WarePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInstruments !== null) {
					foreach($this->collInstruments as $referrerFK) {
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
		$pos = WarePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getSoft();
				break;
			case 1:
				return $this->getHard();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WarePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getSoft(),
			$keys[1] => $this->getHard(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = WarePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setSoft($value);
				break;
			case 1:
				$this->setHard($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = WarePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setSoft($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setHard($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(WarePeer::DATABASE_NAME);

		if ($this->isColumnModified(WarePeer::SOFT)) $criteria->add(WarePeer::SOFT, $this->soft);
		if ($this->isColumnModified(WarePeer::HARD)) $criteria->add(WarePeer::HARD, $this->hard);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(WarePeer::DATABASE_NAME);

		$criteria->add(WarePeer::SOFT, $this->soft);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getSoft();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setSoft($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setHard($this->hard);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getInstruments() as $relObj) {
				$copyObj->addInstrument($relObj->copy($deepCopy));
			}

			foreach($this->getBanks() as $relObj) {
				$copyObj->addBank($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setSoft(NULL); 
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
			self::$peer = new WarePeer();
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

				$criteria->add(InstrumentPeer::SOFTWARE, $this->getSoft());

				InstrumentPeer::addSelectColumns($criteria);
				$this->collInstruments = InstrumentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InstrumentPeer::SOFTWARE, $this->getSoft());

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

		$criteria->add(InstrumentPeer::SOFTWARE, $this->getSoft());

		return InstrumentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInstrument(Instrument $l)
	{
		$this->collInstruments[] = $l;
		$l->setWare($this);
	}


	
	public function getInstrumentsJoinUser($criteria = null, $con = null)
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

				$criteria->add(InstrumentPeer::SOFTWARE, $this->getSoft());

				$this->collInstruments = InstrumentPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(InstrumentPeer::SOFTWARE, $this->getSoft());

			if (!isset($this->lastInstrumentCriteria) || !$this->lastInstrumentCriteria->equals($criteria)) {
				$this->collInstruments = InstrumentPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastInstrumentCriteria = $criteria;

		return $this->collInstruments;
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

				$criteria->add(BankPeer::SOFTWARE, $this->getSoft());

				BankPeer::addSelectColumns($criteria);
				$this->collBanks = BankPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(BankPeer::SOFTWARE, $this->getSoft());

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

		$criteria->add(BankPeer::SOFTWARE, $this->getSoft());

		return BankPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBank(Bank $l)
	{
		$this->collBanks[] = $l;
		$l->setWare($this);
	}


	
	public function getBanksJoinUser($criteria = null, $con = null)
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

				$criteria->add(BankPeer::SOFTWARE, $this->getSoft());

				$this->collBanks = BankPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(BankPeer::SOFTWARE, $this->getSoft());

			if (!isset($this->lastBankCriteria) || !$this->lastBankCriteria->equals($criteria)) {
				$this->collBanks = BankPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastBankCriteria = $criteria;

		return $this->collBanks;
	}

} 