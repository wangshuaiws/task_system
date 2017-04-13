var Vue = require('vue');
var VueResource = require('vue-resource').default;

Vue.use(VueResource);

//Vue.http.headers.common['X-CSRF-TOKEN'] = $('#token').attr('content');

new Vue({
    el: '#app-navbar-collapse',
    data:{
        tasks:[

        ],
        show:true,
        searchString:" "
    },
    methods:{
        fetchTasks:function(){
            this.show = true;
            this.$http.get('/tasks/searchApi').then((response)=>{
                this.$set('tasks', response.body);
        },(response) =>{
                //error
            });
        },

        leave:function(){
            var now = this;
            setTimeout(function(){
                now.show = false;
            },1000);

        }

    },
    filters:{
        searchFor:function(tasks,searchString){
            searchString = searchString.trim().toLowerCase();

            return tasks.filter(function(task){
               if(task.title.toLowerCase().indexOf(searchString)!==-1){
                   return task;
               }
            });
        }
    }
})