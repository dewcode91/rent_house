<?php
/**
 * DEBUG: URL Routing Diagnostics
 * Access this at: http://localhost/rent_house/debug.php
 */

echo "<h1>🔍 Rent House - URL Routing Diagnostics</h1>";
echo "<hr>";

// Display server variables
echo "<h2>SERVER Variables:</h2>";
echo "<pre>";
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "PHP_SELF: " . $_SERVER['PHP_SELF'] . "\n";
echo "</pre>";

// Show parsed request
echo "<h2>Parsed Request:</h2>";
$request = trim($_SERVER['REQUEST_URI'], '/');
echo "<pre>";
echo "Raw Request: $request\n";

// Remove the base path from the request
if (strpos($request, 'rent_house') === 0) {
    $request = substr($request, strlen('rent_house'));
    echo "After removing 'rent_house': $request\n";
}

$request = trim($request, '/');
echo "After trimming: '$request'\n";

// Parse the request
if (empty($request)) {
    $action = 'home';
    $param = null;
} else {
    $parts = explode('/', $request);
    $action = $parts[0] ?? 'home';
    $param = $parts[1] ?? null;
}

echo "Action: $action\n";
echo "Param: " . ($param ?? 'null') . "\n";
echo "</pre>";

// Check mod_rewrite
echo "<h2>Apache mod_rewrite Status:</h2>";
if (function_exists('apache_get_modules')) {
    if (in_array('mod_rewrite', apache_get_modules())) {
        echo "✅ mod_rewrite is ENABLED\n";
    } else {
        echo "❌ mod_rewrite is DISABLED - ENABLE IT!\n";
    }
} else {
    echo "⚠️ Cannot determine mod_rewrite status (apache_get_modules not available)\n";
}

// Check if .htaccess exists
echo "<h2>.htaccess Files:</h2>";
if (file_exists(__DIR__ . '/../.htaccess')) {
    echo "✅ /rent_house/.htaccess exists\n";
} else {
    echo "❌ /rent_house/.htaccess NOT found\n";
}

if (file_exists(__DIR__ . '/.htaccess')) {
    echo "✅ /rent_house/public/.htaccess exists\n";
} else {
    echo "❌ /rent_house/public/.htaccess NOT found\n";
}

// Display .htaccess content
echo "<h2>Root .htaccess Content:</h2>";
if (file_exists(__DIR__ . '/../.htaccess')) {
    echo "<pre>";
    echo htmlspecialchars(file_get_contents(__DIR__ . '/../.htaccess'));
    echo "</pre>";
} else {
    echo "❌ .htaccess not found!";
}

// Test URL generation
echo "<h2>Test URLs:</h2>";
echo "<ul>";
echo "<li><a href='/rent_house/'>/rent_house/ (Home)</a></li>";
echo "<li><a href='/rent_house/properties'>/rent_house/properties (Properties)</a></li>";
echo "<li><a href='/rent_house/about'>/rent_house/about (About)</a></li>";
echo "<li><a href='/rent_house/login'>/rent_house/login (Login)</a></li>";
echo "</ul>";

echo "<hr>";
echo "<p><strong>⏱️ Timestamp:</strong> " . date('Y-m-d H:i:s') . "</p>";
