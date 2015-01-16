<?php

chdir(__DIR__ . '/..');
require_once('vendor/autoload.php');

// Fetch a list of all supported tags
$process = new \Symfony\Component\Process\Process('exiftool -f -listx');
$process->run();
$xml = $process->getOutput();

// Parse document
$doc = new DOMDocument();
$doc->loadXML($xml);
$xpath = new DOMXPath($doc);
$list = $xpath->query('//table');

// Write tags to config file:
$tags = [];
$content = [];
$content[] = '<?php return [';
foreach ($list as $tag) {
    $tag = strtolower($tag->getAttribute('g0'));
    if (in_array($tag, $tags)) {
        continue;
    }

    $tags[] = $tag;
    $content[] = "'{$tag}',";
}
$content[] = '];';

file_put_contents('config/exiftool-tags.php', implode(PHP_EOL, $content));

// Output:
printf('Written %s files to config/exiftool-tags.php', count($tags));