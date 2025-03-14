<?php

if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$category = PersonData::getById($_GET["id"]);
	$category->del();
}
	Core::redir("./index.php?view=persons");

?>