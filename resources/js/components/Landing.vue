<template>
  <div class="page-container">
    <md-app md-mode="reveal">
      <md-app-toolbar class="md-primary" style="background-image: linear-gradient(to right, red,orange,yellow,green,blue,indigo,violet);">

        <span class="md-title">FOTOCOPIAS YA!!!!</span>
      </md-app-toolbar>

      <md-app-content>

        <section>

          <div class="row justify-content-center" style="heigth:100%">

            <div style="position: block; margin:0 auto;" class = "col-lg-5 col-md-5 col-sm-5">

              <imprenta-component
              v-bind:centroDeCopiados="centroDeCopiados"
              v-on:selectEvent="selectEvent"/>

            </div>

            <div style="position: block; margin:0 auto;" class = "col-lg-1 col-md-1 col-sm-1">


            </div>

            <div style="position: block; margin:0 auto;" class = "col-lg-6 col-md-6 col-sm-6">

              <maps-component/>

            </div>

          </div>

          <div class="row justify-content-center" style="heigth:100%" v-if = "this.selectImprenta != false">

            <div style="padding-top: 2%;" class = "col-lg-12 col-md-12 col-sm-12">

               <md-button class="md-raised md-raised md-primary big-button" @click="irASeccion('archivos')">CARGAR ARCHIVOS</md-button>
            </div>
          </div>


        </section>


        <section id="cargarArchivos" ref="cargarArchivos"  v-if = "this.selectImprenta != false" style="display: inline-block;">

          <div class="row" >

              <archivos-component
              v-bind:archivos="archivos"
              v-bind:adicionales="adicionales"
              v-on:sumarArchivo="sumarArchivo"
              v-on:inputEvent="inputEvent"/>
          </div>

          <div class="row justify-content-center" style="heigth:100%" v-if = "this.selectImprenta != false">

            <div style="padding-top: 2%;" class = "col-lg-12 col-md-12 col-sm-12">

               <md-button class="md-raised md-raised md-primary big-button" @click="adicionarArchivo" >ADICIONAR ARCHIVO</md-button>
            </div>

            <div style="padding-top: 2%;" class = "col-lg-12 col-md-12 col-sm-12">

               <md-button class="md-raised md-raised md-primary big-button" @click="irASeccion('abonar')">ABONAR</md-button>
            </div>
          </div>

        </section>

        <section id="abonar" ref="abonar"  v-if = "this.selectImprenta != false" style="display: inline-block;">

          <div class="row" >
              <h1>hola</h1>
          </div>





        </section>


      </md-app-content>
    </md-app>
  </div>
</template>

<style lang="scss" scoped>
section{
  display: inline-block;
  width: 100%;
  height: 100vh;
}

.big-button {
  width: 100%;
  height: 5vh;
}

.scrollbar-hidden::-webkit-scrollbar {
  display: none;
}
</style>

<script>



export default {

  data(){

    return{

     cliente:{},

     archivos:[],

     contador:0,

     centroDeCopiados:null,

     centroDeCopiado: null,

     adicionales:null,

     selectImprenta:false,

     formData:null,

     idTrabajo:null
    }
  },

  methods:{

    irASeccion(seccion) {

      var destino = '';

      switch (seccion) {

        case 'archivos':

          destino = this.$refs.cargarArchivos;
          break;

        case 'abonar':

          destino = this.$refs.abonar;
          this.generarTrabajo();
          this.postTrabajos();
          break;

        default:

      }

      this.$smoothScroll({
        scrollTo: destino,
        duration: 1000,
      })
    },

    generarTrabajo(){

      axios.post('/api/trabajos', {centroDeCopiadoId:this.centroDeCopiado.id})
      .then(res => this.idTrabajo = res.data)
      .catch(function (error) {
          currentObj.output = error;
      });

      this.archivos.forEach((item, i) => {

        item.idTrabajo = this.idTrabajo;
      });
    },

    postTrabajos() {

      this.archivos.forEach((item, i) => {



        this.formData.append('archivo-'+item.id,item.file);
        this.formData.append('metaDataArchivo'+item.id,JSON.stringify(item));
      });

      axios.post('/api/trabajos', this.formData)
      .then(function (response) {

        console.log(response.data);
      })
      .catch(function (error) {

          currentObj.output = error;
      });
    },

    selectEvent(centroDeCopiado){

      this.centroDeCopiado = centroDeCopiado;

      this.adicionales = centroDeCopiado.caracteristicas;

      this.selectImprenta = true;
    },

    sumarArchivo(id, file){

      this.archivo = this.archivos.find(archivo => archivo.id == id );
      this.archivo.file = file;
    },

    inputEvent(id, name, value) {

      this.archivo = this.archivos.find(archivo => archivo.id == id );

      switch (name) {

        case "desde":

          this.archivo.desde = value;
          break;

        case "hasta":

          this.archivo.hasta = value;
          break;

        case "comentarios":

          this.archivo.comentarios = value;
          break;

        default:

      }
   },

   adicionarArchivo(){

     const newArchivo = {

       id: this.contador++,
       file:'',
       desde:'',
       hasta:'',
       comentarios:'',
       idTrabajo:''
     };

     this.archivos = [...this.archivos, newArchivo]
   }
  },

  mounted() {

    this.formData = new FormData();

    this.adicionarArchivo();

    axios.get('/api/centrodecopiado')
    .then(res => this.centroDeCopiados = res.data)
    .catch(err => console.log(err));
  },


}

</script>
