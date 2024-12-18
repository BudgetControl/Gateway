<?php
declare(strict_types=1);

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Budgetcontrol\Connector\Client\WorkspaceClient workspaces()
 * @method static \Budgetcontrol\Connector\Client\EntryClient entry()
 * @method static \Budgetcontrol\Connector\Client\WalletClient wallet()
 * @method static \Budgetcontrol\Connector\Client\BudgetClient budget()
 * @method static \Budgetcontrol\Connector\Client\StatsClient stats()
 * @method static \Budgetcontrol\Connector\Client\SavingClient saving()
 * 
 * @see \Budgetcontrol\Connector\Factory\MicroserviceCLient
 */
final class MicroserviceCLient extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'MicroserviceCLient';
    }
}