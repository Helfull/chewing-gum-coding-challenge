<?php

function _v(string $view, $variables = []) {
    extract($variables);

    ob_start();
    include "./views/$view.php";
    echo ob_get_clean();
}