<?php
/**
 * Base Model Class
 */

class Model
{
    protected $pdo;
    protected $table;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Find record by ID
     */
    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Get all records
     */
    public function all($limit = null, $offset = 0)
    {
        $sql = "SELECT * FROM {$this->table}";
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        }
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Get all records where condition
     */
    public function where($column, $value, $limit = null, $offset = 0)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} = ?";
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$value]);
        return $stmt->fetchAll();
    }

    /**
     * Get count of records
     */
    public function count($column = null, $value = null)
    {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        if ($column && $value) {
            $sql .= " WHERE {$column} = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$value]);
        } else {
            $stmt = $this->pdo->query($sql);
        }
        $result = $stmt->fetch();
        return $result['count'];
    }

    /**
     * Create record
     */
    public function create($data)
    {
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array_values($data))) {
            return $this->pdo->lastInsertId();
        }
        return false;
    }

    /**
     * Update record
     */
    public function update($id, $data)
    {
        $set = implode(',', array_map(fn($key) => "{$key} = ?", array_keys($data)));
        $sql = "UPDATE {$this->table} SET {$set} WHERE id = ?";
        $values = array_values($data);
        $values[] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }

    /**
     * Delete record
     */
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
