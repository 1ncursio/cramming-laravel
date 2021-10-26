<template>
    <!-- component -->
    <!-- post card -->
    <app-layout :title="`${post.title} -  ${post.user} 님의 글`">
        <div
            class="
                flex
                bg-white
                shadow-lg
                rounded-lg
                mx-4
                md:mx-auto
                my-8
                max-w-md
                md:max-w-2xl
            "
        >
            <!--horizantil margin is just for display-->
            <div class="flex items-start px-4 py-6">
                <img
                    class="w-12 h-12 rounded-full object-cover mr-4 shadow"
                    :src="post.user.profile_photo_url"
                    alt="avatar"
                />
                <div class="">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900 -mt-1">
                            {{ post.user.name }}
                        </h2>
                        <small class="text-sm text-gray-700">{{
                            relativeCreatedAt
                        }}</small>
                    </div>
                    <p class="text-gray-700">{{ post.title }}</p>
                    <!-- <p class="mt-3" v-for="(image, i) in post.images" :key="i">
                        <img :src="`/storage/images/${image.url}`" alt="" />
                    </p> -->
                    <p class="mt-3" v-if="post.images.length > 0">
                        <img
                            :src="`/storage/images/${post.images[0].url}`"
                            alt=""
                        />
                    </p>
                    <p class="mt-3 text-gray-700 text-sm">
                        {{ post.content }}
                    </p>
                    <div class="mt-4 flex items-center">
                        <div class="flex mr-2 text-gray-700 text-sm mr-3">
                            <svg
                                fill="none"
                                viewBox="0 0 24 24"
                                class="w-4 h-4 mr-1"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                            <span>12</span>
                        </div>
                        <div class="flex mr-2 text-gray-700 text-sm mr-8">
                            <svg
                                fill="none"
                                viewBox="0 0 24 24"
                                class="w-4 h-4 mr-1"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"
                                />
                            </svg>
                            <span>8</span>
                        </div>
                        <div
                            class="flex text-gray-700 text-sm gap-2"
                            v-if="post.user_id === $page.props.user.id"
                        >
                            <Link :href="route('posts.edit', post)">
                                update
                            </Link>
                            <button @click="onDelete">delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import { computed, defineComponent } from "@vue/runtime-core";
import axios from "axios";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
import "dayjs/locale/ko";

dayjs.extend(relativeTime);
dayjs.locale("ko");

export default defineComponent({
    components: {
        AppLayout,
        Link,
    },
    props: ["post"],
    setup(props) {
        console.log({ post: props.post });
        const relativeCreatedAt = computed(() =>
            dayjs(props.post.created_at).fromNow()
        );

        async function onDelete() {
            if (!confirm("정말 삭제하시겠습니까?")) return;
            try {
                await axios.delete(`/posts/${props.post.id}`);
                Inertia.get("/posts");
            } catch (error) {
                alert("에러 발생");
                console.error(error);
            }
        }

        return { onDelete, relativeCreatedAt };
    },
});
</script>
<style lang=""></style>
