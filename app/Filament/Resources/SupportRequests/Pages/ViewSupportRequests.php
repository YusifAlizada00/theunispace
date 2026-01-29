<?php

namespace App\Filament\Resources\SupportRequests\Pages;

use App\Filament\Resources\SupportRequests\SupportRequestsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSupportRequests extends ViewRecord
{
    protected static string $resource = SupportRequestsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
