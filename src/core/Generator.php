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

		if($this->sp->get("dayOfWeek") == $this->dayOfWeek){
			die("already commited today so not doing again\n");
		}

		$this->wordmap = json_decode(file_get_contents(__DIR__."/wordmap.json"),true);
		$this->recoverIfPossible();

	}

	private function recoverIfPossible(){

		if(!$this->sp->isEmpty()){
			if($this->sentence == $this->sp->get("sentence")){
				$this->charPosition =  $this->sp->get("charPosition");
				$this->weekNumber =  $this->sp->get("weekNumber");
			}
		}else if($this->dayOfWeek != 0)
			die("not monday, we'll start on monday");
		}

	}

	public function shouldCommit(){
		$shouldCommit = false;

		$currentChar = $this->sentence[$this->charPosition];
		echo "currentChar : $currentChar, weekNumber : $this->weekNumber, dayOfWeek : $this->dayOfWeek\n"; 
		$shouldCommit = $this->wordmap[$currentChar][$this->weekNumber][$this->dayOfWeek];

		$this->updateAndSaveState();
		return $shouldCommit == 1;

	}

	private function updateAndSaveState(){

		if($this->dayOfWeek == 6){
			$this->weekNumber++;

		}

		if($this->weekNumber == 6){
			$this->charPosition++;
			$this->weekNumber = 0;
		}

		$this->sp->put("dayOfWeek", $this->dayOfWeek);
		
		$this->saveState();
	}

	private function saveState(){
		$this->sp->put("sentence", $this->sentence);
		$this->sp->put("weekNumber", $this->weekNumber);
		$this->sp->put("charPosition", $this->charPosition);
	}

}

