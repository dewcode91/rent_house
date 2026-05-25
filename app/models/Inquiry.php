<?php
/**
 * Inquiry Model
 */

require_once 'Model.php';

class Inquiry extends Model
{
    protected $table = 'inquiries';

    public function getByProperty($property_id, $limit = null, $offset = 0)
    {
        return $this->where('property_id', $property_id, $limit, $offset);
    }

    public function getByTenant($tenant_id, $limit = null, $offset = 0)
    {
        return $this->where('tenant_id', $tenant_id, $limit, $offset);
    }

    public function getByStatus($status, $limit = null, $offset = 0)
    {
        return $this->where('status', $status, $limit, $offset);
    }

    public function getWithDetails($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT i.*, p.title as property_title, u.name as tenant_name, u.email as tenant_email
            FROM {$this->table} i
            LEFT JOIN properties p ON i.property_id = p.id
            LEFT JOIN users u ON i.tenant_id = u.id
            WHERE i.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAnswer($inquiry_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM inquiry_answers WHERE inquiry_id = ? ORDER BY created_at DESC LIMIT 1");
        $stmt->execute([$inquiry_id]);
        return $stmt->fetch();
    }

    public function addAnswer($inquiry_id, $answer)
    {
        $stmt = $this->pdo->prepare("INSERT INTO inquiry_answers (inquiry_id, answer) VALUES (?, ?)");
        return $stmt->execute([$inquiry_id, $answer]);
    }
}
