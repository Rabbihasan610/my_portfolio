<?php

namespace App\Filament\Resources\Cvs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CvForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('file_path')
                    ->label('CV File (PDF)')
                    ->directory('cv')
                    ->acceptedFileTypes(['application/pdf'])
                    ->required(),
                TextInput::make('version')
                    ->placeholder('e.g. 2026.1'),
                Toggle::make('is_active')
                    ->label('Active CV')
                    ->default(true)
                    ->required(),
            ]);
    }
}
