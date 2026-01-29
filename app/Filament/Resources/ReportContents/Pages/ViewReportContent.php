<?php

namespace App\Filament\Resources\ReportContents\Pages;

use App\Filament\Resources\ReportContents\ReportContentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReportContent extends ViewRecord
{
    protected static string $resource = ReportContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
