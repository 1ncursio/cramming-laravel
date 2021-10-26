<template>
    <!-- component -->
    <!-- post card -->
    <app-layout title="Add new post">
        <form @submit.prevent="form.post('/posts')">
            <input type="file" @change="onUploadImage" />
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
import { defineComponent, ref } from "@vue/runtime-core";
import axios from "axios";
export default defineComponent({
    components: {
        AppLayout,
        Link,
    },
    setup() {
        // const image = ref(null);
        const form = useForm({
            title: null,
            content: null,
            image: null,
        });

        async function onUploadImage(e) {
            const formData = new FormData();
            formData.append("image", e.target.files[0]);
            try {
                const { data } = await axios.post("/posts/image", formData);
                form.image = data;
                console.log({ form });
            } catch (error) {
                console.error(error);
            }
        }

        return { form, onUploadImage };
    },
});
</script>
<style lang=""></style>
