<template>
    <div class="object-link" @click="loadPost">{{linkText}}</div>
</template>

<script>
export default {
    props: {
        linkText: {
            type: String,
            required: true
        },
        postId: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
          //
        }
    },
    mounted() {
        //
    },
    methods: {
        async loadPost(){
            console.log('load');
            const response = await fetch(`http://dev.leo-wacker.ru/wp-json/wp/v2/object/${this.postId}`);
            const data = await response.json();
            console.log(data);
            
        }
    }
}
</script>

<style scoped>
    .object-link {
        cursor: pointer;
    }
</style>