import home from './components/home/home'
import home2 from './components/home/home2'
import frontend from "./layouts/frontend";
const routers = [
    {
        path: '/home',
        component: home,
        name: 'pc-top1',
    }, {
        path: '/',
        component: frontend,
        name: 'pc-top1',
    },
    {
        path: '/home2',
        component: home2,
        name: 'pc-top2',
    }
];
export default routers;
