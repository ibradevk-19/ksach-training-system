<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\{ToCollection, WithHeadingRow};
use Illuminate\Support\Collection;

class DistributionListImport implements ToCollection, WithHeadingRow
{
  public function __construct(public array &$rows) {}

  public function collection(Collection $collection)
  {
    foreach ($collection as $row) {
      $this->rows[] = [
        'husband_name' => $row['اسم_الزوج'] ?? $row['husband_name'] ?? null,
        'husband_national_id' => $row['رقم_هوية_الزوج'] ?? $row['husband_national_id'] ?? null,
        'wife_name' => $row['اسم_الزوجة'] ?? $row['wife_name'] ?? null,
        'wife_national_id' => $row['رقم_هوية_الزوجة'] ?? $row['wife_national_id'] ?? null,
        'family_members_count' => $row['عدد_الافراد'] ?? $row['family_members_count'] ?? 0,
        'phone' => $row['رقم_التواصل'] ?? $row['phone'] ?? null,
      ];
    }
  }
}
