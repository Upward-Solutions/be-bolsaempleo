<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
        <title>Bolsa de Empleo - Bienestar Estudiantil</title>
        <link href="../../../core/styles/css/index.css" rel='stylesheet'>
        <link href="../../../core/styles/css/index.css.map" rel='stylesheet'>
        <link href="../../../res/font-awesome/css/fontawesome-all.min.css" rel='stylesheet'>
    </head>
    <body>
        <nav class="navbar">
            <h2 class="layout-title">Bienestar Estudiantil</h2>
            <a class="layout-menu-item" href="./">Inicio</a>
            <a class="layout-menu-item" href="./?view=vacantes">Vacantes</a>
        </nav>
        <div id="content">
            <?php View::load("index"); ?>
        </div>
        <p class="layout-footer-text">
            Realizado por
            <a href="https://www.psi.uba.ar/bienestar/index.php" target="_blank">Bienestar Estudiantil</a>
            &copy; 2023
        </p>
    </body>
</html>
