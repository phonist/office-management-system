<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\IClientRepository;
use App\Repositories\Eloquents\ClientRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\Eloquents\UserRepository;
use App\Repositories\Interfaces\IVendorRepository;
use App\Repositories\Eloquents\VendorRepository;
use App\Repositories\Interfaces\IOrderRepository;
use App\Repositories\Eloquents\OrderRepository;
use App\Repositories\Interfaces\IPaymentRepository;
use App\Repositories\Eloquents\PaymentRepository;
use App\Repositories\Interfaces\IInventoryRepository;
use App\Repositories\Eloquents\InventoryRepository;
use App\Repositories\Interfaces\ISaleProductRepository;
use App\Repositories\Eloquents\SaleProductRepository;
use App\Repositories\Interfaces\IPurchaseRepository;
use App\Repositories\Eloquents\PurchaseRepository;
use App\Repositories\Interfaces\IQuotationRepository;
use App\Repositories\Eloquents\QuotationRepository;
use App\Repositories\Interfaces\IQuotationProductRepository;
use App\Repositories\Eloquents\QuotationProductRepository;
use App\Repositories\Interfaces\IPurchaseProductRepository;
use App\Repositories\Eloquents\PurchaseProductRepository;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Eloquents\CategoryRepository;
use App\Repositories\Interfaces\ITaxRepository;
use App\Repositories\Eloquents\TaxRepository;
use App\Repositories\Interfaces\IWithdrawalRepository;
use App\Repositories\Eloquents\WithdrawalRepository;
use App\Repositories\Interfaces\IRoleRepository;
use App\Repositories\Eloquents\RoleRepository;
use App\Repositories\Interfaces\IEmployeeRepository;
use App\Repositories\Eloquents\EmployeeRepository;
use App\Repositories\Interfaces\IRoleEmployeeRepository;
use App\Repositories\Eloquents\RoleEmployeeRepository;
use App\Repositories\Interfaces\IEmployeeAttachmentRepository;
use App\Repositories\Eloquents\EmployeeAttachmentRepository;
use App\Repositories\Interfaces\IEmployeeSupervisorRepository;
use App\Repositories\Eloquents\EmployeeSupervisorRepository;
use App\Repositories\Interfaces\IEmployeeSubordinateRepository;
use App\Repositories\Eloquents\EmployeeSubordinateRepository;
use App\Repositories\Interfaces\IDepartmentRepository;
use App\Repositories\Eloquents\DepartmentRepository;
use App\Repositories\Interfaces\IEmployeeDepositRepository;
use App\Repositories\Eloquents\EmployeeDepositRepository;
use App\Repositories\Interfaces\IEmployeeLoginRepository;
use App\Repositories\Eloquents\EmployeeLoginRepository;
use App\Repositories\Interfaces\IContactDetailRepository;
use App\Repositories\Eloquents\ContactDetailRepository;
use App\Repositories\Interfaces\IEmployeeDependentRepository;
use App\Repositories\Eloquents\EmployeeDependentRepository;
use App\Repositories\Interfaces\IEmployeeCommencementRepository;
use App\Repositories\Eloquents\EmployeeCommencementRepository;
use App\Repositories\Interfaces\IJobHistoryRepository;
use App\Repositories\Eloquents\JobHistoryRepository;
use App\Repositories\Interfaces\IEmployeeStatusRepository;
use App\Repositories\Eloquents\EmployeeStatusRepository;
use App\Repositories\Interfaces\IJobTitleRepository;
use App\Repositories\Eloquents\JobTitleRepository;
use App\Repositories\Interfaces\IWorkShiftRepository;
use App\Repositories\Eloquents\WorkShiftRepository;
use App\Repositories\Interfaces\IJobCategoryRepository;
use App\Repositories\Eloquents\JobCategoryRepository;
use App\Repositories\Interfaces\IEmployeeSalaryRepository;
use App\Repositories\Eloquents\EmployeeSalaryRepository;
use App\Repositories\Interfaces\IEmployeeAwardRepository;
use App\Repositories\Eloquents\EmployeeAwardRepository;
use App\Repositories\Interfaces\IAttendanceRepository;
use App\Repositories\Eloquents\AttendanceRepository;
use App\Repositories\Interfaces\ILeaveTypeRepository;
use App\Repositories\Eloquents\LeaveTypeRepository;
use App\Repositories\Interfaces\IApplicationRepository;
use App\Repositories\Eloquents\ApplicationRepository;
use App\Repositories\Interfaces\IReimbursementRepository;
use App\Repositories\Eloquents\ReimbursementRepository;
use App\Repositories\Interfaces\IWorkingDayRepository;
use App\Repositories\Eloquents\WorkingDayRepository;
use App\Repositories\Interfaces\IHolidayRepository;
use App\Repositories\Eloquents\HolidayRepository;
use App\Repositories\Interfaces\IPayGradeRepository;
use App\Repositories\Eloquents\PayGradeRepository;
use App\Repositories\Interfaces\ISalaryComponentRepository;
use App\Repositories\Eloquents\SalaryComponentRepository;
use App\Repositories\Interfaces\IPermissionRepository;
use App\Repositories\Eloquents\PermissionRepository;
use App\Repositories\Interfaces\IPermissionRoleRepository;
use App\Repositories\Eloquents\PermissionRoleRepository;
use App\Repositories\Interfaces\IEmployeeTerminationRepository;
use App\Repositories\Eloquents\EmployeeTerminationRepository;
use App\Repositories\Interfaces\IEmergencyContactRepository;
use App\Repositories\Eloquents\EmergencyContactRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IClientRepository::class, ClientRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IVendorRepository::class, VendorRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(IPaymentRepository::class, PaymentRepository::class);
        $this->app->bind(IInventoryRepository::class, InventoryRepository::class);
        $this->app->bind(ISaleProductRepository::class, SaleProductRepository::class);
        $this->app->bind(IPurchaseRepository::class, PurchaseRepository::class);
        $this->app->bind(IQuotationRepository::class, QuotationRepository::class);
        $this->app->bind(IQuotationProductRepository::class, QuotationProductRepository::class);
        $this->app->bind(IPurchaseProductRepository::class, PurchaseProductRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(ITaxRepository::class, TaxRepository::class);
        $this->app->bind(IWithdrawalRepository::class, WithdrawalRepository::class);
        $this->app->bind(IRoleRepository::class, RoleRepository::class);
        $this->app->bind(IEmployeeRepository::class, EmployeeRepository::class);
        $this->app->bind(IRoleEmployeeRepository::class, RoleEmployeeRepository::class);
        $this->app->bind(IEmployeeAttachmentRepository::class, EmployeeAttachmentRepository::class);
        $this->app->bind(IEmployeeSupervisorRepository::class, EmployeeSupervisorRepository::class);
        $this->app->bind(IEmployeeSubordinateRepository::class, EmployeeSubordinateRepository::class);
        $this->app->bind(IDepartmentRepository::class, DepartmentRepository::class);
        $this->app->bind(IEmployeeDepositRepository::class, EmployeeDepositRepository::class);
        $this->app->bind(IEmployeeLoginRepository::class, EmployeeLoginRepository::class);
        $this->app->bind(IContactDetailRepository::class, ContactDetailRepository::class);
        $this->app->bind(IEmployeeDependentRepository::class, EmployeeDependentRepository::class);
        $this->app->bind(IEmployeeCommencementRepository::class, EmployeeCommencementRepository::class);
        $this->app->bind(IJobHistoryRepository::class, JobHistoryRepository::class);
        $this->app->bind(IEmployeeStatusRepository::class, EmployeeStatusRepository::class);
        $this->app->bind(IWorkShiftRepository::class, WorkShiftRepository::class);
        $this->app->bind(IJobTitleRepository::class, JobTitleRepository::class);
        $this->app->bind(IJobCategoryRepository::class, JobCategoryRepository::class);
        $this->app->bind(IEmployeeSalaryRepository::class, EmployeeSalaryRepository::class);
        $this->app->bind(IEmployeeAwardRepository::class, EmployeeAwardRepository::class);
        $this->app->bind(IAttendanceRepository::class, AttendanceRepository::class);
        $this->app->bind(ILeaveTypeRepository::class, LeaveTypeRepository::class);
        $this->app->bind(IApplicationRepository::class, ApplicationRepository::class);
        $this->app->bind(IReimbursementRepository::class, ReimbursementRepository::class);
        $this->app->bind(IWorkingDayRepository::class, WorkingDayRepository::class);
        $this->app->bind(IHolidayRepository::class, HolidayRepository::class);
        $this->app->bind(IPayGradeRepository::class, PayGradeRepository::class);
        $this->app->bind(ISalaryComponentRepository::class, SalaryComponentRepository::class);
        $this->app->bind(IPermissionRepository::class, PermissionRepository::class);
        $this->app->bind(IPermissionRoleRepository::class, PermissionRoleRepository::class);
        $this->app->bind(IEmployeeTerminationRepository::class, EmployeeTerminationRepository::class);
        $this->app->bind(IEmergencyContactRepository::class, EmergencyContactRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
