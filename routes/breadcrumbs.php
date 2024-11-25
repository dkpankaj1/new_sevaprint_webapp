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
    $trail->push('Users', route('admin.users.index'));
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
