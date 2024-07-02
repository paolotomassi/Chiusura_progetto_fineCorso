<nav class="navbar navbar-expand-lg navbarCus navFixed">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-cart-shopping txt-main fs-3"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  " id="navbarSupportedContent">
            <div class="navbar-nav mb-2 mb-lg-0 mx-auto"> 
                <div class="nav-item">
                  <x-_locale lang="it" nation="it"/>
                </div>
                <div class="nav-item">
                    <x-_locale lang="en" nation="gb"/>
                </div>
                <div class="nav-item">
                    <x-_locale lang="es" nation="es"/>
                </div>              
                <div class="nav-item">
                    <a class="nav-link txt-main fw-bold" href="{{route('home')}}">Home</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link txt-main fw-bold" href="{{route('article.all')}}">{{__('ui.visualizzaArticle')}}</a>
                </div>
                <div class="nav-item">
                    <a class="nav-link txt-main fw-bold" href="{{route('article.create')}}">{{__('ui.allAnnouncements')}}</a>
                </div>
                <div class="nav-item">
                    @auth 
                    @if (Auth::user()->is_revisor)
                    <li>
                        <a class="nav-link btn txt-main fw-bold" aria-current="page" href="{{ route('revisor.index') }}">{{__('ui.revisore')}}
                            @if (App\Models\Article::toBeRevisionedCount()!=0)
                            <span class="position-absolute top-100 start-30 translate-middle badge rounded-pill bg-danger">{{ App\Models\Article::toBeRevisionedCount() }}
                                <span class="visually-hidden">Unread messages</span>
                            </span>
                            @endif
                            
                        </a>
                    </li>
                    @endif
                    @endauth
                </div>
                {{-- <div class="nav-item"> --}}
                    {{-- <a class="nav-link txt-main fw-bold" href="{{route('article.index')}}">Visualizza i tuoi articoli</a> --}}
                    {{-- </div> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle txt-main fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @guest Azioni di accesso @else {{__('ui.saluto')}} {{Auth::user()->name}} @endguest
                          
                        </a>
                        <ul class="dropdown-menu bg-secondaryCus" id="dropdownAccess">
                            @guest
                        <li><a class="dropdown-item nav-link dropdownItemtxt-primary" href="{{route('register')}}">Registrati</a></li>
                        <li><a class="dropdown-item nav-link txt-primary" href="{{route('login')}}">Accedi</a></li>
                        @endguest
                        @auth
                            <li><a class="dropdown-item nav-link txt-primary" href="{{route('logout')}}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a></li>
                                <form action="{{route('logout')}}" method="post" id="logout-form" class="d-none">Logout</a>
                                    @csrf
                                </form>

                        @endauth
                        </ul>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle txt-main fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              {{__('ui.categoria')}}
                            </a>
                            <ul class="dropdown-menu  bg-secondaryCus"  id="dropdownScroll">
                                @foreach ($categories as $category)
                                <li>
                                    <a class="dropdown-item nav-link txt-primary" href="{{route('article.category', $category)}}">{{$category->name}}</a>
                                </li>
                            @endforeach
                            </ul>
                          </li>
                    </div>        
                @auth
                <div class="searchCustom">
                    <form action="{{route('articles.search')}}" method="GET" class="d-flex">
                    <input name="search" class="form-control mx-auto" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    @endauth
                </div> 
            </div>
        </div> 
    </div>
</nav>