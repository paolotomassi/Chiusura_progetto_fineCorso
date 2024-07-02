<x-layout>
    <x-header title="Registrati" subtitle="" />
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid sfondoCus">
        <div class="row justify-content-center">
            <div class="col-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div id="toscroll" class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name='name'>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" name='email'>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name='password'>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Conferma Password</label>
                        <input type="password" class="form-control" name='password_confirmation'>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <x-footer />
    </div>
</x-layout>
