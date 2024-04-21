<?php

namespace App\Filament\Resources\PengaduanResource\Pages;

use App\Filament\Resources\PengaduanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListPengaduans extends ListRecords
{
    protected static string $resource = PengaduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'Belum Ditinjau' => Tab::make()->query(fn($query) => $query->where('status', 'Belum Ditinjau')),
            'Sedang Ditinjau' => Tab::make()->query(fn($query) => $query->where('status', 'Sedang Ditinjau')),
            'Selesai' => Tab::make()->query(fn($query) => $query->where('status', 'Selesai')),
        ];
    }
}
