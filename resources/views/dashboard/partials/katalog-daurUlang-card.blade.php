<div class="col">
    <div class="card h-100" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $data->id }}">
        <img src="{{ $data->gambar ? asset($data->gambar) : asset('img/default.png') }}" class="card-img-top sh-19"
            alt="{{ $data->nama}}" />
        <div class="card-body">
            <h5 class="heading mb-3">
                <a href="javascript:void(0)" role="button" class="body-link stretched-link">
                    <span class="clamp-line sh-5" data-line="2">{{ $data->nama }}</span>
                </a>
            </h5>
            <div>
                <div class="row g-0">
                    <div class="col-auto pe-3">
                        <i data-acorn-icon="user" class="text-primary me-1"
                            data-acorn-size="15"></i>
                        <span class="align-middle">{{ $data->berat }} kg</span>
                    </div>
                    <div class="col">
                        <i data-acorn-icon="clock" class="text-primary me-1"
                            data-acorn-size="15"></i>
                        <span class="align-middle">{{ \Carbon\Carbon::parse($data->batas_waktu)->format('H:i') }} WIB</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>