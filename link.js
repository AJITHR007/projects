window.onload = function() {
    const form = document.getElementById("form");
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
            showError(peraddressInput, "Permanent is required");
            isValid = false;
        } else {
            hideError(peraddressInput);
        }
        if (resaddressInput.value.trim() === "") {
            showError(resaddressInput, "Residential is required");
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
            console.log("test...");
            console.log("email......", emailValue.indexOf('@') >= 6);
            if (!(regex.test(emailValue) && emailValue.indexOf('@') >= 6)) {
                showError(emailInput, "Email should have at least 6 characters before @ symbol.");
            } else {
                hideError(emailInput);
            }
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
            "Employee Name Should Only Contain Alphabetic Characters and Spaces"
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
        showError(inputElement, "Please Select any one");
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
        showError(inputElement, "Please Select Date of birth");
    } else {
        hideError(inputElement);
    }
}

function gendervalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();
    console.log("value...", value);
    if (value === "") {
        showError(inputElement, "Please Select any one");
    } else {
        hideError(inputElement);
    }
}

function bloodGroupvalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();

    if (value === "") {
        showError(inputElement, "Please Select any one");
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
            "Father Name Should Only Contain Alphabetic Characters and Spaces"
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
            "Mother Name Should Only Contain Alphabetic Characters and Spaces"
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
        showError(inputElement, "Please Select any one");
    } else {
        hideError(inputElement);
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
            "Spouse Name Should Not have "
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
        showError(inputElement, "Please Select any one");
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
        showError(inputElement, "Please Select Date of birth");
    } else {
        hideError(inputElement);
    }
}

function spousebloodgroupvalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();
    console.log("value...", value);
    if (value === "") {
        showError(inputElement, "Please Select any one");
    } else {
        hideError(inputElement);
    }
}

function childrenvalidation(event) {
    const inputElement = event.target;
    const value = inputElement.value.trim();
    console.log("value...", value);
    if (value === "") {
        showError(inputElement, "Please Select any one");
    } else {
        hideError(inputElement);
    }
}

function phonenumbervalidation(event) {
    const phoneInputTarget = event.target;
    const phoneInput = event.target.value.trim();
    console.log(phoneInput);

    // Only keep numeric characters
    const numericValue = phoneInput.replace(/[^0-9]/g, "");

    const emergency_contact = document.getElementById("contact").value;


    if (numericValue !== "" &&
        emergency_contact === numericValue) {
        console.log("Inside./..");
        showError(event.target, "Phone Number Should be Starts With 6,7,8,9 and Minimum 10 Digits ");
    }

    // Check if the numeric value starts with 6, 7, 8, or 9 and has a total length of 10
    if (/^[6-9]\d{9}$/.test(numericValue)) {
        phoneInputTarget.value = numericValue;
        hideError(event.target);
    } else {
        showError(event.target, "Phone Number Should be Starts With 6,7,8,9 and Minimum 10 Digits");

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
            "Permanent Address should only contain alphanumeric characters, spaces, commas, periods, slashes, and hyphens."
        );
    } else {
        hideError(peraddressInput);
    }
}

function setBillingAddress() {
    if ($("#homepostalcheck").is(":checked")) {
        $("#resaddress").val($("#peraddress").val());
        $("#resaddress").attr("disabled", "disabled");
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
            "Residential Address should only contain alphanumeric characters, spaces, commas, periods, slashes, and hyphens."
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
        showError(event.target, "Invalid PIN Code");
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
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

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


    if (numericValue.startsWith("0") || numericValue.startsWith("1")) {
        showError(aadharCardInput, "Aadhar Number should not start with 0 or 1");
        return;
    }


    aadharCardValue = numericValue.replace(/(\d{4})/g, "$1 ").trim();
    aadharCardInput.value = aadharCardValue;


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
        showError(inputElement, "Please Select any one");
        return;
    }

    const dojDate = new Date(value);
    const currentDate = new Date();
    const oneYearAgo = new Date(currentDate);
    oneYearAgo.setFullYear(currentDate.getFullYear() - 1);
    const oneYearLater = new Date(currentDate);
    oneYearLater.setFullYear(currentDate.getFullYear() + 1);

    if (dojDate < oneYearAgo || dojDate > oneYearLater) {
        showError(
            inputElement,
            "Please enter a valid date within the previous 1 year and the next 1 year."
        );
    } else {
        hideError(inputElement);
    }
}

function designationvalidation(event) {
    const designationInputTarget = event.target;
    const designationInput = event.target.value.trim();
    console.log(designationInput);
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


    if (numericValue !== "" &&
        phone_contact === numericValue) {
        console.log("Inside./..");
        showError(event.target, "Emergency Contact Should Not be Same as Phone Number");
    }


    if (/^[6-9]\d{9}$/.test(numericValue)) {
        contactInput.value = numericValue;
        hideError(event.target);
    } else {
        showError(event.target, "Phone Number Should be Starts With 6,7,8,9");

    }
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
            hideError(ifsc_codeInput);
        }
    }
}