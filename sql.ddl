Table Employee {
  id int [primary key]
  name varchar(255)
  national_id varchar(20)
  phone varchar(20)
  salary decimal(10, 2)
  total_advances decimal(10, 2)
  total_overtime_hours int
}

Table EmployeeOvertime{
  id int [primary key]
  employee_id int
  date date
  hours_worked decimal(5, 2)
  rate_per_hour decimal(10, 2)
  total_amount decimal(10, 2)
}

Table GasStation {
  id int [primary key]
  name varchar(255)
  owner_id int
  Workshop_id int
  current_balance decimal(10, 2)
}

Table GasStationRefill {
  id int [primary key]
  gas_station_id int
  transaction_date date
  total_amount decimal(10, 2)
  notes varchar(255)
}

Table Owners {
  id int [primary key]
  name varchar(255)
  phone varchar(20)
}

Table Vehicles {
  id int [primary key]
  name varchar(255)
  purchased_price decimal(10, 2)
  type varchar(255)
  number_or_identifier varchar(50)
  total_amount_paid_so_far decimal(10, 2)
  amount_paid_cash decimal(10, 2)
  amount_paid_checks decimal(10, 2)
 remaining_amount decimal(10, 2)
  sale_status varchar(50)
  sale_price decimal(10, 2)
}

Table WorkshopVehicles {
  id int [primary key]
  workshop_id int
  vehicle_id int
}


Table VehiclesIncome {
  id int [primary key]
  workshop_vehicle_id int
  hours_worked decimal(5, 2)
  rate_per_hour decimal(10,2)
  income decimal(10, 2)
  date date
}

Table Workshops {
  id int [primary key]
  owner_id int
  name varchar(255)
  payment_type enum(housr, contract, cups )
  type enum (workshop, sand, transportaion)
  desired_amount decimal(10,2)
  cash_payments decimal(10, 2)
  check_payments decimal(10, 2)
  remaining_balance decimal(10, 2)

}

// Table OperationalExpenses {
//   id int [primary key]
//   Workshop_id int
//   ExpenseType varchar(255)
//   date date
//   amount decimal(10, 2)
//   notes varchar(255)
// }

Table Expenses {
expense_type enum (operational, fuel_with_draw, fuel_cash, maintenance, lubrication)
id int [primary key]
amount int
date date
vehicle_id int
gas_station_id int
workshop_id int
workshop_vehicle_id int
person_name varchar(255)
notes varchar(255)
}

Table WorkshopFinancialProcess {
  id int [primary key]
  workshop_id int
  count_of_hours_or_cups decimal(5,2)
  rate_per_hour_or_cup decimal(10,2)
  total_amount decimal(10,2)

}

Table Payments {
  id int [primary key]
  payment_type enum (employee_overime, employee_advance, employee_salary, station_refill, expenses, vehichle_income, workshop_financial_process  )
  amount_type enum(cash, check)
  check_id int
  date date
  employee_overtime_id int
  employee_id int
  gas_station_refill_id int
  expense_id int
  vehicle_income_id int
  workshop_financial_process_id int
  note varchar(255)
}

Table checks {
  id int [primary key]
  amount  int
  dueDate int
  owner varchar(255)
}

Ref: EmployeeOvertime.employee_id > Employee.id



Ref: GasStationRefill.gas_station_id > GasStation.id

Ref: GasStation.owner_id > Owners.id

Ref: GasStation.Workshop_id > Workshops.id


Ref: VehiclesIncome.workshop_vehicle_id > WorkshopVehicles.id

Ref: WorkshopVehicles.workshop_id > Workshops.id
Ref: WorkshopVehicles.vehicle_id > Vehicles.id



Ref: WorkshopFinancialProcess.workshop_id > Workshops.id



Ref: "Owners"."id" < "Workshops"."owner_id"

Ref: "Workshops"."id" < "Expenses"."workshop_id"


Ref: "GasStation"."id" < "Expenses"."gas_station_id"

Ref: "WorkshopVehicles"."id" < "Expenses"."vehicle_id"

Ref: "WorkshopFinancialProcess"."id" < "Payments"."workshop_financial_process_id"

Ref: "VehiclesIncome"."id" < "Payments"."vehicle_income_id"

Ref: "Employee"."id" < "Payments"."employee_id"

Ref: "EmployeeOvertime"."id" < "Payments"."employee_overtime_id"

Ref: "GasStationRefill"."id" < "Payments"."gas_station_refill_id"

Ref: "Expenses"."id" < "Payments"."expense_id"

Ref: "checks"."id" < "Payments"."check_id"

