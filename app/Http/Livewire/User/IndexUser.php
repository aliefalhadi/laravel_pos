<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class IndexUser extends Component
{
    // public $daftarUser =[];
    public $page=1;
    public $limit=10;
    public $sort='desc';
    public $sortField = 'created_at';
    public $c="";
    public $searchName;
    public $searchEmail;

    protected $listeners = ['refreshData'];

    public function nextPage(){
       $this->page++;
    }

    public function prevPage(){
        if($this->page >1){
            $this->page--;
        }
     }

     public function changeSort($field){
         if($this->sort == 'asc'){
             $this->sort = 'desc';
         }else{
            $this->sort = 'asc';
         }
         $this->sortField = $field;
     }

     
    public function refreshData() 
    {
        // Refresh if the argument is NULL or is the product ID
        $this->c = 'asdasd';
    }

    public function tambahUser(){
        
        $this->emit('showModal');
    }

  
    public function render()
    {
        $daftarUser = User::orderBy($this->sortField, $this->sort);
        if($this->searchEmail !=''){
            $daftarUser->where('email', 'like', '%'.$this->searchEmail.'%');
        }
        if($this->searchName !=''){
            $daftarUser->where('name', 'like', '%'.$this->searchName.'%');
        }
        $total = $daftarUser->count();

       $daftarUser = $daftarUser->limit($this->limit)->offset(($this->page-1)*$this->limit)->get();
       $totalDataPage = $daftarUser->count();

       
        return view('livewire.user.index-user', [
            'daftarUser' => $daftarUser,
            'totalData' => $total,
            'totalDataPage' => $totalDataPage
        ]);
    }
}
