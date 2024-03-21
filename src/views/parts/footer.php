<?php
$env = parse_ini_file(__DIR__ . '/../../../.env');
$APP_DIR = $env["APP_DIR"];

require_once ($_SERVER["DOCUMENT_ROOT"] . $APP_DIR . '/src/views/parts/layouts/layoutTop.php');

require_once (APP_DIR . '/src/views/parts/sidebar.php');
require_once (APP_DIR . '/src/views/parts/header.php');


$config = simplexml_load_file(APP_DIR . '/config.xml');
$footerColor = $config->footerColor;
// Cargar la configuración actual desde el archivo XML

$result = getZikloa($kurtsoa);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $laburbildura = $row["laburbildura"];
    $izena = $row["izena"];
    $bideo_esteka = $row["bideo_esteka"];
    $web_esteka = $row["web_esteka"];
    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Título de tu página</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/7f605dc8fe.js" crossorigin="anonymous"></script>
        <style>
            #mainColor {
                color:
                    <?= $mainColor ?>
                ;
            }
        </style>
    </head>

    <body>
        <div class="content">

        </div>

        <footer style="background-color: <?= $footerColor ?>">
            <div>
                <p><a href="<?= HREF_VIEWS_DIR ?>/main/taldeArgazkia.php" target="_blank">Egileak: 1WG3 eta 1MG3 taldeko
                        ikasleak</a></p>
            </div>
            <div>
                <p><a href="https://www.goierrieskola.eus/es/" target="_blank">goierrieskola.eus</a></p>
            </div>
            <div>
                <nav>
                    <a href="https://www.youtube.com/@GoierriEskola"><i class="fab fa-youtube"></i></a>
                    <a href="https://twitter.com/Goierrieskola1"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/goierrieskola/"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/search/top/?q=goierri%20eskola"><i class="fab fa-facebook"></i></a>
                </nav>
            </div>
        </footer>

    </body>

    </html>
    <?php
}
require_once (APP_DIR . '/src/views/parts/layouts/layoutBottom.php');
?>