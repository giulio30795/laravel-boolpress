<template>
    <div>
        <Header />

    <rotuer-view></rotuer-view>

    </div>
    
</template>

<script>
import Header from '../components/Header.vue'
import Home from '../pages/Home.vue'
export default {
    name: 'App',
    components: {
        Header,
    }
}
</script>
<style>

</style>