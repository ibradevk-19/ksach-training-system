<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Services\ApplicationReviewService;
use Illuminate\Http\Request;

class ApplicationReviewController extends Controller
{
    public function review(Application $application)
    {
        $application->load([
            'applicant.governorate',
            'applicant.residenceType',
            'applicant.incomeType',
            'track',
            'answers.field',
            'files.field',
            'review',
        ]);

        return view('admin.reviews.show', compact('application'));
    }

    public function analyze(Application $application, ApplicationReviewService $service)
    {
        $service->analyze($application);

        return back()->with('success', 'تم تحليل الطلب واحتساب النقاط بنجاح');
    }

    public function manualScore(Request $request, Application $application)
    {
        $request->validate([
            'manual_score' => 'required|integer|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        $review = $application->review;

        if (! $review) {
            return back()->with('error', 'يرجى تحليل الطلب أولاً قبل إضافة تقييم يدوي.');
        }

        $finalScore = $review->auto_score + $request->manual_score;

        $review->update([
            'manual_score' => $request->manual_score,
            'final_score' => $finalScore,
            'notes' => $request->notes,
            'reviewed_at' => now(),
        ]);

        $application->update([
            'score' => $finalScore,
        ]);

        return back()->with('success', 'تم حفظ التقييم اليدوي');
    }
}