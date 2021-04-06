<template>
  <div>

    <md-card>
      <md-card-header>
        <div class="md-title">Item {{this.archivo.id}} - Precio:${{this.archivo.precio}}</div>
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
                <md-input  name="desde" v-model="desde"></md-input>

              </md-field>


            </div>

            <div  class = "col-lg-6 col-md-6 col-sm-6">
              <md-field>
                <label>Hasta</label>
                <md-input name="hasta" v-model="hasta"></md-input>

              </md-field>
            </div>

          </div>

          <md-field>
            <label>Comentarios</label>
            <md-textarea md-autogrow name="comentarios" v-model="comentarios"></md-textarea>
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

  props:["archivo", "adicionales"],

  mounted(){

  },

  data(){

    return{

      checkbox:[],

      desde:null,

      hasta:null,

      comentarios:null,
    }
  },

  methods: {

      onFileChange(e){

        this.$emit('sumarArchivo', this.archivo.id, e.target.files[0]);
      },
  },

  watch: {

    desde:function(){

      this.$emit('inputEvent', this.archivo.id, 'desde', this.desde);
    },

    hasta:function(){

      this.$emit('inputEvent', this.archivo.id, 'hasta', this.hasta);
    },

    comentarios:function(){

      this.$emit('inputEvent', this.archivo.id, 'comentarios', this.comentarios);
    },

    checkbox:function(){

      this.$emit('inputEvent', this.archivo.id, 'checkbox', this.checkbox);
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
