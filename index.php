<?php 

	// Variables
	$source = 'content';
	$output = 'html';
	$url = 'http://localhost:8888/build/markdown-to-html/html';
	
	// Include Parsedown
	include 'lib/Parsedown.php';
	
	// Include the helper file
	include 'lib/helper.php';
	
	// Parsedown
	$Parsedown = new Parsedown();
	
	// Helper
	$builder = new builder();
	
	// Get list of files in source folder
	$articles = $builder->rsearch($source, '/.*md/');
	
	// Set $sidebar variable
	$sidebar = '';
	
	// Run through the files first and create the nav
	foreach ($articles as $key => $article) {
		// list the file name
		$file = basename($article);
		
		// Get the folder
		$folder = str_replace($file, '', $article);
		
		// Remove source folder name from folder
		$folder = str_replace($source, '', $folder);

		// Remove file extension
		$file = str_replace('.md', '', $file);
				
		$sidebar .= '<li><a href="'.$url.$folder.$file.'.html">'.$file.'</a></li>';
	}
	
	
	
	// Loop through files and get their content
	foreach ($articles as $key => $article) {
		
		// list the file name
		$file = basename($article);
		
		// Get the folder
		$folder = str_replace($file, '', $article);
		
		// Remove source folder name from folder
		$folder = str_replace($source, '', $folder);

		// Remove file extension
		$file = str_replace('.md', '', $file);
		
		// Get the content
		$content = $builder->get_contents($article);
		
		// Parse the content
		$content = $Parsedown->text($content);
		
		// Create the template
		ob_start();
						
		// Start the output
		$builder->loadBlock('head', $url);
		$builder->loadBlock('wrapper');
		$builder->loadBlock('sidebar');
		
		
			
		echo $sidebar;
		
		$builder->loadBlock('content');	
		
		// Insert the content
		echo $content;
		
		$builder->loadBlock('footer');
		
			
		$builder->loadBlock('footer');
	
		$markup = ob_get_clean();
		
		// Create folder if it doesnt yet exist
		if (!is_dir($output .'/'.$folder)) {
			mkdir($output . '/'. $folder, 0777, true);          
		}
		
		// Write the file
		file_put_contents($output . '/' . $folder .'/'.$file.'.html', $markup);
		
		echo 'Success';
	}

?>			