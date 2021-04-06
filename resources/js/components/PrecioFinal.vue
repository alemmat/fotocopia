<template>
  <div>
    <md-table>
      <md-table-toolbar>
        <h1 class="md-title">ARCHIVOS A IMPRIMIR</h1>
      </md-table-toolbar>

      <md-table-row>
        <md-table-head>ARCHIVO</md-table-head>
        <md-table-head>NUM DE PAGINAS</md-table-head>
        <md-table-head>PRECIO</md-table-head>
      </md-table-row>


        <md-table-row v-for="archivo in archivos">
          <md-table-cell>{{archivo.file.name}}</md-table-cell>
          <md-table-cell>{{archivo.hasta - archivo.desde}}</md-table-cell>
          <md-table-cell>{{archivo.precio}}</md-table-cell>
        </md-table-row>

        <md-table-row>
          <md-table-cell></md-table-cell>
          <md-table-cell>PRECIO TOTAL</md-table-cell>
          <md-table-cell>{{this.precioTotal}}</md-table-cell>
        </md-table-row>

    </md-table>
  </div>
</template>

<style>
</style>

<script>

export default{

    props:["archivos", "precioTotal"],

    methods:{

    },
}
</script>
