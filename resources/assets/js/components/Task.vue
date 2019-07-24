


<!-- //Shahril // -->
<template>
        <!--
        <div class="task-component">
         <p>TASK</p>
        </div>
        -->
<!--
        <tr>
            <td>id-1</td>
            <td>title-1</td>
            <td>priority-1</td>
            <td></td>
        </tr>
-->
        <tr>
            <td>{{ task.id }}</td>
            <td>{{ task.title }}</td>
            <td>{{ task.priority }}</td>
            <!-- @click gonna go to remove method handler down there-->
            <td><button @click="removetask" class="btn btn-danger">Remove</button></td>
        </tr>


</template>


<script>

    export default{

        data(){
            return{
            }

        },

        methods: {

            removetask(){

                this.$emit('delete', this.task.id) //Will take the task.id then pass to @delete in App.vue 

            }


        },


        props: ['task'] //This is needed as link to :task="task" in App.vue and {{ task.id }} above


    }


</script>

<style>
</style>




