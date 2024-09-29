<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS Bundle -->
    <style>
    .alert {
        z-index: 1050; /* Ensure the alert is above other content */
        transition: opacity 0.5s ease; /* Smooth transition effect */
    }
</style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">Hotel Management</a>

            <!-- Search Form -->
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search Hotels" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <!-- Right-side Buttons -->
            <div class="d-flex">
                <!-- Create Hotel Button -->
                <a href="{{ route('hotels.create') }}" class="btn btn-success me-2">Create Hotel</a>

                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-1 end-0 m-3" id="success-alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show position-fixed top-1 end-0 m-3" id="error-alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <!-- Body - Hotel List -->
    <div class="container mt-4">
        <h2>Your Listed Hotels</h2>
        @if(!$hotels->isEmpty())
        <div class="row">
            <!-- Loop through hotels and display them -->
            @foreach ($hotels as $hotel)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $hotel->name }}</h5>
                            <p class="card-text">{{ $hotel->description }}</p>
                            <p class="card-text"><small class="text-muted">{{ $hotel->address }}</small></p>

                            <!-- Edit and Delete buttons -->
                            <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <div class="text-center my-5">
            <h3>No Hotels Available</h3>
            <a href="{{ route('hotels.create') }}" class="btn btn-primary">Create Hotel</a>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="footer bg-light text-center text-lg-start mt-4">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Hotel Management</h5>
                    <p>Your go-to platform for managing hotels.</p>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Quick Links</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="{{ route('hotels.create') }}" class="text-dark">Create Hotel</a></li>
                        <!-- <li><a href="#" class="text-dark">About Us</a></li>
                        <li><a href="#" class="text-dark">Contact</a></li> -->
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Developer</h5>
                    <p>Developed by Kanhaya</p>
                </div>
            </div>
        </div>

        <div class="text-center p-3 bg-dark text-white">
            © 2024 All Rights Reserved
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert'); // Get all alert elements

        alerts.forEach(function(alert) {
            alert.classList.remove('show'); // Hide alert by removing 'show' class
            alert.classList.add('fade'); // Add 'fade' class for transition effect
        });
    }, 3000); // 3 seconds (3000 milliseconds)
</script>

</body>
</html>
