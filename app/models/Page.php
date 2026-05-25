<?php
/**
 * Page Model
 */

require_once 'Model.php';

class Page extends Model
{
    protected $table = 'pages';

    public function findBySlug($slug)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE slug = ?");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }
}
