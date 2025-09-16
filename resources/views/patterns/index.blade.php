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
                            <div class="col-4 text-right add-region-btn d-none">
                                <a href="{{ route('pattern.create') }}" class="btn btn-sm btn-primary"
                                    id="add-region-btn">{{ __('Add ID Pattern') }}</a>
                            </div>
                        </div>
                    </div>
                   <div class="card-body">
                        @include('notification.index')
                       <form method="post" action="{{ route('pattern.store') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input type="hidden" name="created_by_users_id" value="{{ Auth::user()->id }}">

                            <div class="input-group">
                                <input type="text" name="pattern" class="form-control" placeholder="e.g. ##-E###-##" required>
                            </div>

                            <div class="mt-3 d-flex gap-2">
                                <button type="submit" class="btn btn-success mr-2">{{ __('Save') }}</button>
                            </div>
                        </form>
                        <hr class="my-4">
                        {{-- Activate/Deactivate All --}}
                        @php
                            $hasActive = $patterns->contains('status', 'active');
                        @endphp

                        @if ($hasActive)
                            {{-- Show only Deactivate All if at least one active --}}
                            <form method="POST" action="{{ route('pattern.deactivateAll') }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning">{{ __('Deactivate All') }}</button>
                            </form>
                        @else
                            {{-- Show only Activate First if all inactive --}}
                            <form method="POST" action="{{ route('pattern.activateAll') }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-info">{{ __('Activate All') }}</button>
                            </form>
                        @endif
                            
                        

                        <hr class="my-4">
                        <ul class="list-group">
                            @foreach($patterns as $p)
                                <li class="list-group-item d-flex align-items-center">
                                    <!-- Pattern & Regex -->
                                    <span class="flex-grow-1">
                                        {{ $p->pattern }} → <code>{{ $p->regex }}</code>
                                    </span>

                                    <!-- Status Badge -->
                                    <span class="badge {{ $p->status === 'active' ? 'badge-success' : 'badge-secondary' }} mr-3">
                                        {{ ucfirst($p->status) }}
                                    </span>

                                    <!-- Action Buttons -->
                                    <div class="d-flex">
                                        <form action="{{ route('pattern.toggle', $p->id) }}" method="POST" class="mr-2">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="btn btn-sm {{ $p->status === 'active' ? 'btn-warning' : 'btn-info' }}">
                                                {{ $p->status === 'active' ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>

                                        <form id="delete-form-{{ $p->id }}" 
                                            action="{{ route('pattern.destroy', $p->id) }}" 
                                            method="POST" 
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <button type="button" class="btn btn-sm btn-danger"
                                                onclick="confirmDelete({{ $p->id }})">
                                            Delete
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>



                        <hr class="my-4 d-none">
                        <h2 hidden>Validate an ID</h2>
                        <form action="{{ route('validate-id') }}" method="POST" class="d-none">
                            @csrf
                            <input type="text" name="id" placeholder="Enter ID" required class="form-control"
                                style="width: 300px; display: inline-block; margin-right: 10px;">
                            <button type="submit" class="btn btn-primary">Validate</button>
                        </form>
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
                //  Swal.fire({
                //     icon: 'success',
                //     title: 'Success',
                //     text: "Deleted successfully",
                //     timer: 3000,
                //     showConfirmButton: false
                // });
            }
        })
    }
</script>
@endpush
