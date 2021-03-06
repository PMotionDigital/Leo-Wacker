<template>
  <div class="map-container" :class="{mobile: mobile}">
    <MglMap 
      :accessToken="accessToken" 
      :mapStyle="mapStyle"  
      :attributionControl="false" 
      :center="mapCenter"
      :zoom="mapZoom" 
      @load="onMapLoaded">
      <MglMarker v-for="object in objects" 
        v-bind:key="object.id"
        :coordinates="[Number(object.coords.lng), Number(object.coords.lat)]"
        >
        
        <p @click="flyTo(object)" :class="{active: active == object.id}" slot="marker" class="map-marker">€ {{object.price}}</p>
         <MglPopup v-if="!mobile" :maxWidth="'18px'" @open="openPop(object.id)">
          <MapPopup  v-on:pass-id="passId" v-bind:show="openedPopup == object.id" v-bind:object="object" />
        </MglPopup>
      </MglMarker>
    </MglMap>
  </div>
</template>

<script>
import Mapbox from 'mapbox-gl'
import { MglMap, MglMarker, MglPopup } from 'vue-mapbox'
import MapPopup from '@/components/MapPopup'

export default {
  props: {
    objects: {
        type: Array,
        required: true
    },
    active: {
        type: Number,
        required: true
    },
    mobile: {
      type: Boolean,
      required: true
    }
  },
  components: {
    MglMap,
    MglMarker,
    MglPopup,
    MapPopup
  },
  data() {
    return {
      mapbox: null,
      accessToken: 'pk.eyJ1IjoiZGFuaWxhbG9sd3V0IiwiYSI6ImNrZ2MxbzIwbjBtbXkzMGt6YnF6cWd3N3EifQ.nGLHuElPpYK-0bTp8ABz2Q', // your access token. Needed if you using Mapbox maps
      mapStyle: 'mapbox://styles/mapbox/streets-v11', // your map style
      mapCenter: [13.388382746972873, 52.51507071233264],
      mapZoom: 11,
      flyZoom: 13,
      flySpeed: 0.8,
      openedPopup: null
    };
  },
  computed: {
    //
  },
  methods: {
    async flyTo(el) {
      this.map.flyTo({
        center: [Number(el.coords.lng), Number(el.coords.lat)],
        zoom: this.flyZoom,
        speed: this.flySpeed
      });
      this.$emit('scroll-to', el)
    },
    onMapLoaded(event) {
      // in component
      this.map = event.map;
    },
    passId(data){
      this.$emit('set-id', data);
    },
    openPop(id) {
      this.openedPopup = id;
      console.log(id);
    }
  },
  created() {
    // We need to set mapbox-gl library here in order to use it in template
    this.mapbox = Mapbox;
    this.map = null;
  },
  watch: {
    active: function(val, oldVal) {
      if(val !== oldVal){
        this.flyTo(this.objects.find((el) => el.id == val))
      }
    }
  }
};
</script>

<style >
.map-marker {
  cursor: pointer;
  background-color: #fff;
  position: absolute;
  left: 0;
  top: 0;
  padding: 0.5rem 1rem;
  border-radius: .5rem;
  border: 1px solid transparent;
  color: #000;
  box-shadow: 0px 0.25rem 1rem rgba(0, 0, 0, 0.17);
  font-weight: bold;
}
.map-marker.active {
  border: 1px solid #E26E03;
}
.mapboxgl-popup {
  position: absolute;
  top: 0;
  left: 0;
  padding: 1.3rem 0;
  max-width: 18rem !important;
}
.mapboxgl-popup-content .mapboxgl-popup-close-button {
    display: none;
}
.map-container {
  width: 50vw;
  overflow: hidden;
}
.map-container.mobile {
  width: 100vw;
  height: 100%;
  position: fixed;
  left: 0;
  top: 0;
}

.map-container *:active,
.map-container *:focus {
  outline: none;
}
.mapboxgl-canvas-container {
  position: relative;
}
.mapboxgl-canvas-container::after {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(255,255,255,.8);
  opacity: 0;
  pointer-events: none;
  transition: .25s ease-out;
  z-index: 99;
}
/* .mapboxgl-canvas-container.loading {
    opacity: .5;
} */
.mapboxgl-canvas-container.loading::after {
  opacity: 1;
}
</style>