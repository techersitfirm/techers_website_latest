<?php

use App\Core\Router;

Router::get(
    '/auth/login',
    'Admin\\AuthController@login'
);

Router::post(
    '/auth/login',
    'Admin\\AuthController@loginPost'
);

Router::get(
    '/login',
    'Admin\\AuthController@login'
);

Router::post(
    '/login',
    'Admin\\AuthController@loginPost'
);

Router::get(
    '/logout',
    'Admin\\AuthController@logout'
);

Router::get(
    '/admin/login',
    'Admin\\AuthController@login'
);

Router::post(
    '/admin/login',
    'Admin\\AuthController@loginPost'
);

Router::get(
    '/admin/logout',
    'Admin\\AuthController@logout'
);

Router::get(
    '/admin/dashboard',
    'Admin\\DashboardController@index'
);

// Router::get(
//     '/dashboard/team',
//     'Admin\\DashboardController@team'
// );

// Router::get(
//     '/dashboard/hr',
//     'Admin\\DashboardController@hr'
// );

// Router::get(
//     '/dashboard/account',
//     'Admin\\DashboardController@account'
// );

// Router::get(
//     '/dashboard/seo',
//     'Admin\\DashboardController@seo'
// );

Router::get(
    '/admin/attendance',
    'Admin\\WorkPageController@attendance'
);

Router::get(
    '/admin/leaves',
    'Admin\\WorkPageController@leaves'
);

Router::get(
    '/admin/salary',
    'Admin\\WorkPageController@salary'
);

Router::get(
    '/admin/seo-pages',
    'Admin\\WorkPageController@seoPages'
);

Router::get(
    '/admin/blogs',
    'Admin\\WorkPageController@blogs'
);

Router::get(
    '/admin/testimonials',
    'Admin\\WorkPageController@testimonials'
);

Router::get(
    '/admin/chill-moments',
    'Admin\\WorkPageController@chillMoments'
);

Router::get(
    '/admin/teams',
    'Admin\\TeamController@index'
);

Router::get(
    '/admin/teams/access',
    'Admin\\UserAccessController@access'
);

Router::get(
    '/admin/teams/acees',
    'Admin\\UserAccessController@access'
);

Router::get(
    '/admin/teams/create',
    'Admin\\TeamController@create'
);

Router::post(
    '/admin/teams/store',
    'Admin\\TeamController@store'
);

Router::get(
    '/admin/teams/edit',
    'Admin\\TeamController@edit'
);

Router::post(
    '/admin/teams/update',
    'Admin\\TeamController@update'
);

Router::post(
    '/admin/teams/toggle-status',
    'Admin\\TeamController@toggleStatus'
);

Router::get(
    '/admin/users',
    'Admin\\UserAccessController@users'
);

Router::get(
    '/admin/users/profile',
    'Admin\\UserAccessController@profile'
);

Router::get(
    '/admin/users/access',
    'Admin\\UserAccessController@access'
);

Router::post(
    '/admin/users/access/add',
    'Admin\\UserAccessController@addAccess'
);

Router::post(
    '/admin/users/access/revoke',
    'Admin\\UserAccessController@revokeAccess'
);

Router::post(
    '/admin/users/access/extend',
    'Admin\\UserAccessController@extendAccess'
);

Router::post(
    '/admin/users/access/remove',
    'Admin\\UserAccessController@removeAccess'
);

Router::get(
    '/admin/user-types',
    'Admin\\UserTypeController@index'
);

Router::get(
    '/admin/user-types/create',
    'Admin\\UserTypeController@create'
);

Router::post(
    '/admin/user-types/store',
    'Admin\\UserTypeController@store'
);

Router::get(
    '/admin/user-types/edit',
    'Admin\\UserTypeController@edit'
);

Router::post(
    '/admin/user-types/update',
    'Admin\\UserTypeController@update'
);

Router::get(
    '/admin/user-types/permissions',
    'Admin\\UserTypeController@permissions'
);

Router::post(
    '/admin/user-types/permissions/update',
    'Admin\\UserTypeController@permissionsUpdate'
);

Router::get(
    '/admin/permissions',
    'Admin\\PermissionController@index'
);

Router::get(
    '/admin/permissions/create',
    'Admin\\PermissionController@create'
);

Router::post(
    '/admin/permissions/store',
    'Admin\\PermissionController@store'
);

Router::post(
    '/admin/permissions/toggle-status',
    'Admin\\PermissionController@toggleStatus'
);

// Blog routes starts

Router::get(
    '/admin/blogs',
    'Admin\\BlogController@index'
);

Router::get(
    '/admin/blogs/create',
    'Admin\\BlogController@create'
);

Router::post(
    '/admin/blogs/store',
    'Admin\\BlogController@store'
);

Router::get(
    '/admin/blogs/edit',
    'Admin\\BlogController@edit'
);

Router::post(
    '/admin/blogs/update',
    'Admin\\BlogController@update'
);

Router::post(
    '/admin/blogs/toggle-status',
    'Admin\\BlogController@toggleStatus'
);

Router::post(
    '/admin/blogs/delete',
    'Admin\\BlogController@delete'
);
// Blog routes end

// Jobs routes starts

Router::get(
    '/admin/jobs',
    'Admin\\JobsController@index'
);

Router::get(
    '/admin/jobs/create',
    'Admin\\JobsController@create'
);

Router::post(
    '/admin/jobs/store',
    'Admin\\JobsController@store'
);

Router::get(
    '/admin/jobs/edit',
    'Admin\\JobsController@edit'
);

Router::post(
    '/admin/jobs/update',
    'Admin\\JobsController@update'
);

Router::post(
    '/admin/jobs/toggle-status',
    'Admin\\JobsController@toggleStatus'
);

Router::post(
    '/admin/jobs/delete',
    'Admin\\JobsController@delete'
);

// Jobs routes end

Router::get(
    '/admin/projects',
    'Admin\\ProjectController@index'
);

Router::get(
    '/admin/projects/create',
    'Admin\\ProjectController@create'
);

Router::post(
    '/admin/projects/store',
    'Admin\\ProjectController@store'
);

Router::get(
    '/admin/projects/edit',
    'Admin\\ProjectController@edit'
);

Router::post(
    '/admin/projects/update',
    'Admin\\ProjectController@update'
);

Router::post(
    '/admin/projects/toggle-status',
    'Admin\\ProjectController@toggleStatus'
);

Router::post(
    '/admin/projects/delete',
    'Admin\\ProjectController@delete'
);

Router::get('/admin/testimonials', 'Admin\\TestimonialController@index');
Router::get('/admin/testimonials/create', 'Admin\\TestimonialController@create');
Router::post('/admin/testimonials/store', 'Admin\\TestimonialController@store');
Router::get('/admin/testimonials/edit', 'Admin\\TestimonialController@edit');
Router::post('/admin/testimonials/update', 'Admin\\TestimonialController@update');
Router::post('/admin/testimonials/toggle-status', 'Admin\\TestimonialController@toggleStatus');
Router::post('/admin/testimonials/delete', 'Admin\\TestimonialController@delete');