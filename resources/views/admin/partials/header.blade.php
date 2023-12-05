

<header class="bg-dark">


    <nav class="navbar navbar-dark">
        <div class="container-fluid">
          <a href="{{ route('home')}}" target="_blank" class="navbar-brand"><i class="fa-solid fa-circle-left fs-4"></i><span class="text-white ms-2">Back to public page</span></a>




            <div class="d-flex">



                <form class="me-3 mt-2" action="{{ route('admin.search')}}" method="GET">


                    <input type="form-control mr-sm-2" type="search" placeholder="Cerca" name="toSearch">


                </form>






                <a href="{{ route('profile.edit')}}" class="text-white text-decoration-none me-3 mt-2">{{ Auth::user()->name}}</a>

                <form action="{{ route('logout')}}" method="POST" role="search">
                    @csrf
                    <button class="btn btn-light" type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>

                </form>




            </div>
        </div>
    </nav>

</header>
