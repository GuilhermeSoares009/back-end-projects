<x-mail::message>

# {{ $nomeSerie }} criada

A série {{ $nomeSerie }} com {{ $qtdTemporadas }} temporadas e {{ $episodiosPorTemporada }} episódios foi criada.

Acesse aqui:

<x-mail::button :url="route('seasons.index', $idSerie)">
Ver Série
</x-mail::button>
</x-mail::message>
