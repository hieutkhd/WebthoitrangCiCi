<?php 
	require_once __DIR__ .'/autoload.php';
	$path = isset($_GET['path']) ? $_GET['path'] : '';
	if(is_dir($path))
	{
		deleteFolder($path);
		header("Location: http://basephp.loca/admin/");exit();
	}