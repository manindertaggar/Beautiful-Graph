<?php
namespace Graph\core;

use Graph\storage\SharedPreferences;

class Generator{
	private $sentence;
	private $wordmap;
	private $sp;
	private $pixelPosition;
	private $charPosition; 

	public function __construct($sentence, $pixelPosition = 0){
		$this->sentence=$sentence;
		$this->charPosition = date("N", time())-1;
		$this->pixelPosition = $pixelPosition;
		$this->sp = new SharedPreferences("Generator");
		$this->wordmap = json_decode(__DIR__."/wordmap.json", true);
		$this->recoverIfPossible();
	}

	private function recoverIfPossible(){

		if(!$this->sp->isEmpty() && $this->sentence == $this->sp->get("sentence")){
			$this->pixelPosition =  $this->sp->get("pixelPosition");
		}

	}

	public function getNext(){
		$shouldPrint = true;
		//TODO: add your code here		
		$this->updateAndSaveState();
		return $shouldPrint;
	}

	private function updateAndSaveState(){
		$this->pixelPosition++;
		if($this->pixelPosition > 5){
			$this->pixelPosition = 0;
		}
		$this->saveState();
	}

	private function saveState(){
		$this->sp->put("sentence", $this->sentence);
		$this->sp->put("pixelPosition", $this->pixelPosition);
	}


}