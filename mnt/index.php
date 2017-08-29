<?php

require_once('../b.php');
require_once('../d.php');

if (count($_POST)) $input = $_POST; else $input = $_GET;
if (!$input['srv'] and $_GET['srv']) $input['srv'] = $_GET['srv'];
if (!$input['token'] and $_GET['token']) $input['token'] = $_GET['token'];
$template = 'views/blank.view.php';

try {

    if ($input['token'] != 'b717415eb5e699e4989ef3e2c4e9cbf7') {

        if ($input['login']) {
            if ($input['login'] == 'suporte@immaginare.com.br' and $input['pass'] == '1q2w0o9i#') {
                $token = 'b717415eb5e699e4989ef3e2c4e9cbf7';
                $template = 'views/blank.view.php';
            } else {
                $token = '';
                $template = 'views/um.view.php';
            }            
        } else {
            $template = 'views/um.view.php';
        }

    } else {

        $dbid = 4;

        if ($input['srv'] == 'audit') {

            require_once('../bm.php');
            $obj = new MntAuditService();
            $token = $input['token'];

            if (!$input['id']) {
                $list = $obj->getList();
                $template = "views/uma.view.php";
            } else {
                $txt = $obj->get($input['id']);
                $template = "views/umadet.view.php";
            }

        } elseif ($input['srv'] == 'imp') {

            if (isset($_FILES['arquivo'])) {

                $msg = "file";

                require_once('../imp/bimp.php');
                $obj = new BanMovImpService();
                $msg = $obj->imp($dbid, $_FILES['arquivo']);
            }

            $template = "views/umi.view.php";
        }
    }

} catch (Exception $e) {

     $msg = $e->getMessage();
}

?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="format-detection" content="telephone=no">
    <META name="robots" content="noindex, nofollow">
    <title>TwsLite</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>

<header>
    <nav>

        <?php
        if ($token) {
        ?>

        <a href="index.php?srv=logout">Logout</a>
        <a href="index.php?srv=audit&token=<?php echo $token ?>">Audita</a>
        <a href="index.php?srv=imp&token=<?php echo $token ?>">Importa</a>

        </span>

        <?php
        }
        ?>

        <h1>TwsLite</h1>

    </nav>
</header>

<main>
    <?php include($template) ?>
    <p align="center"><?php echo $msg ?></p>
</main>

</body>
