<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOBAS</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('image/Logofix.png')}}">
</head>
<body>
    @if (session()->has('error'))
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ session('error') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endif  

    <nav class="container_login">
        <div>
            <h1> MOBENG <br> Administrator</h1>
        </div>
        <div>
            <form action="{{ route('authLogin') }}" method="POST" class="kotaklogin">
                @csrf
                <label for="uname">Username</label><br>
                <input type="text" placeholder="Enter Your Email" id="uname" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror"> 
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <br>

                <label for="pass">Password</label>
                <input type="password" placeholder="Enter Your Password" value="{{ old('password') }}" id="pass" name="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    @if (session()->has('error'))
    <script>
        // Memunculkan modal error saat terdapat session error
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
    </script>
    @endif
</body>
</html>
