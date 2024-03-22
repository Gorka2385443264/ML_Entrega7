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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $mensaje = $_POST["mensaje"];
    // Obtener la fecha actual local
    $fecha = date("Y/m/d");

    // Cargar el XML existente
    $xml = simplexml_load_file("2arik_interfaze_gunea.xml");

    // Agregar una nueva opinión
    $nueva_opinion = $xml->addChild('opinion');
    $nueva_opinion->addChild('nombre', $nombre);
    $nueva_opinion->addChild('correo', $correo);
    $nueva_opinion->addChild('mensaje', $mensaje);
    $nueva_opinion->addChild('fecha', $fecha);

    // Guardar el XML actualizado
    $xml->asXML("2arik_interfaze_gunea.xml");

    // Mostrar mensaje de éxito
    echo '<div class="correctlySaved mainMessage">
              <p>Zure erantzuna ongi gorde da. Mila esker parte hartzeagatik!</p>
          </div>';
}

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
                <a href="<?= $web_esteka ?>" target="_blank">Ziklo honi buruzko informazio gehiago</a>
            </span>
        </div>
        <div class="middle_items form_div">

            <!-- Formulario -->
            <div class="form">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="email">Email:<span class="asterisco">*</span></label>
                    <input type="email" name="correo" id="correo" placeholder="xxx_xxx_xxx@goierrieskola.org"
                        pattern="([a-zA-Z]{3}_[a-zA-Z]{3}_[a-zA-Z]{3}|[a-z]{8,})@(goierrieskola\.org|goierrieskola\.eus)$"
                        required><br>


                    <label for="nombre">Nombre:<span class="asterisco">*</span></label>
                    <input type="text" name="nombre" id="nombre" required><br>

                    <label for="mensaje">Mensaje:<span class="asterisco">*</span></label>
                    <textarea name="mensaje" id="mensaje" rows="4" cols="50" required></textarea><br>

                    <?php
                    require_once (APP_DIR . '/src/views/main/index/modal.php');
                    ?>

                    <br>
                    <div class="middle_text">
                        <button type="submit" id="sendResults">Bidali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}

// Mostrar el contenido del XML
$xml = simplexml_load_file("2arik_interfaze_gunea.xml");
?>


<div class="middle_text">
    <?php
    foreach ($xml->opinion as $opinion) {
        echo "<div style='background-color: #f0f0f0;   margin-bottom: 10px;'>";
        echo "<p><strong>Nombre:</strong> " . $opinion->nombre . "<br></p>";
        echo "<p><strong>Correo:</strong> " . $opinion->correo . "<br></p>";
        echo "<p><strong>Mensaje:</strong> " . $opinion->mensaje . "<br></p>";
        echo "<p><strong>Fecha:</strong> " . $opinion->fecha . "<br></p>";
        echo "</div>";
    }
    ?>
</div>

<?php
require_once (APP_DIR . '/src/views/parts/layouts/layoutBottom.php');
?>