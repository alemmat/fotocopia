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

          <div class="row" style="position: block; margin:0 auto;" >

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

          <div class="row justify-content-center">

            <div style="position: block; margin:0 auto;" class = "col-lg-3 col-md-3 col-sm-3">


            </div>

            <div style="position: block; margin:0 auto;" class = "col-lg-3 col-md-3 col-sm-3">
            </div>

            <div style="position: block; margin:0 auto;" class = "col-lg-6 col-md-6 col-sm-6">

            
            </div>
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

     contador:1,

     centroDeCopiados:null,

     centroDeCopiado: null,

     adicionales:null,

     precios:null,

     selectImprenta:false,

     formData:null,

     trabajo:null,
    }
  },

  methods:{

    irASeccion(seccion) {

      var destino = '';

      switch (seccion) {

        case 'archivos':

          destino = this.$refs.cargarArchivos;
          this.generarTrabajo();
          break;

        case 'abonar':

          destino = this.$refs.abonar;
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
      .then(res => this.trabajo = res.data)
      .catch(function (error) {
          currentObj.output = error;
      });

    },

    postTrabajos(){

      for (var i = 0; i < this.archivos.length; i++) {

        var formData = new FormData();

        formData.append( 'trabajo', this.trabajo );
        formData.append( 'archivo', this.archivos[i].file) ;
        formData.append( 'metaDataArchivo', JSON.stringify(this.archivos[i]) );

        axios.post('/api/archivos', formData)
        .then(function (response) {

          console.log(response.data);
        })
        .catch(function (error) {

          console.log(error);
        });
      }
    },

    selectEvent(centroDeCopiado){

      this.centroDeCopiado = centroDeCopiado;

      this.adicionales = centroDeCopiado.caracteristicas;

      this.precios = centroDeCopiado.precios;

      this.precios.sort(function(a, b) {
        return a.numero_de_impresiones - b.numero_de_impresiones;
      });

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

          this.archivo.desde = parseInt(value, 10);
          break;

        case "hasta":

          this.archivo.hasta = parseInt(value, 10);

          this.calcularPrecio(this.archivo)
          break;

        case "comentarios":

          this.archivo.comentarios = value;
          break;

        case "checkbox":

          this.archivo.caracteristicas = value;
          this.calcularAdicionales(this.archivo)
          break;

        default:
          break;
      }
   },

   calcularPrecio(archivo){

     if(archivo.desde < archivo.hasta){

       var paginas =  parseInt( archivo.hasta - archivo.desde, 10);

       for (var i = 0; i < this.precios.length; i++) {

         if( i == 0 ){

           if( paginas <= this.precios[i].numero_de_impresiones ){

             archivo.precio = paginas * this.precios[i].precio;
             break;
           }
         }else {

           if( parseInt( this.precios[i-1].numero_de_impresiones, 10) < paginas ){

             if( paginas <= parseInt( this.precios[i].numero_de_impresiones, 10 ) ){

               archivo.precio = paginas * this.precios[i].precio;
               break;
             }
           }
         }
       }
     }
   },

   calcularAdicionales(archivo){

     this.calcularPrecio(archivo);

     for (var i = 0; i < archivo.caracteristicas.length; i++) {

       this.adicional = this.adicionales.find(adicional => adicional.id == archivo.caracteristicas[i]);

       console.log(this.adicional.coeficiente);

       if(this.adicional.coeficiente){

         archivo.precio = archivo.precio * (this.adicional.precio+1);
       }else {

         archivo.precio = archivo.precio + this.adicional.precio;
       }
     }
   },

   adicionarArchivo(){

     const newArchivo = {

       id: this.contador++,
       file:'',
       desde:'',
       hasta:'',
       comentarios:'',
       precio:null,
       caracteristicas:null,
     };

     this.archivos = [...this.archivos, newArchivo]
   }
  },

  mounted() {

    this.adicionarArchivo();

    axios.get('/api/centrodecopiado')
    .then(res => this.centroDeCopiados = res.data)
    .catch(err => console.log(err));
  },



}

</script>
