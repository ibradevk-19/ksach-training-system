<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Applicant;
use App\Models\Track;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ApplicationService
{
    public function createApplication(Applicant $applicant, Track $track, array $data = []): Application
    {
        return DB::transaction(function () use ($applicant, $track, $data) {

            $this->validateApplicantCanApply($applicant, $track);

            return Application::create([
                'applicant_id' => $applicant->id,
                'track_id' => $track->id,
                'application_number' => $this->generateApplicationNumber(),
                'status' => $data['status'] ?? 'submitted',
                'score' => $data['score'] ?? 0,
                'notes' => $data['notes'] ?? null,
                'created_by' => Auth::id() ?? null,
                'submitted_at' => now(),
            ]);
        });
    }

    public function validateApplicantCanApply(Applicant $applicant, Track $track): void
    {
        if (!$applicant->is_active) {
            throw ValidationException::withMessages([
                'applicant_id' => 'لا يمكن إنشاء طلب لمتقدم غير نشط.',
            ]);
        }

        if ($track->status !== 'published') {
            throw ValidationException::withMessages([
                'track_id' => 'لا يمكن التقديم على مسار غير منشور.',
            ]);
        }

        if ($track->registration_start && now()->lt($track->registration_start)) {
            throw ValidationException::withMessages([
                'track_id' => 'لم يبدأ التسجيل لهذا المسار بعد.',
            ]);
        }

        if ($track->registration_end && now()->gt($track->registration_end)) {
            throw ValidationException::withMessages([
                'track_id' => 'انتهت فترة التسجيل لهذا المسار.',
            ]);
        }

        if ($track->gender !== 'both' && $track->gender !== $applicant->gender) {
            throw ValidationException::withMessages([
                'track_id' => 'جنس المتقدم لا يتوافق مع شروط هذا المسار.',
            ]);
        }

        if ($applicant->birth_date) {
            $age = $applicant->birth_date->age;

            if ($track->min_age && $age < $track->min_age) {
                throw ValidationException::withMessages([
                    'track_id' => 'عمر المتقدم أقل من الحد الأدنى للمسار.',
                ]);
            }

            if ($track->max_age && $age > $track->max_age) {
                throw ValidationException::withMessages([
                    'track_id' => 'عمر المتقدم أكبر من الحد الأعلى للمسار.',
                ]);
            }
        }

        if (!$this->allowMultipleApplications()) {
            $hasAnyApplication = Application::where('applicant_id', $applicant->id)
                ->whereNotIn('status', ['cancelled'])
                ->exists();

            if ($hasAnyApplication) {
                throw ValidationException::withMessages([
                    'applicant_id' => 'هذا المتقدم لديه طلب سابق، ولا يسمح له بالتقديم لأكثر من مسار حالياً.',
                ]);
            }
        }

        $sameTrackApplication = Application::where('applicant_id', $applicant->id)
            ->where('track_id', $track->id)
            ->exists();

        if ($sameTrackApplication) {
            throw ValidationException::withMessages([
                'track_id' => 'هذا المتقدم لديه طلب سابق على نفس المسار.',
            ]);
        }

        $acceptedCount = Application::where('track_id', $track->id)
            ->where('status', 'accepted')
            ->count();

        if ($track->seats > 0 && $acceptedCount >= $track->seats && !$track->allow_waiting_list) {
            throw ValidationException::withMessages([
                'track_id' => 'اكتمل عدد المقاعد لهذا المسار.',
            ]);
        }
    }

    public function updateStatus(Application $application, string $status, ?string $notes = null): Application
    {
        $application->update([
            'status' => $status,
            'notes' => $notes,
            'reviewed_by' => Auth::id() ?? null,
            'reviewed_at' => now(),
        ]);

        return $application;
    }

    private function allowMultipleApplications(): bool
    {
        return (bool) setting('allow_multiple_applications', 0);
    }

    private function generateApplicationNumber(): string
    {
        do {
            $number = 'APP-' . now()->format('Ymd') . '-' . random_int(10000, 99999);
        } while (Application::where('application_number', $number)->exists());

        return $number;
    }
}