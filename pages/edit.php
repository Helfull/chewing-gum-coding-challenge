<?php
require_once './app/ChewingGum.php';
require_once './app/utils.php';

$gum = ChewingGum::find($_GET['id']);

if ($_GET['action'] === 'save') {

    $gum->update(
        name: $_POST['name'],
        taste: $_POST['taste'],
        color: $_POST['color'],
        price: parsePrice($_POST['price']),
    );

    if ($gum->save()) {
        _v('_toast', [
            'type' => 'success',
            'title' => 'Erfolg!',
            'message' => 'Kaugummi wurde erfolgreich gespeichert!',
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

<form method="post" action="?page=edit&action=save&id=<?=$gum->id?>" class="p-8 flex flex-col justify-center">
    <div class="mb-2 flex w-full justify-start">
        <label class="py-2 w-1/6" for="gum_id">ID:</label>
        <input readonly value="<?= $gum->id ?? '' ?>" name="gum_id" id="gum_id" class="w-5/6 py-2 px-1 border-b bg-gray-400 font-bold text-white border-black">
    </div>

    <?php _v('_form', [
        'data' => [
            "name" => $gum->name,
            "taste" => $gum->taste,
            "color" => $gum->color,
            "price" => $gum->getPriceStr(),
        ],
    ]); ?>
</form>