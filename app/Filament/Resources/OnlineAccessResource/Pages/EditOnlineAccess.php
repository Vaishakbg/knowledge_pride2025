<?php

namespace App\Filament\Resources\OnlineAccessResource\Pages;

use App\Filament\Resources\OnlineAccessResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOnlineAccess extends EditRecord
{
    protected static string $resource = OnlineAccessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
