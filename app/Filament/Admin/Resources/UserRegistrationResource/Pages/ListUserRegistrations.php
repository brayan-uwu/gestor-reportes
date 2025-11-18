<?php

namespace App\Filament\Admin\Resources\UserRegistrationResource\Pages;

use App\Filament\Admin\Resources\UserRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserRegistrations extends ListRecords
{
    protected static string $resource = UserRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // No crear nuevos, solo gestionar existentes
        ];
    }
}
