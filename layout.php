<?php 

	ob_start();
					
	// Start the output
	$builder->loadBlock('head', $assets);
	$builder->loadBlock('header');
	$builder->loadBlock('title');
	$builder->loadBlock('breadcrumb');
	$builder->loadBlock('wrapper');
	
	// Get the file contents
	$content = $builder->get_contents($section.'/'.$page);
	echo $Parsedown->text($content);
	
	$file = str_replace('.md', '', $page);
			
	if (!is_dir('../'.$section)) {
		   mkdir('../'.$section);        
	}
		
	echo $sidebar;		
	$builder->loadBlock('footer');

	$output = ob_get_clean();