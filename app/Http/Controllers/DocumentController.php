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

    // public function update(Request $request, $id)
    // {
    //     $document = Document::find($id);

    //     $data = [
    //         'titre' => $request->input('titre'),
    //         'publie_le' => $request->input('publie_le'),
    //         'publie_par' => $request->input('publie_par'),
    //         'extension' => $request->input('extension'),
    //         'type_document' => $request->input('type_document'),
    //         'etat' => $request->input('etat'),
    //         'description' => $request->input('description'),
    //         'nombre_vue' => $request->input('nombre_vue', 0),
    //     ];

    //     if ($request->hasFile('fichier')) {
    //         $file = $request->file('fichier');
    //         $filename = $file->getClientOriginalName();
    //         $file->storeAs('public/documents', $filename);
    //         $data['fichier'] = $filename;
    //     }

    //     $document->update($data);

    //     return redirect()->route('document.index')->with('message', 'Mise à jour effectuée!');
    // }

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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'publie_le' => 'required|date',
            'publie_par' => 'required|string|max:255',
            'extension' => 'required|string|max:255',
            'type_document' => 'required|string|max:255',
            'etat' => 'required|boolean',
            'description' => 'nullable|string',
            'nombre_vue' => 'nullable|integer',
            'fichier' => 'nullable|file|mimes:pdf,doc,docx,xlsx,png,jpg|max:10240', // 10 MB limit
        ]);

        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('documents', $fileName, 'public');

            $validatedData['fichier'] = $filePath;
        }

        Document::create($validatedData);

        return redirect()->route('document.index')->with('success', 'Document ajouté avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'publie_le' => 'required|date',
            'publie_par' => 'required|string|max:255',
            'extension' => 'required|string|max:255',
            'type_document' => 'required|string|max:255',
            'etat' => 'required|boolean',
            'description' => 'nullable|string',
            'nombre_vue' => 'nullable|integer',
            'fichier' => 'nullable|file|mimes:pdf,doc,docx,xlsx,png,jpg|max:10240', // 10 MB limit
        ]);

        $document = Document::findOrFail($id);

        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('documents', $fileName, 'public');

            $validatedData['fichier'] = $filePath;

            // Supprimer l'ancien fichier s'il existe
            if ($document->fichier) {
                Storage::disk('public')->delete($document->fichier);
            }
        }

        $document->update($validatedData);

        return redirect()->route('document.index')->with('success', 'Document mis à jour avec succès.');
    }

}
