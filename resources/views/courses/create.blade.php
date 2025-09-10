@extends('layouts.app', [
'class' => '',
'elementActive' => 'course',
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
                            <h3 class="mb-0">{{ __('Course Management') }}</h3>
                        </div>
                        <div class="col text-right add-user">
                            <a href="{{ route('course.index') }}" class="btn btn-sm btn-primary" id="add-user">{{
                                __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('notification.index')
                    <form method="post" action="{{ route('course.store') }}" autocomplete="off">
                        @csrf

                        <h6 class="heading-small text-muted mb-4">{{ __('Course information') }}</h6>
                        <div class="pl-lg-4">
                            <div class="mb-3">
                                <label>Course Name</label>
                                <input type="text" name="course_name" value="{{ old('course_name') }}" class="form-control" placeholder="Course Name">
                            </div>
                            <div class="mb-3">
                                <label>Course Code</label>
                                <input type="text" name="course_code" value="{{ old('course_code') }}" class="form-control" placeholder="Course Code">
                            </div>
                            <div class="mb-3">
                                <label>Year Level</label>
                               <input type="text" name="year_level" value="{{ old('year_level') }}"  class="form-control" placeholder="Year Level">
                            </div>

                            <div class="">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
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