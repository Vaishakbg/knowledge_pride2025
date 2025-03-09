<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Filament\Resources\ScheduleResource\RelationManagers;
use App\Models\City;
use App\Models\Country;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make()->schema([
                        Select::make('course_id')
                            ->required()
                            ->relationship('course', 'course_full_name'),
                        Select::make('type')
                            ->required()
                            ->options([
                                Schedule::TYPE_CLASSROOM => 'Classroom',
                                Schedule::TYPE_ONLINE => 'Online',
                                Schedule::TYPE_HYBRID => 'Hybrid',
                            ])
                            ->default(Schedule::TYPE_CLASSROOM),
                        Select::make('country_id')
                            ->label('Country')
                            ->placeholder('Select a Country')
                            ->relationship('country', 'name') // Sends only 'id' to DB
                            ->live() // Ensures dynamic updates
                            ->required()
                            ->reactive() // Makes the field reactive
                            ->afterStateUpdated(fn (callable $set) => $set('city_id', null)),
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
                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->required()
                            ->reactive()
                            ->minDate(now()) // Prevents past dates
                            ->afterStateUpdated(fn (callable $set, $state) => $set('end_date', null)),
                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->required()
                            ->reactive()
                            ->minDate(fn (callable $get) => $get('start_date') ?? now()),
                        TimePicker::make('start_time')
                            ->label('Start Time')
                            ->required()
                            ->seconds(false) // Removes seconds
                            ->format('h:i A') // 12-hour format with AM/PM
                            ->default('09:00 AM') // Default to 9 AM
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('end_time', '06:00 PM')),
                        TimePicker::make('end_time')
                            ->label('End Time')
                            ->required()
                            ->seconds(false)
                            ->format('h:i A')
                            ->default('06:00 PM'),
                        Select::make('currency')
                            ->label('Currency')
                            ->placeholder('Select a Currency')
                            ->options(Country::pluck('currency_code', 'currency_code')->toArray())
                            ->default('USD')
                            ->required(),
                        TextInput::make('std_price')
                            ->label('Standard Price')
                            ->required()
                            ->numeric(),
                        TextInput::make('eb_price')
                            ->label('Early Bird Price')
                            ->numeric(),
                        DatePicker::make('eb_date')
                            ->label('Early Bird Date'),
                        Select::make('trainer_id')
                            ->relationship('trainer', 'name'),
                        TextInput::make('venue')
                            ->maxLength(255),
                        TextInput::make('map')
                            ->maxLength(255),
                        TextInput::make('no_of_participants')
                            ->numeric()
                            ->default(0),
                        Select::make('schedule_status')
                            ->options([
                                Schedule::STATUS_UPCOMING => 'Upcoming',
                                Schedule::STATUS_ONGOING => 'Ongoing',
                                Schedule::STATUS_COMPLETED => 'Completed',
                                Schedule::STATUS_CANCELLED => 'Cancelled',
                            ])
                            ->default(Schedule::STATUS_UPCOMING),
                        Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                    ])->columns(4)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('course.course_short_name')
                    ->sortable(),
                TextColumn::make('type'),
                TextColumn::make('country.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('city.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date('d-m-Y')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date('d-m-Y')
                    ->sortable(),
                TextColumn::make('start_time')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('end_time')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('currency')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('std_price')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('eb_price')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('eb_date')
                    ->date('d-m-Y')
                    ->sortable(),
                TextColumn::make('trainer.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('venue')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('map')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('no_of_participants')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('schedule_status')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('course')
                    ->relationship('course', 'course_short_name'),
                SelectFilter::make('country')
                    ->relationship('country', 'name'),
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
