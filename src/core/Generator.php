<?php
namespace Graph\core;

use Graph\storage\SharedPreferences;

class Generator{
	private $sentence;
	private $wordmap;
	private $sp;
	private $dayOfWeek = 0;
	private $weekNumber = 0;
	private $charPosition = 0; 


	public function __construct($sentence, $dayOfWeek = 0){
		$this->sentence = strtoupper($sentence);
		$this->dayOfWeek = date("N", time())-1;
		$this->sp = new SharedPreferences("Generator");
		$this->wordmap = json_decode(file_get_contents(__DIR__."/wordmap.json"),true);
		$this->recoverIfPossible();

	}

	private function recoverIfPossible(){

		if(!$this->sp->isEmpty() && $this->sentence == $this->sp->get("sentence")){
			$this->charPosition =  $this->sp->get("charPosition");
			$this->weekNumber =  $this->sp->get("weekNumber");
		}

	}

	public function getNext(){
		$shouldPrint = false;

		$currentChar = $this->sentence[$this->charPosition];
		echo "currentChar : $currentChar, weekNumber : $this->weekNumber, dayOfWeek : $this->dayOfWeek\n"; 
		$shouldPrint = $this->wordmap[$currentChar][$this->weekNumber][$this->dayOfWeek];

		$shouldPrint = $shouldPrint==1;

		$this->updateAndSaveState();
		return $shouldPrint;

	}

	private function updateAndSaveState(){

		if($this->dayOfWeek == 6){
			$this->weekNumber++;

		}

		if($this->weekNumber == 6){
			$this->charPosition++;
			$this->weekNumber = 0;
		}

		$this->saveState();
	}

	private function saveState(){
		$this->sp->put("sentence", $this->sentence);
		$this->sp->put("weekNumber", $this->weekNumber);
		$this->sp->put("charPosition", $this->charPosition);
	}

}

