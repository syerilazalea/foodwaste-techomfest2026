@foreach($dataMakanan as $item)
<tr>
    <td>
        @if($item->gambar)
        <img src="{{ asset($item->gambar) }}" class="rounded sw-5 sh-5" alt="Gambar {{ $item->nama }}">
        @else
        <img src="{{ asset('img/product/small/product-1.webp') }}" class="rounded sw-5 sh-5" alt="No Image">
        @endif
    </td>
    <td>{{ $item->nama }}</td>
    <td>{{ $item->penyedia }}</td>
    <td>{{ $item->kategori }}</td>
    <td>{{ $item->alamat }}</td>
    <td>{{ $item->porsi }} Porsi</td>
    <td>{{ $item->batas_waktu }}</td>
    <td class="text-nowrap">
        <button
            type="button"
            class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary"
            onclick='setEdit(@json($item))'>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 1 .646.058l2.292 2.292a.5.5 0 0 1-.058.646L4.207 14.793 1 15l.207-3.207L12.854.146z" />
            </svg>
        </button>
        <button class="btn btn-sm btn-icon btn-icon-only btn-outline-danger"
            data-bs-toggle="modal" data-bs-target="#modalDelete"
            onclick="setDeleteId({{ $item->id }})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0V6H6v6.5a.5.5 0 0 1-1 0v-7z" />
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3.5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1H14a1 1 0 0 1 1 1zm-3.5 1V4h-5v-.5h5z" />
            </svg>
        </button>
    </td>
</tr>
@endforeach

<!-- Pagination -->
<tr>
    <td colspan="8">
        {{ $dataMakanan->links('pagination::bootstrap-5') }}
    </td>
</tr>