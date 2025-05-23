<?php

namespace App\Filament\Resources;

use App\Models\Pinjam;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReportResource extends Resource
{
    protected static ?string $model = Pinjam::class; // Model utama adalah Pinjam
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    public static function table(Table $table): Table
    {
        return $table
            ->query(Pinjam::with(['mahasiswa', 'buku', 'kembali'])) // Eager load relasi
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.nama')->label('Nama Mahasiswa'),
                Tables\Columns\TextColumn::make('buku.judul')->label('Judul Buku'),
                Tables\Columns\TextColumn::make('tanggal_pinjam')->date()->label('Tanggal Pinjam'),
                Tables\Columns\TextColumn::make('tanggal_kembali')->date()->label('Tanggal Kembali'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('kembali.tanggal_pengembalian')
                    ->date()
                    ->label('Tanggal Pengembalian')
                    ->formatStateUsing(fn ($state) => $state ?? '-'),
                Tables\Columns\TextColumn::make('kembali.denda')
                    ->money('IDR') // Format rupiah
                    ->label('Denda')
                    ->formatStateUsing(fn ($state) => $state ?? 0),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\ReportResource\Pages\ListReports::route('/'),
        ];
    }
}