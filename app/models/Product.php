<?php

class Product
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getAllProducts(): array
    {
        $sql = "SELECT * FROM products";
        return $this->db->query($sql) ?? [];
    }

    public function createProduct(array $productData): bool
    {
        try {
            $sql = "INSERT INTO products (name, color ,price, category, accessories, available, weight) 
                    VALUES (:name, :color,:price, :category, :accessories,:available, :weight)";

            $params = [
                ':name' => $productData['name'],
                ':color' => $productData['color'],
                ':price' => $productData['price'],
                ':category' => $productData['category'],
                ':accessories' => $productData['accessories'],
                ':available' => $productData['available'],
                ':weight' => $productData['weight'],
            ];

            return $this->db->query($sql, $params) !== false;
        } catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
            return false;
        }
    }

    public function removeProduct($code): bool
    {
        try {
            $sql = "DELETE FROM products WHERE id=:code";

            $params = [
                ':code' => $code,
            ];

            return $this->db->query($sql, $params) !== false;
        } catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
            return false;
        }
    }

    public function findProduct($code): array
    {
        try {
            $sql = "SELECT * FROM products WHERE id=:code";
            $params = [':code' => $code];
            return $this->db->query($sql, $params) ?? [];
        } catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
            return [];
        }
    }

    public function updateProduct(string $productId, array $productData): bool
    {
        try {
            $sql = "UPDATE products SET 
                        name=:name, 
                        color=:color,
                        price=:price, 
                        category=:category, 
                        accessories=:accessories, 
                        available=:available, 
                        weight=:weight 
                    WHERE id=:id";

            $params = [
                ':name' => $productData['name'],
                ':color' => $productData['color'],
                ':price' => $productData['price'],
                ':category' => $productData['category'],
                ':accessories' => $productData['accessories'],
                ':available' => $productData['available'],
                ':weight' => $productData['weight'],
                ':id' => $productId,
            ];

            return $this->db->query($sql, $params) !== false;
        } catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
            return false;
        }
    }
}
