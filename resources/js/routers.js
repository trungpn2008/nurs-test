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
    },
    {
        path: '/news',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/news/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    },
    {
        path: '/fqa',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./pages/fqa/index.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'news',
    }

];
export default routers;
