<template>
    <Form method="POST" :action="route(post.has_liked ? 'posts.unlike' : 'posts.like', [post.profile, post])">
        <div class="flex items-center gap-1">
            <button
                aria-label="like"
                :class="post.has_liked ? 'hover:text-pixl text-pixl' : 'hover:text-pixl'"
                data-test="like-post-button"
            >
                <HeartIcon />
            </button>
            <span
                :class="post.has_liked ? 'hover:text-pixl text-pixl' : 'hover:text-pixl'"
                class="text-sm"
                data-test="like-post-count"
            >
                {{ post.likes_count }}
            </span>
        </div>
    </Form>

</template>

<script setup lang="ts">
import HeartIcon from "./Icons/HeartIcon.vue";
import { Form } from "@inertiajs/vue3";

interface Props {
    post: {
        id: number;
        has_liked: boolean;
        profile: {
            handle: string;
        };
        likes_count: number;
    };
}
const { post } = defineProps<Props>();
</script>
