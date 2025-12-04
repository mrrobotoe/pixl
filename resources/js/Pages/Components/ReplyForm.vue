<template>
    <div
        class="bg-pixl-light/[3%] border-pixl-light/10 mt-8 flex items-start gap-4 border-t p-4"
    >
        <a :href="route('profiles.show', profile)" class="shrink-0">
            <img
                :src="profile.avatar_url"
                :alt="`Avatar of ${profile.display_name}`"
                class="size-10 object-cover"
            />
        </a>

        <Form
            class="grow"
            method="POST"
            :action="route('posts.reply', [post.profile, post])"
            reset-on-success
            #default="{ errors }"
            @success="emit('success')"
        >
            <label for="content" class="sr-only">Reply body</label>
            <textarea
                class="w-full resize-none text-lg"
                name="content"
                id="content"
                :placeholder="`Reply to ${profile.display_name}'s post`"
                rows="5"
            ></textarea>
            <div v-if="errors.content" v-text="errors.content" class="text-red-400 mb-2 text-sm"></div>

            <div class="flex justify-between">
                <div class="flex gap-5">
                    <button type="button">
                        <ImageIcon />
                    </button>
                    <button type="button">
                        <VideIcon />
                    </button>
                </div>
                <button
                    class="bg-pixl text-pixl-dark hover:bg-pixl/90 active:bg-pixl/95 border border-transparent px-4 py-1.5 text-sm transition"
                    type="submit"
                >
                    Post
                </button>
            </div>
        </Form>
    </div>
</template>

<script setup lang="ts">
import { Form } from "@inertiajs/vue3";
import ImageIcon from "./Icons/ImageIcon.vue";
import VideIcon from "./Icons/VideIcon.vue";

defineProps<{
    profile: {
        avatar_url: string
        display_name: string
    }
    post: {
        id: number;
        profile: {
            handle: string;
        };
    };
}>();

let emit = defineEmits(["success"]);
</script>
