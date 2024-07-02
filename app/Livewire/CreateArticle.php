<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisioLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Console\View\Components\Component as ComponentsComponent;

class CreateArticle extends Component
{
    Use WithFileUploads;
    public $title;
    public $subtitle;
    public $body;
    public $price;
    public $category;
    public $temporary_images;
    public $images=[];
    public $image;
    public $article;
   
    protected $rules=[
        'title' => 'required|min:10|max:200',
        'subtitle' => 'required|min:10|max:200',
        'price' => 'required',
        'body' => 'required|min:25|max:3000',
        'category' => 'required',
        'temporary_images.*' => 'image|max:1024',
        'images.*' => 'image|max:1024',
    ];

    protected $messages=[
        'title.required' => 'Il titolo è richiesto',
        'title.min' => 'Il titolo è troppo corto',
        'title.max' => 'Il titolo è troppo lungo',
        'subtitle.required' => 'Il sottotitolo è richiesto',
        'subtitle.min' => 'Il sottotitolo è troppo corto',
        'subtitle.max' => 'Il sottotitolo è troppo lungo',
        'body.required' => 'Il corpo dell\'articolo è richiesto',
        'body.min' => 'Il corpo dell\'articolo è troppo corto',
        'body.max' => 'Il corpo dell\'articolo è troppo lungo',
        'price.required' => 'Devi inserire il prezzo',
        'category.required' => 'Devi inserire la categoria',
        'temporary_images.required' => 'L\'immagine è richiesta',
        'temporary_images.*.image' => 'I File devono essere Immagini',
        'temporary_images.*.max' => 'L\'immagine è troppo grande',
    ]; 

    public function updatedTemporaryImages()
    {
        if($this->validate([
            
            'temporary_images.*' => 'image|max:1024',
        ])){
            foreach($this->temporary_images as $image){
                $this->images[] = $image;
            }
        }

    }

    public function removeImage($key)
    {
        if (in_array($key , array_keys($this->images))){
            unset($this->images[$key]);
        }
    }


    // public function store() 
    // {
    //     $this->validate();

    //     $this->article= Category::find($this->category)-> articles() ->create($this->validate());

    //     if (count($this->images)) {
    //         foreach ($this->images as $image) {
    //             $newFileName= "articles/{$this->article->id}";
    //             $newImage=$this->article->images()->create(['path'=>$image->store($newFileName, 'public')]);

    //             RemoveFaces::withChain([
    //                 new ResizeImage($newImage->path, 400,300),
    //                 new GoogleVisionSafeSearch($newImage->id),
    //                 new GoogleVisioLabelImage($newImage->id)

    //             ])->dispatch($newImage->id);
            
    //         }
    //         File::deleteDirectory(storage_path('/app/livewire-tmp'));
    //     }

    //     session()->flash('message', 'Articolo inserito con successo, sarà pubblicato dopo la revisione');
    //     $this->cleanForm();
    // }

    public function save(){
        // dd(Auth::user());
        $this->validate();
        $this->article = Article::create([
            'title'=> $this->title,
            'subtitle'=> $this->subtitle,
            'body'=>$this->body,
            'price'=>$this->price,
            'category_id'=> $this->category,
            'user_id'=>Auth::user()->id,
            // 'img'=> $this->img,
            // 'img' => $this->file('img'),
        ]);

        // dd($this->article->user());
        // $this->article = Category::find($this->category)->article()->create($this->validate());
        if (count($this->images)>0){
            foreach ($this->images as $image) {
                // $this->article->images()->create(['path'=>$image->store('images', 'public')]);
                $newFileName="articles/{$this->article->id}";
                $newImage=$this->article->images()->create(['path'=>$image->store($newFileName, 'public')]);

                RemoveFaces::withChain([
                    new ResizeImage($newImage->path, 600,600),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisioLabelImage($newImage->id)

                ])->dispatch($newImage->id);
            }

            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }
        
        // $this->article->user()->associate(Auth::user());

            $this->article->save();



        $this->reset();
        // redirect(route('home'))->with('message', 'Il tuo articolo è stato creato correttamente.');
        redirect(route('home'))->with('message', 'Articolo inserito con successo, sarà pubblicato dopo la revisione');

        $this->cleanForm();
    }
    public function cleanForm(){
        $this->title = '';
        $this->subtitle = '';
        $this->body = '';
        $this->price = '';
        $this->category = '';
        $this->temporary_images = [];
        $this->images = [];
    }


    
    public function render()
    {
        return view('livewire.create-article');
    }
    
    
}
