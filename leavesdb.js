window.onload = function() {
    const form = document.querySelector("form");

    const leave_typeInput = document.getElementById("leave_type");
    const errorLeave_type = document.getElementById("error_leave_type");
    const leave_startInput = document.getElementById("leave_start");
    const error_leave_start = document.getElementById("error_leave_start");
    const leave_endInput = document.getElementById("leave_end");
    const error_leave_end = document.getElementById("error_leave_end");
    const reasonInput = document.getElementById("reason");
    const errorreason = document.getElementById("error_reason");

    form.addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
    leave_startInput.addEventListener("change", function(event) {
        leave_startValidation(event);
    });

    leave_endInput.addEventListener("change", function(event) {
        leave_endValidation(event);
    });

    reasonInput.addEventListener("blur", function(event) {
        reasonValidation(event);
    });


    function validateForm() {
        let isValid = true;
        isValid = leaveTypeValidation() && isValid;
        isValid = leave_startValidation() && isValid;
        isValid = leave_endValidation() && isValid;
        isValid = reasonValidation() && isValid;
        return isValid;
    }

    function leaveTypeValidation() {
        const leave_type = leave_typeInput.value;
        errorLeave_type.textContent = ''; // Clear previous error message

        if (leave_type === '') {
            errorLeave_type.textContent = 'Please select a leave type.';
            return false;
        }

        return true;
    }

    function leave_startValidation(event) {
        const leave_startInput = event.target;
        const errorElement = document.getElementById("error_leave_start");
        const leave_endInput = document.getElementById("leave_end");

        if (leave_startInput.value.trim() === "" || leave_startInput.value.startsWith(" ")) {
            showError(leave_startInput, errorElement, "Please fill in the field.");
        } else {
            const currentDate = new Date();
            const inputStartDate = new Date(leave_startInput.value);
            const threeMonthsAgo = new Date(currentDate);
            threeMonthsAgo.setMonth(currentDate.getMonth() - 3);
            const nextYear = new Date(currentDate);
            nextYear.setFullYear(currentDate.getFullYear() + 1);

            if (inputStartDate < threeMonthsAgo || inputStartDate > nextYear) {
                showError(leave_startInput, errorElement, "Please enter a date within the previous 3 months and up to one year in the future.");
            } else {
                hideError(leave_startInput, errorElement);

                if (leave_endInput.value.trim() !== "") {
                    const inputEndDate = new Date(leave_endInput.value);
                    if (inputEndDate <= inputStartDate) {
                        showError(leave_endInput, document.getElementById("error_leave_end"), "End date must be after start date and within the allowed range.");
                    } else {
                        hideError(leave_endInput, document.getElementById("error_leave_end"));
                    }
                }
            }
        }
    }

    function leave_endValidation(event) {
        const leave_endInput = event.target;
        const errorElement = document.getElementById("error_leave_end");
        const leave_startInput = document.getElementById("leave_start");
        const leave_type = document.getElementById("leave_type").value;

        if (leave_endInput.value.trim() === "" || leave_endInput.value.startsWith(" ")) {
            showError(leave_endInput, errorElement, "Please fill in the field.");
        } else {
            const inputEndDate = new Date(leave_endInput.value);

            if (leave_type === 'casual leave') {
                const inputStartDate = new Date(leave_startInput.value);
                if (!isSameDay(inputEndDate, inputStartDate)) {
                    showError(leave_endInput, errorElement, "Casual leave must be for one day only.");
                } else {
                    hideError(leave_endInput, errorElement);
                }
            } else {
                if (inputEndDate < new Date(leave_startInput.value)) {
                    showError(leave_endInput, errorElement, "End date must be after or the same as the start date and within the allowed range.");
                } else {
                    hideError(leave_endInput, errorElement);
                }
            }
        }
    }

    function reasonValidation(event) {
        const reasonInput = event.target;
        const errorElement = document.getElementById("error_reason");
        const validInputRegex = /^[a-zA-Z0-9.,&/\s-]+$/;

        if (reasonInput.value.trim() === "") {
            showError(reasonInput, errorElement, "Please fill in the field.");
        } else if (!validInputRegex.test(reasonInput.value) || reasonInput.value.length < 2 || reasonInput.value.length > 250) {
            showError(reasonInput, errorElement, "Invalid input. Enter valid characters (2-250 characters) including letters, numbers, spaces, and specified punctuation.");
        } else {
            hideError(reasonInput, errorElement);
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

    function isSameDay(date1, date2) {
        return (
            date1.getFullYear() === date2.getFullYear() &&
            date1.getMonth() === date2.getMonth() &&
            date1.getDate() === date2.getDate()
        );
    }
};