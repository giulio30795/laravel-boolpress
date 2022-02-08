<template>
    <div class="container">
        <h1 class="my-5">Our Posts</h1>
        <article class="mb-2" v-for="post in posts" :key="`post${post.id}`">
            <h2>{{ post.title }}</h2>
            <p>{{ post.body }}</p>
        </article>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "App",

    created() {
        this.getPost();
    },

    data() {
        return {
            posts: null,
        };
    },
    methods: {
        getPost() {
            axios("http://127.0.0.1:8000/api/posts").then((res) => {
                this.posts = res.data;
            });
        },
    },
};
</script>

<style scoped lang="scss"></style>
