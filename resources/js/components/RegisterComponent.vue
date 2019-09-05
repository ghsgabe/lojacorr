<template>
    <div class="container">
        <button class="btn btn-success" id="cadastrar" style="float:right" v-on:click="newUser()">Cadastrar</button>
    
        <h2>Cadastro <strong>Lojacorr</strong> </h2>
        <p>CRUD com Laravel e Vue.js</p>  
        <table-component :users="users" @back="back()"></table-component>
        <form-component 
        v-if="newMode" 
        @new="addUser" 
        @back="back()" 
        @alert="alert()">
        </form-component>
    </div>
</template>
<style>
.btn{
    float:right;
    margin-left:2px;
}
</style>

<script>
    export default {
        
        data() {
            return {
                newMode: false,
                users: []
            }
        },
        mounted() {
            axios.get('/users').then((response) => {
                this.users = response.data.data;
            });
        },
        methods: {
            addUser(user){
                this.users.push(user);
                this.newMode = false;
            },
            newUser(){
                this.newMode = true;
            },
            back(){
                this.newMode = false;
                axios.get('/users').then((response) => {
                    this.users = response.data.data;
                });
            }
        }
    }
</script>
