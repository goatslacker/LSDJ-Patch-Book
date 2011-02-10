<?php


abstract class BaseInstrumentBank extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $bank_id;


	
	protected $instrument_id;

	
	protected $aBank;

	
	protected $aInstrument;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getBankId()
	{

		return $this->bank_id;
	}

	
	public function getInstrumentId()
	{

		return $this->instrument_id;
	}

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = InstrumentBankPeer::ID;
		}

	} 
	
	public function setBankId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->bank_id !== $v) {
			$this->bank_id = $v;
			$this->modifiedColumns[] = InstrumentBankPeer::BANK_ID;
		}

		if ($this->aBank !== null && $this->aBank->getId() !== $v) {
			$this->aBank = null;
		}

	} 
	
	public function setInstrumentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->instrument_id !== $v) {
			$this->instrument_id = $v;
			$this->modifiedColumns[] = InstrumentBankPeer::INSTRUMENT_ID;
		}

		if ($this->aInstrument !== null && $this->aInstrument->getId() !== $v) {
			$this->aInstrument = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->bank_id = $rs->getInt($startcol + 1);

			$this->instrument_id = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InstrumentBank object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(InstrumentBankPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InstrumentBankPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(InstrumentBankPeer::DATABASE_NAME);
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


												
			if ($this->aBank !== null) {
				if ($this->aBank->isModified()) {
					$affectedRows += $this->aBank->save($con);
				}
				$this->setBank($this->aBank);
			}

			if ($this->aInstrument !== null) {
				if ($this->aInstrument->isModified()) {
					$affectedRows += $this->aInstrument->save($con);
				}
				$this->setInstrument($this->aInstrument);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InstrumentBankPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += InstrumentBankPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


												
			if ($this->aBank !== null) {
				if (!$this->aBank->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBank->getValidationFailures());
				}
			}

			if ($this->aInstrument !== null) {
				if (!$this->aInstrument->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInstrument->getValidationFailures());
				}
			}


			if (($retval = InstrumentBankPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InstrumentBankPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getBankId();
				break;
			case 2:
				return $this->getInstrumentId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InstrumentBankPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getBankId(),
			$keys[2] => $this->getInstrumentId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InstrumentBankPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setBankId($value);
				break;
			case 2:
				$this->setInstrumentId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InstrumentBankPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setBankId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setInstrumentId($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InstrumentBankPeer::DATABASE_NAME);

		if ($this->isColumnModified(InstrumentBankPeer::ID)) $criteria->add(InstrumentBankPeer::ID, $this->id);
		if ($this->isColumnModified(InstrumentBankPeer::BANK_ID)) $criteria->add(InstrumentBankPeer::BANK_ID, $this->bank_id);
		if ($this->isColumnModified(InstrumentBankPeer::INSTRUMENT_ID)) $criteria->add(InstrumentBankPeer::INSTRUMENT_ID, $this->instrument_id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InstrumentBankPeer::DATABASE_NAME);

		$criteria->add(InstrumentBankPeer::ID, $this->id);

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

		$copyObj->setBankId($this->bank_id);

		$copyObj->setInstrumentId($this->instrument_id);


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
			self::$peer = new InstrumentBankPeer();
		}
		return self::$peer;
	}

	
	public function setBank($v)
	{


		if ($v === null) {
			$this->setBankId(NULL);
		} else {
			$this->setBankId($v->getId());
		}


		$this->aBank = $v;
	}


	
	public function getBank($con = null)
	{
		if ($this->aBank === null && ($this->bank_id !== null)) {
						include_once 'lib/model/om/BaseBankPeer.php';

			$this->aBank = BankPeer::retrieveByPK($this->bank_id, $con);

			
		}
		return $this->aBank;
	}

	
	public function setInstrument($v)
	{


		if ($v === null) {
			$this->setInstrumentId(NULL);
		} else {
			$this->setInstrumentId($v->getId());
		}


		$this->aInstrument = $v;
	}


	
	public function getInstrument($con = null)
	{
		if ($this->aInstrument === null && ($this->instrument_id !== null)) {
						include_once 'lib/model/om/BaseInstrumentPeer.php';

			$this->aInstrument = InstrumentPeer::retrieveByPK($this->instrument_id, $con);

			
		}
		return $this->aInstrument;
	}

} 