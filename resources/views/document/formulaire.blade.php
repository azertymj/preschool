<form method="post" action="{{ isset($document) ? route('document.update', $document->id) : route('document.save') }}"class="row g-3" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <a href="{{ route('list')}}" class="btn btn-primary">Liste <i class="fas fa-table"></i></a>
        <div class="col-12">
            <h5 class="form-title"><span>Ajouter un Nouveau Document</span></h5>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label>Titre <span class="login-danger">*</span></label>
                <input type="text" value="{{ isset($document) ? $document->titre : "" }}" class="form-control" name="titre" id="inputTitre">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label>Publier Le <span class="login-danger">*</span></label>
                <input type="date" value="{{ isset($document) ? $document->publie_le : '' }}" class="form-control" name="publie_le" id="inputPublieLe">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label>Publier Par <span class="login-danger">*</span></label>
                <input type="text" value="{{ isset($document) ? $document->publie_par : '' }}" class="form-control" name="publie_par" id="inputPubliePar">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label>Extension <span class="login-danger">*</span></label>
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
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label>Type Document <span class="login-danger">*</span></label>
                <input type="text" value="{{ isset($document) ? $document->type_document : '' }}" class="form-control" name="type_document" id="inputTypeDocument">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label>Etat <span class="login-danger">*</span></label>
                <select id="inputEtat" name="etat" class="form-select">
                    <option value="1" {{ isset($document) && $document->etat == true ? 'selected' : '' }}>Publié</option>
                    <option value="0" {{ isset($document) && $document->etat == false ? 'selected' : '' }}>Non publié
                    </option>
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label>Description <span class="login-danger"></span></label>
                <textarea class="form-control" name="description" id="inputDescription" rows="3">{{ isset($document) ? $document->description : '' }}</textarea>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label>Nombre de Vues <span class="login-danger"></span></label>
                <input type="number" value="{{ isset($document) ? $document->nombre_vue : 0 }}" class="form-control" name="nombre_vue" id="inputNombreVue">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label>Fichier <span class="login-danger"></span></label>
                <input type="file" class="form-control" name="fichier" id="inputFile">
            </div>
        </div>
        <div class="col-12">
            <div class="student-submit">
                <button type="submit" class="btn btn-primary">{{ isset($document) ? 'Mise à jour' : 'Enregistrer' }}</button>
            </div>
        </div>
    </div>
</form>
