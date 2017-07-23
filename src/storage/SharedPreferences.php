<?php
namespace Graph\storage;
use Graph\storage\SharedPrefencesLoader;

class SharedPreferences{
	private $data = array();
	private $path;

	public function __construct($key){
		$this->path = __DIR__."/data/".$key.".sp";
	
		if(file_exists($this->path)){
			$this->data = json_decode(file_get_contents($this->path), true);
		}else{
			file_put_contents($this->path, json_encode($this->data));
		}
		
	}

	public function isEmpty(){
		return count($this->data)==0;
	}

	public function put($key, $value){
		$this->data[$key] =  $value;
		file_put_contents($this->path, json_encode($this->data));
	}

	public function get($key){
		if(array_key_exists($key, $this->data))
			return $this->data[$key];
		return false;
	}

}