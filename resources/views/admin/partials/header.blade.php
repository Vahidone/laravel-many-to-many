

<header class="bg-dark">


    <nav class="navbar navbar-dark">
        <div class="container-fluid">
          <a href="{{ route('home')}}" target="_blank" class="navbar-brand"><i class="fa-solid fa-circle-left fs-4"></i><span class="text-white ms-2">Back to public page</span></a>
          <form action="{{ route('logout')}}" method="POST" class="d-flex" role="search">
            @csrf
            <button class="btn btn-light" type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
          </form>
        </div>
    </nav>

</header>
