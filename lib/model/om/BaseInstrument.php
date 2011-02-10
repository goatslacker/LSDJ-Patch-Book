<?php


abstract class BaseInstrument extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $stripped;


	
	protected $software = 'LSDJ';


	
	protected $type;


	
	protected $description;


	
	protected $object;


	
	protected $owner;


	
	protected $author;


	
	protected $author_strip;


	
	protected $share = true;


	
	protected $popularity = 0;


	
	protected $sample;


	
	protected $updated_at;

	
	protected $aWare;

	
	protected $aUser;

	
	protected $collTagss;

	
	protected $lastTagsCriteria = null;

	
	protected $collSearchs;

	
	protected $lastSearchCriteria = null;

	
	protected $collComments;

	
	protected $lastCommentCriteria = null;

	
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

	
	public function getStripped()
	{

		return $this->stripped;
	}

	
	public function getSoftware()
	{

		return $this->software;
	}

	
	public function getType()
	{

		return $this->type;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getObject()
	{

		return $this->object;
	}

	
	public function getOwner()
	{

		return $this->owner;
	}

	
	public function getAuthor()
	{

		return $this->author;
	}

	
	public function getAuthorStrip()
	{

		return $this->author_strip;
	}

	
	public function getShare()
	{

		return $this->share;
	}

	
	public function getPopularity()
	{

		return $this->popularity;
	}

	
	public function getSample()
	{

		return $this->sample;
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
			$this->modifiedColumns[] = InstrumentPeer::ID;
		}

	} 
	
	public function setName($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = InstrumentPeer::NAME;
		}

	} 
	
	public function setStripped($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stripped !== $v) {
			$this->stripped = $v;
			$this->modifiedColumns[] = InstrumentPeer::STRIPPED;
		}

	} 
	
	public function setSoftware($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->software !== $v || $v === 'LSDJ') {
			$this->software = $v;
			$this->modifiedColumns[] = InstrumentPeer::SOFTWARE;
		}

		if ($this->aWare !== null && $this->aWare->getSoft() !== $v) {
			$this->aWare = null;
		}

	} 
	
	public function setType($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = InstrumentPeer::TYPE;
		}

	} 
	
	public function setDescription($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = InstrumentPeer::DESCRIPTION;
		}

	} 
	
	public function setObject($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object !== $v) {
			$this->object = $v;
			$this->modifiedColumns[] = InstrumentPeer::OBJECT;
		}

	} 
	
	public function setOwner($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->owner !== $v) {
			$this->owner = $v;
			$this->modifiedColumns[] = InstrumentPeer::OWNER;
		}

		if ($this->aUser !== null && $this->aUser->getUsername() !== $v) {
			$this->aUser = null;
		}

	} 
	
	public function setAuthor($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->author !== $v) {
			$this->author = $v;
			$this->modifiedColumns[] = InstrumentPeer::AUTHOR;
		}

	} 
	
	public function setAuthorStrip($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->author_strip !== $v) {
			$this->author_strip = $v;
			$this->modifiedColumns[] = InstrumentPeer::AUTHOR_STRIP;
		}

	} 
	
	public function setShare($v)
	{

		if ($this->share !== $v || $v === true) {
			$this->share = $v;
			$this->modifiedColumns[] = InstrumentPeer::SHARE;
		}

	} 
	
	public function setPopularity($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->popularity !== $v || $v === 0) {
			$this->popularity = $v;
			$this->modifiedColumns[] = InstrumentPeer::POPULARITY;
		}

	} 
	
	public function setSample($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sample !== $v) {
			$this->sample = $v;
			$this->modifiedColumns[] = InstrumentPeer::SAMPLE;
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
			$this->modifiedColumns[] = InstrumentPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->stripped = $rs->getString($startcol + 2);

			$this->software = $rs->getString($startcol + 3);

			$this->type = $rs->getString($startcol + 4);

			$this->description = $rs->getString($startcol + 5);

			$this->object = $rs->getString($startcol + 6);

			$this->owner = $rs->getString($startcol + 7);

			$this->author = $rs->getString($startcol + 8);

			$this->author_strip = $rs->getString($startcol + 9);

			$this->share = $rs->getBoolean($startcol + 10);

			$this->popularity = $rs->getInt($startcol + 11);

			$this->sample = $rs->getString($startcol + 12);

			$this->updated_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Instrument object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(InstrumentPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InstrumentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isModified() && !$this->isColumnModified(InstrumentPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(InstrumentPeer::DATABASE_NAME);
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


												
			if ($this->aWare !== null) {
				if ($this->aWare->isModified()) {
					$affectedRows += $this->aWare->save($con);
				}
				$this->setWare($this->aWare);
			}

			if ($this->aUser !== null) {
				if ($this->aUser->isModified()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InstrumentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += InstrumentPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collTagss !== null) {
				foreach($this->collTagss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSearchs !== null) {
				foreach($this->collSearchs as $referrerFK) {
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


												
			if ($this->aWare !== null) {
				if (!$this->aWare->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWare->getValidationFailures());
				}
			}

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}


			if (($retval = InstrumentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTagss !== null) {
					foreach($this->collTagss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSearchs !== null) {
					foreach($this->collSearchs as $referrerFK) {
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
		$pos = InstrumentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getStripped();
				break;
			case 3:
				return $this->getSoftware();
				break;
			case 4:
				return $this->getType();
				break;
			case 5:
				return $this->getDescription();
				break;
			case 6:
				return $this->getObject();
				break;
			case 7:
				return $this->getOwner();
				break;
			case 8:
				return $this->getAuthor();
				break;
			case 9:
				return $this->getAuthorStrip();
				break;
			case 10:
				return $this->getShare();
				break;
			case 11:
				return $this->getPopularity();
				break;
			case 12:
				return $this->getSample();
				break;
			case 13:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InstrumentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getStripped(),
			$keys[3] => $this->getSoftware(),
			$keys[4] => $this->getType(),
			$keys[5] => $this->getDescription(),
			$keys[6] => $this->getObject(),
			$keys[7] => $this->getOwner(),
			$keys[8] => $this->getAuthor(),
			$keys[9] => $this->getAuthorStrip(),
			$keys[10] => $this->getShare(),
			$keys[11] => $this->getPopularity(),
			$keys[12] => $this->getSample(),
			$keys[13] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InstrumentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setStripped($value);
				break;
			case 3:
				$this->setSoftware($value);
				break;
			case 4:
				$this->setType($value);
				break;
			case 5:
				$this->setDescription($value);
				break;
			case 6:
				$this->setObject($value);
				break;
			case 7:
				$this->setOwner($value);
				break;
			case 8:
				$this->setAuthor($value);
				break;
			case 9:
				$this->setAuthorStrip($value);
				break;
			case 10:
				$this->setShare($value);
				break;
			case 11:
				$this->setPopularity($value);
				break;
			case 12:
				$this->setSample($value);
				break;
			case 13:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InstrumentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStripped($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSoftware($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setType($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDescription($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setObject($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setOwner($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAuthor($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAuthorStrip($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setShare($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setPopularity($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setSample($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InstrumentPeer::DATABASE_NAME);

		if ($this->isColumnModified(InstrumentPeer::ID)) $criteria->add(InstrumentPeer::ID, $this->id);
		if ($this->isColumnModified(InstrumentPeer::NAME)) $criteria->add(InstrumentPeer::NAME, $this->name);
		if ($this->isColumnModified(InstrumentPeer::STRIPPED)) $criteria->add(InstrumentPeer::STRIPPED, $this->stripped);
		if ($this->isColumnModified(InstrumentPeer::SOFTWARE)) $criteria->add(InstrumentPeer::SOFTWARE, $this->software);
		if ($this->isColumnModified(InstrumentPeer::TYPE)) $criteria->add(InstrumentPeer::TYPE, $this->type);
		if ($this->isColumnModified(InstrumentPeer::DESCRIPTION)) $criteria->add(InstrumentPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(InstrumentPeer::OBJECT)) $criteria->add(InstrumentPeer::OBJECT, $this->object);
		if ($this->isColumnModified(InstrumentPeer::OWNER)) $criteria->add(InstrumentPeer::OWNER, $this->owner);
		if ($this->isColumnModified(InstrumentPeer::AUTHOR)) $criteria->add(InstrumentPeer::AUTHOR, $this->author);
		if ($this->isColumnModified(InstrumentPeer::AUTHOR_STRIP)) $criteria->add(InstrumentPeer::AUTHOR_STRIP, $this->author_strip);
		if ($this->isColumnModified(InstrumentPeer::SHARE)) $criteria->add(InstrumentPeer::SHARE, $this->share);
		if ($this->isColumnModified(InstrumentPeer::POPULARITY)) $criteria->add(InstrumentPeer::POPULARITY, $this->popularity);
		if ($this->isColumnModified(InstrumentPeer::SAMPLE)) $criteria->add(InstrumentPeer::SAMPLE, $this->sample);
		if ($this->isColumnModified(InstrumentPeer::UPDATED_AT)) $criteria->add(InstrumentPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InstrumentPeer::DATABASE_NAME);

		$criteria->add(InstrumentPeer::ID, $this->id);

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

		$copyObj->setStripped($this->stripped);

		$copyObj->setSoftware($this->software);

		$copyObj->setType($this->type);

		$copyObj->setDescription($this->description);

		$copyObj->setObject($this->object);

		$copyObj->setOwner($this->owner);

		$copyObj->setAuthor($this->author);

		$copyObj->setAuthorStrip($this->author_strip);

		$copyObj->setShare($this->share);

		$copyObj->setPopularity($this->popularity);

		$copyObj->setSample($this->sample);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getTagss() as $relObj) {
				$copyObj->addTags($relObj->copy($deepCopy));
			}

			foreach($this->getSearchs() as $relObj) {
				$copyObj->addSearch($relObj->copy($deepCopy));
			}

			foreach($this->getComments() as $relObj) {
				$copyObj->addComment($relObj->copy($deepCopy));
			}

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
			self::$peer = new InstrumentPeer();
		}
		return self::$peer;
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

				$criteria->add(TagsPeer::INSTRUMENT_ID, $this->getId());

				TagsPeer::addSelectColumns($criteria);
				$this->collTagss = TagsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TagsPeer::INSTRUMENT_ID, $this->getId());

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

		$criteria->add(TagsPeer::INSTRUMENT_ID, $this->getId());

		return TagsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTags(Tags $l)
	{
		$this->collTagss[] = $l;
		$l->setInstrument($this);
	}


	
	public function getTagssJoinUser($criteria = null, $con = null)
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

				$criteria->add(TagsPeer::INSTRUMENT_ID, $this->getId());

				$this->collTagss = TagsPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(TagsPeer::INSTRUMENT_ID, $this->getId());

			if (!isset($this->lastTagsCriteria) || !$this->lastTagsCriteria->equals($criteria)) {
				$this->collTagss = TagsPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastTagsCriteria = $criteria;

		return $this->collTagss;
	}

	
	public function initSearchs()
	{
		if ($this->collSearchs === null) {
			$this->collSearchs = array();
		}
	}

	
	public function getSearchs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSearchPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSearchs === null) {
			if ($this->isNew()) {
			   $this->collSearchs = array();
			} else {

				$criteria->add(SearchPeer::INSTRUMENT_ID, $this->getId());

				SearchPeer::addSelectColumns($criteria);
				$this->collSearchs = SearchPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SearchPeer::INSTRUMENT_ID, $this->getId());

				SearchPeer::addSelectColumns($criteria);
				if (!isset($this->lastSearchCriteria) || !$this->lastSearchCriteria->equals($criteria)) {
					$this->collSearchs = SearchPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSearchCriteria = $criteria;
		return $this->collSearchs;
	}

	
	public function countSearchs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSearchPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SearchPeer::INSTRUMENT_ID, $this->getId());

		return SearchPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSearch(Search $l)
	{
		$this->collSearchs[] = $l;
		$l->setInstrument($this);
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

				$criteria->add(CommentPeer::INSTRUMENT_ID, $this->getId());

				CommentPeer::addSelectColumns($criteria);
				$this->collComments = CommentPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CommentPeer::INSTRUMENT_ID, $this->getId());

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

		$criteria->add(CommentPeer::INSTRUMENT_ID, $this->getId());

		return CommentPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addComment(Comment $l)
	{
		$this->collComments[] = $l;
		$l->setInstrument($this);
	}


	
	public function getCommentsJoinUser($criteria = null, $con = null)
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

				$criteria->add(CommentPeer::INSTRUMENT_ID, $this->getId());

				$this->collComments = CommentPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(CommentPeer::INSTRUMENT_ID, $this->getId());

			if (!isset($this->lastCommentCriteria) || !$this->lastCommentCriteria->equals($criteria)) {
				$this->collComments = CommentPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastCommentCriteria = $criteria;

		return $this->collComments;
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

				$criteria->add(InstrumentBankPeer::INSTRUMENT_ID, $this->getId());

				InstrumentBankPeer::addSelectColumns($criteria);
				$this->collInstrumentBanks = InstrumentBankPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InstrumentBankPeer::INSTRUMENT_ID, $this->getId());

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

		$criteria->add(InstrumentBankPeer::INSTRUMENT_ID, $this->getId());

		return InstrumentBankPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInstrumentBank(InstrumentBank $l)
	{
		$this->collInstrumentBanks[] = $l;
		$l->setInstrument($this);
	}


	
	public function getInstrumentBanksJoinBank($criteria = null, $con = null)
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

				$criteria->add(InstrumentBankPeer::INSTRUMENT_ID, $this->getId());

				$this->collInstrumentBanks = InstrumentBankPeer::doSelectJoinBank($criteria, $con);
			}
		} else {
									
			$criteria->add(InstrumentBankPeer::INSTRUMENT_ID, $this->getId());

			if (!isset($this->lastInstrumentBankCriteria) || !$this->lastInstrumentBankCriteria->equals($criteria)) {
				$this->collInstrumentBanks = InstrumentBankPeer::doSelectJoinBank($criteria, $con);
			}
		}
		$this->lastInstrumentBankCriteria = $criteria;

		return $this->collInstrumentBanks;
	}

} 