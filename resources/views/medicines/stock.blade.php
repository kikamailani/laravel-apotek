@extends(templates.app)

@section('content')
    <div id="msg-success"></div>

    <table class="table table-striped table-bordered tabel-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Stok</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach ($medicines as $item) 
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item['name'] }}</td>
                <td styles="{{ $item['stock'] <= 3 ? 'background: red; color: white' : 'background: none; color: black' }}">
                    {{ $item ['stock'] }}
                </td>
                <td class="d-flex justify-content-center">
                    <div onclick="edit($item['id'])" class="btn btn-primary me-3" style="cursor: pointer">Tambah Stok</div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="modal" tabindex="-1" id="edit-stock">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="form-stock">
                    <div class="modal-body">
                        <div id="msg"></div>

                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="name" class="form--label">Nama Obat :</label>
                            <input type="text" class="form-control" id="name" name="name" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form--label">Stok Obat :</label>
                            <input type="number" class="form-control" id="stock" name="stock">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function edit(id) {
            var url = "{{ route('medicine.stock.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                dataType: 'json',
                success: function(res){
                    $('#edit-stock').modal('show');
                    $('#id').val(res.id);
                    $('#name').val(res.name);
                    $('#stock').val(res.stock);
                }
            });
        }

        $('#form-stock').submit(function(e) {
            e.preventDefault();
            var formData = {
                id: $('#id').val(),
                stock: $('#stock').val(),
            };
            
            var url = "{{ route('medicine.stock.update', ':id') }}";
            url = url.replace(':id', formData.id);

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#edit-stock').modal('hide');
                        location.reload();
                    } else {
                        $('#msg').html('<div class="alert alert-danger">'+response.message+'</div>');
                    }
                },
                error: function(xhr) {
                    $('#msg').html('<div class="alert alert-danger">Terjadi kesalahan saat menyimpan data.</div>');
                }
            });
        });

        $(function() {
            if(sessionStorage.reloadAfterPageLoad) {
                $('#msg-success').attar("class", "alert alert-success");
                $('#msg-success').text("Berhasil menambah data stock!");
                sessionStorage.clear();
            }
        })

    </script>
@endpush
