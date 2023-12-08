<div class="modal-content">
    <form id="formAction" action="{{ $berka->id ? route('berkas.update', $berka->id) : route('berkas.store') }} "
        method="post" enctype="multipart/form-data">
        @csrf
        @if ($berka->id)
            @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Berkas TA</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="jenis_file">Jenis</label>
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" id="jenis_file" name="jenis_file">
                                <option value="">Open this select menu</option>
                                @foreach ($documents as $document)
                                    <option value="{{ $document->id }}" {{ $document->id == $berka->jenis_file ? 'selected' : '' }}>
                                        {{ $document->dokumen }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <div class="mb-3">
                        <label for="bukti_file">Bukti FIle</label>
                        <input type="text" class="form-control" value="{{ $berka->bukti_file }}" id="bukti_file"
                            name="bukti_file">
                    </div>
                    @if (request()->user()->can('status layanan/berkas'))
                    <div class="mb-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name='keterangan'>{{$berka->keterangan}}</textarea>
                      </div>
                    <div class="mb-3" {{$berka->id ? 'edit-mode' : ''}}>
                        <label for="hasil_cek">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Open this select menu</option>
                            @php
                                $array = ['Validasi', 'Belum Validasi'];
                            @endphp
                            @foreach ($array as $element)
                                <option value="{{ $element }}" {{ $element === $berka->status ? 'selected' : '' }}>
                                    {{ $element }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
