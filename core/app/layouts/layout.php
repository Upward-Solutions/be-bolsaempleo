<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
        <title>Bolsa de Empleo - Bienestar Estudiantil</title>
        <link href="../../../core/styles/css/index.css" rel='stylesheet'>
        <link href="../../../core/styles/css/index.css.map" rel='stylesheet'>
        <link href="../../../res/loader/loader.css" rel='stylesheet'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar">
            <a class="layout-menu-item" href="./"><h2 class="layout-title">Bolsa de Empleo</h2></a>
            <a class="layout-menu-item" href="./?view=vacantes">Ofertas</a>
        </nav>
        <div class="loader-container"><div class="loader"></div></div>
        <script>
            const loaderContainer = document.getElementsByClassName('loader-container')[0];

            function hideLoader() {
                if (loaderContainer) {
                    loaderContainer.style.display = 'none';
                }
            }

            function showLoader() {
                if (loaderContainer) {
                    loaderContainer.style.display = 'block';
                }
            }

            hideLoader()
        </script>
        <div id="content">
            <?php View::load("index"); ?>
        </div>
        <p class="layout-footer-text">
            Realizado por
            <a href="https://www.psi.uba.ar/bienestar/index.php" target="_blank">Bienestar Estudiantil</a>
            &copy; 2024
        </p>
    </body>
</html>
