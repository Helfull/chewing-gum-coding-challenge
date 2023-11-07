<?php
    $typeClass = match($type) {
        'success' => 'text-green-800 border-green-500 bg-green-100',
        'error' => 'text-red-800 border-red-500 bg-red-100',
    }
?>

<div class="p-4 m-4 border <?= $typeClass ?>">
    <div class="font-bold"><?= $title ?></div>
    <?= $message ?>
</div>