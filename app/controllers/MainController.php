<?php
/**
 * Main Controller - Handles all public routes
 * 
 * PERMISSIONS:
 * ✅ PUBLIC (No Auth Required): home, about, contact, properties, property detail, privacy
 * ❌ PROTECTED: None (all main controller routes are public)
 */

require_once 'Controller.php';
require_once __DIR__ . '/../models/Property.php';
require_once __DIR__ . '/../models/Page.php';
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../middleware/Auth.php';

class MainController extends Controller
{
    /**
     * Home page - PUBLIC ACCESS
     * ✅ Guest, Tenant, Owner, Admin can access
     */
    public function index()
    {
        $propertyModel = new Property($this->pdo);
        $properties = $propertyModel->getAllWithDetails(6);

        $this->view('home', ['properties' => $properties]);
    }

    /**
     * About page - PUBLIC ACCESS
     * ✅ Guest, Tenant, Owner, Admin can access
     */
    public function about()
    {
        $pageModel = new Page($this->pdo);
        $page = $pageModel->findBySlug('about');

        $this->view('about', ['page' => $page]);
    }

    /**
     * Contact page - PUBLIC ACCESS
     * ✅ Guest, Tenant, Owner, Admin can access
     */
    public function contact()
    {
        $pageModel = new Page($this->pdo);
        $page = $pageModel->findBySlug('contact');

        $this->view('contact', ['page' => $page]);
    }

    /**
     * Browse all properties - PUBLIC ACCESS
     * ✅ Guest, Tenant, Owner, Admin can access (no authentication required)
     * 
     * Permission: EVERYONE
     */
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

    /**
     * View property details - PUBLIC ACCESS
     * ✅ Guest, Tenant, Owner, Admin can access (no authentication required)
     * 
     * Permission: EVERYONE
     * Features:
     * - Guests: Can view property but see login/register prompts to contact owner
     * - Authenticated: Can send inquiries to owner
     * 
     * Data passed to view:
     * - $property: Property details
     * - $reviews: Approved reviews
     * - $avgRating: Average rating
     * - $isAuthenticated: Boolean to show/hide inquiry button
     */
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

        // Check if user is authenticated (can send inquiry)
        $isAuthenticated = Auth::check();

        $this->view('properties.detail', [
            'property' => $property,
            'reviews' => $reviews,
            'avgRating' => $avgRating,
            'isAuthenticated' => $isAuthenticated
        ]);
    }

    /**
     * Privacy page - PUBLIC ACCESS
     * ✅ Guest, Tenant, Owner, Admin can access
     */
    public function privacy()
    {
        $pageModel = new Page($this->pdo);
        $page = $pageModel->findBySlug('privacy');

        $this->view('privacy', ['page' => $page]);
    }
}
