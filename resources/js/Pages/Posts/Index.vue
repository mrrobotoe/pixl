<template>
    <Layout>
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
            <PostForm :profile="profile" />

            <!-- Posts feed -->
            <ol class="mt-4">
                <!-- Feed item -->
                <Post v-for="item in posts" :key="item.id" :post="item" :show-engagements="true" />
                <!-- More feed items -->
            </ol>

            <!-- Footer -->
            <footer class="mt-30 pl-14 text-center">
                <p>That's all, folks!</p>
                <hr class="border-pixl-light/10 my-4" />
                <div class="h-20 bg-[url(/images/white-noise.gif)]"></div>
            </footer>
        </main>
    </Layout>
</template>
<script setup>
import Layout from "../Layouts/layout.vue";
import PostForm from "../Components/PostForm.vue";
import Post from "../Components/Post.vue";
defineProps({
    profile: {
        avatar_url: String,
        display_name: String,
        handle: String,
    },
    posts: Array,
})
</script>
