<?php
/**
 * Main Controller
 */

require_once 'Controller.php';
require_once __DIR__ . '/../models/Property.php';
require_once __DIR__ . '/../models/Page.php';
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../middleware/Auth.php';

class MainController extends Controller
{
    public function index()
    {
        $propertyModel = new Property($this->pdo);
        $properties = $propertyModel->getAllWithDetails(6);

        $this->view('home', ['properties' => $properties]);
    }

    public function about()
    {
        $pageModel = new Page($this->pdo);
        $page = $pageModel->findBySlug('about');

        $this->view('about', ['page' => $page]);
    }

    public function contact()
    {
        $pageModel = new Page($this->pdo);
        $page = $pageModel->findBySlug('contact');

        $this->view('contact', ['page' => $page]);
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

        $this->view('properties.list', [
            'properties' => $properties,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function property()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect(SITE_URL . '/properties');
        }

        $propertyModel = new Property($this->pdo);
        $reviewModel = new Review($this->pdo);

        $property = $propertyModel->getWithDetails($id);
        if (!$property) {
            $this->redirect(SITE_URL . '/properties');
        }

        $reviews = $reviewModel->getApproved($id);
        $avgRating = $reviewModel->getAverageRating($id);

        $this->view('properties.detail', [
            'property' => $property,
            'reviews' => $reviews,
            'avgRating' => $avgRating
        ]);
    }

    public function privacy()
    {
        $pageModel = new Page($this->pdo);
        $page = $pageModel->findBySlug('privacy');

        $this->view('privacy', ['page' => $page]);
    }
}
