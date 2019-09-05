<template>
    <div id="newandeditform">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar</div>

                <div class="card-body">
                    <form method="POST" action="" v-on:submit.prevent="update()">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" :value="csrf">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" v-model="userEdit.name" required autocomplete="name" autofocus>
                                 <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" disabled="disabled"  v-model="userEdit.email" required autocomplete="email">
                                <span v-if="errors.email" class="error">{{ errors.email[0] }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cep" class="col-md-4 col-form-label text-md-right">Cep</label>

                            <div class="col-md-6">
                                <input id="cep" @blur="viaCep" type="text" class="form-control" name="cep"  v-model="userEdit.cep" autocomplete="cep" autofocus>
                                <span v-if="errors.cep" class="error">{{ errors.cep[0] }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">Endereço</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control" name="street"  v-model="userEdit.street" autocomplete="street" autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Salvar
                                </button>
                                <button  class="btn btn-warning" v-on:click="onClickBack()">
                                   Voltar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
div#newandeditform > div{
    top: 20%;
    position: fixed;
    left: 30%;
    width: 40%;
}
div#newandeditform {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.7);
}
</style>
<script>
    export default {
    props:['userEdit'],
    data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                name: '',
                errors: []
            }
        },
        mounted() {
        },
        methods: {
            update() {    
                const params = {
                    name: document.getElementById("name").value,
                    cep: document.getElementById("cep").value,
                    street: document.getElementById("street").value
                };
                axios.post(`/users/update/${this.userEdit.id}`, params).then((response) => {
                    this.errors = []; 
                    this.$emit('back');  
                }).catch(error => {
                    if (error.response.status = 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },
            onClickBack() {
                this.$emit('back');
            },
            viaCep(){  
                axios.defaults.headers.common = {};              
                axios.get(`https://viacep.com.br/ws/${this.userEdit.cep}/json/`).then((response) => {
                    this.userEdit.street = response.data.logradouro;
                }).catch(error => {
                    this.userEdit.street = '';
                });
            }
        }
    }
</script>
