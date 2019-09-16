<template>
    <div id="newandeditform">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cadastrar</div>

                <div class="card-body">
                    <form method="POST" id="form_cadastro" action="" v-on:submit.prevent="newUser()">
                        <input type="hidden" name="_token" :value="csrf">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" min="8" name="name" required autocomplete="name" autofocus>
                                <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email">
                                <span v-if="errors.email" class="error">{{ errors.email[0] }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" min="8" name="password" required autocomplete="new-password">
                                <span v-if="errors.password" class="error">{{ errors.password[0] }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-c" class="col-md-4 col-form-label text-md-right">Confirme a senha</label>

                            <div class="col-md-6">
                                <input id="password-c" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cep" class="col-md-4 col-form-label text-md-right">Cep</label>

                            <div class="col-md-6">
                                <input id="cep" @blur="viaCep" type="text" class="form-control" name="cep" min="8" max="9" v-model="cep" autocomplete="cep" autofocus>
                                <span v-if="errors.cep" class="error">{{ errors.cep[0] }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">Endereço</label>

                            <div class="col-md-6">
                                <input id="street"  type="text" class="form-control" name="street" v-model="street"  autocomplete="street" autofocus>
                                <span v-if="errors.street" class="error">{{ errors.street[0] }}</span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Cadastrar
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
<script>
    export default {
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                name: '',
                errors: [],
                street: '',
                cep: ''
            }
        },
        mounted() {
        },
        methods: {
            newUser() {
                const params = {
                    name: document.getElementById("name").value,
                    email: document.getElementById("email").value,
                    password: document.getElementById("password").value,
                    password_confirmation: document.getElementById("password-c").value,
                    cep: document.getElementById("cep").value,
                    street: document.getElementById("street").value
                };
                axios.post('/register', params).then(response=>{   
                    this.errors = [];                                      
                    let user = {
                       name: params.name,
                       email: params.email,
                       cep: params.cep,
                       street: params.street
                    };
                    this.$emit('new', user); 
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
                axios.get(`/users/cep/${this.cep}`).then((response) => {
                    this.street = response.data.logradouro;
                }).catch(error => {
                    this.street = '';
                }); 
            }
        }
    }
</script>
