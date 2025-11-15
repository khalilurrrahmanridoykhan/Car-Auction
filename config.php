<?php
    // Database Config (can be overridden with env vars for containers/local dev)
    $host = getenv('DB_HOST') ?: 'localhost';
    $db_port = getenv('DB_PORT') ?: '3306';
    $db   = getenv('DB_NAME') ?: 'car_auction';
    $db_user = getenv('DB_USER') ?: 'root';
    $pass = getenv('DB_PASS') ?: '';
    $charset = getenv('DB_CHARSET') ?: 'utf8mb4';

    // Admin Panel Config
    define('ADMIN_EMAIL', 'admin@gmail.com');
    define('ADMIN_PASS', 'admin');
    define('ADMIN_TOKEN', hash('sha256', ADMIN_EMAIL . ADMIN_PASS . 'SALT_KEY'));

    try {
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s', $host, $db_port, $db, $charset);
        $pdo = new PDO($dsn, $db_user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Force MySQL to use Asia/Dhaka timezone
        $pdo->exec("SET time_zone = '+06:00'");
    } catch (PDOException $e) {
        die("DB connection failed: " . $e->getMessage());
    }

    // Define Asia/Dhaka timezone
    date_default_timezone_set('Asia/Dhaka');

    // File Root
    $default_base_url = 'http://localhost/bid';
    $main_url = rtrim(getenv('APP_URL') ?: $default_base_url, '/');
    $get_api = $main_url . "/api";
    define('ROOT_PATH', __DIR__ . '/');


    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Get User Information
    $user = null;
    if (isset($_SESSION['user_id'])) {
        $stmt = $pdo->prepare("SELECT * FROM users 
            WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user['profile_status'] === 'banned') {
            if ($_SERVER['REQUEST_URI'] === "/bid/auth/profile.php") {
                // exit();
                
            }
            else {
                header("Location: " . $main_url . "/auth/profile.php");
            }
            // exit();
        }
    }


    // Session Auth
    function auth_check() {
        global $main_url;

        // Allow logged-in users
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            return;
        }else if (isset($_SESSION['auth_token']) && $_SESSION['auth_token'] === ADMIN_TOKEN) {
            return;
        }else {
            header("Location: " . $main_url . "/auth/signin.php");
            exit;
        }

        // Otherwise redirect to signin

    }

    // Admin Session Auth
    function admin_token_check(){
        if (!isset($_SESSION['auth_token']) || $_SESSION['auth_token'] !== ADMIN_TOKEN) {
            header("Location: " . $main_url);
            exit;
        }        
    }


    // Infinity Free Server Information
    // Domain: garikinbo.ct.ws
    // Pass: CUMIuJKRlF
    // User: if0_40122104
?>
