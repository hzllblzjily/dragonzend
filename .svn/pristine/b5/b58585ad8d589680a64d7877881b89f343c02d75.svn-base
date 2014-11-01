<?php



class EasemobHelper
{
	//解析环信返回,status为－1表示未知错误，0表示环信返回error，error描述在message内，1表示正确，数据在data内是数组
	static public function resolveResponse($data){
		$res = array();
		if($data == null){
			$res['status'] = -1;
			$res['message'] = 'unknow error,data=null';
			$res['data'] = null;
			return $res;
		}
		$return_Array = json_decode($data,true);
	
		if(!is_array($return_Array) ){
			$res['status'] = -1;
			$res['message'] = 'unknow error,data='.$data;
			$res['data'] = null;
		}else{
			if(array_key_exists('error',$return_Array)){	
				$res['status'] = 0;
				$res['message'] = $return_Array['error_description'];
				$res['data'] = $return_Array;
			}else{
				$res['status'] = 1;
				$res['message'] = 'success';
				$res['data'] = $return_Array;
			}
		}
	
	
		return $res;
	}
}