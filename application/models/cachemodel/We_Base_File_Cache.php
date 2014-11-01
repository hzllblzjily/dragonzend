<?php

require_once APPLICATION_PATH.'/models/cachemodel/We_Base_Cache.php';


class We_Base_File_Cache extends We_Base_Cache{
    protected  $cache;		//缓存对象
    protected  $key;		//缓存文件key
    protected  $data; 		//缓存数据-目前规定为数组
    
    protected  $cacheFatherDir;   //缓存文件的根目录
    protected  $cacheLifetime;    //缓存文件的生命周期
    protected  $cacheDir;         //缓存文件目录
    public function __construct($dirName,$key) {
    	$this->key = $key;
    
    	$url = constant("APPLICATION_PATH").DIRECTORY_SEPARATOR.'configs'.DIRECTORY_SEPARATOR.'application.ini';
    	$cacheconfig = new Zend_Config_Ini($url, "filecache");
    	$cacheconfig = $cacheconfig->toArray();

    	$this->cacheLifetime = $cacheconfig['lifeTime'];
    	$this->cacheFatherDir = $cacheconfig['dir'];
        $this->cacheDir = $this->cacheFatherDir.$dirName.DIRECTORY_SEPARATOR;
    	
    
    	$frontendOptions = array(
    			'lifeTime' => $this->cacheLifetime , // 两小时的缓存生命期
    			'automatic_serialization' => true
    	);
    
    	$backendOptions = array(
    			'cache_dir' => $this->cacheDir 	// 放缓存文件的目录
    	);
    
    	// 取得一个Zend_Cache_Core 对象
    	$this->cache = Zend_Cache::factory('Core','File',	$frontendOptions,$backendOptions);
    
    }
    
    public function setGlobal($name){
    	Zend_Registry::set($name,$this);
    }
    
    // 设置当前cache的data
    public function setData($data) {
    	$this->data = $data;
    }
    
    // 获取当前cache的data
    public function getData() {
    	return  $this->data;
    }
    
    // 成功返回true
    public function saveData(){
    	if (isset($this->data)) {
    		return $this->cache->save($this->data,$this->key);
    	}else {
    		return false;
    	}
    }
    
    // 成功返回cache，失败返回false
    public function load(){
    	return $this->cache->load($this->key);
    }
    
    // 删除当前
    public function remove(){
    	$this->cache->remove($this->key);
    }
    
    // 删除过期的cache
    public function clean(){
    	$this->cache->clean(Zend_Cache::CLEANING_MODE_OLD);
    }
    
    // 删除所有cache
    public function cleanAll(){
    	$this->cache->clean(Zend_Cache::CLEANING_MODE_ALL);
    }
    
    // 获取缓存内所有id返回数组
    public function getIds(){
    	return $this->cache->getIds();
    }
    
    
}