<?php

namespace Agpretto\Wing\Console\Commands;

use Illuminate\Console\Command;

class WingInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wing:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Agpretto Wing Package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (app()->environment('production')) {
            $this->alert('Running in production mode.');
            if ($this->confirm('Proceed installing Agpretto Wing?')) {
                return;
            }
        }

        $this->comment('Publishing Wing migrations...');
        $this->callSilent('vendor:publish', [ '--tag' => 'wing-migrations' ]);

        $this->info('Wing installed successfully.');
    }
}
