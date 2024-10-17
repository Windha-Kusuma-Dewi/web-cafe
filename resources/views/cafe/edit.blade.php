@extends('template.app', ['title' => 'Edit Minuman || CAFE'])

@section('content-dinamis')
    <div class="container mt-5">
        <div class="card shadow mx-auto border-0" style="max-width: 500px;">
            <div class="card-header bg-light text-center">
                <h4>Edit Drink</h4>
            </div>
            <form class="card-body p-4" action="{{ route('cafes.edit.update', $cafe['id']) }}" method="POST">
                @if (Session::get('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @endif
                @csrf
                @method('PATCH')
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name Drink</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $cafe['name'] }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label for="type" class="form-label">Type (hot/cold)</label>
                    <select name="type" id="type" class="form-select">
                        <option>Select Type</option>
                        <option value="hot" {{ $cafe['type'] == 'hot' ? 'selected' : '' }}>Hot</option>
                        <option value="cold" {{ $cafe['type'] == 'cold' ? 'selected' : '' }}>Cold</option>
                    </select>
                    @error('type')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ number_format($cafe['price'], 0, ',', '.') }}">
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $cafe['stock'] }}">
                    @error('stock')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success w-100">Update Drink</button>
            </form>
        </div>
    </div>
@endsection
