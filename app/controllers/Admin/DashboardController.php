<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Auth;
use App\Middleware\AdminAuthMiddleware;
use App\Services\PermissionService;

class DashboardController extends Controller
{
    public function index()
    {
        AdminAuthMiddleware::handle();

        $view = Auth::type() === 'super-admin'
            ? 'dashboard/index'
            : 'dashboard/common';

        $this->renderAdmin($view, [
            'pageTitle' => 'Dashboard',
            'dashboardCards' => $this->dashboardCards()
        ]);
    }

    public function team(): void
    {
        AdminAuthMiddleware::handle('team.dashboard');

        $this->renderAdmin('dashboard/team', [
            'pageTitle' => 'Team Dashboard',
            'dashboardType' => 'team'
        ]);
    }

    public function hr(): void
    {
        AdminAuthMiddleware::handle('hr.dashboard');

        $this->renderAdmin('dashboard/hr', [
            'pageTitle' => 'HR Dashboard',
            'dashboardType' => 'hr'
        ]);
    }

    public function account(): void
    {
        AdminAuthMiddleware::handle('account.dashboard');

        $this->renderAdmin('dashboard/account', [
            'pageTitle' => 'Account Dashboard',
            'dashboardType' => 'account'
        ]);
    }

    public function seo(): void
    {
        AdminAuthMiddleware::handle('seo.dashboard');

        $this->renderAdmin('dashboard/seo', [
            'pageTitle' => 'SEO Dashboard',
            'dashboardType' => 'seo'
        ]);
    }

    private function dashboardCards(): array
    {
        $cards = [
            ['permission' => 'leave.manage', 'title' => 'Leave Management', 'text' => 'View and manage leave records.', 'url' => BASE_URL . '/admin/leaves', 'icon' => 'bi-calendar-minus'],
            ['permission' => 'salary.view', 'title' => 'Salary Section', 'text' => 'View salary information.', 'url' => BASE_URL . '/admin/salary', 'icon' => 'bi-wallet2'],
            ['permission' => 'salary.manage', 'title' => 'Salary Management', 'text' => 'Add and edit employee salary data.', 'url' => BASE_URL . '/admin/salary', 'icon' => 'bi-cash-coin'],
            ['permission' => 'attendance.view', 'title' => 'Attendance', 'text' => 'View attendance records.', 'url' => BASE_URL . '/admin/attendance', 'icon' => 'bi-calendar2-week'],
            ['permission' => 'attendance.manage', 'title' => 'Attendance Management', 'text' => 'Manage attendance records.', 'url' => BASE_URL . '/admin/attendance', 'icon' => 'bi-calendar-check'],
            ['permission' => 'team.view', 'title' => 'Team', 'text' => 'View team members.', 'url' => BASE_URL . '/admin/teams', 'icon' => 'bi-people'],
            ['permission' => 'team.create', 'title' => 'Add Team Member', 'text' => 'Create new team member accounts.', 'url' => BASE_URL . '/admin/teams/create', 'icon' => 'bi-person-plus'],
            ['permission' => 'seo.pages.manage', 'title' => 'SEO Management', 'text' => 'Manage SEO data for frontend pages.', 'url' => BASE_URL . '/admin/seo-pages', 'icon' => 'bi-search'],
            ['permission' => 'blog.manage', 'title' => 'Blog Management', 'text' => 'Manage blog content.', 'url' => BASE_URL . '/admin/blogs', 'icon' => 'bi-journal-text'],
            ['permission' => 'project.manage', 'title' => 'Project Management', 'text' => 'Manage project content.', 'url' => BASE_URL . '/admin/projects', 'icon' => 'bi-kanban'],
            ['permission' => 'testimonial.manage', 'title' => 'Testimonials', 'text' => 'Manage testimonials.', 'url' => BASE_URL . '/admin/testimonials', 'icon' => 'bi-chat-square-quote'],
            ['permission' => 'job.manage', 'title' => 'Job Management', 'text' => 'Manage job posts.', 'url' => BASE_URL . '/admin/jobs', 'icon' => 'bi-briefcase'],
            ['permission' => 'chill-moments.manage', 'title' => 'Team Chill Moments', 'text' => 'Manage team chill moments.', 'url' => BASE_URL . '/admin/chill-moments', 'icon' => 'bi-stars'],
            ['permission' => 'user-type.manage', 'title' => 'Default Access', 'text' => 'Maintain user type permissions.', 'url' => BASE_URL . '/admin/user-types', 'icon' => 'bi-person-badge'],
            ['permission' => 'permission.manage', 'title' => 'Permissions', 'text' => 'Maintain permission definitions.', 'url' => BASE_URL . '/admin/permissions', 'icon' => 'bi-shield-lock'],
        ];

        if (Auth::type() === 'super-admin') {
            return $cards;
        }

        return array_values(array_filter($cards, static function (array $card): bool {
            return Auth::can($card['permission']);
        }));
    }
}
