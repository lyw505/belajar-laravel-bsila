• Skenario kali ini terkait penggunaan Ajax

• AJAX adalah teknik untuk berkomunikasi antara browser dan server tanpa memuat ulang
halaman web.

• AJAX biasanya menggunakan JavaScript (atau jQuery) untuk mengirim data ke server,
dan server mengembalikan response JSON.

• Alur Kerja AJAX:
o Pengguna melakukan aksi (klik tombol / isi form).
o JavaScript mengirimkan permintaan ke server (request).
o Server (Laravel) memproses data dan mengembalikan response JSON.
o JavaScript menerima response dan menampilkan hasil di halaman tanpa reload.

• Sebelumnya data dari tabel siswa ditampilkan dengan cara load dari controller

• Tujuan kali ini, menampilkan data dari tabel siswa tanpa reload halaman (melalui Ajax)

Langkah-langkah

• Langkah untuk menampilkan data dari tabel siswa melalui Ajax

• Memodifikasi controller berikut dengan mengubahnya

```
public function home(){
           $siswa = siswa::all();
           return view('home');
}
```

Menjadi

```
public function home(){
           return view('home');
}

public function getData()
{
          $siswa = Siswa::all();
           return response()->json($siswa);

}
```

• Memodifikasi view berikut dengan menghapus baris berikut

```
@foreach($siswa as $i => $s)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->tb }}</td>
                <td>{{ $s->bb }}</td>
                @if (session('admin_role') === 'admin')
                <td>
                    <a href="{{ route('siswa.edit', $s->idsiswa) }}">Edit</a> |
                    <a href="{{ route('siswa.delete', $s->idsiswa) }}" onclick="return 
confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
                @endif
            </tr>
@endforeach
```

Menjadi

```
<script>
$(document).ready(function(){
    function renderTable(data) {
        let rows = '';
        if (data.length === 0) {

            rows = '<tr><td colspan="5">Tidak ada data ditemukan</td></tr>';
        } else {
            data.forEach((s, index) => {
                rows += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${s.nama}</td>
                        <td>${s.tb}</td>
                        <td>${s.bb}</td>
                        @if (session('admin_role') === 'admin')
                        <td>
                            <a href="/siswa/edit/${s.idsiswa}">Edit</a> |
                            <a href="/siswa/delete/${s.idsiswa}" onclick="return confirm('Yakin 
ingin menghapus?')">Hapus</a>
                        </td>
                        @endif
                    </tr>
                `;
            });
        }
        $('#tabel-siswa tbody').html(rows);
    }
    function loadSiswa() {

        $.ajax({
            url: "{{ route('siswa.data') }}",
            method: "GET",
            success: function(response) {
                renderTable(response);
            },
            error: function() {
                alert('Gagal memuat data siswa.');
            }
        });
    }
    loadSiswa();
</script>
```

• Menambahkan id="tabel-siswa" didalam tag tabel yang menampilkan data siswa

• Menambahkan baris berikut didalam tag head

```
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
```

• Langkah untuk menambahkan fitur pencarian diatas tabel siswa, dan data yang dicari auto
muncul tanpa reload

• Menambahkan baris berikut diatas tabel data siswa

```
<p><label>Cari Siswa: </label><input type="text" id="search" placeholder="Ketik 
nama..."></p>
```

• Menambahkan function berikut didalam controller siswa

```
public function search(Request $request)
    {
        $keyword = strtolower($request->input('q'));
        $siswa = Siswa::whereRaw('LOWER(nama) LIKE ?', ["%{$keyword}%"])
                    ->get();
        return response()->json($siswa);
    }
```

• Menambahkan script berikut didalam tag script di bawah loadsiswa

```
function searchSiswa(keyword) {
        $.ajax({
            url: "{{ route('siswa.search') }}",
            method: "GET",
            data: { q: keyword },
            success: function(response) {
                renderTable(response);
            },
            error: function() {
                console.error('Gagal mencari data siswa.');
            }
        });
    }

  $('#search').on('keyup', function() {
        const keyword = $(this).val().trim();
        if (keyword.length > 0) {
            searchSiswa(keyword);

        } else {
            loadSiswa();
        }
    });
```