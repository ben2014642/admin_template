<span>
    @foreach ($danhmuc as $item)

        @if ($loop->last)
            <x-link :href="route('admin.blog.danhmuc.edit', $item['id'])" :title="$item['name']" />
        @else
            <x-link :href="route('admin.blog.danhmuc.edit', $item['id'])" :title="$item['name']" />,&nbsp;
        @endif
    @endforeach
</span>
