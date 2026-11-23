<?php

namespace app\controllers\Admin;

use app\core\Controller;
use app\middleware\AdminAuthMiddleware;

class WorkPageController extends Controller
{
    public function attendance(): void
    {
        $this->handleAny(['attendance.view', 'attendance.manage']);

        $this->renderAdmin('work-pages/attendance', [
            'pageTitle' => 'Attendance'
        ]);
    }

    public function leaves(): void
    {
        AdminAuthMiddleware::handle('leave.manage');

        $this->renderAdmin('work-pages/leaves', [
            'pageTitle' => 'Leave Management'
        ]);
    }

    public function salary(): void
    {
        $this->handleAny(['salary.view', 'salary.manage']);

        $this->renderAdmin('work-pages/salary', [
            'pageTitle' => 'Salary'
        ]);
    }

    public function seoPages(): void
    {
        AdminAuthMiddleware::handle('seo.pages.manage');

        $this->renderAdmin('work-pages/seo-pages', [
            'pageTitle' => 'SEO Pages'
        ]);
    }

    public function blogs(): void
    {
        AdminAuthMiddleware::handle('blog.manage');

        $this->renderAdmin('work-pages/blogs', [
            'pageTitle' => 'Blog Management'
        ]);
    }

    public function projects(): void
    {
        AdminAuthMiddleware::handle('project.manage');

        $this->renderAdmin('work-pages/projects', [
            'pageTitle' => 'Project Management'
        ]);
    }

    public function testimonials(): void
    {
        AdminAuthMiddleware::handle('testimonial.manage');

        $this->renderAdmin('work-pages/testimonials', [
            'pageTitle' => 'Testimonial Management'
        ]);
    }

    public function jobs(): void
    {
        AdminAuthMiddleware::handle('job.manage');

        $this->renderAdmin('work-pages/jobs', [
            'pageTitle' => 'Job Management'
        ]);
    }

    public function chillMoments(): void
    {
        AdminAuthMiddleware::handle('chill-moments.manage');

        $this->renderAdmin('work-pages/chill-moments', [
            'pageTitle' => 'Team Chill Moments'
        ]);
    }

    private function handleAny(array $permissions): void
    {
        if (($_SESSION['user_type'] ?? '') === 'super-admin') {
            return;
        }

        foreach ($permissions as $permission) {
            if (\app\core\Auth::can($permission)) {
                return;
            }
        }

        AdminAuthMiddleware::handle($permissions[0]);
    }
}
