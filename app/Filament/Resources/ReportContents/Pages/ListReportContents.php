<?php

namespace App\Filament\Resources\ReportContents\Pages;

use App\Filament\Resources\ReportContents\ReportContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReportContents extends ListRecords
{
    protected static string $resource = ReportContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
