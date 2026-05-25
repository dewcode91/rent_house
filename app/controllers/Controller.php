<?php
/**
 * Base Controller Class
 */

class Controller
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Load a view file
     */
    public function view($name, $data = [])
    {
        extract($data);
        $file = __DIR__ . '/../views/' . str_replace('.', '/', $name) . '.php';
        if (file_exists($file)) {
            include $file;
        } else {
            die("View not found: {$name}");
        }
    }

    /**
     * Redirect to a URL
     */
    public function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }

    /**
     * Return JSON response
     */
    public function json($data, $status = 200)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }

    /**
     * Get POST data
     */
    public function post($key = null)
    {
        if ($key) {
            return $_POST[$key] ?? null;
        }
        return $_POST;
    }

    /**
     * Get GET data
     */
    public function get($key = null)
    {
        if ($key) {
            return $_GET[$key] ?? null;
        }
        return $_GET;
    }

    /**
     * Set flash message
     */
    public function flash($key, $message, $type = 'info')
    {
        $_SESSION['flash'][$key] = ['message' => $message, 'type' => $type];
    }

    /**
     * Get flash message
     */
    public function getFlash($key)
    {
        if (isset($_SESSION['flash'][$key])) {
            $flash = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $flash;
        }
        return null;
    }

    /**
     * Validate input
     */
    public function validate($data, $rules)
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? '';
            $conditions = explode('|', $rule);
            foreach ($conditions as $condition) {
                if ($condition === 'required' && empty($value)) {
                    $errors[$field] = ucfirst($field) . ' is required';
                } elseif (strpos($condition, 'min:') === 0) {
                    $min = (int)str_replace('min:', '', $condition);
                    if (strlen($value) < $min) {
                        $errors[$field] = ucfirst($field) . ' must be at least ' . $min . ' characters';
                    }
                } elseif (strpos($condition, 'max:') === 0) {
                    $max = (int)str_replace('max:', '', $condition);
                    if (strlen($value) > $max) {
                        $errors[$field] = ucfirst($field) . ' must not exceed ' . $max . ' characters';
                    }
                } elseif ($condition === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field] = ucfirst($field) . ' must be a valid email';
                }
            }
        }
        return $errors;
    }
}
