@extends('layouts.frontend')

@section('content')
<div class="main-wrapper bg-white text-dark">
  <!-- Hero Section -->
  <section class="py-5 bg-white position-relative overflow-hidden">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <h1 class="fw-bold display-3 text-gradient mb-3">SIRUANG</h1>
          <p class="fs-5 text-muted mb-4">
            Sistem Penjadwalan Ruangan Kelas & Laboratorium.<br>
            <strong class="text-dark">Cepat. Rapi. Bebas Bentrok.</strong>
          </p>
          <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-lg rounded-pill shadow px-5 py-3">
            <i class="bi bi-calendar-plus me-2"></i> Booking Sekarang
          </a>
        </div>
        <div class="col-lg-6 text-center">
          <img src="{{ asset('assets/backend/img/LAB.jpg') }}" alt="Ilustrasi Ruangan" class="img-fluid rounded-5 shadow-lg" style="max-height: 360px;">
        </div>
      </div>
    </div>
    <div class="position-absolute top-0 end-0 opacity-25" style="z-index:0;">
      <img src="https://www.transparenttextures.com/patterns/cubes.png" alt="bg-texture" style="width: 600px;">
    </div>
  </section>

  <!-- Kalender Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="card border-0 shadow-lg rounded-5">
        <div class="card-body p-5">
          <h2 class="text-center mb-4 fw-semibold text-dark">Kalender Jadwal & Booking</h2>
          <div id="calendar" class="bg-white rounded-4 p-4 shadow-sm"></div>
          <div class="mt-5">
            <h6 class="fw-bold text-muted">Keterangan:</h6>
            <ul class="list-unstyled d-flex flex-wrap gap-4 mt-3">
              <li><span class="legend-box bg-warning me-2"></span> Booking Diterima / Selesai</li>
              <li><span class="legend-box bg-info me-2"></span> Jadwal Tetap</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- FullCalendar CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

<!-- FullCalendar Init Script -->
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
            container: 'body',
            html: true,
          });
        }
      }
    });
    calendar.render();
  });
</script>
<style>
  .text-gradient {
    background: linear-gradient(to right, #1e3a8a, #3b82f6); /* Deep Blue to Soft Blue */
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .btn-primary {
    background: linear-gradient(to right, #1e3a8a, #3b82f6);
    border: none;
    transition: all 0.3s ease-in-out;
  }

  .btn-primary:hover {
    background: linear-gradient(to right, #1e40af, #2563eb);
    transform: translateY(-2px);
  }

  .legend-box {
    display: inline-block;
    width: 18px;
    height: 18px;
    border-radius: 4px;
  }

  .shadow-lg {
    box-shadow: 0 10px 30px rgba(30, 58, 138, 0.15) !important; /* Soft Blue shadow */
  }

  #calendar {
    background-color: #ffffff;
    border-radius: 12px;
  }

  .tooltip-inner {
    background-color: #1e3a8a !important;
    color: #fff !important;
  }

  .tooltip-arrow::before {
    border-top-color: #1e3a8a !important;
  }

  body,
  .text-muted {
    color: #475569 !important; /* Muted gray-blue text */
  }

  .fw-bold {
    font-weight: 700 !important;
  }

  .fw-semibold {
    font-weight: 600 !important;
  }
</style>

@endsection
