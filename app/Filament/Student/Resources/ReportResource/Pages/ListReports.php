<?php

namespace App\Filament\Student\Resources\ReportResource\Pages;

use App\Filament\Student\Resources\ReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReports extends ListRecords
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        if (!auth()->user()->active) {
            return [];
        }

        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Mis Reportes - Matrícula: ' . auth()->user()->enrollment;
    }
}
