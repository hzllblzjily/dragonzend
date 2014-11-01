<?php



require_once APPLICATION_PATH.'/helpers/QueryCondition.php';
require_once APPLICATION_PATH.'/helpers/WeException.php';
abstract class We_Base_Table extends Zend_Db_Table_Abstract {
	
	
	//插入数组对应的ROW数据
	public function insert(array $data)
	{
		return parent::insert($data);
		
	}
	
	//根据ID更新数据
	public function update(array $data, $id)
	{
		if(is_array($this->_primary)){
			$where = $this->getAdapter()->quoteInto($this->_primary[1].' = ?', $id);
		}else{
			$where = $this->getAdapter()->quoteInto($this->_primary.' = ?', $id);
		}	
		return parent::update($data, $where);
	}
	
	//根据ID删除数据
	public function delete($id)
	{
		if(is_array($this->_primary)){
			$where = $this->getAdapter()->quoteInto($this->_primary[1].' = ?', $id);
		}else{
			$where = $this->getAdapter()->quoteInto($this->_primary.' = ?', $id);
		}	

		return parent::delete($where);
	}
	
	
	//主键查询
	public function findById($id)
	{
// 	    if(is_array($this->_primary)){
// 	    	$key = $this->_primary[1];
// 	    }else{
// 	    	$key = $this->_primary;
// 	    }
// 	    return $this->fetchList($key.' = ?', null, null, array($id), null);
        return parent::find($id);
	}
	
	//select for update
	public function findForUpdate($id)
	{
	
	   if(is_array($this->_primary)){
            $key = $this->_primary[1];
        }else{
            $key = $this->_primary;
        }
        return $this->fetchList(null,null,null,$key.' = ?', array($id),null,null,null,true);
	
	}
	
	
	//list操作
	public function fetchList($selects,$tableAlias,$join,$where,$params, $order, $top, $skip,$isForUpdate = false)
	{
	    
		$logger = Zend_Registry::get('log');
// 		$logger->log("begin fetch all where = ".$where, Zend_Log::DEBUG);
// 		$logger->log("begin fetch all where = ".'\'', Zend_Log::DEBUG);
		
		//判断是否有SQL注入的非法字符存在
		QueryCondition::isParamValid($join);
		QueryCondition::isParamValid($tableAlias);
		QueryCondition::isParamValid($where);
		QueryCondition::isParamValid($order);
		QueryCondition::isParamValid($top);
		QueryCondition::isParamValid($skip);
		if($selects != null){
		    if(count($selects) > 0)
		    {
		    	foreach($selects as $key=>$value)
		    	{
		    		QueryCondition::isParamValid($value);
		    	}
		    }
		}


		
		$questionCount = substr_count($where,'?');
		$paramCount = count($params);
		if($questionCount !== $paramCount)
		{
			$logger->log("invalid param count when fetchAll".$questionCount.$paramCount, Zend_Log::ERR);
			$e =  new WeException('20101');
			throw $e;
		}
		
		$queryStr = 'select ';
		
		if($selects===null || count($selects) == 0)
		{
			$queryStr = $queryStr.' * ';
		}
		else
		{
			$index = 0;
			foreach($selects as $key=>$value)
			{
				if($index == 0)
				{
					$queryStr = $queryStr.' '.$value;
				}
				else
				{
					$queryStr = $queryStr.', '.$value;
				}
				$index++;
				
			}
		}
		if($tableAlias != null){
		    $queryStr = $queryStr.' from '.$this->_name.' '.$tableAlias.' ';
		}else{
		    $queryStr = $queryStr.' from '.$this->_name;
		}

		
		if($join != null){
		    $queryStr = $queryStr.$join.' ';
		}
		if($where !== null)
		{
			$paramArray = array();
			$queryWhereArray = explode('?', $where);
			for($i = 0 ; $i <$questionCount; $i++)
			{
				$queryWhereArray[$i] = $queryWhereArray[$i].':param'.$i;
				$paramArray['param'.$i] = $params[$i];
			}
			$where = null;
			for($i = 0 ; $i <=$questionCount; $i++)
			{
				$where = $where.$queryWhereArray[$i];
			}
			$queryStr = $queryStr.' where '.$where;

			if ($order !== null) {
				$queryStr = $queryStr.' order by '.$order.' ';
			}
			if($top === null || $skip === null)
			{
					
			}
			else
			{
				$queryStr = $queryStr.' limit '.$skip.' ,'.$top;
			}
			if($isForUpdate){
				$queryStr = $queryStr.' for update';
			}
			$logger->log("begin fetch all sql str = ".$queryStr, Zend_Log::DEBUG);

			
			$result = $this->getAdapter()->query($queryStr,$paramArray);
			
		}
		else
		{

			if ($order !== null) {
				$queryStr = $queryStr.' order by '.$order.' ';
			}
			if($top === null || $skip === null)
			{
					
			}
			else
			{
				$queryStr = $queryStr.' limit '.$skip.' ,'.$top;
			}
			if($isForUpdate){
				$queryStr = $queryStr.' for update';
			}
			$logger->log("begin fetch all sql str = ".$queryStr, Zend_Log::DEBUG);
			$result = $this->getAdapter()->query($queryStr);
		}
		
		$rows = $result->fetchAll();
		
		return $rows;
	}
	
	//有多少个符合条件的查询
	public function count($tableAlias, $join,$where, $params)
	{
		$logger = Zend_Registry::get('log');
		
		$db = $this->getAdapter();
		
		QueryCondition::isParamValid($join);
		QueryCondition::isParamValid($where);
		QueryCondition::isParamValid($tableAlias);
		
		$questionCount = substr_count($where,'?');
		$paramCount = count($params);
		if($questionCount !== $paramCount)
		{
			$logger->log("invalid param count when fetchAll".$questionCount.$paramCount, Zend_Log::ERR);
			$e =  new WeException('20101');
			throw $e;
		}
		
		$queryStr = 'select count(*) from '.$this->_name.' '.$tableAlias.' ';
		if($join != null){
		    $queryStr = $queryStr.$join.' ';
		}
		
		if($where !== null)
		{
			$paramArray = array();
			$queryWhereArray = explode('?', $where);
			
			for($i = 0 ; $i <$questionCount; $i++)
			{
				$queryWhereArray[$i] = $queryWhereArray[$i].':param'.$i;
				$paramArray['param'.$i] = $params[$i];
			}
			$where = null;
			for($i = 0 ; $i <=$questionCount; $i++)
			{
				$where = $where.$queryWhereArray[$i];
			}
			
			$queryStr = $queryStr.' where '.$where;


			$logger->log("begin count sql str = ".$queryStr, Zend_Log::DEBUG);
// 			echo $queryStr;
// 			exit;
			$result = $this->getAdapter()->query($queryStr,$paramArray);
			
		}
		else
		{
			$logger->log("begin count sql str = ".$queryStr, Zend_Log::DEBUG);
			$result = $this->getAdapter()->query($queryStr);
		}

		
		$rows = $result->fetchAll();
		return $rows[0]['count(*)'];
	
	}
	
	public function executeQuery($queryStr, $paramArray){
	    $result = $this->getAdapter()->query($queryStr,$paramArray);
	    $rows = $result->fetchAll();
	    return $rows;
	}
	
	public function executeUpdate($updateStr, $paramArray){
		$result = $this->getAdapter()->query($updateStr,$paramArray);
		return $result;

	}
	
}
