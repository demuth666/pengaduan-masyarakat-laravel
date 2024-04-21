<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Pengaduan;

class PengaduanChart extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Belum Ditinjau', Pengaduan::where('status', 'Belum Ditinjau')->count())
                ->description('Aduan yang belum di tinjau')
                ->descriptionIcon('heroicon-m-shield-exclamation')
                ->color('danger'),
            Stat::make('Sedang Ditinjau', Pengaduan::where('status', 'Sedang Ditinjau')->count())
                ->description('Aduan yang sedang di tinjau')
                ->descriptionIcon('heroicon-m-arrow-path-rounded-square')
                ->color('warning')
            ,
            Stat::make('Selesai', Pengaduan::where('status', 'Selesai')->count())
                ->description('Aduan yang sudah di selesaikan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
        ];
    }
}
