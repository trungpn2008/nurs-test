const routers = [
    {
        path: '/',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/home/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'home',
    },
    {
        path: '/homes',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/homes/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'homes',
    },
    {
        path: '/introduction',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/introduction/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'homes',
    }

];
export default routers;
