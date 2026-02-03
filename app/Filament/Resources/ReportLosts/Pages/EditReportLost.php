<?php

namespace App\Filament\Resources\ReportLosts\Pages;

use App\Filament\Resources\ReportLosts\ReportLostResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditReportLost extends EditRecord
{
    protected static string $resource = ReportLostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
