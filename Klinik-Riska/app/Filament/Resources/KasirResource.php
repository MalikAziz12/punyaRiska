<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Kasir;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\PatientAppointment;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KasirResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KasirResource\RelationManagers;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;


class KasirResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Kasir::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->required()
                    ->relationship('patient','name'),
                Forms\Components\Select::make('gender')
                    ->options([
                       'Laki-Laki' => 'Laki-Laki',
                       'Perempuan' => 'Perempuan',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('prescription')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('address')

                    ->columnSpanFull(),
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->prefix('IDR')
                    ->numeric(),
                Forms\Components\DatePicker::make('pembayaran')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('patient.name')
                    ->description(fn (Kasir $record): string => $record->gender)
                    ->sortable(),
                Tables\Columns\TextColumn::make('prescription')
                    ->sortable(),
                // Tables\Columns\TextColumn::make('patient.dokter.name')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga')
                    ->numeric()
                    ->money('Rp.')
                    ->sortable(),
                Tables\Columns\IconColumn::make('pembayaran')
                    ->label('Payment')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('Preview Invoice')
                    ->url(fn (Kasir $record): string => route('preview-invoice', $record))
                    ->color('info')
                    ->openUrlInNewTab(),
                Action::make('Download Invoice')
                    ->url(fn (Kasir $record): string => route('download-invoice', $record))
                    ->color('light')
                    ->openUrlInNewTab()
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
            'index' => Pages\ListKasirs::route('/'),
            'create' => Pages\CreateKasir::route('/create'),
            'edit' => Pages\EditKasir::route('/{record}/edit'),
        ];
    }
    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any'
        ];
    }
}
