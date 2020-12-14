<template>
    <div class="slider-wrap">
        <Carousel :perPage="1"
        :paginationEnabled="false" 
        :navigateTo="currentSlide"
        @page-change="changeSlider" >
            <Slide 
                v-for="object in objects"
                v-bind:key="object.id"
                :data-id="object.id" >
                <ObjectItem 
                    v-bind:slider="false"
                    v-bind:object="object"
                    v-on:pass-id="passId"
                    v-bind:translations="translations"
                    v-bind:locale="locale"
                    v-bind:active="activeId == object.id"/>
            </Slide>
        </Carousel>
        
    </div>
</template>
<script>
import ObjectItem from '@/components/ObjectItem'
import { Carousel, Slide } from 'vue-carousel'
export default {
    data () {
        return {
            currentSlide: 1
        }
    },
    props: {
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
        activeId: {
            type: Number,
            required: true
        }
    },
    components: {
        Carousel,
        Slide,
        ObjectItem
    },
    watch: {
        activeId: function(val) {
            let resp = 1;
            if( this.activeId ) {
                const child = document.querySelector(`[data-id="${val}"]`); 
                const parent = child.parentNode; 
                resp = Array.prototype.indexOf.call(parent.children, child);
            }
            console.log(resp, document.querySelector(`[data-id="${val}"]`));
            this.currentSlide = resp;
        }
    },
    computed: {
    
    },
    methods: {
        changeSlider (data) {
            const id = document.querySelectorAll(`[data-id]`)[data].dataset.id;
            const obj = this.objects.find((el) => {
                return el.id == id;
            });
            this.$emit('slider-change', obj);
        },
        passId(data){
            this.$emit('pass-id', data);
        }
    }
}
</script>
    
<style scoped>
.VueCarousel {
    width: 94%;
    margin: 0 auto;
}
.VueCarousel-slide {
    padding: 0 .32rem;
}

.slider-wrap {
    position: absolute;
    pointer-events: all;
    width: 100vw;
    bottom: 4rem;
    left: 0;
}
.object-item {
    width: 100%;
    min-width: 100%;
    display: block;
    background: #fff;
    border-radius: 1rem;
    display: flex;
    flex-wrap: nowrap;
    padding: 0;
    overflow: hidden;
    box-shadow: 0px .25rem .88rem rgba(0, 0, 0, 0.25);
    
}
.object-item_image {
    width: 33.33%;
}
.object-item_content {
    width: 66.66%;
}
.object-item_location {
    display: none;
}
.object-item::after,
.object-item::before  {
    display: none;
}
</style>