<div id="wpwrap">
    <div class="dashboard-leads bg-light rounded-3 shadow my-3 p-4">
        <h4>Leads do Google</h4>
        @if ($leads)
            <form method="POST">
                <div class="table-responsive">
                    <table class="table table-striped bg-white table-leads mt-4 responsive-table">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>gclid</th>
                                <th>Data</th>
                                <th>Horário</th>
                                <th>DDD</th>
                                <th>IP</th>
                                <th>Cidade</th>
                                <th>UF</th>
                                <th class="text-center">
                                    Ações
                                </th>
                            </tr>
                        </thead>

                        @foreach($leads as $lead)
                            <tr>
                                <td>
                                    <input type="checkbox" class="check-export" name="lead[]" value="{{ $lead->id }}">
                                </td>
                                <td>{{ $lead->gclid }}</td>
                                <td>{{ date('d/m/Y', strtotime($lead->time)) }}</td>
                                <td>{{ date('H:i', strtotime($lead->time)) }}h</td>
                                <td>{{ $lead->code_area }}</td>
                                <td>{{ $lead->ip }}</td>
                                <td>{{ $lead->city }}</td>
                                <td>{{ $lead->state }}</td>
                                <td class="text-center">
                                    <a class="text-danger" href="./?delete-lead={{$lead->id}}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="py-2"></div>
                <button disabled type="submit" id="btn-export" class="btn btn-primary me-2">Exportar</button>
                <button disabled type="button" id="btn-delete" class="btn btn-danger">Excluir</button>
            </form>
        @else
            <div class="alert alert-warning">Sem leads capturados!</div>
        @endif

        <hr class="d-block">

        <h4 class="my-4">Exportações</h4>

        @php
            $d = array_diff(
                scandir(GOOGLE_OFF_PLUGIN_PATH . '/storage/export'),
                ['.', '..']
            );
        @endphp

        @if (!empty($d))
            @foreach($d as $file)
                <div class="export p-3 border shadow rounded-2 my-2 bg-white d-flex justify-content-between align-items-center">
                    <a class="text-dark text-decoration-none" target="_self" download href="{{ GOOGLE_OFF_PLUGIN_URI . '/storage/export/'. $file }}"><i class="fas fa-file-download"></i> {{ $file }}</a>
                    <a class="text-danger" href="./?delete-export={{$file}}"><i class="fas fa-trash-alt"></i></a>
                </div>
            @endforeach
        @else
            <div class="alert alert-info">Nenhuma exportação foi realizada!</div>
        @endif
    </div>
</div>