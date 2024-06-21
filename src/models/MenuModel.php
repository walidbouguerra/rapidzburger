<?php

class MenuModel extends Model {
    protected $table = "menu";

    public function add(string $nom, float $prix, string $description, string $image)
    {
        $query = $this->pdo->prepare("INSERT INTO menu VALUES(null, :nom, :prix, :description, :image)");
        $query->execute([
            'nom' => $nom,
            'prix' => $prix,
            'description' => $description,
            'image' => $image
        ]);
    }

    public function update(int $id, string $nom, float $prix, string $description, string $image)
    {
        $query = $this->pdo->prepare("UPDATE menu SET nom = :nom, prix = :prix, description = :description, image = :image WHERE id = :id");
        $query->execute([
            'id' => $id,
            'nom' => $nom,
            'prix' => $prix,
            'description' => $description,
            'image' => $image,
        ]);
    }
}