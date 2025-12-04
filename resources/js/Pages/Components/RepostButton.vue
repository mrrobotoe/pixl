<template>
    <Form method="POST" :action="route(post.has_reposted ? 'posts.destroy' : 'posts.repost', [post.profile, post])" class="inline">
        <div class="flex items-center gap-1">
            <button
                aria-label="repost"
                :class="post.has_reposted ? 'text-pixl hover:text-pixl' : 'hover:text-pixl/80'"
            >
                <RepostIcon />
            </button>
            <span class="text-sm">{{ post.reposts_count }}</span>
        </div>
    </Form>
</template>
<script setup lang="ts">
import RepostIcon from "./Icons/RepostIcon.vue";
import { Form } from "@inertiajs/vue3";

interface Props {
    post: {
        id: number;
        reposts_count: number;
        profile: {
            handle: string;
        }
        has_reposted: boolean;
    };
}

const { post } = defineProps<Props>();
</script>
