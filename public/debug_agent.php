<?php

// Security: Only allow running if a secret param is present, or just keep it simple for now as it is a debug step
// Remove this file immediately after use.

echo "<h1>Server Debug Info</h1>";

// 1. Check PHP Info for Uploads
echo "<h2>PHP Configuration</h2>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
echo "post_max_size: " . ini_get('post_max_size') . "<br>";
echo "memory_limit: " . ini_get('memory_limit') . "<br>";

// 2. Check Directories
echo "<h2>Directory Permissions</h2>";
$dirs = [
    '../storage',
    '../storage/app',
    '../storage/app/public',
    '../storage/app/public/blogs',
    '../storage/framework/views',
    '../storage/logs'
];

foreach ($dirs as $dir) {
    $path = __DIR__ . '/' . $dir;
    $exists = file_exists($path) ? "EXISTS" : "MISSING";
    $writable = is_writable($path) ? "WRITABLE" : "NOT WRITABLE";
    $perms = file_exists($path) ? substr(sprintf('%o', fileperms($path)), -4) : "N/A";

    echo "Directory: <b>$dir</b> - $exists - $writable - Perms: $perms<br>";
}

// 3. Test Write
echo "<h2>Write Test</h2>";
$testFile = __DIR__ . '/../storage/app/public/blogs/test_agent.txt';
try {
    $result = file_put_contents($testFile, 'Test content from agent ' . date('Y-m-d H:i:s'));
    if ($result !== false) {
        echo "Successfully wrote to storage/app/public/blogs/test_agent.txt<br>";
        unlink($testFile);
        echo "Successfully deleted test file.<br>";
    } else {
        echo "FAILED to write to storage/app/public/blogs/test_agent.txt<br>";
    }
} catch (Exception $e) {
    echo "Exception during write test: " . $e->getMessage() . "<br>";
}

// 4. Env Check (Partial)
echo "<h2>Environment</h2>";
echo "APP_URL: " . getenv('APP_URL') . "<br>";
// Note: getenv might not show .env loaded by Laravel, but gives a hint.
