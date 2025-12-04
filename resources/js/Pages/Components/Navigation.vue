<template>
    <header
        class="my-4 hidden w-48 shrink-0 flex-col justify-between gap-8 pl-4 sm:flex xl:ml-40"
    >
        <div class="overflow-y-auto">
            <a href="/">
                <LogoIcon />
            </a>
            <!-- Navigation items -->
            <nav class="mt-10">
                <ul class="flex flex-col gap-3.5">
                    <!-- TODO -->
                    <li>
                        <a :href="route('posts.index')" class="hover:underline" :class="{'text-pixl' : $page.component === 'Posts/Index'  }">Home</a
                        >
                    </li>
                    <li><a class="hover:underline" href="#">Explore</a></li>
                    <!-- Active item -->
                    <li class="-ml-4 flex items-center gap-2">
                        <div class="bg-pixl size-2 shrink-0"></div>
                        <a class="hover:underline" href="#">Notifications</a>
                    </li>

                    <li><a class="hover:underline" href="#">Lists</a></li>
                    <li><a class="hover:underline" href="#">Bookmarks</a></li>
                    <li><a class="hover:underline" href="#">Jobs</a></li>
                    <li><a class="hover:underline" href="#">Communities</a></li>
                    <li><a class="hover:underline" href="#">Premium</a></li>
                    <li><a class="hover:underline" href="#">Profile</a></li>
                    <li><a class="hover:underline" href="#">More</a></li>
                </ul>
            </nav>
        </div>

        <div class="flex flex-col gap-6">
            <!-- TODO: This should only show if we are NOT on posts.index route. -->
            <Link
                v-show="$page.component !== 'Posts/Index'"
                :href="route('posts.index')"
                class="bg-pixl text-pixl-dark hover:bg-pixl/90 active:bg-pixl/95 border border-transparent px-4 py-3 text-sm text-center transition"
                type="submit"
            >
                Post
            </Link>

            <!-- User controls -->
            <div class="flex gap-3.5">
                <a :href="route('profiles.show', $page.props.auth.user.profile)" class="shrink-0">
                    <img
                        :src="$page.props.auth.user.profile.avatar_url"
                        alt="User avatar"
                        class="size-11 object-cover"
                    />
                </a>
                <div class="flex flex-col gap-1">
                    <p class="text-sm">{{ $page.props.auth.user.profile.display_name }}</p>
                    <p class="text-pixel-light/60 text-sm">
                        {{ $page.props.auth.user.profile.handle }}
                    </p>
                </div>
                <button
                    class="group flex gap-[3px] py-2"
                    aria-label="Post options"
                >
                    <span
                        class="bg-pixl-light/40 group-hover:bg-pixl-light/60 size-1"
                    ></span>
                    <span
                        class="bg-pixl-light/40 group-hover:bg-pixl-light/60 size-1"
                    ></span>
                    <span
                        class="bg-pixl-light/40 group-hover:bg-pixl-light/60 size-1"
                    ></span>
                </button>
            </div>
        </div>
    </header>
</template>
<script setup lang="ts">
import LogoIcon from "./Icons/LogoIcon.vue";
import { Link } from "@inertiajs/vue3";
</script>
