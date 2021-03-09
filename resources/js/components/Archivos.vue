<template>

  <div>

    <div v-bind:key="archivo.id"  v-for="archivo in archivos" style="display: inline-block;">

      <archivoitem-component
      v-bind:archivo="archivo"
      v-bind:adicionales="adicionales"      
      v-on:sumarArchivo="sumarArchivo"
      v-on:inputEvent="inputEvent"/>

    </div>

  </div>

</template>

<script>

export default{

  props: ["archivos","adicionales"],
  methods:{
    sumarArchivo(id, file){

      this.$emit('sumarArchivo', id, file);
    },

    inputEvent(id, name, value) {

      this.$emit('inputEvent', id, name, value);
   }
  }
}

</script>

<style scoped>

.hr {
  display: block;
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  margin-left: auto;
  margin-right: auto;
  border-style: inset;
  border-width: 1px;
}

</style>
