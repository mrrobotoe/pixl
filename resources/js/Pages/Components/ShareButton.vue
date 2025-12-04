<template>
    <div class="flex items-center gap-1">
        <button aria-label="share" class="hover:text-pixl/80">
            <ShareIcon />
        </button>
    </div>
</template>
<script setup lang="ts">
import ShareIcon from "./Icons/ShareIcon.vue";

interface Props {
    id: number;
}

defineProps<Props>();
</script>
