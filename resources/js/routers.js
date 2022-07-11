const routers = [
    {
        path: '/',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/home.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/home',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/home2.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
    {
        path: '/home2',
        components: {
            header:()=> import('./layouts/header.vue'),
            default:()=> import('./page/home3.vue'),
            footer:()=> import('./layouts/footer.vue'),
        },
        name: 'pc-top1',
    },
];
export default routers;
