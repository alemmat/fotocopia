<template>
  <div>

    <md-card>
      <md-card-header>
        <div class="md-title">Archivo {{this.archivo.id}}</div>
      </md-card-header>

      <md-card-content>
        <md-field>
          <label>Archivo</label>
          <md-file  v-on:change="onFileChange"/>
        </md-field>


          <div class="row">

            <div  class = "col-lg-6 col-md-6 col-sm-6">
              <md-field>
                <label>Desde</label>
                <md-input @input="inputEvent" @change="inputEvent" name="desde"></md-input>

              </md-field>


            </div>

            <div  class = "col-lg-6 col-md-6 col-sm-6">
              <md-field>
                <label>Hasta</label>
                <md-input @input="inputEvent" @change="inputEvent" name="hasta"></md-input>

              </md-field>
            </div>

          </div>

          <md-field>
            <label>Comentarios</label>
            <md-textarea md-autogrow name="comentarios" @input="inputEvent" @change="inputEvent"></md-textarea>
          </md-field>

          <div v-for="adicional in adicionales" :key="adicional.id" style="display: inline-block;">

              <md-checkbox  v-model="checkbox" :value="adicional.id">{{adicional.detalle}}</md-checkbox>
          </div>

      </md-card-content>


    </md-card>


  </div>
</template>

<script>

export default{

  props:["archivo","adicionales"],

  mounted(){

  },

  data(){

    return{

      checkbox:[],
    }
  },

  methods: {

      onFileChange(e){

        this.$emit('sumarArchivo', this.archivo.id, e.target.files[0]);
      },

      inputEvent({ type, target }) {

        this.$emit('inputEvent', this.archivo.id, target.name, target.value);
     }
  }
}

</script>


<style lang="scss" scoped>

input[type="file"]{
  top: 0px;
  position: relative;
}

.md-card {
  width: 300px;
  margin: 4px;
  display: inline-block;
  vertical-align: top;
}

</style>
