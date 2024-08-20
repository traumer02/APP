<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-console';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // todo: удалить пользователя с проверкой что номер не верифиццирован и прошло больше двух часов
    }
}
