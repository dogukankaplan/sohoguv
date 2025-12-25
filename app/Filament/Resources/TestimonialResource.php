<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Yorumlar';
    protected static ?string $modelLabel = 'Yorum';
    protected static ?string $pluralModelLabel = 'Yorumlar';
    protected static ?string $navigationGroup = 'İçerik Yönetimi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Ad Soyad')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('company')
                    ->label('Firma')
                    ->maxLength(255),

                Forms\Components\TextInput::make('role')
                    ->label('Pozisyon')
                    ->maxLength(255),

                Forms\Components\Textarea::make('content')
                    ->label('Yorum')
                    ->required()
                    ->rows(4),

                Forms\Components\Select::make('rating')
                    ->label('Puan')
                    ->options([
                        1 => '⭐',
                        2 => '⭐⭐',
                        3 => '⭐⭐⭐',
                        4 => '⭐⭐⭐⭐',
                        5 => '⭐⭐⭐⭐⭐',
                    ])
                    ->default(5)
                    ->required(),

                Forms\Components\FileUpload::make('photo')
                    ->label('Fotoğraf')
                    ->image()
                    ->directory('testimonials')
                    ->imageEditor()
                    ->avatar()
                    ->circleCropper(),

                Forms\Components\Toggle::make('is_featured')
                    ->label('Ana Sayfada Göster')
                    ->default(false),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Ad Soyad')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('company')
                    ->label('Firma')
                    ->searchable(),

                Tables\Columns\TextColumn::make('rating')
                    ->label('Puan')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        5 => 'success',
                        4 => 'primary',
                        default => 'warning',
                    }),

                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('Öne Çıkan'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Öne Çıkan'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Aktif'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
