<?php

namespace App\Filament\Resources\Sections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->withCount('publishedArticles'))
            ->columns([
                TextColumn::make('slug')
                    ->label('Слаг')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Назва категорії')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->label('Номер категорії')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Активність')
                    ->boolean(),
                TextColumn::make('published_articles_count')
                    ->label('Опубліковано статей')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Дата створення')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Останні зміни')
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