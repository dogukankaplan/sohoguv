<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'İçerik Yönetimi';
    protected static ?string $navigationLabel = 'Projeler';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Proje Bilgileri')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Proje Adı')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                Forms\Components\Textarea::make('description')
                                    ->label('Kısa Açıklama')
                                    ->columnSpanFull(),

                                Forms\Components\RichEditor::make('content')
                                    ->label('Proje Detayları')
                                    ->toolbar(['h2', 'h3', 'bold', 'italic', 'bulletList', 'orderedList', 'link', 'undo', 'redo'])
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Forms\Components\Section::make('Görseller')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Kapak Görseli')
                                    ->image()
                                    ->directory('projects')
                                    ->required(),

                                Forms\Components\FileUpload::make('gallery')
                                    ->label('Proje Galerisi')
                                    ->image()
                                    ->directory('projects/gallery')
                                    ->multiple()
                                    ->reorderable(),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Durum & Detaylar')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->label('Proje Durumu')
                                    ->options([
                                        'completed' => 'Tamamlanan Proje',
                                        'ongoing' => 'Devam Eden Proje',
                                    ])
                                    ->required()
                                    ->default('completed'),

                                Forms\Components\TextInput::make('client')
                                    ->label('Müşteri'),

                                Forms\Components\TextInput::make('location')
                                    ->label('Lokasyon'),

                                Forms\Components\DatePicker::make('completion_date')
                                    ->label('Tamamlanma Tarihi'),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Aktif mi?')
                                    ->default(true),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Kapak'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Proje Adı')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->colors([
                        'success' => 'completed',
                        'warning' => 'ongoing',
                    ])
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'completed' => 'Tamamlandı',
                        'ongoing' => 'Devam Ediyor',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('client')
                    ->label('Müşteri')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'completed' => 'Tamamlanan',
                        'ongoing' => 'Devam Eden',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
