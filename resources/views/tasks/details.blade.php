@extends('layouts.app');

@section('content')
    <div id="app" class="container">
        <h2 v-show="remaings.length">待完成的步骤(@{{ remaings.length }})
            <span class="btn btn-sm btn-info" @click="CompleteAll">清除所有已完成的</span>
        </h2>
        <ul class="list-group">
                <li class="list-group-item" v-for="step in steps | inProcess">
                    <span @dblclick="editStep(step)">@{{ step.name  }}</span>
                    <span class="pull-right">
                    <i class="fa fa-check" @click="toggleCompletion(step)"></i>
                    <i class="fa fa-close" @click="removeStep(step)"></i>
                    </span>
                </li>
        </ul>

        <form @submit.prevent="addStep" class="form-inline form-inline-fullwidth">
            <div class="form-group col-md-8">
            <input type="text" v-model="newStep" v-el:newstep class="form-control" placeholder="I need to">
            </div>
            <div class="form-group col-md-4">
            <button type="submit" class="btn btn-primary">添加步骤</button>
             </div>
        </form>
        <div class="clearfix"></div>
        <h2 v-show="completions.length">已完成的步骤(@{{ completions.length }})
            <span class="btn btn-sm btn-danger" @click="clearCompletion">清除所有已完成的</span>
        </h2>
        <ul class="list-group">
            <li class="list-group-item" v-for="step in steps | doneProcess">@{{ step.name  }}
                <div class="pull-right">
                    <i class="fa fa-check" @click="toggleCompletion(step)"></i>
                    <i class="fa fa-close" @click="removeStep(step)"></i>
                </div>
            </li>
        </ul>

        <pre>@{{ $data | json }}</pre>
    </div>


@endsection



@section('customJS')
    <script src="{{ asset('js/vue.js') }}"></script>
    <script>
        new Vue({
            el:'#app',
            data:{
                steps: [
                    { name: 'fix bug',completed:false},
                    { name: 'metting',completed:false}
                ],
                newStep:''
            },
            methods:{
                addStep(){
                    this.steps.push( { name:this.newStep,completed:false});
                    this.newStep = '';
                },
                toggleCompletion(step){
                     step.completed = ! step.completed;
                },
                removeStep(step){
                    this.steps.$remove(step);
                },
                editStep(step){
                    this.removeStep(step);
                    this.newStep = step.name;
                   // $('input').focus();
                    this.$els.newstep.focus();

                },
                CompleteAll(step){
                    this.steps.forEach(function(step){
                        step.completed = true;
                    });
                },
                clearCompletion(step){
                    this.steps = this.steps.filter(function (step) {
                        return !step.completed;
                    });
                }
            },
            computed:{
              completions(){
                  return this.steps.filter(function (step){
                     return step.completed;
                  });
              },
              remaings(){
                  return this.steps.filter(function (step){
                      return ! step.completed;
                  });
                }
            },
            filters:{
                inProcess(steps){
                    return steps.filter(function (step){
                       return ! step.completed;
                    });
                },
                doneProcess(steps){
                    return steps.filter(function (step){
                        return step.completed;
                    });
                }
            }
        })
    </script>
@endsection




