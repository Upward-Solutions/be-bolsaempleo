<?php

class Crudadmin{

	public static function valid($schema){
		return true;
	}

	public static function add($schema,$model,$data){
		foreach($schema as $k =>$v){
			if($v["form"]!="hidden" && in_array("add", explode(",", $v["actions"]))){
				$model->{$k} = Core::$post[$k];
			}
		}
		$model->add();
	}

	public static function update($schema,$model,$data,$action="edit"){
		foreach($schema as $k =>$v){
			if($v["form"]!="hidden"){
			if(in_array($action, explode(",", $v["actions"]))){
				$model->{$k} = Core::$post[$k];
			}
			}
		}
		$model->update();
	}
}