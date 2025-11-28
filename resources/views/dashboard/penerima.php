@extends('dashboard.layouts.app')

@section('content')

<main>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="page-title-container">
          <h1 class="mb-0 pb-0 display-4" id="title">Selamat Datang, Penerima!</h1>
        </div>
      </div>
    </div>

    <div class="row">
      <h2 class="small-title">Status Informasi</h2>
      <div class="mb-5">
        <div class="row g-2">
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="card hover-scale-up cursor-pointer sh-19">
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                <div
                  class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                  <i data-acorn-icon="loaf" class="text-white"></i>
                </div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Diterima</div>
                <div class="text-small text-primary">14 PRODUCTS</div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="card hover-scale-up cursor-pointer sh-19">
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                <div
                  class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                  <i data-acorn-icon="send" class="text-white"></i>
                </div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Belum Diambil</div>
                <div class="text-small text-primary">8 PRODUCTS</div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="card hover-scale-up cursor-pointer sh-19">
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                <div
                  class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                  <i data-acorn-icon="leaf" class="text-white"></i>
                </div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Diterima</div>
                <div class="text-small text-primary">21 PRODUCTS</div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-lg-3">
            <div class="card hover-scale-up cursor-pointer sh-19">
              <div class="h-100 d-flex flex-column justify-content-between card-body align-items-center">
                <div
                  class="bg-gradient-light sh-5 sw-5 rounded-xl d-flex justify-content-center align-items-center mb-2">
                  <i data-acorn-icon="send" class="text-white"></i>
                </div>
                <div class="heading text-center mb-0 d-flex align-items-center lh-1">Belum Diambil</div>
                <div class="text-small text-primary">21 PRODUCTS</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Makanan -->
      <div class="col-12 col-xl-6 mb-5">
        <div class="d-flex justify-content-between">
          <h2 class="small-title">Makanan</h2>
          <button class="btn btn-icon btn-icon-only btn-sm btn-background-alternate mt-n2 shadow" type="button"
            data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
            <i data-acorn-icon="more-horizontal" data-acorn-size="15"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end shadow">
            <a class="dropdown-item" href="#">Semua</a>
            <a class="dropdown-item" href="#">Belum Diambil</a>
            <a class="dropdown-item" href="#">Sudah Diambil</a>
          </div>
        </div>
        <div class="scroll-out">
          <div class="scroll-by-count" data-count="4">
            <div class="card mb-2">
              <div class="row g-0 sh-12">
                <div class="col-auto">
                  <span
                    class="badge rounded-pill bg-primary me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                  <img src="{{asset ('{{asset ('img/product/small/product-1.webp')}}')}}" alt="Foto"
                    class="card-img card-img-horizontal sw-13 sw-lg-15" />
                </div>
                <div class="col">
                  <div class="card-body pt-0 pb-0 h-100">
                    <div class="row g-0 h-100 align-content-center">
                      <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                        <span class="fw-bold">Kompost Sayur</span>
                        <div class="text-small text-danger">
                          Batas Pengambilan: 14.00 WIB
                        </div>
                      </div>
                      <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                        <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal"
                          data-bs-target="#detailModal1">
                          Detail
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="card mb-2">
              <div class="row g-0 sh-12">
                <div class="col-auto">
                  <span
                    class="badge rounded-pill bg-primary me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                  <img src="{{asset ('{{asset ('img/product/small/product-1.webp')}}')}}" alt="Foto"
                    class="card-img card-img-horizontal sw-13 sw-lg-15" />
                </div>
                <div class="col">
                  <div class="card-body pt-0 pb-0 h-100">
                    <div class="row g-0 h-100 align-content-center">
                      <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                        <span class="fw-bold">Kompost Sayur</span>
                        <div class="text-small text-danger">
                          Batas Pengambilan: 14.00 WIB
                        </div>
                      </div>
                      <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                        <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal"
                          data-bs-target="#detailModal1">
                          Detail
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="card mb-2">
              <div class="row g-0 sh-12">
                <div class="col-auto">
                  <span
                    class="badge rounded-pill bg-warning me-1 position-absolute s-n2 t-2 z-index-1 t-1">Menunggu</span>
                  <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto"
                    class="card-img card-img-horizontal sw-13 sw-lg-15" />
                </div>
                <div class="col">
                  <div class="card-body pt-0 pb-0 h-100">
                    <div class="row g-0 h-100 align-content-center">
                      <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                        <span class="fw-bold">Kompost Sayur</span>
                        <div class="text-small text-danger">
                          Batas Pengambilan: 14.00 WIB
                        </div>
                      </div>

                      <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                        <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal"
                          data-bs-target="#detailModal2">
                          Detail
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mb-2">
              <div class="row g-0 sh-12">
                <div class="col-auto">
                  <span
                    class="badge rounded-pill bg-warning me-1 position-absolute s-n2 t-2 z-index-1 t-1">Menunggu</span>
                  <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto"
                    class="card-img card-img-horizontal sw-13 sw-lg-15" />
                </div>
                <div class="col">
                  <div class="card-body pt-0 pb-0 h-100">
                    <div class="row g-0 h-100 align-content-center">
                      <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                        <span class="fw-bold">Kompost Sayur</span>
                        <div class="text-small text-danger">
                          Batas Pengambilan: 14.00 WIB
                        </div>
                      </div>
                      <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                        <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal"
                          data-bs-target="#detailModal2">
                          Detail
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mb-2">
              <div class="row g-0 sh-12">
                <div class="col-auto">
                  <span
                    class="badge rounded-pill  bg-warning me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                  <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto"
                    class="card-img card-img-horizontal sw-13 sw-lg-15" />
                </div>
                <div class="col">
                  <div class="card-body pt-0 pb-0 h-100">
                    <div class="row g-0 h-100 align-content-center">
                      <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                        <span class="fw-bold">Kompost Sayur</span>
                        <div class="text-small text-danger">
                          Batas Pengambilan: 14.00 WIB
                        </div>
                      </div>
                      <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                        <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal"
                          data-bs-target="#detailModal1">
                          Detail
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-xl-6 mb-5">
        <div class="d-flex justify-content-between">
          <h2 class="small-title">Produk Daur Ulang</h2>
          <button class="btn btn-icon btn-icon-only btn-sm btn-background-alternate mt-n2 shadow" type="button"
            data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
            <i data-acorn-icon="more-horizontal" data-acorn-size="15"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end shadow">
            <a class="dropdown-item" href="#">Semua</a>
            <a class="dropdown-item" href="#">Belum Diambil</a>
            <a class="dropdown-item" href="#">Sudah Diambil</a>
          </div>
        </div>
        <div class="scroll-out">
          <div class="scroll-by-count" data-count="4">
            <div class="card mb-2">
              <div class="row g-0 sh-12">
                <div class="col-auto">
                  <span
                    class="badge rounded-pill bg-primary me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                  <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto"
                    class="card-img card-img-horizontal sw-13 sw-lg-15" />
                </div>
                <div class="col">
                  <div class="card-body pt-0 pb-0 h-100">
                    <div class="row g-0 h-100 align-content-center">
                      <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                        <span class="fw-bold">Kompost Sayur</span>
                        <div class="text-small text-primary">
                          Diambil Pada: 14.00 WIB
                        </div>
                      </div>
                      <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                        <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal"
                          data-bs-target="#detailModal1">
                          Detail
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mb-2">
              <div class="row g-0 sh-12">
                <div class="col-auto">
                  <span
                    class="badge rounded-pill bg-primary me-1 position-absolute s-n2 t-2 z-index-1 t-1">Diterima</span>
                  <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto"
                    class="card-img card-img-horizontal sw-13 sw-lg-15" />
                </div>
                <div class="col">
                  <div class="card-body pt-0 pb-0 h-100">
                    <div class="row g-0 h-100 align-content-center">
                      <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                        <span class="fw-bold">Kompost Sayur</span>
                        <div class="text-small text-primary">
                          Diambil Pada: 14.00 WIB
                        </div>
                      </div>
                      <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                        <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal"
                          data-bs-target="#detailModal1">
                          Detail
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mb-2">
              <div class="row g-0 sh-12">
                <div class="col-auto">
                  <span
                    class="badge rounded-pill bg-warning me-1 position-absolute s-n2 t-2 z-index-1 t-1">Menunggu</span>
                  <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto"
                    class="card-img card-img-horizontal sw-13 sw-lg-15" />
                </div>
                <div class="col">
                  <div class="card-body pt-0 pb-0 h-100">
                    <div class="row g-0 h-100 align-content-center">
                      <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                        <span class="fw-bold">Kompost Sayur</span>
                        <div class="text-small text-danger">
                          Batas Pengambilan: 14.00 WIB
                        </div>
                      </div>
                      <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                        <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal"
                          data-bs-target="#detailModal2">
                          Detail
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mb-2">
              <div class="row g-0 sh-12">
                <div class="col-auto">
                  <span
                    class="badge rounded-pill bg-warning me-1 position-absolute s-n2 t-2 z-index-1 t-1">Menunggu</span>
                  <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto"
                    class="card-img card-img-horizontal sw-13 sw-lg-15" />
                </div>
                <div class="col">
                  <div class="card-body pt-0 pb-0 h-100">
                    <div class="row g-0 h-100 align-content-center">
                      <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                        <span class="fw-bold">Kompost Sayur</span>
                        <div class="text-small text-danger">
                          Batas Pengambilan: 14.00 WIB
                        </div>
                      </div>
                      <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                        <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal"
                          data-bs-target="#detailModal2">
                          Detail
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mb-2">
              <div class="row g-0 sh-12">
                <div class="col-auto">
                  <span
                    class="badge rounded-pill bg-warning me-1 position-absolute s-n2 t-2 z-index-1 t-1">Menunggu</span>
                  <img src="{{asset ('img/product/small/product-1.webp')}}" alt="Foto"
                    class="card-img card-img-horizontal sw-13 sw-lg-15" />
                </div>
                <div class="col">
                  <div class="card-body pt-0 pb-0 h-100">
                    <div class="row g-0 h-100 align-content-center">
                      <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                        <span class="fw-bold">Kompost Sayur</span>
                        <div class="text-small text-danger">
                          Batas Pengambilan: 14.00 WIB
                        </div>
                      </div>
                      <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                        <button class="btn btn-sm btn-outline-primary ms-1" data-bs-toggle="modal"
                          data-bs-target="#detailModal1">
                          Detail
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</main>

<!-- modal 1 -->
<div class="modal fade modal-close-out" id="detailModal1" tabindex="-1" aria-labelledby="detailMarketplaceLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg">
      <div class="position-relative">
        <img src="img/product/large/product-2.webp" class="img-fluid rounded" alt="Responsive image" />
        <span class="badge bg-success text-white position-absolute" style="top: 12px; left: 12px;">
          Sudah Diambil
        </span>
      </div>

      <div class="modal-body">
        <h5 class="fw-bold mb-3">Kompos Sayur</h5>

        <div class="container px-0">
          <div class="row mb-3">
            <div class="col-6 d-flex">
              <i data-acorn-icon="user" class="me-2 text-primary"></i>
              <div>
                <div class="text-muted small">Penyedia</div>
                <div class="fw-semibold">Hotel Santika Jakarta</div>
              </div>
            </div>
            <div class="col-6 d-flex">
              <i data-acorn-icon="phone" class="me-2 text-primary"></i>
              <div>
                <div class="text-muted small">Kontak</div>
                <div class="fw-semibold">0812-3456-7890</div>
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-6 d-flex">
              <i data-acorn-icon="clock" class="me-2 text-primary"></i>
              <div>
                <div class="text-muted small">Batas Pengambilan</div>
                <div class="fw-semibold text-danger">14.00 WIB</div>
              </div>
            </div>
            <div class="col-6 d-flex">
              <i data-acorn-icon="check-square" class="me-2 text-primary"></i>
              <div>
                <div class="text-muted small">Status</div>
                <span class="badge bg-success">Sudah Diambil</span>
              </div>
            </div>
          </div>

          <div class="mb-1 d-flex align-items-center">
            <i data-acorn-icon="pin" class="me-2 text-primary"></i>
            <span class="text-muted small">Alamat</span>
          </div>

          <div class="ms-4 mb-2">
            Jl. Melati No. 12, Jakarta <br>
            <a href="https://maps.google.com" target="_blank" class="text-primary text-small">
              Buka di Google Maps
            </a>
          </div>

          <!-- MAPS PREVIEW -->
          <div class="ms-4 mb-3">
            <a href="https://maps.google.com" target="_blank">
              <img src="img/maps-thumbnail.png" class="img-fluid rounded shadow-sm"
                style="width: 100%; max-height: 160px; object-fit: cover;" />
            </a>
          </div>
        </div>
      </div>

      <div class="p-3 border-top bg-white">
        <div class="d-grid gap-2 mb-3">
          <button class="btn btn-success" type="button" disabled>
            Sudah Diambil
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal 2 -->
<div class="modal fade modal-close-out" id="detailModal2" tabindex="-1" aria-labelledby="detailMarketplaceLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg">
      <div class="position-relative">
        <img src="img/product/large/product-2.webp" class="img-fluid rounded" alt="Responsive image" />
        <span class="badge bg-warning text-dark position-absolute" style="top: 12px; left: 12px;">
          Belum Diambil
        </span>
      </div>
      <div class="modal-body">
        <h5 class="fw-bold mb-3">Kompos Sayur</h5>
        <div class="container px-0">
          <div class="row mb-3">
            <div class="col-6 d-flex">
              <i data-acorn-icon="user" class="me-2 text-primary"></i>
              <div>
                <div class="text-muted small">Penyedia</div>
                <div class="fw-semibold">Hotel Santika Jakarta</div>
              </div>
            </div>
            <div class="col-6 d-flex">
              <i data-acorn-icon="phone" class="me-2 text-primary"></i>
              <div>
                <div class="text-muted small">Kontak</div>
                <div class="fw-semibold">0812-3456-7890</div>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-6 d-flex">
              <i data-acorn-icon="clock" class="me-2 text-primary"></i>
              <div>
                <div class="text-muted small">Batas Pengambilan</div>
                <div class="fw-semibold text-danger">14.00 WIB</div>
              </div>
            </div>
            <div class="col-6 d-flex">
              <i data-acorn-icon="check-square" class="me-2 text-primary"></i>
              <div>
                <div class="text-muted small">Status</div>
                <span class="badge bg-warning text-dark">Belum Diambil</span>
              </div>
            </div>
          </div>
          <div class="mb-1 d-flex align-items-center">
            <i data-acorn-icon="pin" class="me-2 text-primary"></i>
            <span class="text-muted small">Alamat</span>
          </div>
          <div class="ms-4 mb-2">
            Jl. Melati No. 12, Jakarta <br>
            <a href="https://maps.google.com" target="_blank" class="text-primary text-small">
              Buka di Google Maps
            </a>
          </div>

          <!-- MAPS PREVIEW -->
          <div class="ms-4 mb-3">
            <a href="https://maps.google.com" target="_blank">
              <img src="img/maps-thumbnail.png" class="img-fluid rounded shadow-sm"
                style="width: 100%; max-height: 160px; object-fit: cover;" />
            </a>
          </div>
        </div>
      </div>

      <div class="p-3 border-top bg-white">
        <div class="d-grid gap-2 mb-3">
          <button class="btn btn-primary" type="button">
            Tandai Sudah Diambil
          </button>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Search Modal Start -->
<div class="modal fade modal-under-nav modal-search modal-close-out" id="searchPagesModal" tabindex="-1" role="dialog"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0 p-0">
        <button type="button" class="btn-close btn btn-icon btn-icon-only btn-foreground" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body ps-5 pe-5 pb-0 border-0">
        <input id="searchPagesInput" class="form-control form-control-xl borderless ps-0 pe-0 mb-1 auto-complete"
          type="text" autocomplete="off" />
      </div>
      <div class="modal-footer border-top justify-content-start ps-5 pe-5 pb-3 pt-3 border-0">
        <span class="text-alternate d-inline-block m-0 me-3">
          <i data-acorn-icon="arrow-bottom" data-acorn-size="15" class="text-alternate align-middle me-1"></i>
          <span class="align-middle text-medium">Navigate</span>
        </span>
        <span class="text-alternate d-inline-block m-0 me-3">
          <i data-acorn-icon="arrow-bottom-left" data-acorn-size="15" class="text-alternate align-middle me-1"></i>
          <span class="align-middle text-medium">Select</span>
        </span>
      </div>
    </div>
  </div>
</div>
<!-- Search Modal End -->

@endsection

@push('script')

<!-- script input form -->
<script>
  const radioJenis = document.querySelectorAll('input[name="jenis"]');
  const fieldMakanan = document.getElementById("fieldMakanan");
  const fieldKompos = document.getElementById("fieldKompos");

  radioJenis.forEach(radio => {
    radio.addEventListener("change", function() {
      if (this.value === "makanan") {
        fieldMakanan.classList.remove("d-none");
        fieldKompos.classList.add("d-none");
      } else {
        fieldMakanan.classList.add("d-none");
        fieldKompos.classList.remove("d-none");
      }
    });
  });
</script>

@endpush