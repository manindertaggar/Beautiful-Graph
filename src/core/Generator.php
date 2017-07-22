<?php
namespace Graph\core;

class Generator{
	private $sentence;
	private $wordmap;

	public function __construct($sentence){
		$this->sentence = $sentence;
		$this->wordmap = json_decode(__DIR__."/wordmap.json",true );
	}


	public function getNext(){
		$shouldPrint = true;
		//TODO: add your code here

		return $shouldPrint;
	}


}