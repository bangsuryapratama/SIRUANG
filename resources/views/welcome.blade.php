@extends('layouts.frontend')

@section('content')

<div class="main-wrapper">
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 text-center text-lg-start">
          <h1 class="fw-bold text-primary display-4">SIRUANG</h1>
          <p class="text-muted fs-5 mb-4">
            Sistem Penjadwalan Ruangan Kelas dan Laboratorium.<br>
            <strong>Digital, efisien, dan bebas bentrok jadwal.</strong>
          </p>
          <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-lg px-4 py-2 rounded-pill shadow-sm">
            <i class="bi bi-calendar-plus me-2"></i> Booking Sekarang
          </a>
        </div>
        <div class="col-lg-6 text-center mt-4 mt-lg-0">
          <img src="{{ asset('assets/backend/img/LAB.jpg') }}" alt="Ilustrasi Ruangan" height="300" class="img-fluid rounded-4 shadow">
        </div>
      </div>
    </div>
  </section>
  <section class="py-5">
    <div class="container">
      <div class="card border-0 shadow rounded-4">
        <div class="card-body">
          <h4 class="fw-semibold text-center mb-4">Kalender Jadwal & Booking</h4>
          <div id="calendar" class="rounded-3 overflow-hidden"></div>
          <div class="mt-4">
            <h6>Keterangan:</h6>
            <ul class="list-unstyled d-flex flex-wrap gap-3">
              <li><span class="legend-box bg-warning"></span> Booking Diterima / Selesai</li>
              <li><span class="legend-box bg-info"></span> Jadwal Tetap</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'id',
      height: 'auto',
      aspectRatio: 1.6,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,listMonth'
      },
      buttonText: {
        today: 'Hari Ini',
        month: 'Bulan',
        listMonth: 'List'
      },
      events: @json($jadwal),
      eventDisplay: 'block',
      eventTextColor: '#fff',
      eventDidMount: function (info) {
        if (info.event.extendedProps.description) {
          new bootstrap.Tooltip(info.el, {
            title: info.event.extendedProps.description,
            placement: 'top',
            trigger: 'hover',
            container: 'body'
          });
        }
      }
    });
    calendar.render();
  });
</script>

{{-- Style --}}
<style>
  .btn-primary {
    transition: all 0.3s ease-in-out;
  }

  .btn-primary:hover {
    background-color: #1e6fb3;
    border-color: #1e6fb3;
  }

  .shadow {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08) !important;
  }

  #calendar {
    border-radius: 1rem;
    overflow: hidden;
    background-color: #ffffff;
  }

  .legend-box {
    display: inline-block;
    width: 20px;
    height: 20px;
    border-radius: 4px;
    margin-right: 8px;
  }
</style>

@endsection
