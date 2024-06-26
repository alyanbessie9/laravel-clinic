<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientAppointmentResource\Pages;
use App\Models\PatientAppointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class PatientAppointmentResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = PatientAppointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    //->options(self::fetchDoctors())
                    ->relationship('User', 'name')
                    ->required(),
                Forms\Components\DateTimePicker::make('appointment_date')
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('prescription')
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'completed' => 'Completed',
                    ])
                    ->required(),
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
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Doctor Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('appointment_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('notes')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('prescription')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Add any filters here if needed
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
            // Add any relations here if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatientAppointments::route('/'),
            'create' => Pages\CreatePatientAppointment::route('/create'),
            'edit' => Pages\EditPatientAppointment::route('/{record}/edit'),
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
            $response = Http::get('http://localhost:8080/appointments');
            $appointments = $response->json();
            if (!is_array($appointments)) {
                throw new \Exception('Invalid API response');
            }
            $appointmentIds = collect($appointments)->pluck('id')->toArray();
            return PatientAppointment::query()->whereIn('id', $appointmentIds);
        } catch (\Exception $e) {
            return PatientAppointment::query()->whereRaw('0 = 1');
        }
    }
}
