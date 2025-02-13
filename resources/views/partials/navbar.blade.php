<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a class="navbar-brand fw-bolder" href="#" style="font-family: Poppins, Montserrat, sans-serif;"> 
            <i class="bi bi-stars text-warning"></i>
            Todo List App
        </a>

        <div class="d-flex align-items-center gap-2">
            <!-- Profil & Nama -->
            <div class="d-flex align-items-center">
                <img src="{{asset('img/img-3.JPG')}}" alt="Profil Kurniawan" class="rounded-circle" width="35" height="35">
                <span class="ms-2 fw-bold text-white" style="font-family: Poppins, Montserrat, sans-serif;">
                    Kurniawan
                </span>
            </div>

            <!-- Tombol Tema -->
            <button id="theme-switch">
                <i class="bi bi-moon-fill"></i>           
                <i class="bi bi-sun-fill text-white"></i>
            </button>
        </div>
    </div>
</nav>
