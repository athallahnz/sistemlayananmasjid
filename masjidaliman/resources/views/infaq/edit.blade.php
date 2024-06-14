<div class="container-sm mt-5">
    <form action="{{ route('home.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row justify-content-center">
            <div class="p-5 bg-light rounded-3 border col-xl-6">
                <div class="mb-3 text-center">
                    <h4>Siapkan Infaq terbaikmuuuu!</h4>
                </div>
                <div class="row">
                    <div class="col-mb-3">
                        <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama">
                        @error('nama')
                        <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                        <input class="form-control mt-3 @error('nomor') is-invalid @enderror" type="text" name="nomor" id="nomor" value="{{ old('nomor') }}" placeholder="Masukkan Nomor">
                        @error('nomor')
                        <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <div class="col-md-12 mb-3">
                            <label for="infaq" class="form-label">Tujuan Infaq</label>
                            <select name="infaq" id="infaq" class="form-select mb-3">
                                @foreach ($infaqs as $Infaq)
                                <option value="{{ $Infaq->id }}" {{ old('infaq') == $Infaq->id ? 'selected' : '' }}>{{ $Infaq->code.' - '.$Infaq->name }}</option>
                                @endforeach
                            </select>
                            @error('infaq')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                            <input class="form-control mt-3" type="file" id="formFile" name="file">
                            @error('file')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-outline-light" style="background-color: #622200">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
