<?php
/**
 * Review Model
 */

require_once 'Model.php';

class Review extends Model
{
    protected $table = 'reviews';

    public function getByProperty($property_id, $limit = null, $offset = 0)
    {
        return $this->where('property_id', $property_id, $limit, $offset);
    }

    public function getByTenant($tenant_id, $limit = null, $offset = 0)
    {
        return $this->where('tenant_id', $tenant_id, $limit, $offset);
    }

    public function getApproved($property_id = null, $limit = null, $offset = 0)
    {
        $sql = "SELECT * FROM {$this->table} WHERE status = 'approved'";
        if ($property_id) {
            $sql .= " AND property_id = ?";
        }
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        }
        $stmt = $this->pdo->prepare($sql);
        if ($property_id) {
            $stmt->execute([$property_id]);
        } else {
            $stmt->execute();
        }
        return $stmt->fetchAll();
    }

    public function getAverageRating($property_id)
    {
        $stmt = $this->pdo->prepare("SELECT AVG(rating) as avg_rating FROM {$this->table} WHERE property_id = ? AND status = 'approved'");
        $stmt->execute([$property_id]);
        $result = $stmt->fetch();
        return round($result['avg_rating'], 1);
    }

    public function getWithDetails($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT r.*, p.title as property_title, u.name as tenant_name
            FROM {$this->table} r
            LEFT JOIN properties p ON r.property_id = p.id
            LEFT JOIN users u ON r.tenant_id = u.id
            WHERE r.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
