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
                            <h3 class="mb-0">{{ __('Edit Course Management') }}</h3>
                        </div>
                        <div class="col text-right add-user">
                            <a href="{{ route('course.index') }}" class="btn btn-sm btn-primary" id="add-user">{{
                                __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('notification.index')
                    <form action="{{ route('course.update', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label>Course Name</label>
                        <input type="text" name="course_name" class="form-control" value="{{ old('course_name', $course->course_name) }}" required>

                        <label>Course Code</label>
                        <input type="text" name="course_code" class="form-control" value="{{ old('course_code', $course->course_code) }}" required>

                        <label>Year Level</label>
                        <input type="number" name="year_level" class="form-control" value="{{ old('year_level', $course->year_level) }}" required>
                        
                        <button type="submit" class="btn btn-success mt-4">Update</button>
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