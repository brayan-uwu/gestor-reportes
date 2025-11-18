<?php

namespace App\Filament\Admin\Resources;
use App\Filament\Admin\Resources\ReportResource\Pages;

use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?string $navigationLabel = 'Reportes';
    protected static ?string $pluralLabel = 'Reportes';
    protected static ?string $modelLabel = 'Reporte';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Alumno')
                    ->relationship('student', 'name')
                    ->required(),

                Forms\Components\Select::make('type')
                    ->label('Tipo de reporte')
                    ->options([
                        'uniforme' => 'Uniforme',
                        'cabello' => 'Cabello',
                        'conducta' => 'Conducta',
                        'credencial' => 'Credencial',
                        'escrito' => 'Escrito',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Descripción'),

                Forms\Components\DatePicker::make('date')
                    ->label('Fecha del reporte')
                    ->required(),

                Forms\Components\FileUpload::make('image')
                    ->label('Imagen de evidencia')
                    ->image()
                    ->disk('public')
                    ->directory('reports')
                    ->visibility('public'),

                Forms\Components\Select::make('status')
                    ->label('Estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'resuelto' => 'Resuelto',
                        'en_progreso' => 'En Progreso',
                    ])
                    ->default('pendiente')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Alumno')
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo'),

                Tables\Columns\TextColumn::make('date')
                    ->label('Fecha')
                    ->date(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(50),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente' => 'warning',
                        'resuelto' => 'success',
                        'en_progreso' => 'info',
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
