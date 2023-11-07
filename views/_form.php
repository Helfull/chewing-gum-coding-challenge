<div class="mb-2 flex w-full justify-start">
    <label class="py-2 w-1/6" for="name">Name:</label>
    <input required value="<?= $data['name'] ?? '' ?>" name="name" id="name" class="w-5/6 py-2 px-1 border-b bg-gray-200 border-black">
</div>

<div class="mb-2 flex w-full justify-start">
    <label class="py-2 w-1/6" for="taste">Geschmack:</label>
    <select required value="<?= $data['taste'] ?? '' ?>" name="taste" id="taste" type="number" class="py-2 px-1 border-b bg-gray-200 border-black">
        <option value="0">Bitte wählen!</option>
        <option <?= $data['taste'] === 1 ? 'selected' : '' ?>  value="1">Süß</option>
        <option <?= $data['taste'] === 2 ? 'selected' : '' ?>  value="2">Sauer</option>
        <option <?= $data['taste'] === 3 ? 'selected' : '' ?>  value="3">Anders</option>
    </select>
</div>

<div class="mb-2 flex w-full justify-start">
    <label class="py-2 w-1/6" for="color">Farbe:</label>
    <input required value="<?= $data['color'] ?? '' ?>" name="color" id="color" class="w-5/6 py-2 px-1 border-b bg-gray-200 border-black">
</div>

<div class="mb-2 flex w-full justify-start">
    <label class="py-2 w-1/6" for="price">Preis:</label>
    <input required value="<?= $data['price'] ?? '' ?>" name="price" id="price" class="py-2 px-1 border-b bg-gray-200 border-black text-right">
    <span class="py-2 pl-2 text-lg">€</span>
</div>

<button type="submit" class="border border-black p-4">Speichern</button>