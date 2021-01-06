<div x-data="rupiahInput()">
   <input type="text" placeholder="{{$placeholder}}" x-model="input" class="form-control" x-on:keyup="formatRupiah($event.target.value)" x-on:change="$wire.call('formatRupiah', inputValue)">
</div>

@push('custom-scripts')
<script>
    function rupiahInput(){
        return {
            input:'',
            inputValue:'',
            formatRupiah(value){
               this.inputValue = value.replace('Rp. ', '').replaceAll('.','');
               this.input = this.format(value);
            },
            format(value){
                return "Rp. " + (value + '').replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        }
    }
</script>
@endpush
