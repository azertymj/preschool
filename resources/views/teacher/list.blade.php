@extends('layouts.main')
{{-- @extends('layouts.header')
@extends('layouts.sidebar-menu') --}}

@section('content')
<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Teachers</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Teachers</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by ID ...">
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by Name ...">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by Phone ...">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="search-student-btn">
                    <button type="btn" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">

                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Teachers</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="teachers.html" class="btn btn-outline-gray me-2 active"><i
                                        class="feather-list"></i></a>
                                <a href="teachers-grid.html" class="btn btn-outline-gray me-2"><i
                                        class="feather-grid"></i></a>
                                <a href="#" class="btn btn-outline-primary me-2"><i
                                        class="fas fa-download"></i> Download</a>
                                <a href="add-teacher.html" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
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
                                {{-- @dd($documents) --}}
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @extends('layouts.footer') --}}
