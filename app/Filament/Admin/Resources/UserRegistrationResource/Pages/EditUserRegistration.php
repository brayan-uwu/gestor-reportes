<?php

namespace App\Filament\Admin\Resources\UserRegistrationResource\Pages;

use App\Filament\Admin\Resources\UserRegistrationResource;
use App\Mail\StudentWelcomeMail;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditUserRegistration extends EditRecord
{
    protected static string $resource = UserRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterSave(): void
    {
        $student = $this->record;

        // Send welcome email if student is now active
        if ($student->active) {
            try {
                Mail::to($student->email)->send(new StudentWelcomeMail($student));

                Notification::make()
                    ->title('¡Estudiante activado!')
                    ->body('Se ha enviado un email de bienvenida a ' . $student->email)
                    ->success()
                    ->send();
            } catch (\Exception $e) {
                Notification::make()
                    ->title('Estudiante activado')
                    ->body('El estudiante fue activado, pero hubo un error al enviar el email: ' . $e->getMessage())
                    ->warning()
                    ->send();
            }
        }
    }
}
