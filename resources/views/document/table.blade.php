<table id="example" class="display table table-striped align-middle" style="width:100%">
    <thead>
        <tr>
            <th class="align-middle">Id</th>
            <th class="align-middle">Titre</th>
            <th class="align-middle">Publié le</th>
            <th class="align-middle">Publié par</th>
            <th class="align-middle">Extension</th>
            <th class="align-middle">Type de Document</th>
            <th class="align-middle">État</th>
            <th class="align-middle">Description</th>
            <th class="align-middle">Nombre de Vues</th>
            <th class="align-middle">Fichier</th>
            <th class="align-middle">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($documents ?? [] as $document)
        <tr>
            <td class="align-middle">{{ $document->id }}</td>
            <td class="align-middle">{{ $document->titre }}</td>
            <td class="align-middle">{{ $document->publie_le }}</td>
            <td class="align-middle">{{ $document->publie_par }}</td>
            <td class="align-middle">{{ $document->extension }}</td>
            <td class="align-middle">{{ $document->type_document }}</td>
            <td class="align-middle">{{ $document->etat ? 'Publié' : 'Non publié' }}</td>
            <td class="align-middle">{{ $document->description }}</td>
            <td class="align-middle">{{ $document->nombre_vue }}</td>
            <td>
                <div class="col-md-6">
                    <label for="inputFichier" class="form-label">Fichier</label>
                    <input type="file" class="form-control" name="fichier" id="inputFichier">
                    @if(isset($document) && $document->fichier)
                        <a href="{{ Storage::url($document->fichier) }}" target="_blank">Voir le fichier actuel</a>
                    @endif
                </div>
            </td>
            <td class="align-middle">
                <a class="btn btn-sm btn-warning" href="{{ route('document.edit', ['id' => $document->id]) }}"> Edit </a>
                <a data-id="{{ $document->id }}" class="btn btn-sm btn-delete btn-danger" href="#">Delete</a>
            </td>

        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th class="align-middle">Id</th>
            <th class="align-middle">Titre</th>
            <th class="align-middle">Publié le</th>
            <th class="align-middle">Publié par</th>
            <th class="align-middle">Extension</th>
            <th class="align-middle">Type de Document</th>
            <th class="align-middle">État</th>
            <th class="align-middle">Description</th>
            <th class="align-middle">Nombre de Vues</th>
            <th class="align-middle">Actions</th>
        </tr>
    </tfoot>
</table>
