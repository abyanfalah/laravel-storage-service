<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FileController extends Controller
{

    /** ==============================================
        PROJECT IEU TEU MAKE CSRF, jadi TEU AMAN.
        Mun rek nga hurungken CSRF deui,
        edit dina file VerifyCsrfToken.php.
        Hapus "*" na.
        ===============================================
     */

    public function storeImage(Request $request)
    {
        $namaFile = $request->nama_file;
        $namaFolder = $request->nama_folder;
        $file = $request->file("file_yang_dikirim");
        $formatFile = $file->getClientOriginalExtension();

        // ngaran file na di simpen di db? kari nyimpen 👍🏽

        $pathFileTersimpan = $file->storeAs(
            $namaFolder,
            $namaFile . "." . $formatFile
        );

        return response($pathFileTersimpan);
    }

    public function getImage(string $folder, string $namaFile)
    {
        $headers = [
            'Content-Type' => 'image/png',
        ];

        $lokasiFile = "app/" . $folder . "/" . $namaFile;
        $path = storage_path($lokasiFile);

        return response()->file($path, $headers);
    }
}
