<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Models\Doctor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ImageColumn;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;

class DoctorResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Doctor::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                        Forms\Components\FileUpload::make('profile_photo_path')
                            ->label('Profile Photo')
                            ->image()
                            ->directory('profile-photos')
                            ->required(),
                        Forms\Components\Select::make('user_id')
                            ->relationship('User', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('specialization')
                            ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = static::getQueryFromApi();
        return $table
            ->query($query)
            ->columns([
                Stack::make([
                        Tables\Columns\ImageColumn::make('profile_photo_path')
                            ->label('Profile Photo')
                            ->size(250),
                            
                        Tables\Columns\TextColumn::make('user.name')
                            ->label('Doctor Name')
                            ->sortable(),
                        Tables\Columns\TextColumn::make('specialization')
                            ->searchable(),
                        
                ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                // Any filters can be added here
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
            // Any defined relationships can be returned here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
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
            $response = Http::get('http://localhost:8080/doctors');
            $doctors = $response->json();
            $doctorIds = collect($doctors)->pluck('id')->toArray();
            return doctor::query()->whereIn('id', $doctorIds);
        } catch (\Exception $e) {
            return doctor::query()->whereRaw('0 = 1');
        }
    }
}
