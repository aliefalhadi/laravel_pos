<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Data Produk</h6>
                </div>
                <div class="card-body">
                
                    <a href="{{route('transaksi.tambah', ['idGudang'=>$idGudang])}}"  class="btn btn-primary mb-2" >Tambah data</a>
                    <div class="">
                       
                        <table class="table table-bordered table-hover table-condensed mb-4">
                            <thead>
                                <tr>
                                    <th>No </th>
                                
                                    <th wire:click="changeSort('tgl_transaksi')">Tanggal Transaksi
                                        {!! $sortField == 'tgl_transaksi' ? $sort =='desc' ? '<i class="fas fa-angle-down"></i>'
                                        : '<i class="fas fa-angle-up"></i>' :'' !!}
                                    </th>

                                    <th wire:click="changeSort('status')">Status
                                        {!! $sortField == 'status' ? $sort =='desc' ? '<i class="fas fa-angle-down"></i>'
                                        : '<i class="fas fa-angle-up"></i>' :'' !!}
                                    </th>

                                    <th class="text-center">Action</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    
                                    <td>
                                        <input type="text" wire:model.debounce.500ms="searchTglTransaksi" class="form-control">
                                    </td>
                                    <td>
                                        <select wire:model.debounce.500ms="searchStatus" class="form-control">
                                            <option value="1">Selesai</option>
                                            <option value="2">Hutang</option>
                                        </select>
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
                                    <td>{{$item->tgl_transaksi}}</td>
                                    <td class="text-center"><span class="badge badge-success">{{$item->status == 1 ? 'SELESAI':'HUTANG'}}</span></td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><a href="{{route('transaksi.detail', ['idTransaksi'=>$item->id_transaksi])}}"
                                                    class="btn btn-outline-primary btn-rounded btn-sm"
                                                    data-toggle="tooltip" data-placement="top" title="Edit">
                                                    lihat detail
                                                </a></li>
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
