@extends('layouts.backend')

@section('content')
<div class="container-fluid py-4">
  <div class="row g-4 mb-4">

    @php
      $cards = [
        ['icon' => 'ti-user', 'label' => 'User', 'count' => $user, 'route' => route('backend.user.index')],
        ['icon' => 'ti-door', 'label' => 'Ruangan', 'count' => $ruangan, 'route' => route('backend.ruangan.index')],
        ['icon' => 'ti-calendar', 'label' => 'Jadwal', 'count' => $jadwal, 'route' => route('backend.jadwal.index')],
        ['icon' => 'ti-bookmark', 'label' => 'Booking', 'count' => $booking, 'route' => route('backend.bookings.index')],
      ];
    @endphp

    @foreach($cards as $card)
      <div class="col-md-3">
        <a href="{{ $card['route'] }}" class="text-decoration-none">
          <div class="card border shadow-sm rounded-3 h-100">
            <div class="card-body text-center py-4">
              <i class="ti {{ $card['icon'] }} mb-3 text-secondary" style="font-size: 2.5rem;"></i>
              <h6 class="fw-semibold mb-1 text-dark">{{ $card['label'] }}</h6>
              <h4 class="fw-bold mb-0 text-primary">{{ $card['count'] }}</h4>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>

  <!-- Kalender -->
  <div class="card shadow-sm border-0 rounded-4">
    <div class="card-body">
      <h5 class="fw-bold mb-3 fw-bold"><i class="bi bi-calendar3 me-2"></i>Jadwal Booking</h5>
      <div id="calendar"></div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      height: 'auto',
      events: @json($events),
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek'
      }
    });
    calendar.render();
  });
</script>
@endpush
