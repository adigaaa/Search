<?php

/*$keyword = 'if';
function search($filename){
	global $keyword;
	$filename =  fopen(__DIR__.'/'.$filename,'r');
	 $content =stream_get_contents($filename);
	 $result = strpos($result,$keyword);
	 fclose($filename);
	 return $result  !== false? true : false;
}

$dir = 'murad/';
if (is_dir($dir)) {
	
	$result =  glob($dir."*.{txt}",GLOB_BRACE);
	var_dump($result);
	$result =  array_filter($result,'search');
	var_dump($result);
}
*/
$word = 'Hello';
function search($path){
	$folder = new RecursiveDirectoryIterator($path);
	$folder->setFlags(FilesystemIterator::SKIP_DOTS | FilesystemIterator::UNIX_PATHS);
	$callback = new RecursiveCallbackFilterIterator($folder, function($current,$key,$iterator){
		global $word;
		if ($iterator->hasChildren()) {
			return true;
		}

		$content =  file_get_contents($current->getPathname());
		if (stripos($content,$word) !== false) {
			return true;
		}
	});
	$callback = new RecursiveIteratorIterator($callback);
	foreach ($callback  as $value) {
	 echo 	'<br><b>'.$value->getFilename().'</b><br>';
	 echo file_get_contents($value->getPathname());
	}
}
$start = microtime(true);
search('murad');
echo  '<br>';
echo  microtime(true)-$start;