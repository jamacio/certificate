<?php

namespace App\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;


class CertificateController
{
    public function index()
    {
        $certificates = Certificate::where('id_user', $_SESSION['id'])->get();

        return view('certificates.index', compact('certificates'));
    }

    public function store($data)
    {
        $certificate = new Certificate();
        $certificate->id_user = $_SESSION['id'];
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

        $certificate = Certificate::where('id', $id)
            ->where('id_user', $_SESSION['id'])
            ->first();

        if ($certificate) {
            $certificate->delete();
        }

        $this->index();
    }
}
