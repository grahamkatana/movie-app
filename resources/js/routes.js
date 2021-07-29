import AllMovies from './components/AllMovies.vue';
import Show from './components/Show.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllMovies
    },
    {
        name: 'show',
        path: '/show/:id',
        component: Show
    },
   
];
