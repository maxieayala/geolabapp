<ul>
    @foreach ($children as $child)
        <li data-id="{{ $child->id }}">
            {{ $child->nombre }}
            @if ($child->children->count() > 0)
                @include('opciones.catalogo.treeview.children', ['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>