<?php

namespace App\Controllers;

class Compiler extends BaseController
{
	//fetches code from file
	public function index()
	{
		
$filePath = $_POST['path'];
$filePath = ltrim($filePath, '/');
/*
$programFile = fopen($filePath,"w");
fwrite($programFile,$code);
fclose($programFile);
*/
//$output=shell_exec("python ".$_SERVER['DOCUMENT_ROOT'].'/code_editor/app/'. $filePath." 2>&1");
$filePath = "tmp/output.txt";
$programFile = fopen($filePath,"w");
fwrite($programFile);
fclose($programFile);
//print_r($output);
*/
// code to accept inputs
	define('STDIN',fopen("php://stdin","r"));
$descriptorspec = array(
		0 => array("pipe","r"),
		1 => array("pipe","w"),
		2 => array("file",$_SERVER['DOCUMENT_ROOT']."/code_editor/tmp/error.log","a")
) ;
 
	$process = proc_open('python "'.$filePath.'"',$descriptorspec, $pipes);

	print fgets($pipes[1]);
	$p = $_POST['input'];
	if (is_resource($process)) {
		fwrite($pipes[0], $p);
		fclose($pipes[0]);
	
		print_r(stream_get_contents($pipes[1]));
	
		fclose($pipes[1]);

		proc_close($process);
		}
	}	
}
