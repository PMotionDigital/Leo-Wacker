<template>
    <li class="object-item" ref="el" :class="{active: active}">
        <div class="object-item_image">
            <img :src="object.thumbnail" :alt="object.name">
        </div>
        <div class="object-item_content">
            <div class="object-item_location">
                {{location}}
            </div>
            <div class="object-item_title">
                <h3><ObjectLink :linkText="object.name" :postId="object.id" /></h3>
            </div>
            <ul class="object-item_props">
                <li class="object-item_props-item">{{livingSpace}}</li>
                <li class="object-item_props-item">{{rooms}}</li>
            </ul>
            <div class="object-item_price">
                <span class="price">
                    € {{object.price}} 
                </span>
            </div>
        </div>
    </li>
</template>

<script>
import ObjectLink from '@/components/ObjectLink'
export default {
    props: {
        object: {
            type: Object,
            required: true
        },
        active: {
            type: Boolean,
            required: true
        }
    },
    components: {
        ObjectLink
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
    },
    methods: {
       scrollIntoView(el) {
            const parent = el.closest('ul');
            parent.scrollTo({
                top: el.offsetTop,
                left: 0,
                behavior: 'smooth'
            });     
        }
    },
    watch: {
        active: function(val) {
            if(val){
                this.scrollIntoView(this.$refs.el) 
            }
        }
    }
}
</script>

<style scoped>
    .object-item {
        direction: ltr;
        width: 100%;
        display: flex;
        padding: 1rem 0;
        border-bottom: 1px solid #e0e0e0;
        cursor: pointer;
        position: relative;
        transition: .25s cubic-bezier(0.215, 0.610, 0.355, 1);
    }
    .object-item * {
        direction: ltr !important;
        text-align: left;
    }
    .object-item::after,
    .object-item::before {
        content: '';
        position: absolute;
        top: 0;
        width: 10%;
        height: 100%;
        background-color: inherit;
        border-bottom: 1px solid #e0e0e0;
    }
    .object-item::after {
        left: 100%;
    }
    .object-item::before {
        right: 100%;
    }
    .object-item.active {
        background-color: #EEF2F6;
    }
    .object-item_image {
        position: relative;
        width: 45%;
    }
    .object-item_location {
        color: #767676;
        text-transform: uppercase;
        font-family: 'Cormorant Garamond';
    }
    .object-item_title h3 {
        font-size: 1.38rem;
        padding: .75rem 0;
        padding-bottom: 1rem;
        font-stretch: normal;
        font-weight: normal;
    }
    .object-item_props {
        padding: 1rem 0;
        display: flex;
        flex-wrap: wrap;
        position: relative;
    }
    .object-item_props::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 1.25rem;
        height: 1px;
        background-color: #767676;
        opacity: .7;
    }
    .object-item_props-item {
        padding-right: 1rem;
        color: #767676;
    }
    .object-item_props-item:not(:first-child) {
        padding-left: 1rem;
        position: relative;
    }
    .object-item_props-item:not(:first-child)::before {
        content: '';
        position: absolute;
        left: -1px;
        top: calc(50% - 1px);
        width: 2px;
        height: 2px;
        border-radius: 100%;
        will-change: transform;
        background-color: #767676;
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
    .object-item_price .price {
        font-size: 1.38rem;
        font-weight: bold;
    }
</style>