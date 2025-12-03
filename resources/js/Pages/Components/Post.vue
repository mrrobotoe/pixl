<template>
    <li class="flex items-start gap-4 not-first:pt-2.5">
    <a :href="route('profiles.show', post.profile)" class="shrink-0">
        <img
            :src="post.profile.avatar_url"
            :alt="`Avatar for ${post.profile.display_name}`"
            class="size-10 object-cover"
        />
    </a>
    <div class="grow pt-1.5">
        <div class="border-pixl-light/10 border-b pb-5">
            <!-- User meta -->
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-2.5">
                    <p>
                        <a class="hover:underline" :href="route('profiles.show', post.profile)">{{ post.profile.display_name }}</a>
                    </p>
                    <p class="text-pixl-light/60 text-xs">
                        <a :href="route('posts.show', [post.profile, post])">{{ post.created_at }}</a>
                    </p>
                    <p class="text-pixl-light/60 text-xs">
                        <a
                            :href="route('profiles.show', post.profile)"
                            class="hover:text-pixl-light/60 hover:underline"
                        >
                            {{ post.profile.handle }}
                        </a>
                    </p>
                </div>
                <button
                    class="group flex gap-[3px] py-2"
                    aria-label="Post options"
                >
                          <span
                              class="bg-pixl-light/40 group-hover:bg-pixl-light/60 size-1"
                          ></span>
                    <span
                        class="bg-pixl-light/40 group-hover:bg-pixl-light/60 size-1"
                    ></span>
                    <span
                        class="bg-pixl-light/40 group-hover:bg-pixl-light/60 size-1"
                    ></span>
                </button>
            </div>
            <!-- Post content -->
            <div
                class="[&_a]:text-pixl mt-4 flex flex-col gap-3 text-sm [&_a]:hover:underline"
            >
                <div v-html="post.content"></div>

                <ul v-if="!!post.repost_of && !!post.content">
                    <Post :post="post.repost_of" :show-engagements="false"/>
                </ul>
            </div>

            <!-- Action buttons -->
            <div v-if="showEngagements" class="mt-6 flex items-center justify-between gap-4">
                <div class="flex items-center gap-8">
                    <LikeButton :active="post.has_liked" :count="post.likes_count" :id="post.id" />
                    <ReplyButton :count="post.replies_count" :id="post.id" />
                    <RepostButton :active="post.has_reposted" :count="post.reposts_count" :id="post.id" />
                </div>
                <div class="flex items-center gap-3">
                    <SaveButton :id="post.id" />
                    <ShareButton :id="post.id" />
                </div>
            </div>

<!--            <x-reply-form :post="$post" />-->
        </div>

        <!-- Threaded replies could go here -->
        <ol v-if="showReplies">
            <Reply v-for="reply in post.replies" :key="post.id" :post="reply" :show-engagements="showEngagements" :show-replies="showReplies" />
        </ol>
    </div>
    </li>
</template>

<script setup lang="ts">
import LikeButton from "./LikeButton.vue";
import ReplyButton from "./ReplyButton.vue";
import RepostButton from "./RepostButton.vue";
import SaveButton from "./SaveButton.vue";
import ShareButton from "./ShareButton.vue";
import Reply from "./Reply.vue";

defineProps<{
    post: {
        id: number;
        content: string;
        created_at: string;
        profile: {
            avatar_url: string;
            display_name: string;
            handle: string;
        };
        likes_count: number;
        replies_count: number;
        reposts_count: number;
        has_liked: boolean;
        has_reposted: boolean;
        repostOf?: any;
        replies?: any[];
    };
    showEngagements?: boolean;
    showReplies?: boolean;
}>();
</script>
