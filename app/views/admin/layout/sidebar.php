<?php

$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');

if ($basePath !== '' && $basePath !== '/' && str_starts_with($currentPath, $basePath)) {
    $currentPath = substr($currentPath, strlen($basePath)) ?: '/';
}

$can = static fn (string $permission): bool => \app\core\Auth::can($permission);

$isActive = static function (array $paths) use ($currentPath): string {
    return in_array($currentPath, $paths, true) ? ' active' : '';
};

$navItems = [
    [
        'label' => 'Dashboard',
        'url' => $baseUrl . '/admin/dashboard',
        'icon' => 'bi-speedometer2',
        'paths' => ['/admin/dashboard'],
        'show' => true,
    ],

    [
        'label' => 'Blogs Management',
        'url' => $baseUrl . '/admin/blogs',
        'icon' => 'bi-journal-text',
        'paths' => ['/admin/blogs'],
        'show' => $can('blog.manage'),
    ],

    [
        'label' => 'Projects Management',
        'url' => $baseUrl . '/admin/projects',
        'icon' => 'bi-kanban',
        'paths' => [
            '/admin/projects',
            '/admin/projects/create',
            '/admin/projects/edit'
        ],
        'show' => $can('project.manage'),
    ],

    [
        'label' => 'Testimonials',
        'url' => $baseUrl . '/admin/testimonials',
        'icon' => 'bi-chat-quote',
        'paths' => [
            '/admin/testimonials',
            '/admin/testimonials/create',
            '/admin/testimonials/edit'
        ],
        'show' => $can('testimonial.manage'),
    ],

    [
        'label' => 'Jobs Management',
        'url' => $baseUrl . '/admin/jobs',
        'icon' => 'bi-briefcase',
        'paths' => [
            '/admin/jobs',
            '/admin/jobs/create',
            '/admin/jobs/edit'
        ],
        'show' => $can('job.manage'),
    ],

    [
        'label' => 'Team Members',
        'url' => $baseUrl . '/admin/teams',
        'icon' => 'bi-person-lines-fill',
        'paths' => ['/admin/teams'],
        'show' => $can('team.view'),
    ],

    [
        'label' => 'SEO Pages',
        'url' => $baseUrl . '/admin/seo-pages',
        'icon' => 'bi-file-earmark-text',
        'paths' => ['/admin/seo-pages'],
        'show' => $can('seo.pages.manage'),
    ],

    [
        'label' => 'User Types',
        'url' => $baseUrl . '/admin/user-types',
        'icon' => 'bi-person-badge',
        'paths' => ['/admin/user-types'],
        'show' => $can('user-type.manage'),
    ],

    [
        'label' => 'Permissions',
        'url' => $baseUrl . '/admin/permissions',
        'icon' => 'bi-lock',
        'paths' => ['/admin/permissions'],
        'show' => $can('permission.manage'),
    ],
];

?>

<div class="sidebar">
    <div class="sidebar-header">
        <div class="logo-text">Techers</div>
    </div>

    <div class="nav flex-column">
        <?php foreach ($navItems as $item): ?>
            <?php if (!$item['show']) {
                continue;
            } ?>
            <a
                href="<?= htmlspecialchars($item['url']) ?>"
                class="nav-link<?= $isActive($item['paths']) ?>">
                <i class="bi <?= htmlspecialchars($item['icon']) ?>"></i>
                <span><?= htmlspecialchars($item['label']) ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</div>
