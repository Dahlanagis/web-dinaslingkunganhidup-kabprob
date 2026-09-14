<?php
$html = file_get_contents('scratch/list_galleries.html');
$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);

foreach ($xpath->query('//*[contains(@class, "fi-ta-header-ctn")]') as $el) {
    echo "=== fi-ta-header-ctn ===\n";
    echo $dom->saveHTML($el) . "\n";
}
