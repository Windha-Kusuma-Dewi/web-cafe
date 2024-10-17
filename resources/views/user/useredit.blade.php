@extends('template.app', ['title' => 'Edit User|| CAFE'])

@section('content-dinamis')
    <div class="m-auto" style="width: 65%">
        <form class="p-4 mt-2" style="border: 1px solid black" action="{{ route('user.edit.update', $user['id']) }}"
            method="POST">
            @if (Session::get('failed'))
                <div class="alert alert-danger">{{ Session::get('failed') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ol>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ol>
                </div>
            @endif
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="name" class="form-label">Name :</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user['name'] }}">
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ $user['email'] }}">
            </div>
            <div class="form-group">
                <label for="role" class="form-label">User Type</label>
                <select name="role" id="role" class="form-select">
                    <option hidden selected disabled>Pilih</option>
                    <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="kasir" {{ $user['role'] == 'kasir' ? 'selected' : '' }}>Kasir</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Change Password :</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-3 px-5">Save Changes</button>
            </div>
        </form>
    </div>
@endsection
