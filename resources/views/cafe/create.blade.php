@extends('template.app', ['title' => 'Add Drink || CAFE'])

@section('content-dinamis')
    <div class="container mt-5">
        <div class="card shadow mx-auto border-0" style="max-width: 500px;">
            <div class="card-header bg-secondary text-white text-center">
                <h4>Add New Drink</h4>
            </div>
            <form class="card-body p-4" action="{{ route('cafes.add') }}" method="POST">
                @if (Session::get('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name Drink</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter drink name">
                </div>
                <div class="form-group mb-3">
                    <label for="type" class="form-label">Type (hot/cold)</label>
                    <select name="type" id="type" class="form-select">
                        <option hidden selected disabled>Select Type</option>
                        <option value="hot" {{ old('type') == 'hot' ? 'selected' : '' }}>Hot</option>
                        <option value="cold" {{ old('type') == 'cold' ? 'selected' : '' }}>Cold</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}" placeholder="Enter price">
                </div>
                <div class="form-group mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" placeholder="Enter stock">
                </div>
                <button type="submit" class="btn btn-success w-100">Add Drink</button>
            </form>
        </div>
    </div>
@endsection

