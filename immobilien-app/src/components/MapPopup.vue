<template>
    <div class="popup-item">


        <Carousel v-if="object.gallery.length && show"
            :perPage="1" 
            :navigationEnabled="true" 
            :paginationActiveColor="'#ffffff'" 
            :paginationColor="'rgba(255,255,255,.4)'"
            :paginationPadding="0"
            :paginationSize="8" >
            <Slide>
                <div class="popup-item_image">
                    <img :src="object.thumbnail" :alt="object.name">
                </div>
            </Slide>
            <Slide v-for="image in object.gallery" :key="object.gallery.indexOf(image)">
                <div class="popup-item_image">
                    <img :src="image" :alt="object.name">
                </div>
            </Slide>
        </Carousel>
        
        <div v-else class="popup-item_image single">
            <img :src="object.thumbnail" :alt="object.name">
        </div>
      
        <div class="popup-item_content">
          
            <div class="popup-item_title">
                <h3><ObjectLink 
                :linkText="object.name" 
                :postId="object.id"
                v-on:set-id="passId" /></h3>
            </div>
           
            <div class="popup-item_price">
                <span class="price">
                   € {{object.price}} 
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import ObjectLink from '@/components/ObjectLink'
import { Carousel, Slide } from 'vue-carousel'
export default {
    props: {
        object: {
            type: Object,
            required: true
        },
        show: {
            type: Boolean,
            required: true
        }
    },
    components: {
        ObjectLink,
        Carousel, 
        Slide
    },
    data() {
        return {
        }
    },
    methods: {
        passId(data){
            this.$emit('pass-id', data);
        }
    },
    mounted() {
    }
}
</script>

<style scoped>
.popup-item {
    width: 18rem;
    position: relative;
    background: #fff;
    overflow: hidden;
    animation: fadein .4s ease-out;
    animation-delay: .4s;
    animation-fill-mode: forwards;
    opacity: 0;
}
.VueCarousel {
    width: 100%;
    height: 10rem;
}
.popup-item_image {
    position: relative;
    width: 100%;
    width: 18rem;
    height: 10rem;
}
.popup-item_image::after {
    content: '';
    display: block;
    padding-top: 57%;
}
.popup-item_image img {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.popup-item_title h3 {
    font-stretch: normal;
    font-weight: 400;
    font-size: 1rem;
}
.popup-item_price {
    padding-top: 1rem;
    font-weight: bold;
}
.popup-item_content {
    padding: 1rem;
}

@keyframes fadein {
    0% {
        opacity: 0;
        transform: translateY(1rem);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>