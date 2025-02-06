
<?php
// error_reporting(0);
$path = dirname(__DIR__) . '/.env';
if (!file_exists($path)) {
    throw new Exception(".env file not found at: " . $path);
}

$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) {
        continue;
    }

    list($name, $value) = explode('=', $line, 2);
    $name = trim($name);
    $value = trim($value);
    $value = trim($value, '"\'');

    putenv(sprintf('%s=%s', $name, $value));
    $_ENV[$name] = $value;
    $_SERVER[$name] = $value;
}
try{
    $server   = $_ENV['HOSTNAME'];
    $username = $_ENV['USERNAME'];
    $password = $_ENV['PASSWORD'];
    $database = $_ENV['DATABASE'];
    $mysqli = mysqli_connect($server, $username, $password, $database);

    $server2   = $_ENV['HOSTNAME2'];
    $username2 = $_ENV['USERNAME2'];
    $password2 = $_ENV['PASSWORD2'];
    $database2 = $_ENV['DATABASE2'];
    $mysqli2 = mysqli_connect($server2, $username2, $password2, $database2);
} catch (\Throwable $th) {
    header('Location: error.php');
}
?>