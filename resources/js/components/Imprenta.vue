<template>

  <div class="">


      <md-list>

         <md-list-item>

           <md-field>

             <label for="movie">Imprenta</label>
             <md-select name="imprentas" @input="selectEvent" @change="selectEvent">
               <md-option v-for="centroDeCopiado in this.centroDeCopiados"
               :value="centroDeCopiado.id"
               :key="centroDeCopiado.id">{{centroDeCopiado.nombre_del_punto_de_fotocopiado}}</md-option>
             </md-select>
           </md-field>

         </md-list-item>

         <md-list-item v-if = "this.centroDeCopiado != null">
           <h5 >
             Nombre: {{this.centroDeCopiado.nombre_del_punto_de_fotocopiado}}
           </h5>
         </md-list-item>

         <md-list-item v-if = "this.centroDeCopiado != null">
           <h5 >
             Direccion: {{this.centroDeCopiado.direccion}}
           </h5>
         </md-list-item>

         <md-list-item v-if = "this.centroDeCopiado != null">
           <h5>Adicionales</h5>
         </md-list-item>

         <div class="" v-if = "this.centroDeCopiado != null">

           <md-list-item  v-for="caracteristica in centroDeCopiado.caracteristicas" :key="caracteristica.id">

              <h5 >{{caracteristica.detalle}}</h5>

          </md-list-item>

          <md-table-row>
            <md-table-cell md-numeric>2</md-table-cell>
            <md-table-cell>Odette Demageard</md-table-cell>
            <md-table-cell>odemageard1@spotify.com</md-table-cell>
            <md-table-cell>Female</md-table-cell>
            <md-table-cell>Account Coordinator</md-table-cell>
          </md-table-row>

         </div>



     </md-list>





  </div>






</template>

<script>


export default{

  props: ["centroDeCopiados"],

  data(){

    return{

     centroDeCopiado:null,
    }
  },

  methods:{

    selectEvent(event) {

      this.centroDeCopiado = this.centroDeCopiados.find(centroDeCopiado => centroDeCopiado.id == event);
      this.$emit('selectEvent',this.centroDeCopiado);
   },
  }
}

</script>

<style scoped>



</style>
