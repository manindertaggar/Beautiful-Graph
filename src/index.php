<?php
require __DIR__.'/../vendor/autoload.php';
use Graph\core\Generator;

$word = "bawan";
$generator = new Generator($word);

while(true){
	echo $generator->getNext()==true?"true":"false";
	readline();
}
