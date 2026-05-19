@php
    $labels = [
        'draft' => 'مسودة',
        'submitted' => 'مقدم',
        'under_review' => 'قيد المراجعة',
        'accepted' => 'مقبول',
        'rejected' => 'مرفوض',
        'waiting_list' => 'قائمة انتظار',
        'cancelled' => 'ملغي',
    ];

    $colors = [
        'draft' => 'secondary',
        'submitted' => 'blue',
        'under_review' => 'warning',
        'accepted' => 'success',
        'rejected' => 'danger',
        'waiting_list' => 'purple',
        'cancelled' => 'dark',
    ];
@endphp

<span class="badge bg-{{ $colors[$status] ?? 'secondary' }}">
    {{ $labels[$status] ?? $status }}
</span>