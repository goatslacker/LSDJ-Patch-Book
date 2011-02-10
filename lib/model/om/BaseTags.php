<?php


abstract class BaseTags extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $instrument_id;


	
	protected $user_id;


	
	protected $tag;


	
	protected $normalized;


	
	protected $created_at;

	
	protected $aInstrument;

	
	protected $aUser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getInstrumentId()
	{

		return $this->instrument_id;
	}

	
	public function getUserId()
	{

		return $this->user_id;
	}

	
	public function getTag()
	{

		return $this->tag;
	}

	
	public function getNormalized()
	{

		return $this->normalized;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setInstrumentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->instrument_id !== $v) {
			$this->instrument_id = $v;
			$this->modifiedColumns[] = TagsPeer::INSTRUMENT_ID;
		}

		if ($this->aInstrument !== null && $this->aInstrument->getId() !== $v) {
			$this->aInstrument = null;
		}

	} 
	
	public function setUserId($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = TagsPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getUsername() !== $v) {
			$this->aUser = null;
		}

	} 
	
	public function setTag($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag !== $v) {
			$this->tag = $v;
			$this->modifiedColumns[] = TagsPeer::TAG;
		}

	} 
	
	public function setNormalized($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->normalized !== $v) {
			$this->normalized = $v;
			$this->modifiedColumns[] = TagsPeer::NORMALIZED;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = TagsPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->instrument_id = $rs->getInt($startcol + 0);

			$this->user_id = $rs->getString($startcol + 1);

			$this->tag = $rs->getString($startcol + 2);

			$this->normalized = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Tags object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TagsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TagsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(TagsPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TagsPeer::DATABASE_NAME);
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

			if ($this->aUser !== null) {
				if ($this->aUser->isModified()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TagsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += TagsPeer::doUpdate($this, $con);
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

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}


			if (($retval = TagsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TagsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getInstrumentId();
				break;
			case 1:
				return $this->getUserId();
				break;
			case 2:
				return $this->getTag();
				break;
			case 3:
				return $this->getNormalized();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TagsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getInstrumentId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getTag(),
			$keys[3] => $this->getNormalized(),
			$keys[4] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TagsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setInstrumentId($value);
				break;
			case 1:
				$this->setUserId($value);
				break;
			case 2:
				$this->setTag($value);
				break;
			case 3:
				$this->setNormalized($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TagsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setInstrumentId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTag($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNormalized($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TagsPeer::DATABASE_NAME);

		if ($this->isColumnModified(TagsPeer::INSTRUMENT_ID)) $criteria->add(TagsPeer::INSTRUMENT_ID, $this->instrument_id);
		if ($this->isColumnModified(TagsPeer::USER_ID)) $criteria->add(TagsPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(TagsPeer::TAG)) $criteria->add(TagsPeer::TAG, $this->tag);
		if ($this->isColumnModified(TagsPeer::NORMALIZED)) $criteria->add(TagsPeer::NORMALIZED, $this->normalized);
		if ($this->isColumnModified(TagsPeer::CREATED_AT)) $criteria->add(TagsPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TagsPeer::DATABASE_NAME);

		$criteria->add(TagsPeer::INSTRUMENT_ID, $this->instrument_id);
		$criteria->add(TagsPeer::USER_ID, $this->user_id);
		$criteria->add(TagsPeer::NORMALIZED, $this->normalized);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getInstrumentId();

		$pks[1] = $this->getUserId();

		$pks[2] = $this->getNormalized();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setInstrumentId($keys[0]);

		$this->setUserId($keys[1]);

		$this->setNormalized($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setTag($this->tag);

		$copyObj->setCreatedAt($this->created_at);


		$copyObj->setNew(true);

		$copyObj->setInstrumentId(NULL); 
		$copyObj->setUserId(NULL); 
		$copyObj->setNormalized(NULL); 
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
			self::$peer = new TagsPeer();
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

	
	public function setUser($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getUsername());
		}


		$this->aUser = $v;
	}


	
	public function getUser($con = null)
	{
		if ($this->aUser === null && (($this->user_id !== "" && $this->user_id !== null))) {
						include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUser = UserPeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->aUser;
	}

} 