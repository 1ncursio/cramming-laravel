<template>
    <!-- component -->
    <!-- post card -->
    <app-layout title="Add new post">
        <form @submit.prevent="form.patch(`/posts/${post.id}`)">
            <input type="text" v-model="form.title" placeholder="title" />
            <textarea
                v-model="form.content"
                cols="30"
                rows="10"
                placeholder="content"
            />
            <button type="submit" :disabled="form.processing">Submit</button>
        </form>
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { defineComponent } from "@vue/runtime-core";
export default defineComponent({
    components: {
        AppLayout,
        Link,
    },
    props: ["post"],
    setup(props) {
        const form = useForm({
            title: props.post.title,
            content: props.post.content,
        });

        return { form };
    },
});
</script>
<style lang=""></style>
