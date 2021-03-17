<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat Daftar Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>

               <div class="modal-body">
                <p>
                    <input type="text" class="form-control" placeholder="Masukkan nama produk">
                </p>

                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Pepsodent</td>
                        <td>10</td>
                        <td>Rp.12.000</td>
                        <td><button class="btn btn-sm btn-primary">Pilih</button></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Pepsodent</td>
                        <td>10</td>
                        <td>Rp.12.000</td>
                        <td><button class="btn btn-sm btn-primary">Pilih</button></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Pepsodent</td>
                        <td>10</td>
                        <td>Rp.12.000</td>
                        <td><button class="btn btn-sm btn-primary">Pilih</button></td>
                    </tr>
                </table>
               </div>
                

            </div>
        </div>
    </div>
</div>
