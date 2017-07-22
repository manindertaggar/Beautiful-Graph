<?php
require __DIR__.'/../vendor/autoload.php';
use Graph\core\Generator;

$word = "Pawan";
$generator = new Generator($word);

while(true){
	echo $generator->getNext();
	readline();
}
