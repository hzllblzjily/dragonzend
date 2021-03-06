<?php

require_once APPLICATION_PATH.'/helpers/WeException.php';
require_once APPLICATION_PATH.'/helpers/Constant.php';

class QueryCondition
{
	public $where;
	
	public $order;
	
	public $top;
	
	public $skip;
	
	public $params;         //where语句内对应的参数绑定
	
	public $selects;        //要select出来的字段
	
	public static function getConditionFromRequest($jsonStr)
	{
		$jsonObject = json_decode($jsonStr);
		if(!isset($jsonObject->where))
		{
			$jsonObject->where = null;
		}
		if(!isset($jsonObject->order))
		{
			$jsonObject->order = null;
		}
		if(!isset($jsonObject->top))
		{
			$jsonObject->top = null;
		}
		if(!isset($jsonObject->skip))
		{
			$jsonObject->skip = null;
		}
		if(!isset($jsonObject->params))
		{
			$jsonObject->params = null;
		}
		if(!isset($jsonObject->selects))
		{
			$jsonObject->selects = null;
		}
		return $jsonObject;
	}
	
	public static function isParamValid($str)
	{
		$logger = Zend_Registry::get('log');

		if($str === null)
		{
			return;
		}
			if(strpos($str, '\'')!==false ||
					strpos($str, '"')!==false  ||
					//strpos($str, '/')!==false  ||
					strpos($str, '\\')!==false  ||
					strpos($str, '#')!==false  ||
					strpos($str, '*')!==false  ||
					strpos($str, ';')!==false )
			{
					
				$logger->log('str = '.$str.' is not valid', Zend_Log::ERR);
				$e = new WeException(20101);
				throw $e;
			}
		
	}
	
	public static function isValid($condition)
	{
		$logger = Zend_Registry::get('log');
// 		if($condition->where == null)
// 		{
// 			$logger->log('query condition where should not be null', Zend_Log::ERR);
// 			$e = new RxtException(20101);
// 			throw $e;
// 		}
		if(isset($condition->where))
		{
			$where = $condition->where;
			if(strpos($where, '\'')!==false ||
					strpos($where, '"')!==false  ||
					strpos($where, '/')!==false  ||
					strpos($where, '\\')!==false  ||
					strpos($where, '#')!==false  ||
					strpos($where, '*')!==false  ||
					strpos($where, ';')!==false )
			{
					
				$logger->log('query condition where = '.$where.' is not valid', Zend_Log::ERR);
				$e = new WeException(20101);
				throw $e;
			}
		}
		
		if(isset($condition->order))
		{
			$order = $condition->order;
			if(strpos($order, '\'')!==false ||
					strpos($order, '"')!==false  ||
					strpos($order, '/')!==false  ||
					strpos($order, '\\')!==false  ||
					strpos($order, '#')!==false  ||
					strpos($order, '*')!==false  ||
					strpos($order, ';')!==false )
			{
					
				$logger->log('query condition order = '.$order.' is not valid', Zend_Log::ERR);
				$e = new WeException(20101);
				throw $e;
			}
		}
		if(isset($condition->top))
		{
			$top = $condition->top;
			if(strpos($top, '\'')!==false ||
					strpos($top, '"')!==false  ||
					strpos($top, '/')!==false  ||
					strpos($top, '\\')!==false  ||
					strpos($top, '#')!==false  ||
					strpos($top, '*')!==false  ||
					strpos($top, ';')!==false )
			{
					
				$logger->log('query condition top = '.$top.' is not valid', Zend_Log::ERR);
				$e = new WeException(20101);
				throw $e;
			}
			if ($top > MAX_BASE_TOP_NUMBER) {
				$logger->log('top is too big', Zend_Log::ERR);
				$e = new WeException(20106);
				throw $e;
			}
		}
		if(isset($condition->skip))
		{
			$skip = $condition->where;
			if(strpos($skip, '\'')!==false ||
					strpos($skip, '"')!==false  ||
					strpos($skip, '/')!==false  ||
					strpos($skip, '\\')!==false  ||
					strpos($skip, '#')!==false  ||
					strpos($skip, '*')!==false  ||
					strpos($skip, ';')!==false )
			{
					
				$logger->log('query condition skip = '.$skip.' is not valid', Zend_Log::ERR);
				$e = new WeException(20101);
				throw $e;
			}
		}
		if(isset($condition->selects))
		{
			$selects = $condition->selects;
			if(count($selects) > 0)
			{
				foreach($selects as $key=>$value)
				{
					if(strpos($value, '\'')!==false ||
							strpos($value, '"')!==false  ||
							strpos($value, '/')!==false  ||
							strpos($value, '\\')!==false  ||
							strpos($value, '#')!==false  ||
							strpos($value, '*')!==false  ||
							strpos($value, ';')!==false )
					{
							
						$logger->log('query condition select = '.$value.' is not valid', Zend_Log::ERR);
						$e = new WeException(20101);
						throw $e;
					}
				}
			}

		}
		

		
	}
}




?>