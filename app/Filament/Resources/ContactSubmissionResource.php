<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactSubmissionResource\Pages;
use App\Models\ContactSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'İletişim';
    protected static ?string $navigationLabel = 'Gelen Mesajlar';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'new')->count() ?: null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Mesaj Detayları')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Ad Soyad')
                            ->readonly(),
                        Forms\Components\TextInput::make('email')
                            ->label('E-posta')
                            ->email()
                            ->readonly(),
                        Forms\Components\TextInput::make('phone')
                            ->label('Telefon')
                            ->tel()
                            ->readonly(),
                        Forms\Components\TextInput::make('subject')
                            ->label('Konu')
                            ->readonly()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('message')
                            ->label('Mesaj')
                            ->readonly()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('status')
                            ->label('Durum')
                            ->options([
                                'new' => 'Yeni',
                                'read' => 'Okundu',
                                'replied' => 'Cevaplandı',
                            ])
                            ->default('new')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Ad Soyad')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-posta')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Konu')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->colors([
                        'danger' => 'new',
                        'warning' => 'read',
                        'success' => 'replied',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tarih')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Durum')
                    ->options([
                        'new' => 'Yeni',
                        'read' => 'Okundu',
                        'replied' => 'Cevaplandı',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('mark_as_read')
                        ->label('Okundu Olarak İşaretle')
                        ->icon('heroicon-o-check')
                        ->action(fn(Illuminate\Database\Eloquent\Collection $records) => $records->each->update(['status' => 'read'])),
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
            'index' => Pages\ListContactSubmissions::route('/'),
            // 'create' => Pages\CreateContactSubmission::route('/create'), // No create needed
            // 'view' => Pages\ViewContactSubmission::route('/{record}'), // View page not strictly needed if using ViewAction with modal, but let's stick to standard if possible. 
            // Actually, resource ViewAction is usually modal by default unless configured otherwise or if View page exists.
            // Let's use simple resource approach or just ViewAction modal for now to minimize file creation.
        ];
    }
}
