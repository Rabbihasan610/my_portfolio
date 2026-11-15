<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('category')
                    ->default('Laravel')
                    ->placeholder('e.g. Architecture, Fintech, SaaS, Performance'),
                TextInput::make('tags')
                    ->placeholder('Comma separated tags: Laravel, Redis, Security'),
                TextInput::make('youtube_video_id')
                    ->label('YouTube Video ID / URL')
                    ->placeholder('e.g. dQw4w9WgXcQ (from youtube.com/watch?v=...)'),
                TextInput::make('author_name')
                    ->default('Md Rabbi Hasan'),
                TextInput::make('reading_time')
                    ->default('5 min read'),
                FileUpload::make('image')
                    ->image()
                    ->directory('blog')
                    ->columnSpanFull(),
                Textarea::make('summary')
                    ->placeholder('Brief executive summary for SEO and card listings')
                    ->rows(2)
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_featured')
                    ->label('Featured Post')
                    ->default(false),
                Toggle::make('is_published')
                    ->label('Published')
                    ->default(true),
            ]);
    }
}
