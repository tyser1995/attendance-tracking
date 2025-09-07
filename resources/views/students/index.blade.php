@extends('layouts.app', [
'class' => '',
'elementActive' => 'student'
])

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8 user-font">
                            <h3 class="mb-0">{{ __('Students') }}</h3>
                        </div>
                        @if (Auth::user()->can('student-create'))
                            <div class="col-4 text-right add-user">
                                <a href="{{ route('student.create') }}" class="btn btn-sm btn-primary" id="add-user">{{
                                    __('Add student') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                @include('notification.index')
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table" id="tblData">
                            <thead>
                                <tr>
                                    <th>ID Number</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Middle Name</th>
                                    <th>DOB</th>
                                    <th>Sex</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($students->count())
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->idnumber }}</td>
                                            <td>{{ $student->fn }}</td>
                                            <td>{{ $student->ln }}</td>
                                            <td>{{ $student->mn }}</td>
                                            <td>{{ $student->dob }}</td>
                                            <td>{{ $student->sex }}</td>
                                            <td>
                                                 @if (Auth::user()->can('student-edit'))
                                                    <a href="{{ route('student.edit', $student) }}" class="btn btn-info btn-sm"><i class="fas fa-pen"></i></a>
                                                @endif
                                                @if (Auth::user()->can('student-delete'))
                                                    <button type="button" data-id="{{$student->id}}"
                                                    value="{{$student->idnumber. ' ' . $student->ln}}"
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
                    window.location.href = base_url + "/students/delete/" + $(this).data('id');
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
