<form method="post" action="{{ isset($document) ? route('document.update', $document->id) : route('document.save') }}"
    class="row g-3">
    @csrf
    {{-- @if (isset($document))
        @method('PUT')
    @endif --}}
    <div class="col-md-6">
        <label for="inputTitre" class="form-label">Titre</label>
        <input type="text" value="{{ isset($document) ? $document->titre : "" }}" class="form-control" name="titre"
            id="inputTitre">
    </div>
    <div class="col-md-6">
        <label for="inputPublieLe" class="form-label">Publié le</label>
        <input type="date" value="{{ isset($document) ? $document->publie_le : '' }}" class="form-control"
            name="publie_le" id="inputPublieLe">
    </div>
    <div class="col-md-6">
        <label for="inputPubliePar" class="form-label">Publié par</label>
        <input type="text" value="{{ isset($document) ? $document->publie_par : '' }}" class="form-control"
            name="publie_par" id="inputPubliePar">
    </div>
    <div class="col-md-6">
        <label for="inputExtension" class="form-label">Extension</label>
        <select id="inputExtension" name="extension" class="form-select">
            <option value="pdf" {{ isset($document) && $document->extension == 'pdf' ? 'selected' : '' }}>PDF
            </option>
            <option value="doc" {{ isset($document) && $document->extension == 'doc' ? 'selected' : '' }}>DOC
            </option>
            <option value="xlxs" {{ isset($document) && $document->extension == 'xlxs' ? 'selected' : '' }}>XLXS
            </option>
            <option value="png" {{ isset($document) && $document->extension == 'png' ? 'selected' : '' }}>PNG
            </option>
            <option value="jpg" {{ isset($document) && $document->extension == 'jpg' ? 'selected' : '' }}>JPG
            </option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="inputTypeDocument" class="form-label">Type de Document</label>
        <input type="text" value="{{ isset($document) ? $document->type_document : '' }}" class="form-control"
            name="type_document" id="inputTypeDocument">
    </div>
    <div class="col-md-6">
        <label for="inputEtat" class="form-label">État</label>
        <select id="inputEtat" name="etat" class="form-select">
            <option value="1" {{ isset($document) && $document->etat == true ? 'selected' : '' }}>Publié</option>
            <option value="0" {{ isset($document) && $document->etat == false ? 'selected' : '' }}>Non publié
            </option>
        </select>
    </div>
    <div class="col-md-12">
        <label for="inputDescription" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="inputDescription" rows="3">{{ isset($document) ? $document->description : '' }}</textarea>
    </div>
    <div class="col-md-6">
        <label for="inputNombreVue" class="form-label">Nombre de Vues</label>
        <input type="number" value="{{ isset($document) ? $document->nombre_vue : 0 }}" class="form-control"
            name="nombre_vue" id="inputNombreVue">
    </div>
    <div class="col-6">

        <div class="col-md-12">
            <label for="inputFile" class="form-label">Fichier</label>
            <input type="file" class="form-control" name="fichier" id="inputFile">
        </div>

    </div>
    <div class="col-6">
        <button type="submit" class="btn btn-primary">{{ isset($document) ? 'Mise à jour' : 'Enregistrer' }}</button>
    </div>
    <div class="col-6">
        <button type="reset" class="btn btn-warning">Annuler</button>
    </div>
</form>
