<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Data Transaksi</h6>
                </div>
                <div class="card-body">
                    <h6>Info Transaksi</h6>
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>ID Transaksi</td>
                            <td>{{ $dataTransaksi->id_transaksi }}</td>
                        </tr>
                        <tr>
                            <td>Gudang</td>
                            <td>{{ $dataTransaksi->gudang->nama_gudang }}</td>
                        </tr>
                        <tr>
                            <td>Kasir</td>
                            <td>{{ $dataTransaksi->kasir->name }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>{{ $dataTransaksi->tgl_transaksi }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><span class="badge badge-success">{{ $dataTransaksi->status == 1 ? "Selesai" :"Hutang" }}</span> </td>
                        </tr>
                    </table>

                    <br>
                    <h6>Detail Transaksi</h6>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Quantity</th>
                                <th>Diskon</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0;  ?>
                            @foreach($dataTransaksiDetail as $key => $dt)
                            <?php $subTotal = $dt->harga * $dt->quantity  ?>
                            <?php $total +=  $subTotal  ?>
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $dt->produk->nama_produk }}</td>
                                <td>{{"Rp " . number_format($dt->harga, 2, ",", ".")}}</td>
                                <td>{{ $dt->quantity }}</td>
                                <td> {{"Rp " . number_format(0, 2, ",", ".")}}</td>
                                <td> {{"Rp " . number_format($subTotal, 2, ",", ".")}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" style="font-weight: bold;">TOTAL</td>
                                <td style="font-weight: bold;">{{"Rp " . number_format($total, 2, ",", ".")}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
