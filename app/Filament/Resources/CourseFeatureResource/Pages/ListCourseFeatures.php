<?php

namespace App\Filament\Resources\CourseFeatureResource\Pages;

use App\Filament\Resources\CourseFeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourseFeatures extends ListRecords
{
    protected static string $resource = CourseFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
