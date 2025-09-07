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
                    <form action="{{ route('students.update', $student) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label>ID Number</label>
                            <input type="text" name="idnumber" value="{{ $student->idnumber }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>First Name</label>
                            <input type="text" name="fn" value="{{ $student->fn }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Last Name</label>
                            <input type="text" name="ln" value="{{ $student->ln }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Middle Name</label>
                            <input type="text" name="mn" value="{{ $student->mn }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Date of Birth</label>
                            <input type="date" name="dob" value="{{ $student->dob }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Sex</label>
                            <select name="sex" class="form-control" required>
                                <option value="M" @if($student->sex == 'M') selected @endif>Male</option>
                                <option value="F" @if($student->sex == 'F') selected @endif>Female</option>
                            </select>
                        </div>
                        <button class="btn btn-primary">Update</button>
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