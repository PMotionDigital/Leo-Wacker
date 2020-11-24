<template>
  <div class="map-container">
    <MglMap 
      :accessToken="accessToken" 
      :mapStyle="mapStyle"  
      :attributionControl="false" 
      :center="mapCenter"
      :zoom="mapZoom" >
      <MglMarker v-for="object in objects" 
        v-bind:key="object.id"
        :coordinates="[Number(object.coords.lng), Number(object.coords.lat)]"
        >
        
        <p @click="flyToo" slot="marker" class="map-marker">€ {{object.price}}</p>

         <MglPopup>
          <MapPopup v-bind:object="object" />
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
      mapZoom: 11
    };
  },
  methods: {
    async flyToo() {
      // this.$refs.map.map.flyTo({
      //   center: [13.388382746972873, 52.51507071233264],
      //   zoom: 9,
      // })
      const flyResult = await this.actions.flyTo({ center: [10, 10] });
      this.mapCenter = flyResult.center;
      console.log(this);
    }
  },
  created() {
    // We need to set mapbox-gl library here in order to use it in template
    this.mapbox = Mapbox;
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
  color: #000;
  box-shadow: 0px 0.25rem 1rem rgba(0, 0, 0, 0.17);
  font-weight: bold;
}
.mapboxgl-popup {
  position: absolute;
  top: 0;
  left: 0;
}
  .map-container {
    width: 50vw;
    overflow: hidden;
  }
  .map-container *:active,
  .map-container *:focus {
    outline: none;
  }
</style>