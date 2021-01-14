<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Data Stok Gudang</h6>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary mb-2" wire:click="tambahData">Tambah data</button>
                    <div class="">
                       
                        <table class="table table-bordered table-striped table-hover table-condensed mb-4">
                            <thead>
                                <tr>
                                    <th>No </th>
                                    <th wire:click="changeSort('id_produk')">Produk
                                        {!! $sortField == 'id_produk' ? $sort =='desc' ? '<i class="fas fa-angle-down"></i>'
                                        : '<i class="fas fa-angle-up"></i>' :'' !!}
                                    </th>
                                    <th wire:click="changeSort('id_produk')">Kategori
                                        {!! $sortField == 'id_produk' ? $sort =='desc' ? '<i class="fas fa-angle-down"></i>'
                                        : '<i class="fas fa-angle-up"></i>' :'' !!}
                                    </th>
                                    <th wire:click="changeSort('id_produk')">Satuan
                                        {!! $sortField == 'id_produk' ? $sort =='desc' ? '<i class="fas fa-angle-down"></i>'
                                        : '<i class="fas fa-angle-up"></i>' :'' !!}
                                    </th>
                                    <th wire:click="changeSort('stok')">Stok
                                        {!! $sortField == 'stok' ? $sort =='desc' ? '<i class="fas fa-angle-down"></i>'
                                        : '<i class="fas fa-angle-up"></i>' :'' !!}
                                    </th>
                                    <th wire:click="changeSort('min_stok')">Minimal Stok
                                        {!! $sortField == 'min_stok' ? $sort =='desc' ? '<i class="fas fa-angle-down"></i>'
                                        : '<i class="fas fa-angle-up"></i>' :'' !!}
                                    </th>

                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="text" wire:model.debounce.500ms="searchNamaKategori" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" wire:model.debounce.500ms="searchNamaKategori" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" wire:model.debounce.500ms="searchNamaKategori" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" wire:model.debounce.500ms="searchNamaKategori" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" wire:model.debounce.500ms="searchNamaKategori" class="form-control">
                                    </td>

                                    <td>

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
                                    <td>{{$item->produk->nama_produk}}</td>
                                    <td>{{$item->produk->kategori->nama_kategori}}</td>
                                    <td>{{$item->produk->satuan->nama_satuan}}</td>
                                    <td class="text-center"><span class="badge badge-info ml-2">{{$item->stok}}</span></td>
                                    <td class="text-center">{{$item->min_stok}}</td>
                                    <td><span class="badge badge-{{$item->status_stok == 'Ready' ? 'success' : (($item->status_stok == 'Kosong') ? 'danger' : 'warning') }}">{{$item->status_stok}}</span></td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><a href="javascript:void(0);"
                                                    wire:click ="editData({{$item}})"
                                                    class="btn btn-outline-primary btn-rounded btn-sm"
                                                    data-toggle="tooltip" data-placement="top" title="Edit">
                                                    edit
                                                </a></li>
                                            <li  x-data="{ idKategori: {{$item->id_stok_gudang}} }">  
                                                <button x-on:click="confirm('apakah anda yakin?') ? $wire.call('deleteData', idKategori) :console.log('gagal')" class="btn btn-outline-danger btn-rounded btn-sm"
                                                data-toggle="tooltip" data-placement="top" title="hapus">hapus</button>
                                        
                                                
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8" class="text-center">Data tidak ada</td>
                                </tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
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
    @livewire('stok-gudang.tambah-stok-gudang', ['idGudang'=>$idGudang])
    @livewire('stok-gudang.edit-stok-gudang')
</div>
