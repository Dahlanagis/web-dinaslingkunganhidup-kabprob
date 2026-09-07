<?php

$publicLayout = 'd:\DLH web PKL\resources\views\layouts\public.blade.php';
$welcome = 'd:\DLH web PKL\resources\views\welcome.blade.php';

$publicContent = file_get_contents($publicLayout);
$welcomeContent = file_get_contents($welcome);

// We want to extract everything between <!-- STATISTIK --> and <!-- FOOTER -->
$startMarker = '    <!-- STATISTIK -->';
$endMarker = '        <!-- FOOTER -->';

if (strpos($publicContent, $startMarker) !== false && strpos($publicContent, $endMarker) !== false) {
    // Split layout into 3 parts: BEFORE, THE CHUNK, AFTER
    $parts1 = explode($startMarker, $publicContent, 2);
    $beforeChunk = rtrim($parts1[0]);
    
    $parts2 = explode($endMarker, $parts1[1], 2);
    $theChunk = "\n" . $startMarker . $parts2[0];
    $afterChunk = "\n    " . ltrim($endMarker . $parts2[1]); // Ensure proper spacing
    
    // 1. Save Layout without the chunk
    $newPublicContent = $beforeChunk . "\n" . $afterChunk;
    file_put_contents($publicLayout, $newPublicContent);
    echo "Removed STATISTIK from public layout.\n";
    
    // 2. Add the chunk to welcome.blade.php right before <!-- LAYANAN UNGGULAN -->
    $targetMarker = '<!-- LAYANAN UNGGULAN -->';
    if (strpos($welcomeContent, $targetMarker) !== false) {
        $welcomeParts = explode($targetMarker, $welcomeContent, 2);
        $newWelcomeContent = rtrim($welcomeParts[0]) . "\n\n" . trim($theChunk) . "\n\n    " . $targetMarker . $welcomeParts[1];
        file_put_contents($welcome, $newWelcomeContent);
        echo "Added STATISTIK back to welcome.blade.php.\n";
    } else {
        echo "Could not find target marker in welcome.blade.php.\n";
    }
} else {
    echo "Could not find markers in public.blade.php.\n";
}
