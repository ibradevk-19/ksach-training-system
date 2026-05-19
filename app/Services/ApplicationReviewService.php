<?php

namespace App\Services;

use App\Models\Application;
use App\Models\ApplicationReview;
use Illuminate\Support\Facades\Auth;

class ApplicationReviewService
{
    public function analyze(Application $application): ApplicationReview
    {
        $application->load([
            'applicant',
            'track.eligibilityRules',
            'track.scoringRules',
            'answers.field',
        ]);

        $passedRules = [];
        $failedRules = [];
        $autoScore = 0;

        foreach ($application->track->eligibilityRules->where('is_active', true) as $rule) {
            $actualValue = $this->getValue($application, $rule->source, $rule->field_name);

            $passed = $this->compare(
                $actualValue,
                $rule->operator,
                $rule->expected_value
            );

            if ($passed) {
                $passedRules[] = [
                    'field' => $rule->field_name,
                    'message' => 'Passed',
                    'actual' => $actualValue,
                    'expected' => $rule->expected_value,
                ];
            } else {
                $failedRules[] = [
                    'field' => $rule->field_name,
                    'message' => $rule->failure_message,
                    'actual' => $actualValue,
                    'expected' => $rule->expected_value,
                ];
            }
        }

        foreach ($application->track->scoringRules->where('is_active', true) as $rule) {
            $actualValue = $this->getValue($application, $rule->source, $rule->field_name);

            if ($this->compare($actualValue, $rule->operator, $rule->expected_value)) {
                $autoScore += $rule->score;
            }
        }

        $eligibilityStatus = count($failedRules) > 0
            ? 'not_eligible'
            : 'eligible';

        $review = ApplicationReview::updateOrCreate(
            ['application_id' => $application->id],
            [
                'reviewed_by' => Auth::id(),
                'eligibility_status' => $eligibilityStatus,
                'auto_score' => $autoScore,
                'final_score' => $autoScore,
                'passed_rules' => $passedRules,
                'failed_rules' => $failedRules,
                'reviewed_at' => now(),
            ]
        );

        $application->update([
            'score' => $review->final_score,
            'status' => $eligibilityStatus === 'not_eligible'
                ? 'rejected'
                : 'under_review',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return $review;
    }

    private function getValue(Application $application, string $source, string $fieldName): mixed
    {
        if ($source === 'applicant') {
            return data_get($application->applicant, $fieldName);
        }

        if ($source === 'track') {
            return data_get($application->track, $fieldName);
        }

        if ($source === 'answer') {
            $answer = $application->answers
                ->first(fn ($answer) => $answer->field?->name === $fieldName);

            if (! $answer) {
                return null;
            }

            $decoded = json_decode($answer->answer, true);

            return json_last_error() === JSON_ERROR_NONE
                ? $decoded
                : $answer->answer;
        }

        return null;
    }

    private function compare(mixed $actual, string $operator, mixed $expected): bool
    {
        if (is_array($expected) && count($expected) === 1 && !in_array($operator, ['in', 'not_in'])) {
            $expected = $expected[0];
        }

        if (is_array($actual) && in_array($operator, ['in', 'not_in'])) {
            $intersect = array_intersect($actual, (array) $expected);

            return $operator === 'in'
                ? count($intersect) > 0
                : count($intersect) === 0;
        }

        return match ($operator) {
            '=' => $actual == $expected,
            '!=' => $actual != $expected,
            '>' => is_numeric($actual) && is_numeric($expected) && $actual > $expected,
            '>=' => is_numeric($actual) && is_numeric($expected) && $actual >= $expected,
            '<' => is_numeric($actual) && is_numeric($expected) && $actual < $expected,
            '<=' => is_numeric($actual) && is_numeric($expected) && $actual <= $expected,
            'in' => in_array($actual, (array) $expected),
            'not_in' => !in_array($actual, (array) $expected),
            default => false,
        };
    }
}