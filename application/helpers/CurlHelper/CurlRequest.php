<?php
class CurlRequest
{
	/**
	 * @name 成员变量
	 */
	// param
	protected $url;         // url参数
	protected $data;        // data参数
	// request
	protected $request_url              = '';       // 请求地址
	protected $request_data             = array();  // 请求参数
	protected $request_timeout          = 30;       // 请求超时时间(单位秒)  0为无限等待
	
	protected $isJson = false;
	protected $jsonOption = null;
	protected $header = null;
	
	public function header($header){
		$this->header = $header;
	}

	/**
	* @name 请求地址
	* @param $url
	*/
	public function url($url)
	{
	   $this->url   = $url;

	   $parseUrl   = parse_url($url);
// 	   $this->request_url   = '';
// 	   $this->request_url   .= $parseUrl['scheme']=='https' ? 'https://' : 'http://';
// 	   $this->request_url   .= $parseUrl['host'];
// 	   $this->request_url   .= $parseUrl['path'];
// 	   $this->request_url   .= $parseUrl['port'] ? ':'.$parseUrl['port'] : ':80';
	   $this->request_url = $url;
	   
//	   parse_str($parseUrl['query'], $parseStr);
//	   $this->request_data  = array_merge($this->request_data, $parseStr);

	   return $this;
	}

	/**
	* @name 请求数据
	* @param $data 为数组
	*/
	public function data($data,$isJson=false,$jsonOption=null)
	{
	   if($data != null && count($data) > 0){
	       $this->request_data = array_merge($this->request_data, $data);
	   }

	   $this->isJson = $isJson;
	   $this->jsonOption = $jsonOption;
	   return $this;
	}

	/**
	* @name 请求超时时间
	* @param $timeout 超时， 当timeout 为0 或 flase时， 类为多线程执行
	*/
	public function timeout($timeout)
	{
	// $this->request_timeout    = (int)$timeout==0 ? 1 : (int)$timeout;
	$this->request_timeout   = (int)$timeout;
	return $this;
	}

	/**
	* @name get请求
	* @return mixed [status, data]
	*/
	public function get()
		{
		// 1. 初始化
		$ch = curl_init();
		
		// 2. 设置选项，包括URL
		if($this->request_data == null || count($this->request_data ) <= 0){
		    $url = $this->request_url;
		}else{
		    if($this->isJson){
		        $jsonData = json_encode($this->request_data,$this->jsonOption);
		        $url = $this->request_url.'?'.$jsonData;
		    }else{
		        $url = $this->request_url.'?'.http_build_query($this->request_data);
		    }

		}

		curl_setopt($ch, CURLOPT_HTTPGET, 1);           // 请求类型 get
		curl_setopt($ch, CURLOPT_URL, $url);            // 请求地址
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    // 将curl_exec()获取的信息以文件流的形式返回,不直接输出。
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->request_timeout);    // 连接等待时间
		curl_setopt($ch, CURLOPT_TIMEOUT, $this->request_timeout);           // curl允许执行时间
		if($this->header != null){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
		}
		// 3. 执行并获取返回内容
		$output = curl_exec($ch);
		if ($output === false)
		{
		$returnData['status']   = 0;
		$returnData['data']     = curl_error($ch);
		}
		else
		{
		$returnData['status']   = 1;
		$returnData['data']     = $output;
		}
		// 4. 释放curl句柄
		curl_close($ch);
		return $returnData;
		}
		
		private function sendRequest($type){
			// 1. 初始化
			$ch = curl_init();
			// 2. 设置选项，包括URL
			if($type == 1){
				curl_setopt($ch, CURLOPT_POST, 1);                  // 请求类型 post
			}else if($type == 2){
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			}else{
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			}

			curl_setopt($ch, CURLOPT_URL, $this->request_url);   // 请求地址
				
			if($this->request_data == null || count($this->request_data ) <= 0){
				 
			}else{
				if($this->isJson){
					$jsonData = json_encode($this->request_data,$this->jsonOption);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);   // 请求数据
				}else{
					curl_setopt($ch, CURLOPT_POSTFIELDS, $this->request_data);   // 请求数据
				}
			}
			
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        // 将curl_exec()获取的信息以文件流的形式返回,不直接输出。
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->request_timeout);    // 连接等待时间
			curl_setopt($ch, CURLOPT_TIMEOUT, $this->request_timeout);           // curl允许执行时间
			if($this->header != null){
				curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
			}
			// 3. 执行并获取返回内容
			$output = curl_exec($ch);
			if ($output === false)
			{
				$returnData['status']   = 0;
				$returnData['data']     = curl_error($ch);
			}
			else
			{
				$returnData['status']   = 1;
				$returnData['data']     = $output;
			}
			// 4. 释放curl句柄
			curl_close($ch);
			return $returnData;
		}
		public function put(){
			return $this->sendRequest(2);
		}
		public function delete(){
			return $this->sendRequest(3);
		}
		
		/**
		* @name post请求
		* @return mixed [status, data]
		*/
		public function post()
		{
			return $this->sendRequest(1);
		}
		
		
        public function curl_download($remote, $local) {
			$cp = curl_init($remote);
			$fp = fopen($local, "w");
		
			curl_setopt($cp, CURLOPT_FILE, $fp);
			curl_setopt($cp, CURLOPT_HEADER, 0);
		
			$output = curl_exec($cp);
			if ($output === false)
			{
			     $returnData['status']   = 0;
			     $returnData['data']     = curl_error($cp);
			}
			else
			{
				 $returnData['status']   = 1;
				 $returnData['data']     = $output;
			}
			curl_close($cp);
			fclose($fp);
			return $returnData;
		}
		
}


