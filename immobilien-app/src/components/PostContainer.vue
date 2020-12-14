<template>
    <div class="post-container" :class="{opened: opened, mobile: mobile}" >
       
        
        <div class="post-container_controlls">
            <button @click="opened = !opened" area-label="close" class="close">
                <img :src="`${url}/wp-content/themes/leo-wacker/dist/img/icons/maps.svg`">
            </button>
            <div class="button type-2 green" 
            data-send-object
            :data-title="currentPost.name"
            :data-id="currentPost.id"
            :data-link="currentPost.link"
            >{{translations.send[locale]}}</div>
        </div>
       
        <div class="post-container_content">
            <div class="post-container_header">
                <div class="post-container_header-title">
                    <p class="location">{{translations.berlin[locale]}} - {{currentPost.area}}, {{`${currentPost.type_name}`}}</p>
                    <h1>{{currentPost.name}}</h1>
                </div>
                <div class="post-container_header-price">
                    € {{currentPost.price}}
                </div>
            </div>
            <Carousel v-if="currentPost.gallery_large.length"
            :perPage="1" 
            :navigationEnabled="true" 
            :paginationActiveColor="'#ffffff'" 
            :paginationColor="'rgba(255,255,255,.4)'"
            :paginationPadding="0"
            :paginationSize="8" >
                <Slide>
                    <div class="object-item_image">
                        <img :src="currentPost.thumbnail_large" :alt="currentPost.name">
                    </div>
                </Slide>
                <Slide v-for="image in currentPost.gallery_large" :key="image">
                    <div class="object-item_image">
                        <img :src="image" :alt="currentPost.name">
                    </div>
                </Slide>
            </Carousel>
            <div v-else class="object-item_image">
                <img :src="currentPost.thumbnail_large" :alt="currentPost.name">
            </div>
            <div class="post-container_info">
                <div class="living-space">
                    {{currentPost.living_space}} m2
                </div>
                <div class="rooms">
                    {{currentPost.room}} {{declOfNum(currentPost.room, translations.zimmers[locale])}}
                </div>
            </div>
             <div v-html="postHTML"></div>
        </div>
    </div>
</template>

<script>
import { Carousel, Slide } from 'vue-carousel'
export default {
    props: {
        postData: {
            type: Object,
            required: true
        },
        url: {
            type: String,
            required: true
        },
        objects: {
            type: Array,
            required: true
        },
        locale: {
            type: String,
            required: true
        },
        translations: {
            type: Object,
            required: true
        },
        mobile: {
            type: Boolean,
            required: true
        }
    },
    components: {
        Carousel, 
        Slide
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
            const mapWrap = document.querySelector('.mapboxgl-canvas-container');
            mapWrap.classList.add('loading');
            //this.opened = true;
            // const response = await fetch(`${this.url}/wp-json/wp/v2/object/${this.postData.id}`);
            const response = await fetch(`${this.url}/wp-json/objects-list/v1/contents/${this.postData.id}`);
            const data = await response.json();
            this.postHTML = JSON.parse(data).html;
            this.postData.loading = false;
            this.opened = true;
            mapWrap.classList.remove('loading');
        },
        declOfNum(number, titles) {
            const cases = [2, 0, 1, 1, 1, 2];
            return titles[(number % 100 > 4 && number % 100 < 20) ? 2 : cases[(number % 10 < 5) ? number % 10 : 5]];
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
        },
        currentPost () {
            return this.objects.find((obj) => {
                return obj.id == this.postData.id
            })
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
    padding: 1rem;
    overflow-y: scroll;
}
.post-container.mobile {
    position: fixed;
    left: 0;
    top: 2rem;
    width: 100%;
    height: calc(100% - 2rem);
    z-index: 9999;
}
.post-container.opened {
    transform: translate3d(0,0,0);
    overflow-y: scroll;
    overflow-x: hidden;
}
.post-container_header {
    display: flex;
    padding-bottom: 1.5rem;
}
.post-container_header-title {
    width: 80%;
}
.post-container_header-price {
    width: 20%;
    font-size: 2rem;
    font-weight: bold;
    text-align: right;
    padding-top: 1.6rem;
}
.post-container_header-title > *{
    font-size: 2.18rem;
    font-family: 'Cormorant Garamond';
}
.post-container_header-title .location {
    color: #767676;
    text-transform: uppercase;
    font-size: 1.25rem;
}
.post-container_info {
    display: flex;
    justify-content: flex-end;
    font-size: 1.88rem;
    font-family: 'Cormorant Garamond';
    padding: 1rem 0;
    position: relative; 
}
.post-container_info::after {
    content: '';
    position:absolute;
    left: -1rem;
    top: 100%;
    width: calc(100% + 2.2rem);
    height: 1px;
    background-color: #E0E0E0;
}
.post-container_info .rooms {
    padding-left: 2rem;
}
.VueCarousel {
    width: 100%;
}
.close {
    width: 3.3rem;
    height: 2.68rem;
    cursor: pointer;
    -webkit-appearance: none;
    border: none;
    outline: none;
    background-color: transparent;
    position: relative;
}
.close img {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
}
/* .close::after,
.close::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    height: 2px;
    background: #000;
}
.close::after {
    transform: rotate(45deg);
}
.close::before {
    transform: rotate(-45deg);
} */
.post-container_controlls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 2rem;
}
</style>