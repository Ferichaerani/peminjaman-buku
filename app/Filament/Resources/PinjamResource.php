<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PinjamResource\Pages;
use App\Models\Pinjam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PinjamResource extends Resource
{
    protected static ?string $model = Pinjam::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mahasiswa_id')
                    ->relationship('mahasiswa', 'nama')
                    ->required(),

                Forms\Components\Select::make('buku_id')
                    ->relationship('buku', 'judul')
                    ->required(),

                Forms\Components\DatePicker::make('tanggal_pinjam')
                    ->required(),

                Forms\Components\DatePicker::make('tanggal_kembali'),

                Forms\Components\Select::make('status')
                    ->options([
                        'dipinjam' => 'Dipinjam',
                        'dikembalikan' => 'Dikembalikan',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.nama')
                    ->label('Mahasiswa'),

                Tables\Columns\TextColumn::make('buku.judul')
                    ->label('Judul Buku'),

                Tables\Columns\TextColumn::make('tanggal_pinjam')
                    ->date(),

                Tables\Columns\TextColumn::make('tanggal_kembali')
                    ->date(),

                Tables\Columns\TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPinjams::route('/'),
            'create' => Pages\CreatePinjam::route('/create'),
            'edit' => Pages\EditPinjam::route('/{record}/edit'),
        ];
    }
}
