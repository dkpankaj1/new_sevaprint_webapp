<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/** ################ user breadcrumb ::begin ######################### */


Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push(__('common.breadcrumb.dashboard'), route('dashboard'));
});

Breadcrumbs::for('account.profile.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(__('common.breadcrumb.account'), route('account.profile.index'));
});

Breadcrumbs::for('account.profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('account.profile.index');
    $trail->push(__('common.breadcrumb.profile update'), route('account.profile.edit'));
});

Breadcrumbs::for('account.password.change', function (BreadcrumbTrail $trail) {
    $trail->parent('account.profile.index');
    $trail->push(__('common.breadcrumb.change password'), route('account.password.change'));
});

/** ################ user breadcrumb ::begin ######################### */

/** ################ admin breadcrumb ::begin ######################### */


Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});
Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Users', route('admin.users.index'));
});
Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $trail->push('Create', route('admin.users.create'));
});
Breadcrumbs::for('admin.users.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Show', route('admin.users.show', $user));
});
Breadcrumbs::for('admin.users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $trail->push('Edit', route('admin.users.edit', $user));
});


Breadcrumbs::for('admin.server.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Server Manager', route('admin.server.index'));
});



Breadcrumbs::for('admin.settings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Setting', route('admin.settings.index'));
});

Breadcrumbs::for('admin.settings.brand', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.settings.index');
    $trail->push('Brand', route('admin.settings.brand'));
});

Breadcrumbs::for('admin.settings.general', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.settings.index');
    $trail->push('General', route('admin.settings.general'));
});

Breadcrumbs::for('admin.settings.email', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.settings.index');
    $trail->push('Email', route('admin.settings.email'));
});




Breadcrumbs::for('admin.account.profile.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Account', route('admin.account.profile.index'));
});

Breadcrumbs::for('admin.account.profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.account.profile.index');
    $trail->push('Update Profile', route('admin.account.profile.edit'));
});

Breadcrumbs::for('admin.account.password.change', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.account.profile.index');
    $trail->push('Change Password', route('admin.account.password.change'));
});

/** ################ admin breadcrumb ::begin ######################### */
