<?php
namespace Graph\core;

class Generator{
	private $sentence;
	private $wordmap;

	public function __construct($sentence){
		$this->sentence = $sentence;
		$this->wordmap = json_decode(__DIR__."/wordmap.json");
	}


	public function getNext(){
		$shouldPrint = false;
		//TODO: add your code here

		return $shouldPrint;
	}


}