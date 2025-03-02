<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainerResource\Pages;
use App\Filament\Resources\TrainerResource\RelationManagers;
use App\Models\City;
use App\Models\Trainer;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainerResource extends Resource
{
    protected static ?string $model = Trainer::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make()->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                TextInput::make('alt_email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('alt_phone')
                    ->tel()
                    ->maxLength(255),
                Select::make('country_id')
                    ->label('Country')
                    ->placeholder('Select a Country')
                    ->relationship('country', 'name') // Sends only 'id' to DB
                    ->live() // Ensures dynamic updates
                    ->required()
                    ->reactive() // Makes the field reactive
                    ->afterStateUpdated(fn (callable $set) => $set('city_id', null)), // Clears city selection when country changes
                Select::make('city_id')
                    ->label('City')
                    ->placeholder('Select a City')
                    ->options(fn (callable $get) => 
                        $get('country_id') 
                            ? City::where('country_id', $get('country_id'))->pluck('name', 'id')->toArray()
                            : []
                    )
                    ->searchable()
                    ->loadingMessage('Loading cities...')
                    ->required(),
                    ])->columns(3),
                ]),
                Section::make()
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('trainers'),
                    
                        Textarea::make('about'),
                    ])->columns(2),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alt_email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alt_phone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('country.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->searchable(),
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
            'index' => Pages\ListTrainers::route('/'),
            'create' => Pages\CreateTrainer::route('/create'),
            'edit' => Pages\EditTrainer::route('/{record}/edit'),
        ];
    }
}
