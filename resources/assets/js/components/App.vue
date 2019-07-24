
<!-- //Shahril // -->
<template>
    <div class="app-component">
        <p> APP </p>
         <p> {{ message }} </p> <!-- Will show Hello From Here... -->
        <loading :active.sync="isLoading"></loading> <!-- This setup from vue-loading-overlay below -->

         <table class="table">
             <thead>
               <tr>
                 <th>Id</th>
                 <th>Task Title</th>
                 <th>Priority</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>

             <!-- <task-component v-for="task in tasks" :key="task.id" :task="task" @delete="remove"></task-component> -->
             <!-- v-for = for loop , tasks is value taken from below parse to task
             task.id is the key for loop
             :task = variable declare in Task.vue , "task" in the value object 
             @delete from Task.vue , will pass to method remove below
             -->
             <task-component v-for="task in tasks" :key="task.id" :task="task" @delete="removed"  ></task-component>

             <tr>

		 <!-- This will pass data task.title into v-model and POST into database -->
                 <td><input v-model="task.title" type="text" id="task" class="form-control"></td> 
                 <!-- <td><input type="text" id="task" class="form-control"></td> -->

                 <td>
                  <select v-model='task.priority' id="select" class="form-control"> 
                  <!-- <select id="select" class="form-control"> -->

                      <option>Low</option>
                      <option>Medium</option>
                      <option>High</option>

                 </select>
                 </td>
		
		 <!-- This will make once event click it will go to method store below for whole form --> 
                 <td><button @click="store" class="btn btn-primary">ADD</button></td> 
                 <!-- <td><button  class="btn btn-primary">ADD</button></td> -->


             </tr>

             </tbody>
           </table>




    </div>
</template>


<script>
    import TaskComponent from './Task.vue'; //This is to load component so it knows it defined from Task.vue
    
    //Download packages from https://github.com/ankurk91/vue-loading-overlay
    //yum install GConf2-3.2.6-8.el7.x86_64 GConf2-devel-3.2.6-8.el7.x86_64
    //npm install vue-loading-overlay --no-optional --save
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.min.css'; //Import stylesheet


        export default{
          data(){
            return{
                isLoading: false, //This setup from vue-loading-overlay
                
                //This part is to show GET data from database
/*
                tasks: [

                  {id: 1, title: 'Task 1', priority: 'low'},
                  {id: 2, title: 'Task 2', priority: 'low'},
                  {id: 3, title: 'Task 3', priority: 'high'}

                ],
*/

                tasks: [], //This part is to show GET data from database
                task: {title: '', priority: '' }, //This is to POST/PUT data into database
                message: 'Hello From Here ...'
            }
          },

        //This to GET data from database
        methods: {
            getTasks(){
                window.axios.get('/api/tasks').then(({data})=>{ //THis will GET data from DB using then({data}) pass into forEach loop then pass it to tasks variable, then return to above tasks
                    data.forEach(task =>{
                    this.tasks.push(task)
                });
              });
            }, //Can get the URL from  php artisan route:list|egrep -i 'get|domain|---'

            store(){ //This is to save, will go to $todo/app/Http/Controllers/TaskController.php function store   
                if( this.checkInputs() ){ //This will go to method checkInputs do the checking first
        		//console.log(this.task.title + ' hahaha '+ this.task.priority ) //This will print out value input for task.title
		            window.axios.post('/api/tasks', this.task ).then( savedTask =>{
		            this.tasks.push( savedTask.data );
		  
		            this.task.title = ''; //This is for once data insert and shown, field title will be empty back
	    	    })
                }

	        },

            checkInputs(){
                //This to check if title&priority field is filled then can execute
                if( this.task.title && this.task.priority ) return true;
            },

            removed(id){ //This is to delete, will go to $todo/app/Http/Controllers/TaskController.php function destroy
                this.isLoading = true; //Take from vue-loading-overlay , will show loading circle
                //console.log(`I got the data ${id}`);  //This to test print out show data or not
                window.axios.delete(`/api/tasks/${id}`).then(()=>{
                    let index = this.tasks.findIndex( task => task.id === id ); //If the id key same with any existing id in DB then pass to index variable
                    this.tasks.splice(index,1); //splice = delete .. this function will delete the parse id
                    this.isLoading = false;

                });
                
            }


        },

        created(){      //This will be lifeCycle if everytime getTasks get updated
          this.getTasks();
        },


    components: {TaskComponent , Loading } //This to load <task-component> above , whatever that we import above must put here

        }


</script>


<style>
</style>




