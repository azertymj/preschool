<?php

// namespace App\Http\Controllers;

// use App\Models\Document;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

// class DocumentController extends Controller
// {
//     public function index()
//     {
//         $documents = Document::all();
//         return view('document.index', compact('documents'));
//     }

//     public function edit($id)
//     {
//         $document = Document::find($id);
//         $documents = Document::all();
//         return view('document.index', compact('documents', 'document'));
//     }

//     public function delete($id)
//     {
//         $document = Document::find($id);
//         if (!$document) {
//             return redirect()->route('document.index')->with('error', 'Document non trouvé!');
//         }

//         if ($document->fichier) {
//             Storage::delete($document->fichier);
//         }

//         $document->delete();

//         return redirect()->route('document.index')->with('message', 'Document supprimé avec succès!');
//     }

//     public function update(Request $request, $id)
//     {
//         $document = Document::find($id);

//         $data = [
//             'titre' => $request->input('titre'),
//             'publie_le' => $request->input('publie_le'),
//             'publie_par' => $request->input('publie_par'),
//             'extension' => $request->input('extension'),
//             'type_document' => $request->input('type_document'),
//             'etat' => $request->input('etat'),
//             'description' => $request->input('description'),
//             'nombre_vue' => $request->input('nombre_vue', 0),
//         ];

//         if ($request->hasFile('fichier')) {
//             if ($document->fichier) {
//                 Storage::delete($document->fichier);
//             }
//             $data['fichier'] = $request->file('fichier')->store('documents');
//         }

//         $document->update($data);

//         return redirect()->route('document.index')->with('message', 'Mise à jour effectuée!');
//     }

//     public function save(Request $request)
//     {
//         $data = [
//             'titre' => $request->input('titre'),
//             'publie_le' => $request->input('publie_le'),
//             'publie_par' => $request->input('publie_par'),
//             'extension' => $request->input('extension'),
//             'type_document' => $request->input('type_document'),
//             'etat' => $request->input('etat'),
//             'description' => $request->input('description'),
//             'nombre_vue' => $request->input('nombre_vue', 0),
//         ];

//         if ($request->hasFile('fichier')) {
//             $data['fichier'] = $request->file('fichier')->store('documents');
//         }

//         Document::create($data);

//         return redirect()->back()->with('message', 'Ajout effectué!');
//     }
// }
namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('document.index', compact('documents'));
    }

    public function edit($id)
    {
        $document = Document::find($id);
        $documents = Document::all();
        return view('document.index', compact('documents', 'document'));
    }

    public function delete($id)
    {
        $document = Document::find($id);
        if (!$document) {
            return redirect()->route('document.index')->with('error', 'Document non trouvé!');
        }

        if ($document->fichier) {
            Storage::delete($document->fichier);
        }

        $document->delete();

        return redirect()->route('document.index')->with('message', 'Document supprimé avec succès!');
    }

    public function update(Request $request, $id)
    {
        $document = Document::find($id);

        $data = [
            'titre' => $request->input('titre'),
            'publie_le' => $request->input('publie_le'),
            'publie_par' => $request->input('publie_par'),
            'extension' => $request->input('extension'),
            'type_document' => $request->input('type_document'),
            'etat' => $request->input('etat'),
            'description' => $request->input('description'),
            'nombre_vue' => $request->input('nombre_vue', 0),
        ];

        if ($request->hasFile('fichier')) {
            if ($document->fichier) {
                Storage::delete($document->fichier);
            }
            $data['fichier'] = $request->file('fichier')->store('documents', 'public');
        }

        $document->update($data);

        return redirect()->route('document.index')->with('message', 'Mise à jour effectuée!');
    }

    public function save(Request $request)
    {
        $data = [
            'titre' => $request->input('titre'),
            'publie_le' => $request->input('publie_le'),
            'publie_par' => $request->input('publie_par'),
            'extension' => $request->input('extension'),
            'type_document' => $request->input('type_document'),
            'etat' => $request->input('etat'),
            'description' => $request->input('description'),
            'nombre_vue' => $request->input('nombre_vue', 0),
        ];

        if ($request->hasFile('fichier')) {
            $data['fichier'] = $request->file('fichier')->store('documents', 'public');
        }

        Document::create($data);

        return redirect()->back()->with('message', 'Ajout effectué!');
    }
}
