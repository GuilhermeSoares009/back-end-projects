<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    @auth
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2" >Adicionar</a>
    @endauth
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                @auth<a href="{{ route('seasons.index', $serie->id) }}">@endauth
                    {{ $serie->nome }}
                @auth</a>@endauth

                @auth
                    <span class="d-flex">
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
                    </span>
                @endauth


            </li>
        @endforeach
    </ul>
</x-layout>
