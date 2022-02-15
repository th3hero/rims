function restrictAlphabets(e) {
    var x = e.which || e.keycode;
    if ((x >= 48 && x <= 57 ))
        return true;
    else
        return false;
}

var Submit = document.getElementById('SubmitBTN');
Submit.addEventListener('click', function () {
    var Error = 0;
    var Name = document.getElementById('UserName').value;
    var Email = document.getElementById('UserEmail').value;
    var Phone = document.getElementById('UserPhone').value;
    var Hospital = document.getElementById('Hospital').value;
    var Department = document.getElementById('Department').value;


//Input Error Boxes
    var NameError = document.getElementById('NameFeedback');
    var EmailError = document.getElementById('EmailFeedback');
    var PhoneError = document.getElementById('PhoneFeedback');
    var HospitalError = document.getElementById('HospitalFeedback');
    var DepartmentError = document.getElementById('DepartmentFeedback');

    if (Name == "") {
        NameError.className = '';
        NameError.classList.add('text-danger');
        NameError.innerHTML = "Name is Required";
        Error++;
    } else {
        var regName = /^[A-Za-z ]+$/.test(Name);
        if (regName !== true) {
            NameError.className = '';
            NameError.classList.add('text-danger');
            NameError.innerHTML = 'Name should contain Letter and Space only!';
            Error++;
        } else {
            NameError.className = '';
            NameError.classList.add('text-success');
            NameError.innerHTML = 'Entered name is in correct format';
        }
    }

    if (Email == "") {
        EmailError.className = '';
        EmailError.classList.add('text-danger');
        EmailError.innerHTML = "Email is Required & should be unique";
        Error++;
    } else {
        var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(Email);
        if (regEmail !== true) {
            EmailError.className = '';
            EmailError.classList.add('text-danger');
            EmailError.innerHTML = "Email format is Invalid";
            Error++;
        } else {
            EmailError.className = '';
            EmailError.classList.add('text-success');
            EmailError.innerHTML = "Email is Correct & Valid";
        }
    }

    if (Phone == "") {
        PhoneError.className = '';
        PhoneError.classList.add('text-danger');
        PhoneError.innerHTML = "Phone Number is required";
        Error++;
    } else {
        regPhone = /^[0-9]{10}$/.test(Phone);
        console.log(regPhone);
        if (regPhone !== true) {
            PhoneError.className = '';
            PhoneError.classList.add('text-danger');
            PhoneError.innerHTML = "Phone Number should be of 10 Digits & Numbers only!";
            Error++;
        } else {
            PhoneError.className = '';
            PhoneError.classList.add('text-success');
            PhoneError.innerHTML = "Number is Valid & Correct";
        }
    }

    if (Hospital == "") {
        HospitalError.className = '';
        HospitalError.classList.add('text-danger');
        HospitalError.innerHTML = "Hospital Must be Selected";
        Error++;
    } else {
        HospitalError.className = '';
        HospitalError.classList.add('text-success');
        HospitalError.innerHTML = "Hospital is Selected";
    }

    if (Department == "") {
        DepartmentError.className = '';
        DepartmentError.classList.add('text-danger');
        DepartmentError.innerHTML = "Department Must be Selected";
        Error++;
    } else {
        DepartmentError.className = '';
        DepartmentError.classList.add('text-success');
        DepartmentError.innerHTML = "Department Selected";
    }

    if (Error == 0) {
        document.getElementById('PatientRegisteration').submit();
    }
});