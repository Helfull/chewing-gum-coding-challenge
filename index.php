<?php require_once './app/utils.php' ?>

<?php _v('_header'); ?>

<?php _v('_navbar'); ?>

<?php
    $page = $_GET['page'] ?? 'index';

    if (!file_exists("./pages/$page.php")) {
        $page = '404';
    }

    require_once "./pages/$page.php";
?>

<?php _v('_footer'); ?>