<?php

$publicLayout = 'd:\DLH web PKL\resources\views\layouts\public.blade.php';
$welcome = 'd:\DLH web PKL\resources\views\welcome.blade.php';

$publicContent = file_get_contents($publicLayout);
$welcomeContent = file_get_contents($welcome);

// We want to extract everything between <!-- LAYANAN UNGGULAN --> and <!-- FOOTER -->
$startMarker = '    <!-- LAYANAN UNGGULAN -->';
$endMarker = '    <!-- FOOTER -->';

if (strpos($publicContent, $startMarker) !== false && strpos($publicContent, $endMarker) !== false) {
    // Split layout into 3 parts: BEFORE, THE CHUNK, AFTER
    $parts1 = explode($startMarker, $publicContent, 2);
    $beforeChunk = rtrim($parts1[0]);
    
    $parts2 = explode($endMarker, $parts1[1], 2);
    $theChunk = "\n" . $startMarker . $parts2[0]; // Include the start marker
    $afterChunk = "\n    " . $endMarker . $parts2[1]; // Include the end marker
    
    // 1. Save Layout without the chunk
    $newPublicContent = $beforeChunk . "\n" . $afterChunk;
    file_put_contents($publicLayout, $newPublicContent);
    echo "Removed unwanted sections from public layout.\n";
    
    // 2. Add the chunk to welcome.blade.php right before @endsection
    $endSectionMarker = '@endsection';
    if (strpos($welcomeContent, $endSectionMarker) !== false) {
        $welcomeParts = explode($endSectionMarker, $welcomeContent, 2);
        $newWelcomeContent = rtrim($welcomeParts[0]) . "\n\n" . trim($theChunk) . "\n\n@endsection\n";
        file_put_contents($welcome, $newWelcomeContent);
        echo "Added sections back to welcome.blade.php.\n";
    } else {
        echo "Could not find @endsection in welcome.blade.php.\n";
    }
} else {
    echo "Could not find markers in public.blade.php.\n";
}
