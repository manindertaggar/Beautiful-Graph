<?php
namespace Graph\core;

use Graph\storage\SharedPreferences;

class Generator{
	private $sentence;
	private $wordmap;
	private $sp;
	private $location;
	private $row; 

	public function __construct($sentence, $location = 0){
		$this->sentence=$sentence;
		$this->row = date("N", time())-1;
		$this->location = $location;
		$this->sp = new SharedPreferences("Generator");
		$this->wordmap = json_decode(__DIR__."/wordmap.json", true);
		$this->recoverIfPossible();
	}

	private function recoverIfPossible(){

		if(!$this->sp->isEmpty() && $this->sentence == $this->sp->get("sentence")){
			$this->location =  $this->sp->get("location");
		}

	}

	public function getNext(){
		$shouldPrint = true;
		//TODO: add your code here

		
		$this->updateAndSaveState();
		return $shouldPrint;
	}

	private function updateAndSaveState(){
		$this->location++;
		if($this->location > 5)
			$this->location = 0;
		$this->saveState();
	}

	private function saveState(){
		$this->sp->put("sentence", $this->sentence);
		$this->sp->put("location", $this->location);
	}


}