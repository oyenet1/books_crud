<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AllBooks extends Component
{
    public $title, $isbn, $publisher, $publication_year, $cover_image, $genre, $author, $revision_number, $cid;

    public $update = false;
    public $delete = null;

    public $search = '';

    use WithPagination;
    use WithFileUploads;
    protected $listeners = [
        'deleteConfirm' => 'delete',
    ];

    // refreshinputs after saved
    public function refreshInputs()
    {
        $this->title = '';
        $this->publication_year = '';
        $this->author = '';
        $this->update = false;
    }

    public function add()
    {
        $this->update = false;
    }
    protected $messages = [
        'cover_image.image' => 'Image must be png, jpg, jpeg format',
        'cover_image.max' => 'Image must be less than 500kb',
        'cover_image.required' => 'Image must not be empty',
        'publication_year.required' => 'Published Date must not be empy',
        'publication_year.date' => 'Date must be in the past or today',
    ];

    public function save()
    {
        $data = $this->validate(
            [
                'title' => 'required|unique:books,title',
                'author' => 'required',
                'publication_year' => 'required|numeric',
            ]
        );

        $saved = Book::create($data);

        if ($saved) {
            $this->refreshInputs();
            $this->dispatchBrowserEvent('closeModal');
            $this->dispatchBrowserEvent('swal:success', [
                'icon' => 'success',
                'text' => strtoupper($this->title) . ' added to Archived',
                'title' => 'Book Added',
                'timer' => 5000,
            ]);
        }
        $this->refreshInputs();
    }

    public function confirmDelete(Book $book)
    {

        // $book = Book::findOrFail($id);

        $this->delete = $book->id;

        $this->dispatchBrowserEvent('swal:confirm');
    }
    public function edit(Book $book)
    {

        // $book = Book::findOrFail($id);

        $this->cid = $book->id;
        $this->title = $book->title;
        $this->publication_year = $book->publication_year;
        $this->author = $book->author;

        $this->update = true;
        $this->dispatchBrowserEvent('showModal');
    }

    public function update()
    {

        $book = Book::find($this->cid);
        $data = $this->validate(
            [
                'title' => 'required|unique:books,title,' . $this->cid,
                'author' => 'required',
                'publication_year' => 'required|numeric',

            ]
        );

        $saved = $book->update($data);

        if ($saved) {
            $this->refreshInputs();
            $this->dispatchBrowserEvent('closeModal');
            $this->dispatchBrowserEvent('swal:success', [
                'icon' => 'success',
                'text' => strtoupper($this->title) . ' added to Archived',
                'title' => 'Book Updated',
                'timer' => 7000,
            ]);
        }
        $this->refreshInputs();
        return redirect()->back();
    }

    public function delete()
    {

        $book = Book::findOrFail($this->delete);

        // if the book has a cover image delete the image along with data
        if ($book->cover_image || Storage::exists($book->cover)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $true = $book->delete();

        if ($true) {
            $this->dispatchBrowserEvent('swal:success', [
                'icon' => 'success',
                'text' => $book->title . ' has deleted Successfully from Archived',
                'title' => 'Deleted',
                'timer' => 7000,
            ]);
        }
        $this->update = false;
        $this->refreshInputs();
        return $this->reset();
    }

    public function render()
    {
        $term = '%' . $this->search . '%';
        $books = Book::where('author', 'LIKE', $term)
            ->orWhere('title', 'LIKE', $term)
            ->paginate(10);
        return view('livewire.all-books', compact(['books']));
    }
}
