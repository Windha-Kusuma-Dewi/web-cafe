@extends('template.app', ['title' => 'User || CAFE'])

@section('content-dinamis')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>User List</h2>
        <a href="{{ route('user.tambah') }}" class="btn btn-primary shadow-sm">+ Add User</a>
    </div>
    
    @if(Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $index => $item)
                    <tr>
                        <td>{{ ($user->currentPage() - 1) * $user->perPage() + ($index + 1) }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['email'] }}</td>
                        <td>{{ $item['role'] }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('user.edit', $item['id']) }}" class="btn btn-sm btn-primary shadow-sm">Edit</a>
                                <button class="btn btn-sm btn-danger shadow-sm" onclick="showModal('{{ $item->id }}', '{{ $item->email }}')">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $user->links() }}
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-delete-user" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="exampleModalLabel">Delete User Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete user data with email  <span class="fw-bold text-primary" id="email-user"></span>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" autofocus>Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function showModal(id, email) {
        let action = '{{ route("user.delete", ":id") }}';
        action = action.replace(':id', id);
        $('#form-delete-user').attr('action', action);
        $('#exampleModal').modal('show');
        $('#email-user').text(email);
    }
</script>
@endpush
