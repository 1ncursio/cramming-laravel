<template>
    <app-layout title="Posts">
        <Link :href="route('posts.create')">
            <button
                class="
                    bg-indigo-500
                    hover:bg-indigo-600
                    text-white
                    font-bold
                    py-2
                    px-4
                    rounded
                "
            >
                Add new post
            </button>
        </Link>

        <div v-for="(post, i) in posts.data" :key="i">
            <post-card :post="post" />
        </div>
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PostCard from "./PostCard.vue";
import { defineComponent } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        AppLayout,
        PostCard,
        Link,
    },
    props: ["posts"],
    setup(props) {
        console.log(props.posts);
    },
});
</script>
<style lang=""></style>
