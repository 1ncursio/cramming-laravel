<template>
    <app-layout title="Posts">
        <pagination class="mt-6" :links="posts.links" />
        <div class="flex justify-center mt-2">
            <Link
                :href="route('posts.create')"
                class="
                    bg-indigo-500
                    hover:bg-indigo-600
                    text-white
                    font-bold
                    py-2
                    px-4
                    rounded
                    md:mx-auto
                "
            >
                Add new post
            </Link>
        </div>

        <div v-for="(post, i) in posts.data" :key="i">
            <post-card :post="post" />
        </div>
        <pagination class="mt-6" :links="posts.links" />
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PostCard from "./PostCard.vue";
import Pagination from "./Pagination.vue";
import { defineComponent } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        AppLayout,
        PostCard,
        Link,
        Pagination,
    },
    props: ["posts"],
    setup(props) {
        console.log(props.posts);
    },
});
</script>
<style lang=""></style>
