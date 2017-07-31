<?php
require __DIR__.'/../vendor/autoload.php';
use Graph\core\Generator;

$word = "bawan";
$generator = new Generator($word);

echo $generator->getNext()==true?"true":"false";
