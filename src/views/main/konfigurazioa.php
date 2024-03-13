<?php
$env = parse_ini_file(__DIR__ . '/../../../.env');
$APP_DIR = $env["APP_DIR"];

require_once($_SERVER["DOCUMENT_ROOT"] . $APP_DIR . '/src/views/parts/layouts/layoutTop.php');

require_once(APP_DIR . '/src/views/parts/sidebar.php');
require_once(APP_DIR . '/src/views/parts/header.php');

// Cargar la configuración actual desde el archivo XML
$config = simplexml_load_file(APP_DIR . '/config.xml');

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'changeConfig') {
    // Actualizar los valores del XML con los valores del formulario
    $config->mainColor = $_POST['mainColor'];
    $config->footerColor = $_POST['footerColor'];

    // Guardar los cambios en el archivo XML
    $config->asXML(APP_DIR . '/config.xml');
}

?>
<div class="laburpenaDiv">
    <form action="<?= HREF_APP_DIR ?>/src/php/post.php" method="post">
        <input type="hidden" value="changeConfig" name="action" />
        <div>
            <div>
                <label for="mainColor">Kolore nagusia:</label>
            </div>
            <div>
                <input type="color" id="mainColor" name="mainColor" value="<?= $config->mainColor ?>" />
            </div>
        </div>
        <div>
            <div>
                <label for="footerColor">Footer kolorea:</label>
            </div>
            <div>
                <input type="color" id="footerColor" name="footerColor" value="<?= $config->footerColor ?>" />
            </div>
        </div>
        <button type="submit">Gorde</button>
    </form>
</div>

<?php
require_once(APP_DIR . '/src/views/parts/layouts/layoutBottom.php');
?>