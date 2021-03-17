<div x-data="rupiahInput()" x-init="formatRupiah({{$initialValue}})" >
   <input type="text" placeholder="{{$placeholder}}" x-model="input"  class="form-control" x-on:keyup="formatRupiah($event.target.value)" x-on:change="$wire.call('formatRupiah', input)" id="{{$idEl}}">
</div>

@push('custom-scripts')
<script>
    function rupiahInput(){
      
        return {
            input: '',
            inputValue:'',
            formatRupiah(value){
                
                if(value != null){
                   
                   
               this.input = this.format(value);
             
                }
               
            },
            format(value){
                return "Rp. " + (value + '').replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        }
    }
</script>
@endpush
