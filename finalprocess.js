window.onload = function() {
    const form = document.querySelector("form");
    const base_salaryInput = document.getElementById("base_salary");
    const errorBase_salary = document.getElementById("error_base_salary");
    const overtimeInput = document.getElementById("overtime");
    const errorOvertime = document.getElementById("error_overtime");
    const bonusInput = document.getElementById("bonus");
    const errorBonus = document.getElementById("error_bonus");
    const commissionInput = document.getElementById("commission");
    const errorCommission = document.getElementById("error_commission");
    const houseRentInput = document.getElementById("houseRent");
    const errorHouseRent = document.getElementById("error_houseRent");
    const transport_allowanceInput = document.getElementById("transport_allowance");
    const errorTransport_allowance = document.getElementById("error_transport_allowance");
    const medical_allowanceInput = document.getElementById("medical_allowance");
    const errorMedical_allowance = document.getElementById("error_medical_allowance");
    const phone_allowanceInput = document.getElementById("phone_allowance");
    const errorPhone_allowance = document.getElementById("error_phone_allowance");
    const food_allowanceInput = document.getElementById("food_allowance");
    const errorFood_allowance = document.getElementById("error_food_allowance");
    const tax_deductionsInput = document.getElementById("tax_deductions");
    const errorTax_deductions = document.getElementById("error_tax_deductions");
    const insurenceInput = document.getElementById("insurence");
    const errorInsurence = document.getElementById("error_insurence");
    const totalpresentInput = document.getElementById("totalpresent");
    const errorTotalpresent = document.getElementById("error_totalpresent");
    const totalupsentInput = document.getElementById("totalupsent");
    const errorTotalupsent = document.getElementById("error_totalupsent");
    const totaldaysInput = document.getElementById("totaldays");
    const errorTotaldays = document.getElementById("error_totaldays");
    const pay_monthInput = document.getElementById("pay_month");
    const errorPay_month = document.getElementById("error_pay_month");
    const other_deductionsInput = document.getElementById("other_deductions");
    const errorOther_deductions = document.getElementById("error_other_deductions");
    const retirementInput = document.getElementById("retirement");
    const errorRetirement = document.getElementById("error_retirement");
    form.addEventListener("submit", function(event) {
        event.preventDefault();

        if (validateForm()) {
            form.submit();
        }
    });
    base_salaryInput.addEventListener("input", function(event) {
        baseValidation(event, base_salaryInput, errorBase_salary);
    });

    base_salaryInput.addEventListener("blur", function(event) {
        baseValidation(event, base_salaryInput, errorBase_salary);
    });

    overtimeInput.addEventListener("input", function(event) {
        overtimeValidation(event, overtimeInput, errorOvertime);
    });

    overtimeInput.addEventListener("blur", function(event) {
        overtimeValidation(event, overtimeInput, errorOvertime);
    });
    bonusInput.addEventListener("input", function(event) {
        bonusValidation(event, bonusInput, errorBonus);
    });

    bonusInput.addEventListener("blur", function(event) {
        bonusValidation(event, bonusInput, errorBonus);
    });

    commissionInput.addEventListener("input", function(event) {
        commissionValidation(event, commissionInput, errorCommission);
    });

    commissionInput.addEventListener("blur", function(event) {
        commissionValidation(event, commissionInput, errorCommission);
    });
    houseRentInput.addEventListener("input", function(event) {
        rentValidation(event, houseRentInput, errorHouseRent);
    });

    houseRentInput.addEventListener("blur", function(event) {
        rentValidation(event, houseRentInput, errorHouseRent);
    });
    transport_allowanceInput.addEventListener("input", function(event) {
        transportValidation(event, transport_allowanceInput, errorTransport_allowance);
    });

    transport_allowanceInput.addEventListener("blur", function(event) {
        transportValidation(event, transport_allowanceInput, errorTransport_allowance);
    });
    medical_allowanceInput.addEventListener("input", function(event) {
        medicalValidation(event, medical_allowanceInput, errorMedical_allowance);
    });

    medical_allowanceInput.addEventListener("blur", function(event) {
        medicalValidation(event, medical_allowanceInput, errorMedical_allowance);
    });
    pay_monthInput.addEventListener("input", function(event) {
        paymonthValidation(event, pay_monthInput, errorMedical_allowance);
    });

    pay_monthInput.addEventListener("blur", function(event) {
        paymonthValidation(event, pay_monthInput, errorMedical_allowance);
    });

    phone_allowanceInput.addEventListener("input", function(event) {
        phoneValidation(event, phone_allowanceInput, errorPhone_allowance);
    });

    phone_allowanceInput.addEventListener("blur", function(event) {
        phoneValidation(event, phone_allowanceInput, errorPhone_allowance);
    });
    food_allowanceInput.addEventListener("input", function(event) {
        foodValidation(event, food_allowanceInput, errorFood_allowance);
    });

    food_allowanceInput.addEventListener("blur", function(event) {
        foodValidation(event, food_allowanceInput, errorFood_allowance);
    });
    tax_deductionsInput.addEventListener("input", function(event) {
        taxValidation(event, tax_deductionsInput, errorTax_deductions);
    });

    tax_deductionsInput.addEventListener("blur", function(event) {
        taxValidation(event, tax_deductionsInput, errorTax_deductions);
    });

    insurenceInput.addEventListener("input", function(event) {
        insurenceValidation(event, insurenceInput, errorInsurence);
    });

    insurenceInput.addEventListener("blur", function(event) {
        insurenceValidation(event, insurenceInput, errorInsurence);
    });
    other_deductionsInput.addEventListener("input", function(event) {
        deductionsValidation(event, other_deductionsInput, errorOther_deductions);
    });

    other_deductionsInput.addEventListener("blur", function(event) {
        deductionsValidation(event, other_deductionsInput, errorOther_deductions);
    });

    retirementInput.addEventListener("input", function(event) {
        retirementValidation(event, retirementInput, errorRetirement);
    });
    retirementInput.addEventListener("blur", function(event) {
        retirementValidation(event, retirementInput, errorRetirement);
    });
    totalupsentInput.addEventListener("input", function(event) {
        upsentValidation(event, totalupsentInput, errorMedical_allowance);
    });

    totalupsentInput.addEventListener("blur", function(event) {
        upsentValidation(event, totalupsentInput, errorMedical_allowance);
    });
    totalpresentInput.addEventListener("input", function(event) {
        presentValidation(event, totalpresentInput, errorMedical_allowance);
    });

    totalpresentInput.addEventListener("blur", function(event) {
        presentValidation(event, totalpresentInput, errorMedical_allowance);
    });

    totaldaysInput.addEventListener("input", function(event) {
        calculateTotalDays()(event, totaldaysInput, errorPhone_allowance);
    });

    totaldaysInput.addEventListener("blur", function(event) {
        calculateTotalDays()(event, totaldaysInput, errorPhone_allowance);
    });


    function validateForm() {
        let isValid = true;

        if (base_salaryInput.value.trim() === "") {
            showError(base_salaryInput, errorBase_salary, "Basic salary is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(base_salaryInput.value);

            if (isNaN(numericValue) || numericValue < 10000 || numericValue > 1000000) {
                showError(base_salaryInput, errorBase_salary, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(base_salaryInput, errorBase_salary);
            }
        }

        if (overtimeInput.value.trim() === "") {
            showError(overtimeInput, errorOvertime, "Overtime is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(overtimeInput.value);

            if (isNaN(numericValue) || numericValue < 1000 || numericValue > 10000) {
                showError(overtimeInput, errorOvertime, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(overtimeInput, errorOvertime);
            }
        }
        if (bonusInput.value.trim() === "") {
            showError(bonusInput, errorBonus, "Bonus  is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(bonusInput.value);

            if (isNaN(numericValue) || numericValue < 1000 || numericValue > 10000) {
                showError(bonusInput, errorBonus, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(bonusInput, errorBonus);
            }
        }

        if (commissionInput.value.trim() === "") {
            showError(commissionInput, errorCommission, "Commission field is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(commissionInput.value);

            if (isNaN(numericValue) || numericValue < 100 || numericValue > 1000) {
                showError(commissionInput, errorCommission, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(commissionInput, errorCommission);
            }
        }
        if (houseRentInput.value.trim() === "") {
            showError(houseRentInput, errorHouseRent, "House Rent Allowances is required");
            isValid = false;
        } else {
            const numericValue = parseInt(houseRentInput.value);

            if (isNaN(numericValue) || numericValue < 1000 || numericValue > 5000) {
                showError(houseRentInput, errorHouseRent, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(houseRentInput, errorHouseRent);
            }
        }

        if (transport_allowanceInput.value.trim() === "") {
            showError(transport_allowanceInput, errorTransport_allowance, "Transport Allowance is required");
            isValid = false;
        } else {
            const numericValue = parseInt(transport_allowanceInput.value);

            if (isNaN(numericValue) || numericValue < 1000 || numericValue > 4000) {
                showError(transport_allowanceInput, errorTransport_allowance, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(transport_allowanceInput, errorTransport_allowance);
            }
        }

        if (medical_allowanceInput.value.trim() === "") {
            showError(medical_allowanceInput, errorMedical_allowance, "Medical Allowance is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(medical_allowanceInput.value);

            if (isNaN(numericValue) || numericValue < 1000 || numericValue > 100000) {
                showError(medical_allowanceInput, errorMedical_allowance, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(medical_allowanceInput, errorMedical_allowance);
            }
        }

        if (phone_allowanceInput.value.trim() === "") {
            showError(phone_allowanceInput, errorPhone_allowance, "Phone Allowances is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(phone_allowanceInput.value);

            if (isNaN(numericValue) || numericValue < 500 || numericValue > 1000) {
                showError(phone_allowanceInput, errorPhone_allowance, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(phone_allowanceInput, errorPhone_allowance);
            }
        }
        if (food_allowanceInput.value.trim() === "") {
            showError(food_allowanceInput, errorFood_allowance, "Food Allowances is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(food_allowanceInput.value);

            if (isNaN(numericValue) || numericValue < 1000 || numericValue > 5000) {
                showError(food_allowanceInput, errorFood_allowance, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(food_allowanceInput, errorFood_allowance);
            }
        }
        if (totalupsentInput.value.trim() === "") {
            showError(totalupsentInput, errorTotalupsent, "Total leave days  is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(totalupsentInput.value);

            if (isNaN(numericValue) || numericValue < 0 || numericValue > 31) {
                showError(totalupsentInput, errorTotalupsent, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(totalupsentInput, errorTotalupsent);
            }
        }

        if (totalpresentInput.value.trim() === "") {
            showError(totalpresentInput, errorTotalpresent, "No off present days  is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(totalpresentInput.value);

            if (isNaN(numericValue) || numericValue < 0 || numericValue > 31) {
                showError(totalpresentInput, errorTotalpresent, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(totalpresentInput, errorTotalpresent);
            }
        }
        if (totaldaysInput.value.trim() === "") {
            showError(totaldaysInput, errorTotaldays, "Total Days  is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(totaldaysInput.value);

            if (isNaN(numericValue) || numericValue < 1 || numericValue > 31) {
                showError(totaldaysInput, errorTotaldays, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(totaldaysInput, errorTotaldays);
            }
        }
        if (tax_deductionsInput.value.trim() === "") {
            showError(tax_deductionsInput, errorTax_deductions, "Tax Deductions is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(tax_deductionsInput.value);

            if (isNaN(numericValue) || numericValue < 1000 || numericValue > 5000) {
                showError(tax_deductionsInput, errorTax_deductions, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(tax_deductionsInput, errorTax_deductions);
            }
        }


        if (insurenceInput.value.trim() === "") {
            showError(insurenceInput, errorInsurence, "Insurence  is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(insurenceInput.value);

            if (isNaN(numericValue) || numericValue < 100 || numericValue > 5000) {
                showError(insurenceInput, errorInsurence, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(insurenceInput, errorInsurence);
            }
        }

        if (other_deductionsInput.value.trim() === "") {
            showError(other_deductionsInput, errorOther_deductions, "Other deductions is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(other_deductionsInput.value);

            if (isNaN(numericValue) || numericValue < 1000 || numericValue > 10000) {
                showError(other_deductionsInput, errorOther_deductions, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(other_deductionsInput, errorOther_deductions);
            }
        }
        if (retirementInput.value.trim() === "") {
            showError(retirementInput, errorRetirement, "Retirement is Required");
            isValid = false;
        } else {
            const numericValue = parseInt(retirementInput.value);

            if (isNaN(numericValue) || numericValue < 1000 || numericValue > 10000) {
                showError(retirementInput, errorRetirement, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(retirementInput, errorRetirement);
            }
        }

        // Check if the input is empty or starts with a space
        if (pay_monthInput.value.trim() === "") {
            showError(pay_monthInput, errorPay_month, "Pay month is required");
            isValid = false;
        } else {
            // Get the current date
            const currentDate = new Date();

            // Extract the entered year and month from the input value
            const enteredYear = parseInt(pay_monthInput.value.substring(0, 4));
            const enteredMonth = parseInt(pay_monthInput.value.substring(5, 7));

            // Check if the entered date is within the specified range
            if (
                (enteredYear === currentDate.getFullYear() - 1 && enteredMonth >= 1 && enteredMonth <= 12) ||
                (enteredYear === currentDate.getFullYear() && enteredMonth >= 1 && enteredMonth <= currentDate.getMonth() + 1)
            ) {
                hideError(pay_monthInput, errorPay_month);
            } else {
                showError(
                    pay_monthInput,
                    errorPay_month,
                    "Please enter a valid date within the range of the last month of the previous year and the current month of the current year."
                );
                isValid = false;
            }
        }

        return isValid;
    }

    function baseValidation() {
        const base_salaryInput = event.target;
        const errorElement = document.getElementById("error_base_salary");

        // Check for leading spaces
        if (base_salaryInput.value.trim() === "" || base_salaryInput.value.startsWith(" ")) {
            showError(base_salaryInput, errorElement, "Please fill in the field without leading spaces.");
        } else {
            const retirementValue = parseInt(base_salaryInput.value);

            if (isNaN(retirementValue) || retirementValue < 10000 || retirementValue > 100000) {
                showError(base_salaryInput, errorElement, "Please enter a valid amount between 10000 and 100000.");
            } else {
                hideError(base_salaryInput, errorElement);
            }
        }
    }

    function overtimeValidation(event) {
        const overtimeInput = event.target;
        const errorElement = document.getElementById("error_overtime");

        if (overtimeInput.value.trim() === "" || overtimeInput.value.startsWith(" ")) {
            showError(overtimeInput, errorElement, "Please fill in the field.");
        } else {
            const retirementValue = parseInt(overtimeInput.value);

            if (isNaN(retirementValue) || retirementValue < 1000 || retirementValue > 10000) {
                showError(overtimeInput, errorElement, "Please enter a valid amount between 1000 and 10000.");
            } else {
                hideError(overtimeInput, errorElement);
            }
        }
    }

    function taxValidation(event) {
        const tax_deductionsInput = event.target;
        const errorElement = document.getElementById("error_tax_deductions");

        if (tax_deductionsInput.value.trim() === "" || tax_deductionsInput.value.startsWith(" ")) {
            showError(tax_deductionsInput, errorElement, "Please fill in the field.");
        } else {
            const retirementValue = parseInt(tax_deductionsInput.value);

            if (isNaN(retirementValue) || retirementValue < 1000 || retirementValue > 10000) {
                showError(tax_deductionsInput, errorElement, "Please enter a valid amount between 1000 and 10000.");
            } else {
                hideError(tax_deductionsInput, errorElement);
            }
        }
    }

    function bonusValidation(event) {
        const bonusInput = event.target;
        const errorElement = document.getElementById("error_bonus");

        if (bonusInput.value.trim() === "" || bonusInput.value.startsWith(" ")) {
            showError(bonusInput, errorElement, "Please fill in the field.");
        } else {
            const retirementValue = parseInt(bonusInput.value);

            if (isNaN(retirementValue) || retirementValue < 1000 || retirementValue > 10000) {
                showError(bonusInput, errorElement, "Please enter a valid amount between 1000 and 10000.");
            } else {
                hideError(bonusInput, errorElement);
            }
        }
    }

    function commissionValidation(event) {
        const commissionInput = event.target;
        const errorElement = document.getElementById("error_commission");

        if (commissionInput.value.trim() === "" || commissionInput.value.startsWith(" ")) {
            showError(commissionInput, errorElement, "Please fill in the field.");
        } else {
            const retirementValue = parseInt(commissionInput.value);

            if (isNaN(retirementValue) || retirementValue < 100 || retirementValue > 1000) {
                showError(commissionInput, errorElement, "Please enter a valid amount between 100 and 1000.");
            } else {
                hideError(commissionInput, errorElement);
            }
        }
    }

    function paymonthValidation(event) {
        const pay_monthInput = event.target;
        const errorPay_month = document.getElementById("error_pay_month");
        let isValid = true;

        /// Check if the input is empty or starts with a space
        // Check if the input is empty or starts with a space
        if (pay_monthInput.value.trim() === "") {
            showError(pay_monthInput, errorPay_month, "Pay month is required");
            isValid = false;
        } else {
            // Get the current date
            const currentDate = new Date();

            // Extract the entered year and month from the input value
            const enteredYear = parseInt(pay_monthInput.value.substring(0, 4));
            const enteredMonth = parseInt(pay_monthInput.value.substring(5, 7));

            // Check if the entered date is within the specified range
            if (
                (enteredYear === currentDate.getFullYear() - 1 && enteredMonth >= 1 && enteredMonth <= 12) ||
                (enteredYear === currentDate.getFullYear() && enteredMonth >= 1 && enteredMonth <= currentDate.getMonth() + 1)
            ) {
                hideError(pay_monthInput, errorPay_month);
            } else {
                showError(
                    pay_monthInput,
                    errorPay_month,
                    "Please enter a valid date within the range of the last month of the previous year and the current month of the current year."
                );
                isValid = false;
            }
        }


        return isValid;
    }

    function bonusValidation(event) {
        const bonusInput = event.target;
        const errorElement = document.getElementById("error_bonus");

        if (bonusInput.value.trim() === "" || bonusInput.value.startsWith(" ")) {
            showError(bonusInput, errorElement, "Please fill in the field.");
        } else {
            const retirementValue = parseInt(bonusInput.value);

            if (isNaN(retirementValue) || retirementValue < 1000 || retirementValue > 10000) {
                showError(bonusInput, errorElement, "Please enter a valid amount between 1000 and 10000.");
            } else {
                hideError(bonusInput, errorElement);
            }
        }
    }

    function rentValidation(event) {
        const houseRentInput = event.target;
        const errorElement = document.getElementById("error_houseRent");

        if (houseRentInput.value.trim() === "" || houseRentInput.value.startsWith(" ")) {
            showError(houseRentInput, errorElement, "Please fill in the field and didnot start with space.");
        } else {
            const retirementValue = parseInt(houseRentInput.value);

            if (isNaN(retirementValue) || retirementValue < 1000 || retirementValue > 5000) {
                showError(houseRentInput, errorElement, "Please enter a valid amount between 1000 and 5000.");
            } else {
                hideError(houseRentInput, errorElement);
            }
        }
    }


    function upsentValidation(event) {
        const totalupsentInput = event.target;
        const errorElement = document.getElementById("error_totalupsent");

        if (totalupsentInput.value.trim() === "" || totalupsentInput.value.startsWith(" ")) {
            showError(totalupsentInput, errorElement, "Please fill in the field.");
        } else {
            const retirementValue = parseInt(totalupsentInput.value);

            if (isNaN(retirementValue) || retirementValue < 0 || retirementValue > 31) {
                showError(totalupsentInput, errorElement, "Please enter a valid days between 1 and 31.");
            } else {
                hideError(totalupsentInput, errorElement);
            }
        }
    }

    function presentValidation(event) {
        const totalpresentInput = event.target;
        const errorElement = document.getElementById("error_totalpresent");

        if (totalpresentInput.value.trim() === "" || totalpresentInput.value.startsWith(" ")) {
            showError(totalpresentInput, errorElement, "Please fill in the field.");
        } else {
            const retirementValue = parseInt(totalpresentInput.value);

            if (isNaN(retirementValue) || retirementValue < 0 || retirementValue > 31) {
                showError(totalpresentInput, errorElement, "Please enter a valid days between 1 and 31.");
            } else {
                hideError(totalpresentInput, errorElement);
            }
        }
    }

    function medicalValidation(event) {
        const medical_allowanceInput = event.target;
        const errorElement = document.getElementById("error_medical_allowance");

        if (medical_allowanceInput.value.trim() === "" || medical_allowanceInput.value.startsWith(" ")) {
            showError(medical_allowanceInput, errorElement, "Please fill in the field.");
        } else {
            const taxValue = parseInt(medical_allowanceInput.value);

            if (isNaN(taxValue) || taxValue < 1000 || taxValue > 100000) {
                showError(medical_allowanceInput, errorElement, "Please enter a valid amount between 1000 and 100000.");
            } else {
                hideError(medical_allowanceInput, errorElement);
            }
        }
    }

    function transportValidation(event) {
        const transport_allowanceInput = event.target;
        const errorElement = document.getElementById("error_transport_allowance");

        if (transport_allowanceInput.value.trim() === "" || transport_allowanceInput.value.startsWith(" ")) {
            showError(transport_allowanceInput, errorElement, "Please fill in the field.");
        } else {
            const taxValue = parseInt(transport_allowanceInput.value);

            if (isNaN(taxValue) || taxValue < 1000 || taxValue > 4000) {
                showError(transport_allowanceInput, errorElement, "Please enter a valid amount between 1000 and 4000.");
            } else {
                hideError(transport_allowanceInput, errorElement);
            }
        }
    }

    function foodValidation(event) {
        const food_allowanceInput = event.target;
        const errorElement = document.getElementById("error_food_allowance");

        if (food_allowanceInput.value.trim() === "" || food_allowanceInput.value.startsWith(" ")) {
            showError(food_allowanceInput, errorElement, "Please fill in the field.");
        } else {
            const taxValue = parseInt(food_allowanceInput.value);

            if (isNaN(taxValue) || taxValue < 1000 || taxValue > 5000) {
                showError(food_allowanceInput, errorElement, "Please enter a valid amount between 1000 and 5000.");
            } else {
                hideError(food_allowanceInput, errorElement);
            }
        }
    }

    function phoneValidation(event) {
        const phone_allowanceInput = event.target;
        const errorElement = document.getElementById("error_phone_allowance");

        if (phone_allowanceInput.value.trim() === "" || phone_allowanceInput.value.startsWith(" ")) {
            showError(phone_allowanceInput, errorElement, "Please fill in the field.");
        } else {
            const taxValue = parseInt(phone_allowanceInput.value);

            if (isNaN(taxValue) || taxValue < 500 || taxValue > 1000) {
                showError(phone_allowanceInput, errorElement, "Please enter a valid amount between 500 and 1000.");
            } else {
                hideError(phone_allowanceInput, errorElement);
            }
        }
    }


    function insurenceValidation(event) {
        const insurenceInput = event.target;
        const errorElement = document.getElementById("error_insurence");

        if (insurenceInput.value.trim() === "" || insurenceInput.value.startsWith(" ")) {
            showError(insurenceInput, errorElement, "Please fill in the field.");
        } else {
            const retirementValue = parseInt(insurenceInput.value);

            if (isNaN(retirementValue) || retirementValue < 100 || retirementValue > 10000) {
                showError(insurenceInput, errorElement, "Please enter a valid amount between 100 and 10000.");
            } else {
                hideError(insurenceInput, errorElement);
            }
        }
    }

    function deductionsValidation(event) {
        const other_deductionsInput = event.target;
        const errorElement = document.getElementById("error_other_deductions");

        if (other_deductionsInput.value.trim() === "" || other_deductionsInput.value.startsWith(" ")) {
            showError(other_deductionsInput, errorElement, "Please fill in the field.");
        } else {
            const retirementValue = parseInt(other_deductionsInput.value);

            if (isNaN(retirementValue) || retirementValue < 1000 || retirementValue > 10000) {
                showError(other_deductionsInput, errorElement, "Please enter a valid amount between 1000 and 10000.");
            } else {
                hideError(other_deductionsInput, errorElement);
            }
        }
    }

    function retirementValidation(event) {
        const retirementInput = event.target;
        const errorElement = document.getElementById("error_retirement");

        if (retirementInput.value.trim() === "" || retirementInput.value.startsWith(" ")) {
            showError(retirementInput, errorElement, "Please fill in the field.");
        } else {
            const retirementValue = parseInt(retirementInput.value);

            if (isNaN(retirementValue) || retirementValue < 1000 || retirementValue > 10000) {
                showError(retirementInput, errorElement, "Please enter a valid amount between 1000 and 10000.");
            } else {
                hideError(retirementInput, errorElement);
            }
        }
    }

    function showError(inputElement, errorElement, errorMessage) {
        if (inputElement && errorElement) {
            inputElement.classList.add("error-input");
            errorElement.textContent = errorMessage;
            errorElement.classList.remove("hide");
            errorElement.classList.add("show");
        } else {
            console.error("Invalid input element or value in showError");
        }
    }

    function hideError(inputElement, errorElement) {
        if (inputElement && errorElement) {
            inputElement.classList.remove("error-input");
            errorElement.classList.remove("show");
            errorElement.classList.add("hide");
            errorElement.textContent = "";
        } else {
            console.error("Invalid input element or value in hideError");
        }
    }

    function hideErrorMessageOnFocus(inputId, errorId) {
        const inputElement = document.getElementById(inputId);
        const errorElement = document.getElementById(errorId);

        if (inputElement && errorElement) {
            inputElement.addEventListener("focus", function() {
                hideError(inputElement, errorElement);
            });
        }
    }
};