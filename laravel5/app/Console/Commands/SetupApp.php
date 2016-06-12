<?php

namespace Xentry\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Yaml\Yaml;
use Xentry\Models\User;

class SetupApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup app';

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
        $this->info('Run migrations...');
        $process = new Process('php artisan migrate');
        $process->run();
        $this->line($process->getOutput());

        $this->info('Import fixtures...');
        $this->info('- parse yaml file...');
        $userFixtues = Yaml::parse(file_get_contents(base_path().'/../_shared/users.yml'));

        $this->info('- truncate users table...');
        User::truncate();

        foreach ($userFixtues as $userFixture) {
            $user = new User;

            $this->info(sprintf('- import %s...', $userFixture['name']));
            foreach ($userFixture as $k => $v) {
                if ($k == 'password') {
                    $v = bcrypt($v);
                }
                $user->$k = $v;
            }

            $user->save();
        }

        $this->info('Generate assets...');
        $process = new Process('gulp --production');
        $process->run();
        $this->line($process->getOutput());
    }
}
