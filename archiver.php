<?php
$dir = dirname(__FILE__);
$files = scandir($dir);
$script = basename(__FILE__, '.php').'.php';

foreach($files as $key => $filename) {
	
	if ($filename == $script) {
		continue;
	}
	if (is_dir($filename)){
		continue;
	}
	$fileInfo = new SplFileInfo($filename);
	if($fileInfo->getExtension() == 'bz2') {
		continue;
	}
	$bz = bzopen($filename.".bz2", "w");
	bzwrite($bz, file_get_contents($filename));
	bzclose($bz);
	unlink($filename);
}