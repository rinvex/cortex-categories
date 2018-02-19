<?php

declare(strict_types=1);

use Rinvex\Categories\Models\Category;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;

Breadcrumbs::register('adminarea.categories.index', function (BreadcrumbsGenerator $breadcrumbs) {
    $breadcrumbs->push('<i class="fa fa-dashboard"></i> '.trans('cortex/foundation::common.adminarea'), route('adminarea.home'));
    $breadcrumbs->push(trans('cortex/categories::common.categories'), route('adminarea.categories.index'));
});

Breadcrumbs::register('adminarea.categories.create', function (BreadcrumbsGenerator $breadcrumbs) {
    $breadcrumbs->parent('adminarea.categories.index');
    $breadcrumbs->push(trans('cortex/categories::common.create_category'), route('adminarea.categories.create'));
});

Breadcrumbs::register('adminarea.categories.edit', function (BreadcrumbsGenerator $breadcrumbs, Category $category) {
    $breadcrumbs->parent('adminarea.categories.index');
    $breadcrumbs->push($category->title, route('adminarea.categories.edit', ['category' => $category]));
});

Breadcrumbs::register('adminarea.categories.logs', function (BreadcrumbsGenerator $breadcrumbs, Category $category) {
    $breadcrumbs->parent('adminarea.categories.index');
    $breadcrumbs->push($category->title, route('adminarea.categories.edit', ['category' => $category]));
    $breadcrumbs->push(trans('cortex/categories::common.logs'), route('adminarea.categories.logs', ['category' => $category]));
});
