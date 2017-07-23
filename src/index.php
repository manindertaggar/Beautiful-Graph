<?php
require __DIR__.'/../vendor/autoload.php';
use Graph\core\Generator;

$word = "Maninder";
$generator = new Generator($word);

$commitsCount = 1;
$date = date('d-m-y');
if($generator->shouldCommit()==true){
	$commitsCount = 5;	
}

for($commitNumber=0;$commitNumber<$commitsCount;$commitNumber++){
	$text =  $date."->Working on ( $commitNumber ) \n".PHP_EOL;
	echo $text;
	file_put_contents('readme.md', $text , FILE_APPEND | LOCK_EX);
	shell_exec("git add --all");
	shell_exec("git commit -m \"$commitNumber on $date\"");
}

shell_exec("git push origin master");	
echo "code pushed";
