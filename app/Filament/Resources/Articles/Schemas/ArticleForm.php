<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Str;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('section_id')
                    ->label('Категорія')
                    ->relationship('section', 'name')
                    ->required(),
                Select::make('author_id')
                    ->label('Автор')
                    ->relationship('author', 'name')
                    ->default(null),
                TextInput::make('title')
                    ->label('Заголовок')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->label('Линк')
                    ->required(),
                Textarea::make('excerpt')
                    ->label('Опис')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->label('Контетн')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Зображення')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('articles')
                    ->visibility('public'),
                Select::make('status')
                    ->label('Статус')
                    ->options(['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'])
                    ->default('draft')
                    ->required(),
                DateTimePicker::make('published_at')
                    ->label('Дата публікації')
                    ->default(now()),
            ]);
    }
}
