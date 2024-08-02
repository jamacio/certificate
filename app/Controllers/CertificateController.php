<?php

namespace App\Controllers;

use App\Models\Certificate;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Http\Request;


class CertificateController
{
    public function index()
    {
        $certificates = Certificate::where('id_user', $_SESSION['id'])->get();

        return view('certificates.index', compact('certificates'));
    }

    public function store(Request $request)
    {

        die('dfdsfdsf');
        // // Criação de um novo certificado
        // $certificate = new Certificate();
        // $certificate->id_user = $_SESSION['id'];
        // $certificate->title = $validated['title'];
        // $certificate->description = $validated['description'];
        // // Adicione outros campos conforme necessário
        // $certificate->save();

        // // Redireciona para a lista de certificados com uma mensagem de sucesso
        // return redirect()->route('certificates.index')->with('success', 'Certificado criado com sucesso.');
    }

    public function remove($id)
    {
        // Encontre o certificado pelo ID
        $certificate = Certificate::where('id', $id)
            ->where('id_user', $_SESSION['id'])
            ->first();

        // Verifique se o certificado existe e pertence ao usuário atual
        if ($certificate) {
            // Exclua o certificado
            $certificate->delete();

            // Redireciona para a lista de certificados com uma mensagem de sucesso
            return redirect()->route('certificates.index')->with('success', 'Certificado removido com sucesso.');
        } else {
            // Caso o certificado não exista ou não pertença ao usuário, redirecione com um erro
            return redirect()->route('certificates.index')->with('error', 'Certificado não encontrado ou você não tem permissão para removê-lo.');
        }
    }
}
