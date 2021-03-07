<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\books;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ListingBooks extends Component
{
    use WithPagination;
    public $active;
    public $qbooks;
    public $confirmBookDelete = false;
    public $BookAdd = false;
    public $book;
    public $coperta;

    protected $rules = [
        'book.titlu' => 'required | string',
        'book.isbn' => 'required | string',
        'book.categorie' => 'required | string',
        'book.autor' => 'required | string',
        'book.descriere' => 'required | string',
        'book.an' => 'required | integer',
        'book.editura' => 'required | string',
        'book.coperta' => 'sometimes|mimes:jpeg,jpg,png'
    ];







    public function render()
    {
        $books = books::getquery()
            ->when($this->qbooks, function ($query){
                return $query->where(function($query){
                    $query->where('titlu', 'like', '%'.$this->qbooks.'%')
                          ->orWhere('autor', 'like', '%'.$this->qbooks.'%')
                          ->orWhere('isbn', 'like', '%'.$this->qbooks.'%');

                });
            })
            ->when($this->active, function($query){
                return $query->where('status','Disponibila');})
            ->paginate(1);


        return view('livewire.listing-books', [
            'books' => $books,

        ]);
    }
    public function updatingActive(){
        $this->resetPage();
    }
    public function updatingQBooks(){
        $this->resetPage();
    }
    public function confirmDeleteBook($id){
        $this->confirmBookDelete= $id;
        //$book->delete();
    }
    public function deleteBook( books $book){
        $book->delete();
        $this->confirmBookDelete = false;
    }
    public function dialogBookAdd(){
        $this->reset(['book']);
        $this->BookAdd = true;
    }
    public function addBook(){
        $this->validate();
        $coperta = $request->file('coperta');
        $filename = time(). '. ' . $coperta->getClientOriginalExtension();
        Image::make($coperta)->resize(225,100)->save(public_path('storage/'.$filename));
        $book->coperta = $filename;

        book()->create([
            'titlu' => $this->book['titlu'],
            'autor' => $this->autor['autor'],
            'categorie' => $this->categorie['categorie'],
            'isbn' => $this -> isbn['isbn'],
            'an' => $this -> an['an'],
            'editura' => $this -> editura ['editura'],
            'descriere' => $this -> descriere ['descriere']
            ]) ;
        $coperta = $request->file('coperta');
        $filename = time(). '. ' . $coperta->getClientOriginalExtension();
        Image::make($coperta)->resize(225,100)->save(public_path('storage/'.$filename));
        $book->coperta = $filename;
    }

}
