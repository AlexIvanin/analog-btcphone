export default [
  { path: '/admin', name: 'home', component: require('~/pages/home') },
  { path: '/admin/auth', name: 'auth', component: require('~/pages/auth/login') },
  { path: '/admin/settings', name: 'settings', component: require('~/pages/settings') },
  { path: '/admin/requests', name: 'requests', component: require('~/pages/requests/index') },
  { path: '/admin/requests/:id', name: 'requestsID', component: require('~/pages/requests/id') },
  // Authenticated routes.
  ...middleware('auth', [
   

   
  ]),

  // Guest routes.
  ...middleware('guest', [
  
  ]),

  { path: '*', component: require('~/pages/errors/404.vue') }
]

/**
 * @param  {String|Function} middleware
 * @param  {Array} routes
 * @return {Array}
 */
function middleware (middleware, routes) {
  routes.forEach(route =>
    (route.middleware || (route.middleware = [])).unshift(middleware)
  )

  return routes
}
