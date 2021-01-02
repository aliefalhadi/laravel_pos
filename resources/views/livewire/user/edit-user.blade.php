<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input wire:model.lazy="name" type="text" placeholder="Masukkan nama" class="form-control">
                            @error('name')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>
                        
                         <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input wire:model.lazy="email" type="text" placeholder="Masukkan email"
                                class="form-control">
                            @error('email')<small id="sh-text1" class="form-text"
                                style="color:red">{{ $message }}</small>@enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Type</label>
                            <select class="form-control" id="exampleFormControlSelect1" wire:model.lazy="type">
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                            </select>
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
