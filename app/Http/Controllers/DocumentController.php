<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('teacher.list', compact('documents'));
    }

    public function edit($id)
    {
        $document = Document::find($id);
        $documents = Document::all();
        return view("/document.index", compact('documents', 'document'));
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
            $file = $request->file('fichier');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/documents', $filename);
            $data['fichier'] = $filename;
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
            $file = $request->file('fichier');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/documents', $filename);
            $data['fichier'] = $filename;
        }

        Document::create($data);

        return redirect()->back()->with('message', 'Ajout effectué!');
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);
        $filePath = storage_path('public/documents/'. $document->fichier);
        return response()->download($filePath);
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
        'description' => 'required|string',
        'nombre_vue' => 'required|integer',
        'fichier' => 'required|file|mimes:pdf,doc,docx,xlsx,png,jpg|max:10248',
    ]);

    // Enregistrement du fichier
    $file_name = $request->file('fichier')->getClientOriginalName();
    $file_path = $request->file('fichier')->storeAs('public/documents', $file_name);

    $document = new Document([
        'titre' => $request->get('titre'),
        'publie_le' => $request->get('publie_le'),
        'publie_par' => $request->get('publie_par'),
        'extension' => $request->get('extension'),
        'type_document' => $request->get('type_document'),
        'etat' => $request->get('etat'),
        'description' => $request->get('description'),
        'nombre_vue' => $request->get('nombre_vue'),
        'fichier' => $file_path, // Enregistrez le file_path d'accès au fichier

    ]);

    $document->save();

    return redirect()->route('document.index')->with('success', 'Document ajouté avec succès.');
    }


}


