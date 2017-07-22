<?php
namespace Graph\core;

class Generator{
	private $sentence;
	private $wordmap;
	private $sentence_char_count=0;
	private $arr_count=0;
	private $arr_data_count=0;

	public function __construct($sentence){
		$this->sentence = $sentence;
		$this->wordmap = json_decode(file_get_contents(__DIR__."/wordmap.json"),true);
	}
	
	public function getNext(){

		
		if(!($this->sentence_char_count >= count($this->sentence))){
			$this->str_upper = strtoupper($this->sentence);
			$this->single_char = $this->str_upper[$this->sentence_char_count];
			$result = $this->wordmap[$this->single_char][$this->arr_count][$this->arr_data_count];
			echo "result: $this->single_char  $this->arr_count $this->arr_data_count";
			$result = $result==1;
			$this->arr_data_count++;
			
			if($this->arr_data_count == 7){
				$this->arr_data_count = 0;
				$this->arr_count++;
			}

			if($this->arr_count == 6){
				$this->arr_count=0;
				$this->sentence_char_count++;
			}
			return $result;
		}
	}
	
}


