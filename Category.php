<?php

class Category {
    private string $dataFile;

    public function __construct(string $dataFile = 'categories.json') {
        $this->dataFile = $dataFile;
        if (!file_exists($this->dataFile)) {
            file_put_contents($this->dataFile, json_encode([], JSON_PRETTY_PRINT));
        }
    }

    public function getAll(): array {
        $content = file_get_contents($this->dataFile);
        return json_decode($content, true) ?? [];
    }

    public function add(string $nom, string $couleur, string $icone): void {
        $categories = $this->getAll();
        $newId = count($categories) > 0 ? max(array_column($categories, 'id')) + 1 : 1;

        $newCategory = [
            'id' => $newId,
            'nom' => htmlspecialchars(trim($nom)),
            'couleur' => htmlspecialchars(trim($couleur)),
            'icone' => htmlspecialchars(trim($icone))
        ];

        $categories[] = $newCategory;
        file_put_contents($this->dataFile, json_encode($categories, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}