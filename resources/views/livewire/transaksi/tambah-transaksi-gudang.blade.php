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
                                <button wire:click="addProduk" class="btn btn-modal btn-primary">Lihat daftar produk</button>
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
                                <table class="table table-bordered table-striped">
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
                                    <label for="">Diskon</label>
                                    <input type="text" id="diskonBayar" name="" class="form-control">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Bayar</label>
                                    <input type="text" name="" id="totalBayar" class="form-control">
                                </div>
                                <div class="col-lg-3 text-center">
                                    <label for="">Kembalian</label>
                                    <h3 id="kembalian">Rp 0</h3>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">&nbsp;</label>
                                    <a href="" id="btn-selesai" class="btn  btn-primary btn-block">
                                        <span class="glyphicon glyphicon-shopping-cart"></span> Selesai
                                    </a>
                                    <form action="" id="formTransaksi" method="post">
                                        <input type="hidden" name="_csrf" value="">
                                        <input type="hidden" name="data_transaksi" id="fData_transaksi">
                                        <input type="hidden" name="total" id="fTotal">
                                        <input type="hidden" name="totalBayar" id="fTotalBayar">
                                        <input type="hidden" name="diskonBayar" id="fDiskonBayar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')

@endpush