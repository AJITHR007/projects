window.onload = function() {
    const form = document.getElementById("form");
    const dodInput = document.getElementById("dod");
    const holidayInput = document.getElementById("holiday");
    const descriptionInput = document.getElementById("description");
    const selectedDates = [];

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        if (validateForm()) {
            form.submit();
        }
    });

    dodInput.addEventListener("blur", dodValidation);
    dodInput.addEventListener("focusout", dodValidation);

    holidayInput.addEventListener("blur", holidayValidation);
    holidayInput.addEventListener("focusout", holidayValidation);

    descriptionInput.addEventListener("blur", descriptionValidation);
    descriptionInput.addEventListener("focusout", descriptionValidation);

    function validateForm() {
        let isValid = true;

        isValid = validateDate(dodInput) && isValid;
        isValid = validateHoliday(holidayInput) && isValid;
        isValid = validateDescription(descriptionInput) && isValid;

        return isValid;
    }

    function validateDate(inputElement) {
        const value = inputElement.value.trim();

        if (value === "") {
            showError(inputElement, 'Date is required');
            return false;
        }

        const selectedDate = new Date(value);
        const currentDate = new Date();

        // Get the current year
        const currentYear = currentDate.getFullYear();

        // Create a date for the start of the current year
        const currentYearStart = new Date(currentYear, 0, 1); // January 1st of the current year

        // Create a date for the end of the current year
        const currentYearEnd = new Date(currentYear, 11, 31); // December 31st of the current year

        // Check if the selected date is within the current year
        if (selectedDate < currentYearStart || selectedDate > currentYearEnd) {
            showError(inputElement, 'Selected date must be within the current year.');
            return false;
        }

        // Check if the selected date has already been selected
        if (selectedDates.includes(value)) {
            showError(inputElement, 'Selected date already chosen. Cannot choose again.');
            return false;
        }

        // Add the selected date to the array
        selectedDates.push(value);

        // Hide any previous error messages
        hideError(inputElement);

        return true;
    }

    function validateHoliday(inputElement) {
        const value = inputElement.value.trim();

        if (value === "") {
            showError(inputElement, 'Holiday type is required');
            return false;
        } else {
            hideError(inputElement);
            return true;
        }
    }

    function validateDescription(inputElement) {
        const value = inputElement.value.trim();

        if (value === "") {
            showError(inputElement, 'Description is required');
            return false;
        }

        // Your description validation logic here
        const cleanedValue = value.replace(/\s+/g, ' ');
        const sanitizedValue = cleanedValue.replace(/[^a-zA-Z0-9\s]/g, '');
        const trimmedValue = sanitizedValue.trimStart();

        if (
            trimmedValue.length < 5 ||
            trimmedValue.length > 250 ||
            trimmedValue.startsWith(" ") ||
            /\s{2,}/.test(trimmedValue) ||
            /([a-zA-Z0-9])\1{4,}/.test(trimmedValue)
        ) {
            showError(inputElement, 'Invalid description. Please provide a valid description.');
            return false;
        } else {
            hideError(inputElement);
            return true;
        }
    }

    function showError(inputElement, errorMessage) {
        const errorSpan = inputElement.nextElementSibling;
        errorSpan.textContent = errorMessage;
        inputElement.classList.add("error-input");
    }

    function hideError(inputElement) {
        const errorSpan = inputElement.nextElementSibling;
        errorSpan.textContent = "";
        inputElement.classList.remove("error-input");
    }
};