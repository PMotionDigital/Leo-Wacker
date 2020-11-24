<template>
  <MglMap :accessToken="accessToken" :mapStyle="mapStyle" />
</template>

<script>
import Mapbox from "mapbox-gl";
import { MglMap } from "vue-mapbox";

export default {
  components: {
    MglMap
  },
  data() {
    return {
      accessToken: 'pk.eyJ1IjoiZGFuaWxhbG9sd3V0IiwiYSI6ImNrZ2MxbzIwbjBtbXkzMGt6YnF6cWd3N3EifQ.nGLHuElPpYK-0bTp8ABz2Q', // your access token. Needed if you using Mapbox maps
      mapStyle: '' // your map style
    };
  },

  created() {
    // We need to set mapbox-gl library here in order to use it in template
    this.mapbox = Mapbox;
  }
};
</script>