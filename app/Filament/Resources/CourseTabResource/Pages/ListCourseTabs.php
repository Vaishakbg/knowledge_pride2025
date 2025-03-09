<?php

namespace App\Filament\Resources\CourseTabResource\Pages;

use App\Filament\Resources\CourseTabResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourseTabs extends ListRecords
{
    protected static string $resource = CourseTabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
