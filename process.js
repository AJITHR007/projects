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
    const allowancesInput = document.getElementById("allowances");
    const errorAllowances = document.getElementById("error_allowances");
    const tax_deductionsInput = document.getElementById("tax_deductions");
    const errorTax_deductions = document.getElementById("error_tax_deductions");
    const insurenceInput = document.getElementById("insurence");
    const errorInsurence = document.getElementById("error_insurence");
    const other_deductionsInput = document.getElementById("other_deductions");
    const errorOther_deductions = document.getElementById("error_other_deductions");
    const retirementInput = document.getElementById("retirement");
    const errorRetirement = document.getElementById("error_retirement");
    const startDateInput = document.getElementById("startDate");
    const errorStartDate = document.getElementById("error_startDate");
    const enddateInput = document.getElementById("enddate");
    const errorEnddate = document.getElementById("error_enddate");

    const company_addressInput = document.getElementById("company_address");
    const errorCompany_address = document.getElementById("error_company_address");
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
        rentValidation(event, commissionInput, errorCommission);
    });

    commissionInput.addEventListener("blur", function(event) {
        rentValidation(event, commissionInput, errorCommission);
    });
    allowancesInput.addEventListener("input", function(event) {
        transportValidation(event, allowancesInput, errorAllowances);
    });

    allowancesInput.addEventListener("blur", function(event) {
        transportValidation(event, allowancesInput, errorAllowances);
    });
    tax_deductionsInput.addEventListener("input", function(event) {
        taxValidation(event, tax_deductionsInput, errorTax_deductions);
    });

    tax_deductionsInput.addEventListener("blur", function(event) {
        taxValidation(event, tax_deductionsInput, errorTax_deductions);
    });

    insurenceInput.addEventListener("input", function(event) {
        phoneValidation(event, insurenceInput, errorInsurence);
    });

    insurenceInput.addEventListener("blur", function(event) {
        phoneValidation(event, insurenceInput, errorInsurence);
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
    startDateInput.addEventListener("input", function(event) {
        startdateValidation(event, startDateInput, errorStartDate);
    });

    startDateInput.addEventListener("blur", function(event) {
        startdateValidation(event, startDateInput, errorStartDate);
    });

    enddateInput.addEventListener("input", function(event) {
        enddateValidation(event, enddateInput, errorEnddate);
    });
    enddateInput.addEventListener("blur", function(event) {
        enddateValidation(event, enddateInput, errorEnddate);
    });



    company_addressInput.addEventListener("blur", function(event) {
        caddressValidation(event, company_addressInput, errorCompany_address);
    });
    company_addressInput.addEventListener("input", function(event) {
        caddressValidation(event, company_addressInput, errorCompany_address);
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

        if (allowancesInput.value.trim() === "") {
            showError(allowancesInput, errorAllowances, "Allowances is required");
            isValid = false;
        } else {
            const numericValue = parseInt(allowancesInput.value);

            if (isNaN(numericValue) || numericValue < 1000 || numericValue > 10000) {
                showError(allowancesInput, errorAllowances, "Please enter a valid amount");
                isValid = false;
            } else {
                hideError(allowancesInput, errorAllowances);
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
        // ...

        if (enddateInput.value.trim() === "") {
            showError(enddateInput, errorEnddate, "Pay process End date is Required");
            isValid = false;
        } else {
            const currentDate = new Date();
            const selectedDate = new Date(enddateInput.value);

            // Calculate the date one year ago from the current date
            const lastYear = new Date();
            lastYear.setFullYear(currentDate.getFullYear() - 1);

            if (selectedDate < lastYear || selectedDate > currentDate) {
                showError(enddateInput, errorEnddate, "Please choose a date After Start Date and current date to today");
                return false;
            } else {
                hideError(enddateInput, errorEnddate);
            }
        }

        if (startDateInput.value.trim() === "") {
            showError(startDateInput, errorStartDate, "Pay Process start Date  is Required");
            isValid = false;
        } else {
            const currentDate = new Date();
            const selectedDate = new Date(startDateInput.value);

            // Calculate the date one year ago from the current date
            const lastYear = new Date();
            lastYear.setFullYear(currentDate.getFullYear() - 1);

            if (selectedDate < lastYear || selectedDate > currentDate) {
                showError(startDateInput, errorStartDate, "Please choose a date within the last year and up to today");
                return false;
            } else {
                hideError(startDateInput, errorStartDate);
            }
        }

        if (!validateDates()) {
            isValid = false;
        }



        const company_address = company_addressInput.value;

        if (company_address === "") {
            showError(company_addressInput, errorCompany_address, "Company Address is Required");
            isValid = false;
        } else if (company_address.startsWith(" ")) {
            showError(company_addressInput, errorCompany_address, 'Company address should not start with a space.');
            isValid = false;
            hideErrorMessageOnFocus('company_address', 'error_company_address');
        } else if (/\s{2,}/.test(company_addressInput.value)) {
            showError(company_addressInput, errorCompany_address, 'Company address should not contain consecutive spaces.');
            isValid = false;
            hideErrorMessageOnFocus('company_address', 'error_company_address');
        } else if (company_address.length < 5) {
            showError(company_addressInput, errorCompany_address, 'Reason should be at least 5 characters long.');
            isValid = false;
            hideErrorMessageOnFocus('company_address', 'error_company_address');
        } else if (company_address.length > 250) {
            showError(company_addressInput, errorCompany_address, 'Reason should not exceed 250 characters.');
            isValid = false;
            hideErrorMessageOnFocus('company_address', 'error_company_address');
        } else if (!/^[a-zA-Z\s]+$/.test(company_address)) {
            showError(company_addressInput, errorCompany_address, 'Invalid input. Use only letters and spaces.');
            isValid = false;
            hideErrorMessageOnFocus('company_address', 'error_company_address');
        } else {
            hideError(company_addressInput, errorCompany_address);
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

    function rentValidation(event) {
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

    function transportValidation(event) {
        const allowancesInput = event.target;
        const errorElement = document.getElementById("error_allowances");

        if (allowancesInput.value.trim() === "" || allowancesInput.value.startsWith(" ")) {
            showError(allowancesInput, errorElement, "Please fill in the field and didnot start with space.");
        } else {
            const retirementValue = parseInt(allowancesInput.value);

            if (isNaN(retirementValue) || retirementValue < 1000 || retirementValue > 5000) {
                showError(allowancesInput, errorElement, "Please enter a valid amount between 1000 and 5000.");
            } else {
                hideError(allowancesInput, errorElement);
            }
        }
    }

    function phoneValidation(event) {
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

    function startdateValidation(event) {
        const startDateInput = event.target;
        const errorElement = document.getElementById("error_startDate");

        if (startDateInput.value.trim() === "" || startDateInput.value.startsWith(" ")) {
            showError(startDateInput, errorElement, "Please fill in the field.");
        } else {
            const currentDate = new Date();
            const inputDate = new Date(startDateInput.value);

            // Calculate the date one year ago from the current date
            const oneYearAgo = new Date(currentDate);
            oneYearAgo.setFullYear(currentDate.getFullYear() - 1);

            // Check if the input date is within the previous one year and the current month
            if (inputDate < oneYearAgo || inputDate > currentDate) {
                showError(startDateInput, errorElement, "Please enter a date within the previous one year and the current month.");
            } else {
                hideError(startDateInput, errorElement);
            }
        }
    }

    function enddateValidation(event) {
        const enddateInput = event.target;
        const errorElement = document.getElementById("error_enddate");

        if (enddateInput.value.trim() === "" || enddateInput.value.startsWith(" ")) {
            showError(enddateInput, errorElement, "Please fill in the field.");
        } else {
            const currentDate = new Date();
            const inputDate = new Date(enddateInput.value);

            // Calculate the date one year ago from the current date
            const oneYearAgo = new Date(currentDate);
            oneYearAgo.setFullYear(currentDate.getFullYear() - 1);

            // Check if the input date is within the previous one year and the current month
            if (inputDate < oneYearAgo || inputDate > currentDate) {
                showError(enddateInput, errorElement, "Please enter a date After Start date and current date");
            } else {
                hideError(enddateInput, errorElement);
            }
        }
    }

    function validateDates() {
        var isValid = true;

        // Existing validation logic for end date
        if (enddateInput.value.trim() === "") {
            showError(enddateInput, errorEnddate, "Pay process End date is Required");
            isValid = false;
        } else {
            const currentDate = new Date();
            const selectedEndDate = new Date(enddateInput.value);

            // Calculate the date one year ago from the current date
            const lastYear = new Date();
            lastYear.setFullYear(currentDate.getFullYear() - 1);

            if (selectedEndDate < lastYear || selectedEndDate > currentDate) {
                showError(enddateInput, errorEnddate, "Please choose a date within the last year and up to today");
                isValid = false;
            } else {
                hideError(enddateInput, errorEnddate); // Moved this line outside of the if block
            }
        }

        // Existing validation logic for start date
        if (startDateInput.value.trim() === "") {
            showError(startDateInput, errorStartDate, "Pay Process start Date is Required");
            isValid = false;
        } else {
            const currentDate = new Date();
            const selectedStartDate = new Date(startDateInput.value);

            // Calculate the date one year ago from the current date
            const lastYear = new Date();
            lastYear.setFullYear(currentDate.getFullYear() - 1);

            if (selectedStartDate < lastYear || selectedStartDate > currentDate) {
                showError(startDateInput, errorStartDate, "Please choose a date within the last year and up to today");
                isValid = false;
            } else {
                hideError(startDateInput, errorStartDate);
            }
        }

        // Check if end date is after start date
        if (isValid) {
            const selectedStartDate = new Date(startDateInput.value);
            const selectedEndDate = new Date(enddateInput.value);

            if (selectedEndDate <= selectedStartDate) {
                showError(enddateInput, errorEnddate, "End date must be after start date and current date");
                isValid = false;
            } else {
                hideError(enddateInput, errorEnddate);
            }
        }

        return isValid;
    }





    function caddressValidation(event) {
        const company_addressInput = event.target;
        const errorElement = document.getElementById("error_company_address");

        // Regular expression to check if the input follows the specified conditions
        const validInputRegex = /^[a-zA-Z0-9,&\/\s-]+$/;

        if (company_addressInput.value.trim() === "") {
            showError(company_addressInput, errorElement, "Please fill in the field without using spaces.");
        } else if (company_addressInput.value.charAt(0) === ' ' || /\s\s+/.test(company_addressInput.value) || /\.\./.test(company_addressInput.value)) {
            showError(company_addressInput, errorElement, "Invalid input. Avoid starting with a space, having consecutive spaces, or consecutive periods.");
        } else if (!validInputRegex.test(company_addressInput.value) || company_addressInput.value.length < 5 || company_addressInput.value.length > 250) {
            showError(company_addressInput, errorElement, "Invalid input. Enter valid characters (2-250 characters) including letters, numbers, spaces, commas, hyphens, and slashes.");
        } else {
            // Count occurrences of a specific word or number
            const specificWordRegex = /\b(?:specificWord)\b/g;
            const specificWordCount = (company_addressInput.value.match(specificWordRegex) || []).length;

            // Allow the specific word or number up to 4 times
            if (specificWordCount > 4) {
                showError(company_addressInput, errorElement, "Invalid input. The specific word or number is allowed a maximum of 4 times.");
            } else {
                hideError(company_addressInput, errorElement);
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