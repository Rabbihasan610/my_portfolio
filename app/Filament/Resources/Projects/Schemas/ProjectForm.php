<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
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
                    ->placeholder('e.g. SaaS, Fintech, ERP, GovTech, High-Traffic')
                    ->default('Laravel'),
                TextInput::make('purpose')
                    ->placeholder('e.g. Real-time Wallet Sync Engine'),
                TextInput::make('client')
                    ->placeholder('e.g. Healthcare Operator'),
                TextInput::make('duration')
                    ->placeholder('e.g. 6 Months'),
                FileUpload::make('image')
                    ->image()
                    ->directory('projects')
                    ->columnSpanFull(),
                TextInput::make('technology')
                    ->placeholder('e.g. Laravel, MySQL, Redis, Docker')
                    ->columnSpanFull(),
                TextInput::make('url')
                    ->url()
                    ->placeholder('https://example.com'),
                TextInput::make('github_url')
                    ->url()
                    ->placeholder('https://github.com/...'),
                Textarea::make('description')
                    ->placeholder('Executive summary of this project')
                    ->columnSpanFull(),
                Textarea::make('problem')
                    ->placeholder('What problem did the client or product face?')
                    ->columnSpanFull(),
                Textarea::make('solution')
                    ->placeholder('What architectural and engineering solution was built?')
                    ->columnSpanFull(),
                Textarea::make('use_case')
                    ->label('Deep-Dive Use Case & Architecture')
                    ->placeholder('Detailed step-by-step workflow, real-world scenario, or architecture breakdown')
                    ->rows(6)
                    ->columnSpanFull(),
                Textarea::make('features')
                    ->label('Key Features (One per line)')
                    ->placeholder("Feature 1\nFeature 2\nFeature 3")
                    ->rows(4)
                    ->columnSpanFull(),
                Textarea::make('results')
                    ->label('Measurable Results & Impact')
                    ->placeholder('e.g. Handled 5,000+ req/sec with 99.99% uptime')
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_featured')
                    ->label('Featured on Homepage')
                    ->default(false),
                Toggle::make('is_published')
                    ->label('Published')
                    ->default(true),
            ]);
    }
}
