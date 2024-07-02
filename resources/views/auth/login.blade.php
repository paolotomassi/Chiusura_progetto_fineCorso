<x-layout>
    <x-header title="ACCEDI" subtitle=""/>
    @if ($errors->any())
        <div class="alert alert-danger mb-0">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
       </div>
    @endif
    <div class="container-fluid sfondoCus">
        <div class="row justify-content-center mb-5">
            <div class="col-8">
                <form method="POST" action="{{route('login')}}">
                    @csrf

                    
                    <div id="toscroll" class=" mt-5 mb-3">
                      <label  class="form-label">Email address</label>
                      <input type="email" class="form-control" name='email'>
                      
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Password</label>
                      <input type="password" class="form-control" name='password'>
                    </div>

                  
                  
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
        <x-footer/>
    </div>
</x-layout>