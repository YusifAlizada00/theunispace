<?php

namespace App\Filament\Resources\ReportLosts\Pages;

use App\Filament\Resources\ReportLosts\ReportLostResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReportLost extends ViewRecord
{
    protected static string $resource = ReportLostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
