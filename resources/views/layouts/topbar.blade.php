<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="logo-image">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
         </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('sales.index') }}">Sales list</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('products.products') }}">Sell products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('products.create') }}">Add products</a>
                </li>
                <li class=" dropdown nav-item ">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="clientsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Clients
                    </a>
                    <div aria-labelledby="clientsDropdown" class="dropdown-menu" >
                        <a class="dropdown-item text-dark" href="{{ route('clients.create') }}">Add Client</a>
                        <a class="dropdown-item text-dark" href="{{ route('clients.index') }}">List Clients</a>
                    </div>
                </li>
            </ul>
            <div class="ml-auto button-group">
                <a href="{{ route('users.edit') }}" class="btn-custom me-2">Edit Account</a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-custom">Logout</button>
                </form>
            </div>
        </div>

    </div>
</nav>