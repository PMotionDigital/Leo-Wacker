<template>
    <div class="popup-item">
        <div class="popup-item_image">
            <img :src="object.thumbnail" alt="">
        </div>
        <div class="popup-item_content">
          
            <div class="popup-item_title">
                <h3>{{object.name}}</h3>
            </div>
           
            <div class="popup-item_price">
                <span class="price">
                    {{object.price}} €
                </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        object: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
          //
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
</style>