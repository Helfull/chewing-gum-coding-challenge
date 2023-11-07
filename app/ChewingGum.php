<?php

class ChewingGum {

    private ?PDO $db;

    public readonly int $id;
    private bool $fresh = true;

    private function __construct(
        public readonly string $name,
        public readonly int $taste,
        public readonly string $color,
        public readonly int $price,
    ) {
    }

    public static function make(?string $name, ?int $taste, ?string $color, ?int $price) {
        return new self(
            name: $name ?? '',
            taste: $taste ?? 0,
            color: $color ?? '',
            price: $price ?? 0,
        );
    }

    public static function find(int $id) {
        $gum = new self('', 0, '', 0);
        return $gum->findById($id);
    }

    /**
     * @return array<ChewingGum>
     */
    public static function all(): array {
        $gum = new self('', 0, '', 0);
        return $gum->findAll();
    }

    /**
     * @return array<ChewingGum>
     */
    public function findAll(): array {
        try {
            $statement = $this->getDB()->prepare(
                "SELECT * FROM kaugummisorten"
            );

            $status = $statement->execute();

            if (!$status) {
                return [];
            }

            $data = $statement->fetchAll();

            if (count($data) === 0) {
                return [];
            }

            $gums = [];

            foreach ($data as $gumRow) {
                $gum = new self(
                    name: $gumRow['name'],
                    taste: $gumRow['taste'],
                    color: $gumRow['color'],
                    price: $gumRow['price'],
                );

                $gum->id = $gumRow['id'];
                $gum->fresh = false;

                $gums[] = $gum;
            }

            return $gums;
        } catch (PDOException $e) {
            error_log("Fehler beim Laden");
            error_log($e->getMessage());
            return [];
        }
    }

    public function findById(int $id): ?ChewingGum {
        try {
            $statement = $this->getDB()->prepare(
                "SELECT * FROM kaugummisorten
                    WHERE id = :id"
            );

            $status = $statement->execute([
                "id" => $id,
            ]);

            if (!$status) {
                return null;
            }

            $data = $statement->fetchAll();

            if (count($data) === 0) {
                return null;
            }

            $gum = new self(
                name: $data[0]['name'],
                taste: $data[0]['taste'],
                color: $data[0]['color'],
                price: $data[0]['price'],
            );

            $gum->id = $data[0]['id'];
            $gum->fresh = false;

            return $gum;
        } catch (PDOException $e) {
            error_log("Fehler beim Laden");
            error_log($e->getMessage());
            return null;
        }
    }

    public function save(): bool {
        try {
            if (! $this->fresh) {
                return $this->update();
            }

            $statement = $this->getDB()->prepare(
                "INSERT INTO kaugummisorten (name, taste, color, price)
                    VALUES (:name, :taste, :color, :price)"
            );

            $status = $statement->execute([
                "name" => $this->name,
                "taste" => $this->taste,
                "color" => $this->color,
                "price" => $this->price,
            ]);

            if ($status) {
                $this->id = (int) $this->getDB()->lastInsertId();
            }

            return $status;
        } catch (PDOException $e) {
            error_log("Fehler beim Speichern");
            error_log($e->getMessage());
            return false;
        }
    }

    private function update() {
        $statement = $this->getDB()->prepare(
            "UPDATE kaugummisorten
                SET
                    name=:name,
                    taste=:taste,
                    color=:color,
                    price=:price,
                WHERE id=:id
            "
        );

        return $statement->execute([
            "id" => $this->id,
            "name" => $this->name,
            "taste" => $this->taste,
            "color" => $this->color,
            "price" => $this->price,
        ]);

    }

    private function getDB() {
        if (!isset($this->db)) {
            try {
                error_log("Connecting to database...");
                $this->db = new PDO(
                    "mysql:host=127.0.0.1;dbname=chewing_gum",
                    "chewing_gum",
                    "chewing_gum",
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_TIMEOUT => 5,
                    ]
                );
                error_log("Connected to database");
            } catch (PDOException $e) {
                error_log("Failed to connect to database");
                error_log($e->getMessage());
                die;
            }
        }

        return $this->db;
    }

    public function getPriceStr(): string {
        return number_format($this->price / 100, 2, ',', '.');
    }

    public function getTasteStr(): string {
        return match($this->taste) {
            1 => "Süß",
            2 => "Sauer",
            default => "Anders",
        };
    }

}