<div x-data="dropdown()" x-init="loadOptions()" style="position: relative;" class="custom-dropdown">
    <input type="search" placeholder="{{$placeholder}}" class="form-control"  @click="open = true" wire:model.debounce.300ms="select" x-on:keyup="filterSelect($event.target.value)">
    <div x-show="open" @click.away="open = false" class="card mt-1" style="max-height: 200px; width: 100%; overflow-y: auto; position: absolute; z-index: 500;">
        <ul>
            <template x-for="(option,index) in selectOptions" :key="option.key">
                <li  x-on:click="$wire.selected(option); open=false" x-text="option.value"></li>
            </template>
        </ul>
    </div>
</div>
@push('styles')
<style>
   .custom-dropdown ul{
        list-style: none;
        padding: 0px;
    }
    .custom-dropdown ul li{
        padding: 10px;
        border-bottom: 1px solid whitesmoke;
    }
    .custom-dropdown ul li:hover{
        background-color: whitesmoke;
        cursor: pointer;
    }
</style>
@endpush

@push('custom-scripts')
<script>
    function dropdown() {
        return {
            open:false,
            selectOptions: [],
            options: @entangle('options'),
            loadOptions(){
                this.selectOptions = this.options;
            },
            filterSelect(value){
                let newOptions = this.options.filter((str)=>{
                    return str.value.search(value) !== -1;
                });
               this.selectOptions = newOptions;
            }
        }
    }
</script>
@endpush
