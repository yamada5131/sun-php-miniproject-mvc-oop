<?php

class Database
{
    public PDO $conn;
    private string $host = "db";
    private string $dbName = "my_database";
    private string $username = "root";
    private string $password = "root";

    public function __construct()
    {
        $this->connect();
    }

    private function connect(): void
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: ".$e->getMessage();
        }
    }

    /**
     * Executes a SQL query with optional parameters.
     *
     * @param  string  $sql  The SQL query to execute.
     * @param  array  $params  The parameters to bind to the query.
     * @return array|bool|int The result of the query execution.
     */
    public function query(string $sql, array $params = []): array|bool|int
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);

            if (preg_match('/^(SELECT|SHOW|DESCRIBE|EXPLAIN)/i', $sql)) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } elseif (preg_match('/^(INSERT|UPDATE|DELETE)/i', $sql)) {
                return $stmt->rowCount();
            }
            return true;
        } catch (PDOException $e) {
            echo "Query failed: ".$e->getMessage();
            return false;
        }
    }
}

