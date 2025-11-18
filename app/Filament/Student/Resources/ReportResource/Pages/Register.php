<?php

namespace App\Filament\Student\Resources\ReportResource\Pages;

use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    protected static string $view = 'filament-panels::pages.auth.register';

    protected function mutateFormDataBeforeRegister(array $data): array
    {
        $data['active'] = false;
        $data['name'] = '';
        $data['group'] = '';
        $data['enrollment'] = '';

        return $data;
    }
}
