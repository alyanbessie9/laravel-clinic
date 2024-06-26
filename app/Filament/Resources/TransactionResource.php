<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class TransactionResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Transaction::class;
    protected static ?string $navigationLabel = 'Transactions';
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_name')
                    ->relationship('patient', 'name')
                    ->required(),
                Forms\Components\Select::make('drug_id')
                    ->relationship('drug', 'drug_name')
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('total_price')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('currency')
                    ->default('IDR')
                    ->disabled(),
                Forms\Components\Textarea::make('prescription')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = static::getQueryFromApi();

        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('patient.name')
                    ->label('Patient')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('drug.drug_name')
                    ->label('Drug')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Price')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state, $record) => $record->currency . ' ' . number_format($state, 2)),
                Tables\Columns\TextColumn::make('prescription')
                    ->sortable()
                    ->searchable(),
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
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
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
            $response = Http::get('http://localhost:8080/transactions');
            $transactions = $response->json();
            if (!is_array($transactions)) {
                throw new \Exception('Invalid API response');
            }
            $transactionIds = collect($transactions)->pluck('id')->toArray();
            return Transaction::query()->whereIn('id', $transactionIds);
        } catch (\Exception $e) {
            return Transaction::query()->whereRaw('0 = 1');
        }
    }
}
