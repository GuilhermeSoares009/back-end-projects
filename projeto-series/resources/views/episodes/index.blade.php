<x-layout title="Episódios">
    <form method="post">
        <ul class="list-group">
            @foreach ($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episode->number }}

                    <input type="checkbox" name="episodes[]" value="{{ $episode->id }}">
                </li>
            @endforeach
        </ul>
    </form>
</x-layout>
