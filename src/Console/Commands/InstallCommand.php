<?php

declare(strict_types=1);

namespace Cortex\Categories\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'cortex:install:categories')]
class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cortex:install:categories {--f|force : Force the operation to run when in production.} {--r|resource=* : Specify which resources to publish.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Cortex Categories Module.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->alert($this->description);

        ! $this->option('resource') || $this->call('cortex:publish:categories', [
            '--force' => $this->option('force'),
            '--resource' => $this->option('resource'),
        ]);

        $this->call('cortex:migrate:categories', ['--force' => $this->option('force')]);
        $this->call('cortex:seed:categories');
    }
}
