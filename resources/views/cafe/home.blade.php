@extends('template.app', ['title' => 'Order || CAFE'])

@section('content-dinamis')
    <div class="d-block mx-auto my-5">
        <a href="{{ route('cafes.add') }}" class="btn btn-success mb-3">+ Add Order</a>
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="container mt-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-danger">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Drink Name</th>
                            <th scope="col">Type (hot/cold)</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($cafes) > 0)
                            @foreach ($cafes as $index => $item)
                                <tr>
                                    <td>{{ ($cafes->currentPage() - 1) * $cafes->perPage() + ($index + 1) }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['type'] }}</td>
                                    <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td class="{{ $item['stock'] <= 3 ? 'bg-danger text-white' : 'bg-white text-dark' }}"><a
                                            onclick="editStock ({{ $item['id'] }}, {{ $item['stock'] }})">
                                            <span>{{ $item['stock'] }}</span>
                                    </td>
                                    <td class="d-flex justify-content-center py-1">
                                        <a href="{{route('cafes.edit' , $item['id'])}}" class="btn btn-primary btn-sm me-2">Edit</a>
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="showModal('{{ $item->id }}', '{{ $item->name }}')">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-bold">Empty data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mt-3">
                    {{ $cafes->links() }}
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="form-delete-obat" method="POST">
                            @csrf
                            {{-- menimpa method POST diganti menjadi delete, sesuai dengan http method untuk menghapus data --}}
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Drink Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete the drink data? <span id="nama-obat"></span>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger" id="confirm-delete">Delete</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        {{-- </div>
    </div> --}}
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function showModal(id, name) {
        let action = '{{ route("cafes.delete", ":id") }}';
        action = action.replace (':id', id);

        $('#form-delete-obat').attr('action', action);
        $('#exampleModal').modal('show');
        console.log(name);
        $('#nama-obat').text(name);
    }
</script>
@endpush