<?php

namespace App\Filament\Resources\RoleGenerateResource\Pages;

use App\Filament\Resources\RoleGenerateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoleGenerate extends EditRecord
{
    protected static string $resource = RoleGenerateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
