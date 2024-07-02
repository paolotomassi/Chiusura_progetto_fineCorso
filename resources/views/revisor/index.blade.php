 <x-layout>
    
    <div class="container-fluid p-5 bg-gradient bg-success p-5 shadow">
        <div class="row">
            <div class="col-12 text-light p-5 mt-2 pb-0 text-center">
                <h1 class="display-2">
                    {{ $article_to_check ? 'Ecco l\'annuncio da revisionare' : 'Non ci sono annunci da revisionare' }}
                </h1>
            </div>
        </div>
    </div>
    
    @if ($article_to_check)
    <div class="container-fluid justify-content-center sfondoCus pt-5">
        <div class="row justify-content-center">
            
            <div class="col-12 col-md-6">
                <div id="showCarousel" class="carousel slide" data-bs-ride="carousel">
                    @if ($article_to_check->images->isNotEmpty())
                    <div class="carousel-inner AltCarCus">
                        @foreach ($article_to_check->images as $image)
                        <div class="carousel-item @if($loop->first)active @endif">
                            <img src="{{$image->getUrl(600,600)}}" class="img-fluid p-3 rounded imgcarcus" alt="">
                            
                        </div>
                        @endforeach
                        
                    </div>
                    @else
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://picsum.photos/601/300" class="img-fluid p-3 rounded" alt="">
                        </div>
                        <div class="carousel-item active">
                            <img src="https://picsum.photos/602/300" class="img-fluid p-3 rounded" alt="">
                        </div>
                    </div>
                    @endif
                    <button class="carousel-control-prev" type="button" data-bs-target="#showCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Precedente</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#showCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Successivo</span>
                    </button>
                </div>
            </div>
            
            @if ($article_to_check->images->isNotEmpty())
            
            <div class="col-12 col-md-3 border-end">
                <h5 class="mt-3">Tags</h5>
                <div class="p-2">
                    @if ($image->labels && count($image->labels) > 0)
                    @foreach ($image->labels as $label)
                    <p class="d-inline">{{$label}},</p>
                    @endforeach
                    @endif 
                </div>
            </div>
            
            <div class="col-12 col-md-3 border-end">
                <div class="card-body">
                    <h5 class="mt-3">Revisione immagini</h5>
                    <p>Adulti: <span class="{{$image->adult}}"></span></p>
                    <p>Satira: <span class="{{$image->spoof}}"></span></p>  
                    <p>Medicina: <span class="{{$image->medical}}"></span></p>
                    <p>Violence: <span class="{{$image->violence}}"></span></p>
                    <p>Adulti: <span class="{{$image->adult}}"></span></p>
                    <p>Contenuto ammiccante: <span class="{{$image->racy}}"></span></p>
                    
                </div>
                
            </div>
            @endif
        </div>
        
        <h5 class="card-title">Titolo: {{ $article_to_check->title }}</h5>
        <p class="card-text">Descrizione: {{ $article_to_check->body }}</p>
        <p class="card-footer">Pubblicato il: {{ $article_to_check->created_at->format('D/m/Y')}}</p>
        
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 d-flex justify-content-around">
                <form action="{{ route('revisor.accept_article', ['article'=>$article_to_check]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success shadow btn2Cus">Accetta</button>
                </form>
                <form action="{{ route('revisor.reject_article', ['article'=>$article_to_check]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger shadow btn1Cus">Rifiuta</button>
                </form>
            </div>
        </div>
        <x-footer/>
    </div>
    
    @else 
    
    <div class="container-fluid sfondoCus heightCus">
        
        <div class="row">
            
            <div class="col-12">
                
            </div>
        </div>
        <x-footer/>
    </div>
    @endif
    
    
</x-layout>