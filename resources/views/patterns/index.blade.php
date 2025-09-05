@extends('layouts.app', [
'class' => '',
'elementActive' => 'pattern'
])

@section('content')
<div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0 h3_title">ID Pattern</h3>
                            </div>
                            <div class="col-4 text-right add-region-btn">
                                <a href="{{ route('pattern.create') }}" class="btn btn-sm btn-primary"
                                    id="add-region-btn">{{ __('Add ID Pattern') }}</a>
                            </div>
                        </div>
                    </div>
                   <div class="card-body">
                        @include('notification.index')
                        <ul class="list-group">
                            @foreach($patterns as $p)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $p->pattern }} → <code>{{ $p->regex }}</code></span>

                                    <form id="delete-form-{{ $p->id }}" action="{{ route('pattern.destroy', $p->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $p->id }})">
                                        Delete
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <hr class="my-4">
                        <h2>Validate an ID</h2>
                        <form action="{{ route('validate-id') }}" method="POST">
                            @csrf
                            <input type="text" name="id" placeholder="Enter ID" required class="form-control"
                                style="width: 300px; display: inline-block; margin-right: 10px;">
                            <button type="submit" class="btn btn-primary">Validate</button>
                        </form>
                        @include('notification.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
                 Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "Deleted successfully",
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        })
    }
</script>
@endpush
