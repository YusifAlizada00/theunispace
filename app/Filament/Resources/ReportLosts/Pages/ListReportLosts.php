<?php

namespace App\Filament\Resources\ReportLosts\Pages;

use App\Filament\Resources\ReportLosts\ReportLostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReportLosts extends ListRecords
{
    protected static string $resource = ReportLostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
