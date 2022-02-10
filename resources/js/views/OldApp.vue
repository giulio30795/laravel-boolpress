<template>
    <div class="container">
        <h1 class="my-5">Our Posts</h1>
        <article class="mb-2" v-for="post in posts" :key="`post${post.id}`">
            <h2>{{ post.title }}</h2>
            <p>{{ post.body }}</p>
        </article>

        <section class="pagination">
            <button
                @click="getPost(pagination.current - 1)"
                :disabled="pagination.current == 1"
                class="btn mr-1 btn-primary"
            >
                Prev
            </button>

            <button
                class="btn mr-2"
                :class="
                    pagination.current === i ? `btn-primary` : `btn-secondary`
                "
                @click="getPost(i)"
                v-for="i in pagination.last"
                :key="`page-${i}`"
            >
                {{ i }}
            </button>

            <button
                @click="getPost(pagination.current + 1)"
                :disabled="pagination.current == pagination.last"
                class="btn btn-primary"
            >
                Next
            </button>
        </section>
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
            pagination: null,
        };
    },
    methods: {
        getPost(page = 1) {
            axios
                .get(`http://127.0.0.1:8000/api/posts?page=${page}`)
                .then((res) => {
                    this.posts = res.data.data;
                    this.pagination = {
                        current: res.data.current_page,
                        last: res.data.last_page,
                    };
                });
        },
    },
};
</script>

<style scoped lang="scss"></style>
