<x-layout title="PIXL - Feed">
    <!-- Navigation -->
    @include('partials.navigation')

    <!-- Content -->
    <main class="-mx-4 flex grow flex-col gap-4 overflow-y-auto px-4 py-4">
        <div class="h-full">
            <nav class="overflow-x-auto [scrollbar-width:none]">
                <ul class="flex min-w-max justify-end gap-8 text-sm">
                    <li>
                        <a href="#">For you</a>
                    </li>
                    <li>
                        <a href="#" class="text-pixl-light/60 hover:text-pixl-light/80"
                        >Idea streams</a
                        >
                    </li>
                    <li>
                        <a href="#" class="text-pixl-light/60 hover:text-pixl-light/80"
                        >Following</a
                        >
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Post prompt -->
        <div
            class="border-pixl-light/10 mt-8 flex items-start gap-4 border-b pb-4"
        >
            <a href="/profile" class="shrink-0">
                <img
                    src="/images/adrian.png"
                    alt="User avatar"
                    class="size-10 object-cover"
                />
            </a>
            @include('partials.post-form', [
                'labelText' => 'Post body',
                'fieldName' => 'post',
                'placeholder' => 'What\'s up _adrian?',
                'rows' => 2
            ])
        </div>

        <!-- Posts feed -->
        <ol class="mt-4">
            <!-- Feed item -->
            @foreach ($feedItems as $item)
                @include('partials.feed-item', compact('item'))
            @endforeach
            <!-- More feed items -->
        </ol>

        <!-- Footer -->
        <footer class="mt-30 pl-14 text-center">
            <p>That's all, folks!</p>
            <hr class="border-pixl-light/10 my-4" />
            <div class="h-20 bg-[url(/images/white-noise.gif)]"></div>
        </footer>
    </main>

    <!-- Sidebar -->
    @include('partials.aside')
</x-layout>
