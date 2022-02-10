<template>
    <div class="container">
        <div v-if="posts">
            <h1 class="my-5">Our Posts</h1>
            <article class="mb-2" v-for="post in posts" :key="`post${post.id}`">
                <h2>{{ post.title }}</h2>
                <p class="mb-2">{{ post.body }}</p>
                <button class="btn btn-primary">
                    <router-link class="text-white" :to="{name: 'post-detail', params:{ slug: post.slug }}">
                        Read More
                    </router-link>
                </button>

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

        <div class=" mt-3" v-else>
            <Loader 
            text ="Loading Post Archive..." />
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Loader from "../components/Loader.vue"

export default {
    name: "Home",

    components:{
        Loader,
    },

    created() {
        this.getPost();
    },

    data() {
        return {
            posts: null,
            pagination: 0,
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
