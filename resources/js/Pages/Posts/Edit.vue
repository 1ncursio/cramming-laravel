<template>
    <!-- component -->
    <!-- post card -->
    <app-layout title="Add new post">
        <div class="heading text-center font-bold text-2xl m-5 text-gray-800">
            New Post
        </div>
        <form
            class="
                editor
                mx-auto
                w-10/12
                flex flex-col
                text-gray-800
                border border-gray-300
                p-4
                shadow-lg
                max-w-2xl
            "
            @submit.prevent="form.patch(`/posts/${post.id}`)"
        >
            <input ref="file" type="file" @change="onUploadImage" hidden />
            <input
                class="
                    title
                    bg-gray-100
                    border border-gray-300
                    p-2
                    mb-4
                    outline-none
                "
                v-model="form.title"
                spellcheck="false"
                placeholder="Title"
                type="text"
            />
            <textarea
                class="
                    description
                    bg-gray-100
                    sec
                    p-3
                    h-60
                    border border-gray-300
                    outline-none
                "
                v-model="form.content"
                spellcheck="false"
                placeholder="Describe everything about this post here"
            ></textarea>

            <!-- icons -->
            <div class="icons flex text-gray-500 m-2">
                <svg
                    @click="selectImage"
                    class="
                        mr-2
                        cursor-pointer
                        hover:text-gray-700
                        border
                        rounded-full
                        p-1
                        h-7
                    "
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                    />
                </svg>
                <!-- <div class="count ml-auto text-gray-400 text-xs font-semibold">
                    0/300
                </div> -->
            </div>
            <!-- buttons -->
            <div class="buttons flex justify-end">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="
                        btn
                        border border-indigo-500
                        p-1
                        px-4
                        font-semibold
                        cursor-pointer
                        text-gray-200
                        ml-2
                        bg-indigo-500
                    "
                >
                    Post
                </button>
            </div>
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
