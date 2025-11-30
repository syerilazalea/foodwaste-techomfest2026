@extends('dashboard.layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="page-title-container">
            <div class="row">
            </div>
        </div>

        <section class="scroll-section" id="accordionCards">
            <h2 class="small-title">Pertanyaan Umum</h2>
            <div class="mb-n2" id="accordionCardsExample">

                <div class="card d-flex mb-2">
                    <div class="d-flex flex-grow-1" role="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true">
                        <div class="card-body py-4">
                            <div class="btn btn-link list-item-heading p-0">Apa itu Food Cycle?</div>
                        </div>
                    </div>
                    <div id="faq1" class="collapse show" data-bs-parent="#accordionCardsExample">
                        <div class="card-body accordion-content pt-0">
                            <p class="mb-0">
                                Food Cycle adalah platform yang bertujuan untuk mengurangi dampak food waste yang berlebihan dengan cara menjembatani penyaluran makanan layak konsumsi kepada pihak yang membutuhkan, serta limbah hasil makanan agar dapat dimanfaatkan menjadi kompos, pakan
                                ternak, atau lainnya.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card d-flex mb-2">
                    <div class="d-flex flex-grow-1" role="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        <div class="card-body py-4">
                            <div class="btn btn-link list-item-heading p-0">Siapa yang bisa menjadi kolaborator?
                            </div>
                        </div>
                    </div>
                    <div id="faq2" class="collapse" data-bs-parent="#accordionCardsExample">
                        <div class="card-body accordion-content pt-0">
                            <p class="mb-0">
                                Kolaborator bisa berupa restoran, kafe, hotel, UMKM kuliner, peternak, pengolah kompos, atau individu yang ingin menyalurkan makanan dan limbah organik secara bertanggung jawab.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card d-flex mb-2">
                    <div class="d-flex flex-grow-1" role="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        <div class="card-body py-4">
                            <div class="btn btn-link list-item-heading p-0">Apa tugas seorang aktivis?</div>
                        </div>
                    </div>
                    <div id="faq3" class="collapse" data-bs-parent="#accordionCardsExample">
                        <div class="card-body accordion-content pt-0">
                            <p class="mb-0">
                                Aktivis bertugas membagikan informasi bermanfaat, membuat artikel mengenai lingkungan, serta mengadakan atau mempublikasikan kegiatan seperti gerakan tanam pohon, edukasi sampah organik, dan kampanye peduli lingkungan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card d-flex mb-2">
                    <div class="d-flex flex-grow-1" role="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                        <div class="card-body py-4">
                            <div class="btn btn-link list-item-heading p-0">Apakah semua makanan bisa disalurkan?
                            </div>
                        </div>
                    </div>
                    <div id="faq4" class="collapse" data-bs-parent="#accordionCardsExample">
                        <div class="card-body accordion-content pt-0">
                            <p class="mb-0">
                                Hanya makanan yang masih layak konsumsi, aman, dan higienis sesuai standar kesehatan. Makanan basi, rusak, atau tidak layak tidak dapat disalurkan tetapi bisa dialihkan ke proses pengolahan limbah organik.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card d-flex mb-2">
                    <div class="d-flex flex-grow-1" role="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                        <div class="card-body py-4">
                            <div class="btn btn-link list-item-heading p-0">Bagaimana cara menjadi kolaborator?
                            </div>
                        </div>
                    </div>
                    <div id="faq5" class="collapse" data-bs-parent="#accordionCardsExample">
                        <div class="card-body accordion-content pt-0">
                            <p class="mb-0">
                                Cukup mendaftar melalui halaman pendaftaran kolaborator, mengisi data yang tersedia, serta jadwal pengambilan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card d-flex mb-2">
                    <div class="d-flex flex-grow-1" role="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                        <div class="card-body py-4">
                            <div class="btn btn-link list-item-heading p-0">Apa manfaat bergabung sebagai kolabolator?
                            </div>
                        </div>
                    </div>
                    <div id="faq6" class="collapse" data-bs-parent="#accordionCardsExample">
                        <div class="card-body accordion-content pt-0">
                            <p class="mb-0">
                                Kolaborator dapat menyalurkan makanan secara aman, mengurangi biaya pengelolaan limbah, mendukung keberlanjutan lingkungan, serta meningkatkan citra usaha, serta menerima makanan dari kolabolator lain.
                        </div>

                        <div class="card d-flex mb-2">
                            <div class="d-flex flex-grow-1" role="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                                <div class="card-body py-4">
                                    <div class="btn btn-link list-item-heading p-0">Bagaimana cara konfirmasi pengambilan makanan?</div>
                                </div>
                            </div>
                            <div id="faq7" class="collapse" data-bs-parent="#accordionCardsExample">
                                <div class="card-body accordion-content pt-0">
                                    <p class="mb-0">
                                        Setelah kolaborator menginput stok atau limbah yang tersedia, pengguna dapat memesan makanan atau produk limbah yang tersedia melalui platform dengan mengisi data yang disediakan.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card d-flex mb-2">
                            <div class="d-flex flex-grow-1" role="button" data-bs-toggle="collapse" data-bs-target="#faq9">
                                <div class="card-body py-4">
                                    <div class="btn btn-link list-item-heading p-0">Apakah ada laporan aktivitas?
                                    </div>
                                </div>
                            </div>
                            <div id="faq9" class="collapse" data-bs-parent="#accordionCardsExample">
                                <div class="card-body accordion-content pt-0">
                                    <p class="mb-0">
                                        Ya. Kolaborator dan aktivis akan mendapatkan laporan aktivitas seperti jumlah makanan tersalurkan, limbah yang dimanfaatkan, serta statistik agenda lingkungan yang telah dijalankan.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
        </section>

    </div>
</main>

@endsection

@push('scripts')

<script>
    // Preview foto otomatis
    document.getElementById('fotoInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('previewFoto');

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        }
    });
</script>

@endpush