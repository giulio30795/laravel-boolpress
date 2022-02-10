<template>

    <div class="container mt-3">
        <div v-if="post">
            <h1 class="mb-3">{{ post.title }}</h1>
            <h4> {{post.category.name}} </h4>

            <span class="badge badge-primary mr-1" v-for="tag in post.tags" :key="`tag-${tag.id}`">
                {{tag.name}}
            </span>
            <p class="mt-2">{{ post.body }}</p>
        </div>
        <div class="container mt-3" v-else>
            <Loader 
            text ="loading post..." />
        </div>

    </div>

</template>

<script>
import axios from 'axios';
import Loader from '../components/Loader.vue'
export default {
    name: 'PostDetail',
        components:{
            Loader,
        },
    data() {
        return {
            post: null,
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