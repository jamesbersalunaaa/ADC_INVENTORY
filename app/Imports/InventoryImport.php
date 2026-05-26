<?php

namespace App\Imports;

use App\Models\InventoryItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InventoryImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!isset($row['item_description']) || $row['item_description'] == null) {
            return null;
        }

        return new InventoryItem([
            'item_description' => $row['item_description'],
            'quantity' => $row['quantity'] ?? 0,
            'unit' => $row['unit'] ?? null,
            'cost' => $row['cost'] ?? 0,
        ]);
    }
}