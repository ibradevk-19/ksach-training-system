<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تقرير طلبات الانضمام</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            direction: rtl;
            text-align: right;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px;
            vertical-align: top;
        }

        th {
            background: #eee;
        }

        .summary {
            margin-bottom: 15px;
        }

        .summary td {
            font-weight: bold;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<h2>تقرير طلبات الانضمام للمسارات التدريبية</h2>

<table class="summary">
    <tr>
        <td>إجمالي الطلبات: {{ $summary['total'] }}</td>
        <td>المقبولين: {{ $summary['accepted'] }}</td>
        <td>قائمة الانتظار: {{ $summary['waiting_list'] }}</td>
        <td>المرفوضين: {{ $summary['rejected'] }}</td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>رقم الطلب</th>
            <th>اسم المتقدم</th>
            <th>رقم الهوية</th>
            <th>الجوال</th>
            <th>المسار</th>
            <th>الحالة</th>
            <th>الأهلية</th>
            <th>النقاط</th>
            <th>أسباب الرفض</th>
        </tr>
    </thead>

    <tbody>
        @foreach($applications as $application)
            <tr>
                <td>{{ $application->application_number }}</td>
                <td>{{ $application->applicant?->full_name }}</td>
                <td>{{ $application->applicant?->national_id }}</td>
                <td>{{ $application->applicant?->phone_1 }}</td>
                <td>{{ $application->track?->title }}</td>
                <td>{{ $application->status }}</td>
                <td>{{ $application->review?->eligibility_status ?? '-' }}</td>
                <td>{{ $application->score }}</td>
                <td>
                    @php
                        $failed = $application->review?->failed_rules ?? [];
                    @endphp

                    @foreach($failed as $rule)
                        - {{ $rule['message'] ?? '-' }}<br>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>