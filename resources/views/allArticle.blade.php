<x-layout>

    <x-header title="" subtitle="Tutti I Nostri Articoli"/>
    {{-- <div class="container-fluid ">
        <div class="row ">
            
            @foreach ($articles as $article)
 
            @endforeach
            
        </div>
    </div> --}}

    <div id="toscroll" class="container-fluid pt-5 sfondoCus">
        <div class="row">
            
                    @forelse ($articles as $article)
                    <div class="col-12 col-md-4 my-4 d-flex justify-content-center">
                        <x-card
                        :article="$article"
                        />
                    </div>
                
                    @empty
                    <div class="col-12">
                        <div class="alert alert-danger py-3 shadow">
                            <p>Non ci sono annunci in questa pagina</p>
                        </div>
                    </div>
                  @endforelse
                  {{-- {{$articles->link()}} --}}
                </div>
                <x-footer/>
            </div>
</x-layout>