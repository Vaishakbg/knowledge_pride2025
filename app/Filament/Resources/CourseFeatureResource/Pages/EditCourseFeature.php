<?php

namespace App\Filament\Resources\CourseFeatureResource\Pages;

use App\Filament\Resources\CourseFeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCourseFeature extends EditRecord
{
    protected static string $resource = CourseFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
