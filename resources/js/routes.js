import User from './components/UserCompenent.vue'
import Task from './components/TaskCompenent.vue'

export const routes = [
    {
        path:'/users',
        component:User
    },
    {
        path:'/tasks',
        component:Task
    },
];
