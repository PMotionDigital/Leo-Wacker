<template>
    <div class="post-container" :class="{opened: opened}" >
        {{this.postData.id}}
        <button @click="opened = !opened">CLOSE XxX</button>
        <div v-html="postHTML"></div>
    </div>
</template>

<script>
export default {
    props: {
        postData: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            postHTML: null,
            opened: false
        }
    },
    methods: {
        async loadPost(){
            console.log('load');
            const response = await fetch(`http://dev.leo-wacker.ru/wp-json/wp/v2/object/${this.postData.id}`);
            const data = await response.json();
            this.postHTML = data.content.rendered;
            this.postData.loading = false;
            this.opened = true;
        }
    },
    computed: {
        isOpen() {
            let opened;
            if(!this.postData.loading && this.opened){
                opened = true
            } else {
                opened = false
            }
            return opened
        }
    },
    watch: {
        postData: function(val, oldVal) {
            // if(val.id != oldVal.id){
            console.log(val.id != oldVal.id);
            this.opened = false;
            this.loadPost();
            
        }
    }
}
</script>
<style scoped>
.post-container {
    position: absolute;
    right: 0;
    top: 0;
    width: 50vw;
    height: 100%;
    transform: translate3d(100%, 0, 0);
    transition: .25s ease-out;
    background-color: #EEF2F6;
}
.post-container.opened {
    transform: translate3d(0,0,0);
    overflow-y: scroll;
    overflow-x: hidden;
}
</style>