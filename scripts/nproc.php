<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$parser = (new \Linfo\Linfo())->getParser();

if ($parser !== null && method_exists($parser, 'getCPU') && is_array($CPU = $parser->getCPU())) {
    return (string) max(1, count($CPU));
}

return '1';
