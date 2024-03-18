<?php

namespace App\Jobs;

use App\Commands\AddTextCommand;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExecuteCommand implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $command;

    /**
     * Job para processar os comandos de forma assíncrona.
     * Isso nos permite enfileirar os comandos para execução posterior
     */
    public function __construct($command)
    {
        $this->command = $command;
    }

    public function handle()
    {
        $this->command->execute();
    }
}
