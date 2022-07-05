import home from './components/home/home'
import home2 from './components/home/home2'
import home3 from './components/home/home3'
import frontend from "./layouts/frontend";
const routers = [
    {
        path: '/home',
        component: home,
        name: 'pc-top1',
    }, {
        path: '/',
        component: home,
        name: 'pc-top1',
    },
    {
        path: '/home2',
        component: home3,
        name: 'pc-top2',
    }
];
export default routers;
