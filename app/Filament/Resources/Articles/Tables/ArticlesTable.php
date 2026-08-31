<?php

namespace App\Filament\Resources\Articles\Tables;

use App\Models\Article;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Зображення')
                    ->state(fn(Article $record): string => $record->image_url),
                TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable(),
                TextColumn::make('section.name')
                    ->label('Категорія')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Статус')
                    ->badge(),
                TextColumn::make('view_count')
                    ->label('Перегляди')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Дата створення')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
