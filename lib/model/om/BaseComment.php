<?php


abstract class BaseComment extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $instrument_id;


	
	protected $author = 'anonymous';


	
	protected $comment;


	
	protected $created_at;

	
	protected $aInstrument;

	
	protected $aUser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getInstrumentId()
	{

		return $this->instrument_id;
	}

	
	public function getAuthor()
	{

		return $this->author;
	}

	
	public function getComment()
	{

		return $this->comment;
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

	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = CommentPeer::ID;
		}

	} 
	
	public function setInstrumentId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->instrument_id !== $v) {
			$this->instrument_id = $v;
			$this->modifiedColumns[] = CommentPeer::INSTRUMENT_ID;
		}

		if ($this->aInstrument !== null && $this->aInstrument->getId() !== $v) {
			$this->aInstrument = null;
		}

	} 
	
	public function setAuthor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->author !== $v || $v === 'anonymous') {
			$this->author = $v;
			$this->modifiedColumns[] = CommentPeer::AUTHOR;
		}

		if ($this->aUser !== null && $this->aUser->getUsername() !== $v) {
			$this->aUser = null;
		}

	} 
	
	public function setComment($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->comment !== $v) {
			$this->comment = $v;
			$this->modifiedColumns[] = CommentPeer::COMMENT;
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
			$this->modifiedColumns[] = CommentPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->instrument_id = $rs->getInt($startcol + 1);

			$this->author = $rs->getString($startcol + 2);

			$this->comment = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Comment object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CommentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CommentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(CommentPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CommentPeer::DATABASE_NAME);
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
					$pk = CommentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CommentPeer::doUpdate($this, $con);
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


			if (($retval = CommentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getInstrumentId();
				break;
			case 2:
				return $this->getAuthor();
				break;
			case 3:
				return $this->getComment();
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
		$keys = CommentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getInstrumentId(),
			$keys[2] => $this->getAuthor(),
			$keys[3] => $this->getComment(),
			$keys[4] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setInstrumentId($value);
				break;
			case 2:
				$this->setAuthor($value);
				break;
			case 3:
				$this->setComment($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CommentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setInstrumentId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAuthor($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setComment($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CommentPeer::DATABASE_NAME);

		if ($this->isColumnModified(CommentPeer::ID)) $criteria->add(CommentPeer::ID, $this->id);
		if ($this->isColumnModified(CommentPeer::INSTRUMENT_ID)) $criteria->add(CommentPeer::INSTRUMENT_ID, $this->instrument_id);
		if ($this->isColumnModified(CommentPeer::AUTHOR)) $criteria->add(CommentPeer::AUTHOR, $this->author);
		if ($this->isColumnModified(CommentPeer::COMMENT)) $criteria->add(CommentPeer::COMMENT, $this->comment);
		if ($this->isColumnModified(CommentPeer::CREATED_AT)) $criteria->add(CommentPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CommentPeer::DATABASE_NAME);

		$criteria->add(CommentPeer::ID, $this->id);

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

		$copyObj->setAuthor($this->author);

		$copyObj->setComment($this->comment);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new CommentPeer();
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
			$this->setAuthor('anonymous');
		} else {
			$this->setAuthor($v->getUsername());
		}


		$this->aUser = $v;
	}


	
	public function getUser($con = null)
	{
		if ($this->aUser === null && (($this->author !== "" && $this->author !== null))) {
						include_once 'lib/model/om/BaseUserPeer.php';

			$this->aUser = UserPeer::retrieveByPK($this->author, $con);

			
		}
		return $this->aUser;
	}

} 