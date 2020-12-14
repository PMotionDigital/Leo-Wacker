<template>
<div class="main-wrapper">
  <div class="objects-wrapper" :class="{mobile: mobile}">
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
        >
            <span class="text" v-if="showControlls">{{translations.closeFilters[locale]}}</span>
            <span class="text" v-else>{{translations.openFilters[locale]}}</span>
            <span>{{translations.found[locale]}}: {{filteredObjects.length}}</span>
        </div>
    </div>
   
    <div class="app-loader" v-if="loading">
    
    </div>
    <div class="objects-container"  v-else-if="filteredObjects.length">
        <MobileObjects 
            v-if="mobile"
            v-bind:translations="translations"
            v-bind:locale="locale"
            v-bind:activeId="activeElement"
            v-bind:objects="filteredObjects"
            v-on:slider-change="scrollTo"
            v-on:pass-id="loadPost" />

        <ul v-if="!mobile" class="objects">
            <ObjectItem     
                v-on:pass-id="loadPost"
                v-for="object in filteredObjects" 
                v-bind:key="object.id" 
                v-bind:slider="true"
                v-bind:object="object" 
                v-bind:translations="translations"
                v-bind:locale="locale"
                v-bind:active="activeElement == object.id"
                @click.native="scrollTo(object)"
            />
        </ul>
        <div v-else class="objects-draggable" :class="{opened: openList}">
            <div class="objects-button" @click="openList = !openList">
                {{translations.found[locale]}}: {{filteredObjects.length}}
            </div>
            <ul class="objects">
                
                <ObjectItem 
                    
                    v-on:pass-id="loadPost"
                    v-for="object in filteredObjects" 
                    v-bind:key="object.id" 
                    v-bind:slider="true"
                    v-bind:mobile="mobile"
                    v-bind:object="object" 
                    v-bind:translations="translations"
                    v-bind:locale="locale"
                    v-bind:active="activeElement == object.id"
                    @click.native="scrollTo(object)"
                />
            </ul>
        </div>
    </div>
    
    <p v-else>
        {{emptyMessage}}
    </p>
    
  </div>
  <MapDisplay 
  v-on:set-id="loadPost"
  v-if="objects.length" 
  v-on:scroll-to="scrollTo" 
  v-bind:objects="filteredObjects"
  v-bind:active="activeElement"
  v-bind:mobile="mobile" />

  <PostContainer v-if="postData" 
  v-bind:mobile="mobile"
  v-bind:objects="objects" 
  v-bind:postData="postData" 
  v-bind:translations="translations"
  v-bind:locale="locale"
  v-bind:url="requestUrl" />
  </div>
</template>

<script>
import 'vue-range-component/dist/vue-range-slider.css'
import VueRangeSlider from 'vue-range-component'

import ObjectItem from '@/components/ObjectItem'
import MapDisplay from '@/components/MapDisplay'
import PostContainer from '@/components/PostContainer'
import MobileObjects from '@/components/MobileObjects'

export default {
    data() {
        return {
            objects: [],
            filters: [],
            selects: [],
            loading: true,
            mobile: true,
            openList: false,
            //loadingMessage: 'Loading...',
            emptyMessage: 'Not Found',
            showControlls: false,
            activeElement: 0,
            postData: {
                loading: true,
                id: 0
            },
            requestUrl: '',
            locale: 'ru',
            langs: [
                {
                    ind: 1,
                    slug: 'ru'
                },
                {
                    ind: 2,
                    slug: 'en'
                },
                {
                    ind: 3,
                    slug: 'de'
                }
            ],
            translations: {
                All: {
                    ru: 'Все',
                    en: 'All',
                    de: 'Alles'
                },
                openFilters: {
                    ru: 'Открыть фильтры',
                    en: 'Open filters',
                    de: 'Filter öffnen'
                },
                closeFilters: {
                    ru: 'Закрыть фильтры',
                    en: 'Close filters',
                    de: 'Filter schließen'
                },
                immobilienart: {
                    ru: 'Тип недвижимости',
                    de: 'Immobilienart',
                    en: 'Property type'
                },
                bezirk: {
                    ru: 'Округ Берлина',
                    en: 'District',
                    de: 'Bezirk'
                },
                zimmer: {
                    ru: 'Кол-во комнат',
                    en: 'Rooms',
                    de: 'Zimmer'
                },
                zimmers: {
                    ru: ['Комната', 'Комнаты', 'Комнат'],
                    en: ['Room', 'Rooms', 'Rooms'],
                    de: ['Zimmer', 'Zimmer', 'Zimmer']
                },
                pries: {
                    ru: 'Цена',
                    en: 'Price',
                    de: 'Pries'
                },
                flache: {
                    de: 'Wohnfläche',
                    en: 'Living space',
                    ru: 'Жилая площадь'
                },
                found: {
                    en: 'Objects found',
                    ru: 'Найдено объектов',
                    de:'Objekte gefunden'
                },
                'berlin': {
                    en: 'Berlin',
                    de: 'Berlin',
                    ru: 'Берлин'
                },
                'send' : {
                    de: 'Anfrage senden',
                    ru: 'Отправить запрос',
                    en: 'Send inquiry'
                }
            }
        }
    },
    components: {
        ObjectItem,
        VueRangeSlider,
        MapDisplay,
        PostContainer,
        MobileObjects
    },
    async created() {
        // GET request using fetch with async/await
        const mob = document.querySelector('#is_mobile_');
        if(mob) {
            this.mobile = mob.value;
        }
        const loc = document.getElementById('current_locale_');
        const urlEl = document.getElementById('current_url_');
        let locVal = 1;
        this.locale = this.langs.find(el => el.ind == locVal).slug;
        this.requestUrl = 'http://dev.leo-wacker.ru';
        if(loc) {
            this.locale = loc.value;
            locVal = this.langs.find(el => el.slug == loc.value).ind;
        }
        if(urlEl) {
            this.requestUrl = urlEl.value;
        }
        console.log(loc);
        const response = await fetch(`${this.requestUrl}/wp-json/objects-list/v1/objects/${locVal}`);
        const data = await response.json();
        this.objects = data;
        const rooms = [];
        const prices = [];
        const livingSpace = [];
        const areas = [this.translations.All[this.locale]];
        const types = [this.translations.All[this.locale]];
        data.forEach((object) => {
            rooms.push(object.room);
            prices.push(Number(object.price));
            livingSpace.push(Number(object.living_space));
            if(areas.indexOf(object.area) == -1){
                areas.push(object.area);
            }
            // if(types.indexOf(object.type_name) == -1){
            //     types.push(object.type_name);
            // }
            object.type_name.forEach((name) => {
                if(types.indexOf(name) == -1) {
                    types.push(name);
                }
            });
        });
        // create filters
        this.createFilter(this.translations.zimmer[this.locale], rooms, (val) => {
            return `${val} ${this.declOfNum(val, this.translations.zimmers[this.locale])}`; 
            }, 'room');
        this.createFilter(this.translations.pries[this.locale], prices, val => `€ ${val}`, 'price');
        this.createFilter(this.translations.flache[this.locale], livingSpace, val => `${val} m2`, 'living_space');
        // create select filters
        this.createSelectFilter(this.translations.bezirk[this.locale], areas, 'area');
        this.createSelectFilter(this.translations.immobilienart[this.locale], types, 'type_name');
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
            if(this.activeElement != obj.id) {
                this.activeElement = obj.id
                console.log('one');
            }
        },
        loadPost(data){
            this.postData = data;
            this.openList = false;
        },
        declOfNum(number, titles) {
            const cases = [2, 0, 1, 1, 1, 2];
            return titles[(number % 100 > 4 && number % 100 < 20) ? 2 : cases[(number % 10 < 5) ? number % 10 : 5]];
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
                    if(select.current !== this.translations.All[this.locale]) {
                        if(Array.isArray(obj[select.field])){
                            console.log('aray')
                            compare.push(obj[select.field].indexOf(select.current) != -1);
                        } else {
                            compare.push(obj[select.field] == select.current)
                        }
                        
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
    position: relative;
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
        height: 100%;
        position: relative;
        direction: rtl;
    }
    .objects-container {
        flex-grow: 2;
        overflow: hidden;
    }
    .objects-wrapper {
        height: calc(100vh - 4rem);
        display: flex;
        flex-direction: column;
    }
    .objects-wrapper.mobile {
        height: calc(100% - 2rem);
        position: fixed;
        left: 0;
        top: 2rem;
        width: 100%;
        pointer-events: none;
        z-index: 9999;
    }
    .objects-button {
        padding: 1rem;
        border-radius: 1rem 1rem 0 0;
        background-color: #fff;
        text-align: center;
        position: absolute;
        left: 0;
        bottom: 100%;
        width: 100%;
        pointer-events: all;
    }
    .objects-button::after {
        content: '';
        position: absolute;
        top: .25rem;
        left: calc(50% - 25px);
        width: 50px;
        height: .25rem;
        background: #E4E4E4;
        border-radius: 50em;
    }
    .objects-draggable {
        position: fixed;
        left: 0;
        top: 100%;
        height: 70%;
        transition: .25s ease-out;
    }
    .objects-draggable.opened {
        transform: translate3d(0,-100%,0);
    }
    .objects-wrapper.mobile ul.objects {
        background: #fff;
        pointer-events: all;
        -webkit-overflow-scrolling: touch;
        width: 100%;
        height: 100%;
        padding: calc(100vw / 24);
    }
    .objects-wrapper.mobile ul.objects .VueCarousel {
        width: 33.33%;
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
        background-color: #fff;
        padding: 1.25rem;
        pointer-events: all;
    }
    .objects-wrapper {
        width: 50vw;
    }
    .button-filters {
        padding: 0.625em;
        width: 100%;
        cursor: pointer;
        display: block;
        border-radius: 50em;
        background-color: #E26E03;
        color: #fff;
        padding: 0.94em 1.25rem;
        font-size: 1.25em;
        text-transform: uppercase;
        display: flex;
        justify-content: space-between;
    }
    .button-filters .text {
        text-transform: lowercase;
    }
    .button-filters .text::first-letter {
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
