<template>
    <div class="popup-item">
        <div class="popup-item_image">
            <img :src="object.thumbnail" alt="">
        </div>
        <div class="popup-item_content">
          
            <div class="popup-item_title">
                <h3><ObjectLink :linkText="object.name" :postId="object.id" /></h3>
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
export default {
    props: {
        object: {
            type: Object,
            required: true
        }
    },
    components: {
        ObjectLink
    },
    data() {
        return {
          //
        }
    },
    mounted() {
        //
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
.popup-item_image {
    position: relative;
    width: 100%;
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