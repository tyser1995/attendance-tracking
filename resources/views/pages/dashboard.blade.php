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
</div>

@endsection
@push('scripts')
<script>
</script>
@endpush
