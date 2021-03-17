<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Data Produk</h6>
                </div>
                <div class="card-body">
                
                    <a href="{{route('produk.tambah')}}"  class="btn btn-primary mb-2" >Tambah data</a>
                    <div class="">
                       
                        <table class="table table-bordered table-hover table-condensed mb-4">
                            <thead>
                                <tr>
                                    <th>No </th>
                                    <th wire:click="changeSort('kode_barcode')">Kode Produk
                                        {!! $sortField == 'kode_barcode' ? $sort =='desc' ? '<i class="fas fa-angle-down"></i>'
                                        : '<i class="fas fa-angle-up"></i>' :'' !!}
                                    </th>
                                    <th wire:click="changeSort('nama_produk')">Nama Produk
                                        {!! $sortField == 'nama_produk' ? $sort =='desc' ? '<i class="fas fa-angle-down"></i>'
                                        : '<i class="fas fa-angle-up"></i>' :'' !!}
                                    </th>
                                    <th wire:click="changeSort('nama_kategori')">Kategori
                                        {!! $sortField == 'nama_kategori' ? $sort =='desc' ? '<i class="fas fa-angle-down"></i>'
                                        : '<i class="fas fa-angle-up"></i>' :'' !!}
                                    </th>

                                    <th wire:click="changeSort('nama_satuan')">Satuan
                                        {!! $sortField == 'nama_satuan' ? $sort =='desc' ? '<i class="fas fa-angle-down"></i>'
                                        : '<i class="fas fa-angle-up"></i>' :'' !!}
                                    </th>

                                   

                                    <th wire:click="changeSort('harga_jual')">Harga Jual
                                        {!! $sortField == 'harga_jual' ? $sort =='desc' ? '<i class="fas fa-angle-down"></i>'
                                        : '<i class="fas fa-angle-up"></i>' :'' !!}
                                    </th>

                                    <th class="text-center">Action</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="text" wire:model.debounce.500ms="searchKodeBarcode" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" wire:model.debounce.500ms="searchNamaProduk" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" wire:model.debounce.500ms="searchNamaKategori" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" wire:model.debounce.500ms="searchNamaSatuan" class="form-control">
                                    </td>
                                   
                                    <td>
                                        <input type="text" wire:model.debounce.500ms="searchHargaModal" class="form-control">
                                    </td>

                                    <td>

                                    </td>

                                </tr>
                            </thead>
                            <tbody>
                                @if($daftarData->count()>0)
                                @foreach ($daftarData as $key=>$item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{$item->kode_barcode}}</td>
                                    <td>{{$item->nama_produk}}</td>
                                    <td>{{$item->kategori->nama_kategori}}</td>
                                    <td>{{$item->satuan->nama_satuan}}</td>
                                    
                                    <td>{{$item->harga_jual_rupiah}}</td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><a href="{{route('produk.edit', ['idProduk'=>$item->id_produk])}}"
                                                    wire:click ="editData({{$item}})"
                                                    class="btn btn-outline-primary btn-rounded btn-sm"
                                                    data-toggle="tooltip" data-placement="top" title="Edit">
                                                    edit
                                                </a></li>
                                            <li  x-data="{ id: {{$item->id_produk}} }">  
                                                <button x-on:click="confirm('apakah anda yakin?') ? $wire.call('deleteData', id) :console.log('gagal')" class="btn btn-outline-danger btn-rounded btn-sm"
                                                data-toggle="tooltip" data-placement="top" title="hapus">hapus</button>
                                        
                                                
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6" class="text-center">Data tidak ada</td>
                                </tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                Menampilkan
                                                @if ($totalData >0)
                                                {{ $page == 1 ? 1 : ($page-1)+$limit }}
                                                @else
                                                0
                                                @endif

                                                -
                                                {{$totalData < 1 ? 0 : (($page-1)*$limit)+$totalDataPage }}
                                                dari
                                                {{$totalData}} data
                                            </div>
                                            <div class="col-lg-6 text-right">
                                                <span>Jumlah per halaman</span>
                                                <select name="" id="" wire:model.lazy="limit">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>


                                                <button class="dv-footer-btn" wire:click="prevPage">
                                                    &laquo;
                                                </button>


                                                <div
                                                    style="border: 1px solid black; width: 50px; text-align: center;  display:inline-block">
                                                    {{ $page }}
                                                </div>
                                                {{-- <input type=" text" class="dv-footer-input" wire:model.lazy="page" /> --}}

                                                @if ((($page-1)*$limit)+$totalDataPage == $totalData)
                                                <button class="dv-footer-btn" disabled>
                                                    &raquo;
                                                </button>
                                                @else
                                                <button class="dv-footer-btn" wire:click="nextPage">
                                                    &raquo;
                                                </button>
                                                @endif



                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (session()->has('success'))
@push('custom-scripts')
<script>
   function notif(){
       console.log('asdsa');
    toastr['success']('',
    "{{ session("success") }}");
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
   }
   notif();
</script>
@endpush
@endif
