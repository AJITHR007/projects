const departmentInput = document.getElementById("department");
window.onload = function() {
    const form = document.getElementById("form");
    const empRecInput = document.getElementById("empRec");
    const empNameInput = document.getElementById("empName");
    const dobInput = document.getElementById("dob");
    const ageInput = document.getElementById("age");
    const genderInput = document.getElementById("gender");
    const bloodGroupInput = document.getElementById("bloodGroup");
    const fatherNameInput = document.getElementById("fatherName");
    const motherNameInput = document.getElementById("motherName");
    const maritalInput = document.getElementById("marital");
    const spousenameInput = document.getElementById("spousename");
    const spousedobInput = document.getElementById("spousedob");
    const spouseageInput = document.getElementById("spouseage");
    const spousebloodgroupInput = document.getElementById("spousebloodgroup");
    const childrenInput = document.getElementById("children");
    const phoneInput = document.getElementById("phone");
    const peraddressInput = document.getElementById("peraddress");
    const resaddressInput = document.getElementById("resaddress");
    const countryIdInput = document.getElementById("countryId");
    const stateIdInput = document.getElementById("stateId");
    const cityIdInput = document.getElementById("cityId");
    const pincodeInput = document.getElementById("pincode");
    const emailInput = document.getElementById("email");
    const usernameInput = document.getElementById("username");
    const passInput = document.getElementById("pass");
    const aadharCardInput = document.getElementById("aadharCard");
    const panInput = document.getElementById("pan");
    const dojInput = document.getElementById("doj");
    const designationInput = document.getElementById("designation");
    const qualificationInput = document.getElementById("qualification");
    const ugcourseInput = document.getElementById("ugcourse");
    const uginstitutionInput = document.getElementById("uginstitution");
    const ugpassedoutInput = document.getElementById("ugpassedout");
    const pgcourseInput = document.getElementById("pgcourse");
    const pginstitutionInput = document.getElementById("pginstitution");
    const pgpassedoutInput = document.getElementById("pgpassedout");
    const othercourseInput = document.getElementById("othercourse");
    const otherinstitutionInput = document.getElementById("otherinstitution");
    const otherpassedoutInput = document.getElementById("otherpassedout");
    const departmentInput = document.getElementById("department");
    const contactInput = document.getElementById("contact");
    const account_numberInput = document.getElementById("account_number");
    const bank_nameInput = document.getElementById("bank_name");
    const branch_nameInput = document.getElementById("branch_name");
    const ifsc_codeInput = document.getElementById("ifsc_code");
    const work_experienceInput = document.getElementById("work_experience");
    const experienceCertificatesInput = document.getElementById("experienceCertificates");
    const paySlipInput = document.getElementById("paySlip");
    const passportStatusInput = document.getElementById("passportStatus");
    const passportInput = document.getElementById("passport");
    // const 

    // const work_experienceSelect = document.getElementById("work_experience");
    //      work_experienceSelect.addEventListener("change", function() {
    //         if (work_experienceSelect.value === "0") {
    //         // If work experience is zero, hide the fields
    //         // paySlipExperienceCertificatesFields.style.display = "none";
    //         console.log("test");
    //             // hideError(paySlipInput)
    //         }
    //         else 
    //         {
    //         // If work experience is not zero, show the fields
    //         // paySlipExperienceCertificatesFields.style.display = "block";
    //         }
    // });

    form.addEventListener("submit", function(event) {
        event.preventDefault();

        if (validateFrom()) {
            form.submit();
        }
    });



    account_numberInput.addEventListener("input", function(event) {
        accountNumberValidation(event);
    });

    account_numberInput.addEventListener("blur", function(event) {
        accountNumberValidation(event);
    });

    ifsc_codeInput.addEventListener("input", function(event) {
        ifsc_codeValidation(event);
    });

    ifsc_codeInput.addEventListener("blur", function(event) {
        ifsc_codeValidation(event);
    });

    passportInput.addEventListener("input", function(event) {
        passportValidation(event);
    });

    passportInput.addEventListener("blur", function(event) {
        passportValidation(event);
    });


    function validateFrom() {
        let isValid = true;

        if (departmentInput.value.trim() === "") {
            showError(departmentInput, "Department is required");
            isValid = false;
        } else {
            hideError(departmentInput);
        }

        if (contactInput.value.trim() === "") {
            showError(contactInput, "Emergency Contact Number is required");
            isValid = false;
        } else {
            hideError(contactInput);
        }

        if (work_experienceInput.value.trim() === "") {
            showError(work_experienceInput, "Work Experience is required");
            isValid = false;
        } else {
            hideError(work_experienceInput);
        }

        if (account_numberInput.value.trim() === "") {
            showError(account_numberInput, "Account Number is required");
            isValid = false;
        } else {
            hideError(account_numberInput);
        }

        if (ifsc_codeInput.value.trim() === "") {
            showError(ifsc_codeInput, "IFSC Code is required");
            isValid = false;
        } else {
            hideError(ifsc_codeInput);
        }

        if (branch_nameInput.value.trim() === "") {
            showError(branch_nameInput, "Branch Name is required");
            isValid = false;
        } else {
            hideError(branch_nameInput);
        }

        if (bank_nameInput.value.trim() === "") {
            showError(bank_nameInput, "Bank Name is required");
            isValid = false;
        } else {
            hideError(bank_nameInput);
        }


        console.log(experienceCertificatesInput.files);
        // input.files.length > 0
        console.log("work_exp..", work_experienceInput.files);
        if (work_experienceInput.value == " " || work_experienceInput.value > 0) {
            console.log("TEst..if");
            showError(
                experienceCertificatesInput,
                "Experience Certificates is required"
            );
            isValid = false;

            if (experienceCertificatesInput.files.length != 0) {
                hideError(experienceCertificatesInput);
                isValid = true;
            }
        } else {
            hideError(experienceCertificatesInput);
        }

        if (work_experienceInput.value > 0 || work_experienceInput.value == " ") {
            showError(paySlipInput, "Pay Slip is required");
            isValid = false;
            if (paySlipInput.files.length != 0) {
                hideError(paySlipInput);
                isValid = true;
            }
        } else {
            hideError(paySlipInput);
        }

        if (passportInput.value.trim() === "" && passportStatusInput.value !== "no") {
            showError(passportInput, "Passport Number is required");
            isValid = false;
        } else {
            hideError(passportInput);
        }
        // if (paySlipInput.value.trim() === "") {
        //     showError(paySlipInput, "Pay Slip is required");
        //     isValid = false;
        // } else {
        //     hideError(paySlipInput);
        // }

        // if (passportInput.value.trim() === "") {
        //     showError(passportInput, "Passport Number is required");
        //     isValid = false;
        // } else {
        //     hideError(passportInput);
        // }

        if (passportStatusInput.value.trim() === "") {
            showError(passportStatusInput, "Passport Status is required");
            isValid = false;
        } else {
            hideError(passportStatusInput);
        }
        // --------------------------------- Form Field-----------------------------



        var empRecValue = empRecInput.value.trim();
        // Validate the structure of the employee code
        const firstThreeCharacters = empRecValue.substring(0, 3);
        const nextThreeDigits = empRecValue.substring(3, 6);

        if (empRecInput.value.trim() === "" || (!/^[A-Z]{3}$/.test(firstThreeCharacters) || // First three characters are letters
                !/^\d{3}$/.test(nextThreeDigits))) {
            showError(empRecInput, "Employee Code is required");

            isValid = false;
        } else {
            hideError(empRecInput);
        }

        if (empNameInput.value.trim() === "" || (hasConsecutiveRepeatedLetters(empNameInput.value) || empNameInput.value.length <= 3)) {

            showError(empNameInput, "Employee Full Name is required");
            isValid = false;
        } else {
            hideError(empNameInput);
        }

        if (dobInput.value.trim() === "") {
            showError(dobInput, "Date of Birth is required");
            isValid = false;
        } else {
            hideError(dobInput);
        }

        if (ageInput.value.trim() === "") {
            showError(ageInput, "Age is required");
            isValid = false;
        } else {
            hideError(ageInput);
        }
        if (genderInput.value.trim() === "") {
            showError(genderInput, "Gender is required");
            isValid = false;
        } else {
            hideError(genderInput);
        }
        if (bloodGroupInput.value.trim() === "") {
            showError(bloodGroupInput, "Employee Blood Group is required");
            isValid = false;
        } else {
            hideError(bloodGroupInput);
        }

        if (fatherNameInput.value.trim() === "" || (hasConsecutiveRepeatedLetters(fatherNameInput.value) || fatherNameInput.value.length <= 3)) {

            showError(fatherNameInput, "Employee Father Name is required");
            isValid = false;
        } else {
            hideError(fatherNameInput);
        }
        if (motherNameInput.value.trim() === "" || (hasConsecutiveRepeatedLetters(motherNameInput.value) || motherNameInput.value.length <= 3)) {

            showError(motherNameInput, "Employee Mother Name is required");
            isValid = false;
        } else {
            hideError(motherNameInput);
        }

        if (maritalInput.value.trim() === "") {
            showError(maritalInput, "Marital Status is required");
            isValid = false;
        } else {
            hideError(maritalInput);
        }
        if (maritalInput.value != "Single" && (spousenameInput.value.trim() === "" || (hasConsecutiveRepeatedLetters(spousenameInput.value) || spousenameInput.value.length <= 3))) {

            showError(spousenameInput, "Spouse Name is required");
            isValid = false;
        } else {
            hideError(spousenameInput);
        }
        if (maritalInput.value != "Single" && spousedobInput.value.trim() === "") {
            showError(spousedobInput, "Spouse Date of Birth is required");
            isValid = false;
        } else {
            hideError(spousedobInput);
        }
        if (maritalInput.value != "Single" && spouseageInput.value.trim() === "") {
            showError(spouseageInput, "Spouse Age is required");
            isValid = false;
        } else {
            hideError(spouseageInput);
        }
        if (
            maritalInput.value != "Single" &&
            spousebloodgroupInput.value.trim() === ""
        ) {
            showError(spousebloodgroupInput, "Spouse bloodgroup is required");
            isValid = false;
        } else {
            hideError(spousebloodgroupInput);
        }

        if (maritalInput.value != "Single" && childrenInput.value.trim() === "") {
            showError(childrenInput, "Children is required");
            isValid = false;
        } else {
            hideError(childrenInput);
        }


        if (phoneInput.value.trim() === "" || !(/^[6-9]\d{9}$/.test(phoneInput.value.trim()))) {
            showError(phoneInput, "Phone Number is required");
            isValid = false;
        } else {
            hideError(phoneInput);
        }
        if (peraddressInput.value.trim() === "") {
            showError(peraddressInput, "Permanent Address is required");
            isValid = false;
        } else {
            hideError(peraddressInput);
        }
        if (resaddressInput.value.trim() === "") {
            showError(resaddressInput, "Residential Address is required");
            isValid = false;
        } else {
            hideError(resaddressInput);
        }
        if (countryIdInput.value.trim() === "") {
            showError(countryIdInput, "Country is required");
            isValid = false;
        } else {
            hideError(countryIdInput);
        }
        if (stateIdInput.value.trim() === "") {
            showError(stateIdInput, "State is required");
            isValid = false;
        } else {
            hideError(stateIdInput);
        }
        if (cityIdInput.value.trim() === "") {
            showError(cityIdInput, "District is required");
            isValid = false;
        } else {
            hideError(cityIdInput);
        }
        if (pincodeInput.value.trim() === "") {
            showError(pincodeInput, "Pincode is required");
            isValid = false;
        } else {
            hideError(pincodeInput);
        }

        var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var emailValue = emailInput.value;
        if (emailInput.value.trim() === "") {



            showError(emailInput, "Email is required");
            isValid = false;
        } else {
            if (!(regex.test(emailValue) && emailValue.indexOf('@') >= 6)) {
                showError(emailInput, "Email should have at least 6 characters before @ symbol.");
            } else {
                hideError(emailInput);
            }
        }
        if (usernameInput.value.trim() === "") {
            showError(usernameInput, "Username is required");
            isValid = false;
        } else {
            hideError(usernameInput);
        }
        if (passInput.value.trim() === "") {
            showError(passInput, "Password is required");
            isValid = false;
        } else {
            hideError(passInput);
        }
        if (aadharCardInput.value.trim() === "" || (hasConsecutiveRepeatedLetters(aadharCardInput.value) || aadharCardInput.value.length <= 3)) {
            showError(aadharCardInput, "Aadhar Number is required");
            isValid = false;
        } else {
            hideError(aadharCardInput);
        }
        // if (panInput.value.trim() === "") {
        var panValue = panInput.value.trim();
        // Validate the structure of the PAN
        const firstFiveAlpha = panValue.substring(0, 5);
        const nextFourNumeric = panValue.substring(5, 9);
        const lastAlpha = panValue.substring(9);

        if (panInput.value.trim() === "" || (!/^[A-Z]+$/.test(firstFiveAlpha) || // First five characters are alphabetic
                !/^\d{4}$/.test(nextFourNumeric) || // Next four characters are numeric
                !/^[A-Z]$/.test(lastAlpha) // Last character is alphabetic
            )) {
            showError(panInput, "PAN Number is required");
            isValid = false;
        } else {
            hideError(panInput);
        }
        if (dojInput.value.trim() === "") {
            showError(dojInput, "Date of Joining is required");
            isValid = false;
        } else {
            hideError(dojInput);
        }
        if (designationInput.value.trim() === "") {
            showError(designationInput, "Designation is required");
            isValid = false;
        } else {
            hideError(designationInput);
        }
        if (qualificationInput.value.trim() === "") {
            showError(qualificationInput, "Qualification is required");
            isValid = false;
        } else {
            hideError(qualificationInput);
        }

        hideError(pgcourseInput);
        hideError(pginstitutionInput);
        hideError(pgpassedoutInput);
        hideError(ugpassedoutInput);
        // hideError(uginstitutionInput);
        // hideError(ugcourseInput);
        hideError(otherpassedoutInput);
        hideError(othercourseInput);
        hideError(otherinstitutionInput);
        if (
            qualificationInput.value == "Others" ||
            qualificationInput.value.length <= 0
        ) {

            if (othercourseInput.value.trim() === "" || (hasConsecutiveRepeatedLetters(othercourseInput.value) || othercourseInput.value.length <= 3)) {
                showError(othercourseInput, "Other Course is required");
                isValid = false;
            } else {
                hideError(othercourseInput);
            }

            // if (otherinstitutionInput.value.trim() === "") {
            //     showError(otherinstitutionInput, "Other Institution is required");
            //     isValid = false;
            // } else {
            //     hideError(otherinstitutionInput);
            // }
            if (otherinstitutionInput.value.trim() === "" || (hasConsecutiveRepeatedLetters(otherinstitutionInput.value) || otherinstitutionInput.value.length <= 3)) {
                showError(otherinstitutionInput, "Other Institution is required");
                isValid = false;
            } else {
                hideError(otherinstitutionInput);
            }

            if (otherpassedoutInput.value.trim() === "0") {
                showError(otherpassedoutInput, "Other Passed Out is required");
                isVali = false;
            } else {
                hideError(otherpassedoutInput);
            }
        }
        if (
            qualificationInput.value == "PG" ||
            qualificationInput.value.length <= 0
        ) {

            if (pgcourseInput.value.trim() === "" || (hasConsecutiveRepeatedLetters(pgcourseInput.value) || pgcourseInput.value.length <= 3)) {
                showError(pgcourseInput, "PG Course is required");
                isValid = false;
            } else {
                hideError(pgcourseInput);
            }

            // if (pginstitutionInput.value.trim() === "") {
            //     showError(pginstitutionInput, "PG Institution is required");
            //     isValid = false;
            // } else {
            //     hideError(pginstitutionInput);
            // }
            if (pginstitutionInput.value.trim() === "" || (hasConsecutiveRepeatedLetters(pginstitutionInput.value) || pginstitutionInput.value.length <= 3)) {
                showError(pginstitutionInput, "pg Institution is required");
                isValid = false;
            } else {
                hideError(pginstitutionInput);
            }

            if (pgpassedoutInput.value.trim() === "0") {
                showError(pgpassedoutInput, "PG Passed Out is required");
                isValid = false;
            } else {
                hideError(pgpassedoutInput);
            }


            if (ugcourseInput.value.trim() === "" || (hasConsecutiveRepeatedLetters(ugcourseInput.value) || ugcourseInput.value.length <= 3)) {
                showError(ugcourseInput, "UG Course is required");
                isValid = false;
            } else {
                hideError(ugcourseInput);
            }
            // if (uginstitutionInput.value.trim() === "") {
            //     showError(uginstitutionInput, "UG Institution is required");
            //     isValid = false;
            // } else {
            //     console.log("sdasd");
            //     hideError(uginstitutionInput);
            // }
            if (uginstitutionInput.value.trim() === "" || (hasConsecutiveRepeatedLetters(uginstitutionInput.value) || uginstitutionInput.value.length <= 3)) {
                showError(uginstitutionInput, "ug Institution is required");
                isValid = false;
            } else {
                hideError(uginstitutionInput);
            }


            if (ugpassedoutInput.value.trim() === "0") {
                showError(ugpassedoutInput, "UG Passed Out is required");
                isValid = false;
            } else {
                hideError(ugpassedoutInput);
            }
        }
        if (
            qualificationInput.value == "UG" ||
            qualificationInput.value.length <= 0
        ) {
            // if (ugcourseInput.value.trim() === "") {
            //     showError(ugcourseInput, "UG Course is required");
            //     isValid = false;
            // } else {
            //     hideError(ugcourseInput);
            // }
            console.log("sdsdfsdf");
            if (uginstitutionInput.value.trim() === "" || (hasConsecutiveRepeatedLetters(uginstitutionInput.value) || uginstitutionInput.value.length <= 3)) {
                showError(uginstitutionInput, "UG Institution is required");
                isValid = false;
            } else {
                hideError(uginstitutionInput);
            }
            if (ugpassedoutInput.value.trim() === "0") {
                showError(ugpassedoutInput, "UG Passed Out is required");
                isValid = false;
            } else {
                hideError(ugpassedoutInput);
            }


        }
        return isValid;
    }
};

function showError(inputElement, errorMessage) {
    const errorDiv = inputElement.nextElementSibling;
    inputElement.classList.add("error-input");
    errorDiv.textContent = errorMessage;
}

function hideError(inputElement) {
    const errorDiv = inputElement.nextElementSibling;
    inputElement.classList.remove("error-input");
    errorDiv.textContent = "";
}

function validateEmpCode(event) {
    const codeInputTarget = event.target;
    const codeInput = event.target.value.trim();

    // Check if input is empty
    if (codeInput === '') {
        showError(event.target, "Employee Code is Required");
    } else {
        const firstThreeCharacters = codeInput.substring(0, 3);
        const nextThreeDigits = codeInput.substring(3, 6);

        if (!/^[A-Z]{3}$/.test(firstThreeCharacters) || // First three characters are letters
            !/^\d{3}$/.test(nextThreeDigits) // Next three characters are digits
        ) {
            showError(event.target, "Employee Code Should Only Contain First Three Characters Uppercase Followed by Numbers");
        } else {
            // Check if empRec is already accepted
            checkIfEmpRecExists(codeInput)
                .then((exists) => {
                    if (exists) {
                        showError(event.target, "Employee Code Already Exists");
                    } else {
                        hideError(event.target);
                    }
                })
                .catch((error) => {
                    console.error("Error checking employee code:", error);
                });
        }
    }
}


// Function to check if empRec exists
function checkIfEmpRecExists(empRec) {
    return new Promise((resolve, reject) => {
        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();

        // Configure the request
        xhr.open('POST', 'check_empRec_exists.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        // Define what happens on successful data submission
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Resolve the promise with the response text
                resolve(xhr.responseText === 'true');
            } else {
                // Reject the promise with a status text error
                reject('Request failed');
            }
        };

        // Handle network errors
        xhr.onerror = function() {
            reject('Network error');
        };

        // Send the request
        xhr.send('empRec=' + empRec);
    });
}

function empNamevalidation(event) {
    const empNameInput = event.target;
    let empNameValue = empNameInput.value;

    // Replace consecutive spaces with a single space
    empNameValue = empNameValue.replace(/\s+/g, " ");

    // Allow up to 3 spaces in between names or characters
    empNameValue = empNameValue.replace(/[^a-zA-Z\s]{1,3}/g, "");
    console.log("empNameValue...", empNameValue);

    empNameInput.value = empNameValue;

    // Check for consecutive repeated letters
    if (hasConsecutiveRepeatedLetters(empNameValue) || empNameValue.length <= 3) {
        showError(
            empNameInput,
            "Employee Name Should Only Contain Alphabetic Characters and cannot contain more than 3 consecutive letters"
        );
    } else {
        hideError(empNameInput);
    }
}

// Helper function to check for consecutive repeated letters
function hasConsecutiveRepeatedLetters(name) {
    for (let i = 0; i < name.length - 1; i++) {
        if ((name[i] === name[i + 1]) & (name[i + 1] === name[i + 2])) {
            return true; // Consecutive repeated letters found
        }
    }
    return false; // No consecutive repeated letters found
}



const dateField = document.getElementById("dob");

dateField.setAttribute("min", "1970-01-01");
dateField.setAttribute("max", "2024-12-31");
dateField.addEventListener("change", function() {
    console.log("value...", this.value);
    const selectedDate = new Date(this.value);

    //   // Calculate 21 years ago from the current date
    const twentyOneYearsAgo = new Date();
    twentyOneYearsAgo.setFullYear(twentyOneYearsAgo.getFullYear() - 21);

    const disabledYears = ["2023", "2024"];
    const selectedYear = selectedDate.getFullYear().toString();
    console.log("selectedYear/....", selectedYear);

    submitBday(this.value);
    if (selectedDate > twentyOneYearsAgo) {
        this.value = "";
        showError(this, "Employee Must be Atleast 21 Years Old");
        return;
    }
});


const dateField2 = document.getElementById("spousedob");

dateField2.setAttribute("min", "1970-01-01");
dateField2.setAttribute("max", "2024-12-31");
dateField2.addEventListener("change", function() {
    console.log("value...", this.value);
    const selectedDate2 = new Date(this.value);


    const twentyOneYearsAgo = new Date();
    twentyOneYearsAgo.setFullYear(twentyOneYearsAgo.getFullYear() - 21);

    const disabled = ["2023", "2024"];

    submitBirthday(this.value);

});

function dobvalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();
    console.log("value...", value);
    if (value === "") {
        showError(inputElement, "Please choose Date of Birth");
    } else {
        hideError(inputElement);
    }
}

function submitBday(value) {
    let Bdate = value;
    let Bday = +new Date(Bdate);
    Bday = Math.floor((Date.now() - Bday) / 31557600000);
    // console.log('value...gg', Bday);

    if (Bday >= 0) {
        document.getElementById("age").value = Bday;
    }
}

function agevalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();
    console.log("value...", value);
    if (value === "") {
        showError(inputElement, "Please choose Date of birth");
    } else {
        hideError(inputElement);
    }
}

function gendervalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();
    console.log("value...", value);
    if (value === "") {
        showError(inputElement, "Please choose any one");
    } else {
        hideError(inputElement);
    }
}

function bloodGroupvalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();

    if (value === "") {
        showError(inputElement, "Please choose any one");
    } else {
        hideError(inputElement);
    }
}

function fathernamevalidation(event) {
    const empNameInput = event.target;
    let empNameValue = empNameInput.value;

    // Replace consecutive spaces with a single space
    empNameValue = empNameValue.replace(/\s+/g, " ");

    // Allow up to 3 spaces in between names or characters
    empNameValue = empNameValue.replace(/[^a-zA-Z\s]{1,3}/g, "");
    console.log("empNameValue...", empNameValue);

    empNameInput.value = empNameValue;

    // Check for consecutive repeated letters
    if (hasConsecutiveRepeatedLetters(empNameValue) || empNameValue.length <= 3) {
        showError(
            empNameInput,
            "Father Name Should Only Contain Alphabetic Characters and cannot contain more than 3 consecutive letters"
        );
    } else {
        hideError(empNameInput);
    }
}

// Helper function to check for consecutive repeated letters
function hasConsecutiveRepeatedLetters(name) {
    for (let i = 0; i < name.length - 1; i++) {
        if ((name[i] === name[i + 1]) & (name[i + 1] === name[i + 2])) {
            return true; // Consecutive repeated letters found
        }
    }
    return false; // No consecutive repeated letters found
}

function motherNamevalidation(event) {
    const empNameInput = event.target;
    let empNameValue = empNameInput.value;

    // Replace consecutive spaces with a single space
    empNameValue = empNameValue.replace(/\s+/g, " ");

    // Allow up to 3 spaces in between names or characters
    empNameValue = empNameValue.replace(/[^a-zA-Z\s]{1,3}/g, "");
    console.log("empNameValue...", empNameValue);

    empNameInput.value = empNameValue;

    // Check for consecutive repeated letters
    if (hasConsecutiveRepeatedLetters(empNameValue) || empNameValue.length <= 3) {
        showError(
            empNameInput,
            "Mother Name Should Only Contain Alphabetic Characters and cannot contain more than 3 consecutive letters"
        );
    } else {
        hideError(empNameInput);
    }
}

// Helper function to check for consecutive repeated letters
function hasConsecutiveRepeatedLetters(name) {
    for (let i = 0; i < name.length - 1; i++) {
        if ((name[i] === name[i + 1]) & (name[i + 1] === name[i + 2])) {
            return true; // Consecutive repeated letters found
        }
    }
    return false; // No consecutive repeated letters found
}

function maritalvalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();
    console.log("value...", value);
    if (value === "") {
        showError(inputElement, "Please choose any one");
    } else {
        hideError(inputElement);

    }

    if (value === 'single') {
        hideError(document.getElementById(""));
    }
}

function spousenamevalidation(event) {
    const spousenameInput = event.target;
    let spousenameValue = spousenameInput.value;

    // Replace consecutive spaces with a single space
    spousenameValue = spousenameValue.replace(/\s+/g, " ");

    // Allow up to 3 spaces in between names or characters
    spousenameValue = spousenameValue.replace(/[^a-zA-Z\s]{1,3}/g, "");
    console.log("spousenameValue...", spousenameValue);

    spousenameInput.value = spousenameValue;


    // Check for consecutive repeated letters
    if (hasConsecutiveRepeatedLetters(spousenameValue) || spousenameValue.length <= 3) {
        showError(
            spousenameInput,
            "Spouse Name Should Only Contain Alphabetic Characters and cannot contain more than 3 consecutive letters"
        );
    } else {
        hideError(spousenameInput);
    }
}

// Helper function to check for consecutive repeated letters
function hasConsecutiveRepeatedLetters(name) {
    for (let i = 0; i < name.length - 1; i++) {
        if ((name[i] === name[i + 1]) & (name[i + 1] === name[i + 2])) {
            return true; // Consecutive repeated letters found
        }
    }
    return false; // No consecutive repeated letters found
}

function spousedobvalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value;

    if (value === "") {
        showError(inputElement, "Please choose Date of Birth");
        return;
    }

    const dobDate = new Date(value);
    const twentyOneYearsAgo = new Date();
    twentyOneYearsAgo.setFullYear(twentyOneYearsAgo.getFullYear() - 21);

    const startDate = new Date("1980-01-01");

    if (dobDate > twentyOneYearsAgo) {
        showError(inputElement, "Employee Must be Atleast 21 Years Old");
    } else if (dobDate < startDate) {
        showError(inputElement, "Date of Birth is Required");
    } else {
        hideError(inputElement);
    }
}

function submitBirthday(event) {
    let Bdate = event.target.value;
    let Bday = +new Date(Bdate);
    Bday = Math.floor((Date.now() - Bday) / 31557600000);
    if (Bday >= 0) {
        document.getElementById("spouseage").value = Bday;
    }
}

function spouseagevalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();
    console.log("value...", value);
    if (value === "") {
        showError(inputElement, "Please choose Date of birth");
    } else {
        hideError(inputElement);
    }
}

function spousebloodgroupvalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();
    console.log("value...", value);
    if (value === "") {
        showError(inputElement, "Please choose any one");
    } else {
        hideError(inputElement);
    }
}

function childrenvalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();
    console.log("value...", value);
    if (value === "") {
        showError(inputElement, "Please choose any one");
    } else {
        hideError(inputElement);
    }
}


function phonenumbervalidation(event) {
    const phoneInputTarget = event.target;
    const phoneInput = event.target.value.trim();

    // Only keep numeric characters
    const numericValue = phoneInput.replace(/[^0-9]/g, "");

    const emergency_contact = document.getElementById("contact").value;

    // // Check for more than 4 consecutive letters
    // if (/([a-zA-Z])\1{3,}/.test(phoneInput)) {
    //     showError(event.target, "Phone Number should not contain more than 4 consecutive letters");
    //     return;
    // }

    // Check for consecutive numbers
    if (/(\d)\1{3,}/.test(numericValue)) {
        showError(event.target, "Phone Number should not contain more than 3 consecutive numbers");
        return;
    }

    if (numericValue !== "" && emergency_contact === numericValue) {
        showError(event.target, "Phone Number Should be Starts With 6,7,8,9 and Maximum 10 Digits ");
        return;
    }

    // Check if the numeric value starts with 6, 7, 8, or 9 and has a total length of 10
    if (/^[6-9]\d{9}$/.test(numericValue)) {
        phoneInputTarget.value = numericValue;
        hideError(event.target);
    } else {
        showError(event.target, "Phone Number Should be Starts With 6,7,8,9 and Maximum 10 Digits");
    }
}



function peraddressvalidation(event) {
    const peraddressInput = event.target;
    let peraddressValue = peraddressInput.value;

    // Replace multiple spaces with a single space
    peraddressValue = peraddressValue.replace(/\s+/g, " ");

    // Allow only alphanumeric characters, spaces, commas, periods, slashes, and hyphens
    peraddressValue = peraddressValue.replace(/[^a-zA-Z0-9\s,./-]/g, "");

    peraddressInput.value = peraddressValue;

    if (peraddressValue.length <= 10) {
        showError(
            peraddressInput,
            "Please enter a valid address"
        );
    } else {
        hideError(peraddressInput);

    }
}

function setBillingAddress() {
    if ($("#homepostalcheck").is(":checked")) {
        $("#resaddress").val($("#peraddress").val());
        hideError(document.getElementById("resaddress"))
        $("#resaddress").attr("readonly", "readonly");
    } else {
        $("#resaddress").removeAttr("disabled");
    }
}

$("#homepostalcheck").click(function() {
    setBillingAddress();
});

function resaddressvalidation(event) {
    const resaddressInput = event.target;
    let resaddressValue = resaddressInput.value;

    // Replace multiple spaces with a single space
    resaddressValue = resaddressValue.replace(/\s+/g, " ");

    // Allow only alphanumeric characters, spaces, commas, periods, slashes, and hyphens
    resaddressValue = resaddressValue.replace(/[^a-zA-Z0-9\s,./-]/g, "");

    resaddressInput.value = resaddressValue;

    if (resaddressValue.length <= 10) {
        showError(
            resaddressInput,
            "Please enter a valid address"
        );
    } else {
        hideError(resaddressInput);
    }
}

function countryvalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();

    if (value === "") {
        showError(inputElement, "Please choose any one");
    } else {
        hideError(inputElement);
    }
}

function statevalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();

    if (value === "") {
        showError(inputElement, "Please choose any one");
    } else {
        hideError(inputElement);
    }
}

function districtvalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();

    if (value === "") {
        showError(inputElement, "Please choose any one");
    } else {
        hideError(inputElement);
    }
}

function pincodeValidation(event) {
    const pinInputTarget = event.target;
    const pinInput = event.target.value.trim();
    // console.log(pinInput);

    // Remove spaces and only keep numeric characters
    const numericValue = pinInput.replace(/[^0-9]/g, "");

    // const pincode = event.target.value;
    const districtVal = document.getElementById("cityId").value;
    const xhr = new XMLHttpRequest();
    xhr.open(
        "GET",
        `https://api.postalpincode.in/pincode/${pinInputTarget.value.replace(
      /\s+/g,
      ""
    )}`,
        true
    );

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            const districtElement = document.getElementById("cityId");

            if (response && response.length > 0 && response[0].Status === "Success") {
                const district = response[0].PostOffice[0].District;
                // document.getElementById('sdf').innerHTML= district;
                // const districtVal = districtElement.value;
                if (district == districtVal) {
                    // document.getElementById('zip').style.boxShadow = "none";
                    // document.getElementById('zipdiv').innerHTML ="";
                    console.log("district  matchhhhhvvv");
                    hideError(districtElement);
                } else {
                    console.log("district didnt match");
                    showError(districtElement.target);
                    // document.getElementById('zip').style.boxShadow = "0 0 3px 3px red";
                    // document.getElementById('zipdiv').innerHTML ="Entered pincode does not match with city";
                }
            } else {
                console.log("district didnt match 333");
                showError(
                    districtElement,
                    "Pincode Doesn't Match with the Selected City"
                );
                // document.getElementById('zip').style.boxShadow = "0 0 3px 3px red";
                // document.getElementById('zipdiv').innerHTML ="Entered pincode does not exists";
            }
        } else {
            console.error("Error fetching data. Status:", xhr.status);
        }
    };
    xhr.send();

    // Check if the numeric value meets the criteria
    if (
        /^[1-9]\d{2} ?\d{3}$/.test(numericValue) &&
        !hasSameDigits(numericValue)
    ) {
        // If the numeric value has 6 consecutive digits, we can modify it to the format with a space
        const formattedValue =
            numericValue.substring(0, 3) + " " + numericValue.substring(3);
        pinInputTarget.value = formattedValue;
        hideError(event.target);
    } else {
        showError(event.target, "Please enter a valid Pincode");
    }
}

function hasSameDigits(value) {
    // Check if all digits are the same in the value
    for (let i = 1; i < value.length; i++) {
        if (value[i] !== value[0]) {
            return false;
        }
    }
    return true;
}

function emailvalidation(event) {
    const emailInputTarget = event.target;
    const emailInput = event.target.value.trim();
    console.log(emailInput);

    // Regular expression for a more permissive email validation
    const emailPattern = /^[a-zA-Z0-9._%+-]{6,}@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Check for email validation and other conditions
    if (
        emailPattern.test(emailInput) &&
        isValidStartCharacter(emailInput) &&
        isValidDomainName(emailInput)
    ) {
        emailInputTarget.value = emailInput;
        hideError(event.target);
    } else {
        showError(event.target, "Please Enter a Valid Email Address!, email shoud contain atleast 6 characters before @");
    }
}

// Function to check if the email starts with a character or a number
function isValidStartCharacter(email) {
    const atIndex = email.indexOf("@");
    const startPart = email.slice(0, atIndex);

    // Check for valid starting character conditions (letter or number)
    const startPattern = /^[a-zA-Z0-9]/;

    return startPattern.test(startPart);
}

// Function to check if the domain name after '@' does not start with a dot
function isValidDomainName(email) {
    const atIndex = email.indexOf("@");
    const domainPart = email.slice(atIndex + 1);

    // Check for valid domain name conditions (does not start with a dot)
    const domainPattern = /^[^.]/;

    return domainPattern.test(domainPart);
}

function usernameValidation(event) {
    const usernameInput = event.target;
    let usernameValue = usernameInput.value;

    // Remove characters that are not alphanumeric or @, #, &
    usernameValue = usernameValue.replace(/[^a-zA-Z0-9@#&]/g, "");

    // Ensure maximum length is 20 characters
    if (usernameValue.length > 20) {
        usernameValue = usernameValue.substring(0, 20);
    }

    usernameInput.value = usernameValue;

    // Check for consecutive same letters
    const continuousCharacters = /(.)\1{2,}/;

    if (usernameValue.length < 5 || continuousCharacters.test(usernameValue)) {
        showError(
            usernameInput,
            "Username should only contain alphanumeric characters, @, #, & (maximum 20 characters)"
        );
    } else {
        hideError(usernameInput);
    }
}


function passvalidation(event) {
    const passwordInputTarget = event.target;
    const passwordInput = event.target.value.trim();
    console.log(passwordInput);

    // Define the criteria for a strong password
    const uppercaseRegex = /[A-Z]/;
    const lowercaseRegex = /[a-z]/;
    const digitRegex = /\d/;
    const specialCharRegex = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/;

    // Check if the password meets the criteria
    if (
        passwordInput.length >= 8 &&
        uppercaseRegex.test(passwordInput) &&
        lowercaseRegex.test(passwordInput) &&
        digitRegex.test(passwordInput) &&
        specialCharRegex.test(passwordInput)
    ) {
        passwordInputTarget.value = passwordInput;
        hideError(event.target);
    } else {
        showError(
            event.target,
            "Password Must be Atleast 8 Characters Long and Include Uppercase, Lowercase, Digit, and Special Character"
        );
    }
}

function aadharCardValidation(event) {
    const aadharCardInput = event.target;
    let aadharCardValue = aadharCardInput.value.trim();

    // Remove all non-numeric characters
    const numericValue = aadharCardValue.replace(/[^0-9]/g, "");

    // Ensure Aadhar has 12 digits
    if (numericValue.length !== 12) {
        showError(aadharCardInput, "Aadhar Number should contain 12 digits");
        return;
    }

    // Ensure Aadhar doesn't start with 0 or 1
    if (numericValue.startsWith("0") || numericValue.startsWith("1")) {
        showError(aadharCardInput, "Aadhar Number should not start with 0 or 1");
        return;
    }

    // Ensure numbers are allowed 2 to 4 times
    // const numbersCount = (numericValue.match(/\d{1,6}/g) || []).join("").length;

    // if (numbersCount < 1 || numbersCount > 6) {
    //     showError(aadharCardInput, "Aadhar Number Should contain Same Numbers");
    //     return;
    // }

    // Add whitespace after every 4 digits
    aadharCardValue = numericValue.replace(/(\d{4})/g, "$1 ").trim();
    aadharCardInput.value = aadharCardValue;

    // All checks passed
    hideError(aadharCardInput);
}

function panvalidation(event) {
    const panInputTarget = event.target;
    const panInput = event.target.value.trim();
    console.log(panInput);

    const formattedValue = panInput.replace(/[^0-9A-Z]/g, "");
    panInputTarget.value = formattedValue;

    // Validate the structure of the PAN
    const firstFiveAlpha = formattedValue.substring(0, 5);
    const nextFourNumeric = formattedValue.substring(5, 9);
    const lastAlpha = formattedValue.substring(9);

    if (!/^[A-Z]+$/.test(firstFiveAlpha) || // First five characters are alphabetic
        !/^\d{4}$/.test(nextFourNumeric) || // Next four characters are numeric
        !/^[A-Z]$/.test(lastAlpha) // Last character is alphabetic
    ) {
        showError(event.target, "Please Enter a Valid PAN Card Number");
    } else {
        hideError(event.target);
    }
}

//Set Previous year and Future Year for date of joining field
const d = new Date();
var previousYear = d.getFullYear() - 1 + "-01-01";
var futureYear = d.getFullYear() + 1 + "-12-31";

document.getElementsByName("doj")[0].setAttribute("min", previousYear);
document.getElementsByName("doj")[0].setAttribute("max", futureYear);

function addYears(date, years) {
    date = new Date(date);
    let day = date.getDate(),
        newDate = new Date(
            Date.UTC(date.getFullYear() + years, date.getMonth(), date.getDate(), 0)
        );
    newDate.getDate() != day && newDate.setDate(0);
    return newDate;
}

function dojvalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value;

    if (value === "") {
        showError(inputElement, "Please select a date");
        return;
    }

    const dojDate = new Date(value);
    const currentDate = new Date();
    const sixMonthsAgo = new Date(currentDate);
    sixMonthsAgo.setMonth(currentDate.getMonth() - 6);
    const sixMonthsLater = new Date(currentDate);
    sixMonthsLater.setMonth(currentDate.getMonth() + 6);

    if (dojDate < sixMonthsAgo || dojDate > sixMonthsLater) {
        showError(
            inputElement,
            "Please enter a valid date within the previous 6 months and the next 6 months."
        );
    } else {
        hideError(inputElement);
    }
}


function designationvalidation(event) {
    const designationInputTarget = event.target;
    const designationInput = event.target.value.trim();
    console.log(designationInput);

    // Define your criteria or pattern for designation validation
    // For example, let's say the designation should not be empty and should be at least 2 characters long
    const designationPattern = /.{2,}/;

    if (designationPattern.test(designationInput)) {
        designationInputTarget.value = designationInput;
        hideError(event.target);
    } else {
        showError(event.target, "Please Select any one");
    }
}

function qualificationvalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();

    if (value === "") {
        showError(inputElement, "Please choose any one");
    } else {
        hideError(inputElement);
    }
}

function ugcoursevalidation(event) {
    const ugcourseInput = event.target;
    let ugcourseValue = ugcourseInput.value;

    // Replace consecutive spaces with a single space
    ugcourseValue = ugcourseValue.replace(/\s+/g, " ");

    // Allow alphabetic characters, spaces, and dots
    ugcourseValue = ugcourseValue.replace(/[^a-zA-Z\s.]/g, "");

    ugcourseInput.value = ugcourseValue;

    // Check for continuous characters
    const continuousCharacters = /(.)\1{2,}/;

    if (
        ugcourseValue.length < 2 ||
        ugcourseValue.startsWith(".") ||
        continuousCharacters.test(ugcourseValue)
    ) {
        showError(
            ugcourseInput,
            "UG Course Should only Contain Alphabetic Characters, Spaces, and Dot"
        );
    } else {
        hideError(ugcourseInput);
    }
}

function uginstitutionvalidation(event) {
    const uginstitutionInput = event.target;
    let uginstitutionValue = uginstitutionInput.value;

    // Replace consecutive spaces with a single space
    uginstitutionValue = uginstitutionValue.replace(/\s+/g, " ");

    // Allow alphabetic characters and spaces
    uginstitutionValue = uginstitutionValue.replace(/[^a-zA-Z\s]/g, "");

    uginstitutionInput.value = uginstitutionValue;

    // Check for continuous characters
    const continuousCharacters = /(.)\1{2,}/;

    if (
        uginstitutionValue.length < 10 ||
        continuousCharacters.test(uginstitutionValue)
    ) {
        showError(
            uginstitutionInput,
            "UG Institution should only Contain Alphabetic Characters and Spaces"
        );
    } else {
        hideError(uginstitutionInput);
    }
}

$(function() {
    var option = function(i, j) {
        return $("<option value=" + (j + 2000) + ">").append(j + 2000);
    };

    var options = (new Array(25) + "").split(",").map(option);

    $("#ugpassedout").append(options);
});

function ugpassedoutvalidation(event) {
    console.log("test");
    const inputElement = event.target;
    const value = inputElement.value.trim();
    // console.log("value...ww", value);
    if (value === "0") {
        // console.log("errore");
        showError(inputElement, "Please Select any one");
    } else {
        hideError(inputElement);
    }
}

function pgcoursevalidation(event) {
    const pgcourseInput = event.target;
    let pgcourseValue = pgcourseInput.value;

    // Replace consecutive spaces with a single space
    pgcourseValue = pgcourseValue.replace(/\s+/g, " ");

    // Allow alphabetic characters, spaces, and dots
    pgcourseValue = pgcourseValue.replace(/[^a-zA-Z\s.]/g, "");

    pgcourseInput.value = pgcourseValue;

    // Check for continuous characters
    const continuousCharacters = /(.)\1{2,}/;

    if (
        pgcourseValue.length < 1 ||
        pgcourseValue.startsWith(".") ||
        continuousCharacters.test(pgcourseValue)
    ) {
        showError(
            pgcourseInput,
            "PG Course Should only Contain Alphabetic Characters, Spaces, and Dots"
        );
    } else {
        hideError(pgcourseInput);
    }
}

function pginstitutionvalidation(event) {
    const pginstitutionInput = event.target;
    let pginstitutionValue = pginstitutionInput.value;

    // Replace consecutive spaces with a single space
    pginstitutionValue = pginstitutionValue.replace(/\s+/g, " ");

    // Allow alphabetic characters and spaces
    pginstitutionValue = pginstitutionValue.replace(/[^a-zA-Z\s]/g, "");

    pginstitutionInput.value = pginstitutionValue;

    // Check for continuous characters
    const continuousCharacters = /(.)\1{2,}/;

    if (
        pginstitutionValue.length < 10 ||
        continuousCharacters.test(pginstitutionValue)
    ) {
        showError(
            pginstitutionInput,
            "PG Institution should only Contain Alphabetic Characters and Spaces"
        );
    } else {
        hideError(pginstitutionInput);
    }
}

$(function() {
    var option = function(i, j) {
        return $("<option value=" + (j + 2000) + ">").append(j + 2000);
    };

    var options = (new Array(25) + "").split(",").map(option);

    $("#pgpassedout").append(options);
});

function pgpassedoutvalidation(event) {
    console.log("test");
    const inputElement = event.target;
    const value = inputElement.value.trim();
    // console.log("value...ww", value);
    if (value === "0") {
        // console.log("errore");
        showError(inputElement, "Please Select any one");
    } else {
        hideError(inputElement);
    }
}

function othercoursevalidation(event) {
    const courseInput = event.target;
    let courseValue = courseInput.value;

    // Replace consecutive spaces with a single space
    courseValue = courseValue.replace(/\s+/g, " ");

    // Allow alphabetic characters, spaces, and dots
    courseValue = courseValue.replace(/[^a-zA-Z\s.]/g, "");

    courseInput.value = courseValue;

    // Check for continuous characters
    const continuousCharacters = /(.)\1{2,}/;

    if (
        courseValue.length < 1 ||
        courseValue.startsWith(".") ||
        continuousCharacters.test(courseValue)
    ) {
        showError(
            courseInput,
            "Course Should only Contain Alphabetic Characters, Spaces, and Dots"
        );
    } else {
        hideError(courseInput);
    }
}

function otherinstitutionvalidation(event) {
    const institutionInput = event.target;
    let institutionValue = institutionInput.value;

    // Replace consecutive spaces with a single space
    institutionValue = institutionValue.replace(/\s+/g, " ");

    // Allow alphabetic characters and spaces
    institutionValue = institutionValue.replace(/[^a-zA-Z\s]/g, "");

    institutionInput.value = institutionValue;

    // Check for continuous characters
    const continuousCharacters = /(.)\1{2,}/;

    if (
        institutionValue.length < 10 ||
        continuousCharacters.test(institutionValue)
    ) {
        showError(
            institutionInput,
            "Institution should only Contain Alphabetic Characters and Spaces"
        );
    } else {
        hideError(institutionInput);
    }
}

$(function() {
    var option = function(i, j) {
        return $("<option value=" + (j + 2000) + ">").append(j + 2000);
    };

    var options = (new Array(25) + "").split(",").map(option);

    $("#otherpassedout").append(options);
});

function otherpassedoutvalidation(event) {
    console.log("test");
    const inputElement = event.target;
    const value = inputElement.value.trim();
    // console.log("value...ww", value);
    if (value === "0") {
        // console.log("errore");
        showError(inputElement, "Please Select any one");
    } else {
        hideError(inputElement);
    }
}

function departmentvalidation(event) {
    const departmentInput = event.target;
    const value = departmentInput.value.trim();

    if (value === "") {
        showError(departmentInput, "Please choose a department");
    } else {
        hideError(departmentInput);
    }
}

function validateEmergencyContact(event) {
    const contactInput = event.target;
    const contactValue = event.target.value.trim(); // Trim to remove leading/trailing spaces

    // Regular expression to match valid contact numbers (customize as needed)
    const numericValue = contactValue.replace(/[^0-9]/g, "");
    // const regex = /^\+91[1-9]\d{9}$/;

    const phone_contact = document.getElementById("phone").value;

    // Check for consecutive numbers
    if (/(\d)\1{3,}/.test(numericValue)) {
        showError(event.target, "Emergency Contact should not contain more than 3 consecutive numbers");
        return;
    }

    if (numericValue !== "" && phone_contact === numericValue) {
        console.log("Inside./..");
        showError(event.target, "Emergency Contact Should Not be Same as Phone Number");
        return;
    }

    if (/^[6-9]\d{9}$/.test(numericValue)) {
        contactInput.value = numericValue;
        hideError(event.target);
    } else {
        showError(event.target, "Phone Number Should start with 6, 7, 8, or 9");
    }
}




function accountNumberValidation(event) {
    const account_numberInput = event.target.value.trim();
    console.log(account_numberInput);

    const minAccountNumberLength = 8;
    const maxAccountNumberLength = 18;

    let isValid = true; // Declare isValid variable

    // Check length
    if (
        account_numberInput.length < minAccountNumberLength ||
        account_numberInput.length > maxAccountNumberLength
    ) {
        showError(
            event.target,
            `Account number should be between ${minAccountNumberLength} and ${maxAccountNumberLength} digits`
        );
        isValid = false;
    } else if (!/^\d+$/.test(account_numberInput)) {
        showError(event.target, "Please enter a valid numeric account number");
        isValid = false;
    } else if (!/^[1-9]\d*$/.test(account_numberInput)) {
        showError(event.target, "First digit should be a non-zero digit");
        isValid = false;

    } else {
        hideError(event.target); // Define hideError function
    }

    return isValid; // Return isValid
}


function bank_namevalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();

    if (value === "") {
        showError(inputElement, "Please Fill IFSC Code");
    } else {
        hideError(inputElement);
    }
}

function branch_nameValidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();

    if (value === "") {
        showError(inputElement, "Please Fill IFSC Code");
    } else {
        hideError(inputElement);
    }
}


function ifsc_codeValidation(event) {
    // Check if the pressed key is not a modifier key (Shift, Ctrl, Alt)
    if (!(event.shiftKey || event.ctrlKey || event.altKey)) {
        const ifsc_codeInput = event.target;
        const ifsc_codeValue = ifsc_codeInput.value.trim();

        // IFSC code pattern: Four uppercase letters followed by seven digits
        const ifscPattern = /^[A-Z]{4}\d{7}$/;

        if (!ifscPattern.test(ifsc_codeValue)) {
            showError(ifsc_codeInput, "Invalid IFSC code, IFSC code pattern: Four uppercase letters followed by seven digits.");
        } else {
            console.log("hideError");
            hideError(ifsc_codeInput);
            hideError(document.getElementById("bank_name"));
            hideError(document.getElementById("branch_name"));
            // hideError(bank_nameInput);
            // hideError(branch_nameInput);
        }
    }
}


function work_experiencevalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();

    if (value === "") {
        showError(inputElement, "Please choose any one");
    } else {
        hideError(inputElement);
    }
}


// function uploadValidation(event) {
//     const inputElement = event.target;
//     const value = inputElement.value.trim();

//     if (value === "") {
//         showError(inputElement, "Please Upload Experience Certificate");
//     } else {
//         hideError(inputElement);
//     }
// }

function uploadValidation(event) {
    // console.log("teser....");
    var input = event.target;
    // var errorSpan = document.getElementById('error_documentInput');

    if (input.files.length > 0) {
        var file = input.files[0];

        // console.log("tesre");
        if (file.type !== 'application/pdf') {
            showError(input, 'Please upload Only PDF document.');
            input.value = '';
            return false;
        }

        var fileSizeKB = file.size / 1024; // Convert size to KB

        if (fileSizeKB < 100 || fileSizeKB > 1024 * 1) { // Check size range in KB (1 MB = 1024 KB)
            showError(input, 'Document size must be between 100 KB and 1 MB.');
            input.value = '';
            return false;
        }

        hideError(input);
        return true;
    } else {
        showError(input, 'Please select a document.');
        return false;
    }
}



function baseSalaryValidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim().toLowerCase();

    const errorElementId = "baseSalaryError";

    const minValue = 10000;
    const maxValue = 200000;

    const validAmountPattern = /^\d{5,6}$/;

    if (!value ||
        isNaN(value) ||
        parseFloat(value) < minValue ||
        parseFloat(value) > maxValue ||
        !validAmountPattern.test(value)
    ) {
        showError(
            inputElement,
            `Invalid base salary. Please enter a valid amount between $${minValue} and $${maxValue}.,
            errorElementId`
        );
        return false;
    } else {
        hideError(inputElement, errorElementId);
        return true;
    }
}








// function passportValidation(event) {
//     const passportNumberInput = event.target;
//     let passportNumber = passportNumberInput.value.trim();

//     // Remove non-alphanumeric characters
//     passportNumber = passportNumber.replace(/[^A-Z0-9]/g, "");
//     passportNumberInput.value = passportNumber;

//     // Set minimum and maximum length
//     const minLength = 8; // Example minimum length
//     const maxLength = 15; // Example maximum length

//     // Check if the alphanumeric value is within the specified length range
//     if (passportNumber.length < minLength || passportNumber.length > maxLength) {
//         showError(
//             passportNumberInput,
//             `Passport Number should be between ${minLength} and ${maxLength} characters long.`
//         );
//     } else {
//         hideError(passportNumberInput);
//     }
// }

function passportValidation(event) {
    const passportNumberInput = event.target;
    let passportNumber = passportNumberInput.value.trim();

    // Remove non-alphanumeric characters
    passportNumber = passportNumber.replace(/[^A-Z0-9]/g, "");
    passportNumberInput.value = passportNumber;

    // Set required length
    const requiredLength = 8; // Total length required

    // Check if the alphanumeric value has the required length
    if (passportNumber.length !== requiredLength) {
        showError(
            passportNumberInput,
            `Passport Number should be exactly ${requiredLength} characters long.`
        );
    } else {
        // Check if the first character is an uppercase letter and the next 7 characters are digits
        if (/^[A-Z]\d{7}$/.test(passportNumber)) {
            hideError(passportNumberInput);
        } else {
            showError(
                passportNumberInput,
                "Passport Number should start with an uppercase letter followed by 7 digits."
            );
        }
    }
}



function handlePassportStatus() {
    var passportStatus = document.getElementById("passportStatus").value;
    var passportField = document.getElementById("passportField");

    if (passportStatus === "yes") {
        passportField.style.display = "block";
    } else {
        passportField.style.display = "none";
        document.getElementById("passportError").innerHTML = ""; // Clear any existing error message
    }
}

function hasConsecutiveRepeatingDigits(input) {
    const consecutiveRepeatingDigitsPattern = /(\d)\1/; // Matches consecutive repeating digits
    return consecutiveRepeatingDigitsPattern.test(input);
}

function checkPincode(event) {
    console.log("func");
}