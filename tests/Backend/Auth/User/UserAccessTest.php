<?php

use Tests\BrowserKitTestCase;

/**
 * Class UserAccessTest.
 */
class UserAccessTest extends BrowserKitTestCase
{
    public function testUserCantAccessAdminDashboard()
    {
        $this->visit('/')
             ->actingAs($this->user)
             ->visit('/admin/dashboard')
             ->seePageIs('/dashboard')
             ->see('You do not have access to do that.');
    }

    public function testExecutiveCanAccessAdminDashboard()
    {
        $this->visit('/')
             ->actingAs($this->executive)
             ->visit('/admin/dashboard')
             ->seePageIs('/admin/dashboard')
             ->see($this->executive->name);
    }

    public function testExecutiveCantAccessManageRoles()
    {
        $this->visit('/')
             ->actingAs($this->executive)
             ->visit('/admin/dashboard')
             ->seePageIs('/admin/dashboard')
             ->visit('/admin/auth/role')
             ->seePageIs('/admin/dashboard')
             ->see('You do not have access to do that.');
    }
}
