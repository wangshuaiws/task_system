var Vue = require('vue');
var VueResource = require('vue-resource').default;

Vue.use(VueResource);


Vue.http.headers.common['X-CSRF-TOKEN'] = $('#token').attr('content');
var resource = Vue.resource(top.location+'/steps{/id}');

new Vue({
    el:'#app',
    data:{
        steps: [
            {name: '',completed:false}
        ],
        newStep: '',
        baseUrl: top.location+'/steps'
    },
    ready:function () {
        this.fetchSteps();
    },
    methods:{
        fetchSteps:function(){
            resource.query().then((response)=>{
                //success
                this.$set('steps',response.body);
        },(response)=>{
                //error
                response.status;
            });
        },
        addStep:function (){
            resource.save('',{ name:this.newStep }).then((response)=>{
                //success
                this.newStep = '';
            this.fetchSteps();
        },(response)=>{
                //error
                response.status;
            });
        },
        toggleCompletion:function (step){
            resource.update({id:step.id},{ opposite: !step.completed}).then((response)=>{
                //success
                this.fetchSteps();
        },(response)=>{
                //error
                response.status;
            });

        },
        removeStep:function (step){
            resource.delete({id:step.id}).then(response=> {
                this.fetchSteps();
        },(response)=>{
                response.status;
            });
        },
        editStep:function (step){
            this.removeStep(step);
            this.newStep = step.name;
            // $('input').focus();
            this.$els.newstep.focus();

        },
        CompleteAll:function (){
            this.$http.post(this.baseUrl+'/completed').then((response)=>{
                //success
                this.fetchSteps();
        },(response)=>{
                //error
                response.status;
            });
        },
        clearCompletion:function (){
            this.$http.delete(this.baseUrl+'/clear').then((response)=>{
                //success
                this.fetchSteps();
        },(response)=>{
                //error
                response.status;
            });
        }
    },
    computed:{
        completions:function (){
            return this.steps.filter(function (step){
                return step.completed;
            });
        },
        remaings:function (){
            return this.steps.filter(function (step){
                return ! step.completed;
            });
        }
    },
    filters:{
        inProcess:function (steps){
            return steps.filter(function (step){
                return !step.completed;
            });
        },
        doneProcess:function (steps){
            return steps.filter(function (step){
                return step.completed;
            });
        }
    }
})