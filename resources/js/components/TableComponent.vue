<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Cep</th>
                        <th>Logradouro</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <users-component  
                    v-for="(user, index) in users" 
                    :key="user.id" :user="user" 
                    @edit="editUser(index)" 
                    @editPass="editPassUser(index)"  
                    @delete="deleteUser(index)"
                    ></users-component>
                </tbody>
            </table>
            <formedit-component 
            v-if="editMode" 
            :userEdit="userEdit" 
            @back="closeEdit()
            "></formedit-component>
            <formpass-component 
            v-if="editPassMode" 
            :userEdit="userEdit" 
            @back="closeEdit()
            "></formpass-component>
            <delete-component 
            v-if="deleteMode" 
            :userEdit="userEdit" 
            @back="closeEdit()
            "></delete-component>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['users'],
        data() {
            return {
                editMode: false,
                userEdit: false,
                editPassMode: false,
                deleteMode: false,
            }
        },
        mounted() {
        }, 
        methods: {
            deleteUser(index) {
                this.userEdit = this.users[index];
                this.deleteMode = true;
                this.users.splice(index, 1);
            },
            editUser(index) {
                this.userEdit = this.users[index];
                this.editMode = true;
            },
            editPassUser(index) {
                this.userEdit = this.users[index];
                this.editPassMode = true;
            },
            closeEdit(){
                this.$emit('back');
                this.editMode = false;
                this.editPassMode = false;
                this.deleteMode = false;
            }
        }
    }
</script>