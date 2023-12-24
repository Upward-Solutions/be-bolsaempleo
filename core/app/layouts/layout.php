<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
    <title>Bolsa de Empleo - Bienestar Estudiantil</title>
    <link href="../../../res/bootstrap/css/bootstrap.css" rel='stylesheet'>
    <link href="../../../res/font-awesome/css/fontawesome-all.min.css" rel='stylesheet'>
    <script src="../../../res/js/jquery.min.js"></script>
</head>

<body>
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./"><b>Bienestar Estudiantil</b></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="./">Inicio</a></li>
                <li><a href="./?view=vacantes">Vacantes</a></li>
            </ul>
        </div>
    </div>
</nav>


<?php
View::load("index");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
            <hr>
            <p class="text-muted text-center">
                Realizado por
                <a href="https://www.psi.uba.ar/bienestar/index.php" target="_blank">Bienestar Estudiantil</a>
                &copy; 2023
            </p>
        </div>
    </div>
</div>
<script src="../../../res/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
