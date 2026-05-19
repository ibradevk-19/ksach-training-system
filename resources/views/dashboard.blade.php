@extends('layouts.app')
@section('title','لوحة التحكم')
@section('page_title','لوحة التحكم')
@section('content')
<div class="container-xl">

  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="page-title">Dashboard</h2>
        <div class="text-secondary">نظرة عامة على عمليات الاستيراد والتوزيع</div>
      </div>
    </div>
  </div>

  {{-- KPIs --}}
  <div class="row row-cards">
    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <span class="bg-primary text-white avatar me-3">
              <i class="ti ti-users"></i>
            </span>
            <div>
              <div class="font-weight-medium">{{ number_format($totalBeneficiaries) }}</div>
              <div class="text-secondary">إجمالي المستفيدين</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <span class="bg-indigo text-white avatar me-3">
              <i class="ti ti-list-check"></i>
            </span>
            <div>
              <div class="font-weight-medium">{{ number_format($totalLists) }}</div>
              <div class="text-secondary">إجمالي الكشوفات</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <span class="bg-success text-white avatar me-3">
              <i class="ti ti-check"></i>
            </span>
            <div>
              <div class="font-weight-medium">{{ number_format($deliveredToday) }}</div>
              <div class="text-secondary">مستلمون اليوم</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <span class="bg-warning text-white avatar me-3">
              <i class="ti ti-hourglass"></i>
            </span>
            <div>
              <div class="font-weight-medium">{{ number_format($activeNotDelivered) }}</div>
              <div class="text-secondary">غير مستلمين (نشط)</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <span class="bg-cyan text-white avatar me-3">
              <i class="ti ti-chart-line"></i>
            </span>
            <div>
              <div class="font-weight-medium">{{ $deliveryRate7 }}%</div>
              <div class="text-secondary">نسبة التسليم (7 أيام)</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <span class="bg-teal text-white avatar me-3">
              <i class="ti ti-file-import"></i>
            </span>
            <div>
              <div class="font-weight-medium">{{ number_format($importsToday) }}</div>
              <div class="text-secondary">استيرادات اليوم</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Charts --}}
  <div class="row row-cards mt-2">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header"><h3 class="card-title">التسليم يوميًا (آخر 14 يوم)</h3></div>
        <div class="card-body">
          <canvas id="chartDelivered"></canvas>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card">
        <div class="card-header"><h3 class="card-title">نتائج آخر استيراد</h3></div>
        <div class="card-body">
          <div class="text-secondary mb-2">
            {{ $lastImport ? ('Batch #'.$lastImport->id.' - '.$lastImport->file_name) : 'لا يوجد' }}
          </div>
          <canvas id="chartEligibility"></canvas>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card">
        <div class="card-header"><h3 class="card-title">أعلى مساعدات</h3></div>
        <div class="card-body">
          <canvas id="chartTopAid"></canvas>
        </div>
      </div>
    </div>
  </div>

  {{-- Tables --}}
  <div class="row row-cards mt-2">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header"><h3 class="card-title">آخر الكشوفات</h3></div>
        <div class="table-responsive">
          <table class="table table-vcenter">
            <thead>
              <tr>
                <th>العنوان</th>
                <th>الحالة</th>
                <th>التقدم</th>
                <th class="w-1"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($latestLists as $l)
              <tr>
                <td>{{ $l->title }}</td>
                <td><span class="badge bg-{{ $l->status=='active'?'success':'secondary' }}">{{ $l->status }}</span></td>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <div class="progress flex-fill" style="height:8px">
                      <div class="progress-bar" style="width: {{ $l->progress }}%"></div>
                    </div>
                    <span class="text-secondary">{{ $l->progress }}%</span>
                  </div>
                </td>
                <td>
                  <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.distribution-lists.show',$l) }}">فتح</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card">
        <div class="card-header"><h3 class="card-title">آخر الاستيرادات</h3></div>
        <div class="table-responsive">
          <table class="table table-vcenter">
            <thead>
              <tr>
                <th>الملف</th>
                <th>الحالة</th>
                <th>الإجمالي</th>
                <th>المؤهل</th>
                <th>المكرر</th>
              </tr>
            </thead>
            <tbody>
              @foreach($latestImports as $b)
              <tr>
                <td>{{ $b->file_name }}</td>
                <td>
                  <span class="badge bg-{{ $b->status=='done'?'success':($b->status=='failed'?'danger':'warning') }}">
                    {{ $b->status }}
                  </span>
                </td>
                <td>{{ $b->total_rows }}</td>
                <td>{{ $b->eligible_count }}</td>
                <td>{{ $b->duplicate_count }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Line: Delivered daily
  new Chart(document.getElementById('chartDelivered'), {
    type: 'line',
    data: {
      labels: @json($days),
      datasets: [{ label: 'Delivered', data: @json($deliveredSeries) }]
    },
    options: { responsive: true, plugins: { legend: { display: true } } }
  });

  // Donut: Eligibility
  new Chart(document.getElementById('chartEligibility'), {
    type: 'doughnut',
    data: {
      labels: ['مؤهل','غير مؤهل','غير صالح','مكرر'],
      datasets: [{ data: [
        {{ $eligibilityDonut['eligible'] }},
        {{ $eligibilityDonut['not_eligible'] }},
        {{ $eligibilityDonut['invalid'] }},
        {{ $eligibilityDonut['duplicate'] }},
      ]}]
    },
    options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
  });

  // Bar: Top aids
  new Chart(document.getElementById('chartTopAid'), {
    type: 'bar',
    data: {
      labels: @json($topAidTypes->pluck('name')),
      datasets: [{ label: 'Lists', data: @json($topAidTypes->pluck('count')) }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
  });
</script>
@endpush
