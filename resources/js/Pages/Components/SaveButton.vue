<template>
    <div class="flex items-center gap-1">
        <button aria-label="save" class="hover:text-pixl/80">
            <SaveIcon />
        </button>
        <span class="text-pixl-light/40 text-sm">Save</span>
    </div>
</template>
<script setup lang="ts">
import SaveIcon from "./Icons/SaveIcon.vue";

interface Props {
    id: number;
}
const { id } = defineProps<Props>();
</script>
