<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseFeatureResource\Pages;
use App\Filament\Resources\CourseFeatureResource\RelationManagers;
use App\Models\CourseFeature;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseFeatureResource extends Resource
{
    protected static ?string $model = CourseFeature::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make()->schema([
                        Select::make('course_id')
                            ->required()
                            ->relationship('course', 'course_full_name'),
                        TextInput::make('feature')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        Select::make('order')
                            ->label('Order')
                            ->options(array_combine(range(1, 8), range(1, 8)))
                            ->required()
                        ])->columns(4),
                    ])
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course.course_full_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('feature')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourseFeatures::route('/'),
            'create' => Pages\CreateCourseFeature::route('/create'),
            'edit' => Pages\EditCourseFeature::route('/{record}/edit'),
        ];
    }
}
