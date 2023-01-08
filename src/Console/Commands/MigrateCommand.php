<?php

declare(strict_types=1);

namespace Cortex\Categories\Console\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Rinvex\Categories\Console\Commands\MigrateCommand as BaseMigrateCommand;

#[AsCommand(name: 'cortex:migrate:categories')]
class MigrateCommand extends BaseMigrateCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cortex:migrate:categories {--f|force : Force the operation to run when in production.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Cortex Categories Tables.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        parent::handle();

        $path = config('cortex.categories.autoload_migrations') ?
            'app/cortex/categories/database/migrations' :
            'database/migrations/cortex/categories';

        if (file_exists($path)) {
            $this->call('migrate', [
                '--step' => true,
                '--path' => $path,
                '--force' => $this->option('force'),
            ]);
        } else {
            $this->warn('No migrations found! Consider publish them first: <fg=green>php artisan cortex:publish:categories</>');
        }

        $this->line('');
    }
}
