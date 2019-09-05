<template>
    <div id="newandeditform">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Senha</div>

                <div class="card-body">
                    <form method="POST" action="" v-on:submit.prevent="update()">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" :value="csrf">

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Nova Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                <span v-if="errors.password" class="error">{{ errors.password[0] }}</span>
                             </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-c" class="col-md-4 col-form-label text-md-right">Confirme a senha</label>

                            <div class="col-md-6">
                                <input id="password-c" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
                    password: document.getElementById("password").value,
                    password_confirmation: document.getElementById("password-c").value
                };
                axios.post(`/users/updatepass/${this.userEdit.id}`, params).then((response) => {
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
            }
        }
    }
</script>
