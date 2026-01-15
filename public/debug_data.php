<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "<h1>Data & Config Debug</h1>";

// 1. Check Config
echo "<h2>Configuration</h2>";
echo "Current FileSystem Driver: <b>" . config('filesystems.default') . "</b> (Should be 'public')<br>";
echo "Public Disk Root: " . config('filesystems.disks.public.root') . "<br>";
echo "APP_URL: " . config('app.url') . "<br>";

// 2. Check Database
echo "<h2>Latest Blog Post</h2>";
try {
    $post = \App\Models\BlogPost::latest('updated_at')->first();
    if ($post) {
        echo "ID: " . $post->id . "<br>";
        echo "Title: " . $post->title . "<br>";
        echo "Image Data (DB): <b>" . ($post->image ?? 'NULL') . "</b><br>";
        echo "Created At: " . $post->created_at . "<br>";
        echo "Updated At: " . $post->updated_at . "<br>";
    } else {
        echo "No blog posts found.<br>";
    }
} catch (\Exception $e) {
    echo "Database Error: " . $e->getMessage();
}

// 3. Check Logs (Last 10 lines)
echo "<h2>Recent Logs</h2>";
$logFile = storage_path('logs/laravel.log');
if (file_exists($logFile)) {
    $lines = file($logFile);
    $lastLines = array_slice($lines, -20);
    foreach ($lastLines as $line) {
        echo htmlspecialchars($line) . "<br>";
    }
} else {
    echo "Log file not found.";
}
