<?php

namespace App\Filament\Resources\SupportRequests\Pages;

use App\Filament\Resources\SupportRequests\SupportRequestsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSupportRequests extends EditRecord
{
    protected static string $resource = SupportRequestsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
