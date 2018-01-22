<?php
chdir(__DIR__);
$filePath = realpath(ltrim($_SERVER["REQUEST_URI"], '/'));
if ($filePath && is_file($filePath)) {
    if (strpos($filePath, __DIR__ . DIRECTORY_SEPARATOR) === 0 &&
        $filePath != __DIR__ . DIRECTORY_SEPARATOR . 'router.php' &&
        substr(basename($filePath), 0, 1) != '.'
    ) {
        if (strtolower(substr($filePath, -4)) == '.php') {
            include $filePath;
        } else {
            return false;
        }
    } else {
        header("HTTP/1.1 404 Not Found");
        echo "404 Not Found";
    }
} else {
    include __DIR__ . DIRECTORY_SEPARATOR . 'index.php';
}
