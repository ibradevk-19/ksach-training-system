<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{ToCollection, WithHeadingRow};

class OfflineDeliveredImport implements ToCollection, WithHeadingRow
{
    public function __construct(public array &$rows) {}

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $this->rows[] = [
                'item_id' => $row['item_id'] ?? null,
                'delivered_at' => $row['delivered_at'] ?? null,
                'note' => $row['note'] ?? null,
            ];
        }
    }
}
