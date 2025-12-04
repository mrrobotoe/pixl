<template>
    <Transition
        enter-active-class="transition duration-300 transform ease-out"
        enter-from-class="translate-x-full opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition duration-200 transform ease-out"
        leave-from-class="opacity-100"
        leave-to-class="translate-x-full opacity-0"
    >
        <div
            v-if="flashMessage"
            v-text="flashMessage"
            class="fixed bottom-4 right-4 bg-pixl text-pixl-dark text-sm rounded-lg py-2 px-3"
        ></div>
    </Transition>
</template>
<script setup>
import { ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";

let flashMessage = ref("");

function flash(message) {
    flashMessage.value = message;

    setTimeout(() => {
        flashMessage.value = "";
    }, 3000);
}

watch(() => usePage().props.flash.success, flash);
</script>
