<?php

namespace App\Filament\Resources\ResumeItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ResumeItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->options([
                        'experience' => 'Work Experience',
                        'education' => 'Education',
                        'training' => 'Certifications & Training',
                        'language' => 'Language',
                        'volunteer' => 'Volunteer Experience',
                        'reference' => 'Professional Reference',
                        'skill' => 'Technical Skill',
                    ])
                    ->required(),
                TextInput::make('title')
                    ->required()
                    ->placeholder('e.g. Full-Stack Developer or Degree Name'),
                TextInput::make('subtitle')
                    ->placeholder('e.g. Company, Institution, or Skill summary'),
                TextInput::make('date_range')
                    ->placeholder('e.g. Jan 2024 - Present or Graduated 2021'),
                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
