<template>
    <tr>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.cep }}</td>
        <td>{{ user.street }}</td>
        <td>
            <button class="btn btn-danger" v-on:click="onClickDelete()">Excluir</button>
            <button class="btn btn-warning" v-on:click="onClickEditPass()">Editar Senha</button>
            <button class="btn btn-info" v-on:click="onClickEdit()">Editar Informações</button>
        </td>
    </tr>
</template>
<script>
    export default {
        props: ['user'],
        mounted() {
        },
        methods: {
            onClickDelete(){
                this.$emit('delete');
            },
            onClickEdit(){
                this.$emit('edit');
            },
            onClickEditPass(){
                this.$emit('editPass');
            }
        }
    }
</script>