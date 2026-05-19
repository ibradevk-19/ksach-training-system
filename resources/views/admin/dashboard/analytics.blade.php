@extends('layouts.app')

@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">لوحة التحليلات</h2>
        <div class="text-muted">إحصائيات طلبات الانضمام للمسارات التدريبية</div>
      </div>
    </div>
  </div>

  <div class="row row-cards mb-3">

    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="subheader">إجمالي المتقدمين</div>
          <div class="h1 mb-0">{{ $summary['total_applicants'] }}</div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="subheader">إجمالي الطلبات</div>
          <div class="h1 mb-0">{{ $summary['total_applications'] }}</div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="subheader">المقبولين</div>
          <div class="h1 mb-0 text-success">{{ $summary['accepted'] }}</div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="subheader">المرفوضين</div>
          <div class="h1 mb-0 text-danger">{{ $summary['rejected'] }}</div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="subheader">قيد المراجعة</div>
          <div class="h1 mb-0 text-warning">{{ $summary['under_review'] }}</div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="subheader">قائمة الانتظار</div>
          <div class="h1 mb-0 text-primary">{{ $summary['waiting_list'] }}</div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="subheader">الطلبات المقدمة</div>
          <div class="h1 mb-0">{{ $summary['submitted'] }}</div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="subheader">ذوي الإعاقة</div>
          <div class="h1 mb-0">{{ $summary['disabled_applicants'] }}</div>
        </div>
      </div>
    </div>

  </div>

  <div class="row row-cards mb-3">

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">الطلبات حسب المسار</h3>
        </div>

        <div class="card-body">
          <canvas id="applicationsByTrackChart" height="180"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">الطلبات حسب الحالة</h3>
        </div>

        <div class="card-body">
          <canvas id="applicationsByStatusChart" height="180"></canvas>
        </div>
      </div>
    </div>

  </div>

  <div class="row row-cards mb-3">

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">توزيع المحافظات</h3>
        </div>

        <div class="card-body">
          <canvas id="governoratesChart" height="180"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">توزيع الجنس</h3>
        </div>

        <div class="card-body">
          <canvas id="genderChart" height="180"></canvas>
        </div>
      </div>
    </div>

  </div>

  <div class="row row-cards mb-3">

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">ذوي الإعاقة حسب المسار</h3>
        </div>

        <div class="card-body">
          <canvas id="disabledByTrackChart" height="180"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">أعلى الطلبات نقاطاً</h3>
        </div>

        <div class="table-responsive">
          <table class="table card-table table-vcenter">
            <thead>
              <tr>
                <th>#</th>
                <th>المتقدم</th>
                <th>المسار</th>
                <th>النقاط</th>
                <th>الحالة</th>
              </tr>
            </thead>

            <tbody>
              @forelse($topScoredApplications as $index => $application)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>
                    <div>{{ $application->applicant?->full_name }}</div>
                    <div class="text-muted">{{ $application->applicant?->national_id }}</div>
                  </td>
                  <td>{{ $application->track?->title }}</td>
                  <td><span class="badge bg-blue">{{ $application->score }}</span></td>
                  <td>
                    @include('admin.applications.partials.status-badge', ['status' => $application->status])
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center text-muted">لا توجد بيانات</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">حالة المقاعد حسب المسار</h3>
    </div>

    <div class="table-responsive">
      <table class="table card-table table-vcenter">
        <thead>
          <tr>
            <th>المسار</th>
            <th>المقاعد</th>
            <th>إجمالي الطلبات</th>
            <th>المقبولين</th>
            <th>قائمة الانتظار</th>
            <th>نسبة الإشغال</th>
          </tr>
        </thead>

        <tbody>
          @forelse($trackCapacityStats as $track)
            @php
              $percentage = $track->seats > 0
                ? round(($track->accepted_count / $track->seats) * 100)
                : 0;
            @endphp

            <tr>
              <td>{{ $track->title }}</td>
              <td>{{ $track->seats }}</td>
              <td>{{ $track->applications_count }}</td>
              <td>{{ $track->accepted_count }}</td>
              <td>{{ $track->waiting_count }}</td>
              <td>
                <div class="progress">
                  <div class="progress-bar" style="width: {{ min($percentage, 100) }}%">
                    {{ $percentage }}%
                  </div>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted">لا توجد مسارات</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const applicationsByTrack = @json($applicationsByTrack);
  const applicationsByStatus = @json($applicationsByStatus);
  const applicantsByGovernorate = @json($applicantsByGovernorate);
  const applicantsByGender = @json($applicantsByGender);
  const disabledByTrack = @json($disabledByTrack);

  function chartLabels(data) {
    return data.map(item => item.label);
  }

  function chartValues(data) {
    return data.map(item => item.total);
  }

  function createBarChart(canvasId, data) {
    new Chart(document.getElementById(canvasId), {
      type: 'bar',
      data: {
        labels: chartLabels(data),
        datasets: [{
          label: 'الإجمالي',
          data: chartValues(data)
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              precision: 0
            }
          }
        }
      }
    });
  }

  function createPieChart(canvasId, data) {
    new Chart(document.getElementById(canvasId), {
      type: 'pie',
      data: {
        labels: chartLabels(data),
        datasets: [{
          data: chartValues(data)
        }]
      },
      options: {
        responsive: true
      }
    });
  }

  createBarChart('applicationsByTrackChart', applicationsByTrack);
  createPieChart('applicationsByStatusChart', applicationsByStatus);
  createBarChart('governoratesChart', applicantsByGovernorate);
  createPieChart('genderChart', applicantsByGender);
  createBarChart('disabledByTrackChart', disabledByTrack);
</script>
@endpush