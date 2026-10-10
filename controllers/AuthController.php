<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/FarmerModel.php';
require_once __DIR__ . '/../models/InvestorModel.php';
require_once __DIR__ . '/../models/LandownerModel.php';

class AuthController
{
    private UserModel     $userModel;
    private FarmerModel   $farmerModel;
    private InvestorModel $investorModel;
    private LandownerModel $landownerModel;

    public function __construct()
    {
        $db = Database::getConnection();
        $this->userModel      = new UserModel($db);
        $this->farmerModel    = new FarmerModel($db);
        $this->investorModel  = new InvestorModel($db);
        $this->landownerModel = new LandownerModel($db);
    }


    public function handleLogin(): void
    {
        Auth::start();

        $this->ensureDemoAccounts();

        if (Auth::isLoggedIn()) {
            $this->redirectToDashboard(Auth::role());
            return;
        }

        $username = '';
        $error    = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($username === '') {
                $error = 'Enter Username or Email';
            } elseif ($password === '') {
                $error = 'Enter Password';
            } else {
                $user = $this->userModel->findByUsernameOrEmail($username);

                if ($user) {
                    $passwordValid = ($user['password'] === $password);

                    if (!$passwordValid) {
                        $error = 'Invalid Username/Email or Password';
                    } elseif ($user['status'] !== 'active') {
                        $error = 'Your account has been suspended. Please contact support.';
                    } else {
                        Auth::login((int)$user['id'], $user['name'], $user['role']);
                        $this->redirectToDashboard($user['role']);
                        return;
                    }
                } else {
                    $error = 'Invalid Username/Email or Password';
                }
            }
        }

        $GLOBALS['_auth_login_data'] = compact('username', 'error');
    }

    private function ensureDemoAccounts(): void
    {
        $demoAccounts = [
            ['name' => 'admin',  'email' => 'admin@demo.local',  'password' => 'admin',  'role' => 'admin'],
            ['name' => 'invest', 'email' => 'invest@demo.local', 'password' => 'invest', 'role' => 'investor'],
            ['name' => 'farmer', 'email' => 'farmer@demo.local', 'password' => 'farmer', 'role' => 'farmer'],
            ['name' => 'land',   'email' => 'land@demo.local',   'password' => 'land',   'role' => 'landowner'],
        ];

        foreach ($demoAccounts as $account) {
            $existing = $this->userModel->findByUsernameOrEmail($account['name']);
            if ($existing !== null) {
                continue;
            }

            $plainPassword = $account['password'];
            $newUserId = $this->userModel->createUser(
                $account['name'],
                $account['email'],
                $plainPassword,
                '',
                $account['role']
            );

            if ($newUserId > 0) {
                $this->createRoleProfile($newUserId, $account['role'], '', '', 0);
            }
        }
    }

    private function redirectToDashboard(string $role): void
    {
        $map = [
            'farmer'    => 'farmer/farmer-dashboard.php',
            'investor'  => 'investor/dashboard.php',
            'landowner' => 'landowner/landowner-dashboard.php',
            'admin'     => 'admin/admin-dashboard.php',
        ];
        $target = $map[$role] ?? 'home.php';
        header("Location: $target");
        exit();
    }


    public function handleRegistration(): void
    {
        Auth::start();

        $name           = '';
        $email          = '';
        $password       = '';
        $phone          = '';
        $address        = '';
        $role           = '';
        $specialization = '';
        $experience     = '';
        $message        = '';
        $message_type   = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name           = trim($_POST['name']           ?? '');
            $email          = trim($_POST['email']          ?? '');
            $password       = $_POST['password']            ?? '';
            $phone          = trim($_POST['phone']          ?? '');
            $address        = trim($_POST['address']        ?? '');
            $role           = trim($_POST['role']           ?? '');
            $specialization = trim($_POST['specialization'] ?? '');
            $experience     = trim($_POST['experience']     ?? '');

            if ($name === '' || $email === '' || $password === '' || $role === '') {
                $message      = 'Please fill in all required fields';
                $message_type = 'error';
            } elseif ($this->userModel->emailExists($email)) {
                $message      = 'Email Already Exists';
                $message_type = 'error';
            } else {
                $newUserId = $this->userModel->createUser($name, $email, $password, $phone, $role);

                if ($newUserId > 0) {
                    $profileCreated = $this->createRoleProfile($newUserId, $role, $address, $specialization, (int)$experience);

                    if ($profileCreated) {
                        $message      = 'Registration Successful! You can now log in.';
                        $message_type = 'success';
                        $name = $email = $password = $phone = $address = $role = $specialization = $experience = '';
                    } else {
                        $this->userModel->deleteUser($newUserId);
                        $message      = 'Registration failed. Please try again.';
                        $message_type = 'error';
                    }
                } else {
                    $message      = 'Registration failed. Please try again.';
                    $message_type = 'error';
                }
            }
        }

        $GLOBALS['_auth_reg_data'] = compact(
            'name', 'email', 'password', 'phone', 'address', 'role',
            'specialization', 'experience', 'message', 'message_type'
        );
    }

    private function createRoleProfile(int $userId, string $role, string $address, string $specialization, int $experience): bool
    {
        if ($role === 'farmer') {
            return $this->farmerModel->createProfile($userId, $specialization, $experience);
        }
        if ($role === 'investor') {
            return $this->investorModel->createProfile($userId);
        }
        if ($role === 'landowner') {
            return $this->landownerModel->createProfile($userId, $address);
        }
        return false;
    }
}
