<template>
    <li class="object-item">
        <div class="object-item_image">
            <img :src="object.thumbnail" alt="">
        </div>
        <div class="object-item_content">
            <div class="object-item_location">
                {{location}}
            </div>
            <div class="object-item_title">
                <h3>{{object.name}}</h3>
            </div>
            <ul class="object-item_props">
                <li class="object-item_props-item">{{livingSpace}}</li>
                <li class="object-item_props-item">{{rooms}}</li>
            </ul>
            <div class="object-item_price">
                <span class="price">
                    {{object.price}} €
                </span>
            </div>
        </div>
    </li>
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
            location: '',
            livingSpace: '',
            rooms: ''
        }
    },
    mounted() {
        this.location = `Berlin - ${this.object.area}, ${this.object.type_name}`;
        this.livingSpace = `${this.object.living_space} m2`;
        this.rooms = `${this.object.room} zimmer`;
    }
}
</script>

<style scoped>
    .object-item {
        width: 100%;
        display: flex;
        padding: 1rem 0;
        border-bottom: 1px solid #e0e0e0;
        cursor: pointer;
    }
    .object-item_image {
        position: relative;
        width: 45%;
    }
    .object-item_image::after {
        content: '';
        display: block;
        padding-top: 57%;

    }
    .object-item_image img {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        object-fit: cover;
    }
    .object-item_content {
        display: flex;
        flex-direction: column;
        width: 55%;
        padding-left: 1.75rem;
    }
    .object-item_props {
        list-style: none;
    }
    .object-item_price {
        flex-grow: 2;
        display: flex;
        align-items: flex-end;
        justify-content: flex-end;
    }
</style>