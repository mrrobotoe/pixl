<template>
    <div class="flex items-center gap-1">
        <button
            aria-label="comment"
            :class="'text-pixl-light'"
        >
            <ReplyIcon />
        </button>
        <span class="text-sm">{{ post.replies_count }}</span>
    </div>

</template>
<script setup lang="ts">
import ReplyIcon from "./Icons/ReplyIcon.vue";

defineProps<{
    post: {
        id: number;
        replies_count: number;
    };
}>();
</script>
