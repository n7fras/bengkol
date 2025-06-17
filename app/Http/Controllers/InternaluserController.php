<?php

namespace App\Http\Controllers;
use App\Mail\InternalUserMail;
use Illuminate\Support\Facades\Mail;
use App\Models\InternalUser;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;

class InternalUserController extends Controller
{
    public function index()
    {

        $users = InternalUser::orderBy('id', 'asc')->get();
        $judul='List User internal';

        return view('backend.V_Userinternal.userinternal', [
            'users' => $users,
            'judul'=>$judul
        ]);
       
    }
    public function create()    
    {
        return view('backend.V_Userinternal.create',
        
        [
            'judul' => 'Add Internal User',
        ]);

    }
   public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'username' => 'required|string|max:255|unique:internalusers,username',
        'email' => 'required|email|unique:internalusers,email',
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
        'role' => 'required|in:Super Admin,Admin Input,Supervisor',
        'status' => 'required|boolean',
        'password' => 'required|string|min:6',
        'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
    ], $messages = [
        'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
        'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
    ]);

    // Membuat instance InternalUser baru
    $user = new InternalUser();
    
    // Menyimpan data user
    $user->username = $request->username;
    $user->email = $request->email;
    $user->name = $request->name;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->role = $request->role;
    $user->status = $request->status;
    $passwordasli=$request->password;
    $user->password = bcrypt($request->password); // Menyimpan password yang telah di-enkripsi

    // Upload foto jika ada
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
    
        // Tentukan path untuk menyimpan file di public/storage/img-user
        $destinationPath = public_path('storage/img-user');
    
        // Pastikan direktori ada
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
    
        // Pindahkan file ke direktori yang diinginkan
        $file->move($destinationPath, $originalFileName);
    
        // Simpan nama file di database
        $user->foto = $originalFileName;
    }
    

    // Simpan data user ke database
    $user->save();
 Mail::to($user['email'])->send(new InternalUserMail($user, $passwordasli));
    // Redirect dengan pesan sukses
    return redirect()->route('internal_user.index')->with('success', 'User Add Successfully!');
}

      //fungcion delete
public function destroy($id)
{
    $user = InternalUser::findOrFail($id);
    $user->delete();

    return redirect()->route('internal_user.index')->with('success', 'User deleted successfully');
}
public function deactivate($id)
    {
        $user = InternalUser::findOrFail($id);
        $user->status = 0; // 0 untuk nonaktif
        $user->save();

        return redirect()->back()->with('success', 'User berhasil dinonaktifkan.');
    }

    public function reactivate($id)
    {
        $user = InternalUser::findOrFail($id);
        $user->status = 1; // 1 untuk aktif
        $user->save();

        return redirect()->back()->with('success', 'User berhasil diaktifkan kembali.');
    }
        
    public function edit($id)
    {
        $user = InternalUser::findOrFail($id);
        $judul = 'Edit User'; // Menetapkan variabel $judul
    
        return view('backend.V_Userinternal.edit', [
            'edit' => $user,
            'judul' => $judul, // Menggunakan kunci yang benar
        ]);
    }
    
            
    
    public function update(Request $request, $id)
    {
        // Cari user berdasarkan ID, jika tidak ditemukan maka akan gagal dengan error 404
        $user = InternalUser::findOrFail($id);
    
        // Validasi input
        $rules=[
            'username' => 'required|string|max:255|unique:internalusers,username,' . $id,
            'email' => 'required|email|unique:internalusers,email,' . $id,
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:Super Admin,Admin Input,Supervisor',
            'status' => 'required|boolean',
            
            'foto' => 'nullable|image|max:2048',
        ];
        $messages=[
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ];
    
        // Update data user
        $user->username = $request->username;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->status = $request->status;
       // Menyimpan password yang telah di-enkripsi
      
    
        // Jika ada file foto yang diunggah, simpan file tersebut
        if ($request->file('foto')) {
            //hapus gambar lama
            if ($user->foto) {
                $oldImagePath = public_path('storage/img-user/') . $user->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
                $file = $request->file('foto');
                $extension = $file->getClientOriginalExtension();
                $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            
                // Tentukan path untuk menyimpan file di public/storage/img-user
                $destinationPath = public_path('storage/img-user');
            
                // Pastikan direktori ada
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
            
                // Pindahkan file ke direktori yang diinginkan
                $file->move($destinationPath, $originalFileName);
            
                // Simpan nama file di database
                $user->foto = $originalFileName;
            
        }

    
        // Simpan perubahan ke database
        $user->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('internal_user.index')->with('success', 'User updated successfully!');
    }
    public function changePasswordForm()
{
    $judul = 'Change Password';
    return view('backend.V_Userinternal.change-password', compact('judul'));
}

public function updatePassword(Request $request)
{
    // Validasi input
    $request->validate([
        'old_password' => 'required',
        'password' => 'required|string|min:6|confirmed', // Password harus dikonfirmasi
    ], [
        'old_password.required' => 'Password lama wajib diisi.',
        'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        'password.min' => 'Password baru harus memiliki minimal 6 karakter.',
        'password.required' => 'Password baru wajib diisi.',
    ]);

    // Ambil user yang sedang login
    $user = auth()->user();

    // Verifikasi password lama
    if (!\Hash::check($request->old_password, $user->password)) {
        return back()->withErrors(['old_password' => 'Password lama tidak sesuai.']);
    }

    // Update password
    $user->password = bcrypt($request->password);
    $user->save();

    // Redirect dengan pesan sukses
    return redirect()->route('internal_user.index')->with('success', 'Password berhasil diperbarui.');
}

    
}



