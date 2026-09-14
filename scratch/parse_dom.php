<?php
$html = file_get_contents('scratch/list_galleries.html');

// Let's inspect headings, headers, toolbar, table-header, etc.
$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);

echo "--- Headers ---\n";
foreach ($xpath->query('//header') as $h) {
    echo "header class: " . $h->getAttribute('class') . " | text: " . trim(substr($h->textContent, 0, 100)) . "\n";
}

echo "\n--- Divs with fi- ---\n";
foreach ($xpath->query('//*[contains(@class, "fi-ta-header") or contains(@class, "fi-ta-toolbar") or contains(@class, "fi-header")]') as $el) {
    echo "Tag: " . $el->tagName . " | class: " . $el->getAttribute('class') . "\n";
    echo "  Inner: " . trim(substr(strip_tags($el->textContent), 0, 120)) . "\n";
}
