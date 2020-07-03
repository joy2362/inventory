let login = require('./components/auth/login').default;
let register = require('./components/auth/register').default;
let forget = require('./components/auth/forgetpass').default;
let logout = require('./components/auth/logout').default;


//after login component
let home = require('./components/home').default;

//employee route
let addEmployee = require('./components/employee/addEmployee').default;
let allEmployee = require('./components/employee/allEmployee').default;
let editEmployee = require('./components/employee/edit').default;

//supplier route
let addSupplier = require('./components/supplier/add').default;
let allSupplier = require('./components/supplier/show').default;
let editSupplier = require('./components/supplier/edit').default;

//category route
let addCategory = require('./components/category/add').default;
let allCategory = require('./components/category/index').default;
let editCategory = require('./components/category/edit').default;

//product route
let addProduct = require('./components/product/add').default;
let allProduct = require('./components/product/index').default;
let editProduct = require('./components/product/edit').default;
let showProduct = require('./components/product/show').default;

//expense route
let addExpense = require('./components/expense/add').default;
let allExpense = require('./components/expense/index').default;
let editExpense = require('./components/expense/edit').default;

export const routes = [
    { path: '/', component: login  , name:'index'},
    { path: '/logout', component: logout , name:'logout'},
    { path: '/register', component: register },
    { path: '/forget', component: forget },

    { path: '/home', component: home , name:'home'},

    { path: '/add/employee', component: addEmployee , name:'addEmployee'},
    { path: '/all/employee', component: allEmployee , name:'allEmployee'},
    { path: '/edit/employee/:id', component: editEmployee , name:'edit/employee'},

    { path: '/add/supplier', component: addSupplier , name:'addSupplier'},
    { path: '/all/supplier', component: allSupplier , name:'allSupplier'},
    { path: '/edit/supplier/:id', component: editSupplier , name:'editSupplier'},

    { path: '/add/category', component: addCategory , name:'addCategory'},
    { path: '/all/category', component: allCategory , name:'allCategory'},
    { path: '/edit/category/:id', component: editCategory , name:'editCategory'},

    { path: '/add/product', component: addProduct , name:'addProduct'},
    { path: '/all/product', component: allProduct , name:'allProduct'},
    { path: '/edit/product/:id', component: editProduct , name:'editProduct'},
    { path: '/show/product/:id', component: showProduct , name:'showProduct'},

    { path: '/add/expense', component: addExpense , name:'addExpense'},
    { path: '/all/expense', component: allExpense , name:'allExpense'},
    { path: '/edit/expense/:id', component: editExpense , name:'editExpense'},
]
