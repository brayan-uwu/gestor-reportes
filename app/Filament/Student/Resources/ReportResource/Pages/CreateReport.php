<?php

namespace App\Filament\Student\Resources\ReportResource\Pages;

use App\Filament\Student\Resources\ReportResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReport extends CreateRecord
{
    protected static string $resource = ReportResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['student_id'] = auth()->id();
        $data['status'] = 'pendiente';

        return $data;
    }

    public function mount(): void
    {
        if (!auth()->user()->active) {
            abort(403, 'Tu cuenta no está activada. Contacta al administrador.');
        }

        parent::mount();
    }
}
