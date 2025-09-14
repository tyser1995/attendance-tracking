@extends('layouts.app', [
'class' => '',
'elementActive' => 'attendance',
])

@section('content')
<style>
</style>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card  shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8 create-font">
                            <h3 class="mb-0">{{ __('Edit Time Table') }}</h3>
                        </div>
                        <div class="col text-right add-user">
                            <a href="{{ route('attendance_management.index') }}" class="btn btn-sm btn-primary" id="add-user">{{
                                __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('notification.index')
                    <form action="{{ route('attendance_management.update', $attendance->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h6 class="heading-small text-muted mb-4">{{ __('Attendance information') }}</h6>
                        <div class="pl-lg-4">
                            <div class="mb-3">
                                <label>ID Number</label>
                                <input type="text" name="idnumber" value="{{ old('idnumber', $attendance->idnumber) }}" class="form-control" placeholder="ID Number">
                            </div>
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ old('name', $attendance->name) }}"  class="form-control" placeholder="Name">
                            </div>
                            <div class="mb-3">
                                <label>Time In</label>
                               <input type="time" name="time_in" value="{{ old('time_in', $attendance->time_in) }}"  class="form-control" placeholder="Time In">
                            </div>
                             <div class="mb-3">
                                <label>Time Out</label>
                               <input type="time" name="time_out" value="{{ old('time_out', $attendance->time_out) }}"  class="form-control" placeholder="Time Out">
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </form>
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