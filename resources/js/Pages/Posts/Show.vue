<template>
    <Layout>
        <!-- Content -->
        <main class="-mx-4 flex grow flex-col gap-4 overflow-y-auto px-4 py-4">
            <div class="">
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

            <!-- Posts feed -->
            <ol class="mt-4">
                <Post :post="post" :show-replies="true" show-engagements/>
            </ol>

            <!-- Footer -->
            <footer class="mt-30 pl-14 text-center">
                <p>That's all, folks!</p>
                <hr class="border-pixl-light/10 my-4" />
                <div class="h-20 bg-[url(/resources/images/white-noise.gif)]"></div>
            </footer>
        </main>

    </Layout>
</template>
<script setup>
import Layout from "../Layouts/layout.vue";
import Post from "../Components/Post.vue";
defineProps({
    post: Object,
})
</script>
