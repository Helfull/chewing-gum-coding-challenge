<?php
require_once './app/ChewingGum.php';
require_once './app/utils.php';

$gum = ChewingGum::make($_POST['name'], $_POST['taste'], $_POST['color'], parsePrice($_POST['price'] ?? 0));

if ($_GET['action'] === 'save') {
    if ($gum->save()) {
        _v('_toast', [
            'type' => 'success',
            'title' => 'Erfolg!',
            'message' => 'Kaugummi wurde erfolgreich hinzugefügt!',
        ]);
    } else {
        _v('_toast', [
            'type' => 'error',
            'title' => 'Fehler!',
            'message' => 'Leider konnte das Kaugummi nicht gespeichert werden, bitte wenden sie sich an den Administrator!',
        ]);
    }
}
?>

<form method="post" action="?page=new&action=save" class="p-8 flex flex-col justify-center">
    <?php _v('_form', [
        'data' => [
            "id" => $gum->id ?? null,
            "name" => $gum->name ?? null,
            "taste" => $gum->taste ?? null,
            "color" => $gum->color ?? null,
            "price" => $gum->getPriceStr() ?? null,
        ],
    ]); ?>
</form>