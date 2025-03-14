<?php


class Module
{

    public static function loadLayout(): void
    {
        if (Core::$root == "") {
            include "core/app/layouts/layout.php";
        } else if (Core::$root == "admin/") {
            include "core/app/" . Core::$theme . "/layouts/layout.php";
        }
    }
}


?>
