<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
use Filament\Widgets\Widget;
use Illuminate\Support\Number;
use Filament\Widgets\StatsOverviewWidget\Card;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Orders', Order::query()->where('status', 'new')->count()),
            Stat::make('Orders Processing', Order::query()->where('status', 'processing')->count()),
            Stat::make('Orders Shipped', Order::query()->where('status', 'shipped')->count()),
            Stat::make('Average Price', Number::currency(Order::query()->avg('grand_total'))),
        ];
    }

    private function formatRupiah($number)
    {
        return 'Rp ' . number_format($number, 2, ',', '.');
    }
}