<div class="card " style="width: 18rem;">
    <img class="cardcust" src="{{ !$article->images()->get()->isEmpty() ? $article->images()->first()->getUrl(600,600) : 'https://picsum.photos/100/100'}}" class="card-img-top" alt="...">
<div class="card-body shadow bg-secondaryCus text-center">
<h5 class="card-title text-truncate fw-bold txt-myblack">{{$article->title}}</h5>
<p class="card-text text-truncate txt-terciary ">{{$article->subtitle}}</p>
<p class="card-text text-truncate txt-terciary ">{{$article->body}}</p>
<p class="card-text txt-terciary ">Prezzo:{{$article->price}} €</p>
<p class="card-text txt-terciary ">Categoria: {{$article->category->name}}</p>
<p class="txt-terciary ">Caricato il : {{$article->getFormattedDate()}}</p>
<a href="{{route('article.show',compact('article'))}}" class="btn btn-primary">Dettaglio</a>
</div>
</div>