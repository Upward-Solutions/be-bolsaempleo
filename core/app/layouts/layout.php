<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
        <title>Bolsa de Empleo - Bienestar Estudiantil</title>
        <link href="../../../res/bootstrap/css/bootstrap.css" rel='stylesheet'>
        <link href="../../../res/font-awesome/css/fontawesome-all.min.css" rel='stylesheet'>
    </head>
    <body>
        <nav class="navbar-inverse">
            <div class="container" style="display: flex; justify-content: flex-start; align-items: center; gap: 10px;">
                <h2 style="margin: 0; color: white">Bienestar Estudiantil</h2>
                <a href="./">Inicio</a>
                <a href="./?view=vacantes">Vacantes</a>
            </div>
        </nav>
        <?php View::load("index"); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
