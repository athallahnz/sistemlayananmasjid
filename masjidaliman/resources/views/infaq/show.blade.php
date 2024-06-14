<div class="container-sm my-5">
    <div class="row justify-content-center">
        <div class="p-5 bg-light rounded-3 col-xl-4 border">
        <div class="mb-3 text-center">
        <i class="bi-person-circle fs-1"></i>
        <h4>Detail Infaq</h4>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="nama" class="form-label">Nama</label>
                <h5>{{ $jamaahs->nama }}</h5>
            </div>
            <div class="col-md-12 mb-3">
                <label for="nomor" class="form-label">Nomor</label>
                <h5>{{ $jamaahs->nomor }}</h5>
            </div>
            <div class="col-md-12 mb-3">
                <label for="infaq" class="for-label">Tujuan</label>
                <h5>{{ $jamaahs->infaq->name }}</h5>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 d-grid">
                    <a href="{{ route('home') }}" class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
