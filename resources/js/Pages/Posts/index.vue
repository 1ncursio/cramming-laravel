<template>
    <Layout>
        <div v-for="(post, i) in posts.data" :key="post.id">
            <post-card :post="post" />
        </div>
    </Layout>
</template>
<script>
import Layout from "@/Layouts/AppLayout.vue";
import PostCard from "./PostCard.vue";
import { defineComponent } from "@vue/runtime-core";

export default defineComponent({
    components: {
        Layout,
        PostCard,
    },
    props: ["posts"],
    setup(props) {
        console.log(props.posts);
    },
});
</script>
<style lang=""></style>
