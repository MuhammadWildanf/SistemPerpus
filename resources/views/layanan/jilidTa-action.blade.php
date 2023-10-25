<div class="modal-content">
    <form id="formAction" action="{{$jilid->id ? route('jilidLaporan.update' , $jilid->id ) : route('jilidLaporan.store')}} " method="post" enctype="multipart/form-data">
        @csrf
        @if($jilid->id)
        @method('put')
        @endif
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Jilid Laporan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="file">Nama</label>
                        <input type="text" class="form-control" value="{{$jilid->name}}" id="nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="file">Page Berwarna</label>
                        <input type="number" class="form-control" id="page_berwarna" {{$jilid->page_berwarna}}  name="page_berwarna">
                    </div>
                    <div class="mb-3">
                        <label for="file">Page Berwarna</label>
                        <input type="number" class="form-control" id="page_hitamPutih" {{$jilid->page_hitamPutih}} name="page_hitamPutih">
                    </div>
                    <div class="mb-3">
                        <label for="file">cover</label>
                        <input type="number" class="form-control" id="cover" {{$jilid->cover}} name="cover">
                    </div>
                    <div class="mb-3">
                        <label for="file">Exemplar</label>
                        <input type="number" class="form-control" id="exemplar" {{$jilid->exemplar}} name="exemplar">
                    </div>
                    <div class="mb-3">
                        <label for="file">Total</label>
                        <input type="number" class="form-control" id="total" {{$jilid->total}} name="total">
                    </div>
                    <div class="mb-3">
                        <label for="file">File</label>
                        <input type="text" class="form-control" id="file" {{$jilid->file}} name="file">
                    </div>
                    <div class="mb-3">
                        <label for="file">Bukti Pembayaran</label>
                        <input type="text" class="form-control" id="bukti_pembayaran" {{$jilid->bukti_pembayaran}} name="bukti_pembayaran">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>


<script>
    function updateCalculations() {
    const pageBerwarna = parseFloat(document.getElementById("page_berwarna").value);
    const pageHitamPutih = parseFloat(document.getElementById("page_hitamPutih").value);
    const cover = parseFloat(document.getElementById("cover").value);
    const exemplar = parseFloat(document.getElementById("exemplar").value);

    if (!isNaN(pageBerwarna) && !isNaN(pageHitamPutih) && !isNaN(cover) && !isNaN(exemplar)) {
        //ini mengambil dari table price 

        $.ajax({
            url: '{{ url('konfigurasi/getPriceData') }}',
            method: 'GET',
            success: function(response) {
                const data = response.data[0]; // Mengambil data dari respons
                const totalPageBerwarna = pageBerwarna * data.pageBerwarnaPrice;
                const totalPageHitamPutih = pageHitamPutih * data.pageHitamPutihPrice;
                const totalCover = cover * data.coverprice;
                const totalPerjilid = exemplar * data.perjilidprice;
                const total = (totalPageBerwarna + totalPageHitamPutih + totalCover + totalPerjilid);

                document.getElementById("total").value = total;
            },
            error: function(xhr, status, error) {
                console.log('ini Error', error);
            }
        });
    }
}

// Attach the calculation function to input change events
document.getElementById("page_berwarna").addEventListener("input", updateCalculations);
document.getElementById("page_hitamPutih").addEventListener("input", updateCalculations);
document.getElementById("exemplar").addEventListener("input", updateCalculations);
document.getElementById("cover").addEventListener("input", updateCalculations);

// Calculate initial values
updateCalculations();
</script>