@extends('layouts.app', [
'class' => '',
'elementActive' => 'attendance'
])

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8 user-font">
                            <h3 class="mb-0">{{ __('Time Table') }}</h3>
                        </div>
                        {{-- @if (Auth::user()->can('attendance_managements-create'))
                            <div class="col-4 text-right add-user">
                                <a href="{{ route('attendance_management.create') }}" class="btn btn-sm btn-primary" id="add-user">{{
                                    __('Add Attendance') }}</a>
                            </div>
                        @endif --}}
                    </div>
                </div>
                @include('notification.index')
                <div class="card-body">
                    <form method="GET" action="{{ route('attendance_management.index') }}" class="mb-4 row g-3">
                        <div class="col-md-3">
                            <label for="date_from" class="form-label">Date From</label>
                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="date_to" class="form-label">Date To</label>
                            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="form-control">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary mr-2">Filter</button>
                            <a href="{{ route('attendance_management.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>

                    <div class="table-responsive-sm">
                        <table class="table" id="tblData">
                            <thead>
                                <tr>
                                    <th hidden>#</th>
                                    <th>ID Number</th>
                                    <th>Name</th>
                                    <th>Time In</th>
                                    <th>Course</th>
                                    {{-- <th>Time Out</th> --}}
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($attendances->count())
                                    @foreach($attendances as $attendance)
                                        <tr>
                                            <td hidden>{{ $attendance->id }}</td>
                                            <td>{{ $attendance->idnumber }}</td>
                                            <td>{{ $attendance->name }}</td>
                                            <td>{{ $attendance->time_in }}</td>
                                            <td>
    {{ optional($attendance->student->course)->course_code 
        ? optional($attendance->student->course)->course_code . '-' . optional($attendance->student->course)->year_level 
        : '-' }}
</td>
                                            {{-- <td>{{ $attendance->time_out }}</td> --}}
                                            <td>{{ $attendance->created_date }}</td>
                                            <td>
                                                 @if (Auth::user()->can('attendance_management-edit'))
                                                    <a href="{{ route('attendance_management.edit', $attendance) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                @endif
                                                @if (Auth::user()->can('attendance_management-delete'))
                                                    <button type="button" data-id="{{$attendance->id}}"
                                                    value="{{$attendance->idnumber. ' ' . $attendance->name}}"
                                                    class="btnCanDestroy btn btn-danger btn-sm"><i
                                                        class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr style=" text-align: center;font-size: large;vertical-align: middle;">
                                    <td colspan="6">{{ __('No Records found.') }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#tblData').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        order: [[1, 'asc']], // Order by ID number
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> Export Excel',
                className: 'btn btn-success btn-sm',
                title: function() {
                    // Add date filter info to filename
                    const from = $('#date_from').val() || 'all';
                    const to = $('#date_to').val() || 'all';
                    return `Attendance_${from}_to_${to}`;
                }
            },
            {
                extend: 'csvHtml5',
                text: '<i class="fas fa-file-csv"></i> Export CSV',
                className: 'btn btn-info btn-sm'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> Export PDF',
                className: 'btn btn-danger btn-sm',
                orientation: 'landscape',
                pageSize: 'A4',
                title: 'Attendance Report'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Print',
                className: 'btn btn-primary btn-sm'
            }
        ],
        language: {
            search: "Search Attendance:",
            lengthMenu: "Show _MENU_ records per page"
        }
    });

    // Move export buttons to the top-right of your card
    table.buttons().container()
        .appendTo('#tblData_wrapper .col-md-6:eq(0)');

    // Delete confirmation
    $('#tblData tbody').on('click','.btnCanDestroy',function() {
            Swal.fire({
                // title: 'Error!',
                text: 'Do you want to remove ' + $(this).val() + ' user?',
                icon: 'question',
                allowOutsideClick:false,
                confirmButtonText: 'Yes',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                    window.location.href = base_url + "/attendance_managements/delete/" + $(this).data('id');
                    Swal.fire({
                        title: $(this).val() + ' Deleted Successfully',
                        icon: 'success',
                        allowOutsideClick:false,
                        confirmButtonText: 'Close',
                    }).then(()=>{
                        $('#tblData').DataTable().ajax.reload();
                    });
                }
            });
        });
    });
</script>
@endpush
