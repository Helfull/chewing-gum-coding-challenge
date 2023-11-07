<?php

require_once './app/ChewingGum.php';

$gums = ChewingGum::all();
?>

<table class="w-full">
    <thead>
        <tr>
            <th>Name</th>
            <th>Geschmack</th>
            <th>Farbe</th>
            <th>Preis</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($gums as $gum) : ?>
            <tr class="hover:bg-gray-200 border-b-2 border-grey-500">
                <td class="p-2 text-center"><?= $gum->name ?></td>
                <td class="p-2 text-center"><?= $gum->getTasteStr() ?></td>
                <td class="p-2 text-center"><?= $gum->color ?></td>
                <td class="p-2 text-center"><?= $gum->getPriceStr() ?>€</td>
                <td class="p-2 underline text-center"><a href="?page=edit&id=<?=$gum->id?>">Bearbeiten</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>