<?php
/**
 * Author: Theo Champion
 * Date: 08/04/2023
 * Time: 09:51
 */


namespace LesIgnobles\BaseApiLaravel\Console;


use Illuminate\Console\Command;

abstract class BaseCommand extends Command
{
    protected ?float $startTime = null;
    protected ?float $endTime = null;
    protected array $logs = [];
    protected bool $hasCrashed = false;

    const DRY_RUN_OPTION = 'dry-run';

    protected function dryRun(): bool
    {
        return $this->hasOption(self::DRY_RUN_OPTION)
            ? $this->option(self::DRY_RUN_OPTION)
            : false;
    }

    protected function getExecutionTime(): float
    {
        if (is_null($this->startTime) || is_null($this->endTime)) {
            return -1;
        }
        return round($this->endTime - $this->startTime, 3);
    }

    protected function startTime()
    {
        $this->startTime = microtime(true);
    }

    protected function endTime()
    {
        $this->endTime = microtime(true);
    }

    protected function addLogs(mixed $log)
    {
        $this->logs[] = $log;
    }

    protected function generateReport(): array
    {
        return [
            'Execution time' => $this->getExecutionTime() . 's',
            'Crashed'        => $this->hasCrashed,
            'Logs'           => $this->logs,
            'Memory'         => round(memory_get_peak_usage() / (1024 * 1024)) . 'M'
        ];
    }

    protected abstract function sendReport(): void
}
