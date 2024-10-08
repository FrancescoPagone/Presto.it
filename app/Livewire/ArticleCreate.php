<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Jobs\ResizeImage;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\RemoveFaces;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticleCreate extends Component



{

    use WithFileUploads;
    public $images = [];
    public $temporary_images;

    #[Validate]
    public $title;
    #[Validate]
    public $body;
    #[Validate]
    public $price;
    #[Validate]
    public $category;

    public $article;

    public function rules()
    {
        return [
            'title' => 'required|max:25',
            'body' => 'required',
            'price' => 'required|',
            'category' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'required' => 'Il campo :attribute è obbligatorio! ',
            'min' => 'Il campo :attribute deve avere un minimo di caratteri: :min',
            'max' => 'Il campo :attribute deve avere un massimo di caratteri: :max'
        ];
    }
    public function store()
    {
        $this->validate();
        $this->article = Article::create([
            'title' => $this->title,
            'body' => $this->body,
            'price' => $this->price,
            'category_id' => $this->category,
            'user_id' => Auth::user()->id
        ]);

        if (count($this->images) > 0) {
            foreach ($this->images as $image) {
                $newFileName = "articles/{$this->article->id}";
                $storedPath = $image->store($newFileName, 'public');
                $newImage = $this->article->images()->create([
                    'path' => $storedPath
                ]);
                // dispatch(new ResizeImage($storedPath, 300, 300));
                // dispatch(new GoogleVisionSafeSearch($newImage->id));
                // dispatch(new GoogleVisionLabelImage($newImage->id));
                RemoveFaces::withChain([
                    new ResizeImage($storedPath, 300, 300),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id)
                ])->dispatch($newImage->id);
            }
            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        session()->flash('success', 'Articolo creato con successo!');

        $this->reset();
        return redirect('/products')->with('message', 'In attesa di approvazione!');
    }

    public function validationAttributes()
    {
        return [
            'body' => 'descrizione',
            'title' => 'titolo',
            'price' => 'prezzo',
        ];
    }

    public function render()
    {
        return view('livewire.article-create');
    }

    public function updatedTemporaryImages()
    {
        if ($this->validate([
            'temporary_images.*' => 'image|max:1024',
            'temporary_images' => 'max:6'
        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }
}
