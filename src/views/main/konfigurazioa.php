<?php
$env = parse_ini_file(__DIR__ . '/../../../.env');
$APP_DIR = $env["APP_DIR"];

require_once ($_SERVER["DOCUMENT_ROOT"] . $APP_DIR . '/src/views/parts/layouts/layoutTop.php');

require_once (APP_DIR . '/src/views/parts/sidebar.php');
require_once (APP_DIR . '/src/views/parts/header.php');

// Cargar la configuración actual desde el archivo XML
$config = simplexml_load_file(APP_DIR . '/config.xml');

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset ($_POST['action']) && $_POST['action'] === 'changeConfig') {
    // Obtener el valor hexadecimal del color principal y del pie de página
    $mainColor = isset ($_POST['mainColor']) ? $_POST['mainColor'] : '';
    $footerColor = isset ($_POST['footerColor']) ? $_POST['footerColor'] : '';

    // Actualizar los valores del XML con los valores del formulario
    $config->mainColor = $mainColor;
    $config->footerColor = $footerColor;

    // Guardar los cambios en el archivo XML
    $config->asXML(APP_DIR . '/config.xml');

    // Redireccionar para reflejar los cambios
    header("Location: ./index.php");
    exit();
}

// Generar CSS dinámico
$dynamicCSS = "<style>
    .main-content {
        background-color: $config->mainColor;
    }
    footer {
        background-color: $config->footerColor;
    }
</style>";
?>

<div class="laburpenaDiv">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <!-- Cambiado el action para que envíe el formulario a sí mismo -->
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

<?= $dynamicCSS ?>