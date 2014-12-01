<?php 

class builder {
	
	public static function get_contents($file) {
		return file_get_contents($file);
	}
	
	public static function get_pages($source) {
		return glob($source.'/*.md');
	}
	
	
	public function loadBlock($file, $params = null) {	
		require('layout/'.$file.'.php');
	}
	
	
	function rsearch($folder, $pattern) {
	    $dir = new RecursiveDirectoryIterator($folder);
	    $ite = new RecursiveIteratorIterator($dir);
	    $files = new RegexIterator($ite, $pattern, RegexIterator::GET_MATCH);
	    $fileList = array();
	    foreach($files as $file) {
	        $fileList = array_merge($fileList, $file);
	    }
	    return $fileList;
	}
}