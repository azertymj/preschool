
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Subjects</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Liste de document</a></li>
                        <li class="breadcrumb-item active">Subjects</li>
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
                        <input type="text" class="form-control" placeholder="Search by Class ...">
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
                                    <h3 class="page-title">Subjects</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="#" class="btn btn-outline-primary me-2"><i
                                            class="fas fa-download"></i> Download</a>
                                    <a href="{{ route('document.index')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="example" class="display table table-striped align-middle" style="width:100%" class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>ID</th>
                                        <th>Titre</th>
                                        <th>Publier Le</th>
                                        <th>Publier Par</th>
                                        <th>Extension</th>
                                        <th>Type Document</th>
                                        <th>Etat</th>
                                        <th>Description</th>
                                        <th>Nombre de Vues</th>
                                        <th>Fichier</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($documents as $document)
                                        <tr>
                                            <td>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </td>
                                            <td>{{ $document->id }}</td>
                                            <td>
                                                <h2><a
                                                        href="{{ route('document.index', $document->id) }}">{{ $document->titre }}</a>
                                                </h2>
                                            </td>
                                            <td>{{ $document->publie_le }}</td>
                                            <td>{{ $document->publie_par }}</td>
                                            <td>{{ $document->extension }}</td>
                                            <td>{{ $document->type_document }}</td>
                                            <td>{{ $document->etat }}</td>
                                            <td>{{ $document->description }}</td>
                                            <td>{{ $document->nombre_vue }}</td>
                                            <td>
                                                @if($document->fichier)
                                                <a href="{{ asset('storage/documents/' . $document->fichier) }}"
                                                    class="btn btn-sm bg-success-light me-2" data-toggle="tooltip"
                                                    data-placement="right" title="Voir le fichier">
                                                    <i class="feather-eye"></i>
                                                </a>
                                                    {{-- <a href="{{ asset('storage/' . $document->fichier) }}" download>Download</a>
                                                    <br>
                                                    <img src="{{ asset('storage/' . $document->file_name) }}" alt="Document Image" width="100"> --}}
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    {{-- <a href="{{ route('teacher.view', $document->id) }}"
                                                        class="btn btn-sm bg-success-light me-2">
                                                        <i class="feather-eye"></i>
                                                    </a> --}}
                                                    <form action="{{ route('document.edit', $document->id) }}"
                                                        method="GET" enctype="multipart/form-data">
                                                        @csrf

                                                        <button type="submit" class="btn btn-sm bg-danger-light">
                                                            <i class="feather-edit"><a data-id="{{ $document->id }}"  style="display: none" href="#"></a>
                                                            </i>
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('document.delete', $document->id) }}"method="POST" class="d-inline">

                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm bg-danger-light"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?');">
                                                            <i class="feather-trash-2"><a data-id="{{ $document->id }}" style="display: none" href="#"></a></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>

