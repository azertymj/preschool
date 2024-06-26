<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function index()
    {   notify()->success('Laravel Notify is awesome!');
        $documents = Document::all();
        return view('teacher.list', compact('documents'));
    }

    public function edit($id)
    {
        $document = Document::find($id);
        $documents = Document::all();
        return view('/document.index', compact('documents', 'document'))->with('edit', 'Modification  effectuée!');
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

        return redirect()->route('document.index')->with('delete', 'Document supprimé avec succès!');
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

        return redirect()->route('document.index')->with('maj', 'Mise à jour effectuée!');
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

        return redirect()->back()->with('save', 'Ajout effectué!');
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);
        $filePath = storage_path('public/documents/' . $document->fichier);
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
            'fichier' => $file_name, // Enregistrez le file_path d'accès au fichier
        ]);

        $document->save();

        return redirect()->route('document.index')->with('message', 'Document ajouté avec succès.');
    }

    public function search(Request $request)
    {
        $query = Document::query();

        // Filtrer par ID
        if ($request->filled('search_id')) {
            $query->where('id', $request->input('search_id'));
        }

        // Filtrer par Titre
        if ($request->filled('search_titre')) {
            $query->where('titre', 'like', '%' . $request->input('search_titre') . '%');
        }

        // Filtrer par Extension
        if ($request->filled('search_extension')) {
            $query->where('extension', 'like', '%' . $request->input('search_extension') . '%');
        }

        // Obtenir les résultats filtrés
        $documents = $query->get();

        return view('teacher.list', compact('documents'));
    }

    public function downloadCsv()
    {
        $documents = Document::all();
        $csvContent = "ID,Titre,Publier Le,Publier Par,Extension,Type Document,Etat,Description,Nombre de Vues,Fichier\n";

        foreach ($documents as $document) {
            $csvContent .= "{$document->id},{$document->titre},{$document->publie_le},{$document->publie_par},{$document->extension},{$document->type_document},{$document->etat},{$document->description},{$document->nombre_vue},{$document->fichier}\n";
        }

        $fileName = 'documents_' . date('Y-m-d_H-i-s') . '.csv';
        return response($csvContent)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return redirect()->route('document.index')->with('error', 'No documents selected for deletion.');
        }

        $documents = Document::whereIn('id', $ids)->get();

        DB::transaction(function () use ($documents) {
            foreach ($documents as $document) {
                if ($document->fichier) {
                    Storage::delete($document->fichier);
                }
                $document->delete();
            }
        });

        return redirect()->route('document.index')->with('message', 'Documents deleted successfully!');
    }
}
