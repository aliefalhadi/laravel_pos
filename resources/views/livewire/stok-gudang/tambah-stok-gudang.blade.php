<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Stok Gudang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>
                <form wire:submit.prevent="create">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Produk</label>
                            <livewire:shared.select2 :options="$daftarProduk" :listenFunction="'selectedProduk'" :placeholder="'Pilih produk'" :initialValue="$initialValue" />
                            @error('idProduk')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Minimal Stok Produk</label>
                            <input wire:model.lazy="minStok" type="text" placeholder="Masukkan minimal stok" class="form-control">
                            @error('minStok')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Stok</label>
                            <input wire:model.lazy="stok" type="text" placeholder="Masukkan stok awal" class="form-control">
                            @error('stok')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>
                       
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Batal</button>
                        <div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        
                            <div wire:loading>
                                Processing...
                            </div>
                        </div>
                        
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
