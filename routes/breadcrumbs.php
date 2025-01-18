<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/** ################ user breadcrumb ::begin ######################### */


Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push(__('common.breadcrumb.dashboard'), route('dashboard'));
});


Breadcrumbs::for('wallet.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push("Wallet", route('wallet.index'));
});

Breadcrumbs::for('wallet.recharge', function (BreadcrumbTrail $trail) {
    $trail->parent('wallet.index');
    $trail->push("Recharge", route('wallet.recharge'));
});


Breadcrumbs::for('mobile-recharge.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push("Mobile Recharge", route('mobile-recharge.index'));
});
Breadcrumbs::for('mobile-recharge.create', function (BreadcrumbTrail $trail) {
    $trail->parent('mobile-recharge.index');
    $trail->push("Create", route('mobile-recharge.create'));
});
Breadcrumbs::for('mobile-recharge.show', function (BreadcrumbTrail $trail, $mobileRecharge) {
    $trail->parent('mobile-recharge.index');
    $trail->push("Show", route('mobile-recharge.show', $mobileRecharge));
});


Breadcrumbs::for('nsdl.transaction-status', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push("Transaction Status", route('nsdl.transaction-status'));
});
Breadcrumbs::for('nsdl.pan-status', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push("PAN Status", route('nsdl.pan-status'));
});

Breadcrumbs::for('nsdl.pan-card.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push("PanCard", route('nsdl.pan-card.index'));
});
Breadcrumbs::for('nsdl.pan-card.create', function (BreadcrumbTrail $trail) {
    $trail->parent('nsdl.pan-card.index');
    $trail->push("Create", route('nsdl.pan-card.create'));
});
Breadcrumbs::for('nsdl.pan-card.show', function (BreadcrumbTrail $trail,$t) {
    $trail->parent('nsdl.pan-card.index');
    $trail->push("Show", route('nsdl.pan-card.show',$t));
});
Breadcrumbs::for('nsdl.pan-card.edit', function (BreadcrumbTrail $trail,$t) {
    $trail->parent('nsdl.pan-card.index');
    $trail->push("Edit", route('nsdl.pan-card.edit',$t));
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


Breadcrumbs::for('admin.balance-transfer.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Balance Transfer', route('admin.balance-transfer.index'));
});
Breadcrumbs::for('admin.balance-transfer.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.balance-transfer.index');
    $trail->push('Create', route('admin.balance-transfer.create'));
});
Breadcrumbs::for('admin.balance-transfer.show', function (BreadcrumbTrail $trail, $balance_transfer) {
    $trail->parent('admin.balance-transfer.index');
    $trail->push('Show', route('admin.balance-transfer.show', $balance_transfer));
});
Breadcrumbs::for('admin.balance-transfer.edit', function (BreadcrumbTrail $trail, $balance_transfer) {
    $trail->parent('admin.balance-transfer.index');
    $trail->push('Edit', route('admin.balance-transfer.edit', $balance_transfer));
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


Breadcrumbs::for('admin.mobile-recharge.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push("Mobile Recharge", route('admin.mobile-recharge.index'));
});
Breadcrumbs::for('admin.mobile-recharge.show', function (BreadcrumbTrail $trail, $mobileRecharge) {
    $trail->parent('admin.mobile-recharge.index');
    $trail->push("Show", route('admin.mobile-recharge.show', $mobileRecharge));
});


Breadcrumbs::for('admin.server.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Server Manager', route('admin.server.index'));
});

Breadcrumbs::for('admin.feature.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Feature', route('admin.feature.index'));
});
Breadcrumbs::for('admin.feature.show', function (BreadcrumbTrail $trail, $service) {
    $trail->parent('admin.feature.index');
    $trail->push('Show', route('admin.feature.show', $service));
});
Breadcrumbs::for('admin.feature.edit', function (BreadcrumbTrail $trail, $service) {
    $trail->parent('admin.feature.index');
    $trail->push('Edit', route('admin.feature.edit', $service));
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

Breadcrumbs::for('admin.settings.payment-getaway', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.settings.index');
    $trail->push('Payment Getaway', route('admin.settings.payment-getaway'));
});

Breadcrumbs::for('admin.messages.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Messages', route('admin.messages.index'));
});

Breadcrumbs::for('admin.messages.show', function (BreadcrumbTrail $trail, $msg) {
    $trail->parent('admin.messages.index');
    $trail->push('Detail', route('admin.messages.show', $msg));
});


// --------------------------------------------------------------------------------------------

Breadcrumbs::for('admin.website.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Website Setting', route('admin.website.index'));
});

Breadcrumbs::for('admin.website.text-slider.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.website.index');
    $trail->push('Text Slider', route('admin.website.text-slider.index'));
});
Breadcrumbs::for('admin.website.text-slider.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.website.text-slider.index');
    $trail->push('Create', route('admin.website.text-slider.create'));
});
Breadcrumbs::for('admin.website.text-slider.show', function (BreadcrumbTrail $trail, $textSlider) {
    $trail->parent('admin.website.text-slider.index');
    $trail->push('Show', route('admin.website.text-slider.show', $textSlider));
});
Breadcrumbs::for('admin.website.text-slider.edit', function (BreadcrumbTrail $trail, $textSlider) {
    $trail->parent('admin.website.text-slider.index');
    $trail->push('Edit', route('admin.website.text-slider.edit', $textSlider));
});


Breadcrumbs::for('admin.website.our-services.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.website.index');
    $trail->push('Our Services', route('admin.website.our-services.index'));
});
Breadcrumbs::for('admin.website.our-services.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.website.our-services.index');
    $trail->push('Create', route('admin.website.our-services.create'));
});
Breadcrumbs::for('admin.website.our-services.show', function (BreadcrumbTrail $trail, $services) {
    $trail->parent('admin.website.our-services.index');
    $trail->push('Show', route('admin.website.our-services.show', $services));
});
Breadcrumbs::for('admin.website.our-services.edit', function (BreadcrumbTrail $trail, $services) {
    $trail->parent('admin.website.our-services.index');
    $trail->push('Edit', route('admin.website.our-services.edit', $services));
});

Breadcrumbs::for('admin.website.videos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.website.index');
    $trail->push('Videos', route('admin.website.videos.index'));
});
Breadcrumbs::for('admin.website.videos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.website.videos.index');
    $trail->push('Create', route('admin.website.videos.create'));
});
Breadcrumbs::for('admin.website.videos.show', function (BreadcrumbTrail $trail, $videos) {
    $trail->parent('admin.website.videos.index');
    $trail->push('Show', route('admin.website.videos.show', $videos));
});
Breadcrumbs::for('admin.website.videos.edit', function (BreadcrumbTrail $trail, $videos) {
    $trail->parent('admin.website.videos.index');
    $trail->push('Edit', route('admin.website.videos.edit', $videos));
});

Breadcrumbs::for('admin.website.about-us.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.website.index');
    $trail->push('About US', route('admin.website.about-us.edit'));
});

// --------------------------------------------------------------------------------------------

Breadcrumbs::for('admin.transaction.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Transaction', route('admin.transaction.index'));
});

Breadcrumbs::for('admin.transaction.show', function (BreadcrumbTrail $trail, $transaction) {
    $trail->parent('admin.transaction.index');
    $trail->push('Show', route('admin.transaction.show', $transaction));
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
