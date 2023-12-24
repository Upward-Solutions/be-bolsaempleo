<?php


// 14 de Abril del 2014
// Core.php
// @brief obtiene las configuraciones, muestra y carga los contenidos necesarios.

class Core {
	public static $debug_sql = false;
	public static $post;
	public static $get;

	public static function addFlash($type,$message){
		$flash = "<p class='alert alert-".$type."'>".$message."<p>";
		if(!isset($_SESSION["flashes"])){ $_SESSION["flashes"]=  array(); }
		$flashes = $_SESSION["flashes"];
		$flashes[] = $flash;
		$_SESSION["flashes"] = $flashes;

	}

	public static function redir($url){
		echo "<script>window.location='".$url."';</script>";
	}

	public static function alert($txt){
		echo "<script>alert('".$txt."');</script>";
	}

	public static function g($f,$v){
		return isset($_GET[$f]) && $_GET[$f]==$v;
	}
}
