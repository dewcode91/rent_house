<?php
/**
 * User Model
 */

require_once 'Model.php';

class User extends Model
{
    protected $table = 'users';

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function getByRole($role, $limit = null, $offset = 0)
    {
        return $this->where('role', $role, $limit, $offset);
    }

    public function getActive()
    {
        return $this->where('status', 'active');
    }
}
