<x-layout>
  <x-header title="" subtitle="Dettaglio articolo"/>
  <div id="toscroll" class="container-fluid py-5 sfondoCus">
    <div class="row media1Cus">
      <div class="col-12 col-lg-6 my-5">
        <div class="swiper mySwiper">
          <div class="swiper-wrapper">
          @if(!$article->images()->get()->isEmpty() )
            @foreach ($article->images as $image)
            <div class="swiper-slide "><img  src="{{ Storage::url($image->path)}}" alt=""></div>
            @endforeach
          @else
            <div class="swiper-slide "><img  src="https://picsum.photos/200" alt=""></div>
            <div class="swiper-slide "><img  src="https://picsum.photos/201" alt=""></div>
            <div class="swiper-slide "><img  src="https://picsum.photos/202" alt=""></div>
          @endif
          </div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
      <div class="col-12 col-lg-5 glassmorphism text-center my-5 ">
        <h2>{{$article->title}}</h2>
        <h3>{{$article->subtitle}}</h3>
        <p>{{$article->body}}</p>
        <p>Prezzo: {{$article->price}} €</p>
        <p>Categoria {{$article->category->name}}</p>  
        <a href="{{route('home')}}" class="btn btn-primary">Torna alla home</a>
        @auth
            
        
        <form method="POST" action="{{route('article.delete', compact('article'))}}">
      @csrf
    @method('delete')
<button type="submit" class="btn btn-danger my-3  ">Cancella </button>
      </form>
      @endauth
      </div>
    </div>
    <x-footer/>
  </div>
</x-layout>