<x-layout>
    
    <x-header title="Presto" subtitle=""/>

    <div id="toscroll" class="container-fluid pt-5 sfondoCus ">
        <div class="row  justify-content-between align-items-center mt-5 pt-5">

            

                @forelse ($category->article()->where('is_accepted',true)->get() as $article)
                    <div class="col-12 col-md-3 py-5 d-flex justify-content-center">
                        <x-card
                        :article="$article"
                        />
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-danger py-3 shadow">
                            <p>Non ci sono annunci per questa ricerca</p>
                        </div>
                    </div>
                @endforelse
          </div>
          <x-footer/>
    </div>
</x-layout>