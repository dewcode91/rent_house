<?php
/**
 * PropertyType Model
 */

require_once 'Model.php';

class PropertyType extends Model
{
    protected $table = 'property_types';

    public function findByName($name)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE name = ?");
        $stmt->execute([$name]);
        return $stmt->fetch();
    }
}
