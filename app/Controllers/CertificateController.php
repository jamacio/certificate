<?php

namespace App\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController
{
    public function index()
    {
        $idUser = session('id');
        if ($idUser) {
            $certificates = Certificate::where('id_user', $idUser)->get();

            return view('certificates.index', compact('certificates'));
        }

        return redirect('/');
    }

    public function store($data)
    {
        $certificate = new Certificate();
        $certificate->id_user = session('id');
        $certificate->image = $data;
        $certificate->save();
    }

    public function remove(Request $request)
    {
        $content = $request->getContent();
        $requestContent = json_decode($content, true);
        if (isset($requestContent['remove-file'])) {
            $id = $requestContent['remove-file'];
        }

        parse_str($content, $requestParam);

        $id = $requestParam['remove-file'] ?? '';
        $idUser = session('id');
        $certificate = Certificate::where('id', $id)
            ->where('id_user', $idUser)
            ->first();

        if ($certificate) {
            $certificate->delete();
        }

        return redirect('/certificates');
    }
}
