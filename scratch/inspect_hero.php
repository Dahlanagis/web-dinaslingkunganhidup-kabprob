<?php

$welcome = file_get_contents(__DIR__ . '/../resources/views/welcome.blade.php');
$public = file_get_contents(__DIR__ . '/../resources/views/layouts/public.blade.php');

preg_match_all('/class="[^"]*hero[^"]*"/', $welcome, $m1);
echo "Hero classes in welcome: \n" . implode("\n", array_unique($m1[0])) . "\n\n";

preg_match_all('/\.hero[^{]*\{[^}]*\}/s', $public, $m2);
echo "Hero styles in public.blade.php: \n" . implode("\n---\n", $m2[0]) . "\n\n";
