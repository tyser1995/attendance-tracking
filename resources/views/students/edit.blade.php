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

                        <label>ID Number</label>
                        <input type="text" name="idnumber" class="form-control" value="{{ old('idnumber', $student->idnumber) }}" required>

                        <label>First Name</label>
                        <input type="text" name="fn" class="form-control" value="{{ old('fn', $student->fn) }}" required>

                        <label>Last Name</label>
                        <input type="text" name="ln" class="form-control" value="{{ old('ln', $student->ln) }}" required>

                        <label>Middle Name</label>
                        <input type="text" name="mn" class="form-control" value="{{ old('mn', $student->mn) }}">

                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob', $student->dob) }}" required>

                        <label>Sex</label>
                        <select name="sex" class="form-control" required>
                            <option value="M" {{ old('sex', $student->sex) == 'M' ? 'selected' : '' }}>Male</option>
                            <option value="F" {{ old('sex', $student->sex) == 'F' ? 'selected' : '' }}>Female</option>
                        </select>

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