<?php
/**
 * Property Model
 */

require_once 'Model.php';

class Property extends Model
{
    protected $table = 'properties';

    public function getByOwner($owner_id, $limit = null, $offset = 0)
    {
        return $this->where('owner_id', $owner_id, $limit, $offset);
    }

    public function getByType($type_id, $limit = null, $offset = 0)
    {
        return $this->where('property_type_id', $type_id, $limit, $offset);
    }

    public function getByCity($city, $limit = null, $offset = 0)
    {
        return $this->where('city', $city, $limit, $offset);
    }

    public function getAvailable($limit = null, $offset = 0)
    {
        return $this->where('status', 'available', $limit, $offset);
    }

    public function getWithDetails($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT p.*, pt.name as property_type, u.name as owner_name 
            FROM {$this->table} p 
            LEFT JOIN property_types pt ON p.property_type_id = pt.id 
            LEFT JOIN users u ON p.owner_id = u.id 
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAllWithDetails($limit = null, $offset = 0)
    {
        $sql = "
            SELECT p.*, pt.name as property_type, u.name as owner_name 
            FROM {$this->table} p 
            LEFT JOIN property_types pt ON p.property_type_id = pt.id 
            LEFT JOIN users u ON p.owner_id = u.id
        ";
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        }
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
