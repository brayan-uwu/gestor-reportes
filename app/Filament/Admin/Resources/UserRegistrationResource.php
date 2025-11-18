<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserRegistrationResource\Pages;
use App\Mail\StudentWelcomeMail;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserRegistrationResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationLabel = 'Usuarios Registrados';
    protected static ?string $pluralLabel = 'Usuarios Registrados';
    protected static ?string $modelLabel = 'Usuario Registrado';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->disabled()
                    ->dehydrated(false),

                Forms\Components\TextInput::make('name')
                    ->label('Nombre del alumno')
                    ->required(),

                Forms\Components\TextInput::make('group')
                    ->label('Grupo')
                    ->required(),

                Forms\Components\TextInput::make('enrollment')
                    ->label('Matrícula')
                    ->unique(ignoreRecord: true)
                    ->required(),

                Forms\Components\TextInput::make('password')
                    ->label('Nueva Contraseña (opcional)')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state)),

                Forms\Components\Toggle::make('active')
                    ->label('Convertir en Estudiante Activo')
                    ->default(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Registro')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Completar Registro'),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserRegistrations::route('/'),
            'edit' => Pages\EditUserRegistration::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('active', false);
    }
}
