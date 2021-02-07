<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function OpenApi\scan;

class SwaggerScan extends Command
{
    protected $signature = 'swg:scan';

    public function handle()
    {
        $root = dirname(dirname(dirname(__DIR__)));
        $paths = [
            $root . '/Domain',
            $root . '/Service',
        ];
        $outputPath = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'public/swagger.json';
        $this->info('Scanning ' . json_encode($paths));
        $openApi = scan($paths);

        header('Content-Type: application/json');
        file_put_contents($outputPath, $openApi->toJson());

        $this->info('Output ' . $outputPath);
    }
}
