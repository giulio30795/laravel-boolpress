<template>
    <div class="container">
        <h1 class="mb-3">{{ post.title }}</h1>
        <h4> {{post.category.name}} </h4>

        <span class="badge badge-primary mr-1" v-for="tag in post.tags" :key="`tag-${tag.id}`">
            {{tag.name}}
        </span>
        <p>{{ post.body }}</p>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'PostDetail',

    data() {
        return {
            post: '',
        }
    },
    created(){
        this.getPostDetail()
    },

    methods: {
        getPostDetail() {
            axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
            .then ( res => {
                this.post = res.data;
            })
        }
    }
};

</script>

<style scoped lag="scss">

</style>