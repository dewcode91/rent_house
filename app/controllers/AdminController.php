<?php
/**
 * Admin Controller
 */

require_once 'Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Property.php';
require_once __DIR__ . '/../models/PropertyType.php';
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../models/Page.php';
require_once __DIR__ . '/../middleware/Auth.php';

class AdminController extends Controller
{
    public function __construct($pdo)
    {
        parent::__construct($pdo);
        Auth::requireAdmin();
    }

    public function dashboard()
    {
        $userModel = new User($this->pdo);
        $propertyModel = new Property($this->pdo);
        $reviewModel = new Review($this->pdo);

        $stats = [
            'total_users' => $userModel->count(),
            'total_properties' => $propertyModel->count(),
            'total_owners' => $userModel->count('role', 'owner'),
            'total_tenants' => $userModel->count('role', 'tenant'),
            'pending_reviews' => $reviewModel->count('status', 'pending')
        ];

        $recentProperties = $propertyModel->getAllWithDetails(5);

        $this->view('admin.dashboard', ['stats' => $stats, 'recentProperties' => $recentProperties]);
    }

    public function propertyTypes()
    {
        $typeModel = new PropertyType($this->pdo);
        $types = $typeModel->all();

        $this->view('admin.property_types', ['types' => $types]);
    }

    public function addPropertyType()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');

            $errors = $this->validate(['name' => $name], ['name' => 'required']);

            if (empty($errors)) {
                $typeModel = new PropertyType($this->pdo);
                $existing = $typeModel->findByName($name);

                if ($existing) {
                    $errors['name'] = 'Property type already exists';
                } else {
                    if ($typeModel->create(['name' => $name, 'description' => $description])) {
                        $this->flash('success', 'Property type added successfully', 'success');
                        $this->redirect(SITE_URL . '/admin/property-types');
                    }
                }
            }

            $this->view('admin.add_property_type', ['errors' => $errors]);
        } else {
            $this->view('admin.add_property_type', ['errors' => []]);
        }
    }

    public function users()
    {
        $userModel = new User($this->pdo);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = ITEMS_PER_PAGE;
        $offset = ($page - 1) * $perPage;

        $users = $userModel->all($perPage, $offset);
        $total = $userModel->count();
        $totalPages = ceil($total / $perPage);

        $this->view('admin.users', [
            'users' => $users,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function properties()
    {
        $propertyModel = new Property($this->pdo);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = ITEMS_PER_PAGE;
        $offset = ($page - 1) * $perPage;

        $properties = $propertyModel->getAllWithDetails($perPage, $offset);
        $total = $propertyModel->count();
        $totalPages = ceil($total / $perPage);

        $this->view('admin.properties', [
            'properties' => $properties,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function reviews()
    {
        $reviewModel = new Review($this->pdo);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = ITEMS_PER_PAGE;
        $offset = ($page - 1) * $perPage;

        $reviews = $reviewModel->all($perPage, $offset);
        $total = $reviewModel->count();
        $totalPages = ceil($total / $perPage);

        foreach ($reviews as &$review) {
            $reviewModel->update($review['id'], ['status' => 'approved']);
        }

        $this->view('admin.reviews', [
            'reviews' => $reviews,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function pages()
    {
        $pageModel = new Page($this->pdo);
        $pages = $pageModel->all();

        $this->view('admin.pages', ['pages' => $pages]);
    }

    public function editPage()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect(SITE_URL . '/admin/pages');
        }

        $pageModel = new Page($this->pdo);
        $page = $pageModel->find($id);

        if (!$page) {
            $this->redirect(SITE_URL . '/admin/pages');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');

            $errors = $this->validate(['title' => $title], ['title' => 'required']);

            if (empty($errors)) {
                if ($pageModel->update($id, ['title' => $title, 'content' => $content])) {
                    $this->flash('success', 'Page updated successfully', 'success');
                    $this->redirect(SITE_URL . '/admin/pages');
                }
            }

            $this->view('admin.edit_page', ['page' => $page, 'errors' => $errors]);
        } else {
            $this->view('admin.edit_page', ['page' => $page, 'errors' => []]);
        }
    }

    public function toggleUserStatus()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect(SITE_URL . '/admin/users');
        }

        $userModel = new User($this->pdo);
        $user = $userModel->find($id);

        if ($user) {
            $newStatus = $user['status'] === 'active' ? 'inactive' : 'active';
            $userModel->update($id, ['status' => $newStatus]);
        }

        $this->redirect(SITE_URL . '/admin/users');
    }
}
