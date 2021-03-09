<template>



    <strong>File:</strong>
    <input type="file" class="form-control" v-on:change="onFileChange">

    <div style="position: block; margin:0 auto;" class = "col-lg-6 col-md-6 col-sm-6">
      <label></label>
      <input type="text">

    </div>

    <div style="position: block; margin:0 auto;" class = "col-lg-6 col-md-6 col-sm-6">
      <label></label>
      <input type="text">

    </div>


</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
              name: '',
              file: '',
              success: ''
            };
        },
        methods: {
            onFileChange(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('file', this.file);

                axios.post('/formSubmit', formData, config)
                .then(function (response) {
                    currentObj.success = response.data.success;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            }
        }
    }
</script>
