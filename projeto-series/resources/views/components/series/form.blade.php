<form action="{{ $action }}" method="post">
    @csrf

    @if($update)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input
            type="text"
            name="nome"
            id="nome"
            class="form-control"
            @isset($nome) value="{{$nome}}"@endisset>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="cover" class="form-label">Capa</label>
                    <input type="file" 
                           id="cover" 
                           name="cover" 
                           class="form-control" 
                           accept="image/gif,image/jpeg, image/png">
                </div>
            </div>
    </div>

    <button type="submit" class="btn btn-primary"> Salvar </button>
</form>
