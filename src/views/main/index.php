<?php

$env = parse_ini_file(__DIR__ . '/../../../.env');

$APP_DIR = $env["APP_DIR"];

require_once ($_SERVER["DOCUMENT_ROOT"] . $APP_DIR . '/src/views/parts/layouts/layoutTop.php');

require_once (APP_DIR . '/src/views/parts/sidebar.php');

require_once (APP_DIR . '/src/views/parts/header.php');

require_once (APP_DIR . '/src/php/connect.php');

$scanned = isset ($_GET["scanned"]);
$kurtsoa = isset ($_GET["kurtsoa"]) ? $_GET["kurtsoa"] : 1;

$result = getZikloa($kurtsoa);

$config = simplexml_load_file(APP_DIR . '/config.xml');
$mainColor = $config->mainColor;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $laburbildura = $row["laburbildura"];
    $izena = $row["izena"];
    $bideo_esteka = $row["bideo_esteka"];
    $web_esteka = $row["web_esteka"];
    ?>
    <div class="middle_text">
        <h1 id="mainColor"><span id="laburbiLdura_base_datos">
                <?= $laburbildura ?>
            </span> -
            <?= $izena ?>
        </h1>
        <br>
        <div>
            <iframe width="560" height="315" src="<?= $bideo_esteka ?>" title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
        </div>
        <div>
            <span class="goierri_link">
                <a href="<?= $web_esteka ?>" target="_blank">
                    Ziklo honi buruzko informazio gehiago
                </a>
            </span>
        </div>
        <?php
        if ($scanned) {
            ?>
            <div class="middle_items form_div">
                <div id="errorMessage">
                    <ul>
                        <li class="hidden" id="emailError">Zure eskolako emaila jarri behar duzu.</li>
                        <li class="hidden" id="valorationError">Balorazio bat gehitzea derrigorrezkoa da.</li>
                    </ul>
                </div>
                <div class="correctlySaved mainMessage hidden">
                    <p>
                        Zure erantzuna ongi gorde da. Mila esker parte hartzeagatik!
                    </p>
                </div>
                <div class="alreadyAnswered mainMessage hidden">
                    <p>
                        Dagoeneko parte hartu duzu ziklo honetako galderan. Eskerrik asko!
                    </p>
                </div>
                <input type="hidden" id="courseId" value="<?= $kurtsoa ?>" />
                <div class="form">
                    <label for="email">Email:<span class="asterisco">*</span></label>
                    <input type="email" name="email" id="email" placeholder="xxx_xxx_xxx@goierrieskola.org"
                        pattern="([a-zA-Z]{3}_[a-zA-Z]{3}_[a-zA-Z]{3}|[a-z]{8,})@(goierrieskola\.org|goierrieskola\.eus)$"
                        required>
                    <br>
                    <label for="balorazioa">Balorazioa<span class="asterisco" id="balorazioa">*</span>:
                        <i id="info-icon" class="fa fa-info-circle"></i>

                        <div class="rating">
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                        </div>
                        <div id="ratingResult"></div>
                        <div class="hidden" id="ratingValue"></div>
                    </label>

                    <?php
                    require_once (APP_DIR . '/src/views/main/index/modal.php');
                    ?>

                    <br>
                    <div class="middle_text">
                        <button type="submit" id="sendResults">Bidali</button>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="mainMessage qr_explanation">
                <p>
                    Galdera erantzuteko QR-a irakurri behar duzu mugikorrarekin. Animatu eta parte hartu!
                </p>
            </div>
            <?php
        }
        ?>

    </div>

    </div>
    <?php
}

require_once (APP_DIR . '/src/views/parts/layouts/layoutBottom.php');

require_once (APP_DIR . '/src/views/main/2arik_interfaze_gunea.xml');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $mensaje = $_POST["mensaje"];
    $kurtsoa = isset ($_POST["kurtsoa"]) ? $_POST["kurtsoa"] : 1;

    $xml = simplexml_load_file("2arik_interfaze_gunea.xml");

    $nueva_opinion = $xml->addChild('opinion');
    $nueva_opinion->addChild('nombre', $nombre);
    $nueva_opinion->addChild('correo', $correo);
    $nueva_opinion->addChild('mensaje', $mensaje);
    $nueva_opinion->addChild('kurtsoa', $kurtsoa);
    $nueva_opinion->addChild('fecha', date("Y-m-d H:i:s"));

    $xml->asXML("2arik_interfaze_gunea.xml");
}

$xml = simplexml_load_file("2arik_interfaze_gunea.xml");

foreach ($xml->opinion as $opinion) {
    if ($opinion->kurtsoa == $kurtsoa) {
        echo "<div>";
        echo "<p><strong>Nombre:</strong> " . $opinion->nombre . "<br></p>";
        echo "<p><strong>Correo:</strong> " . $opinion->correo . "<br></p>";
        echo "<p><strong>Mensaje:</strong> " . $opinion->mensaje . "<br></p>";
        echo "<p><strong>Fecha:</strong> " . $opinion->fecha . "<br></p>";
        echo "</div>";
    }
}
?>