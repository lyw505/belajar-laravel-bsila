tugas 7

• Skenario kali ini terkait penggunaan middleware

• Sebelumnya middleware telah diterapkan menggunakan logika sederhana dengan seleksi
kondisi atau if

• Sebagai contoh baris

```
if (!session()->has('admin_id')) {
           return redirect()->route('login');
}
```

Baris tersebut digunakan untuk memastikan bahwa terdapat user yang sedang login, jika
belum login maka akan diarahkan ke halaman login

• Cara kerja middleware
User request -> Middleware -> Controller -> Response -> Middleware -> Browser

Bermaksud sebagai penjaga gerbang (gatekeeper) antara user dan controller.
Jadi akan memeriksa request sebelum sampai ke controller, dan bisa juga memodifikasi
response sebelum dikirim ke browser.

Langkah-langkah

• Membuat middleware baru untuk memeriksa login dengan perintah

```
php artisan make:middleware ceklogin
```

• Memidifikasi function handle dari middleware ceklogin dengan memindahkan baris
berikut sebelum baris return

```
if (!session()->has('admin_id')) {
           return redirect()->route('login');
}
```

• Menambahkan baris berikut didalam file app/Http/Kernel.php didalam bagian route
middleware

```
'ceklogin' => \App\Http\Middleware\ceklogin::class,
```

• Jika tidak menemukan file tersebut, maka buat file baru Kernel.php didalam folder
app/Http dan isi dengan kode berikut

```
<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // Middleware global Laravel
        \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        \Illuminate\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     */
    protected $middlewareGroups = [

        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'ceklogin' => \App\Http\Middleware\ceklogin::class, // tambahannya ada disini
    ];
}
```

• Memodifikasi route home menjadi

before:

```
Route::get('/home', [siswaController::class, 'home'])->name('home');
```

after:

```
Route::get('/home', [siswaController::class, 'home'])->name('home')->middleware('ceklogin');
```

• Contoh baris kode jika lebih dari 1 route yang membutuhkan middleware ceklogin

```
Route::middleware(['ceklogin'])->group(function () {

    Route::get('/home', [siswaController::class, 'home'])->name('home'); //contoh route 1
    Route::get('/home2', [siswaController2::class, 'home2'])->name('home2'); //contoh route 2
});
```
