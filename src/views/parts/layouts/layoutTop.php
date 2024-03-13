<!DOCTYPE HTML>
<html lang="es">
<?php

define('APP_DIR', $_SERVER['DOCUMENT_ROOT'] . $APP_DIR); //Aplikazioaren karpeta edozein lekutatik atzitzeko.
define('HREF_APP_DIR', $APP_DIR); //Aplikazioaren views karpeta edozein lekutatik deitzeko
define('HREF_VIEWS_DIR', $APP_DIR . '/src/views'); //Aplikazioaren views karpeta edozein lekutatik deitzeko
define('HREF_JS_DIR', $APP_DIR . '/src/js'); //Aplikazioaren views karpeta edozein lekutatik deitzeko

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.ico">
    <link href="<?= HREF_APP_DIR ?>/public/font_awesome/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Azoka</title>

    <!-- CSRF Token -->
    <!-- TODO: Gehitzeko -->

    <!-- External -->
    <link href="<?= HREF_APP_DIR ?>/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Internal -->
    <link href="<?= HREF_APP_DIR ?>/src/css/app.css" rel="stylesheet">


</head>

<body class="">