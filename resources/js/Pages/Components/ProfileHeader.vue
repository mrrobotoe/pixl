<template>
    <!-- Profile header -->
    <header>
        <img
            :src="profile.cover_url"
            alt="Cover image"
            class="w-full"
        />
        <div
            class="-mt-10 flex flex-wrap items-end justify-between gap-4 md:-mt-16"
        >
            <div class="flex items-end gap-4">
                <img
                    :src="profile.avatar_url"
                    alt="`Avatar of ${profile.display_name}``"
                    class="size-20 object-cover md:size-32"
                />
                <div class="flex flex-col md:gap-1">
                    <p class="text-lg md:text-xl">{{ profile.display_name }}</p>
                    <p class="text-pixel-light/60 text-sm">{{ `@${profile.handle}` }}</p>
                </div>
            </div>

            <Link
                v-if="$page.props.auth.user && profile.id !== $page.props.auth.user?.profile.id"
                method="post"
                as="button"
                :href="route(profile.has_followed ? 'profiles.unfollow' : 'profiles.follow', profile)"
                class="bg-pixl-dark/50 border-pixl/50 text-pixl hover:bg-pixl-dark/55 hover:border-pixl/55 active:bg-pixl-dark/75 active:border-pixl/75 border px-2 py-1 text-sm transition"
            >
                {{ profile.has_followed ? 'Unfollow' : 'Follow' }}
            </Link>
        </div>
        <div class="[&_a]:text-pixl mt-8 [&_a]:hover:underline">
            <p>{{ profile.bio }}</p>
        </div>
        <dl class="mt-6 flex gap-6">
            <div class="flex gap-1.5">
                <dd>{{ profile.following_count }}</dd>
                <dt class="text-pixl-light/60">Following</dt>
            </div>
            <div class="flex gap-1.5">
                <dd>{{ profile.followers_count }}</dd>
                <dt class="text-pixl-light/60">Followers</dt>
            </div>
        </dl>

    </header>

    <!-- navigation/tabs -->
    <div class="mt-6 h-full">
        <nav class="h-full overflow-x-auto [scrollbar-width:none]">
            <ul class="flex min-w-max justify-end gap-8 text-sm">
                <li>
                    <Link
                        :href="route('profiles.show', profile)"
                        :class="route().current('profiles.show') ? 'text-pixl' : 'text-pixl-light/60 hover:text-pixl-light/80'"
                    >Posts</Link>
                </li>
                <li>
                    <Link
                        :href="route('profiles.replies', profile)"
                        :class="route().current('profiles.replies') ? 'text-pixl' : 'text-pixl-light/60 hover:text-pixl-light/80'"
                    >Replies</Link
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
</template>
<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    profile: Object,
})
</script>
