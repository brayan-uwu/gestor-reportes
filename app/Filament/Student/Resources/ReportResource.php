<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\ReportResource\Pages;
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
    protected static ?string $navigationLabel = 'Mis Reportes';
    protected static ?string $pluralLabel = 'Mis Reportes';
    protected static ?string $modelLabel = 'Reporte';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                    ->directory('reports'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo'),

                Tables\Columns\TextColumn::make('date')
                    ->label('Fecha')
                    ->date(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(50),

                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente' => 'warning',
                        'en_progreso' => 'info',
                        'resuelto' => 'success',
                    }),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagen')
                    ->square(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'view' => Pages\ViewReport::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return auth()->check() && auth()->user()->active;
    }

    public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->active;
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('student_id', auth()->id());
    }
}
