<div class="border-pixl-light/20 mt-10 border p-4">
    <h2 class="text-pixl-light/60 text-sm">Artists to Follow</h2>
    <ol class="mt-4 flex flex-col gap-4">
        @foreach ($profiles as $profile)
        <li class="flex items-center justify-between gap-2">
            <div class="flex items-center gap-2.5">
                <img
                    src="{{ $profile->avatar_url }}"
                    alt="Avatar of {{ $profile->display_name }}"
                    class="size-8 object-cover"
                />
                <p class="truncate text-sm">{{ $profile->handle }}</p>
            </div>
            <button
                class="bg-pixl-dark/50 border-pixl/50 text-pixl hover:bg-pixl-dark/55 hover:border-pixl/55 active:bg-pixl-dark/75 active:border-pixl/75 border px-2 py-1 text-sm transition"
            >
                Follow
            </button>
        @endforeach
    </ol>
    <a href="#" class="text-pixl-light/60 mt-4 inline-block text-sm"
    >Show more</a
    >
</div>
