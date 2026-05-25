<?php
/**
 * Owner Controller
 */

require_once 'Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Property.php';
require_once __DIR__ . '/../models/PropertyType.php';
require_once __DIR__ . '/../models/Inquiry.php';
require_once __DIR__ . '/../middleware/Auth.php';

class OwnerController extends Controller
{
    public function __construct($pdo)
    {
        parent::__construct($pdo);
        Auth::requireOwner();
    }

    public function dashboard()
    {
        $propertyModel = new Property($this->pdo);
        $inquiryModel = new Inquiry($this->pdo);

        $ownerId = Auth::id();
        $properties = $propertyModel->getByOwner($ownerId);
        $totalProperties = count($properties);

        $pendingInquiries = $inquiryModel->getByStatus('pending');
        $pendingCount = count($pendingInquiries);

        $this->view('owner.dashboard', [
            'totalProperties' => $totalProperties,
            'pendingInquiries' => $pendingCount,
            'properties' => $properties
        ]);
    }

    public function properties()
    {
        $propertyModel = new Property($this->pdo);
        $ownerId = Auth::id();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = ITEMS_PER_PAGE;
        $offset = ($page - 1) * $perPage;

        $properties = $propertyModel->getByOwner($ownerId, $perPage, $offset);
        $total = $propertyModel->count('owner_id', $ownerId);
        $totalPages = ceil($total / $perPage);

        $this->view('owner.properties', [
            'properties' => $properties,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function addProperty()
    {
        $typeModel = new PropertyType($this->pdo);
        $types = $typeModel->all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $price = trim($_POST['price'] ?? '');
            $bedrooms = trim($_POST['bedrooms'] ?? '');
            $bathrooms = trim($_POST['bathrooms'] ?? '');
            $area = trim($_POST['area'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $city = trim($_POST['city'] ?? '');
            $state = trim($_POST['state'] ?? '');
            $country = trim($_POST['country'] ?? '');
            $type_id = trim($_POST['type_id'] ?? '');

            $errors = $this->validate(
                ['title' => $title, 'price' => $price, 'address' => $address, 'city' => $city],
                ['title' => 'required', 'price' => 'required', 'address' => 'required', 'city' => 'required']
            );

            if (empty($errors)) {
                $propertyModel = new Property($this->pdo);
                $image = '';

                if (!empty($_FILES['image']['name'])) {
                    $image = $this->uploadImage($_FILES['image']);
                }

                $propertyId = $propertyModel->create([
                    'owner_id' => Auth::id(),
                    'property_type_id' => $type_id,
                    'title' => $title,
                    'description' => $description,
                    'price' => $price,
                    'bedrooms' => $bedrooms,
                    'bathrooms' => $bathrooms,
                    'area' => $area,
                    'address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'property_image' => $image,
                    'status' => 'available'
                ]);

                if ($propertyId) {
                    $this->flash('success', 'Property added successfully', 'success');
                    $this->redirect(SITE_URL . '/owner/properties');
                }
            }

            $this->view('owner.add_property', ['types' => $types, 'errors' => $errors]);
        } else {
            $this->view('owner.add_property', ['types' => $types, 'errors' => []]);
        }
    }

    public function editProperty()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect(SITE_URL . '/owner/properties');
        }

        $propertyModel = new Property($this->pdo);
        $typeModel = new PropertyType($this->pdo);

        $property = $propertyModel->find($id);
        if (!$property || $property['owner_id'] != Auth::id()) {
            $this->redirect(SITE_URL . '/owner/properties');
        }

        $types = $typeModel->all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $price = trim($_POST['price'] ?? '');
            $bedrooms = trim($_POST['bedrooms'] ?? '');
            $bathrooms = trim($_POST['bathrooms'] ?? '');
            $area = trim($_POST['area'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $city = trim($_POST['city'] ?? '');
            $state = trim($_POST['state'] ?? '');
            $country = trim($_POST['country'] ?? '');
            $type_id = trim($_POST['type_id'] ?? '');
            $status = trim($_POST['status'] ?? 'available');

            $errors = $this->validate(
                ['title' => $title, 'price' => $price, 'address' => $address, 'city' => $city],
                ['title' => 'required', 'price' => 'required', 'address' => 'required', 'city' => 'required']
            );

            if (empty($errors)) {
                $image = $property['property_image'];

                if (!empty($_FILES['image']['name'])) {
                    $image = $this->uploadImage($_FILES['image']);
                }

                $propertyModel->update($id, [
                    'property_type_id' => $type_id,
                    'title' => $title,
                    'description' => $description,
                    'price' => $price,
                    'bedrooms' => $bedrooms,
                    'bathrooms' => $bathrooms,
                    'area' => $area,
                    'address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'property_image' => $image,
                    'status' => $status
                ]);

                $this->flash('success', 'Property updated successfully', 'success');
                $this->redirect(SITE_URL . '/owner/properties');
            }

            $this->view('owner.edit_property', ['property' => $property, 'types' => $types, 'errors' => $errors]);
        } else {
            $this->view('owner.edit_property', ['property' => $property, 'types' => $types, 'errors' => []]);
        }
    }

    public function inquiries()
    {
        $inquiryModel = new Inquiry($this->pdo);
        $propertyModel = new Property($this->pdo);

        $ownerId = Auth::id();
        $properties = $propertyModel->getByOwner($ownerId);
        $propertyIds = array_column($properties, 'id');

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = ITEMS_PER_PAGE;
        $offset = ($page - 1) * $perPage;

        $inquiries = [];
        foreach ($propertyIds as $propertyId) {
            $inquiries = array_merge($inquiries, $inquiryModel->getByProperty($propertyId));
        }

        $this->view('owner.inquiries', [
            'inquiries' => array_slice($inquiries, $offset, $perPage),
            'currentPage' => $page,
            'totalPages' => ceil(count($inquiries) / $perPage)
        ]);
    }

    public function answerInquiry()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect(SITE_URL . '/owner/inquiries');
        }

        $inquiryModel = new Inquiry($this->pdo);
        $inquiry = $inquiryModel->getWithDetails($id);

        if (!$inquiry) {
            $this->redirect(SITE_URL . '/owner/inquiries');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $answer = trim($_POST['answer'] ?? '');

            $errors = $this->validate(['answer' => $answer], ['answer' => 'required']);

            if (empty($errors)) {
                $inquiryModel->addAnswer($id, $answer);
                $inquiryModel->update($id, ['status' => 'answered']);
                $this->flash('success', 'Answer sent successfully', 'success');
                $this->redirect(SITE_URL . '/owner/inquiries');
            }

            $this->view('owner.answer_inquiry', ['inquiry' => $inquiry, 'errors' => $errors]);
        } else {
            $this->view('owner.answer_inquiry', ['inquiry' => $inquiry, 'errors' => []]);
        }
    }

    private function uploadImage($file)
    {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return '';
        }

        $filename = uniqid() . '_' . basename($file['name']);
        $uploadPath = UPLOAD_DIR . $filename;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $filename;
        }

        return '';
    }
}
