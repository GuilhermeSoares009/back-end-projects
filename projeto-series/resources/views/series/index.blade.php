<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">

    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2" >Adicionar</a>

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('seasons.index', $serie->id) }}">
                    {{ $serie->nome }}
                </a>

                <form action="{{ route('series.edit', $serie->id)  }}" method="get">
                    @csrf
                    <button class="btn btn-danger btn-sm">
                        ✍
                    </button>
                </form>

                <form action="{{ route('series.destroy', $serie->id)  }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        X
                    </button>
                </form>


            </li>
        @endforeach
    </ul>
</x-layout>
