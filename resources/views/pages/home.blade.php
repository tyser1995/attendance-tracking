@extends('layouts.app', [
'class' => ''
])
@section('content')
<div class="row container-fluid time-attendance-page">
    <!-- Left Column (Attendance Form + Logs) -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-header text-center d-none">
                <span class="h1"><b>RSG</b>-mAnoL</span>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <a href="{{ url('/home') }}">
                        <img src="{{ asset('images/no_logo.png') }}" style="width:150px"  alt="nologo"/>
                    </a>
                    <p class="login-box-msg"></p>
                </div>
                @include('notification.index')
                <form id="id-form" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="idnumber">ID Number</label>
                        <input type="text" class="form-control" name="idnumber" id="idnumber" required autofocus>
                        <small id="id-feedback" class="form-text"></small>
                    </div>
                </form>

                <!-- User Logs Table -->
                <div class="mt-4">
                    <h5 class="text-left mb-3">Logs</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID Number</th>
                                    <th>Name</th>
                                    <th>Time Punch</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 
                                @forelse($logs as $log)
                                    <tr>
                                        <td>{{ $log->user->id_number }}</td>
                                        <td>{{ $log->user->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($log->created_at)->format('M d, Y h:i:s A') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No logs found</td>
                                    </tr>
                                @endforelse
                                --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Date & Time Display -->
            <div class="card-footer text-left">
              <p id="date-time" class="mb-0 fw-bold" style="font-size: 1.5rem; color: #000;"></p>
            </div>
        </div>
    </div>

    <!-- Right Column (Announcements / Events) -->
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">📢 Announcements</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    @forelse($announcements as $announcement)
                        <li class="mb-3">
                            <strong>{{ $announcement->title }}</strong><br>
                            <small class="text-muted">{{ $announcement->created_at->format('M d, Y') }}</small>
                            <p>{{ $announcement->body }}</p>
                        </li>
                    @empty
                        <li>No announcements available</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">📅 Upcoming Events</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    @forelse($events as $event)
                        <li class="mb-3">
                            <strong>{{ $event->title }}</strong><br>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y h:i A') }}
                            </small>
                            <p>{{ $event->description }}</p>
                        </li>
                    @empty
                        <li>No upcoming events</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- <div class="mt-4">
        <h5 class="text-left mb-3">Available Patterns</h5>
        <ul>
            @forelse($patterns as $p)
                <li>{{ $p->pattern }} → <code>{{ $p->regex }}</code></li>
            @empty
                <li>No patterns available</li>
            @endforelse
        </ul>
        </div> --}}
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#id-form').on('submit', function(e) {
        e.preventDefault(); // prevent reload
    });

    /*$('#idnumber').on('input', function() {
        let idValue = $(this).val();

        if (idValue.length > 0) {
                $.ajax({
                    url: "{{ route('attendance') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        idnumber: idValue
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#id-feedback')
                                .text(response.message)
                                .css('color', 'green');

                            // clear old rows first
                            $('table tbody').empty();
                            // append new log to table
                            let newRow = `
                                <tr>
                                    <td>${response.data.idnumber}</td>
                                    <td>${response.data.name}</td>
                                    <td>${response.data.time_in ?? response.data.time_out}</td>
                                </tr>
                            `;
                            $('table tbody').prepend(newRow);

                            // clear input
                            $('#idnumber').val('');
                        } else {
                            // $('#id-feedback')
                            //     .text('❌ Failed to log attendance')
                            //     .css('color', 'red');
                        }

                        setTimeout(function() {
                            $('#id-feedback').text('');
                            $('#idnumber').val('');
                            $('table tbody').empty();
                        }, 5000);
                    },
                    error: function(xhr) {
                        // $('#id-feedback')
                        //     .text('⚠ Something went wrong')
                        //     .css('color', 'orange');
                    }
                });
            }
    });*/


    $('#idnumber').on('keypress', function(e) {
        if (e.which === 13) { // Enter key
            e.preventDefault();

            let idValue = $(this).val();

            if (idValue.length > 0) {
                $.ajax({
                    url: "{{ route('attendance') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        idnumber: idValue
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#id-feedback')
                                .text(response.message)
                                .css('color', 'green');

                            // clear old rows first
                            $('table tbody').empty();
                            // append new log to table
                            let newRow = `
                                <tr>
                                    <td>${response.data.idnumber}</td>
                                    <td>${response.data.name}</td>
                                    <td>${response.data.time_in ?? response.data.time_out}</td>
                                </tr>
                            `;
                            $('table tbody').prepend(newRow);

                            // clear input
                            $('#idnumber').val('');
                        } else {
                            $('#id-feedback')
                            .text(response.message)
                            .css('color', 'red');
                        }

                        setTimeout(function() {
                            $('#id-feedback').text('');
                            $('#idnumber').val('');
                            $('table tbody').empty();
                        }, 5000);
                    },
                    error: function(xhr) {
                        $('#id-feedback')
                            .text('⚠ Something went wrong')
                            .css('color', 'orange');
                    }
                });
            }
        }
    });
});

function updateDateTime() {
        const now = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        };
        document.getElementById('date-time').innerText = now.toLocaleDateString('en-US', options);
    }

    setInterval(updateDateTime, 1000);
    updateDateTime(); // run immediately on load
</script>
@endpush