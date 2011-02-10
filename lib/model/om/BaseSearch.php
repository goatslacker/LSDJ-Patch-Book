<?php


abstract class BaseSearch extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $instrument_id;


	
	protected $word;


	
	protected $weight = 0;


	
	protected $id;

	
	protected $aInstrument;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getInstrumentId()
	{

		return $this->instrument_id;
	}

	
	public function getWord()
	{

		return $this->word;
	}

	
	public function getWeight()
	{

		return $this->weight;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setInstrumentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->instrument_id !== $v) {
			$this->instrument_id = $v;
			$this->modifiedColumns[] = SearchPeer::INSTRUMENT_ID;
		}

		if ($this->aInstrument !== null && $this->aInstrument->getId() !== $v) {
			$this->aInstrument = null;
		}

	} 
	
	public function setWord($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->word !== $v) {
			$this->word = $v;
			$this->modifiedColumns[] = SearchPeer::WORD;
		}

	} 
	
	public function setWeight($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->weight !== $v || $v === 0) {
			$this->weight = $v;
			$this->modifiedColumns[] = SearchPeer::WEIGHT;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = SearchPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->instrument_id = $rs->getInt($startcol + 0);

			$this->word = $rs->getString($startcol + 1);

			$this->weight = $rs->getInt($startcol + 2);

			$this->id = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Search object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SearchPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SearchPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SearchPeer::DATABASE_NAME);
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


												
			if ($this->aInstrument !== null) {
				if ($this->aInstrument->isModified()) {
					$affectedRows += $this->aInstrument->save($con);
				}
				$this->setInstrument($this->aInstrument);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SearchPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SearchPeer::doUpdate($this, $con);
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


												
			if ($this->aInstrument !== null) {
				if (!$this->aInstrument->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInstrument->getValidationFailures());
				}
			}


			if (($retval = SearchPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SearchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getInstrumentId();
				break;
			case 1:
				return $this->getWord();
				break;
			case 2:
				return $this->getWeight();
				break;
			case 3:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SearchPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getInstrumentId(),
			$keys[1] => $this->getWord(),
			$keys[2] => $this->getWeight(),
			$keys[3] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SearchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setInstrumentId($value);
				break;
			case 1:
				$this->setWord($value);
				break;
			case 2:
				$this->setWeight($value);
				break;
			case 3:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SearchPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setInstrumentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setWord($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setWeight($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setId($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SearchPeer::DATABASE_NAME);

		if ($this->isColumnModified(SearchPeer::INSTRUMENT_ID)) $criteria->add(SearchPeer::INSTRUMENT_ID, $this->instrument_id);
		if ($this->isColumnModified(SearchPeer::WORD)) $criteria->add(SearchPeer::WORD, $this->word);
		if ($this->isColumnModified(SearchPeer::WEIGHT)) $criteria->add(SearchPeer::WEIGHT, $this->weight);
		if ($this->isColumnModified(SearchPeer::ID)) $criteria->add(SearchPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SearchPeer::DATABASE_NAME);

		$criteria->add(SearchPeer::ID, $this->id);

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

		$copyObj->setInstrumentId($this->instrument_id);

		$copyObj->setWord($this->word);

		$copyObj->setWeight($this->weight);


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
			self::$peer = new SearchPeer();
		}
		return self::$peer;
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