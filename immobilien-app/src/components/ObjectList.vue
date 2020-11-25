<template>
<div class="main-wrapper">
  <div class="objects-wrapper">
    <div class="objects-controlls">
        <transition name="heightToggle">
            <div class="controlls" v-if="showControlls">
                <div class="selects">
                    <div class="select-item" v-for="select in selects" :key="select.field">
                        <label for="">
                            <div class="controlls-title">{{select.title}}</div>
                            <select :name="select.field" v-model="select.current">
                                <option :value="option" v-for="option in select.options" :key="option">
                                    {{option}}
                                </option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="filters">
                    <div class="filters-item" v-for="filter in filters" :key="filter.title">
                        <div class="controlls-title">{{filter.title}}</div>
                        <vue-range-slider
                            v-model="filter.val" 
                            :min="filter.min" 
                            :max="filter.max" 
                            :formatter="filter.format"
                            :enable-cross="false"
                            :tooltip="'hover'">
                        </vue-range-slider>
                        <div class="filters-item_display">
                            {{ filter.format(filter.val[0]) }} - {{ filter.format(filter.val[1]) }}
                        </div>
                    </div>
                </div>
            </div>
        </transition>
        <div class="button-filters" 
        @click="showControlls = !showControlls"
        v-if="filteredObjects.length"
        ><span>gefunden objektskhoph: {{filteredObjects.length}}</span></div>
    </div>
    <p v-if="loading">
        {{loadingMessage}}
    </p>
    <ul class="objects" v-else-if="filteredObjects.length">
        <ObjectItem  
            v-for="object in filteredObjects" 
            v-bind:key="object.id" 
            v-bind:object="object" 
            v-bind:active="activeElement == object.id"
        />
    </ul>
    <p v-else>
        {{emptyMessage}}
    </p>
    
  </div>
  <MapDisplay v-if="objects.length" v-on:scroll-to="scrollTo" v-bind:objects="filteredObjects" />
  </div>
</template>

<script>
import 'vue-range-component/dist/vue-range-slider.css'
import VueRangeSlider from 'vue-range-component'

import ObjectItem from '@/components/ObjectItem'
import MapDisplay from '@/components/MapDisplay'

export default {
    data() {
        return {
            objects: [],
            filters: [],
            selects: [],
            loading: true,
            loadingMessage: 'Loading...',
            emptyMessage: 'Not Found',
            showControlls: true,
            activeElement: 0
        }
    },
    components: {
        ObjectItem,
        VueRangeSlider,
        MapDisplay
    },
    async created() {
        // GET request using fetch with async/await
        const response = await fetch('http://dev.leo-wacker.ru/wp-json/objects-list/v1/objects');
        const data = await response.json();
        this.objects = data;
        const rooms = [];
        const prices = [];
        const livingSpace = [];
        const areas = ['All'];
        const types = ['All'];
        data.forEach((object) => {
            rooms.push(object.room);
            prices.push(Number(object.price));
            livingSpace.push(Number(object.living_space));
            if(areas.indexOf(object.area) == -1){
                areas.push(object.area);
            }
            if(types.indexOf(object.type_name) == -1){
                types.push(object.type_name);
            }
        });
        // create filters
        this.createFilter('Zimmer', rooms, val => `${val} zimmer`, 'room');
        this.createFilter('Pries', prices, val => `€ ${val}`, 'price');
        this.createFilter('Flache', livingSpace, val => `${val} m2`, 'living_space');
        // create select filters
        this.createSelectFilter('Bezirk', areas, 'area');
        this.createSelectFilter('Immobilienart', types, 'type_name');
        //
        this.loading = false;
    },
    methods: {
        createFilter(title, array, format, field) {
            let filter = {
                title: title,
                min: Math.min.apply(null, array),
                max: Math.max.apply(null, array),
                val: [Math.min.apply(null, array), Math.max.apply(null, array)],
                format: format,
                field: field
            }
            this.filters.push(filter)
        },
        createSelectFilter(title, array, field) {
            let select = {
                title: title,
                field: field,
                options: array,
                current: array[0]
            }
            this.selects.push(select)
        },
        scrollTo(obj) {
            this.activeElement = obj.id
        }
    },
    computed: {
        filteredObjects() {
            return this.objects.filter((obj) => {
                let compare = [];
                this.filters.forEach((filt) => {
                    compare.push(obj[filt.field] >= filt.val[0] && obj[filt.field] <= filt.val[1]);
                })
                this.selects.forEach((select) => {
                    if(select.current !== 'All') {
                        compare.push(obj[select.field] == select.current)
                        //console.log(obj[select.field],  select.current)
                    }
                })
                return compare.every((i) => i == true)
            });
        }
    }
}
</script>

<style scoped>
.main-wrapper {
    justify-content: space-between;
    display: flex;
    overflow-x: hidden;
    overflow-y: hidden;
}
    .controlls-title {
        color: #3C3C3C;
        font-size: 1.25rem;
        padding-bottom: 0.63rem;
        font-family: 'Cormorant Garamond';
        font-weight: bold;
    }
    .controlls {
        overflow: hidden;
    }
    .objects {
        overflow-y: scroll;
        overflow-x: hidden;
        padding: 0 1.88rem;
        flex-grow: 2;
        position: relative;
        direction: rtl;
    }
    .objects-wrapper {
        height: calc(100vh - 4rem);
        display: flex;
        flex-direction: column;
    }
    .filters, .selects {
        display: flex;
        padding-top: 1.5rem;
    }
    .filters-item, .select-item {
        width: 33.33%;
        padding: 0.625rem;
    }
    .filters-item {
        padding-top: 1rem;
    }
    .filters-item_display {
        font-size: 1.25rem;
        font-weight: 400;
        padding-top: 0.3rem;
        padding-bottom: 1rem;
    }
    .select-item select {
        width: 100%;
        font-size: 1.25rem;
        background-color: #EEF2F6;
        border: none;
        outline: none;
        padding: 0.63rem;
    }
    .objects-controlls {
        padding: 1.25rem;
    }
    .objects-wrapper {
        width: 50vw;
    }
    .button-filters {
        padding: 0.625em;
        width: 100%;
    }
    .button-filters span {
        cursor: pointer;
        display: block;
        border-radius: 50em;
        background-color: #E26E03;
        color: #fff;
        padding: 0.94em 1.25rem;
        font-size: 1.25em;
        text-transform: uppercase;
    }
    .heightToggle-enter-active, .heightToggle-leave-active {
        transition: all .5s;
        max-height: 25rem;
    }
    .heightToggle-enter, .heightToggle-leave-to /* .fade-leave-active до версии 2.1.8 */ {
        opacity: 0;
        max-height: 0px;
    }
</style>
