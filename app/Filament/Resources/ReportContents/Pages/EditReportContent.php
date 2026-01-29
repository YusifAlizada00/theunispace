<?php

namespace App\Filament\Resources\ReportContents\Pages;

use App\Filament\Resources\ReportContents\ReportContentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditReportContent extends EditRecord
{
    protected static string $resource = ReportContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
