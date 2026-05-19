<?php

namespace App\Exports;

use App\Models\BeneficiaryAidHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class BeneficiaryAidHistoryExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    public $allowedIds;
    
    public function __construct($allowedIds)
    {
          $this->allowedIds = $allowedIds;
    }

    public function collection()
    {
         $allowedIds = $this->allowedIds;
         
        return BeneficiaryAidHistory::with(['beneficiary', 'aidType', 'distributionList'])
            ->whereHas('beneficiary', function ($q) use ($allowedIds) {
                $q->whereIn('husband_national_id', $allowedIds);
            })
            ->orderByDesc('delivered_at')
            ->get()
            ->unique(fn ($item) => $item->beneficiary->husband_national_id ?? null)
            ->values()
            ->map(function ($item) {
                return [
                    'beneficiary_name' => $item->beneficiary->husband_name ?? '',
                    'husband_national_id'  => $item->beneficiary->husband_national_id ?? '',
                    'delivered_at'     => $item->delivered_at ? $item->delivered_at->format('Y-m-d H:i') : '',
                    'aid_type'         => $item->aidType->name ?? '',
                    'distribution_list' => $item->distributionList->title ?? '',
                    'distribution_date' => $item->distributionList->distribution_date ?? '',
                ];
            });
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $sheet->getStyle('A1:F1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D9E1F2'],
                    ],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);

                $highestRow = $sheet->getHighestRow();
                $sheet->getStyle("A1:F{$highestRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);

                $sheet->getStyle('A:F')->getAlignment()->setWrapText(true);
                $sheet->getRowDimension(1)->setRowHeight(28);
                $sheet->freezePane('A2');
                $sheet->setRightToLeft(true);
            },
        ];
    }

    public function headings(): array
    {
        return [
            'اسم المستفيد',
            'رقم الهوية',
            'تاريخ التسليم',
            'نوع المساعدة',
            'قائمة التوزيع',
            'تاريخ التوزيع',
        ];
    }
}