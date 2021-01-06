<div>
    <div class="row" >
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Tambah Data Produk</h6>
                </div>
                <div class="card-body">
                    <div class="form-row mb-4">
                        <div class="form-group col-lg-6">
                            <label for="kode_barcode">Kode barcode</label>
                            <input type="text" placeholder="Masukkan barcode" class="form-control" wire:model.lazy="kodeBarcode">
                            @error('kodeBarcode')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="kode_barcode">Nama Produk</label>
                            <input type="text" placeholder="Masukkan nama produk" class="form-control" wire:model.lazy="namaProduk">
                            @error('kodeBarcode')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="kode_barcode">Kategori</label>
                            <livewire:shared.select2 :options="$daftarKategoriArr" :listenFunction="'selectedKategori'" :placeholder="'Pilih kategori'" />
                            @error('idKategori')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="kode_barcode">Satuan</label>
                            <livewire:shared.select2 :options="$daftarSatuanArr" :listenFunction="'selectedSatuan'"  :placeholder="'Pilih satuan'"/>
                            @error('idSatuan')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="kode_barcode">Harga Modal</label>
                            <livewire:shared.rupiah-input :placeholder="'Masukkan harga modal'" :listenFunction="'inputRupiahHargaModal'"/>
                            @error('hargaModal')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="kode_barcode">Harga Jual</label>
                            <livewire:shared.rupiah-input :placeholder="'Masukkan harga jual'" :listenFunction="'inputRupiahHargaJual'"/>
                            @error('hargaJual')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="kode_barcode">Diskon</label>
                            <livewire:shared.rupiah-input :placeholder="'Masukkan diskon jika ada'" :listenFunction="'inputRupiahDiskon'"/>                            
                            @error('diskon')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="kode_barcode">Minimal Jumlah Diskon</label>
                            <input type="text" placeholder="Masukkan minimal jumlah diskon" class="form-control" wire:model.lazy="minimalDiskon">
                            @error('minimalDiskon')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="kode_barcode">Keterangan</label>
                            <input type="text" placeholder="Masukkan keterangan" class="form-control" wire:model.lazy="keterangan">
                            @error('keterangan')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-lg-12 text-right mt-2">
                            <button class="btn btn-outline-default btn-rounded">Batal</button>
                            <button class="btn btn-outline-primary btn-rounded" wire:click="create">Simpan</button>
                            <button class="btn btn-primary btn-rounded">Simpan & Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
<script>
    var ss = $(".basic").select2({
    tags: true,
});

$(".basic").on('change', function(){
    @this.idKategori = $(this).val();
    console.log($(this).val());
});

$('.rupiah').autoNumeric('init');
</script>
@endpush
