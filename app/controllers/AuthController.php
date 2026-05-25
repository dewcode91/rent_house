<?php
/**
 * Auth Controller
 */

require_once 'Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../middleware/Auth.php';

class AuthController extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $errors = $this->validate(
                ['email' => $email, 'password' => $password],
                ['email' => 'required|email', 'password' => 'required']
            );

            if (empty($errors)) {
                $userModel = new User($this->pdo);
                $user = $userModel->findByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    Auth::login($user);
                    $this->flash('success', 'Login successful', 'success');

                    if ($user['role'] === 'admin') {
                        $this->redirect(SITE_URL . '/admin/dashboard');
                    } elseif ($user['role'] === 'owner') {
                        $this->redirect(SITE_URL . '/owner/dashboard');
                    } else {
                        $this->redirect(SITE_URL . '/tenant/dashboard');
                    }
                } else {
                    $errors['login'] = 'Invalid email or password';
                }
            }

            $this->view('auth.login', ['errors' => $errors]);
        } else {
            $this->view('auth.login', ['errors' => []]);
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'tenant';

            $errors = $this->validate(
                ['name' => $name, 'email' => $email, 'password' => $password],
                ['name' => 'required|min:3', 'email' => 'required|email', 'password' => 'required|min:6']
            );

            if (empty($errors)) {
                $userModel = new User($this->pdo);
                $existingUser = $userModel->findByEmail($email);

                if ($existingUser) {
                    $errors['email'] = 'Email already registered';
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $userId = $userModel->create([
                        'name' => $name,
                        'email' => $email,
                        'password' => $hashedPassword,
                        'role' => $role,
                        'status' => 'active'
                    ]);

                    if ($userId) {
                        $this->flash('success', 'Registration successful. Please login.', 'success');
                        $this->redirect(SITE_URL . '/login');
                    } else {
                        $errors['general'] = 'Registration failed. Please try again.';
                    }
                }
            }

            $this->view('auth.register', ['errors' => $errors]);
        } else {
            $this->view('auth.register', ['errors' => []]);
        }
    }

    public function logout()
    {
        Auth::logout();
        $this->flash('success', 'Logged out successfully', 'success');
        $this->redirect(SITE_URL . '/');
    }
}
