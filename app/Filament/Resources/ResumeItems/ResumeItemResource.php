<?php

namespace App\Filament\Resources\ResumeItems;

use App\Filament\Resources\ResumeItems\Pages\CreateResumeItem;
use App\Filament\Resources\ResumeItems\Pages\EditResumeItem;
use App\Filament\Resources\ResumeItems\Pages\ListResumeItems;
use App\Filament\Resources\ResumeItems\Schemas\ResumeItemForm;
use App\Filament\Resources\ResumeItems\Tables\ResumeItemsTable;
use App\Models\ResumeItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ResumeItemResource extends Resource
{
    protected static ?string $model = ResumeItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $navigationLabel = 'CV & Resume Items';

    protected static string|UnitEnum|null $navigationGroup = 'CV & Career';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ResumeItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResumeItemsTable::configure($table);
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
            'index' => ListResumeItems::route('/'),
            'create' => CreateResumeItem::route('/create'),
            'edit' => EditResumeItem::route('/{record}/edit'),
        ];
    }
}
