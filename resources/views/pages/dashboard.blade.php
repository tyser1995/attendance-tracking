@extends('layouts.app', [
'class' => '',
'elementActive' => 'dashboard'
])
@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        <?php
                            $count = \App\Models\Student::all();
                            echo count($count);
                        ?>
                    </h3>

                    <p>Total User</p>
                </div>
                <div class="icon">
                <i class="fas fa-users"></i>
            </div>
                <a href="{{ route('students') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
                <div class="small-box-footer">
                    <?php
                                $count = \App\Models\Student::get()->last();
                            ?>
                    @if (!empty($count))
                    <i class="fa fa-refresh"></i> Update Since {{$count->created_at->diffForHumans()}}
                    @else
                    {{__('No Records found')}}
                    @endif
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                <h3>
                    <?php
                        $count = \App\Models\Attendance::where('created_at', '>=', \Carbon\Carbon::today()->startOfDay())
                        ->where('created_at', '<=', \Carbon\Carbon::today()->endOfDay())
                        ->get();
                        echo count($count);
                    ?>
                </h3>

                <p>Attendance Logs</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <a href="{{route('attendance_managements')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                <div class="small-box-footer">
                    <?php
                                $count = \App\Models\Attendance::get()
                                ->last();
                            ?>
                    @if (!empty($count))
                    <i class="fa fa-refresh"></i> Update Since {{$count->created_at->diffForHumans()}}
                    @else
                    {{__('No Records found')}}
                    @endif
                </div>
            </div>
        </div>
        <!-- Late Today -->
        <div class="col-lg-3 col-6 d-none">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>
                        <?php
                            // Cutoff for lateness (set your rule, e.g., 8:00 AM)
                            $cutoff = '08:00:00';

                            // Count today's late arrivals
                            $count = \App\Models\Attendance::whereDate('created_date', \Carbon\Carbon::today())
                                ->where('time_in', '>', $cutoff)
                                ->count();

                            echo $count;
                        ?>
                    </h3>
                    <p>Late Today Morning Time</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-clock"></i>
                </div>
                <a href="{{route('attendance_managements')}}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
                <div class="small-box-footer">
                    <?php 
                        $last = \App\Models\Attendance::whereDate('created_date', \Carbon\Carbon::today())
                            ->where('time_in', '>', $cutoff)
                            ->where('time_in', '=',1)
                            ->latest()
                            ->first();
                    ?>
                    @if ($last)
                        <i class="fa fa-refresh"></i> Last Late {{$last->created_at->diffForHumans()}}
                    @else
                        {{__('No Late Records found')}}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Today's Attendance</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th hidden>#</th>
                                    <th>ID Number</th>
                                    <th>Name</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Date</th>
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
                                            <td>{{ $attendance->time_out }}</td>
                                            <td>{{ $attendance->created_date }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="6" class="py-4 text-muted">
                                            {{ __('No Records found for today.') }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(method_exists($attendances, 'links'))
                    <div class="card-footer d-flex justify-content-end">
                        {{ $attendances->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection
@push('scripts')
<script>
</script>
@endpush
