<?php
$publicPath = 'd:/DLH web PKL/public';
$uri = '/storage/galleries/01M1ZF29SG4CM6JWR1ZGR0ZA85.jpg';
$full = $publicPath . $uri;

echo "Checking: $full\n";
echo "file_exists: " . (file_exists($full) ? 'YES' : 'NO') . "\n";
echo "is_file: " . (is_file($full) ? 'YES' : 'NO') . "\n";
echo "is_readable: " . (is_readable($full) ? 'YES' : 'NO') . "\n";

$storageDir = 'd:/DLH web PKL/public/storage';
echo "storage exists: " . (file_exists($storageDir) ? 'YES' : 'NO') . "\n";
echo "storage is_link: " . (is_link($storageDir) ? 'YES' : 'NO') . "\n";
echo "storage is_dir: " . (is_dir($storageDir) ? 'YES' : 'NO') . "\n";
if (file_exists($storageDir)) {
    print_r(scandir($storageDir));
}
