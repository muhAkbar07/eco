<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Order;

class OrderStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('New Orders', Order::query()->where('status', 'new')->count()),
            Card::make('Orders Processing', Order::query()->where('status', 'processing')->count()),
            Card::make('Orders Shipped', Order::query()->where('status', 'shipped')->count()),
            Card::make('Average Price', $this->formatRupiah($this->getAverageOrderPrice())),
        ];
    }

    private function getAverageOrderPrice(): float
    {
        $averagePrice = Order::query()->avg('grand_total');
        return $averagePrice !== null ? $averagePrice : 0.0;
    }

    private function formatRupiah($number)
    {
        return 'Rp ' . number_format($number, 2, ',', '.');
    }
}