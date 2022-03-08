<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Navigation Menu
    |--------------------------------------------------------------------------
    |
    | This array is for Navigation menus of the backend.  Just add/edit or
    | remove the elements from this array which will automatically change the
    | navigation.
    |
    */

    // SIDEBAR LAYOUT - MENU
    'userSidebar' =>[
        [
            'title' =>'Dashboard',
            'link'  =>'/users',
            'active'=>'users*',
            'icon'  =>'icon-fa icon-fa-dashboard',
        ],[
            'title' => 'Profile',
            'link'  => '/users/profiles',
            'active'=> 'users/profiles*',
            'icon'  => 'icon-fa icon-fa-user-circle',
        ],[
            'title' => 'Leave Application',
            'link'  => '/users/applications',
            'active'=> 'users/application*',
            'icon'  => 'icon-fa icon-fa-wpforms',
        ],[
            'title' => 'Reimbursement',
            'link'  => '#',
            'active'=> 'users/reimbursements*',
            'icon'  => 'icon-fa icon-fa-tasks',
            'children' => [
                [
                    'title' => 'Reimbursement List',
                    'link' => '/users/reimbursements',
                    'active' => 'users/reimbursements*',
                ],
                [
                    'title' => 'Approval request',
                    'link' => '/users/reimbursements/approvals',
                    'active' => 'users/reimbursements/approvals*',
                ]
            ]
        ],[
            'title' => 'Payroll',
            'link'  => '/users/payrolls',
            'active'=> 'users/payroll*',
            'icon'  => 'icon-fa icon-fa-credit-card',
            
        ],[
            'title' => 'Attendance',
            'link'  => '/users/attendances',
            'active'=> 'users/attendance*',
            'icon'  => 'icon-fa icon-fa-check-square-o',
        ],[
            'title' => 'Awards',
            'link'  => '/users/awards',
            'active'=> 'users/award*',
            'icon'  => 'icon-fa icon-fa-star',
        ]
    ],
    'sidebar' => [
        [
            'title' => 'Dashboard',
            'link' => '/admin',
            'active' => 'admin*',
            'icon' => 'icon-fa icon-fa-dashboard'
        ],[
            'title' => 'Trader',
            'link' => '#',
            'active' => 'admin/trader*',
            'icon' => 'icon-fa icon-fa-user-circle',
            'children' => [
                [
                    'title' => 'Client',
                    'link' => '/admin/client',
                    'active' => 'admin/client',
                ],
                [
                    'title' => 'Vendor',
                    'link' => '/admin/vendor',
                    'active' => 'admin/vendor',
                ]
            ]
        ],[
            'title' => 'Sales',
            'link' => '#',
            'active' => 'admin/sales*',
            'icon' => 'icon-fa icon-fa-barcode',
            'children' =>[
                [
                    'title' => 'Create Invoice',
                    'link' => '/admin/orders/create',
                    'active' => 'admin/orders/create',
                ]
                ,[
                    'title' => 'All Invoice',
                    'link' => '/admin/orders',
                    'active' => 'admin/orders',
                ],[
                    'title'=> 'Processing Order',
                    'link'=> '/admin/orders/processing',
                    'active'=>'admin/orders/processing',
                ],[
                    'title'=> 'Pending Shipment',
                    'link'=> '/admin/orders/pending',
                    'active'=> 'admin/orders/pending',
                ],[
                    'title'=>'Delivered Order',
                    'link'=> '/admin/orders/deliver',
                    'active'=> 'admin/orders/deliver',
                ],[
                    'title'=>'Quotation',
                    'link'=> '/admin/quotations/create',
                    'active'=> 'admin/quotations/create',
                ],[
                    'title'=>'All Quotation',
                    'link'=> '/admin/quotations',
                    'active'=> 'admin/quotations',
                ]
            ]
        ],[
            'title' => 'Purchase',
            'link' => '#',
            'active' => 'admin/purchase*',
            'icon' => 'icon-fa icon-fa-credit-card',
            'children' =>[
                [
                    'title' => 'New Purchase',
                    'link' => '/admin/purchases/create',
                    'active' => 'admin/purchases/create',
                ],[
                    'title' => 'Purchase List',
                    'link' => '/admin/purchases',
                    'active' => 'admin/purchases',
                ],[
                    'title'=> 'Received Product',
                    'link'=> '/admin/purchaseProduct',
                    'active'=>'admin/purchaseProduct',
                ]
            ]
        ],[
            'title' => 'Product and Services',
            'link' => '#',
            'active' => 'admin/inventory*',
            'icon' => 'icon-fa icon-fa-product-hunt',
            'children' =>[
                [
                    'title' => 'Product List',
                    'link' => '/admin/inventory',
                    'active' => 'admin/inventory',
                ],[
                    'title' => 'Import Product',
                    'link' => '/admin/inventory/import',
                    'active' => 'admin/inventory/import',
                ],[
                    'title'=> 'Category',
                    'link'=> '/admin/category',
                    'active'=>'admin/category',
                ],[
                    'title'=> 'Withdrawal',
                    'link'=> '/admin/withdrawals',
                    'active'=>'admin/withdrawals',
                ]
            ]
        ],[
            'title' => 'Employee',
            'link' => '#',
            'active' => 'admin/users*',
            'icon' => 'icon-fa icon-fa-user-plus',
            'children' =>[
                [
                    'title' => 'Add Employee',
                    'link' => 'admin/employees/create',
                    'active' => 'admin/employees/create',
                ],[
                    'title' => 'Import Employee',
                    'link' => '/admin/employees/import',
                    'active' => 'admin/employees/import',
                ],[
                    'title'=> 'Employee List',
                    'link'=> '/admin/employees',
                    'active'=>'admin/employees',
                ],[
                    'title'=> 'Terminated Employee',
                    'link'=> '/admin/employees/terminateList',
                    'active'=>'admin/employees/terminateList',
                ],[
                    'title'=> 'Employee Award',
                    'link'=> '/admin/employeeAwards',
                    'active'=>'admin/employeeAwards',
                ],[
                    'title'=> 'Set Attendance',
                    'link'=> '/admin/attendances/setAttendance',
                    'active'=>'admin/attendances/setAttendance',
                ],[
                    'title'=> 'Import Attendance',
                    'link'=> '/admin/attendances/import',
                    'active'=>'admin/attendances/import',
                ],[
                    'title'=> 'Attendance Report',
                    'link'=> '/admin/attendances/attendanceReport',
                    'active'=>'admin/attendances/attendanceReport',
                ],[
                    'title'=> 'Application List',
                    'link'=> '/admin/applications',
                    'active'=>'admin/applications',
                ],[
                    'title'=> 'Reimbursement',
                    'link'=> '/admin/reimbursements',
                    'active'=>'admin/reimbursements',
                ]
            ]
        ],[
            'title' => 'Office Settings',
            'link' => '#',
            'active' => 'admin/setting*',
            'icon' => 'icon-fa icon-fa-gear',
            'children' =>[
                [
                    'title' => 'Department',
                    'link' => '/admin/departments',
                    'active' => 'admin/departments',
                ],[
                    'title' => 'Job Titles',
                    'link' => '/admin/jobtitles',
                    'active' => 'admin/jobtitles',
                ],[
                    'title'=> 'Job Categories',
                    'link'=> '/admin/jobCategories',
                    'active'=>'admin/jobCategories',
                ],[
                    'title'=> 'Work Shifts',
                    'link'=> '/admin/workshifts',
                    'active'=>'admin/workshifts',
                ],[
                    'title'=> 'Working Days',
                    'link'=> '/admin/workingdays',
                    'active'=>'admin/workingdays',
                ],[
                    'title'=> 'Holiday List',
                    'link'=> '/admin/holidays',
                    'active'=>'admin/holidays',
                ],[
                    'title'=> 'Leave Type',
                    'link'=> '/admin/leavetypes',
                    'active'=>'admin/leavetypes',
                ],[
                    'title'=> 'Pay Grades',
                    'link'=> '/admin/paygrades',
                    'active'=>'admin/paygrades',
                ],[
                    'title'=> 'Salary Component',
                    'link'=> '/admin/salarycomponents',
                    'active'=>'admin/salarycomponents',
                ],[
                    'title'=> 'Employment Status',
                    'link'=> '/admin/employeestatus',
                    'active'=>'admin/employeestatus',
                ],[
                    'title'=> 'Tax',
                    'link'=> '/admin/taxes',
                    'active'=>'admin/taxes',
                ],[
                    'title'=> 'Role',
                    'link' => '/admin/roles',
                    'active'=>'admin/roles',
                ],[
                    'title'=> 'Permission',
                    'link' => '/admin/permissions',
                    'active'=> 'admin/permissions',
                ]
            ]
        ]
        // ,
        // [
        //     'title' => 'Settings',
        //     'link' => '#',
        //     'active' => 'admin/settings*',
        //     'icon' => 'icon-fa icon-fa-cogs',
        //     'children' => [
        //         [
        //             'title' => 'Social',
        //             'link' => '/admin/settings/social',
        //             'active' => 'admin/settings/social',
        //         ],
        //         [
        //             'title' => 'Mail',
        //             'link' => 'admin/settings/mail',
        //             'active' => 'admin/settings/mail*',
        //             'icon' => 'icon-fa icon-fa-mail',
        //         ],
        //     ]
        // ]
    
    ]
];
