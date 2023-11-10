<?php

use App\Models\CompanyEmployee;

$company_employee = CompanyEmployee::query()->where('employee_id', $entry->id)->first();
if (isset($company_employee)) {
    echo $company_employee->company->first_name;
} else {
    echo '--';
}
?>
