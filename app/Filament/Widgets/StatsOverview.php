<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\PurchaseOrder;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {

        // Totals per month


        $receptions = PurchaseOrder::where('status_id' , 1)->count();
        $receptionsPerMonth = PurchaseOrder::where('status_id' , 1)
        ->whereMonth('created_at', Carbon::now()->month)
        ->count();


        $internal = PurchaseOrder::where('status_id' , 2)->count();
        $picking = PurchaseOrder::where('status_id' , 3)->count();
        $delivery = PurchaseOrder::where('status_id' , 4)->count();
        return [
            Stat::make('Receptions', $receptions)
            ->color('success')
            ->description($receptionsPerMonth . ' this month')
            ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Internal Transit', $internal),
            Stat::make('Picking', $picking),
            Stat::make('Delivery Orders', $delivery),
        ];
    }
}
