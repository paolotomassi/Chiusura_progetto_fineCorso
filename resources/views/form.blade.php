<x-layout>
    <x-header title='' subtitle='Lavora con noi'/>

    <div id= "toscroll" class="container-fluid py-5 sfondoCus">
      <div class="row justify-content-center text-center">
        <div class="col-8">
          <form method="POST" action="{{route('salva.body')}}">
            @csrf
             <div class="mb-3">
               <label  class="form-label txt-secondary fw-bold fs-2">Perchè vuoi lavorare con noi?</label>
               <textarea name="body"  cols="30" rows="10" class="form-control"></textarea>
             </div>
            
             <button type="submit" class="btn btn-success">Invia la tua richiesta</button>
           </form>
        </div>
      </div>
      <x-footer/>
    </div>


</x-layout>