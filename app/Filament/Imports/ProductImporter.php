<?php

namespace App\Filament\Imports;

use App\Models\Product;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('sku')
                ->label('SKU')
                ->rules(['max:255']),
            ImportColumn::make('slug')
                ->rules(['max:255']),
            ImportColumn::make('tags')
                ->rules(['max:65535']),
            ImportColumn::make('original_barcode')
                ->rules(['max:255']),
            ImportColumn::make('unit_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('category_id')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('description')
                ->rules(['max:255']),
            ImportColumn::make('notes')
                ->rules(['max:65535']),
            ImportColumn::make('image')
                ->rules(['max:65535']),
            ImportColumn::make('images')
                ->rules(['max:65535']),
            ImportColumn::make('price')
                ->numeric(),
        ];
    }

    public function resolveRecord(): ?Product
    {
        // return Product::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Product();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your product import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
