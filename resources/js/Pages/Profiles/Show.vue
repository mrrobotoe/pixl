<template>
    <Layout>
        <main class="-mx-4 flex grow flex-col gap-4 overflow-y-auto px-4 py-4">
            <a :href="route('posts.index')" class="group flex items-baseline gap-1.5">
                <BackIcon />
                <span>back</span>
            </a>

            <!-- Profile header -->
            <ProfileHeader :profile="profile" />

            <!-- Posts feed -->
            <ol class="border-pixl-light/10 border-t pt-4">
                <!-- Feed item -->
                <Post v-for="item in posts" :post="item" :show-engagements="true" />

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
<script setup lang="ts">
import Layout from "../Layouts/layout.vue";
import Post from "../Components/Post.vue";
import ProfileHeader from "../Components/ProfileHeader.vue";
import BackIcon from "../Components/Icons/BackIcon.vue";

defineProps({
    profile: Object,
    posts: Array
})
</script>
