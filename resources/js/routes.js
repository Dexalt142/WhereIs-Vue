import PlaceIndex from './components/PlaceIndex.vue';
import PlaceCreate from './components/PlaceCreate.vue';
import PlaceDetail from './components/PlaceDetail.vue';
import PlaceEdit from './components/PlaceEdit.vue';

const routes = [
    {
        name: 'index',
        path: '/',
        component: PlaceIndex
    },
    {
        name: 'create',
        path: '/add',
        component: PlaceCreate
    },
    {
        name: 'detail',
        path: '/detail/:id',
        component: PlaceDetail
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: PlaceEdit
    }
];

export default routes;