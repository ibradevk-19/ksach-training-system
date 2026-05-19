<?php

namespace App\Exports;

use App\Models\Application;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ApplicationsReportExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private Request $request)
    {
    }

    public function collection()
    {
        return $this->query()->get();
    }

    public function headings(): array
    {
        return [
            'رقم الطلب',
            'اسم المتقدم',
            'رقم الهوية',
            'رقم الجوال',
            'الجنس',
            'المحافظة',
            'المسار',
            'حالة الطلب',
            'الأهلية',
            'النقاط',
            'أسباب الرفض',
            'تاريخ التقديم',
        ];
    }

    public function map($application): array
    {
        return [
            $application->application_number,
            $application->applicant?->full_name,
            $application->applicant?->national_id,
            $application->applicant?->phone_1,
            $application->applicant?->gender == 'male' ? 'ذكر' : 'أنثى',
            $application->applicant?->governorate?->name,
            $application->track?->title,
            $this->statusLabel($application->status),
            $this->eligibilityLabel($application->review?->eligibility_status),
            $application->score,
            $this->failedReasons($application),
            $application->submitted_at?->format('Y-m-d H:i'),
        ];
    }

    private function query()
    {
        $query = Application::with([
            'applicant.governorate',
            'track',
            'review',
        ])->latest();

        if ($this->request->filled('track_id')) {
            $query->where('track_id', $this->request->track_id);
        }

        if ($this->request->filled('status')) {
            $query->where('status', $this->request->status);
        }

        if ($this->request->filled('eligibility_status')) {
            $query->whereHas('review', function ($q) {
                $q->where('eligibility_status', $this->request->eligibility_status);
            });
        }

        if ($this->request->filled('gender')) {
            $query->whereHas('applicant', function ($q) {
                $q->where('gender', $this->request->gender);
            });
        }

        if ($this->request->filled('q')) {
            $query->where(function ($q) {
                $q->where('application_number', 'like', '%' . $this->request->q . '%')
                    ->orWhereHas('applicant', function ($applicantQuery) {
                        $applicantQuery->where('full_name', 'like', '%' . $this->request->q . '%')
                            ->orWhere('national_id', 'like', '%' . $this->request->q . '%')
                            ->orWhere('phone_1', 'like', '%' . $this->request->q . '%');
                    });
            });
        }

        return $query;
    }

    private function statusLabel(?string $status): string
    {
        return [
            'draft' => 'مسودة',
            'submitted' => 'مقدم',
            'under_review' => 'قيد المراجعة',
            'accepted' => 'مقبول',
            'rejected' => 'مرفوض',
            'waiting_list' => 'قائمة انتظار',
            'cancelled' => 'ملغي',
        ][$status] ?? '-';
    }

    private function eligibilityLabel(?string $status): string
    {
        return [
            'eligible' => 'مؤهل',
            'partially_eligible' => 'مؤهل جزئياً',
            'not_eligible' => 'غير مؤهل',
        ][$status] ?? '-';
    }

    private function failedReasons($application): string
    {
        $failed = $application->review?->failed_rules ?? [];

        return collect($failed)
            ->pluck('message')
            ->filter()
            ->implode(' | ');
    }
}