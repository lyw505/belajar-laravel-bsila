# Tugas
* Skenario kali ini membuat backend jadi lebih terstruktur
* Dengan cara membagi beban controller ke pada fungsi yang sesungguhnya
* Pertama, request digunakan untuk memvalidasi dan mengelola input dari user (HTTP Request) sebelum diproses lebih lanjut.
* Kedua, service digunakan untuk menyimpan logika bisnis dari system
* Ketiga, repository digunakan untuk mengelola akses dengan database, seperti mengambil data atau menyimpan data
* Jadi alur ketika sebuah function di controller berjalan, dari **request → service → repository**
* Sebagai contoh skenario dapat diterapkan ketika akan menambah siswa

---

## Langkah-langkah

* Langkah untuk membuat class request untuk menambahkan siswa

  ```bash
  php artisan make:request StoreSiswaRequest
  ```

* Memodifikasi request tersebut pada bagian

  ```php
  public function authorize(): bool 
  { 
      return false; 
  }  
  ```

  menjadi

  ```php
  public function authorize(): bool 
  { 
      return true; 
  }  
  ```

* Memodifikasi request tersebut pada bagian

  ```php
  public function rules(): array 
  { 
      return [ 
          // 
      ]; 
  } 
  ```

  menjadi

  ```php
  public function rules(): array 
  { 
      return [ 
          'nama' => 'required|string|max:100', 
          'tb' => 'required|numeric|min:30|max:250', 
          'bb' => 'required|numeric|min:10|max:200', 
      ]; 
  } 
  ```

---

* Buat directory baru dengan nama **Repositories** di dalam folder **app**

* Buat file baru di dalam directory **Repositories** dengan nama **SiswaRepository.php** dan isi dengan kode berikut:

  ```php
  <?php 

  namespace App\Repositories; 

  use App\Models\Siswa; 

  class SiswaRepository 
  { 
      
  } 
  ```

* Tambahkan function berikut di dalam `SiswaRepository.php`:

  ```php
  public function create(array $data) 
  { 
      $admin = \App\Models\Admin::create([ 
          'username' => $data['nama'], 
          'password' => bcrypt($data['nama']),  
          'role'     => 'siswa', 
      ]); 

      $siswa = \App\Models\Siswa::create([ 
          'id' => $admin->id,  
          'nama'     => $data['nama'], 
          'tb'       => $data['tb'], 
          'bb'       => $data['bb'], 
      ]); 

      return $siswa; 
  } 
  ```

---

* Buat directory baru dengan nama **Services** di dalam folder **app**

* Buat file baru di dalam directory **Services** dengan nama **SiswaService.php** dan isi dengan kode berikut:

  ```php
  <?php 

  namespace App\Services; 

  use App\Repositories\SiswaRepository; 

  class SiswaService 
  { 
      
  } 
  ```

* Tambahkan function berikut di dalam `SiswaService.php`:

  ```php
  protected $repo; 

  public function __construct(SiswaRepository $repo) 
  { 
      $this->repo = $repo; 
  } 
  ```

* Tambahkan function berikut di dalam `SiswaService.php`:

  ```php
  public function createSiswa(array $data) 
  { 
      return $this->repo->create($data); 
  } 
  ```

---

* Tambahkan function berikut di dalam `SiswaController.php`:

  ```php
  protected $service; 

  public function __construct(SiswaService $service) 
  { 
      $this->service = $service; 
  } 
  ```

* Modifikasi function `store` di dalam controller `SiswaController` menjadi:

  ```php
  public function store(StoreSiswaRequest $request) 
  { 
      $this->service->createSiswa($request->validated()); 

      return redirect()->route('home')->with('success', 'Data siswa berhasil ditambahkan!'); 
  } 
  ```

---

## Penjelasan

* User → Route → Controller → Request → Service → Repository → Model (Database)
* User memasukkan field pada form input, lalu me-klik tombol simpan
* Tombol simpan melakukan route **POST** sesuai rute yang tertulis, lalu menjalankan controllernya (`SiswaController::store`)
* Saat di controller,

```php
public function store(StoreSiswaRequest $request)
{
    $this->service->createSiswa($request->validated());
    return redirect()->route('home')->with('success', 'Data siswa berhasil ditambahkan!');
}
```

* Artinya adalah menjalankan request dulu yang ada pada `StoreSiswaRequest`

```php
public function store(StoreSiswaRequest $request)
{
    $this->service->createSiswa($request->validated());
    return redirect()->route('home')->with('success', 'Data siswa berhasil ditambahkan!');
}
```

* Lalu, menjalankan service pada function `createSiswa`

```php
public function createSiswa(array $data)
{
    return $this->repo->create($data);
}
```

* Kemudian, baru menjalankan repository pada function `create`, yang isinya ternyata menyimpan data (berisi sesuai dengan field form yang telah divalidasi oleh class request) melalui model siswa yang terhubung dengan tabel `datasiswa`

---