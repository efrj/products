import { createRouter, createWebHistory } from 'vue-router';
import ListCategories from './components/ListCategories.vue';
import CreateCategory from './components/CreateCategory.vue';
import EditCategory from './components/EditCategory.vue';
import ListProducts from './components/ListProducts.vue';

const routes = [
  {
    path: '/categorias',
    name: 'Categorias',
    component: ListCategories
  },
  {
    path: '/categorias/criar',
    name: 'CriarCategoria',
    component: CreateCategory
  },
  {
    path: '/categorias/editar/:id',
    name: 'EditarCategoria',
    component: EditCategory
  },
  {
    path: '/produtos',
    name: 'Produtos',
    component: ListProducts
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
