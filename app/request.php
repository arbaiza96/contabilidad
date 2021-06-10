<?php 

	session_start();

	require 'link/conexion.php';
	require 'class/class.php';

	$class = $_REQUEST["class"];
	$function = $_REQUEST["action"];

	$instance = new $class();
	$data = $instance->$function();
	
	print_r($data);

?>