<?php

namespace App\Exports;

use App\Models\DistributionListItem;
use App\Models\DistributionList;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{FromCollection, WithHeadings, WithMapping};

class DistributionItemsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(
        public int $distributionListId,
        public array $filters = []
    ) {}

    public function collection()
    {
        $list = DistributionList::with('aidType')->findOrFail($this->distributionListId);

        $eligibility = $this->filters['eligibility'] ?? 'all';
        $delivery    = $this->filters['delivery'] ?? 'all';
        $override    = $this->filters['override'] ?? 'all';
        $q           = trim((string)($this->filters['q'] ?? ''));

        return $list->items()
            ->with('beneficiary')
            ->when($eligibility !== 'all', function($query) use ($eligibility){
                if ($eligibility === 'eligible') {
                    $query->where(function($q){
                        $q->where('eligibility_status','eligible')->orWhere('is_override',1);
                    });
                } else {
                    $query->where('eligibility_status',$eligibility);
                }
            })
            ->when($delivery !== 'all', fn($query) => $query->where('delivery_status',$delivery))
            ->when($override !== 'all', fn($query) => $query->where('is_override',(int)$override))
            ->when($q, function($query) use ($q){
                $query->whereHas('beneficiary', function($b) use ($q){
                    $b->where('husband_name','like',"%$q%")
                      ->orWhere('wife_name','like',"%$q%")
                      ->orWhere('husband_national_id','like',"%$q%")
                      ->orWhere('wife_national_id','like',"%$q%")
                      ->orWhere('phone','like',"%$q%");
                });
            })
            ->orderByDesc('id')
            ->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'اسم الزوج',
            'هوية الزوج',
            'اسم الزوجة',
            'هوية الزوجة',
            'عدد الأفراد',
            'الهاتف',
            'التأهيل',
            'سبب عدم التأهيل',
            'Override',
            'سبب الاستثناء',
            'حالة الاستلام',
            'تاريخ الاستلام',
        ];
    }

    public function map($row): array
    {
        $b = $row->beneficiary;

        return [
            $row->id,
            $b?->husband_name ?? '',
            $b?->husband_national_id ?? '',
            $b?->wife_name ?? '',
            $b?->wife_national_id ?? '',
            $b?->family_members_count ?? '',
            $b?->phone ?? '',
            $row->eligibility_status,
            $row->ineligible_reason,
            $row->is_override ? 'yes' : 'no',
            $row->override_reason,
            $row->delivery_status,
            $row->delivered_at ? $row->delivered_at->format('Y-m-d H:i') : '',
        ];
    }
}
