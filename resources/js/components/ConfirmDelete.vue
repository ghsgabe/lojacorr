<template>
    <div id="newandeditform">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Deletar - {{ userEdit.name }}</div>

                <div class="card-body">
                    <form method="POST" action="" v-on:submit.prevent="update()">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" :value="csrf">

                        <h3>Você deseja <strong>deletar {{ userEdit.name }} </strong>?</h3>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger" v-on:click="deleteUser()">
                                   Deletar
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
                name: ''
            }
        },
        mounted() {
        },
        methods: {
            deleteUser() {    
                axios.get(`/users/delete/${this.userEdit.id}`).then((response) => {
                    this.$emit('back');
                });
            },
            onClickBack() {
                this.$emit('back');
            }
        }
    }
</script>
