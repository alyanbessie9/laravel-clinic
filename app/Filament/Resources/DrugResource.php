<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DrugResource\Pages;
use App\Models\Drug;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;

class DrugResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Drug::class;
    protected static ?string $navigationLabel = 'Drug';
    protected static ?string $navigationIcon = 'heroicon-o-heart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('drug_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('drug_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('composition')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('packaging')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('dosage')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('contraindications')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('side_effects')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('currency')
                    ->options([
                        'Rp' => 'Rupiah (Rp)',
                        '$' => 'Dollar ($)',
                        '€' => 'Euro (€)',
                        '¥' => 'Yen (¥)',
                    ])
                    ->default('IDR')
                    ->required(),
                Forms\Components\DatePicker::make('expiration_date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(static::getQueryFromApi())
            ->columns([
                Tables\Columns\TextColumn::make('drug_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('drug_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('packaging')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dosage')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->sortable()
                    ->formatStateUsing(fn($state, $record) => $record->currency . ' ' . number_format($state, 2)),
                Tables\Columns\TextColumn::make('expiration_date')
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListDrugs::route('/'),
            'create' => Pages\CreateDrug::route('/create'),
            'edit' => Pages\EditDrug::route('/{record}/edit'),
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
            'delete_any',
        ];
    }

    protected static function getQueryFromApi(): Builder
    {
        try {
            $response = Http::get('http://localhost:8080/drugs');
            $drugs = $response->json();
            $drugIds = collect($drugs)->pluck('id')->toArray();
            return Drug::query()->whereIn('id', $drugIds);
        } catch (\Exception $e) {
            return Drug::query()->whereRaw('0 = 1');
        }
    }
}
