@extends('layouts.app', [
'class' => '',
'elementActive' => 'student',
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
                            <h3 class="mb-0">{{ __('Edit Student Management') }}</h3>
                        </div>
                        <div class="col text-right add-user">
                            <a href="{{ route('student.index') }}" class="btn btn-sm btn-primary" id="add-user">{{
                                __('Back to list') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('notification.index')
                    <form action="{{ route('student.update', $student->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h6 class="heading-small text-muted mb-4">{{ __('Student information') }}</h6>
                        <div class="pl-lg-4">
                            <div class="mb-3">
                                <label>ID Number</label>
                                <input type="text" name="idnumber" value="{{ old('idnumber', $student->idnumber) }}" class="form-control" placeholder="ID Number">
                            </div>
                            <div class="mb-3">
                                <label>First Name</label>
                                <input type="text" name="fn" value="{{ old('fn', $student->fn) }}"  class="form-control" placeholder="First Name">
                            </div>
                            <div class="mb-3">
                                <label>Last Name</label>
                               <input type="text" name="ln" value="{{ old('ln', $student->ln) }}"  class="form-control" placeholder="Last Name">
                            </div>
                            <div class="mb-3">
                                <label>Middle Name</label>
                                <input type="text" name="mn" value="{{ old('mn', $student->mn) }}"  class="form-control" placeholder="Middle Name">
                            </div>
                            <div class="mb-3">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" value="{{ old('dob', $student->dob) }}" class="form-control" >
                            </div>
                            <div class="mb-3">
                                <label>Sex</label>
                                 <select name="sex" class="form-control" required>
                                    <option value="">-- Select Sex --</option>
                                    <option value="M" {{ old('sex', $student->sex ?? '') == 'M' ? 'selected' : '' }}>Male</option>
                                    <option value="F" {{ old('sex', $student->sex ?? '') == 'F' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Course & Year</label>
                                <select name="course_id" class="form-control" required>
                                    <option value="" disabled selected>-- Select Course & Year --</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ old('course_id', $student->course_id) == $course->id ? 'selected' : '' }}>
                                            {{ $course->course_name }} ({{ $course->year_level }})
                                        </option>
                                    @endforeach
                                </select>
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