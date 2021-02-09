<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Data Gudang</h6>
                </div>
                <div class="card-body">
                  
                    <div class="">
                       
                        <table class="table table-bordered table-hover table-condensed mb-4">
                            <thead>
                                <tr>
                                    <th>No </th>
                                    <th wire:click="changeSort('nama_gudang')">Nama Gudang
                                        {!! $sortField == 'nama_gudang' ? $sort =='desc' ? '<i class="fas fa-angle-down"></i>'
                                        : '<i class="fas fa-angle-up"></i>' :'' !!}
                                    </th>

                                    <th class="text-center">Action</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="text" wire:model.debounce.500ms="searchNamaGudang" class="form-control">
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
                                    <td>{{$item->nama_gudang}}</td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><a href="{{route('transaksi.daftar', ['idGudang'=>$item->id_gudang])}}"
                                                class="btn btn-outline-primary btn-rounded btn-sm"
                                                data-toggle="tooltip" data-placement="top" title="lihat data transaksi">
                                                Data Transaksi
                                            </a></li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center">Data tidak ada</td>
                                </tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
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
    @livewire('gudang.tambah-gudang')
    @livewire('gudang.edit-gudang')
</div>
