<?php
/**
 * Tenant Controller
 */

require_once 'Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Property.php';
require_once __DIR__ . '/../models/Inquiry.php';
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../middleware/Auth.php';

class TenantController extends Controller
{
    public function __construct($pdo)
    {
        parent::__construct($pdo);
        Auth::requireTenant();
    }

    public function dashboard()
    {
        $inquiryModel = new Inquiry($this->pdo);
        $reviewModel = new Review($this->pdo);

        $tenantId = Auth::id();
        $inquiries = $inquiryModel->getByTenant($tenantId);
        $reviews = $reviewModel->getByTenant($tenantId);

        $this->view('tenant.dashboard', [
            'totalInquiries' => count($inquiries),
            'totalReviews' => count($reviews),
            'recentInquiries' => array_slice($inquiries, 0, 5)
        ]);
    }

    public function inquiries()
    {
        $inquiryModel = new Inquiry($this->pdo);
        $tenantId = Auth::id();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = ITEMS_PER_PAGE;
        $offset = ($page - 1) * $perPage;

        $inquiries = $inquiryModel->getByTenant($tenantId, $perPage, $offset);
        $total = $inquiryModel->count('tenant_id', $tenantId);
        $totalPages = ceil($total / $perPage);

        $this->view('tenant.inquiries', [
            'inquiries' => $inquiries,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function submitInquiry()
    {
        $propertyId = $_GET['property_id'] ?? null;
        if (!$propertyId) {
            $this->redirect(SITE_URL . '/properties');
        }

        $propertyModel = new Property($this->pdo);
        $property = $propertyModel->find($propertyId);

        if (!$property) {
            $this->redirect(SITE_URL . '/properties');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = trim($_POST['message'] ?? '');

            $errors = $this->validate(['message' => $message], ['message' => 'required']);

            if (empty($errors)) {
                $inquiryModel = new Inquiry($this->pdo);
                $inquiryId = $inquiryModel->create([
                    'property_id' => $propertyId,
                    'tenant_id' => Auth::id(),
                    'message' => $message,
                    'status' => 'pending'
                ]);

                if ($inquiryId) {
                    $this->flash('success', 'Inquiry submitted successfully', 'success');
                    $this->redirect(SITE_URL . '/tenant/inquiries');
                }
            }

            $this->view('tenant.submit_inquiry', ['property' => $property, 'errors' => $errors]);
        } else {
            $this->view('tenant.submit_inquiry', ['property' => $property, 'errors' => []]);
        }
    }

    public function reviews()
    {
        $reviewModel = new Review($this->pdo);
        $tenantId = Auth::id();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = ITEMS_PER_PAGE;
        $offset = ($page - 1) * $perPage;

        $reviews = $reviewModel->getByTenant($tenantId, $perPage, $offset);
        $total = $reviewModel->count('tenant_id', $tenantId);
        $totalPages = ceil($total / $perPage);

        $this->view('tenant.reviews', [
            'reviews' => $reviews,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function submitReview()
    {
        $propertyId = $_GET['property_id'] ?? null;
        if (!$propertyId) {
            $this->redirect(SITE_URL . '/properties');
        }

        $propertyModel = new Property($this->pdo);
        $property = $propertyModel->find($propertyId);

        if (!$property) {
            $this->redirect(SITE_URL . '/properties');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rating = trim($_POST['rating'] ?? '');
            $comment = trim($_POST['comment'] ?? '');

            $errors = [];
            if (empty($rating) || $rating < 1 || $rating > 5) {
                $errors['rating'] = 'Please select a rating between 1 and 5';
            }
            if (empty($comment)) {
                $errors['comment'] = 'Comment is required';
            }

            if (empty($errors)) {
                $reviewModel = new Review($this->pdo);
                $reviewId = $reviewModel->create([
                    'property_id' => $propertyId,
                    'tenant_id' => Auth::id(),
                    'rating' => $rating,
                    'comment' => $comment,
                    'status' => 'pending'
                ]);

                if ($reviewId) {
                    $this->flash('success', 'Review submitted successfully. Awaiting approval.', 'success');
                    $this->redirect(SITE_URL . '/tenant/reviews');
                }
            }

            $this->view('tenant.submit_review', ['property' => $property, 'errors' => $errors]);
        } else {
            $this->view('tenant.submit_review', ['property' => $property, 'errors' => []]);
        }
    }

    public function profile()
    {
        $userModel = new User($this->pdo);
        $user = $userModel->find(Auth::id());

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $city = trim($_POST['city'] ?? '');
            $state = trim($_POST['state'] ?? '');
            $country = trim($_POST['country'] ?? '');

            $errors = $this->validate(['name' => $name], ['name' => 'required']);

            if (empty($errors)) {
                $userModel->update(Auth::id(), [
                    'name' => $name,
                    'phone' => $phone,
                    'address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country
                ]);

                $this->flash('success', 'Profile updated successfully', 'success');
                $this->redirect(SITE_URL . '/tenant/profile');
            }

            $this->view('tenant.profile', ['user' => $user, 'errors' => $errors]);
        } else {
            $this->view('tenant.profile', ['user' => $user, 'errors' => []]);
        }
    }
}
