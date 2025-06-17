<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body
  class="h-screen flex items-center justify-center"
  style="background-image: url('{{ asset('image/bgrncst.png') }}'); background-size: cover; background-position: center;"
>
  <div class="bg-white bg-opacity-70 rounded-2xl p-8 w-full max-w-md shadow-xl">
    <h2 class="text-2xl font-bold text-center mb-6">Welcome Back</h2>

    @if(session('error'))
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
        {{ session('error') }}
      </div>
    @endif

    <form class="space-y-4" method="POST" action="{{ route('customer.auth') }}">
      @csrf

      <div>
        <label class="block font-semibold">Email</label>
        <input
          type="email"
          name="email"
          placeholder="Masukan Email Anda"
          class="w-full mt-1 p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
          required
        />
      </div>

      <div>
        <label class="block font-semibold">Password</label>
        <div class="relative">
          <input
            type="password"
            name="password"
            placeholder="Masukan Kata Sandi"
            class="w-full mt-1 p-3 pr-10 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
            required
          />
          <svg
            class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12h.01M9 12h.01M6.55 7.11a8.001 8.001 0 0110.9 0M12 19c-4.418 0-8-3.582-8-8a8 8 0 0116 0c0 4.418-3.582 8-8 8z"/>
          </svg>
        </div>
        <div class="text-right mt-1">
          <a href="#" class="text-sm text-blue-600 font-medium hover:underline">Forgot Password?</a>
        </div>
      </div>

      <button
        type="submit"
        class="w-full py-3 bg-gradient-to-r from-orange-400 to-red-500 text-white font-semibold rounded-md hover:opacity-90 transition"
      >
        Log in
      </button>

      <a
        href="{{ route('google.redirect') }}"
        class="w-full py-3 border text-gray-700 rounded-md flex justify-center items-center gap-2 hover:bg-gray-100"
      >
        <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="w-5 h-5" />
        Sign in with Google
      </a>

      <p class="text-center text-sm mt-4">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">Daftar Sekarang</a>
      </p>
    </form>
  </div>
</body>
</html>
