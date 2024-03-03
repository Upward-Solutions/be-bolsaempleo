<?php


// 14 de Abril del 2014
// Core.php
// @brief obtiene las configuraciones, muestra y carga los contenidos necesarios.

class Core
{
    public static bool $debug_sql = false;
    public static $post;
    public static $get;

    public static function addFlash($type, $message): void
    {

        $flash = "<p class='alert alert-" . $type . "'>" . $message . "<p>";
        if (!isset($_SESSION["flashes"])) {
            $_SESSION["flashes"] = array();
        }

        $flashes = $_SESSION["flashes"];
        $flashes[] = $flash;
        $_SESSION["flashes"] = $flashes;

    }

    public static function redir($url): void
    {
        echo "<script>window.location='" . $url . "';</script>";
    }

    public static function alert($txt): void
    {
        echo "<script>alert('" . $txt . "');</script>";
    }

    public static function loader(): void
    {
        echo '<link href="../../res/loader/loader.css" rel="stylesheet">';
        echo '<div class="loader-container"><div class="loader"></div></div>';
    }

    public static function g($f, $v): bool
    {
        $ret = false;
        if (isset($_GET[$f]) && $_GET[$f] == $v) {
            $ret = true;
        }
        return $ret;
    }

    public static function num($n)
    {
        if (is_numeric($n)) {
            return number_format($n, 2);
        } else {
            return $n;
        }
    }

}
