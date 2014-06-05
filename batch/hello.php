<?php
// Prompt for the file path to the project
print "Enter project directory: C:/wamp/www/";
// Save the user input to $filePath
$filePath = trim(fgets(STDIN)); // reads one line from STDIN

// Prompt for the project's name (also the local url, ex: http://projectName.local)
print "Enter project name: ";
$projectName = trim(fgets(STDIN)); // reads one line from STDIN

// Check if the filepath was multi-part (i.e. contains forward slashes)
if (strpos($filePath,'/') !== false) {
	
    // replace all forward slashes with backslashes
    $filePath_final = str_replace('/','\\',$filePath);
	
}
else {
	
	$filePath_final = $filePath;
	
}

// Define the proper directory separator
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

// Create the full file path...
$dir = "C:".DS.'wamp'.DS.'www'.DS.addslashes($filePath_final);


//print 'DIR: '.$dir;

// Check if the directory already exists
if( !is_dir($dir) ){
	
	// Create the directory
	if(!mkdir($dir,0777,true)){
		
		print "There was an error creating the directory.";
		exit;
		
	}
	else {
		
		print "Directory created successfully ({$dir})";
		
		// Append a new local domain for Windows
		$file = "C:".DS.'Windows'.DS.'System32'.DS.'drivers'.DS.'etc'.DS.'hosts';
		$data = "\n".'127.0.0.1        '.$projectName.'.local';
		file_put_contents($file, $data, FILE_APPEND);
		
		// Append a new virtual host for WAMP
		$file = "C:".DS.'wamp'.DS.'bin'.DS.'apache'.DS.'Apache2.4.4'.DS.'conf'.DS.'extra'.DS.'httpd-vhosts.conf';
		$data  = "\n";
		$data .= '<VirtualHost *:80>'."\n";
		$data .= '    DocumentRoot C:/wamp/www/'.$filePath."\n";
		$data .= '    ServerName '.$projectName.'.local'."\n";
		$data .= '</VirtualHost>';
		file_put_contents($file, $data, FILE_APPEND);
		
	}
	
}
else {
	
	print "Directory already exists ({$dir})";
	exit;
	
}
