<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaduanResource\Pages;
use App\Filament\Resources\PengaduanResource\RelationManagers;
use App\Models\Pengaduan;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextArea;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use App\Models\Status;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengaduanResource extends Resource
{
    protected static ?string $model = Pengaduan::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nik')
                    ->label('NIK')
                ,
                TextInput::make('nama')
                    ->label('Nama')
                ,
                TextArea::make('aduan')
                    ->label('Aduan')
                ,
                FileUpload::make('bukti')
                    ->directory('bukti')
                    ->label('Bukti')
                ,
                Select::make('status')
                    ->options([
                        'Belum Ditinjau' => 'Belum Ditinjau',
                        'Sedang Ditinjau' => 'Sedang Ditinjau',
                        'Selesai' => 'Selesai',
                    ])
                    ->label('Status')
                    ->placeholder('Pilih Status')
                ,
                DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('aduan')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Belum Ditinjau' => 'danger',
                        'Sedang Ditinjau' => 'warning',
                        'Selesai' => 'success',
                    })
                    ->sortable(),
                ImageColumn::make('bukti')
                    ->square(),
                TextColumn::make('tanggal')
                    ->searchable()
                    ->dateTime('Y-m-d')
                    ->sortable(),


            ])
            ->filters([
                Filter::make('created_at')

                    ->form([
                        DatePicker::make('created_from'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tanggal', '>=', $date),
                            );
                    })

            ])
            ->actions([
                Action::make('Detail')
                    ->form([
                        TextInput::make('nik')
                            ->label('NIK')
                            ->disabled(),
                        TextInput::make('nama')
                            ->label('Nama')
                            ->disabled(),
                        TextArea::make('aduan')
                            ->label('Aduan')
                            ->disabled(),
                        FileUpload::make('bukti')
                            ->label('Bukti')
                            ->disabled(),
                        Select::make('status')
                            ->options([
                                'Belum Ditinjau' => 'Belum Ditinjau',
                                'Sedang Ditinjau' => 'Sedang Ditinjau',
                                'Selesai' => 'Selesai',
                            ])
                            ->label('Status')
                            ->placeholder('Pilih Status')
                    ])
                    ->fillForm(fn(Pengaduan $record): array => [
                        'nik' => $record->nik,
                        'nama' => $record->nama,
                        'aduan' => $record->aduan,
                        'bukti' => $record->bukti,
                        'status' => $record->status,
                    ])
                    ->action(function ($data, Pengaduan $record): void {
                        $record->status = $data['status'];
                        $record->save();
                    })

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengaduans::route('/'),
            'create' => Pages\CreatePengaduan::route('/create'),
            'edit' => Pages\EditPengaduan::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
