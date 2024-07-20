<?php

class User
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function findUserByUsername(string $username): array
    {
        try {
            $sql = "SELECT * From users WHERE username=:username";
            $params = [':username' => $username];
            return $this->db->query($sql, $params) ?? [];
        } catch (PDOException $e) {
            echo "Error creating product: ".$e->getMessage();
            return [];
        }
    }
}