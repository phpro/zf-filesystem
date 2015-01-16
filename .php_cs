<?php
$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->exclude('config')
    ->exclude('bin')
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/spec');

$config = Symfony\CS\Config\Config::create();
$config->fixers(Symfony\CS\FixerInterface::PSR2_LEVEL);
$config->finder($finder);
return $config;
