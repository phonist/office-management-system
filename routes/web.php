<?php
/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
| Define the routes for your Frontend pages here
|
*/
Auth::routes();
Route::get('/', 'Auth\LoginController@showLoginForm')->name('loginForm.get');
Route::post('/logout', 'Auth\LoginController@logout')->name('logoutForm.post');
Route::get('auth/{provider}', 'AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');
Route::post('/forgot-password', 'ForgotPasswordController@postEmail')->name('send-reset-link');
// Route::get('/home', 'HomeController@index')->name('home');

Route::group([
   'prefix' => 'admin',
   'middleware' => 'auth'
], function () {
    Route::get('/', [
        'as' => 'admin.dashboard', 'uses' => 'DashboardController@basic'
    ]);
    Route::get('/chartSales','DashboardController@chartSales')->name('dashboards.chartSales');
    Route::get('/chartClients','DashboardController@chartClients')->name('dashboards.chartClients');
    Route::resource('roles','RoleController');

    //Routes for permission
    Route::resource('permissions','PermissionController');

    //Routes for payment
    // Route::post('/payment/{payment}/delete','PaymentController@delete')->name('payments.delete');
    // Route::post('/payments/add','PaymentController@add')->name('payments.add');
    Route::resource('payments','PaymentController');
    
    //Routes for purchases
    Route::get('/purchases/export','PurchaseController@export')->name('purchases.export');
    Route::get('/purchases/receive','PurchaseController@receive')->name('purchases.receive');
    // Route::post('/purchases/{purchase}/delete','PurchaseController@delete')->name('purchases.delete');
    Route::get('/purchases/{vendor}/createWithVendor','PurchaseController@createWithVendor')->name('purchases.createWithVendor');
    Route::get('/purchases/{purchase}/getBalance','PurchaseController@getBalance')->name('purchases.getBalance');
    Route::resource('purchases','PurchaseController');

    //Routes for inventory
    Route::post('/inventory/importInventory','InventoryController@importInventory')->name('inventory.importInventory');
    Route::get('/inventory/import','InventoryController@import')->name('inventory.import');
    Route::post('/inventory/delete','InventoryController@delete')->name('inventory.delete');
    Route::get('/inventory/download','InventoryController@downloadInventorySample')->name('inventory.download');
    Route::resource('inventory','InventoryController');

    //Routes for orders
    Route::get('/orders/exportOrder','OrderController@exportOrder')->name('orders.export');
    Route::get('/orders/exportProcessing','OrderController@exportProcessing')->name('orders.exportProcess');
    Route::get('/orders/exportPending','OrderController@exportPending')->name('orders.exportPending');
    Route::get('/orders/exportDeliver','OrderController@exportDeliver')->name('orders.exportDeliver');
    Route::get('/orders/processing','OrderController@process')->name('orders.process');
    Route::get('/orders/pending','OrderController@pending')->name('orders.pending');
    Route::get('/orders/deliver','OrderController@deliver')->name('orders.deliver');
    Route::get('/orders/quotation','OrderController@quotation')->name('orders.quotation');
    Route::get('/orders/all_quotation','OrderController@all_quotation')->name('orders.all_quotation');
    // Route::post('/orders/{order}/delete','OrderController@delete')->name('orders.delete');
    Route::post('/orders/{order}/updateStatusToShipping','OrderController@updateStatusToShipping')->name('orders.updateStatusToShipping');
    Route::post('/orders/{order}/updateStatusToShipped','OrderController@updateStatusToShipped')->name('orders.updateStatusToShipped');
    Route::get('/orders/{client}/createWithClient','OrderController@createWithClient')->name('orders.createWithClient');
    Route::resource('orders','OrderController');

    //user
    // Route::get('/user/award','UserController@award')->name('users.award');
    Route::get('/user/set_attendance','UserController@set_attendance')->name('users.set_attendance');
    Route::get('/user/import_attendance','UserController@import_attendance')->name('users.import_attendance');
    Route::get('/user/attendance_report','UserController@attendance_report')->name('users.attendance_report');
    Route::get('/user/application_list','UserController@application_list')->name('users.application_list');
    Route::get('/user/reimbursement','UserController@reimbursement')->name('users.reimbursement');
    // Route::post('/user/{user}/delete','UserController@delete')->name('users.delete');
    Route::post('/user/storeSkin','UserController@storeSkin')->name('users.storeSkin');
    Route::get('/user/getSkin','UserController@getSkin')->name('users.getSkin');
    Route::get('/users/export','UserController@export')->name('users.export');
    Route::resource('users','UserController');

    //Employee
    Route::get('/employees/{employee}/reportTo','EmployeeController@reportTo')->name('employees.reportTo');
    Route::get('/employees/{employee}/directDeposit','EmployeeController@directDeposit')->name('employees.directDeposit');
    Route::get('/employees/{employee}/employeeLogin','EmployeeController@employeeLogin')->name('employees.employeeLogin');
    Route::get('/employees/{employee}/employeeSalaries','EmployeeController@employeeSalaries')->name('employees.employeeSalaries');
    Route::get('/employees/{employee}/employeeCommencements','EmployeeController@employeeCommencements')->name('employees.employeeCommencements');
    Route::get('/employees/{employee}/employeeDependents','EmployeeController@employeeDependents')->name('employees.employeeDependents');
    Route::get('/employees/{employee}/contactDetails','EmployeeController@contactDetails')->name('employees.contactDetails');
    Route::post('/employees/{employee}/delete','EmployeeController@delete')->name('employees.delete');
    Route::get('/employees/import','EmployeeController@import')->name('employees.import');
    Route::get('/employees/downloadSample','EmployeeController@downloadSample')->name('employees.downloadSample');
    Route::post('/employees/importEmployee','EmployeeController@importEmployee')->name('employees.importEmployee');
    Route::get('/employees/terminateList','EmployeeController@terminateList')->name('employees.terminateList');
    Route::get('/employees/terminate','EmployeeController@terminate')->name('employees.terminate');
    Route::resource('employees','EmployeeController');

    Route::get('/email/inbox','EmailController@inbox')->name('email.inbox');
    Route::get('/email/compose','EmailController@compose')->name('email.compose');
    Route::get('/email/read','EmailController@read')->name('email.read');
    Route::resource('email','EmailController');
    //Client
    Route::post('/vendor/import','VendorController@import')->name('vendor.import');
    Route::get('/vendor/download','VendorController@downloadVendorSample')->name('vendor.download');
    Route::resource('vendor','VendorController');

    Route::post('/client/import','ClientController@import')->name('client.import');
    Route::get('/client/download','ClientController@downloadClientSample')->name('client.download');
    Route::resource('client','ClientController');
    //Vendor
    Route::get('/transaction/chart_of_accounts','TransactionController@chart_of_accounts')->name('transaction.chart_of_accounts');
    Route::get('/transaction/income_categories','TransactionController@income_categories')->name('transaction.income_categories');
    Route::get('/transaction/expense_categories','TransactionController@expense_categories')->name('transaction.expense_categories');
    Route::resource('transaction','TransactionController');

    Route::resource('depreciation','DepreciationController');

    Route::get('/payroll/make_payment','PayrollController@make_payment')->name('payroll.make_payment');
    Route::resource('payroll','PayrollController');

    Route::resource('report','ReportController');
    Route::resource('noticeboard','NoticeBoardController');
    Route::resource('admin','AdminController');

    Route::get('/officesetting/work_shifts','OfficeSettingController@work_shifts')->name('officesetting.work_shifts');
    Route::get('/officesetting/working_days','OfficeSettingController@working_days')->name('officesetting.working_days');
    Route::get('/officesetting/holiday_lists','OfficeSettingController@holiday_lists')->name('officesetting.holiday_lists');
    Route::get('/officesetting/leave_type','OfficeSettingController@leave_type')->name('officesetting.leave_type');
    Route::get('/officesetting/pay_grades','OfficeSettingController@pay_grades')->name('officesetting.pay_grades');
    Route::get('/officesetting/salary_component','OfficeSettingController@salary_component')->name('officesetting.salary_component');
    Route::get('/officesetting/employment_status','OfficeSettingController@employment_status')->name('officesetting.employment_status');
    Route::get('/officesetting/tax','OfficeSettingController@tax')->name('officesetting.tax');
    Route::resource('officesetting ','OfficeSettingController');
    
    Route::resource('setting','SettingController');

    Route::resource('category','CategoryController');
    
    Route::get('/purchaseProduct/export','PurchaseProductController@export')->name('purchaseProduct.export');
    Route::post('/purchaseProduct/{purchase}/updateReceivedAmt','PurchaseProductController@updateReceivedAmt')->name('purchaseProduct.updateReceivedAmt');
    Route::post('/purchaseProduct/{purchase}/updateReturnAmt','PurchaseProductController@updateReturnAmt')->name('purchaseProduct.updateReturnAmt');
    Route::get('/purchaseProduct/{purchaseProduct}/getName','PurchaseProductController@getName')->name('purchaseProduct.getName');
    Route::resource('purchaseProduct','PurchaseProductController');
    
    Route::get('/quotation/exportQuotation','QuotationController@exportQuotation')->name('quotation.exportQuotation');
    // Route::post('/quotation/{quotation}/delete','QuotationController@delete')->name('quotation.delete');
    Route::get('/quotation/{client}/createWithClient','QuotationController@createWithClient')->name('quotation.createWithClient');
    Route::resource('quotations','QuotationController');

    // Route::post('/withdrawals/{withdrawal}/delete','WithdrawalController@delete')->name('withdrawals.delete');
    Route::resource('withdrawals','WithdrawalController');

    Route::post('/employeeAttachments/delete','EmployeeAttachmentController@delete')->name('employeeAttachments.delete');
    Route::resource('employeeAttachments','EmployeeAttachmentController');

    Route::post('/employeeTerminations/{employeeTermination}/unterminate','EmployeeTerminationController@unterminate')->name('employeeTerminations.unterminate');
    Route::resource('employeeTerminations','EmployeeTerminationController');

    Route::resource('contactDetails','ContactDetailController');

    Route::post('/emergencyContacts/delete','EmergencyContactController@delete')->name('emergencyContacts.delete');
    Route::resource('emergencyContacts','EmergencyContactController');

    Route::post('/employeeDependents/delete','EmployeeDependentController@delete')->name('employeeDependents.delete');
    Route::resource('employeeDependents','EmployeeDependentController');

    Route::resource('employeeCommencements','EmployeeCommencementController');

    Route::post('/jobHistories/delete','JobHistoryController@delete')->name('jobHistories.delete');
    Route::resource('jobHistories','JobHistoryController');
    Route::resource('employeeSalaries','EmployeeSalaryController');

    Route::post('/employeeSupervisors/delete','EmployeeSupervisorController@delete')->name('employeeSupervisors.delete');
    Route::resource('employeeSupervisors','EmployeeSupervisorController');
    
    Route::post('/employeeSubordinates/delete','EmployeeSubordinateController@delete')->name('employeeSubordinates.delete');
    Route::resource('employeeSubordinates','EmployeeSubordinateController');

    Route::resource('employeeDirectDeposits','EmployeeDepositController');

    Route::resource('employeeLogins','EmployeeLoginController');

    // Route::post('/employeeAwards/{employeeAward}/delete','EmployeeAwardController@delete')->name('employeeAwards.delete');
    Route::resource('employeeAwards','EmployeeAwardController');

    // Route::post('/departments/{department}/delete','DepartmentController@delete')->name('departments.delete');
    Route::resource('departments','DepartmentController');

    // Route::post('/jobtitles/{jobtitle}/delete','JobTitleController@delete')->name('jobtitles.delete');
    Route::resource('jobtitles','JobTitleController');

    // Route::post('/jobCategories/{jobCategory}/delete','JobCategoryController@delete')->name('jobCategories.delete');
    Route::resource('jobCategories','JobCategoryController');

    // Route::post('/workshifts/{workshift}/delete','WorkShiftController@delete')->name('workshifts.delete');
    Route::resource('workshifts','WorkShiftController');

    Route::resource('workingdays','WorkingDayController');

    // Route::post('/holidays/{holiday}/delete','HolidayController@delete')->name('holidays.delete');
    Route::resource('holidays','HolidayController');

    // Route::post('/leavetypes/{leavetype}/delete','LeaveTypeController@delete')->name('leavetypes.delete');
    Route::resource('leavetypes','LeaveTypeController');
    
    // Route::post('/paygrades/{paygrade}/delete','PayGradeController@delete')->name('paygrades.delete');
    Route::resource('paygrades','PayGradeController');

    // Route::post('/salarycomponents/{salarycomponent}/delete','SalaryComponentController@delete')->name('salarycomponents.delete');
    Route::resource('salarycomponents','SalaryComponentController');
    
    // Route::post('/employeestatus/{employeestatus}/delete','EmployeeStatusController@delete')->name('employeestatus.delete');
    Route::resource('employeestatus','EmployeeStatusController');

    // Route::post('/taxes/{tax}/delete','TaxController@delete')->name('taxes.delete');
    Route::resource('taxes','TaxController');

    Route::get('/attendances/setAttendance','AttendanceController@setAttendance')->name('attendances.setAttendance');
    Route::post('/attendances/updateAttendance','AttendanceController@updateAttendance')->name('attendances.updateAttendance');
    // Route::post('/attendances/attendance','AttendanceController@attendance')->name('attendances.attendance');
    Route::get('/attendances/import','AttendanceController@import')->name('attendances.import');
    Route::get('/attendances/download','AttendanceController@download')->name('attendances.download');
    Route::post('/attendances/importAttendance','AttendanceController@importAttendance')->name('attendances.importAttendance');
    Route::get('/attendances/attendanceReport','AttendanceController@attendanceReport')->name('attendances.attendanceReport');
    Route::post('/attendances/setReport','AttendanceController@setReport')->name('attendances.setReport');
    Route::get('/attendances/export','AttendanceController@export')->name('attendances.export');
    Route::resource('attendances','AttendanceController');

    Route::get('/reimbursements/export','ReimbursementController@export')->name('reimbursements.export');
    // Route::post('/reimbursements/{reimbursement}/delete','ReimbursementController@delete')->name('reimbursements.delete');
    Route::resource('reimbursements','ReimbursementController');
    
    // Route::post('/applications/{application}/delete','ApplicationController@delete')->name('applications.delete');
    Route::resource('applications','ApplicationController');

});
