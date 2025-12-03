<x-layout title="PIXL - Profile">
<!-- Navigation -->
    @include('partials.navigation', ['showPostButton' => true])

    <!-- Content -->
    <main class="-mx-4 flex grow flex-col gap-4 overflow-y-auto px-4 py-4">
        <a href="/feed" class="group flex items-baseline gap-1.5">
            <svg
                class="size-3"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 12 12"
                fill="none"
            >
                <path
                    fill="currentColor"
                    d="M6.857 0v1.714H5.143V0zM5.143 1.715v1.714H3.429V1.715zM3.427 3.429v1.714H1.713V3.429zM1.715 5.143v1.714H0V5.143zm1.713 1.715v1.714H1.714V6.858zm1.714 1.714v1.714H3.428V8.572zm1.715 1.713V12H5.143v-1.714z"
                ></path>
                <path
                    fill="currentColor"
                    class="opacity-60 group-hover:opacity-100"
                    d="M12 0v1.714h-1.714V0zm-1.714 1.714v1.714H8.572V1.714zM8.57 3.428v1.714H6.856V3.428zM6.857 5.143v1.714H5.143V5.143zM8.57 6.858v1.714H6.856V6.858zm1.715 1.714v1.714H8.571V8.572zM12 10.286V12h-1.714v-1.714z"
                ></path>
            </svg>
            <span>back</span>
        </a>

        <!-- Profile header -->
        <header>
            <img
                src="/images/laravel-workshop-cover.png"
                alt="Cover image"
                class="w-full"
            />
            <div
                class="-mt-10 flex flex-wrap items-end justify-between gap-4 md:-mt-16"
            >
                <div class="flex items-end gap-4">
                    <img
                        src="/images/adrian.png"
                        alt=""
                        class="size-20 object-cover md:size-32"
                    />
                    <div class="flex flex-col md:gap-1">
                        <p class="text-lg md:text-xl">_adrian</p>
                        <p class="text-pixel-light/60 text-sm">@tudsss</p>
                    </div>
                </div>

                <a
                    href="#"
                    class="bg-pixl-dark/50 border-pixl/50 text-pixl hover:bg-pixl-dark/55 hover:border-pixl/55 active:bg-pixl-dark/75 active:border-pixl/75 border px-2 py-1 text-sm transition"
                >
                    Edit Profile
                </a>
            </div>
            <div class="[&_a]:text-pixl mt-8 [&_a]:hover:underline">
                <p>I design <a href="#">@Laracasts</a> so hit me up whenever =]</p>
            </div>
            <dl class="mt-6 flex gap-6">
                <div class="flex gap-1.5">
                    <dd>100</dd>
                    <dt class="text-pixl-light/60">Following</dt>
                </div>
                <div class="flex gap-1.5">
                    <dd>1.2K</dd>
                    <dt class="text-pixl-light/60">Followers</dt>
                </div>
            </dl>
        </header>

        <!-- navigation/tabs -->
        <div class="mt-6 h-full">
            <nav class="h-full overflow-x-auto [scrollbar-width:none]">
                <ul class="flex min-w-max justify-end gap-8 text-sm">
                    <li>
                        <a href="#">Posts</a>
                    </li>
                    <li>
                        <a href="#" class="text-pixl-light/60 hover:text-pixl-light/80"
                        >Replies</a
                        >
                    </li>
                    <li>
                        <a href="#" class="text-pixl-light/60 hover:text-pixl-light/80"
                        >Highlights</a
                        >
                    </li>
                    <li>
                        <a href="#" class="text-pixl-light/60 hover:text-pixl-light/80"
                        >Inspiration streams</a
                        >
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Posts feed -->
        <ol class="border-pixl-light/10 border-t pt-4">
            <!-- Feed item -->
            @foreach ($feedItems as $item)
                @include('partials.feed-item', compact('item'))
            @endforeach

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
