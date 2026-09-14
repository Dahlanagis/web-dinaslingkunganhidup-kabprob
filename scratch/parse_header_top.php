<?php
$html = file_get_contents('scratch/list_galleries.html');
$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);

foreach ($xpath->query('//*[contains(@class, "fi-ta-header-ctn")]') as $el) {
    $lines = explode("\n", $dom->saveHTML($el));
    for ($i = 0; $i < min(40, count($lines)); $i++) {
        echo $lines[$i] . "\n";
    }
}
