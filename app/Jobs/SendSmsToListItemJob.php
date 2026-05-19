<?php

namespace App\Jobs;

use App\Models\SmsLog;
use App\Services\SmsApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsToListItemJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $smsLogId,
        public string $mobile,
        public string $message
    ) {}

    public function handle(): void
    {
        $log = SmsLog::find($this->smsLogId);
        if (!$log || $log->status !== 'pending') return;

        try {
            // هنا نستخدم مزودك الحالي، لكن دالتك الحالية تستقبل باراميترات متعددة
            // لذلك نرسل رسالة جاهزة مباشرة عبر GET باستخدام Http داخل SmsApiService أو نضيف دالة sendRaw()
            // لتبسيط الموضوع الآن: سنسجل sent بشكل تجريبي، ويفضل تضيف SmsApiService::sendRaw($mobile,$message)
            // --- الحل الأفضل: أضف sendRaw داخل SmsApiService (أسفل)
            $result = SmsApiService::sendRaw($this->mobile, $this->message);

            if ($result['success'] ?? false) {
                $log->update([
                    'status' => 'sent',
                    'provider_code' => $result['code'] ?? null,
                    'provider_response' => $result['response'] ?? null,
                    'sent_at' => now(),
                ]);
            } else {
                $log->update([
                    'status' => 'failed',
                    'provider_code' => $result['code'] ?? null,
                    'provider_response' => $result['error'] ?? ($result['response'] ?? 'Provider error'),
                ]);
            }
        } catch (\Throwable $e) {
            $log->update([
                'status' => 'failed',
                'provider_response' => $e->getMessage(),
            ]);
        }
    }
}
