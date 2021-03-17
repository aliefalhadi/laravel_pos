<div>
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Tambah produk (F1)</label>
                            <input type="text" wire:model.debounce.500ms="searchProduk"  name="" id="i-produk" class="form-control" wire:change="addProduk">
                        </div>
                        <div class="col-lg-2">
                            <label for="">&nbsp;</label>
                            <p class="">
                                <button wire:click="lihatProduk" class="btn btn-modal btn-primary">Lihat daftar produk</button>
                            </p>
                        </div>

                        <div class="col-lg-4 offset-2">
                            <h4>Total</h4>
                            <h1 class="text-right" id='total_harga'>
                                {{"Rp " . number_format($totalTransaksi, 2, ",", ".")}}
                            </h1>
                        </div>

                        <div class="col-lg-12">
                            <hr>
                            <div style="overflow-y: auto; height: 280px;">
                                <table class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <td class="text-center">No</td>
                                            <td class="text-center">Kode Item</td>
                                            <td class="text-center">Nama Item</td>
                                            <td class="text-center">Qty</td>
                                            <td class="text-center">Harga</td>
                                            <td class="text-center">Sub Total</td>
                                            <td class="text-center">Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($daftarProdukTransaksi)>0)
                                            @foreach($daftarProdukTransaksi as $i=> $dt)
                                                <tr>
                                                    <td>
                                                        {{$i+1}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$dt['kode_barcode']}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$dt['nama_produk']}}
                                                    </td>
                                                    <td>
                                                        {{$dt['qty']}}
                                                    </td>
                                                    <td>
                                                        {{"Rp " . number_format($dt['harga_jual'], 2, ",", ".")}}
                                                    </td>
                                                    <td>
                                                        {{"Rp " . number_format($dt['qty']*$dt['harga_jual'], 2, ",", ".")}}
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-xs btn-danger" wire:click="hapusProdukTransaksi({{$dt['kode_barcode']}})"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr><td class='text-center' colspan='9'>tidak ada data</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <hr>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="">Diskon (F2)</label>
                                    <livewire:shared.rupiah-input :placeholder="'Masukkan total bayar'" :listenFunction="'inputRupiahDiskonBayar'" :initialValue="$diskonBayar" :idEl="'i-diskon'" />
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Bayar (F3)</label>
                                    <livewire:shared.rupiah-input :placeholder="'Masukkan total bayar'" :listenFunction="'inputRupiahTotalBayar'" :initialValue="$totalBayar" :idEl="'i-bayar'" />
                                    <!-- <input type="text" name="" id="totalBayar" class="form-control" wire:model.debounce.500ms="totalBayar" > -->
                                </div>
                                <div class="col-lg-3 text-center">
                                    <label for="">Kembalian</label>
                                    <h3 id="kembalian">{{"Rp " . number_format($totalKembalian, 2, ",", ".")}}</h3>
                                </div>
                                <div class="col-lg-3" x-data="{  }">
                                    <label for="">&nbsp;</label>
                                   <!-- <a href="" id="btn-selesai" class="btn  btn-primary btn-block">
                                        <span class="glyphicon glyphicon-shopping-cart"></span> Selesai
                                    </a>  -->
                                    <div>
                                        <button x-on:click="confirm('apakah anda yakin?') ? $wire.call('create') :console.log('gagal')" class="btn btn-primary btn-block"
                                    data-toggle="tooltip" data-placement="top" title="hapus" id="btn-selesai"> <span class="glyphicon glyphicon-shopping-cart"></span> Selesai (F12)</button>
                                        <div wire:loading>
                                            Processing...
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

    @livewire('transaksi.lihat-daftar-produk')
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

@push('custom-scripts')
<script>
   $(document).on('keydown',function(e) {
    

    //f1
    if(e.which == 112) {
        e.preventDefault();
        $('#i-produk').focus();
    }

    //f2
    if(e.which == 113) {
        e.preventDefault();
        $('#i-diskon').focus();
    }

    //f3
    if(e.which == 114) {
        e.preventDefault();
        $('#i-bayar').focus();
    }

    //f12
    if(e.which == 123) {
        e.preventDefault();
        $('#btn-selesai').click();
    }
});
</script>
@endpush